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

    public function gettask_list(){
        $datas = DB::connection('dynamic')
        ->table('tm_tasks')
        ->select('tm_tasks.task_name','tm_tasks.id','tm_tasks.task_assigned_to','tm_tasks.task_deadline')
        ->get();
        foreach($datas  as  $val) {
            $arr = explode("-",$val->task_assigned_to);
            $new_arr = [];
            foreach($arr as $ida){
                $data = DB::connection('dynamic')
                ->table('tm_employee')
                ->select('tm_employee.emp_photo as emp_photo')
                ->where('id','=',$ida)
                ->first();
                $domainName = $_SERVER['HTTP_HOST'];
                if ($data){
                    $new_arr[$ida] = $domainName."/".$data->emp_photo;
                } else {
                    $new_arr[$ida] = null;

                }
            }
            $val->photo = $new_arr;
        }
        if ($datas){
            
            return response()->json([
                'success' => true,
                'message' => $datas,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to employee',
            ], 404);
        }
    }
}

?>
