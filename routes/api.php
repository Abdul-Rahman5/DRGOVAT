<?php

use App\Http\Controllers\DrugsController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::controller(UserController::class)->group(function ()  {

Route::post("register","register");
Route::post("login","login");
Route::get("showProfile/{id}","show");
Route::put("profile/{id}","update");

});
Route::controller(DrugsController::class)->group(function ()  {
    Route::get("allDrugs","index");
    Route::get("showDrugs/{id}","show");
    Route::post("addDurag","store");
    Route::delete("DeleteDurag/{id}","delete");
    Route::put("UpdateDurag/{id}","update");


});
Route::controller(PatientController::class)->group(function ()  {
Route::post("addPatient","store")->name("infoPatient");
Route::get("allPatient","index")->name("allPatient");
Route::put("UpdatePatient/{id}","update")->name("UpdatePatient");
});

