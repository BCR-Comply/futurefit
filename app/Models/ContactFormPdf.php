<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractFormPdf extends Model
{
    protected $table = 'contract_forms_pdf';
    public $timestamps = false;

    public function contractForm()
    {
        return $this->hasOne(ContractForm::class, 'fk_contract_forms_pdf_id');
    }
}
