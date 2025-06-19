<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckApiQuota;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsageController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\AdminController;

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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/data', fn() => response()->json(['message' => 'Success']))->middleware(CheckApiQuota::class);
    Route::get('/key', fn(Request $req) => $req->user()->currentAccessToken());
    Route::get('/usage', [UsageController::class, 'index']);
    Route::get('/billing', [BillingController::class, 'index']);
    Route::post('/admin/set-tier', [AdminController::class, 'setTier']);
});