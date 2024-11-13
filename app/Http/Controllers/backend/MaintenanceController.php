<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maintenanceheadmaster;
use App\Models\Maintenancegroupmaster;
use App\Models\CommanModel;

class MaintenanceController extends Controller

{
    public function index(){
        $maintenances = Maintenanceheadmaster::where('is_delete',0)->get();
        $maintenancegs = Maintenancegroupmaster::where('is_delete',0)->get();
        $select_main = Maintenancegroupmaster::All();
        return view('backend.Transport.maintenance-head-master', compact('select_main','maintenancegs','maintenances'));
    }

    public function view($id){
        $maintenance_s = Maintenanceheadmaster::whereId($id)->get();
        $maintenances = Maintenanceheadmaster::orderBy('id','desc')->get();
        $maintenancegs = Maintenancegroupmaster::orderBy('id','desc')->get();
        $select_main = Maintenancegroupmaster::All();
        return view('backend.Transport.maintenance-head-master',compact('select_main','maintenancegs','maintenance_s','maintenances'));
    }

    public function editg($id){
        $maintenance_groups = Maintenancegroupmaster::whereId($id)->get();
        $maintenancegs = Maintenancegroupmaster::orderBy('id','desc')->get();
        $maintenances = Maintenanceheadmaster::orderBy('id','desc')->get();
        return view('backend.Transport.maintenance-head-master',compact('maintenance_groups','maintenancegs','maintenances'));
    }

    public function store(Request $request){
        if (!empty($request->id)){
            Maintenanceheadmaster::updateorcreate([
                'id' => $request->id
            ],
            [
                'maintenance_group_name' => $request->maintenance_group_name,
                'maintenance_head_name' => $request->maintenance_head_name
            ]);
        } else {
            Maintenanceheadmaster::create($request->post());
        }
        return redirect()->action([MaintenanceController::class, 'index'])->with('success','Maintenance Master has been Save successfully.');
    }

    public function storeg(Request $request){
        if (!empty($request->id)){
            Maintenancegroupmaster::updateorcreate([
                'id' => $request->id
            ],
            [
                'maintenance_group_name' => $request->maintenance_group_name
            ]);
        } else {
            Maintenancegroupmaster::create($request->post());
        }
        return redirect()->action([MaintenanceController::class, 'index'])->with('success','Maintenance Master has been Save successfully.');
    }
    public function maintenancegroupmaster_delete($id)
    {
        // echo $id;
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
    public function maintenanceheadpmaster_delete($id)
    {
        // echo $id;
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

    public function delete($id){
        $rtopapers = Maintenanceheadmaster::findOrFail($id);
        $rtopapers->delete();
        return redirect()->route('maintenance-head-master')->with('success','Bus Stop has been Deleted successfully.');
    }
}
