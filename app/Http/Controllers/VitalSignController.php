<?php

namespace App\Http\Controllers;

use App\Http\Resources\VitalSingsResource;
use App\Models\VitalSign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VitalSignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vitalSings=VitalSign::all();
        return VitalSingsResource::collection($vitalSings);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validation rules
         $validator = Validator::make($request->all(), [
            'heart_rate' => 'required|string|min:0',
            'blood_pressure' => 'required|string',
            'respiratory_rate' => 'required|string',
            'oxygen_saturation' => 'required|integer|between:0,100',
            'end_tidal_carbon' => 'required|integer|min:0',
            'temperature' => 'required|numeric|min:0',
            'electrocardiogram' => 'required|integer|min:0',
        ]);
          // Check for validation errors
          if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        //create
         // Create the record
         $VitalSign = VitalSign::create([
            'heart_rate' => $request->heart_rate,
            'blood_pressure' => $request->blood_pressure, // Assuming format is "min - max"
            'respiratory_rate' =>$request-> respiratory_rate, // Assuming format is "min - max"
            'oxygen_saturation' => $request->oxygen_saturation,
            'end_tidal_carbon' => $request->end_tidal_carbon,
            'temperature' => $request->temperature,
            'electrocardiogram' => $request->electrocardiogram,
        ]);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Vital Signs  added successfully!',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(VitalSign $vitalSign)
    {
        //
    }
    public function update(Request $request,  $id)
    {
         // Validation rules
         $validator = Validator::make($request->all(), [
            'heart_rate' => 'required|string|min:0',
            'blood_pressure' => 'required|string',
            'respiratory_rate' => 'required|string',
            'oxygen_saturation' => 'required|integer|between:0,100',
            'end_tidal_carbon' => 'required|integer|min:0',
            'temperature' => 'required|numeric|min:0',
            'electrocardiogram' => 'required|integer|min:0',
        ]);
         // Check for validation errors
         if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

          // Find the Vital Sign  record
          $VitalSign = VitalSign::find($id);

         // If record not found
         if (!$VitalSign) {
            return response()->json([
                'success' => false,
                'message' => 'Vital Signs  not found.'
            ], 404);
        }

        $VitalSign->update([
            'heart_rate' => $request->heart_rate,
            'blood_pressure' => $request->blood_pressure,
            'respiratory_rate' =>$request-> respiratory_rate,
            'oxygen_saturation' => $request->oxygen_saturation,
            'end_tidal_carbon' => $request->end_tidal_carbon,
            'temperature' => $request->temperature,
            'electrocardiogram' => $request->electrocardiogram,
        ]);


         // Return success response
         return response()->json([
            'success' => true,
            'message' => 'Vital Signs updated successfully!',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VitalSign $vitalSign)
    {
        //
    }
}
