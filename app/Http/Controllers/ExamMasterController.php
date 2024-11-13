<?php

namespace App\Http\Controllers;

use App\Models\Exammaster;
use App\Models\Student_registration;
use App\Http\Controllers\Controller;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\CommanModel;
use App\Models\ExamType;
use DB;
use Illuminate\Support\Facades\Config;

class ExamMasterController extends Controller
{
    // public function index()
    // {
    //     $exammasters = Exammaster::where('is_delete', 0)->get();
    //     $exammasters = Exammaster::where('is_delete', 0)->distinct()->get();
    //     $studentclasses = DB::table('classes')->select('class_name')->get();//Student_registration::select('class_name')->distinct()->get();

    //     // $exammasters = Exammaster::All();
    //     $examtypelist = ExamType::select('examtype')->distinct()->get(); 

    //     return view('backend.AcademicsModules.exammaster', compact('exammasters', 'studentclasses','examtypelist'));
    // }
    

 public function index()
    {
        $exammasters = Exammaster::where('is_delete', 0)->get();
        $examtypelist = ExamType::where('is_delete', 0)->select('examtype')->distinct()->get();
        $studentclasses = DB::table('classes')->select('class_name')->get();
    
        return view('backend.AcademicsModules.exammaster', compact('exammasters', 'studentclasses', 'examtypelist'));
    }
    


    public function create(Request $request)
    {
        // print_r($request->all());

        Exammaster::create($request->post());
        // print_r($request->all());
        // return redirect()->route('exammaster')->with('success',' has been created successfully.');
        return 'success';
    }

    public function view($id)
    {        
        $exam_master = Exammaster::whereId($id)->get();
        // $exammasters = Exammaster::orderBy('id', 'desc');
        $exammasters = Exammaster::where('is_delete', 0)->distinct()->get();

        // $examtypelist = ExamType::where('is_delete', 0)->select('examtype')->distinct()->get();


        if (!empty($exam_master)) {
            $exam_master[count($exam_master)-1 ]->class_name = explode(',', $exam_master[count($exam_master)-1 ]->class_name);
        }
        

        // if (!empty($exam_master)) {
        //     $lastExam = end($exam_master);
        
        //     if ($lastExam !== false) {
        //         $lastExam->class_name = explode(',', $lastExam->class_name);
        //     } else {
        //         // Handle the case where $exam_master is not empty but has no elements
        //         // Log an error or take appropriate action
        //     }
        // } else {
        //     // Handle the case where $exam_master is empty
        //     // Log an error or take appropriate action
        // }
        
        // $examtypelist = ExamType::where('is_delete', 0)->select('examtype')->distinct()->get();

        
        $examtypelist = DB::connection('dynamic')
        ->table('examtypes')
        ->select('examtype')
        ->where('is_delete', '=', 0)
        ->get();//ExamType::select('examtype')->distinct()->get(); 

        $studentclasses = DB::table('classes')->select('class_name')->get();//Student_registration::select('class_name')->distinct()->get();                
        return view('backend.AcademicsModules.exammaster', compact('exam_master', 'exammasters', 'studentclasses','examtypelist'));
    }



    // public function view($id)
    // {
    //     $exam_master = Exammaster::findOrFail($id); // Use findOrFail to automatically handle 404 if not found
    //     $exammasters = Exammaster::where('is_delete', 0)->distinct()->get();
        
    //     $lastExam = $exam_master->isNotEmpty() ? $exam_master->last() : null;
    
    //     if ($lastExam) {
    //         $lastExam->class_name = explode(',', $lastExam->class_name);
    //     }
    
    //     $examtypelist = ExamType::distinct()->pluck('examtype'); // Use pluck to get a flat array
    //     $studentclasses = Student_registration::distinct()->pluck('class_name'); // Use pluck to get a flat array
    
    //     return view('backend.AcademicsModules.exammaster', compact('exam_master', 'exammasters', 'studentclasses', 'examtypelist'));
    // }
    
    public function store(Request $request)
    {
        //   echo 'store';
        // print_r($request->all());
        $exammaster = array(
            "exam_name" => $request->exam_name,
            "max_marks_theory" => $request->max_marks_theory,
            "max_marks_practical" => $request->max_marks_practical,
            "fail_if" => $request->fail_if,
            "exam_type" => $request->exam_type,
            "remarks" => $request->remarks,
            "is_ser" => $request->is_ser,
            "class_name" => $request->class_name,
        );

        Exammaster::whereId($request->id)->update($exammaster);
        return redirect()->route('exammaster')->with('success', ' Updated successfully.');

    }

    public function exam_master_delete($id)
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

    public function delete($id)
    {
        $exammaster = Exammaster::findOrFail($id);
        $exammaster->delete();
        return redirect()->route('exammaster')->with('success', ' Deleted successfully.');
    }

}