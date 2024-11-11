<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyNote extends Model
{
    use HasFactory;
    protected $table = 'property_notes';

    protected $fillable = ['text', 'property_id'];

    function propery(){
        return $this->belongsTo(Property::class, 'property_id');
    }
}
