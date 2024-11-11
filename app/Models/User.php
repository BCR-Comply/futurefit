<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\PortalNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'firstname',
        'lastname',
        'usertype',
        'password_text',
        'eircode',
        'role',
        'phone',
        'address1',
        'address2',
        'address3',
        'county',
        'jobs',
        'company',
        'contractor_next_of_kin_name',
        'contractor_safe_pass_photo',
        'contractor_next_of_kin_phone',
        'contractor_safe_pass_expiry',
        'contractor_medical_issue',
        'contractor_agree_to_health_and_safety_procedure'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function assessor_properties(){
        return $this->belongsToMany(
            Property::class,
            'assessor_property',
            'assessor_id',
            'property_id'
        );
    }


    function contractor_properties(){
        return $this->belongsToMany(
            Property::class,
            'contractor_property',
            'contractor_id',
            'property_id'
        );
    }

    public function notifications(){
        return $this->morphMany(PortalNotification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
}
