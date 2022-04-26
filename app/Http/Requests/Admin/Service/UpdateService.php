<?php

namespace App\Http\Requests\Admin\Service;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam title object the value of service title record Example: {"en": "English service title", "ar": "Arabic service title"}
 * @bodyParam active boolean the status of service category record
 * @bodyParam points object the value of service points record Example: {"en": ["points 1", "points 2"], "ar": ["points 1", "points 2"]}
 * @bodyParam photo file The image of the service. Maximum size is 5MB and allowed types are JPG, JPEG, PNG.
*/
class UpdateService extends FormRequest
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
            "title" => "array",
            "points" => "array",
            'photo' => constant('valid_image'),
            "active" => "boolean",
        ];
    }

    public function withValidator($validator)
    {
        $translatables = ['title'];

        $validator->after(function ($validator) use ($translatables) {
            validate_translatables($validator, $translatables);
        });
    }
}
