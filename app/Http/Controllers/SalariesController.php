<?php

namespace App\Http\Controllers;
use App\Models\CommanModel;
use App\Models\Salaries;
use App\Models\Employees;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalariesController extends Controller
{
    

    public function index(){
        $stream = Salaries::where('is_delete',0)->get();
        $employeeName = Employees::where('is_delete',0)->distinct()->get();

        return view('backend.HRMS.salaries', compact('stream','employeeName'));
    }

    
    public function create(Request $request){
        Salaries::create($request->post());
        return redirect()->route('salaries')->with('success','  salaries has been created successfully.');
    }

    public function view($id){
        // $stream_master = Salaries::where('SalaryID',$id)->get();
        // $stream = Salaries::whereId($id)->get();
        // $stream = Salaries::orderBy('id','desc')->paginate(5);

        $stream_master = Salaries::where('SalaryID',$id)->get();
        // $stream = Department::orderBy('DepartmentID','desc')->paginate(5);
        $stream = Salaries::where('is_delete',0)->get();
        $employeeName = Employees::where('is_delete',0)->distinct()->get();
        return view('backend.HRMS.salaries', compact('stream_master','stream','employeeName'));
    }

    public function store(Request $request){
        $data = [
            'SalaryAmount' => $request->SalaryAmount,
            'EffectiveDate' => $request->EffectiveDate,
            'AttendanceMonth' => $request->AttendanceMonth,
            'EmployeeID' => $request->EmployeeID

        ];
        // Salaries::whereId($request->id)->update($data);
        Salaries::where('SalaryID',$request->id)->update($data);
        return redirect()->route('salaries')->with('success','salaries has been Updated successfully.');
    }

    public function salaries_delete($id)
    {
        // echo $id;
        // exit;Position
        $a = explode('-',$id);
        $b = $a[1];        
        $c = $a[0];
        // $delete_resp = CommanModel::soft_delete($c,['id'=>$b]);
        $delete_resp = CommanModel::soft_delete($c,['SalaryID'=>$b]);
        if($delete_resp=='TRUE'){
            return redirect()->back()->with('success', 'Record successfully removed');
        }elseif($delete_resp=='FALSE'){
            return redirect()->back()->with('error', 'Record not removed');
        }
    }

    public function delete($id){
        $stream = Salaries::findOrFail($id);
        $stream->delete();
        return redirect()->route('salaries')->with('success','Deleted successfully.');
    }

}
