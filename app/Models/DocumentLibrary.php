<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentLibrary extends Model
{
    use HasFactory;
    protected $table = 'document_library';
    protected $fillable = [
        'job_lookup',
        'job_document',
        'document',
        'file'
    ];

    function job_look(){
        return $this->belongsTo(JobLookup::class, 'job_lookup', 'id');
    }
    function job_document_type(){
        return $this->belongsTo(JobDocument::class, 'job_document', 'id');
    }

}
