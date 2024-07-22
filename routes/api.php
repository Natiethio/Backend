<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\ViolationsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/upload', [ViolationsController::class, 'test']);
Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/mytestapi',[ViolationsController::class,'fetchData']);
    // Route::post('/upload', [ViolationsController::class, 'upload']);
    Route::get('/getUserData', [UserController::class, 'getUserData']);
    Route::get('/GetProduct/{id}',[ViolationsController::class,"GetViolation"]);
    Route::get('/GetFlagged/{id}',[ViolationsController::class,"GetFlagged"]);
    Route::get('/FindLocation',[ViolationsController::class,"FindLocation"]);
    Route::get('/Flagged',[ViolationsController::class,"Flagged"]);
    Route::post('/AddFlagged',[ViolationsController::class,"AddViolation"]);
    Route::post('/AddTraffic',[ViolationsController::class,"AddTraffic"]);
    Route::post('/UpdateProduct/{id}',[ViolationsController::class,"UpdateViolation"]);
    Route::post('/UpdateFlagged/{id}',[ViolationsController::class,"UpdateFlagged"]);
    Route::post('/SendSms/{id}',[SmsController::class,"SendSms"]);
    Route::post('/SendSmsFlagged/{id}',[SmsController::class,"SendSmsFlagged"]);
    Route::get('/Search/{id}',[ViolationsController::class,"Search"]);
    Route::get('/SearchFlagged/{id}',[ViolationsController::class,"SearchFlagged"]);
    Route::post('/Logout',[UserController::class,"Logout"]);
    Route::delete('/Delete/{id}',[ViolationsController::class,"Delete"]);
    Route::delete('/DeleteFlagged/{id}',[ViolationsController::class,"DeleteFlagged"]);
});
// Route::get('/SearchFlagged/{id}',[ViolationsController::class,"SearchFlagged"]);
Route::post('/Login',[UserController::class,"Login"]);
Route::post('/Register',[UserController::class,"Register"]);
// Route::post('/Search/{id}',[ProductController::class,"Search"]);
// Route::post('/AddProduct',[ProductController::class,"AddProduct"]);
Route::get('/Productlist',[ViolationsController::class,"Violationlist"]);
// Route::get('/GetProduct/{id}',[ProductController::class,"GetProduct"]);
// Route::post('/UpdateProduct/{id}',[ProductController::class,"UpdateProduct"]);
// Route::delete('/Delete/{id}',[ProductController::class,"Delete"]);

