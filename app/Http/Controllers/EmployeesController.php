<?php

namespace App\Http\Controllers;
use App\Models\CommanModel;
use App\Models\Employees;
use App\Models\Position;
use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class EmployeesController extends Controller
{
    // public function index(){
    //     return view('backend.AcademicsModules.stream');
    // }

    public function index(){
        $stream = Employees::where('is_delete',0)->get(); 
        
        $deparments = Department::where('is_delete',0)->distinct()->get();
        $positions = Position::where('is_delete',0)->distinct()->get();
       

        // $deparments = DB::table('departments')
        // ->join('employees', 'departments.DepartmentID', '=', 'employees.DepartmentID')
        // ->select('employees.DepartmentID', 'departments.DepartmentName')
        // ->get();

        return view('backend.HRMS.employees', compact('stream', 'deparments','positions'));
    }

    public function create(Request $request){
        Employees::create($request->post());
        return redirect()->route('employee')->with('success','  employee has been created successfully.');
    }

    // public function view($id){
    //     $stream_master = Employees::whereId($id)->get();
    //     // $stream = Teachers::orderBy('id','desc')->paginate(5);
    //     $stream = Employees::where('is_delete',0)->get();     
    //     return view('backend.HRMS.employees', compact('stream_master','stream'));
    // }


    public function view($id){        
        $stream_master = Employees::where('EmployeeID',$id)->get();
        // $stream = Employees::orderBy('EmployeeID','desc')->paginate(5);  
        $stream = Employees::where('is_delete',0)->get();

        $deparments = Department::where('is_delete',0)->distinct()->get();
        $positions = Position::where('is_delete',0)->distinct()->get();
        return view('backend.HRMS.employees', compact('stream_master','stream' ,'deparments','positions'));
    }


    public function store(Request $request){
        $data = [
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'Email' => $request->Email,
            'Phone' => $request->Phone,
            'Address' => $request->Address,
            'DateOfBirth' => $request->DateOfBirth,
            'JoiningDate' => $request->JoiningDate,
            'DepartureDate' => $request->DepartureDate,
            'DepartmentID' => $request->DepartmentID,
            'PositionID' => $request->PositionID,
   
        ];
        // Employees::whereId($request->EmployeeID)->update($data);
        Employees::where('EmployeeID',$request->EmployeeID)->update($data);
        return redirect()->route('employee')->with('success','employee has been Updated successfully.');
    }


    public function delete($id){
        $teachersubject = Employees::findOrFail($id);
        $teachersubject->delete();
        return redirect()->route('employee')->with('success','Deleted successfully.');
    }

    public function employee_delete($id)
    {                
        // $stream = Employees::findOrFail($id);
        // $stream->delete();
        // return redirect()->back()->with('success', 'Record successfully removed');
        
        $delete_resp = CommanModel::soft_delete('employees',['EmployeeID'=>$id]);
        if($delete_resp=='TRUE'){
            return redirect()->back()->with('success', 'Record successfully removed');
        }elseif($delete_resp=='FALSE'){
            return redirect()->back()->with('error', 'Record not removed');
        }
    }





}