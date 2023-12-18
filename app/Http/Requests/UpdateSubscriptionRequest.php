<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UpdateSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->tokenCan('admin');
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors()));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string|filled',
            'cost' => 'regex:/^\d+(\.\d{1,2})?$/',
            'article_quota' => 'numeric|filled',
            'active' => 'boolean',
        ];
    }
}
