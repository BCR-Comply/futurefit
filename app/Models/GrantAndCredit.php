<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrantAndCredit extends Model
{
    protected $table = 'pi_grants_credits';
    use HasFactory;


    public $timestamps = false;
}
