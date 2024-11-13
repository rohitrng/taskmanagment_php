<?php

namespace App\Http\Controllers;

use App\Models\SubjectCombination;
use App\Models\CommanModel;
use App\Models\Stream;
use App\Models\Subject;
use App\Models\Classes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SubjectCombinationController extends Controller
{
    public function index()
    {
        $stream = SubjectCombination::where('is_delete', 0)->get();
        $studentclasses = Classes::select('class_name', 'section_name')->distinct()->get();
        $subjects = Subject::all();
        $streamlist = Stream::select('streams')->distinct()->get();        
        return view('backend.AcademicsModules.subjectcombination', compact('stream', 'streamlist', 'studentclasses', 'subjects'));
    }

    // public function create(Request $request)
    // {
    //     SubjectCombination::create($request->post());
    //     $streamlist = Stream::select('streams')->distinct()->get();
    //     return redirect()->route('subjectcombinatiomaster')->with('success', 'Subject combination master has been created successfully.');
    // }

    public function create(Request $request)
    {
        $data = $request->validate([
            'combination_name' => 'required',
            'alise_name' => 'required',
            'streams' => 'required',
            // Add other validation rules for your fields here
        ]);



    
        // Save the validated data to the database
        SubjectCombination::create($data);
    $subjects = Subject::all();
        $streamlist = Stream::select('streams')->distinct()->get();
        return redirect()->route('subjectcombinatiomaster')->with('success', 'Subject combination master has been created successfully.');
    }
    

    // public function view($id)
    // {
    //     $streams = SubjectCombination::whereId($id)->first();
    
    //     if (!$streams) {
    //         return redirect()->route('subjectcombinatiomaster');
    //     }
    
    //     $stream = SubjectCombination::where('is_delete', 0)->get();
    //     $studentclasses = Classes::select('class_name', 'section_name')->distinct()->get();
    //     $subjects = Subject::all();
    //     $streamlist = Stream::select('streams')->distinct()->get();
    
    //     return view('backend.AcademicsModules.subjectcombination', compact('streams', 'stream', 'studentclasses', 'subjects', 'streamlist'));
    // }
    

    // public function view($id)
    // {
    //     $stream_master = SubjectCombination::whereId($id)->get();        
    //     $stream = SubjectCombination::where('is_delete', 0)->get();
    //     $studentclasses = Classes::select('class_name', 'section_name')->distinct()->get();
    //     $subjects = Subject::all();
    //     $streamlist = Stream::select('streams')->distinct()->get();
    //     // return $stream_master;
    //     return view('backend.AcademicsModules.subjectcombination', compact('stream_master','stream', 'studentclasses', 'subjects', 'streamlist'));
    // }




    public function view($id)
    {
        $stream_master = SubjectCombination::whereId($id)->get(); 

        $selected_subjects_json= json_decode($stream_master[0]['selected_subjects_data'],1);
        $selected_classes_json= json_decode($stream_master[0]['selected_classes_data'],1);

        $subject_combination_type = $stream_master[0]['combination_type'];

    //   echo "<pre>";  print_r($json);die();


        // $streams = SubjectCombination::whereId($id)->first();
    
        // if (!$streams) {
        //     return redirect()->route('subjectcombinatiomaster'); // Replace 'subjects.index' with the actual route name.
        // }
    
        $section = SubjectCombination::orderBy('id', 'desc')->paginate(5);
        
        // Rest of your code here
        $stream = SubjectCombination::where('is_delete', 0)->get();
        
        
        $studentclasses = Classes::select('class_name', 'section_name')->distinct()->get();
        $subjects = Subject::all();
        $streamlist = Stream::select('streams')->distinct()->get();

        // return $stream_master;
    
        return view('backend.AcademicsModules.subjectcombination', compact('stream_master', 'subject_combination_type','selected_subjects_json', 'selected_classes_json', 'section', 'stream', 'studentclasses', 'subjects', 'streamlist'));
    }
    
    


    public function fetchSubjects(Request $request)
    {
        $subjects = Subject::all();

        $subjectData = $subjects->map(function ($subject) {
            return [
                'id' => $subject->id,
                'subject_name' => $subject->subject_name,
            ];
        });

        return response()->json(['subjects' => $subjectData]);
    }



    // public function store(Request $request)
    // {
    //     // $request->validate([
    //     //     'combination_name' => 'required',
    //     //     'alise_name' => 'required',
    //     //     'streams' => 'required',
    //     //     'combination_type' => 'required',
    //     //     'selected_subjects_data' => 'required|array',
    //     // ]);

    //     // $subjectCombination = new SubjectCombination();
    //     // $subjectCombination->combination_name = $request->input('combination_name');
    //     // $subjectCombination->alise_name = $request->input('alise_name');
    //     // $subjectCombination->streams = $request->input('streams');
    //     // $subjectCombination->is_academic_comb = $request->input('combination_type') == 'Academic' ? 1 : 0;
    //     // $subjectCombination->selected_subjects_data = json_encode($request->input('selected_subjects_data'));
    //     // $subjectCombination->save();

    //     $insertArr  = [
    //         // 'alise_name'=>$request->form_number,
    //         'combination_name'=>$request->input('combination_name'),
    //         'alise_name'=>$request->input('alise_name'),
    //         'streams'=>$request->input('streams'),
    //         'is_academic_comb'=>$request->input('combination_type') == 'Academic' ? 1 : 0,          
    //         'selected_subjects_data'=>json_encode($request->input('selected_subjects_data')),
    //         'selected_classes_data'=>json_encode($request->input('selected_classes_data'))
    //     ];
        

    //     // return $insertArr;
    //      DB::connection('dynamic')->table('subject_combinations')->insert($insertArr);        
    //      SubjectCombination::whereId($request->id)->update($data);
    //     return response()->json(['message' => "Subject combination created successfully"]);
        
    //     // return redirect()->route('subjectcombinatiomaster')->with('success', 'Subject combination created successfully');
    // }



    public function store(Request $request)
    {
        // Validate the request data here if needed

        $selected_subjects_data = $request->input('selected_subjects_data'); 
        $selected_classes_data = $request->input('selected_classes_data'); 

        // $selected_subjects_data = json_encode($request->input('selected_subjects_data')); 
        // $selected_classes_data = json_encode($request->input('selected_classes_data')); 
    
        if ($request->id) {
            // If an ID is provided, it means you want to update an existing record
            $subjectCombination = SubjectCombination::find($request->id);
    
            if (!$subjectCombination) {
                // Handle the case where the record with the given ID is not found
                return response()->json(['error' => "Subject combination not found"]);
            }

           
            // Update the existing record
            $subjectCombination->update([
                'combination_name' => $request->input('combination_name'),
                'alise_name' => $request->input('alise_name'),
                'streams' => $request->input('streams'),
                'is_academic_comb' => $request->input('combination_type') == 'Academic' ? 1 : 0,
                'combination_type' => $request->input('combination_type'),
                'selected_subjects_data' => $selected_subjects_data,
                'selected_classes_data' => $selected_classes_data
            ]);
    
            return response()->json(['message' => "Subject combination updated successfully"]);
        } else {
            // If no ID is provided, it means you want to insert a new record
            $newSubjectCombination = new SubjectCombination([
                'combination_name' => $request->input('combination_name'),
                'alise_name' => $request->input('alise_name'),
                'streams' => $request->input('streams'),
                'is_academic_comb' => $request->input('combination_type') == 'Academic' ? 1 : 0,
                'combination_type' => $request->input('combination_type'),
                'selected_subjects_data' => $selected_subjects_data,
                'selected_classes_data' => $selected_classes_data
            ]);
    
            $newSubjectCombination->save();
    
            return response()->json(['message' => "Subject combination created successfully"]);
        }
    }
    


    public function subjectcombinatio_master_delete($id)
    {
        $table = 'subject_combinations';
        $delete_resp = CommanModel::soft_delete($table, ['id' => $id]);
        if ($delete_resp == 'TRUE') {
            return redirect()->back()->with('success', 'Record successfully removed');            
        } elseif ($delete_resp == 'FALSE') {
            return redirect()->back()->with('error', 'Record not removed');            
        }
    }

    public function subject_delete(Request $request)
    {
        $table = $request->table_name;
        $delete_resp = CommanModel::soft_delete($table, ['id' => $request->delete_id]);
        if ($delete_resp == 'TRUE') {
            return redirect()->back()->with('success', 'Record successfully removed');
        } elseif ($delete_resp == 'FALSE') {
            return redirect()->back()->with('error', 'Record not removed');
        }
    }

    public function delete($id)
    {
        $stream = SubjectCombination::findOrFail($id);
        $stream->delete();
        return redirect()->route('subjectcombinatiomaster')->with('success', 'Deleted successfully.');
    }
}
