<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;
    protected $table = 'properties';

    public $timestamps = false;

    protected $fillable = [
        'house_num',
        'client_id',
        'address1',
        'address2',
        'address3',
        'county',
        'eircode',
        'wh_fname',
        'wh_lname',
        'phone1',
        'phone2',
        'notes',
        'wh_mprn',
        'batch_id',
        'archived',
        'start_date',
        'end_date',
        'hea_status',
        'contractor_status',
        'status',
        'email',
        'post_ber',
        'pre_ber',
        'deposit_amount',
        'interim_amount',
        'final_amount',
        'deposit_date',
        'interim_date',
        'final_date',
        'deposit_status',
        'interim_status',
        'final_status',
        'overall_total',
        'wh_ref',
        'lead_type',
        'lead_value',
        'lead_source',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function contract()
    {
        return $this->hasMany(ContractorProperty::class, 'property_id', 'id');
    }

    public function assessor_contract()
    {
        return $this->hasMany(AssessorProperty::class, 'property_id', 'id');
    }

    public function measures()
    {
        return $this->hasMany(Measure::class, 'property_id', 'id');
    }

    public function notes(){
        return $this->hasMany(PropertyNote::class, 'property_id', 'id');
    }
    public function snags(){
        return $this->hasMany(SnagRecord::class, 'fk_property_id', 'id');
    }
    function user_signin_out()
    {
        return $this->hasMany(UserPropSigninOut::class,'property_id');
    }
    public function inspection_data()
    {
        return $this->hasOne(Inspection::class, 'fk_property_id', 'id')->where('fk_forms_id',22)->orderBy('id','desc');
    }
}
