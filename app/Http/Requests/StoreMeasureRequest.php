<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeasureRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'property_id' => ['required'],
            'job_id' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
        ];
    }
}
