<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WsVentilationThroughTheCavity extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ws_ventilation_through_the_cavity';
}
