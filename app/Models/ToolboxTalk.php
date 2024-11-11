<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolboxTalk extends Model
{
    use HasFactory;
    protected $table='toolbox_talk';
    public $timestamps = false;

    protected $guarded = [];

    public function toolbox_talk_items(){
        return $this->hasMany(ToolboxTalkItem::class, 'fk_toolbox_talk_id');
    }
}
