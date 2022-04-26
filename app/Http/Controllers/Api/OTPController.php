<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OTPRequest;
use App\Http\Resources\User\UserResource;
use App\Notifications\OTPVerification;

class OTPController extends Controller
{
    public function verify(OTPRequest $request)
    {
        $user = auth()->user();

        if($request->input('otp') == $user->otp)
        {
            $user->resetOTP();
            $user->email_verified_at = now();
            $user->save();

            return ok_response(new UserResource($user), "Verified");
        }
        return unauthorized_response("Code InCorrect");
    }

    public function sendVerificationCode()
    {
        $user = auth()->user();
        $this->generateOTP($user);
        $user->notify(new OTPVerification());
        return ok_response("Verification Code Sent");
    }

    public function resetOTP($user)
    {
        $user->timestamps = false;
        $user->otp = null;
        $user->otp_expiration = null;
        $user->save();
    }
}
