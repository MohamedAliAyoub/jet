<?php

namespace App\Http\Requests\Role;

use App\Enums\TemplateType;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            "name" => ['required', 'string', 'min:3', 'max:100'],
            "title" => ['nullable', 'string', 'min:3', 'max:100'],
            'abilities' => [ 'nullable', 'array'],
            'abilities.*' => [ 'nullable', 'string'],
        ];
    }
}
