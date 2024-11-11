<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'reminders';

    protected $fillable = [
        'title',
        'notes',
        'due_date',
        'property_id',
        'status',
        'when_time',
        'due_time'
    ];
}
