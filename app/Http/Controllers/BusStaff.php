<?php

namespace App\Http\Controllers;
use App\Models\AddVehial;
use App\Http\Controllers\BusStaff;
use Illuminate\Http\Request;
use App\Models\BusStaf;
use Illuminate\Support\Facades\Config;
use App\Models\CommanModel;
use App\Models\Schedulemasterall;
use DB;

class BusStaff extends Controller
{
    public function __construct(Request $request)
    {
        if (isset($_COOKIE['selectedYear'])) {
            $selectedYear = $_COOKIE['selectedYear'];
            // Now you can use $selectedYear in your PHP code
            $selectedYear;
        }
        
        if (!empty($request->session)){
            $db_name = $request->session; 
        } else if (!empty($request->session_name)){
            $db_name = $request->session_name;
        } else {
            if (isset($_COOKIE['selectedYear'])) {
                $db_name = $_COOKIE['selectedYear'];
            } else {
                $db_name = "hr_project";
            }
            
        }

        $dynamicConnectionName = 'dynamic';
        $dynamicConfig = Config::get("database.connections.{$dynamicConnectionName}");
        $dynamicConfig['database'] = $db_name;
        Config::set('database.connections.dynamic', $dynamicConfig);
        DB::reconnect('dynamic');

    }
    public function index(){
        $busStafs = DB::connection('dynamic')->table('busstaff')->where('is_delete',0)->get();//BusStaf::where('is_delete',0)->get();

        $callno = DB::connection('dynamic')->table('vehicel')->select('callno')->distinct()->get();//AddVehial::select('callno')->distinct()->get(); 
        return view('backend.Transport.BusStaff', compact('busStafs','callno'));
    }

    public function create(Request $request){
        BusStaf::create($request->post());
        return redirect()->route('driver-conductor-master')->with('success',' has been created successfully.');
    }

    public function view($id){
        $bus_stafs = BusStaf::whereId($id)->get();
        $callno = AddVehial::select('callno')->distinct()->get(); 
        $busStafs = BusStaf::orderBy('id','desc')->get();
        $schedulemasteralls = Schedulemasterall::all();
        $currentDateTime = now(); // Get the current date and time
        
        foreach ($bus_stafs as $bus_staf) {
            $ename = $bus_staf->ename;
        
            foreach ($schedulemasteralls as $schedulemasterall) {
                $schedule_check_one = json_decode($schedulemasterall->schedule_check_one);
                $schedule_time_from = $schedulemasterall->schedule_time_from;
        
                // Compare the current time with the schedule_time_from
                if ($currentDateTime->format('H:i') === $schedule_time_from) {
                    foreach ($schedule_check_one as $item) {
                        if ($item->driver_name === $ename || $item->conductor_name === $ename) {
                            // The ename matches the driver_name and current time matches schedule_time_from
                            // echo "Match found: $ename\n";
                            return redirect()->route('driver-conductor-master')->with('error',' Driver is on the route try after some time');
                        }
                    }
                }
            }
        }
        return view('backend.Transport.BusStaff',compact('bus_stafs','busStafs','callno'));
    
    }

    public function store(Request $request){
        $data = [
            'role' => $request->role,
            'ename' => $request->ename,
            'mobile_number' => $request->mobile_number,
            'aadhar_number' => $request->aadhar_number,
            'sssmid' => $request->sssmid,
            'current_address' => $request->current_address,
            'parmanent_address' => $request->parmanent_address,
            'license_no' => $request->license_no,
            'license_expire' => $request->license_expire,
            'license_lssue' => $request->license_lssue,
            'voter_id_no' => $request->voter_id_no,
            'joining_date' => $request->joining_date,
            'leaving_date' => $request->leaving_date,
            'leaving_date1' => $request->leaving_date1,
            'callno' => $request->callno,
            'offical_mobile_no' => $request->offical_mobile_no,
            'remarks' => $request->remarks,
            'healthstatus' => $request->healthstatus,
        ];
        BusStaf::whereId($request->id)->update($data);
        return redirect()->route('driver-conductor-master')->with('success','Bus Stop has been Updated successfully.');
    }

    public function delete($id){
        $BusStaf = BusStaf::findOrFail($id);
        $BusStaf->delete();
        return redirect()->route('driver-conductor-master')->with('success','Bus Stop has been Deleted successfully.');
    }
    public function busstaff_delete($id)
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
}
