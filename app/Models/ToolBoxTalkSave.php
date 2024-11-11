<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolBoxTalkSave extends Model
{
    protected $table = 'toolbox_talk_save';
    public $timestamps = false;
    function toolbox_talkdata()
    {
        return $this->hasOne(ToolboxTalk::class,'id','fk_toolbox_id');
    }
    function toolbox_talkitems()
    {
        return $this->hasOne(ToolboxTalkItem::class,'id','fk_toolbox_item_id');
    }
}
