<?php

namespace App\Http\Requests\User;

use App\Constants\UserTypes;
use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam name string required The Name of the User.
 * @bodyParam email string required The Email of the User.
 * @bodyParam password_confirmation string required Confirm Password.
 * @bodyParam phone int required The Phone of the User. Example 01111234212
 * @bodyParam type int required The Type of the User. Allowed parameters = (Admin = 1 & Client = 2)
 * @bodyParam active int required The Status of the User. Allowed parameters = (Active = 1 & InActive = 0)
 */
class UserStore extends FormRequest
{
    use ValidationTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', ...constant('valid_name')],
            'email' => ['required', "unique:users", ...constant('valid_email')],
            'password' => ['required', ...constant('valid_password'), "confirmed"],
            'type' => "required|integer|in:".valid_inputs([UserTypes::ADMIN, UserTypes::CLIENT]),
            'phone' => ['required', "unique:users", ...constant('valid_phone')],
            'active' => ['required', ...constant('valid_active')],
        ];
    }

}
