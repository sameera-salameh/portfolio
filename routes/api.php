<?php

use App\Http\Controllers\AboutMeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\HtmlTagController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum','portfolio.owner'])->group(function () {
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('aboutme' , [AboutMeController::class , 'index']);
Route::post('aboutme' , [AboutMeController::class , 'store']);
Route::post('aboutme/{aboutMe}' , [AboutMeController::class , 'update']);
Route::get('aboutme/{aboutMe}' , [AboutMeController::class , 'show']);
Route::delete('aboutme/{aboutMe}' , [AboutMeController::class , 'destroy']);
Route::get('contacts' , [ContactController::class , 'index']);
Route::post('contacts' , [ContactController::class , 'store']);
Route::post('contacts/{contact}' , [ContactController::class , 'update']);
Route::get('contacts/{contact}' , [ContactController::class , 'show']);
Route::delete('contacts/{contact}' , [ContactController::class , 'destroy']);
Route::get('educations' , [EducationController::class , 'index']);
Route::post('educations' , [EducationController::class , 'store']);
Route::post('educations/{education}' , [EducationController::class , 'update']);
Route::get('educations/{education}' , [EducationController::class , 'show']);
Route::delete('educations/{education}' , [EducationController::class , 'destroy']);
Route::get('projects' , [ProjectController::class , 'index']);
Route::post('projects' , [ProjectController::class , 'store']);
Route::post('projects/{project}' , [ProjectController::class , 'update']);
Route::get('projects/{project}' , [ProjectController::class , 'show']);
Route::delete('projects/{project}' , [ProjectController::class , 'destroy']);
Route::get('services' , [ServiceController::class , 'index']);
Route::post('services' , [ServiceController::class , 'store']);
Route::post('services/{service}' , [ServiceController::class , 'update']);
Route::get('services/{service}' , [ServiceController::class , 'show']);
Route::delete('services/{service}' , [ServiceController::class , 'destroy']);
Route::get('skills' , [SkillController::class , 'index']);
Route::post('skills' , [SkillController::class , 'store']);
Route::post('skills/{skill}' , [SkillController::class , 'update']);
Route::get('skills/{skill}' , [SkillController::class , 'show']);
Route::delete('skills/{skill}' , [SkillController::class , 'destroy']);
Route::post('bold', [HtmlTagController::class, 'bold']);
Route::post('italic', [HtmlTagController::class, 'italic']);
Route::post('color', [HtmlTagController::class, 'color']);
});
Route::get('portfolio' , [PortfolioController::class , 'index']);
