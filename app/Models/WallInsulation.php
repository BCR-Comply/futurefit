<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WallInsulation extends Model
{
    protected $table = 'pi_wall_insulation';
    use HasFactory;

    public $timestamps = false;
}
