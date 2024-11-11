<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnagRecordsComment extends Model
{
    use HasFactory;
    protected $table='snag_records_comments';
    public $timestamps = false;

    public function comment_reply(){
        return $this->hasMany(SnagRecordsReplyComment::class, 'fk_snag_comment_id', 'id');
    }
}
