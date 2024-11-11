<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'works_orders';

    protected $fillable = [
        'fk_contractor_property_id',
        'fk_assessor_property_id',
        'file_path',
        'date',
        'status',
        'file_name'
    ];
}
