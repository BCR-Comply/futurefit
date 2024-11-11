<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = 'logs';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'author',
        'type',
        'address',
        'property_id',
        'first_name',
        'last_name'
    ];
}
