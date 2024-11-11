<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalDrawing extends Model
{
    protected $table = 'pi_drawings_and_photographs';
    use HasFactory;

    public $timestamps = false;
}
