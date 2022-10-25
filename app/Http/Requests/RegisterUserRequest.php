<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|unique:users,name|max:32',
            'email' => 'required|email|unique:users,email|max:64',
            'password' => 'required|min:8'
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
