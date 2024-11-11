<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorMessage extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'contractor_message';
}
