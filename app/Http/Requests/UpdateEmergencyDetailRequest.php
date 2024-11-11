<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmergencyDetailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contractor_next_of_kin_name' => ['nullable', 'string', 'max:255'],
            'contractor_safe_pass_photo' => ['nullable', 'image', 'max:1024'],
            'contractor_next_of_kin_phone' => ['nullable', 'string', 'max:15'],
            'contractor_safe_pass_expiry' => ['nullable', 'date'],
            'contractor_medical_issue' => ['nullable', 'string'],
            'contractor_agree_to_health_and_safety_procedure' => ['nullable', 'string', 'max:1'],
        ];
    }
}
