<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeapiController extends Controller{

    public function employeeform(request $request){
        $datas = [
            'emp_name' => $request->emp_name,
            'emp_id' => $request->emp_id,
            'emp_department' => $request->emp_department,
            'emp_designation' => $request->emp_designation,
            'emp_contact_number' => $request->emp_contact_number,
            'emp_email' => $request->emp_email,
            'emp_date_of_join' => $request->emp_date_of_join,
            'emp_manager' => $request->emp_manager,
            'emp_hourly' => $request->emp_hourly,
        ];

        $insert = DB::connection('dynamic')->table('tm_employee')->insert($datas);
        if ($insert){
            return response()->json([
                'success' => true,
                'message' => 'Add employee successful',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add employee',
            ], 404);
        }

    }

    public function getemp_id(){
        $lastId = DB::connection('dynamic')->table('tm_employee')->max('id');
        $data = [
            'last_id' => $lastId + 1,
        ];
        if ($lastId) {
            return response()->json([
                'success' => true,
                'message' => $data,
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => $data,
            ], 200);
        }
    }

}