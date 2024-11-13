<?php

namespace App\Http\Controllers;
use App\Models\CommanModel;
use App\Models\Marks;
use App\Models\Tablemarks;
use App\Models\Teachers;
use App\Models\Exammaster;
use App\Models\Subject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class MarksController extends Controller
{
    // public function index(){T
    //     return view('backend.AcademicsModules.stream');
    // }

    public function index(){
        $stream = DB::table('previosly_saved_marks_entry')->where('is_delete','=',0)->get();//Marks::where('is_delete',0)->get();
        $teacherlist = Teachers::select('teacher_name')->distinct()->get();
        $examslist = DB::table('exammasters')->select('exam_name')->where('is_delete','=',0)->get();//Exammaster::select('exam_name')->distinct()->get();
        $classlist = DB::table('classes')->select('class_name')->distinct()->get();
        $subjectlist = Subject::select('subject_name')->distinct()->get();
        
        return view('backend.AcademicsModules.marks', compact('classlist','stream','teacherlist','examslist','subjectlist'));
    }

    
    public function create(Request $request){

        $data = [
            "teacher_name" => $request->teacher_name,
            "class_name" => $request->class_name,
            "section_name" => $request->section_name,
            "exam_name" => $request->exam_name,
            "subject_name" => $request->subject_name,
            "max_marks_t" => $request->max_marks_t,
            "also_enter_practical_marks" => $request->also_enter_practical_marks,
            "max_marks_p" => $request->max_marks_p,
            "max_marks" => $request->max_marks,
            "grade_calculation" => $request->grade_calculation,
            "max_marks_nb" => $request->max_marks_nb,
            "max_marks_se" => $request->max_marks_se,            
        ];
        $id = DB::table("previosly_saved_marks_entry")->insertGetId($data);

        $marksdata = $request->marksdata;
        

        foreach ($marksdata as $mdata) {

            $newmdata = [
                "marks_id" => $id,
                "is_absent" => $mdata['is_absent'],
                "is_absent_pr" => $mdata['is_absent_pr'],
                "student_name" => $mdata['student_name'],
                "enrollment" => $mdata['enrollment'],
                "scholar_no" => $mdata['scholar_no'],
                "mark_theory" => $mdata['mark_theory'],
                "mark_practical" => $mdata['mark_practical'],
                "total_marks" => (!empty($mdata['total_marks']) ? $mdata['total_marks'] : $mdata['result'] ),
                "grade" => $mdata['grade'],
                // "result" => (!empty($mdata['result']) ? $mdata['result'] : $mdata['total_marks'] ),
                "class_name" => $request->class_name,
                "max_marks_t" => $request->max_marks_t,
                "max_marks_p" => $request->max_marks_p,
                "max_nb" => (!empty($mdata['max_nb']) ? $mdata['max_nb'] : 0 ),
                "max_se" => (!empty($mdata['max_se']) ? $mdata['max_se'] : 0 ),
                // "overall_grade" => $mdata['overall_grade'],
            ];
            DB::table("marks")->insert($newmdata);//Tablemarks::create($newmdata);
        }        


        $response = ["status" => "success"];
        return response()->json($response);


        // return "success";
        // Marks::create($request->post());
        // return redirect()->route('marks')->with('success','  marks has been created successfully.');
    }

    public function classstudentdata(Request $request){
        $class = $request->class;
        $section_name = $request->section_name;

        $data['students'] = DB::table('student_registration')
            ->where('class_name', $class)
            ->whereJsonContains('json_str->section_name', $section_name)
            ->get();

        return $data;
    }

    public function grade_percentage(Request $request) {
        $percentage = $request->post('percentage');
        
        $arr = DB::table('grademaster')->where('is_delete','=',0)->get();
        $data = "";
    
        foreach ($arr as $range) {
            $min = $range->min_per;
            $max = $range->max_per;
            $grade = $range->grade;
    
            if ($percentage >= $min && $percentage <= $max) {
                $data = $grade;
                break;  // Break out of the loop once a match is found
            }
        }
    
        return json_encode($data);
    }
    

    public function view($id){
        $stream_master = Marks::whereId($id)->where('is_delete',0)->get();//Marks::where('is_delete',0)->get();
        $stream = Marks::where('is_delete',0)->get();
        $teacherlist = Teachers::select('teacher_name')->distinct()->get();
        $examslist = Exammaster::select('exam_name')->distinct()->get();
        $classlist = DB::table('classes')->select('class_name')->distinct()->get();
        $subjectlist = Subject::select('subject_name')->distinct()->get();
        // return $stream_master;
        return view('backend.AcademicsModules.marks', compact('classlist','stream_master','stream','teacherlist','examslist','subjectlist'));
    }

    public function store(Request $request){
        $data = [

            "teacher_name" => $request->subject,
            'exam_name' => $request->exam_name,
            'class_name' => $request->class_name,
            'section_name' => $request->section_name,
            'subject_name' => $request->subject_name,
            
        ];
        Marks::whereId($request->id)->update($data);
        return redirect()->route('marks')->with('success','marks has been Updated successfully.');
    }
    
    public function marks_delete($id)
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

    public function delete($id){
        $stream = Marks::findOrFail($id);
        $stream->delete();
        return redirect()->route('marks')->with('success','Deleted successfully.');
    }

    public function showmarks(){
        $classlist = DB::table('classes')->select('class_name')->distinct()->get();
        $examslist = DB::table('exammasters')->select('exam_name')->where('is_delete','=',0)->get();//Exammaster::select('exam_name')->distinct()->get();
        return view('backend.AcademicsModules.showmarks',compact('classlist','examslist'));
    }

    public function show_report_markss(Request $request){
        $section_name = $request->post('section_name');
        $class_name = $request->post('classname');
        $term_name = $request->post('term_name');
        $report_type = $request->post('report_type');
        $exam_title = $request->post('exam_title');
        $best_of_two = $request->post('best_of_two');
        $pdf_check = $request->post('pdf_check');
        if (!empty($pdf_check)){
            echo "yes";
        } else {
            echo "no";
        }
        die();
        $classlist = DB::table('classes')->select('class_name')->distinct()->get();
        $examslist = DB::table('exammasters')->select('exam_name')->where('is_delete','=',0)->get();
        $studentmarkss = DB::connection('dynamic')
                ->table('previosly_saved_marks_entry')
                ->join('marks', 'previosly_saved_marks_entry.id', '=', 'marks.marks_id')
                ->where('previosly_saved_marks_entry.class_name', '=', $class_name)
                ->where('section_name', '=', $section_name)
                ->Where('exam_name', '=', $term_name)
                ->get();
        $class_teacher = DB::connection('dynamic')->table('teacher_subjects')->select('teacher_name')
        ->where('class_name','=',$class_name)
        ->where('role','=','Class Teacher')
        ->first();
        $studentmarks = [];
        $studentmarks_grade = [];
        $studentmarks_total = [];
        $subject = [];
        $total = 0;
        $sum_marks = 0;
        // echo '<pre>';
        $studentmarks_total_sum = [];
        $studentmarks_total_sum_max = [];
        $student_grade = [];
        foreach($studentmarkss as $key => $student){
            $subject[$student->subject_name] = $student->max_marks;
            $studentmarks[$student->student_name][$student->subject_name] = $student->total_marks;
            $studentmarks_grade[$student->student_name][$student->subject_name] = $student->grade;
            if($student->subject_name != 'Sanskrit' && $student->subject_name != 'Computer Science'){
                $studentmarks[$student->student_name]['total'][] = $student->total_marks;
                $studentmarks[$student->student_name]['max_total'][] = $student->max_marks;
            }
            $studentmarks[$student->student_name]['scholar_no'] = $student->scholar_no;
            $studentmarks_total_sum[$student->student_name] = array_sum($studentmarks[$student->student_name]['total']);
            $studentmarks_total_sum_max[$student->student_name] = array_sum($studentmarks[$student->student_name]['max_total']);
            $student_grade[$student->student_name] = $this->check_grade(($studentmarks_total_sum[$student->student_name] / $studentmarks_total_sum_max[$student->student_name]) * 100);
            $studentmarks_total[$student->student_name][$student->subject_name] = $student->max_marks;
        }
        // print_r($studentmarks);die();
        // print_r($studentmarks_total_sum_max);

        return view('backend.AcademicsModules.showmarks',compact('report_type','term_name','class_name','section_name','class_teacher','studentmarks_grade','student_grade','studentmarks_total_sum_max','subject','classlist','examslist','studentmarks'));
    }

    public function check_grade($number){
        $arr = DB::table('grademaster')->where('is_delete','=','0')->get();
        $data = "";
    
        foreach ($arr as $range) {
            $min = $range->min_per;
            $max = $range->max_per;
            $grade = $range->grade;
    
            if ($number >= $min && $number <= $max) {
                $data = $grade;
                break;  // Break out of the loop once a match is found
            }
        }
        return $data;
    }
}
