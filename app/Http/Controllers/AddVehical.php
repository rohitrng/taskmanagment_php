<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AddVehical;
use Illuminate\Http\Request;
use App\Models\AddVehial;
use App\Models\CommanModel;
class AddVehical extends Controller
{
    public function index(){
        $vehicals = AddVehial::where('is_delete',0)->get();
        return view('backend.Transport.addvehical', compact('vehicals'));
    }
    public function addvehical(Request $request){
        $request->validate([
            'callno'=>'required',
            'vehicel'=>'required',
            'imei'=>'required',
            'Machine'=>'required'
        ]);
        $AddVehial= new AddVehial;
        $AddVehial->callno=$request['callno'];
        $AddVehial->vehicelno=$request['vehicel'];
        $AddVehial->vehiceltype=$request['vehiceltype'];
        $AddVehial->nature=$request['Nature'];
        $AddVehial->model=$request['year'];
        $AddVehial->purchase=$request['dp'];
        $AddVehial->capacity=$request['capacity'];
        $AddVehial->standard=$request['StandardAvg'];
        $AddVehial->IMEI=$request['imei'];
        $AddVehial->machine=$request['Machine'];
        $AddVehial->studentrelated=$request['StudentRelated'];
        $AddVehial->scrapped=$request['Scrapped'];

        $AddVehial->save();
        return redirect('addvehical')
                        ->with('success','Record inserted successfully');
    }
   
    public function list(){
        $Vehicallist = AddVehial::all();
        return view('backend.Transport.list',compact('Vehicallist'));
    }
    public function view($id){
        $Vehicallist = AddVehial::whereId($id)->get();
        // $Vehicallist = AddVehial::orderBy('id','desc')->paginate(5);
        $vehicals = AddVehial::where('is_delete',0)->get();

        // echo"<pre>";
        // print_r($Vehicallist);
        // exit;
        return view('backend.Transport.addvehical',compact('vehicals','Vehicallist'));
    }
    public function store(Request $request){
        // echo"<pre>";
        // print_r($request->all());
        // exit;
        $data = [
            'callno' => $request->callno,
            'vehicelno' => $request->vehicel,
            'vehiceltype' => $request->vehiceltype,
            'model' => $request->year,
            'purchase' => $request->dp,
            'capacity' => $request->capacity,
            'standard' => $request->StandardAvg,
            'imei' => $request->imei,
            'machine' => $request->Machine,
            'nature' => $request->Nature,
            'studentrelated' => $request->StudentRelated,
            'scrapped' => $request->Scrapped,
        ];
        // echo"<pre>";
        // print_r($data);
        // exit;
        AddVehial::whereId($request->id)->update($data);
        // echo "done";
        return redirect('addvehical')
        ->with('success','Record update successfully');

    }
    public function busstaff(){
        return view('backend.Transport.BusStaff');
    }
    public function  addvehical_delete($id)
    {
        // echo $id;
        // exit;
        $a = explode('-',$id);
        $b = $a[1];        
        $c = $a[0];
        $delete_resp = CommanModel::soft_delete($c,['id'=>$b]);
        if($delete_resp=='TRUE'){
            return redirect()->back()->with('success', 'Record successfully removed');
        }elseif($delete_resp=='FALSE'){
            return redirect()->back()->with('error', 'Record not removed');
        }
    }
    public function registerstaff(Request $request){
         echo"<pre>";
         print_r($request->all());
    }
}
