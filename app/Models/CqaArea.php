<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CqaArea extends Model
{
    use HasFactory;
    protected $table = 'cqa_areas';
    public $timestamps = false;

    function cqa_item(){
        return $this->hasOne(CqaItem::class, 'fk_area_id');
    }

    function cqa_area(){
        return $this->hasOne(CqaPhotoInspectionItem::class, 'fk_item_id');
    }

}
