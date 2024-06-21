<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use Illuminate\Http\Request;
use Validator;

class ScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $screenings = Screening::latest()->get();
        
        if (is_null($screenings->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No screening questions found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Screening questions are retrieved successfully.',
            'data' => $screenings,
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'jobid' => 'required',
            'questiontype' => 'required',
            'question'  => 'required',
            'idealanswer' => 'required',
            'compulsoryforshortlisting'  => 'required'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);    
        }

        $screenings = Screening::create($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Screening questions are added successfully.',
            'data' => $screenings,
        ];

        return response()->json($response, 200);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $screening = Screening::find($id);
  
        if (is_null($screening)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Screening question is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Screening questions are retrieved successfully.',
            'data' => $screening,
        ];
        
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'jobid',
            'questiontype',
            'question',
            'idealanswer',
            'compulsoryforshortlisting'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $screening= Screening::find($id);

        if (is_null($screening)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Screening question is not found!',
            ], 200);
        }

        $screening->update($request->all());
        
        $response = [
            'status' => 'success',
            'message' => 'Screening question is updated successfully.',
            'data' => $screening,
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $screening = Screening::find($id);
  
        if (is_null($screening)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Screening question is not found!',
            ], 200);
        }

        Project::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Screening question is deleted successfully.'
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
        $project = Project::where('jobid', '=', $jobid)
            ->latest()->get();

        if (is_null($screening->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No screening questions found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Screening questions are retrieved successfully.',
            'data' => $screening,
        ];

        return response()->json($response, 200);
    }
}
