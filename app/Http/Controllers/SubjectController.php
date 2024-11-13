<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\CommanModel;


class SubjectController extends Controller
{
    public function index(){
        $datas = Subject::where('is_delete',0)->get();
        return view('backend.AcademicsModules.createsubject',compact('datas'));
    }

    // public function create(Request $request){
    //     Subject::create($request->post());
    //     return redirect()->route('subjectmaster')->with('success',' has been created successfully.');
    // }
    public function create(Request $request)
    {
        // Get subject name from the form
        $subjectName = $request->input('subject_name');
    
        // Check if the subject already exists
        $existingSubject = Subject::where('subject_name', $subjectName)->first();
    
        if ($existingSubject) {
            // Subject already exists, display an error message
            return redirect()->route('subjectmaster')->with('error', 'Subject already exists!');
        } else {
            // Subject does not exist, proceed with insertion
            Subject::create($request->post());
            return redirect()->route('subjectmaster')->with('success', 'Subject has been created successfully.');
        }
    }

    public function view($id){
        $subject_s = Subject::whereId($id)->get();
        $datas = Subject::orderBy('id','desc')->paginate(5);
        return view('backend.AcademicsModules.createsubject',compact('subject_s','datas'));
    }

    public function store(Request $request){
        $data = [
            'subject_name' => $request->subject_name,
            'subject_type' => $request->subject_type,
            'evaluation' => $request->evaluation,
            'practical' => $request->practical,
        ];
        Subject::whereId($request->id)->update($data);
        return redirect()->route('subjectmaster')->with('success','Subject has been Updated successfully.');
    }

    public function subjects_delete($id){
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
}
