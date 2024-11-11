<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspections extends Model
{
    protected $table = 'inspections';
    public $timestamps = false;
    function bre_snag()
    {
        return $this->hasMany(SnagRecord::class, 'fk_inspection_id','id');
    }
}
