<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreArea extends Model
{
    use HasFactory;
    protected $table = 'bre_areas';
    public $timestamps = false;

    function bre_item(){
        return $this->hasOne(BreItem::class, 'fk_area_id');
    }

    function bre_area(){
        return $this->hasOne(BrePhotoInspectionItem::class, 'fk_item_id');
    }

}
