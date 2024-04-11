<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    //
    public function jobs()
    {
        $jobs = Job::all();

        return response()->json([
            'jobs' => $jobs->map(function ($job) {
                return [
                    'id' => $job->id,
                    'job_name' => $job->job_name,
                    'description' => $job->description,
                    'slots' => $job->slots
                ];
            }),
            'counts' => $jobs->count()
        ], 200);
    }

    public function job(Request $request)
    {
        $job = Job::where('id', $request->id)->first();

        if(!$job){
            return response()->json([
                'status' => 'invalid',
                'message' => 'Job not found',
            ], 400);
        }

        return response()->json([
            'id' => $job->id,
            'job_name' => $job->job_name,
            'description' => $job->description,
            'slots' => $job->slots
        ], 200);
    }
}
