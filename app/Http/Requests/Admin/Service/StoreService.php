<?php

namespace App\Http\Requests\Admin\Service;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam title object required the value of service title record Example: {"en": "English service title", "ar": "Arabic service title"}
 * @bodyParam description object required the value of service description record Example: {"en": "English service description", "ar": "Arabic service description"}
 * @bodyParam short_description object the value of service short_description record Example: {"en": "English service short_description", "ar": "Arabic service short_description"}
 * @bodyParam active boolean required the status of service record
 * @bodyParam photo file required The image of the service. Maximum size is 5MB and allowed types are JPG, JPEG, PNG.
 * @bodyParam cover file required The cover of the service. Maximum size is 5MB and allowed types are JPG, JPEG, PNG.
*/
class StoreService extends FormRequest
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
            "title" => "required",
            "description" => "required",
            "short_description" => "array",
            'photo' => ["required", ...constant('valid_image')],
            'cover' => ["required", ...constant('valid_image')],
            "active" => ["required", "boolean"],
        ];
    }

    public function withValidator($validator)
    {
        $translatables = ['title', 'description', 'short_description'];

        $validator->after(function ($validator) use ($translatables) {
            validate_translatables($validator, $translatables);
        });
    }
}
