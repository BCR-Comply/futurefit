<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CqaItem extends Model
{
    use HasFactory;
    protected $table = 'cqa_items';
    public $timestamps = false;

    function area()
    {
        return $this->belongsTo(CqaArea::class, 'fk_area_id');
    }
}
