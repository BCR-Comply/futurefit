<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoFolderName extends Model
{
    protected $table = 'photo_folder_names';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];
}