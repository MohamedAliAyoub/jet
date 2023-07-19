<?php

namespace App\Http\Requests\Admin;

use App\Classes\Rules;
use App\Enums\TemplateType;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    private function onCreate()
    {
        return [
            "name" => ['required', 'string', 'min:3', 'max:100'],
            "email" => ['required', 'email'  , 'unique:users'],
            "password" => ['required', 'string','min:' . Rules::MIN_PASSWORD, 'max:' . Rules::MAX_PASSWORD , 'confirmed'],
            'avatar.*' => ['nullable','image','max:3000','mimes:jpg,png,jpeg,gif,svg'],
            'role_id'=> ['nullable' , 'exists:roles,id'],
            'mobile' => ['nullable', 'numeric'],


        ];
    }

    private function onUpdate()
    {
        return [
            "name" => ['required', 'string', 'min:3', 'max:100'],
            "email" => ['required', 'email'],
            "password" => ['nullable', 'string','min:' . Rules::MIN_PASSWORD, 'max:' . Rules::MAX_PASSWORD , 'confirmed'],
            'avatar.*' => ['nullable','image','max:3000','mimes:jpg,png,jpeg,gif,svg'],
            'role_id'=> ['nullable' , 'exists:roles,id'],
            'mobile' => ['nullable', 'numeric'],


        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        // $rules = [
        //     'email' => 'required|unique:table,column'
        // ];

        // if($this->routeIs('user.admins.update')) {
        //     $rules = array_merge($rules, [
        //         'email' => 'required|unique:table,column,except,id'
        //     ]);
        // }

        return request()->id ? $this->onUpdate() : $this->onCreate();
    }
}
