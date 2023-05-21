<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NoteController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/notes', [NoteController::class, 'getAllNotes'])->middleware('auth:sanctum');
Route::get('/notes/{id}', [NoteController::class, 'getNotesById'])->middleware('auth:sanctum');
Route::post('/notes', [NoteController::class, 'createNote'])->middleware('auth:sanctum');
Route::put('/notes/{id}', [NoteController::class, 'updateNote'])->middleware('auth:sanctum');
Route::delete('/notes/{id}', [NoteController::class, 'deleteNote'])->middleware('auth:sanctum');

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::middleware('auth:sanctum')->get('/auth/user', [AuthController::class, 'getUser']);
Route::middleware('auth:sanctum')->post('/auth/logout', [AuthController::class, 'logoutUser']);