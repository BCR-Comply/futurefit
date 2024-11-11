<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contractor_id' => ['required', 'numeric'],
            'property_id' => ['required', 'numeric'],
            'notes' => ['nullable', 'string'],
            'job_id' => ['required', 'numeric'],
            'our_price' => 'nullable|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'paid' => 'nullable|numeric|min:0',
            'start_date' => ['required'],
            'end_date' => ['required'],
            'status' => ['required', 'string'],
            'surveyor_id' => ['nullable', 'numeric'],
            'units' => ['nullable', 'string', 'max:255']
        ];
    }
}
