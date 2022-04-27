<?php

namespace App\Http\Requests\Admin\Blog;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam title object the value of Blog title record Example: {"en": "English Blog title", "ar": "Arabic Blog title"}
 * @bodyParam description object the value of Blog description record Example: {"en": "English Blog description", "ar": "Arabic Blog description"}
 * @bodyParam active boolean the status of article category record
 * @bodyParam photo file The image of the Blog. Maximum size is 5MB and allowed types are JPG, JPEG, PNG.
 * @bodyParam cover file The image of the Blog. Maximum size is 5MB and allowed types are JPG, JPEG, PNG.
*/
class UpdateBlog extends FormRequest
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
            "description" => "array",
            'photo' => [...constant('valid_image')],
            'cover' => [...constant('valid_image')],
            "active" => ["boolean"],
        ];
    }

    public function withValidator($validator)
    {
        $translatables = ['title', 'description'];

        $validator->after(function ($validator) use ($translatables) {
            validate_translatables($validator, $translatables);
        });
    }
}
