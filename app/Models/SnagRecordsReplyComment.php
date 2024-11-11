<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnagRecordsReplyComment extends Model
{
    use HasFactory;
    protected $table='snag_records_reply_comment';
    public $timestamps = false;
}
