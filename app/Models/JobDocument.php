<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDocument extends Model
{
    use HasFactory;
    protected $table = 'job_documents';
    protected $guarded = [];
}
