<?php

namespace App\Http\Controllers;

use App\Models\Bidproject;
use Illuminate\Http\Request;
use Validator;

class BidprojectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bidprojects = Bidproject::latest()->get();
        
        if (is_null($bidprojects->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No bidded project found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Bidded projects are retrieved successfully.',
            'data' => $bidprojects,
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'bidid' => 'required|string|max:250',
            'biddocument' => 'required|string|',
            'currency' => 'required|string|max:250',
            'amount' => 'required',
            'supportingdocument' => 'string'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);    
        }

        $bidproject = Bidproject::create($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Bidded projectis added successfully.',
            'data' => $bidproject,
        ];

        return response()->json($response, 200);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bidproject = Bidproject::find($id);
  
        if (is_null($bidproject)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Project is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Bidded project is retrieved successfully.',
            'data' => $bidproject,
        ];
        
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'bidid' => 'required',
            'biddocument',
            'currency',
            'amount',
            'supportingdocument'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $bidproject = Bidproject::find($id);

        if (is_null($product)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Bidded project is not found!',
            ], 200);
        }

        $bidproject->update($request->all());
        
        $response = [
            'status' => 'success',
            'message' => 'Project is updated successfully.',
            'data' => $bidproject,
        ];

        return response()->json($response, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bidproject =Bidproject::find($id);
  
        if (is_null($bidproject)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Bidded project is not found!',
            ], 200);
        }

        Personaldetail::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Bidded project is deleted successfully.'
            ], 200);
    }

    /**
     * Search by a product name
     *
     * @param  str  $bidid
     * @return \Illuminate\Http\Response
     */
    public function search($bidid)
    {
        $bidprojects = Personaldetail::where('bidid', '=', $bidid)
            ->latest()->get();

        if (is_null($$bidprojects->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No bidded project found found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Bidded projects are retrieved successfully.',
            'data' => $bidprojects,
        ];

        return response()->json($response, 200);
    }
}
