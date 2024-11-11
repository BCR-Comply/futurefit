<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreQuestion extends Model
{
    use HasFactory;
    protected $table = 'bre_questions';
    public $timestamps = false;
}
