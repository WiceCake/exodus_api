<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id', 'remember_token'
    ];
}
