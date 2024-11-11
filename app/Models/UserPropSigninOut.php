<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPropSigninOut extends Model
{
    use HasFactory;
    protected $table = 'user_prop_signin_out';
    public $timestamps = false;

    function surveyor()
    {
        return $this->belongsTo(Surveyor::class, 'user_id', 'user_id');
    }
    function users()
    {
        return $this->hasOne(TableUser::class, 'user_id','user_id');
    }
}
