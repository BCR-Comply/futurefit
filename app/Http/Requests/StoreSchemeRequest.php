<?php

namespace App\Http\Requests;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StoreSchemeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'scheme' => ['required', 'string', 'max:100', 'unique:schemes,scheme,'.$this->id],
            'is_active' => ['required']
        ];
    }
}
