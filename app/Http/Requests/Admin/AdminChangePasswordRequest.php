<?php

namespace App\Http\Requests\Admin;

use App\Classes\Rules;
use Illuminate\Foundation\Http\FormRequest;

class AdminChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => ['required', 'string', 'min:' . Rules::MIN_PASSWORD, 'max:' . Rules::MAX_PASSWORD],
            'password' => ['required', 'string', 'min:' . Rules::MIN_PASSWORD, 'max:' . Rules::MAX_PASSWORD , 'confirmed']
        ];
    }


}
