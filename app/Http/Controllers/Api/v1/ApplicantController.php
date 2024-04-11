<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Job;
use App\Models\Applicant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ApplicantCreds;
use App\Http\Controllers\Controller;
use App\Models\ApplicantDocument;
use App\Models\ApplicantJob;
use App\Models\ApplicantToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApplicantController extends Controller
{
    //
    public function apply(Request $request){
        $validate = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:applicants,email',
            'birthday' => 'required|date',
            'gender' => 'required|in:Male,Female',
        ]);

        if($validate->fails()){
            $errors = $validate->errors();
            $error_format = [];

            foreach($errors->keys() as $key){
                $error_format[$key] = $errors->get($key);
            }

            return response()->json([
                'status' => 'invalid',
                'message' => 'The given data was invalid',
                'errors' => $error_format
            ], 401);
        }

        
        $username = Str::random(8);
        $password = Str::random(20);

        $applicant = Applicant::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'status' => 'Pending',
        ]);

        ApplicantCreds::create([
            'applicant_id' => $applicant->id,
            'username' => $username,
            'password' => bcrypt($password),
        ]);


        return response()->json([
            'status' => 'success',
            'username' => $username,
            'password' => $password,
        ]);
    }

    public function applyJob(Request $request){
        $user = Applicant::whereHas('token', function($q){
            $q->where('remember_token', request()->bearerToken());
        })->first();

        $validate = Validator::make($request->all(), [
            'job_id' => 'required|exists:jobs,id',
        ]);

        if($user->job){
            return response()->json([
                'status' => 'invalid',
                'message' => 'You already applied in for ' . $user->job->first()->job_name,
            ], 401);
        }

        if($validate->fails()){
            $errors = $validate->errors();
            $error_format = [];

            foreach($errors->keys() as $key){
                $error_format[$key] = $errors->get($key);
            }

            return response()->json([
                'status' => 'invalid',
                'message' => 'The given data was invalid',
                'errors' => $error_format
            ], 401);
        }

        ApplicantJob::create([
            'job_id' => $request->job_id,
            'applicant_id' => $user->id
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function getJob(){
        $user = Applicant::whereHas('token', function($q){
            $q->where('remember_token', request()->bearerToken());
        })->first();

        $job = $user->job->first();

        return response()->json([
            'id' => $job->id,
            'name' => $job->job_name,
            'description' => $job->description
        ], 200);
    }
    
    public function documents(Request $request){
        $user = Applicant::whereHas('token', function($q){
            $q->where('remember_token', request()->bearerToken());
        })->first();

        if(!$user->job){
            return response()->json([
                'status' => 'invalid',
                'message' => 'Apply a job first'
            ]);
        }

        $validate = Validator::make($request->all(), [
            'file_category' => 'required|in:Birth Certificate,Barangay Clearance,Police Clearance,Valid ID',
            'birth_certificate' => 'file|mimes:pdf,png,jpg,jpeg',
            'brgy_clearance' => 'file|mimes:pdf,png,jpg,jpeg',
            'police_clearance' => 'file|mimes:pdf,png,jpg,jpeg',
            'valid_id' => 'file|mimes:pdf,png,jpg,jpeg'
        ]);

        if($validate->fails()){
            $errors = $validate->errors();
            $error_format = [];

            foreach($errors->keys() as $key){
                $error_format[$key] = $errors->get($key);
            }

            return response()->json([
                'status' => 'invalid',
                'message' => 'The given data was invalid',
                'errors' => $error_format
            ], 401);
        }

        $file_check = ApplicantDocument::where(['applicant_id' => $user->id, 'file_category' => $request->file_category])->first();

        if($file_check){
            return response()->json([
                'status' => 'invalid',
                'message' => 'You already submitted file for ' . $request->file_category,
            ], 401);
        }

        $file = null;

        switch($request->file_category){
            case 'Birth Certificate':
                $file = $request->file('birth_certificate');
                break;
            case 'Barangay Clearance':
                $file = $request->file('brgy_clearance');
                break;
            case 'Police Clearance':
                $file = $request->file('police_clearance');
                break;
            case 'Valid ID':
                $file = $request->file('valid_id');
                break;
        }

        if(!$file){
            return response()->json([
                'status' => 'invalid',
                'message' => 'Did not upload any files please upload at least one'
            ], 401);
        }

        ApplicantDocument::create([
            'applicant_id' => $user->id,
            'file_category' => $request->file_category,
            'path' => $file->getClientOriginalName()
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function status(){
        $user = Applicant::whereHas('token', function($q){
            $q->where('remember_token', request()->bearerToken());
        })->first();
        
        $file_categories = ['Birth Certificate', 'Barangay Clearance', 'Police Clearance', 'Valid ID'];
        $documents = $user->documents->pluck('file_category')->toArray();
        $file_categories = array_diff($file_categories, $documents);

        return response()->json([
            'status' => 'success',
            'application_status' => $user->status,
            'remaining_requirements' => $file_categories
        ]); 
    }

    public function login(Request $request){
        
        $username = $request->username;
        $password = $request->password;

        $user = ApplicantCreds::where('username', $username)->first();

        if(!$user){
            return response()->json([
                'status' => 'invalid',
                'message' => 'User Not Found'
            ], 400);
        }

        if(!Hash::check($password, $user->password)){
            return response()->json([
                'status' => 'invalid',
                'message' => 'Invalid Password'
            ], 401);
        }

        $token = md5(Str::random(80) . now());

        $user->user->setToken($token);

        return response()->json([
            'status' => 'success',
            'token' => $token
        ], 201);

    }

    public function logout(){
        $user = Applicant::whereHas('token', function($q){
            $q->where('remember_token', request()->bearerToken());
        })->first();

        $user->setToken(null);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
