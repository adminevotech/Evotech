<?php

namespace App\Http\Requests\Admin\Client;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam name object the value of client name record Example: {"en": "English client name", "ar": "Arabic client name"}
 * @bodyParam link string the link of client record Example: https://www.google.com/
 * @bodyParam active boolean the status of article category record
 * @bodyParam photo file The image of the client. Maximum size is 5MB and allowed types are JPG, JPEG, PNG.
*/
class UpdateClient extends FormRequest
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
            "name" => "array",
            "link" => "nullable|url",
            'photo' => [...constant('valid_image')],
            "active" => ["boolean"],
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
