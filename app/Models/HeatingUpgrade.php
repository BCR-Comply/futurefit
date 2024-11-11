<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeatingUpgrade extends Model
{
    protected $table = 'pi_heating_upgrade';
    use HasFactory;


    public $timestamps = false;
}
