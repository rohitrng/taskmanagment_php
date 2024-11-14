<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Support\Facades\Validator;

class TaskapiController extends Controller{

    public function taskform(request $request){
        $datas = [
            'task_name' => $request->task_name,
            'task_description' => $request->task_description,
            'task_assigned_to' => $request->task_assigned_to,
            'task_priority' => $request->task_priority,
            'task_deadline' => $request->task_deadline,
            'task_estimated_hours' => $request->task_estimated_hours,
            'task_type' => $request->task_type,
            'task_user_id' => $request->task_user_id,
        ];
        $insert = DB::connection('dynamic')->table('tm_tasks')->insert($datas);
        if ($insert){
            return response()->json([
                'success' => true,
                'message' => 'Add task successful',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add employee',
            ], 404);
        }
    }
}

?>
