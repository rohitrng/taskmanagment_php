<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\CommanModel;

class SectionController extends Controller
{
    public function index(){
        $section = Section::orderBy('id','desc')->paginate(5);
        return view('backend.AcademicsModules.section', compact('section'));
    }

    public function create(Request $request){
        Section::create($request->post());
        return redirect()->route('sectionmaster')->with('success',' has been created successfully.');
    }

    public function view($id){
        $section_master = Section::whereId($id)->get();
        $section = Section::orderBy('id','desc')->paginate(5);
        return view('backend.AcademicsModules.section', compact('section_master','section'));
    }

    public function store(Request $request){
        $data = [
            'section' => $request->section,
            'remark' => $request->remark,
        ];
        Section::whereId($request->id)->update($data);
        return redirect()->route('sectionmaster')->with('success','Section has been Updated successfully.');
    }

    
    public function section_master_delete($id)
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
        $section = Section::findOrFail($id);
        $section->delete();
        return redirect()->route('sectionmaster')->with('success','Deleted successfully.');
    }
}
