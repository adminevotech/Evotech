<?php

namespace App\Http\Requests\Admin\Portfolio;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam name string required the value of Portfolio name record Example: English Portfolio name
 * @bodyParam link string required the value of Portfolio link record Example: https://www.google.com/
 * @bodyParam active boolean required the status of article category record
 * @bodyParam photo file required The image of the Portfolio. Maximum size is 5MB and allowed types are JPG, JPEG, PNG.
 * @bodyParam service_id integer required The image of the Portfolio.
*/
class StorePortfolio extends FormRequest
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
            "name" => "required",
            "service_id" => "required|exists:services,id",
            "link" => "required|url",
            'photo' => ["required", ...constant('valid_image')],
            "active" => ["required", "boolean"],
        ];
    }
}
