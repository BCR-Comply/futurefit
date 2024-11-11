<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrePhotoInspectionItem extends Model
{
    use HasFactory;
    protected $table = 'bre_photo_inspection_items';
    public $timestamps = false;

    function bre_item(){
        return $this->belongsTo(BreItem::class, 'fk_item_id');
    }

    function bre_area(){
        return $this->belongsTo(BreArea::class, 'fk_item_id');
    }

    function bre_question(){
        return $this->belongsTo(BreQuestion::class, 'fk_question_id');
    }
}
