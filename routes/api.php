<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\SyncController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/videos', [VideoController::class, 'upload']);
Route::post('/sync', [SyncController::class, 'store']);
Route::get('/sync/{sessionId}', [SyncController::class, 'show']);
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});
Route::get('/videos', [VideoController::class, 'index']);

