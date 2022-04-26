<?php

namespace App\Http\Requests\Admin\Client;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam client_category_id integer required the id of client category record must exist client categories table. Example: 2
 * @bodyParam name object required the value of client name record Example: {"en": "English client name", "ar": "Arabic client name"}
 * @bodyParam active boolean required the status of article category record
 * @bodyParam photo file required The image of the client. Maximum size is 5MB and allowed types are JPG, JPEG, PNG.
*/
class StoreClient extends FormRequest
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
            "client_category_id" => "required|exists:client_categories,id",
            "name" => "required",
            'photo' => ["required", ...constant('valid_image')],
            "active" => ["required", "boolean"],
        ];
    }

    public function withValidator($validator)
    {
        $translatables = ['name'];

        $validator->after(function ($validator) use ($translatables) {
            validate_translatables($validator, $translatables);
        });
    }
}
