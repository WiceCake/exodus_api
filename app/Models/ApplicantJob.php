<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id', 'applicant_id'
    ];
}
