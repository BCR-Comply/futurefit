<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheme extends Model
{
    use HasFactory;
    protected $table = 'schemes';

    public $timestamps = false;

    protected $fillable = [
        'scheme'
    ];

    function batches(){
        return $this->hasMany(Batch::class, 'scheme_id', 'id');
    }
}
