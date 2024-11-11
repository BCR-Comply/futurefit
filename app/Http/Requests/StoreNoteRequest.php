<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'text' => ['required', 'string'],
            'property_id' => ['required', 'string']
        ];
    }
}
