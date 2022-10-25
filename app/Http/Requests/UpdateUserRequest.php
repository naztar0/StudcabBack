<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|unique:users,name|max:32',
            'email' => 'email|unique:users,email|max:64',
            'password' => 'min:8',
            'role' => 'string|in:user,admin',
        ];
    }

    public function getValidatorInstance()
    {
        $this->hashPassword();
        return parent::getValidatorInstance();
    }

    protected function hashPassword()
    {
        $this->merge([
            'password' => Hash::make($this->request->get('password'))
        ]);
    }
}
