<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnagRecord extends Model
{
    use HasFactory;
    protected $table='snag_records';
    public $timestamps = false;

    public function comments(){
        return $this->hasMany(SnagRecordsComment::class, 'fk_snag_record_id', 'id');
    }


    public function property(){
        return $this->belongsTo(Property::class, 'fk_property_id');
    }
}
