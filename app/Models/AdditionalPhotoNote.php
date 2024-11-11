<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalPhotoNote extends Model
{
    protected $table = 'pi_additional_photos_notes';
    use HasFactory;

    public $timestamps = false;
}
