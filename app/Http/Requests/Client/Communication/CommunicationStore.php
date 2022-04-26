<?php

namespace App\Http\Requests\Client\Communication;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam name string required record must be at 3 characters min and 40 max. Example: Editor
 * @bodyParam message string required
 * @bodyParam subject string required
 * @bodyParam email email required
*/
class CommunicationStore extends FormRequest
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
            "email" => ["required", ...constant('valid_email')],
            "subject" => ["required"],
            "message" => ["required", ...constant('valid_description')],
        ];
    }
}
