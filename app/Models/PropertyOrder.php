<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyOrder extends Model
{
    use HasFactory;
    protected $table = 'properties_order';
    public $timestamps = false;
    protected $fillable = ['property_id','contractor_id','priority'];
    
}
