<?php
namespace App\Traits;

use App\Http\Requests\ChangePassword;
use App\Http\Requests\ResetPassword;
use App\Http\Requests\ResetPasswordLink;

use App\Http\Resources\User\CustomUserResource;
use App\Mail\ForgetPassword;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait AuthenticationTrait{
    public function login($request) {
        $user = User::whereEmail($request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            return ok_response(new CustomUserResource(['user' => $user, 'token' => $token]));
        }
        return unauthorized_response(constant("wrong_credentials_message"));
    }

    public function logout(Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        return ok_response(new CustomUserResource(['user' => $request->user(), 'token' => ""]));
    }

    public function changePassword(ChangePassword $request)
    {
        $request->user()->update(["password" => $request->password]);
        return ok_response(new CustomUserResource(['user' => $request->user()]));
    }

    public function resetPassword(ResetPassword $request)
    {
        $record = DB::table('password_resets')->where('token', $request->token)->latest()->firstOrFail();
        $tokenIsValid = $this->checkTokenValidation($record);

        if($tokenIsValid){
            $user = User::whereEmail($record->email)->first();

            if(Hash::check($request->password, $user->password)){
                return forbidden_response("You Can't Use Your Old Password");
            }

            $user->update(["password" => $request->password]);
            return ok_response(new CustomUserResource(['user' => $user]));
        }
        return unauthorized_response("Token Expired");
    }

    private function checkTokenValidation($record){
        $record_create_time = new DateTime($record->created_at);
        $current_time = new DateTime(now());
        return $record_create_time->modify("+".get_default_reset_password_link_expiration_time()." seconds") < $current_time;
    }

    public function sendResetPasswordLink(ResetPasswordLink $request)
    {
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $user = User::whereEmail($request->email)->first();

        $data = [
            "first_name" => $user->first_name,
            "reset_password_link" => config("system_defaults.reset_password_link")."?=$token",
        ];

        $this->emailInterface->sendEmail($request->email, ForgetPassword::class, $data);
        return ok_response();
    }
}
