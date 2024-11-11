<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFinancialRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'deposit_amount' => ['nullable'],
            'interim_amount' => ['nullable'],
            'final_amount' => ['nullable'],
            'deposit_date' => ['nullable'],
            'interim_date' => ['nullable'],
            'final_date' => ['nullable'],
            'overall_total' => ['nullable'],
            'deposit_status' => ['required'],
            'interim_status' => ['required'],
            'final_status' => ['required']
        ];
    }
}
