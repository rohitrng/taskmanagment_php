<?php

namespace App\Http\Controllers;
use App\Models\CommanModel;
use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // public function index(){
    //     return view('backend.AcademicsModules.stream');
    // }

    public function index(){
        $stream = Department::where('is_delete',0)->get();
        return view('backend.HRMS.department', compact('stream'));
    }

    
    public function create(Request $request){
        Department::create($request->post());
        return redirect()->route('department')->with('success','  Department has been created successfully.');
    }

    public function view($id){
        // $stream_master = Department::whereId($id)->get();        
        $stream_master = Department::where('DepartmentID',$id)->get();
        // $stream = Department::orderBy('DepartmentID','desc')->paginate(5);
        $stream = Department::where('is_delete',0)->get();
        return view('backend.HRMS.department', compact('stream_master','stream'));
    }

    public function store(Request $request){
        $data = [
            'DepartmentName' => $request->DepartmentName
            
        ];
        // Department::whereId($request->id)->update($data);
        Department::where('DepartmentID',$request->EmployeeID)->update($data);
        return redirect()->route('department')->with('success','department has been Updated successfully.');
    }

    public function department_delete($id)
    {
        // echo $id;
        // exit;
        $a = explode('-',$id);
        $b = $a[1];        
        $c = $a[0];
        $delete_resp = CommanModel::soft_delete($c,['DepartmentID'=>$b]);
        if($delete_resp=='TRUE'){
            return redirect()->back()->with('success', 'Record successfully removed');
        }elseif($delete_resp=='FALSE'){
            return redirect()->back()->with('error', 'Record not removed');
        }
    }

    public function delete($id){
        $stream = Department::findOrFail($id);
        $stream->delete();
        return redirect()->route('department')->with('success','Deleted successfully.');
    }

}
