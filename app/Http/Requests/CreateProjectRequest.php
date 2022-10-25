<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:32',
            'group_id' => 'integer|exists:groups,id|nullable',
            'speakers' => 'integer'
        ];
    }
}
