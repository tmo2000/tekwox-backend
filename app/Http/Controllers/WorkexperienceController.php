<?php

namespace App\Http\Controllers;

use App\Models\Workexperience;
use Illuminate\Http\Request;
use Validator;

class WorkexperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workexperiences = Workexperience::latest()->get();
        
        if (is_null($workexperiences->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No work experience details found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Work experiece details are retrieved successfully.',
            'data' => $workexperiences,
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|max:250',
            'companyname' => 'required|string|',
            'jobtitle' => 'required|string|max:250',
            'jobdescription' => 'required|string|max:250',
            'activework' => 'string',
            'startdate' => 'string|max:250',
            'enddate' => 'string|max:250'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);    
        }

        $workexperience = Workexperience::create($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Work experience details is added successfully.',
            'data' => $workexperience,
        ];

        return response()->json($response, 200);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $workexperience = Workexperience::find($id);
  
        if (is_null($workexperience)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Work experience detail is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Personal detail is retrieved successfully.',
            'data' => $workexperience,
        ];
        
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            'companyname' => 'required',
            'jobtitle' => 'required',
            'jobdescription' => 'required',
            'activework' => 'required',
            'startdate' => 'required',
            'enddate'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $workexperience = Workexperience::find($id);

        if (is_null($workexperience)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Work experience detail is not found!',
            ], 200);
        }

        $workexperience->update($request->all());
        
        $response = [
            'status' => 'success',
            'message' => 'Workexperience is updated successfully.',
            'data' => $workexperience,
        ];

        return response()->json($response, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $workexperience = Workexperience::find($id);
  
        if (is_null($workexperience)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Workexperience detail is not found!',
            ], 200);
        }

        Workexperience::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Work experience detail is deleted successfully.'
            ], 200);
    }

    /**
     * Search by a product name
     *
     * @param  str  $email
     * @return \Illuminate\Http\Response
     */
    public function search($email)
    {
        $workexperience = Workexperience::where('email', '=', $email)
            ->latest()->get();

        if (is_null($workexperience->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No work experience details found found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Work experience details are retrieved successfully.',
            'data' => $workexperience,
        ];

        return response()->json($response, 200);
    }
}
