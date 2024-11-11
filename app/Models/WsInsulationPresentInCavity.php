<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WsInsulationPresentInCavity extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ws_insulation_present_in_cavity';
}
