<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginapiController;
use App\Http\Controllers\Api\EmployeeapiController;
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
// Route::post('register', [LoginapiController::class, 'register']);
Route::post('login', [LoginapiController::class, 'login']);
Route::post('employeeform', [EmployeeapiController::class, 'employeeform']);
Route::get('getemp_id', [EmployeeapiController::class, 'getemp_id']);
