<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Validator;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $education = Education::latest()->get();
        
        if (is_null($education->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No education details found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Education details are retrieved successfully.',
            'data' => $education,
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
            'school' => 'required|string|',
            'degree' => 'required|string|max:250',
            'fos' => 'required|string|max:250',
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

        $education = Education::create($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Education details is added successfully.',
            'data' => $education,
        ];

        return response()->json($response, 200);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $education = Education::find($id);
  
        if (is_null($education)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Education detail is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Education detail is retrieved successfully.',
            'data' => $education,
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
            'school' => 'required',
            'degree' => 'required',
            'fos' => 'required',
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

        $education = Education::find($id);

        if (is_null($education)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Education detail is not found!',
            ], 200);
        }

        $education->update($request->all());
        
        $response = [
            'status' => 'success',
            'message' => 'Education is updated successfully.',
            'data' => $education,
        ];

        return response()->json($response, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $education = Education::find($id);
  
        if (is_null($education)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Education detail is not found!',
            ], 200);
        }

        Education::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Education detail is deleted successfully.'
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
        $education = Education::where('email', '=', $email)
            ->latest()->get();

        if (is_null($education->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No education details found found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Education details are retrieved successfully.',
            'data' => $education,
        ];

        return response()->json($response, 200);
    }
}
