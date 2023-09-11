<?php

namespace App\Http\Requests\Admin;

use App\Classes\Rules;
use App\Enums\TemplateType;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class CreateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    private function onCreate(): array
    {
        return [
            "name" => ['required', 'string', 'min:3', 'max:100' , 'unique:users,name'],
            "email" => ['nullable', 'email'  , 'unique:users'],
            "password" => ['required', 'string','min:' . Rules::MIN_PASSWORD, 'max:' . Rules::MAX_PASSWORD , 'confirmed'],
            'avatar.*' => ['nullable','image','max:3000','mimes:jpg,png,jpeg,gif,svg'],
            'role_id'=> ['nullable' , 'exists:roles,id'],
            'mobile' => ['nullable', 'numeric'],
            'hours' => ['nullable', 'numeric'],
            'parent_id' => [
                'nullable',
                Rule::exists('users', 'id')->whereNull('parent_id')
            ],

        ];
    }

    private function onUpdate(): array
    {
        return [
            "name" => [
                'required',
                'string',
                'min:3',
                'max:100' ,
                Rule::unique('users', 'name')->ignore($this->id)
            ],
            "email" => ['nullable', 'email'],
            "password" => ['nullable', 'string','min:' . Rules::MIN_PASSWORD, 'max:' . Rules::MAX_PASSWORD , 'confirmed'],
            'avatar.*' => ['nullable','image','max:3000','mimes:jpg,png,jpeg,gif,svg'],
            'role_id'=> ['nullable' , 'exists:roles,id'],
            'mobile' => ['nullable', 'numeric'],
            'hours' => ['nullable', 'numeric'],
            'parent_id' => [
                'nullable',
                Rule::exists('users', 'id')->whereNull('parent_id')
            ],

        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
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
