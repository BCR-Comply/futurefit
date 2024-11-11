<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table = 'files';

    public $timestamps = false;

    protected $fillable = [
        'document',
        'file',
        'contract_id',
        'assessor_contract_id',
        'author'
    ];
}
