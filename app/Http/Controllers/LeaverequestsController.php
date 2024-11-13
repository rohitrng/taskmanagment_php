<?php

namespace App\Http\Controllers;
use App\Models\CommanModel;
use App\Models\Leaverequests;
use App\Models\Employees;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaverequestsController extends Controller
{
    

    public function index(){
        $stream = Leaverequests::where('is_delete',0)->get();
        $employeeName = Employees::where('is_delete',0)->distinct()->get();
        return view('backend.HRMS.leaverequests', compact('stream','employeeName'));
    }

    
    public function create(Request $request){
        Leaverequests::create($request->post());
        return redirect()->route('leaverequests')->with('success','  Leaverequests has been created successfully.');
    }

    public function view($id){
        // $stream_master = Leaverequests::whereId($id)->get();
        $stream_master = Leaverequests::where('LeaveRequestID',$id)->get();
        $stream = Leaverequests::orderBy('LeaveRequestID','desc')->paginate(5); 
        $employeeName = Employees::where('is_delete',0)->distinct()->get(); 
        return view('backend.HRMS.leaverequests', compact('stream_master','stream','employeeName'));
    }

    public function store(Request $request){
        $data = [
            'LeaveStartDate' => $request->LeaveStartDate,
            'LeaveEndDate' => $request->LeaveEndDate,
            'LeaveType' => $request->LeaveType,
            'Status' => $request->Status,
            'EmployeeID' => $request->EmployeeID
        ];
                
        Leaverequests::where('LeaveRequestID',$request->id)->update($data);
        return redirect()->route('leaverequests')->with('success','Leaverequests has been Updated successfully.');
    }

    public function leaverequests_delete($id)
    {       
        $delete_resp = CommanModel::soft_delete('leaverequests',['LeaveRequestID'=>$id]);
        if($delete_resp=='TRUE'){
            return redirect()->back()->with('success', 'Record successfully removed');
        }elseif($delete_resp=='FALSE'){
            return redirect()->back()->with('error', 'Record not removed');
        }
    }

    public function delete($id){
        $stream = Leaverequests::findOrFail($id);
        $stream->delete();
        return redirect()->route('leaverequests')->with('success','Deleted successfully.');
    }

}
