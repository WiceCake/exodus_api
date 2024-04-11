<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantCreds extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id', 'username', 'password'
    ];

    protected $hidden = [
        'password',
    ];

    protected $cast = [
        'password' => 'hashed',
    ];

    public function user(){
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }

    
}
