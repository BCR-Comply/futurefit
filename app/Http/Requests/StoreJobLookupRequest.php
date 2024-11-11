<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobLookupRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:100', 'unique:job_lookups,title,'.$this->id],
            'type' => ['required', 'string']
        ];
    }
}
