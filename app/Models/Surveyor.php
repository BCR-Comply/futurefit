<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surveyor extends Model
{
    use HasFactory;

    protected $table = 'tbl_user';
    protected $primaryKey = 'user_id'; // or null
    public $timestamps = false;
    protected $fillable = [
        'appname',
        'email',
        'password',
        'full_name',
        'phone_number',
        'role',
        'status',
        'contractor_id',
        'assessor_id',
        'is_access'
    ];

    function properties()
    {
        return $this->belongsToMany(
            Property::class,
            'property_surveyors',
            'surveyor_id',
            'property_id'
        );
    }

}
