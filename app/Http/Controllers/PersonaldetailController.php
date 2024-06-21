<?php

namespace App\Http\Controllers;

use App\Models\Personaldetail;
use Illuminate\Http\Request;
use Validator;

class PersonaldetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personaldetails = Personaldetail::latest()->get();
        
        if (is_null($personaldetails->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No Personal details found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Personal details are retrieved successfully.',
            'data' => $personaldetails,
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
            'bio' => 'required|string|',
            'nationality' => 'required|string|max:250',
            'country' => 'required|string|max:250',
            'cvpath' => 'string',
            'businessname' => 'string|max:250',
            'website' => 'string|max:250',
            'industry' => 'string|max:250',
            'no_of_employee' => 'string|max:250'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);    
        }

        $personaldetail = Personaldetail::create($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Personal details is added successfully.',
            'data' => $personaldetail,
        ];

        return response()->json($response, 200);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $personaldetail = Personaldetail::find($id);
  
        if (is_null($personaldetail)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Personal detail is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Personal detail is retrieved successfully.',
            'data' => $personaldetail,
        ];
        
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'email'=> 'required',
            'bio',
            'nationality',
            'country',
            'cvpath',
            'businessname',
            'website',
            'industry',
            'no_of_employee'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $personaldetail = Personaldetail::find($id);

        if (is_null($product)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Personal detail is not found!',
            ], 200);
        }

        $personaldetail->update($request->all());
        
        $response = [
            'status' => 'success',
            'message' => 'Product is updated successfully.',
            'data' => $personaldetail,
        ];

        return response()->json($response, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $personaldetail = Personaldetail::find($id);
  
        if (is_null($personaldetail)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Personal detail is not found!',
            ], 200);
        }

        Personaldetail::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Personal detail is deleted successfully.'
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
        $personaldetails = Personaldetail::where('email', '=', $email)
            ->latest()->get();

        if (is_null($personaldetails->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No personal details found found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Personal details are retrieved successfully.',
            'data' => $personaldetails,
        ];

        return response()->json($response, 200);
    }
}
