<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $table = 'batches';
    protected $fillable = [
        'id',
        'our_ref',
        'quote',
        'start_date',
        'end_date',
        'invoice',
        'scheme_id',
        'notes',
        'status'
    ];

    function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_id');
    }

    function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    function properties()
    {
        return $this->hasMany(Property::class, 'batch_id');
    }
}
