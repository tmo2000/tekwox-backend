<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Validator;

class JobController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->get();
        
        if (is_null($jobs->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No jobs found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Jobs are retrieved successfully.',
            'data' => $jobs,
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'jobid' => 'required|string|max:250',
            'jobtitle' => 'required',
            'workplacetype' => 'required',
            'worktype' => 'required|string|max:250',
            'employmentlocation' => 'required',
            'jobdescription' => 'required',
            'requiredskills' => 'required',
            'additionalskills' => 'required'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);    
        }

        $job = Job::create($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Jobs are added successfully.',
            'data' => $job,
        ];

        return response()->json($response, 200);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $job = Job::find($id);
  
        if (is_null($job)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Job is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Jobs are retrieved successfully.',
            'data' => $job,
        ];
        
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'jobid'=> 'required',
            'jobtitle',
            'workplacetype',
            'worktype',
            'employmentlocation',
            'jobdescription',
            'requiredskills',
            'additionalskills'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $job = Job::find($id);

        if (is_null($product)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Job is not found!',
            ], 200);
        }

        $job->update($request->all());
        
        $response = [
            'status' => 'success',
            'message' => 'Product is updated successfully.',
            'data' => $job,
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $job = Job::find($id);
  
        if (is_null($job)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Job is not found!',
            ], 200);
        }

        Job::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Job is deleted successfully.'
            ], 200);
    }

    /**
     * Search by a product name
     *
     * @param  str  $jobid
     * @return \Illuminate\Http\Response
     */
    public function search($jobid)
    {
        $job = Job::where('jobid', '=', $jobid)
            ->latest()->get();

        if (is_null($job->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No jobs found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Jobs are retrieved successfully.',
            'data' => $job,
        ];

        return response()->json($response, 200);
    }
}
