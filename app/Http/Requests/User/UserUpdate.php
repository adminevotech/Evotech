<?php

namespace App\Http\Requests\User;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @bodyParam name string The Name of the User.
 * @bodyParam email string The Email of the User.
 * @bodyParam password_confirmation string Confirm Password.
 * @bodyParam phone int The Phone of the User.
 * @bodyParam type int The Type of the User. Allowed parameters = (Admin = 1 & Client = 2)
 * @bodyParam active int The Status of the User. Allowed parameters = (Active = 1 & InActive = 0)
 */

class UserUpdate extends FormRequest
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
            'name' => [...constant('valid_name')],
            'email' => [Rule::unique('users')->ignore(optional($this->user)->id, 'id'), ...constant('valid_email')],
            'password' => [...constant('valid_password'), "confirmed"],
            'phone' => [Rule::unique('users')->ignore(optional($this->user)->id, 'id'), ...constant('valid_phone')],
            'active' => [...constant('valid_active')],
        ];
    }
}
