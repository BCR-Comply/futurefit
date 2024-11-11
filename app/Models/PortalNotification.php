<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortalNotification extends  DatabaseNotification {
    use HasFactory;
    protected $table = 'portal_notifications';
}
