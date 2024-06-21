<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Validator;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificate = Certificate::latest()->get();
        
        if (is_null($certificate->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No certificate details found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Education details are retrieved successfully.',
            'data' => $certificate,
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
            'certtitle' => 'required|string|',
            'institution' => 'required|string|max:250',
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);    
        }

        $certificate = Certificate::create($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Certificate details is added successfully.',
            'data' => $certificate,
        ];

        return response()->json($response, 200);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $certificate = Certificate::find($id);
  
        if (is_null($certificate)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Certificate detail is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Certificate detail is retrieved successfully.',
            'data' => $certificate,
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
            'certtitle' => 'required',
            'institution' => 'required',
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $certificate = Certificate::find($id);

        if (is_null($certificate)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Certificate detail is not found!',
            ], 200);
        }

        $certificate->update($request->all());
        
        $response = [
            'status' => 'success',
            'message' => 'Certificate is updated successfully.',
            'data' => $certificate,
        ];

        return response()->json($response, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $certificate = Certificate::find($id);
  
        if (is_null($certificate)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Certificate detail is not found!',
            ], 200);
        }

        Education::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Certificate detail is deleted successfully.'
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
        $certificate = Certificate::where('email', '=', $email)
            ->latest()->get();

        if (is_null($certificate->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No certificate details found found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Certificate details are retrieved successfully.',
            'data' => $certificate,
        ];

        return response()->json($response, 200);
    }
}
