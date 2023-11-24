<?php

namespace App\Http\Requests\V1\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('account');

        return [
            'login'    => [
                'sometimes',
                'string',
                'max:20',
                Rule::unique('accounts', 'login')->ignore($id, 'registerID'),
            ],
            'password' => 'sometimes|string|max:40',
            'phone'    => 'sometimes|string|max:20',
        ];
    }
}
