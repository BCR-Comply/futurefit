<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variaton extends Model
{
    use HasFactory;
    protected $table = 'variations';

    public $timestamps = false;

    protected $fillable = [
        'fk_contractor_property_id',
        'notes',
        'additional_cost',
        'date',
        'status',
        'uploader_id',
        'uploader_type'
    ];

    public function documents()
    {
        return $this->hasMany(VariatonDoc::class, 'fk_variation_id', 'id');
    }
}
