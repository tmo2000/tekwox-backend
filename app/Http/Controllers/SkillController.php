<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Validator;

class SkillController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skill = Skill::latest()->get();
        
        if (is_null($skill->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No skill details found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'skill details are retrieved successfully.',
            'data' => $skill,
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
            'skill' => 'required|string|',
            'level' => 'required|string|max:250',
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);    
        }

        $skill = Skill::create($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Skill details is added successfully.',
            'data' => $skill,
        ];

        return response()->json($response, 200);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $skill = Skill::find($id);
  
        if (is_null($skill)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Skill detail is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Skill detail is retrieved successfully.',
            'data' => $skill,
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
            'skill' => 'required',
            'level' => 'required',
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $skill = Skill::find($id);

        if (is_null($skill)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Skill detail is not found!',
            ], 200);
        }

        $skill->update($request->all());
        
        $response = [
            'status' => 'success',
            'message' => 'Skill is updated successfully.',
            'data' => $skill,
        ];

        return response()->json($response, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $skill = Skill::find($id);
  
        if (is_null($skill)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Skill detail is not found!',
            ], 200);
        }

        Skill::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Skill detail is deleted successfully.'
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
        $skill = Skill::where('email', '=', $email)
            ->latest()->get();

        if (is_null($skill->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No skill details found found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Skill details are retrieved successfully.',
            'data' => $skill,
        ];

        return response()->json($response, 200);
    }
}
