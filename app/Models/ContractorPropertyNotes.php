<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorPropertyNotes extends Model
{
    use HasFactory;
    protected $table = 'contractor_property_notes';

    protected $fillable = [
        'property_id',
        'contractor_property_id',
        'contractor_id',
        'job_id',
        'notes',
        'created_by'
    ];


    function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}