<?php

namespace App\Http\Controllers;
use App\Models\CommanModel;
use App\Models\Attendance;
use App\Models\Employees;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    

    public function index(){
        $stream = Attendance::where('is_delete',0)->get();
        $employeeName = Employees::where('is_delete',0)->distinct()->get();
        return view('backend.HRMS.attendance', compact('stream','employeeName'));
    }

    
    public function create(Request $request){
        Attendance::create($request->post());
        return redirect()->route('attendance')->with('success','  attendance has been created successfully.');
    }

    public function view($id){        
        $stream_master = Attendance::where('AttendanceID',$id)->get();        
        $stream = Attendance::where('is_delete',0)->get();
        $employeeName = Employees::where('is_delete',0)->distinct()->get();
        return view('backend.HRMS.attendance', compact('stream_master','stream','employeeName'));
    }

    public function store(Request $request){
        $data = [
            'Date' => $request->Date,
            'Status' => $request->Status,
            'EmployeeID' => $request->EmployeeID,
        ];        
        Attendance::where('AttendanceID',$request->id)->update($data);
        return redirect()->route('attendance')->with('success','attendance has been Updated successfully.');
    }

    public function attendance_delete($id)
    {
        // echo $id;
        // exit;Position
        $a = explode('-',$id);
        $b = $a[1];        
        $c = $a[0];
        $delete_resp = CommanModel::soft_delete($c,['AttendanceID'=>$b]);
        if($delete_resp=='TRUE'){
            return redirect()->back()->with('success', 'Record successfully removed');
        }elseif($delete_resp=='FALSE'){
            return redirect()->back()->with('error', 'Record not removed');
        }
    }

    public function delete($id){
        $stream = Attendance::findOrFail($id);
        $stream->delete();
        return redirect()->route('attendance')->with('success','Deleted successfully.');
    }

}
