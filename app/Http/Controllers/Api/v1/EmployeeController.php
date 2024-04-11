<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Schedule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    //
    public function schedules(){
        $user = Employee::whereHas('token', function($q){
            $q->where('remember_token', request()->bearerToken());
        })->first();

        return response()->json([
            $user->schedules->map(function($schedule){
                return [
                    'id' => $schedule->id,
                    'day' => $schedule->day,
                    'time_slot_start' => $schedule->time_slot_start,
                    'time_slot_end' => $schedule->time_slot_end,
                ];
            })
        ]);
    }

    public function profile(){
        $user = Employee::whereHas('token', function($q){
            $q->where('remember_token', request()->bearerToken());
        })->first();

        $userDetails = $user->details->first();

        return response()->json([
            'employee_id' => $user->id,
            'username' => $user->username,
            'first_name' => $userDetails->first_name,
            'middle_name' => $userDetails->middle_name,
            'last_name' => $userDetails->last_name,
            'email' => $userDetails->email,
            'birthday' => $userDetails->birthday,
            'gender' => $userDetails->gender,
            'created_at' => $userDetails->created_at,
            'updated_at' => $userDetails->updated_at
        ]);
    }
    
    public function time_in(Request $request){
        $user = Employee::whereHas('token', function($q){
            $q->where('remember_token', request()->bearerToken());
        })->first();

        $validate = Validator::make($request->all(), [
            'date' => 'required|date',
            'time' => 'required|date_format:H:i:s',
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

        $attendance = Attendance::where(['employee_id'=>$user->id, 'date' => $request->date])->first();
        $attendance = $attendance != null ? $attendance->time_in : null;

        if($attendance){
            return response()->json([
                'status' => 'failed',
                'message' => 'You already created attendance for time in'
            ], 401);
        }

        Attendance::create([
            'employee_id' => $user->id,
            'date' => $request->date,
            'time_in' => $request->time
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function time_out(Request $request){
        $user = Employee::whereHas('token', function($q){
            $q->where('remember_token', request()->bearerToken());
        })->first();

        $validate = Validator::make($request->all(), [
            'date' => 'required|date',
            'time' => 'required|date_format:H:i:s',
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

        $attendance = Attendance::where(['employee_id'=>$user->id, 'date' => $request->date])->first();
        $attendance = $attendance != null ? $attendance->time_out : null;

        if($attendance){
            return response()->json([
                'status' => 'failed',
                'message' => 'You already created attendance for time out'
            ], 401);
        }

        Attendance::updateOrCreate(
            ['employee_id' => $user->id, 'date' => $request->date],
            ['time_out' => $request->time]
        );

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function attendance(){
        $user = Employee::whereHas('token', function($q){
            $q->where('remember_token', request()->bearerToken());
        })->first();

        $date_now = date('Y-m-d', strtotime(now()));
        $day_now = date('D', strtotime(now()));
        $attendance = Attendance::where(['employee_id'=> $user->id, 'date' => $date_now])->first();
        $schedule = Schedule::where('employee_id',$user->id)->get()->pluck('day')->map(function($day){
            return substr($day, 0, 3);
        })->toArray();

        if($day_now == 'Sat' || $day_now == 'Sun'){
            return response()->json([
                'status' => 'invalid',
                'message' => 'No work on weekends'
            ]);
        }

        if(!in_array($day_now, $schedule)){
            return response()->json([
                'status' => 'invalid',
                'message' => 'No work it is your restday'
            ]);
        }

        return response()->json([
            'id' => $attendance->id,
            'date' => $attendance->date,
            'time_in' => $attendance->time_in != null ? $attendance->time_in : 'Not yet',
            'time_out' => $attendance->time_out != null ? $attendance->time_out : 'Not yet',
            'created_at' => $attendance->created_at,
            'updated_at' => $attendance->updated_at,
        ]);
    }

    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;

        $user = Employee::where('username', $username)->first();

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

        $user->setToken($token);

        return response()->json([
            'status' => 'success',
            'token' => $token
        ], 201);
    }

    public function logout(){
        $user = Employee::whereHas('token', function($q){
            $q->where('remember_token', request()->bearerToken());
        })->first();

        $user->setToken(null);

        return response()->json([
            'status' => 'success'
        ]);
    }

}
