<?php

namespace App\Http\Controllers;
use App\Models\CommanModel;
use App\Models\Holidays;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HolidaysController extends Controller
{
    

    public function index(){
        $stream = Holidays::where('is_delete',0)->get();
        return view('backend.HRMS.holidays', compact('stream'));
    }

    
    public function create(Request $request){
        Holidays::create($request->post());
        return redirect()->route('holidays')->with('success','  holidays has been created successfully.');
    }

    public function view($id){
        // $stream_master = Holidays::whereId($id)->get();
        $stream_master = Holidays::where('HolidayID',$id)->get();
        // $stream = Holidays::orderBy('HolidayID','desc')->paginate(5);
        $stream = Holidays::where('is_delete',0)->get();
        return view('backend.HRMS.holidays', compact('stream_master','stream'));
    }

    public function store(Request $request){
        $data = [
            'HolidayName' => $request->HolidayName,
            'HolidayDate' => $request->HolidayDate
        ];
        // Attendance::whereId($request->id)->update($data);
        Holidays::where('HolidayID',$request->id)->update($data);
        return redirect()->route('holidays')->with('success','holidays has been Updated successfully.');
    }

    public function holidays_delete($id)
    {
        // echo $id;
        // exit;Position
        $a = explode('-',$id);
        $b = $a[1];        
        $c = $a[0];
        // $delete_resp = CommanModel::soft_delete($c,['id'=>$b]);
        $delete_resp = CommanModel::soft_delete($c,['HolidayID'=>$b]);
        if($delete_resp=='TRUE'){
            return redirect()->back()->with('success', 'Record successfully removed');
        }elseif($delete_resp=='FALSE'){
            return redirect()->back()->with('error', 'Record not removed');
        }
    }

    public function delete($id){
        $stream = Holidays::findOrFail($id);
        $stream->delete();
        return redirect()->route('holidays')->with('success','Deleted successfully.');
    }

}
