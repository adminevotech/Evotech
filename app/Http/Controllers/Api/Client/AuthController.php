<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\OTPController;
use App\Http\Requests\Client\Auth\ClientLogin;
use App\Http\Requests\Client\Auth\ClientRegister;
use App\Http\Resources\User\CustomUserResource;
use App\Interfaces\EmailInterface;
use App\Models\User;
use App\Notifications\OTPVerification;
use App\Traits\AuthenticationTrait;

/**
 * @group Client Auth Module
 * @unauthenticated
 */
class AuthController extends Controller
{
    use AuthenticationTrait{
        login as TraitLogin;
    }

    protected $emailInterface;
    protected $OTPController;

    public function __construct(EmailInterface $emailInterface, OTPController $OTPController)
    {
        $this->emailInterface = $emailInterface;
        $this->OTPController = $OTPController;
    }

    public function register(ClientRegister $request) {
        $user = User::create($request->validated());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $this->OTPController->generateOTP($user);
        $user->notify(new OTPVerification());
        return ok_response(new CustomUserResource(['user' => $user, 'token' => $token]));
    }

    public function login(ClientLogin $request) {
        return $this->TraitLogin($request);
    }
}
