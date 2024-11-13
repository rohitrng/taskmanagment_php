<?php

namespace App\Http\Controllers;
use App\Models\TeacherSubject;
use App\Http\Controllers\Controller;
use App\Models\CommanModel;
use App\Models\Student_registration;
use App\Models\Subject;
use App\Models\Teachers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use DB;

class TeacherSubjectController extends Controller
{
    public function index(){
        $studentclasses = Student_registration::select('class_name')->distinct()->get();
        $studentsession = Student_registration::select('session_name')->distinct()->get();
        $subjects = Subject::select('id','subject_name')->distinct('subject_name')->get();
        $teacherlist = Teachers::select('teacher_name')->distinct()->get();
        $session = Student_registration::select('id','session_name')->distinct('session_name')->get();
        $teachersubjects = TeacherSubject::all();
        $teachersession = Student_registration::all();
        $pre_studentsessions = $studentsession;
        $datas = DB::table('classes')->select('class_name')->distinct()->get();
        $classlist = DB::table('classes')->select('class_name')->distinct()->get();
        return view('backend.AcademicsModules.teachersubject', compact('teacherlist','classlist','studentclasses', 'subjects', 'teachersubjects', 'session', 'studentsession', 'pre_studentsessions','teachersession'));
    }

    public function create(Request $request){                 
        if($request->section_name == "All"){
           
            $data = $request->all();
            $sections = ['A', 'B'];
            foreach($sections as $section){
                 $data = $section;
                //  TeacherSubject::create($data);

                //   print_r($data);
                //  echo 'shivani';
                 
            }

            // die();
            
        }else{
            TeacherSubject::create($request->post());            
        }
        
        // print_r($request->all());
        return redirect()->route('teachersubject')->with('success',' has been created successfully.');
        // return 'success';
    }

    public function teachersubject_copy(Request $request){
        $data = $request->all();
        // print_r($data['pre_session']);
        $pre_session = $data['pre_session'];
        $session_name = $data['session_name'];
        $TeacherSubject = TeacherSubject::where(['session_name' => $pre_session])->get();
        $newData = [];
        foreach ($TeacherSubject as $item) {
            $data = array(
                "class_name" => $item['class_name'],
                "section_name" => $item['section_name'],
                "subject_name" => $item['subject_name'],
                "teacher_name" => $item['teacher_name'],
                "session_name" => $session_name,
            ); 
            array_push($newData, $data);
        }

        TeacherSubject::insert($newData);

        // return redirect()->route('teachersubject')->with('success',' copied successfully.');
        return redirect()->route('teachersubject')->with('success',' has been copied successfully.');
    }


    public function view($id){
        $teacher_subject = TeacherSubject::whereId($id)->get();
        // $teachersubjects = TeacherSubject::orderBy('id','desc');
        $teachersubjects = TeacherSubject::all();

        // if(!empty($teacher_subject)){          
        //     $teacher_subject[count($teacher_subject)-1]->class_name = explode(',', $teacher_subject[count($teacher_subject)-1]->class_name);            
        // }         
        $teacher_subject = $teacher_subject[0];

        $studentclasses = Student_registration::select('class_name')->distinct()->get();
        $classlist = DB::table('classes')->select('class_name')->distinct()->get();
        $teacherlist = Teachers::select('teacher_name')->distinct()->get();

        $subjects = Subject::select('id','subject_name')->distinct('subject_name')->get();
        return view('backend.AcademicsModules.teachersubject',compact('teacherlist','classlist', 'subjects','teacher_subject','teachersubjects', 'studentclasses'));

        $sessions = Student_registration::whereId($id)->get();
        $teachersession = Student_registration::orderBy('id','desc');

        if(!empty($sessions)){          
            $sessions[count($sessions)-1]->class_name = explode(',', $sessions[count($sessions)-1]->session_name);            
        }
        $pre_studentsessions = $studentsession;

        $studentsession = Student_registration::select('session_name')->distinct()->get();

        $classlist = DB::table('classes')->select('class_name')->distinct()->get();

        return view('backend.AcademicsModules.teachersubject',compact('classlist','sessions','teachersession', 'studentsession', 'pre_studentsessions'));

    }
    // public function getteachersclasses(Request $request){
    //     $teacher = $request->teacher;

    //     $data = DB::table('teacher_subjects')->where("teacher_name", $teacher)->distinct()->get();
    //     return $data;
    // }

    // public function getteacherssubject(Request $request){
    //     $teacher = $request->teacher;

    //     $data = DB::table('teacher_subjects')->where("teacher_name", $teacher)->distinct()->get();
    //     return $data;
    // }
    public function getteachersdata(Request $request){
        $teacher = $request->teacher;
    
        $classes = DB::table('teacher_subjects')->where("teacher_name", $teacher)->distinct()->pluck('class_name');
        $subjects = DB::table('teacher_subjects')->where("teacher_name", $teacher)->distinct()->pluck('subject_name');
    
        return ['classes' => $classes, 'subjects' => $subjects];
    }
    
    public function getteachersandsubject(Request $request){
        $teacher = $request->teacher;
        $class_name = $request->class_name;
    
        // $classes = DB::table('teacher_subjects')->where("teacher_name", $teacher)->distinct()->pluck('class_name');
        $subjects = DB::table('teacher_subjects')->where("teacher_name", $teacher)->where("class_name", $class_name)->distinct()->pluck('subject_name');
    
        return [ 'subjects' => $subjects];
    }

    public function store(Request $request){
        //   echo 'store';
            // print_r($request->all());
            
            $teachersubject = array(
                "class_name" => $request->class_name,
                "section_name" => $request->section_name,
                "subject_name" =>$request->subject_name,
                "teacher_name" => $request->teacher_name,
                "session_name" => $request->session_name,
                "current_date" =>$request->current_date,
                "role" =>$request->role,


            );            
    
            // $exammaster = Exammaster::create($exammaster);
            // return view($exammaster, "added successfully.");
    
            TeacherSubject::whereId($request->id)->update($teachersubject);
            return redirect()->route('teachersubject')->with('success',' Updated successfully.');
    
        }

        public function teachersubject_delete(Request $request)
        {
            // print_r($request->all());
            // die();
            $table = $request->table_name;
            $delete_resp = CommanModel::soft_delete($table,['id'=>$request->delete_id]);
            if($delete_resp=='TRUE'){
                return redirect()->back()->with('success', 'Record successfully removed');
            }elseif($delete_resp=='FALSE'){
                return redirect()->back()->with('error', 'Record not removed');
            }
        }


        public function delete($id){
            $teachersubject = TeacherSubject::findOrFail($id);
            $teachersubject->delete();
            return redirect()->route('teachersubject')->with('success','Deleted successfully.');
        }

}
