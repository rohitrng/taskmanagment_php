<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommanModel;
use App\Models\SubjectAssignStudent;
use App\Models\SubjectCombination;
use DB;
class AssignSubjectController extends Controller
{
    public function index() {
        $stream = SubjectAssignStudent::where('is_delete', 0)->get();
        $subjectsassign = SubjectAssignStudent::all();
        $classlist = DB::table('classes')->select('class_name')->distinct()->get();
        $datas = DB::table('classes')->select('class_name')->distinct()->get();
        $comlist = SubjectCombination::select('combination_name')->distinct()->get(); // Change the select column here        
    
        // Initialize $c_stream with a default value, or fetch it from your data
        $c_stream = ''; // You can set it to the default value or fetch it from your data
        // dd($comlist);
         
        return view('backend.AcademicsModules.assignsubject', compact('classlist', 'stream', 'datas', 'subjectsassign', 'comlist', 'c_stream'));
    }
    
    public function create(Request $request){

        // $students_details = $request->input('students_details'); 
        $students_details = ""; 

        if($request->section_name == "All"){
           
            $data = $request->all();
            $sections = ['A', 'B'];
            foreach($sections as $section){
                 $data = $section;
                //  TeacherSubject::create($data);

                //   print_r($data);
                //  echo 'shivani';
                 
            }

        }else{

            $newSubjectAssignStudent = new SubjectAssignStudent([
                'class_name' => $request->input('class_name'),
                'section_name' => $request->input('section_name'),
                'assign_this_combtoall' => $request->input('combination_name_dropdown'),                
                // 'students_details' => $students_details
            ]);
    
            $newSubjectAssignStudent->save();
    
            // SubjectAssignStudent::create($request->post());            
        }
        // SubjectCombination::create($request->post());
        $comlist = SubjectCombination::select('combination_name')->distinct()->get();
        return redirect()->route('AssignSubject')->with('success','  AssignSubject has been created successfully.');
    }

    
    public function view($id){
        $stream_master = SubjectAssignStudent::whereId($id)->get();
        $stream = SubjectAssignStudent::orderBy('id','desc')->paginate(5);
        $datas = DB::table('classes')->select('class_name')->distinct()->get();
        $classlist = DB::table('classes')->select('class_name')->distinct()->get();
        $subjectsassign = SubjectAssignStudent::all();
        
        return view('backend.AcademicsModules.assignsubject', compact('stream_master','stream','classlist','subjectsassign'));

        // return view('backend.AcademicsModules.teachersubject',compact('classlist','sessions','teachersession', 'studentsession', 'pre_studentsessions'));

    }

    public function student_combination_data(Request $request){       
        $class_name = $request->class_name;
        $section_name = $request->section_name;
        // $data = DB::table('student_registration')->select('id', 'class_name', 'student_name')->where(['class_name','=',$class_name], ['section_name','=',$section_name])->distinct()->get();
        $data = DB::table('student_registration')->select('id', 'class_name', 'student_name')->where('class_name','=',$class_name)->distinct()->get();
            

        return $data;

    }


    public function store(Request $request){
        $data = [
            'class_name' => $request->class_name,
            'section_name' => $request->section_name,
            'combination_name' => $request->combination_name,
            'students_details' => $request->students_details,
        ];
        SubjectAssignStudent::whereId($request->id)->update($data);
        return redirect()->route('AssignSubject')->with('success','AssignSubject has been Updated successfully.');
    }



    
    public function fetchStudentData(Request $request)
{
    // Fetch student data based on the selected class and section
    $selectedClass = $request->input('class_name');
    $selectedSection = $request->input('section_name');
    
    // You should implement the logic to fetch student data based on class and section here
    $studentData = response[i].studentData; // Replace with your logic to get student data

    return response()->json($studentData);
}

    public function AssignSubject_delete($id)
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
        $stream = SubjectAssignStudent::findOrFail($id);
        $stream->delete();
        return redirect()->route('AssignSubject')->with('success','Deleted successfully.');
    }












}
