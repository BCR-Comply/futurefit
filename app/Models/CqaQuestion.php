<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CqaQuestion extends Model
{
    use HasFactory;
    protected $table = 'cqa_questions';
    public $timestamps = false;
}
