<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationMobile extends Model
{
    use HasFactory;
    protected $table = 'notifications_mobile';
    public $timestamps = false;
}