<?php

namespace App\Http\Requests\Api;

use App\Enums\AppEnv;
use App\Enums\ContractServer;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class ShowSerialpasoRequest extends FormRequest
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
        return [
            'file'            => ['required', 'string', 'max:128'],
            'app_env'         => ['required', 'digits_between:1,4', 'max:2', new EnumValue(AppEnv::class)],
            'contract_app'    => ['required', 'digits_between:1,4'],
            'contract_server' => ['required', 'digits_between:1,4', 'max:1', new EnumValue(ContractServer::class)],
        ];  
    }
}
