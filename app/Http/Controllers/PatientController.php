<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPatient = Patient::all();
        return PatientResource::collection($allPatient);
    }


    public function store(Request $request)
    {
        //validator
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'age' => 'nullable|integer|min:0|max:150',
            'height' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'heart_state' => 'required|in:stable,unstable',
            'hypertension' => 'required|boolean',
            'diabetes' => 'required|boolean',
            'full_half' => 'required|in:full,half',
            'period_of_operation' => 'required|integer|min:0', // assuming period is in minutes
            'operations' => 'nullable|string|max:255', // adjust max length as needed

        ]);
        //check
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()

            ], 301);
        }
        //create
        $patient = Patient::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'age' => $request->age,
            'height' => $request->height,
            'weight' => $request->weight,
            'heart_state' => $request->heart_state,
            'hypertension' => $request->hypertension,
            'diabetes' => $request->diabetes,
            'full_half' => $request->full_half,
            'period_of_operation' => $request->period_of_operation,
            'operations' => $request->operations,
        ]);
        //msg
        return response()->json([
            "success" => "data added successflly",
        ], 201);
    }


    public function show(Patient $patient)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //validator
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'age' => 'nullable|integer|min:0|max:150',
            'height' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'heart_state' => 'required|in:stable,unstable',
            'hypertension' => 'required|boolean',
            'diabetes' => 'required|boolean',
            'full_half' => 'required|in:full,half',
            'operations' => 'nullable|string|max:255', // adjust max length as needed

        ]);
        //check
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ], 301);
        }
         //find
         $patient=Patient::find($id);
         if ($patient == null) {
             return response()->json([
                 "msg"=>"patient not found"
             ],301);
         }
          //update
          $patient->update([
            "name" => $request->name,
            "gender" => $request->gender,
            "age" => $request->age,
            "height" => $request->height,
            "weight" => $request->weight,
            "heart_state" => $request->heart_state,
            "hypertension" => $request->hypertension,
            "diabetes" => $request->diabetes,
            "full_half" => $request->full_half,
            "operations" => $request->full_half,
        ]);
        //msg
        return response()->json([
            "success" => "data updated successflly",
        ], 201);
    }
}
