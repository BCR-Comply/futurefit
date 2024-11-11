<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalBuildingDetail extends Model
{
    protected $table = 'pi_additional_property_detail';
    use HasFactory;

    public $timestamps = false;
}
