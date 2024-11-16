<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginapiController;
use App\Http\Controllers\Api\EmployeeapiController;
use App\Http\Controllers\Api\TaskapiController;
use App\Http\Controllers\Api\ProjectapiController;

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
// EmployeeapiController
Route::post('employeeform', [EmployeeapiController::class, 'employeeform']);
Route::get('getemp_id', [EmployeeapiController::class, 'getemp_id']);
Route::get('getemp_list', [EmployeeapiController::class, 'getemp_list']);
Route::get('getemp_list_full', [EmployeeapiController::class, 'getemp_list_full']);
Route::get('deleteemp/{id}', [EmployeeapiController::class, 'deleteemp']);
Route::get('get_emp_single/{id}', [EmployeeapiController::class, 'get_emp_single']);
// Route::post('update_employee', [EmployeeapiController::class, 'update_employee']);
Route::put('update_employee', [EmployeeapiController::class, 'update_employee']);

// TaskapiController
Route::post('taskform',[TaskapiController::class, 'taskform']);
Route::get('gettask_list', [TaskapiController::class, 'gettask_list']);
Route::get('task_delete', [TaskapiController::class, 'task_delete']);

// ProjectapiController
Route::post('projectform', [ProjectapiController::class, 'projectform']);
Route::get('project_list/{id}', [ProjectapiController::class, 'project_list']);
Route::get('project_delete/{id}', [ProjectapiController::class, 'project_delete']);
