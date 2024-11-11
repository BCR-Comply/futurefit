<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrandTotal extends Model
{
    protected $table = 'pi_grand_total';
    use HasFactory;


    public $timestamps = false;
}
