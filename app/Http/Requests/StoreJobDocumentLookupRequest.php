<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobDocumentLookupRequest extends FormRequest
{
    public function rules()
    {
        return [
            'documents' => ['required', 'array', 'min:1']
        ];
    }
}
