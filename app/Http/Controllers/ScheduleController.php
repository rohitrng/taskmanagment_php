<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedulemaster;
use App\Models\Schedulemasterall;
use App\Models\AddVehial;
use App\Models\BusStaf;
use App\Models\Routemaster;
use DB;
use App\Models\CommanModel;

class ScheduleController extends Controller
{
    public function index(){
        $schedule_names = Schedulemaster::orderBy('id','desc')->get();
        $vehicels = AddVehial::orderBy('id','desc')->get();
        $routes = Routemaster::All();
        $drivers = BusStaf::select('ename')->where('role','=','Driver')->get();
        $conductors = BusStaf::select('ename')->where('role','=','Conductor')->get();

        $count_taken_tranport = DB::table('student_registration')
            ->join('scholarbusassign', 'scholarbusassign.student_id_select_p', '=', 'student_registration.id')
            ->select('student_registration.class_name', DB::raw('COUNT(*) as count'))
             ->where('student_registration.class_name', '=', '01')
            ->groupBy('student_registration.class_name')
            ->get();

        $student_data = DB::connection('dynamic')->table('student_registration')
            ->select('class_name', DB::connection('dynamic')->raw('COUNT(*) as count'))
            ->selectRaw("SUM(JSON_EXTRACT(json_str, '$.required_school_transport    ') = '1') as transport_count")
            ->groupBy('class_name')
            ->get();
        return view('backend.Transport.shedulemaster',compact('conductors','drivers','routes','schedule_names','vehicels','student_data','count_taken_tranport'));
    }

    public function store(Request $request){
        if (!empty($request->id)){
            Schedulemaster::updateorcreate([
                'id' => $request->id
            ],
            [
                'schedule_name' => $request->schedule_name
            ]);
        } else {
            // checking schedule name 
            if (DB::table('schedulemaster')->where('schedule_name', $request->schedule_name)->exists()){
                return redirect()->action([ScheduleController::class, 'index'])->with('error','Schedule name is already exists.');
            }else{
                Schedulemaster::create($request->post());
            }
            
        }
        return redirect()->action([ScheduleController::class, 'index'])->with('success','Schedule Master has been Save successfully.');
    }

    public function create(Request $request){
        $count = $request->count;
        $check_one_count = $request->check_one_count;
        echo '<pre>';
        
        for($i=1; $i<=$count; $i++){
            $check_two = 'check_two_'.$i;
            $class_name = 'class_name_'.$i;
            $section = 'section_'.$i;
            $class_strength = 'class_strength_'.$i;
            if($request->post($check_two) == 1){
                $data[$i] = [
                    'check_two' => $request->post($check_two),
                    'class_name' => $request->post($class_name),
                    'section' => $request->post($section),
                    'class_strength' => $request->post($class_strength),
                ];
            }
        }

        for($i=1; $i<=$check_one_count; $i++){
            $check_one = 'check_one_'.$i;
            $callno = 'callno_'.$i;
            $vehicelno = 'vehicelno_'.$i;
            $capacity = 'capacity_'.$i;
            $route_name = 'route_name_'.$i;
            $driver_name = 'driver_name_'.$i;
            $conductor_name = 'conductor_name_'.$i;

            if($request->post($check_one) == 1){
                $data1[$i] = [
                    'check_one' => $request->post($check_one),
                    'callno' => $request->post($callno),
                    'vehicelno' => $request->post($vehicelno),
                    'capacity' => $request->post($capacity),
                    'route_name' => $request->post($route_name),
                    'driver_name' => $request->post($driver_name),
                    'conductor_name' => $request->post($conductor_name),
                ];
            }
        }

        $json2 = json_encode($data,1);
        $json1 = json_encode($data1,1);

        if (!empty($request->id)){
            $data = [
                'schedule_name' => $request->schedule_namea,
                'schedule_date' => $request->schedule_date,
                'schedule_time_from' => $request->schedule_time_from,
                'schedule_time_to' => $request->schedule_time_to,
                'schedule_print_option' => $request->schedule_print_option,
                'schedule_point' => $request->schedule_point,
                'schedule_order' => $request->schedule_order,
                'schedule_check_two' => $json2,
                'schedule_check_one' => $json1,
            ];
            $inquiry_data = CommanModel::updateData('schedulemasterall',['id'=>$request->id],$data);
        } else {
            $data = [
                'schedule_name' => $request->schedule_namea,
                'schedule_date' => $request->schedule_date,
                'schedule_time_from' => $request->schedule_time_from,
                'schedule_time_to' => $request->schedule_time_to,
                'schedule_print_option' => $request->schedule_print_option,
                'schedule_point' => $request->schedule_point,
                'schedule_order' => $request->schedule_order,
                'schedule_check_two' => $json2,
                'schedule_check_one' => $json1,
            ];
            DB::table('schedulemasterall')->insert($data);
            // Schedulemasterall::create($data);
        }
        return redirect()->action([ScheduleController::class, 'index'])->with('success','Schedule Master has been Save successfully.');
    }

    public function ajax(Request $request){
        $schedule_name = $request->schedule_name;
        $schedule_names = Schedulemasterall::select('*')->where('schedule_name','=',$schedule_name)->get();
        $pickupBusNoCounts = DB::table('scholarbusassign')
            ->select('pickup_bus_no', DB::raw('COUNT(*) as pickup_bus_no_count'))
            ->groupBy('pickup_bus_no')
            ->where('pick_shedule_name', '=', $schedule_name)
            ->get();
        $join = ['schedule_names'=>$schedule_names,'pickupBusNoCounts'=>$pickupBusNoCounts];    
        return json_encode($join,1);
    }
}