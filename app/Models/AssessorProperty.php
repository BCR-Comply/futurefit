<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessorProperty extends Model
{
    use HasFactory;

    protected $table = 'assessor_property';

    public $timestamps = false;

    protected $fillable = [
        'property_id',
        'assessor_id',
        'cost',
        'paid',
        'notes',
        'our_price',
        'start_date',
        'end_date',
        'status',
        'assessor_notes',
        'surveyor_id',
        'job_id'
    ];

    function assessor()
    {
        return $this->belongsTo(User::class, 'assessor_id');
    }

    function surveyor()
    {
        return $this->belongsTo(Surveyor::class, 'surveyor_id');
    }

    function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    function document()
    {
        return $this->hasMany(File::class, 'assessor_contract_id');
    }

    public function work_orders()
    {
        return $this->hasMany(WorkOrder::class, 'fk_assessor_property_id')->orderBy('status');
    }

    function job_lookup(){
        return $this->belongsTo(JobLookup::class, 'job_id');
    }
}
