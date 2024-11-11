<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostWorkLog extends Model
{
    use HasFactory;

    protected $table = 'post_works_logs';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'fk_contractor_property_id',
        'notes',
        'date_added',
        'status',
    ];


    function contractor_property()
    {
        return $this->belongsTo(ContractorProperty::class, 'fk_contractor_property_id');
    }
}
