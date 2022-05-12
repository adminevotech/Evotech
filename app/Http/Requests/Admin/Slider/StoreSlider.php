<?php

namespace App\Http\Requests\Admin\Slider;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam title object required the value of slider title record Example: {"en": "English slider title", "ar": "Arabic slider title"}
 * @bodyParam sub_title object required the value of slider title record Example: {"en": "English slider title", "ar": "Arabic slider title"}
 * @bodyParam description object required the value of slider description record Example: {"en": "English slider description", "ar": "Arabic slider description"}
 * @bodyParam button object required the value of slider button record Example: {"en": "English slider button", "ar": "Arabic slider button"}
 * @bodyParam photo file required The image of the slider. Maximum size is 5MB and allowed types are JPG, JPEG, PNG.
*/
class StoreSlider extends FormRequest
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
            "title" => "required|array",
            "sub_title" => "required|array",
            "description" => "required|array",
            "button" => "required|array",
            'photo' => ["required", ...constant('valid_image')],
        ];
    }

    public function withValidator($validator)
    {
        $translatables = ['title', 'description', 'button', 'sub_title'];

        $validator->after(function ($validator) use ($translatables) {
            validate_translatables($validator, $translatables);
        });
    }
}
