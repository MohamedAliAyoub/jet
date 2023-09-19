<?php

namespace App\Http\Requests\Api\Auth;

use App\Classes\Rules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email' => [
                    'required',
                    Rule::exists('users')->where(function ($query)  {
                        $query->where('name', request()->input('email'))
                            ->orWhere('email', request()->input('email'));
                    }),
                ],
            ],
            'password' => ['required'],
        ];
    }
}
