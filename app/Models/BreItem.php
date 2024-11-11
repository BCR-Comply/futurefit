<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreItem extends Model
{
    use HasFactory;
    protected $table = 'bre_items';
    public $timestamps = false;

    function bre_area(){
        return $this->belongsTo(BreArea::class, 'fk_area_id');
    }
}
