<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    use HasFactory;

    protected $table = 'measures';
    protected $fillable = [
        'property_id',
        'job_id'
    ];
    public $timestamps = false;

    function job_lookup(){
        return $this->belongsTo(JobLookup::class, 'job_id');
    }
}
