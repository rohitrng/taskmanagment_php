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
        $mobile_number = DB::connection('dynamic')->table('tm_employee')
        ->where('emp_contact_number', $request->emp_contact_number)
        ->first();
        if ($mobile_number) {
            return response()->json(['error' => 'User is all ready exist'], 409);
        } else {
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
                'emp_user_id' => $request->emp_user_id,
            ];
            
            // Handle file upload for candidate resume
            if ($request->hasFile('emp_photo')) {
                // Get the uploaded file
                $file = $request->file('emp_photo');
                
                // Move the file to the 'resumes' directory in public path and store its path
                $filePath = $file->move(public_path('emp_photo'), $file->getClientOriginalName());
                
                // Store the relative path of the file in the data array
                $datas['emp_photo'] = 'emp_photo/' . $file->getClientOriginalName();
            } else {
                // Set resume path to null if no file is uploaded
                $datas['emp_photo'] = null;
            }

            $insert = DB::connection('dynamic')->table('tm_employee')->insert($datas);
            if ($insert){
                return response()->json([
                    'success' => true,
                    'message' => 'Add employee successful',
                    'datas' => $datas,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to add employee',
                ], 404);
            }
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

    public function getemp_list(){
        $datas = DB::connection('dynamic')
            ->table('tm_employee')
            ->join('model_has_roles', 'tm_employee.emp_contact_number', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name','!=','Admin')
            ->select('tm_employee.emp_name','tm_employee.id', 'roles.name as role_name')
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

    public function getemp_list_full(){
        $datas = DB::connection('dynamic')
        ->table('tm_employee')
        ->join('model_has_roles', 'tm_employee.emp_contact_number', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->where('roles.name','!=','Admin')
        ->select('tm_employee.id','tm_employee.emp_name','tm_employee.emp_id','tm_employee.emp_contact_number','tm_employee.emp_email','tm_employee.emp_date_of_join','tm_employee.emp_photo', 'roles.name as role_name')
        ->get();
        // emp_name, emp_id, emp_contact_number, emp_email, emp_date_of_join, photo
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

    public function deleteemp($id){
        DB::table('tm_employee')->where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => "Deleted successfuly",
        ], 200);
    }
}