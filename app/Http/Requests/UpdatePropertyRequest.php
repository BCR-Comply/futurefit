<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'batch_id' => ['required', 'numeric'],
            'house_num' => ['nullable', 'string', 'max:20'],
            'address1' => ['required', 'string', 'max:50'],
            'address2' => ['nullable', 'string', 'max:50'],
            'address3' => ['nullable', 'string', 'max:50'],
            'county' => ['nullable', 'string', 'max:50'],
            'eircode' => ['nullable', 'string', 'max:20'],
            'wh_fname' => ['nullable', 'string', 'max:100'],
            'wh_lname' => ['nullable', 'string', 'max:100'],
            'phone1' => ['nullable', 'string', 'max:16'],
            'phone2' => ['nullable', 'string', 'max:16'],
            'notes' => ['nullable', 'string'],
            'wh_mprn' => 'nullable|max:11|min:11',
            'start_date' => ['required'],
            'end_date' => ['required'],
            'client_select_type' => ['required', 'string'],
            'contractor_status' => ['required', 'string'],
            'hea_status' => ['required', 'string'],
            'status' => ['required', 'string'],
            'email' => ['nullable', 'string'],
            'pre_ber' => ['nullable', 'string'],
            'post_ber' => ['nullable', 'string'],
            'wh_ref' => ['nullable', 'string']
        ];
    }
}
