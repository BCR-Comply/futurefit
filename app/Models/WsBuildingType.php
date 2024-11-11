<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WsBuildingType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ws_building_type';
}
