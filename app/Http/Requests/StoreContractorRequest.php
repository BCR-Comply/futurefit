<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                $this->request->get('id') ? 'unique:users,email,' . $this->request->get('id') : 'unique:users'],
            'firstname' => ['required', 'string', 'max:255'],
            'password' => [$this->request->get('id') ? 'nullable' : 'required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'eircode' => ['required', 'string', 'max:255'],
            'address1' => ['nullable', 'string', 'max:255'],
            'address2' => ['nullable', 'string', 'max:255'],
            'address3' => ['nullable', 'string', 'max:255'],
            'county' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'contractor_next_of_kin_name' => ['nullable', 'string', 'max:255'],
            'contractor_safe_pass_photo' => ['nullable', 'image', 'max:1024'],
            'contractor_next_of_kin_phone' => ['nullable', 'string', 'max:15'],
            'contractor_safe_pass_expiry' => ['nullable', 'date'],
            'contractor_medical_issue' => ['nullable', 'string'],
            'contractor_agree_to_health_and_safety_procedure' => ['nullable', 'string', 'max:1'],
            'is_default_contractor' => ['nullable', 'boolean']
        ];
    }
}
