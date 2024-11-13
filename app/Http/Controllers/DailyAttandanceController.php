<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teachers;
use App\Models\Student_registration;
use App\Models\dailyattandence;
use App\Models\CommanModel;
use DB;

class DailyAttandanceController extends Controller
{
    public function index(){
        $Classes = Student_registration::all();
        // echo"<pre>";
        // print_r($Classes);
        // exit;
        $dailyreport = dailyattandence::all();
         // Step 2: Retrieve the data that has already been shown and store it in an array or collection
    $alreadyShown = Student_registration::pluck('class_name')->toArray();

    // Step 3: Query the database to select the data that has not been shown yet
    // $nextData = Student_registration::whereNotIn('class_name', $alreadyShown)->first();
    $uniqueNames = array_unique($alreadyShown);

        // $records = Student_registration::select('class_name')->get();

        // echo"<pre>";
        // print_r($dailyreport);
        // exit;
        $classlist = DB::table('classes')->select('class_name')->distinct()->get();
        $teacherlist = Teachers::select('teacher_name')->distinct()->get();
        return view('backend.AcademicsModules.dailyattandence', compact('teacherlist','classlist','Classes','dailyreport','uniqueNames','alreadyShown'));
    }

    
    public function filter(Request $request){
        // $id=;
        $className = $request->value;
        $classwiseAttendance = Student_registration::where('class_name', $className)->get();
        // echo"<pre>";
        // print_r($classwiseAttendance);
        // exit;
        return json_encode($classwiseAttendance,1); 
        
    }
    
    public function Attendance(Request $request){
        // Check if attendance_data is not null
        if ($request->has('attendance_data')) {
            $attdata = json_decode($request->attendance_data);
    
            // Check if $attdata is an array or object
            if (is_array($attdata) || is_object($attdata)) {
                // Extract data from JSON objects
                $studentdata = [];
                foreach ($attdata as $entry) {
                    $studentdata[] = [
                        'row' => $entry->row,
                        'value' => $entry->value,
                        'student_name' => $entry->student_name,
                        'form_Number' => $entry->form_Number,
                        'student_id' => $entry->student_id,
                    ];
                }
    
                $data = json_encode($studentdata);
    
                $insertArr  = [
                    'Attandence_Name' => $request->Attandence_Name,
                    'teacher_name' => $request->teacher_name,
                    'section_name' => $request->section_name,
                    'class_name' => $request->class_name,
                    'period_meeting' => $request->period_meeting,
                    'json_str' => $data
                ];
    
                CommanModel::insertData('dailattandence', $insertArr);
    
            }
        }
        return redirect()->back()->with('success', 'Student successfully registered');
    }
    
    
}
