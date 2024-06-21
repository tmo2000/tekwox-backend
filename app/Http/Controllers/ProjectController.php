<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Validator;

class ProjectController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->get();
        
        if (is_null($projects->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No projects found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Projects are retrieved successfully.',
            'data' => $projects,
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'projectreferencenumber'  => 'required|string|max:250',  
            'projecttitle'  => 'required',
            'projectdetails' => 'required',
            'location' => 'required',
            'opentolocalbusinesses' => 'required',
            'openinternationally'=> 'required',       
            'preferredbiddingcurrency1' => 'required',
            'makecurrencymandatory' => 'required',
            'preferredbiddingcurrency2' => 'required',
            'limitbidamount' => 'required',
            'bidamount' => 'required',
            'startdate' => 'required',
            'starttime' => 'required',
            'enddate' => 'required',
            'endtime' => 'required'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);    
        }

        $projects = Project::create($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Projects are added successfully.',
            'data' => $projects,
        ];

        return response()->json($response, 200);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = JProject::find($id);
  
        if (is_null($job)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Project is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Projects are retrieved successfully.',
            'data' => $project,
        ];
        
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'projectreferencenumber',  
            'projecttitle',
            'projectdetails',
            'location',
            'opentolocalbusinesses',
            'openinternationally',       
            'preferredbiddingcurrency1',
            'makecurrencymandatory',
            'preferredbiddingcurrency2',
            'limitbidamount',
            'bidamount',
            'startdate',
            'starttime',
            'enddate',
            'endtime'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $project = Project::find($id);

        if (is_null($project)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Project is not found!',
            ], 200);
        }

        $project->update($request->all());
        
        $response = [
            'status' => 'success',
            'message' => 'Project is updated successfully.',
            'data' => $job,
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::find($id);
  
        if (is_null($project)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Project is not found!',
            ], 200);
        }

        Project::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Project is deleted successfully.'
            ], 200);
    }

    /**
     * Search by a product name
     *
     * @param  str  $jobid
     * @return \Illuminate\Http\Response
     */
    public function search($projectreferencenumber)
    {
        $project = Project::where('projectreferencenumber', '=', $projectreferencenumber)
            ->latest()->get();

        if (is_null($project->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No projects found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Projects are retrieved successfully.',
            'data' => $project,
        ];

        return response()->json($response, 200);
    }
}
