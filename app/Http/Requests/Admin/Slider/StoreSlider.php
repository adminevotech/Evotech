<?php

namespace App\Http\Requests\Admin\Slider;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam group string required the group of slider record must be home_header or partner 3 characters min and 40 max. Example: Editor
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
            'group' => ["required", ...constant('valid_name'), "in:home_header,partner"],
            'photo' => ["required", ...constant('valid_image')],
        ];
    }
}
