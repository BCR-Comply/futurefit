<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLookup extends Model
{
    use HasFactory;
    protected $table = 'job_lookups';
    protected $guarded = [];

    function documents()
    {
        return $this->hasMany(JobDocument::class, 'job_look_id', 'id');
    }
}