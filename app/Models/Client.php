<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    public $timestamps = false;

    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'address1',
        'address2',
        'address3',
        'eircode',
        'county',
        'notes'
    ];

}
