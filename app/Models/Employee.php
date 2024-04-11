<?php

namespace App\Models;

use App\Models\EmployeeToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id', 'username', 'password'
    ];

    public function token(){
        return $this->hasOne(EmployeeToken::class, 'employee_id');
    }

    public function details(){
        return $this->belongsTo(Applicant::class, 'applicant_id', 'id');
    }

    public function schedules(){
        return $this->hasMany(Schedule::class, 'employee_id');
    }

    public function setToken($value){
        DB::table('employee_tokens')
            ->updateOrInsert(
                ['employee_id' => $this->id],
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
