<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoInspectionItem extends Model
{
    use HasFactory;
    protected $table = 'photo_inspection_items';
    public $timestamps = false;

    function property()
    {
        return $this->belongsTo(Property::class, 'fk_property_id');
    }

    function question()
    {
        return $this->belongsTo(Question::class, 'fk_quesion_id');
    }

    function item()
    {
        return $this->belongsTo(Item::class, 'fk_item_id');
    }
}
