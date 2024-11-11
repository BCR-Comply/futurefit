<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorLogs extends Model
{
    protected $table = 'error_logs';
    public $timestamps = false;
    use HasFactory;
}
