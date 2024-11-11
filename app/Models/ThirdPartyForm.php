<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThirdPartyForm extends Model
{
    protected $table = '3rd_party_forms';
    protected $fillable = [
        'fk_property_id',
        'type',
        'supplied_by',
        'notes',
        'file_path',
        'archived'
    ];
    public $timestamps = false;
    use HasFactory;
}
