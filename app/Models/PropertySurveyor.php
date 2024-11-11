<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertySurveyor extends Model
{
    protected $table = 'property_surveyors';
    protected $fillable = ['property_id', 'surveyor_id', 'survey_date', 'today_date_status'];
    use HasFactory;


    function surveyor()
    {
        return $this->belongsTo(Surveyor::class, 'surveyor_id');
    }

    function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
