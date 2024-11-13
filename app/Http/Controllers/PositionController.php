<?php

namespace App\Http\Controllers;
use App\Models\CommanModel;
use App\Models\Position;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    

    public function index(){
        $stream = Position::where('is_delete',0)->get();
        return view('backend.HRMS.position', compact('stream'));
    }

    
    public function create(Request $request){
        Position::create($request->post());
        return redirect()->route('position')->with('success','  position has been created successfully.');
    }

    public function view($id){        
        // $stream = Position::orderBy('PositionID','desc')->paginate(5);
        $stream_master = Position::where('PositionID',$id)->get();        
        $stream = Position::where('is_delete',0)->get();
        return view('backend.HRMS.position', compact('stream_master','stream'));
    }

    public function store(Request $request){
        $data = [
            'PositionName' => $request->PositionName
            
        ];
        // Position::whereId($request->id)->update($data);
        Department::where('PositionID',$request->EmployeeID)->update($data);

        return redirect()->route('position')->with('success','position has been Updated successfully.');
    }

    public function position_delete($id)
    {
        // echo $id;
        // exit;Position
        $a = explode('-',$id);
        $b = $a[1];        
        $c = $a[0];
        // $delete_resp = CommanModel::soft_delete($c,['id'=>$b]);
        $delete_resp = CommanModel::soft_delete($c,['PositionID'=>$b]);
        if($delete_resp=='TRUE'){
            return redirect()->back()->with('success', 'Record successfully removed');
        }elseif($delete_resp=='FALSE'){
            return redirect()->back()->with('error', 'Record not removed');
        }
    }

    public function delete($id){
        $stream = Position::findOrFail($id);
        $stream->delete();
        return redirect()->route('position')->with('success','Deleted successfully.');
    }

}
