<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Support\Facades\Validator;

class ProjectapiController extends Controller{
    public function projectform(request $request){
        $datas = [
            'project_name' => $request->task_name,
            'project_description' => $request->task_description,
            'project_deadline' => $request->project_deadline,
            'project_assigned_team' => $request->project_assigned_team,
            'project_user_id' => $request->project_user_id,
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