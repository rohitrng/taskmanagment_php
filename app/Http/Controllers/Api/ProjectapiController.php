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
            'project_name' => $request->project_name,
            'project_description' => $request->project_description,
            'project_deadline' => $request->project_deadline,
            'project_assigned_team' => $request->project_assigned_team,
            'project_user_id' => $request->project_user_id,
        ];
        $insert = DB::connection('dynamic')->table('tm_project')->insert($datas);
        if ($insert){
            return response()->json([
                'success' => true,
                'message' => 'Add Project successful',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add Project',
            ], 404);
        }
    }

    public function project_list($id){
        $datas = DB::connection('dynamic')
            ->table('tm_project');
        if ($id != 0) {
            $datas->where('project_user_id', '=', $id);
        }
        $datas->where('is_delete', '=', 0);
        $datas = $datas
            ->select('id', 'project_name', 'project_description', 'project_deadline', 'project_assigned_team', 'project_user_id')
            ->get();
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

    public function project_delete($id){
        DB::table('tm_project')
        ->where('id', $id)
        ->update(['is_delete' => 1]);    
        return response()->json([
            'success' => true,
            'message' => "Deleted successfuly",
        ], 200);
    }
}
?>