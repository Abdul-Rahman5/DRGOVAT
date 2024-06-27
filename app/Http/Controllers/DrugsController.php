<?php

namespace App\Http\Controllers;

use App\Http\Resources\DrugsResource;
use App\Models\Drugs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DrugsController extends Controller
{

    public function index()
    {
        $drugs = Drugs::all();
        return DrugsResource::collection($drugs);
    }


    public function store(Request $request)
    {
        //validator
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "desc" => "required",
            "image" => "required|image|mimes:png,jpg,jpeg"
        ]);
        //check
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ], 301);
        }
        //image
        $imageName = Storage::putFile("Drugs", $request->image);
        //create
        Drugs::create([
            "name" => $request->name,
            "desc" => $request->desc,
            "image" => $imageName,
        ]);

        //msg
        return response()->json([
            "success" => "data added successflly",
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $drugs = Drugs::find($id);
        if ($drugs == null) {
            return response()->json([
                "msg" => "Drugs not found"
            ], 404);
        }
        return new DrugsResource($drugs);
    }


    public function update(Request $request, $id)
    {
        //validator
        $validator = Validator::make($request->all(), [
            "name" => "string|max:255",
            "desc" => "string",
            "image" => "image|mimes:png,jpg,jpeg"
        ]);
        //check
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ], 301);
        }
        //find
        $drugs=Drugs::find($id);
        if ($drugs == null) {
            return response()->json([
                "msg"=>"Drugs not found"
            ],404);
        }
        //storage
        $imageName=$drugs->image;
        if ($request->has("image")) {
            Storage::delete($imageName);
            $imageName= Storage::putFile("Drugs",$request->image);
        }
        //update
         $drugs->update([
            "name" => $request->name,
            "desc" => $request->desc,
            "image" => $imageName,
        ]);
        //msg
        return response()->json([
            "success" => "data updated successflly",
        ], 201);
    }

    public function delete($id)
    {
        //find drug
        $drug = Drugs::find($id);
        if ($drug == null) {
            return response()->json([
                "error" => "Drug not found"
            ], 301);
        }
        //storage
        if ($drug->image !== null) {
            # code...
            Storage::delete($drug->image);
        }
        //delete
        $drug->delete();
        //msg
        return response()->json([
            "success" => "Drug deleted successfuly"
        ], 301);
    }
}
