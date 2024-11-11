<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolboxTalkItem extends Model
{
    use HasFactory;
    protected $table='toolbox_talk_items';
    public $timestamps = false;

    protected $guarded = [];
}
