<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorProperty extends Model
{
    use HasFactory;

    protected $table = 'contractor_property';

    public $timestamps = false;


    protected $fillable = [
        'property_id',
        'contractor_id',
        'cost',
        'paid',
        'notes',
        'our_price',
        'start_date',
        'end_date',
        'status',
        'contractor_notes',
        'surveyor_id',
        'job_id',
        'units',
        'survey_qty_inc_variation'
    ];

    function contractor()
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }

    function surveyor(){
        return $this->belongsTo(Surveyor::class, 'surveyor_id');
    }

    function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    function document()
    {
        return $this->hasMany(File::class, 'contract_id');
    }

    public function word_orders()
    {
        return $this->hasMany(WorkOrder::class, 'fk_contractor_property_id')->orderBy('status');
    }

    public function variation()
    {
        return $this->hasMany(Variaton::class, 'fk_contractor_property_id');
    }

    public function post_work_log(){
        return $this->hasMany(PostWorkLog::class, 'fk_contractor_property_id');
    }

    function job_lookup(){
        return $this->belongsTo(JobLookup::class, 'job_id');
    }

    public function property_notes()
    {
        return $this->hasMany(ContractorPropertyNotes::class, 'contractor_property_id');
    }
}
