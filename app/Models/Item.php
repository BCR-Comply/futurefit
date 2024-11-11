<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    public $timestamps = false;

    function area()
    {
        return $this->belongsTo(Area::class, 'fk_area_id');
    }
}
