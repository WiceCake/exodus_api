<?php

namespace App\Models;

use App\Models\ApplicantToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'middle_name', 
        'last_name', 'email', 'birthday',
        'gender', 'status'
    ];

    public function token(){
        return $this->hasOne(ApplicantToken::class, 'applicant_id');
    }

    public function documents(){
        return $this->hasMany(ApplicantDocument::class, 'id');
    }

    public function job(){
        return $this->belongsToMany(Job::class, ApplicantJob::class);
    }

    public function setToken($value){
        DB::table('applicant_tokens')
            ->updateOrInsert(
                ['applicant_id' => $this->id],
                [
                    'remember_token' => $value,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
    }

    static function getUser(){
        return static::query()->whereHas('token', function($query){
            $query->where('remember_token', request()->bearerToken());
        })->first();
    }
}
