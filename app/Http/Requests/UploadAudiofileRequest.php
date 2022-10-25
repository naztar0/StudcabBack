<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UploadAudiofileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'audiofile' => [
                'required', 'file', 'mimes:mp3,ogg,aac,m4a,wav', 'max:4096',
                Rule::prohibitedIf((bool)$this->project->audiofile),
            ]
        ];
    }
}
