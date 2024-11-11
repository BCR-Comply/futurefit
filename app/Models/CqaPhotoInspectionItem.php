<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CqaPhotoInspectionItem extends Model
{
    use HasFactory;
    protected $table = 'cqa_photo_inspection_items';
    public $timestamps = false;

    function property()
    {
        return $this->belongsTo(Property::class, 'fk_property_id');
    }

    function cqa_item(){
        return $this->belongsTo(CqaItem::class, 'fk_item_id');
    }

    function cqa_area(){
        return $this->belongsTo(CqaArea::class, 'fk_item_id');
    }

    function cqa_question(){
        return $this->belongsTo(CqaQuestion::class, 'fk_question_id');
    }
}
