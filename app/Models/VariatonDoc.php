<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariatonDoc extends Model
{
    use HasFactory;
    protected $table = 'variation_docs';
    protected $fillable = [
        'fk_variation_id',
        'file_path',
        'uploader_id',
        'uploader_type'
    ];
}
