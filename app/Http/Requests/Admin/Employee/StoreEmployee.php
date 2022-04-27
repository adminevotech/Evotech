<?php

namespace App\Http\Requests\Admin\Employee;

use App\Constants\EmployeeTypes;
use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam name string required the name of employee record must be at 3 characters min and 40 max. Example: Scott
 * @bodyParam position object required the value of employee position record Example: {"en": "English employee position", "ar": "Arabic employee position"}
 * @bodyParam social_media array the social media links of the employee. Example: [https://www.facebook.com/]
 * @bodyParam active boolean required the status of employee record
 * @bodyParam photo file required The image of the employee. Maximum size is 5MB and allowed types are JPG, JPEG, PNG.
*/
class StoreEmployee extends FormRequest
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
            "name" => ["required", ...constant('valid_name')],
            "position" => ["required"],
            'social_media' => "array",
            'photo' => ["required", ...constant('valid_image')],
            "active" => ["required", "boolean"],
        ];
    }

    public function withValidator($validator)
    {
        $translatables = ['position'];

        $validator->after(function ($validator) use ($translatables) {
            validate_translatables($validator, $translatables);
        });
    }
}
