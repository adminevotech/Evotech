<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\AdminLogin;
use App\Traits\AuthenticationTrait;

/**
 * @group Admin Auth Module
 * @unauthenticated
 */
class AuthController extends Controller
{
    use AuthenticationTrait{
        login as TraitLogin;
    }

    public function login(AdminLogin $request) {
        return $this->TraitLogin($request);
    }
}
