<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //register
    function register(Request $request)
    {
        //validator]
        $validator = Validator::make($request->all(), [
            "fullName" => "required|string|max:255 ",
            "email" => "required|email|unique:users,email",
            "phone" => "required|max:255",
            "password" => "required|min:6|confirmed"
        ]);
        //check
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ], 301);
        }
        //password hash
        $password = bcrypt($request->password);
        $access_token = Str::random(64);
        //create
        User::create([
            "fullName" => $request->fullName,
            "email" => $request->email,
            "phone" => $request->phone,
            "password" => $password,
            "access_token" => $access_token
        ]);
        //msg
        return response()->json([
            "success" => "you registerd successflly",
            "access_token" => $access_token
        ], 201);
    }
    //login
    function login(Request $request)
    {
        //vaildation
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|min:6",
        ]);
        //check
        if ($validator->fails()) {

            return response()->json([
                "errors" => $validator->errors()
            ], 301);
        }
        //chech (email,password)
        $user = User::where("email", "=", $request->email)->first();
        if ($user !== null) {
            # password
            $oldPassword = $user->password; //hashed
            $access_token = Str::random(64);
            $isVerified =  Hash::check($request->password, $oldPassword);
            if ($isVerified) {
                # update...
                $user->update([
                    "access_token" => $access_token
                ]);
                return response()->json([
                    "message" => "you logged in successfuly",
                    "id" => $user->id,
                    "fullName" => $user->fullName,
                    "email" => $user->email,
                    "phone" => $user->phone,
                    "access_token" => $access_token,

                ], 200);
            } else {
                # erorr...
                return response()->json([
                    "message" => "credintials not correct"
                ], 404);
            }
        } else {
            return response()->json([
                "message" => "This account not exist"
            ], 404);
        }
    }
    function show($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return response()->json([
                "msg" => "user not found"
            ], 404);
        }
        return new UserResource($user);
    }
    function update(Request $request, $id)
    {
        //validator
        $validator = Validator::make($request->all(), [
            "fullName" => "required|string|max:255 ",
            "email" => "required|email|unique:users,email",
            "phone" => "required|max:255",
        ]);
        //check
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ], 301);
        }
        //find
        $user = User::find($id);
        if ($user == null) {
            return response()->json([
                "msg" => "user not found"
            ], 404);
        }
        //update
        $user->update([
            "fullName" => $request->fullName,
            "email" => $request->email,
            "phone" => $request->phone,

        ]);
        //msg
        //msg
        return response()->json([
            "success" => "data updated successflly",
        ], 201);
    }
}
