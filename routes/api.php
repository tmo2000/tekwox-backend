<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\PersonaldetailController;
use App\Http\Controllers\WorkexperienceController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BidprojectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Public routes of authtication
Route::controller(LoginRegisterController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::controller(PersonaldetailController::class)->group(function() {
    Route::get('/personaldetails', 'index');
    Route::get('/personaldetails/{id}', 'show');
    Route::get('/personaldetails/search/{email}', 'search');

    Route::post('/personaldetails', 'store');
    Route::post('/personaldetails/{id}', 'update');
    Route::delete('/personaldetails/{id}', 'destroy');
});

Route::controller(WorkexperienceController::class)->group(function() {
    Route::get('/workexperience', 'index');
    Route::get('/workexperience/{id}', 'show');
    Route::get('/workexperience/search/{email}', 'search');

    Route::post('/workexperience', 'store');
    Route::post('/workexperience/{id}', 'update');
    Route::delete('/workexperience/{id}', 'destroy');
});

Route::controller(EducationController::class)->group(function() {
    Route::get('/education', 'index');
    Route::get('/education/{id}', 'show');
    Route::get('/education/search/{email}', 'search');

    Route::post('/education', 'store');
    Route::post('/education/{id}', 'update');
    Route::delete('/education/{id}', 'destroy');
});

Route::controller(CertificateController::class)->group(function() {
    Route::get('/certificate', 'index');
    Route::get('/certificate/{id}', 'show');
    Route::get('/certificate/search/{email}', 'search');

    Route::post('/certificate', 'store');
    Route::post('/certificate/{id}', 'update');
    Route::delete('/certificate/{id}', 'destroy');
});

Route::controller(SkillController::class)->group(function() {
    Route::get('/skill', 'index');
    Route::get('/skill/{id}', 'show');
    Route::get('/skill/search/{email}', 'search');

    Route::post('/skill', 'store');
    Route::post('/skill/{id}', 'update');
    Route::delete('/skill/{id}', 'destroy');
});

Route::controller(JobController::class)->group(function() {
    Route::get('/job', 'index');
    Route::get('/job/{id}', 'show');
    Route::get('/job/search/{jobid}', 'search');

    Route::post('/job', 'store');
    Route::post('/job/{id}', 'update');
    Route::delete('/job/{id}', 'destroy');
});

Route::controller(ProjectController::class)->group(function() {
    Route::get('/project', 'index');
    Route::get('/project/{id}', 'show');
    Route::get('/project/search/{projectreferencenumber}', 'search');

    Route::post('/project', 'store');
    Route::post('/project/{id}', 'update');
    Route::delete('/project/{id}', 'destroy');
});

Route::controller(BidprojectController::class)->group(function() {
    Route::get('/bidproject', 'index');
    Route::get('/bidproject/{id}', 'show');
    Route::get('/bidproject/search/{bidid}', 'search');

    Route::post('/bidproject', 'store');
    Route::post('/bidproject/{id}', 'update');
    Route::delete('/bidproject/{id}', 'destroy');
});

// Public routes of product
//Route::controller(PersonaldetailController::class)->group(function() {
    //Route::get('/personaldetails', 'index');
    //Route::get('/personaldetails/{id}', 'show');
    //Route::get('/personaldetails/search/{email}', 'search');
//});

// Protected routes of product and logout
Route::middleware('auth:api')->group( function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout']);


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //return $request->user();
});
