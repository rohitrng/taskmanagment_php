<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use DB;
use App\Models\CommanModel;
use DataTables;
use App\Http\Requests\StoreFileRequest;
use PDF;
use Illuminate\Support\Facades\Config;

class FeesTypesMasterController extends Controller
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
        // $db_name = "hr_project";

        $dynamicConnectionName = 'dynamic';
        $dynamicConfig = Config::get("database.connections.{$dynamicConnectionName}");
        $dynamicConfig['database'] = $db_name;
        Config::set('database.connections.dynamic', $dynamicConfig);
        DB::reconnect('dynamic');
    // print_r($db_name);die();
    }

    public function index(Request $request)
    {
        $fees_types_masterArr = DB::connection('dynamic')->table('fees_types_master')->where('is_delete', 0)->get();
        return view('backend.FeesTypeMaster.index',compact('fees_types_masterArr'));
    }

    public function view(Request $request)
    {
        $mobile_number = $request->post('mobile_number');

        if ($request->ajax()) {
  
            $data = Call::select('call_note')->where('mobile_number',$mobile_number)->latest()->get();
  
            return $data;
            
        }
        
        return view('backend.inquiry');
    }

    public function create(Request $request)
    {

        $insertArr = $request->all();
        unset($insertArr['_token']);
        // check exist

        $request->validate([
            'fees_type' => 'required',
            'session' => 'required',
        ]);

        $isExist =  DB::connection('dynamic')->table('fees_types_master')->select('id')->where('fees_type', $request->fees_type)->exists();    
        
        // if(!$isExist){DB::connection('dynamic')
        DB::connection('dynamic')->table('fees_types_master')->insert($insertArr);
            // CommanModel::insertData('fees_types_master',$insertArr);

        // }else{

        //     CommanModel::updateData('fees_types_master',['id'=>$isExist->id],$insertArr);
        // }

        return redirect()->back()->with('success', 'Fees type master created successfully');  
    }

    public function edit($id)
    {
        $fees_types_masterArr =  DB::connection('dynamic')->table('fees_types_master')->where('id', $id)->first();
        //CommanModel::getRowWhere('fees_types_master',['id'=>$id]);
        return view('backend.FeesTypeMaster.edit',compact('fees_types_masterArr'));
    }

    public function delete(Request $request)
    {
        print_r($request->all());die();
        $table = $request->table_name;
        $delete_resp = DB::connection('dynamic')->table($table)->where('id', $request->delete_id);//CommanModel::soft_delete($table,['id'=>$request->delete_id]);
        if($delete_resp=='TRUE'){
            return redirect()->back()->with('success', 'Record successfully removed');
        }elseif($delete_resp=='FALSE'){
            return redirect()->back()->with('error', 'Record not removed');
        }
    }

    public function update(Request $request)
    {   
        $update_id = $request->update_id;

        $updateArr = $request->all();
        unset($updateArr['_token']);
        unset($updateArr['update_id']);

        $inquiry_data = DB::connection('dynamic')->table('fees_types_master')->where('id', $update_id)->update($updateArr);
        //CommanModel::updateData('fees_types_master',['id'=>$update_id],$updateArr);

        return redirect('fees-types-master')->with('success', 'Fees type master updated successfully');
    }

    public function student_ledger(){

        // $challan_data = CommanModel::fetchDataArr('feesreceiptchallan');

        $data_student_name = DB::connection('dynamic')->table('student_registration')->select('student_name','id')->where('status','=','r')->get();

        // print_r($challan_data);
        // die();


        return view('backend.FeesTypeMaster.ledgershow',compact('data_student_name'));
    }
    public function cancle_student_ledger(){

        // $challan_data = CommanModel::fetchDataArr('feesreceiptchallan');

        // $data_student_name = DB::connection('dynamic')->table('inquiry_registration')->select('student_name','id')->get();

        $response = DB::table('inquiry_registration')
        ->select('inquiry_registration.*', 'student_registration.scholar_no')
        ->join('student_registration', 'student_registration.form_number', '=', 'inquiry_registration.form_number')
        ->get();
    
        $data_student_name = $response;

        // print_r($challan_data);
        // die();


        return view('backend.FeesTypeMaster.canclestudentledgershow',compact('data_student_name'));
    }

    public function search_student_ledger(Request $request){

        $student_id = $request->student_id;
        $totalnextyear = DB::connection('dynamic')->table('totalnextyear')->where('scholar_no',$request->scholar_number)->get();
        
        $feesreceiptchallan_student_data = DB::connection('dynamic')->table('feesreceiptchallan')->select('str_json')->where('student_id',$student_id)->get();

        if(!empty($feesreceiptchallan_student_data[0])){
            $feesreceiptchallan_student_data_json = json_decode($feesreceiptchallan_student_data[0]->str_json);
            // $name_formno = $feesreceiptchallan_student_data_json->name_formno;
        }

        $challan_data = DB::connection('dynamic')->table('feesreceiptchallan')->where('student_id', $student_id)->get();

        $student_data = DB::connection('dynamic')->table('student_registration')->where('id', $student_id)->first();

        $data_student_name = DB::connection('dynamic')->table('student_registration')->select('student_name','id')->get();

        return view('backend.FeesTypeMaster.ledgershow',compact('data_student_name','challan_data','student_data', 'student_id','totalnextyear'));
    }
    // public function search_cancle_student_ledger(Request $request){
    //     // print_r($request->all());exit;

    //     $student_id = $request->student_id;

    //     $feesreceiptchallan_student_data = DB::connection('dynamic')->table('feesreceiptchallan')->select('str_json')->where('student_id',$student_id)->get();

    //     if(!empty($feesreceiptchallan_student_data[0])){
    //         $feesreceiptchallan_student_data_json = json_decode($feesreceiptchallan_student_data[0]->str_json);
    //         // $name_formno = $feesreceiptchallan_student_data_json->name_formno;
    //     }

    //     $challan_data = DB::connection('dynamic')->table('feesreceiptchallan')->where('student_id', $student_id)->get();

    //     $student_data = DB::connection('dynamic')->table('student_registration')->where('id', $student_id)->first();

    //     $data_student_name = DB::connection('dynamic')->table('inquiry_registration')->select('student_name','id')->get();
    //     // print_r($challan_data);exit;

    //     return view('backend.FeesTypeMaster.canclestudentledgershow',compact('data_student_name','challan_data','student_data', 'student_id'));
    // }

    public function search_cancle_student_ledger(Request $request){
        $student_id = $request->student_id;
    
        $feesreceiptchallan_student_data = DB::connection('dynamic')->table('feesreceiptchallan')->select('str_json')->where('student_id',$student_id)->get();
    
        if(!empty($feesreceiptchallan_student_data[0])){
            $feesreceiptchallan_student_data_json = json_decode($feesreceiptchallan_student_data[0]->str_json);
        }
    
        $challan_data = DB::connection('dynamic')->table('feesreceiptchallan')->where('student_id', $student_id)->get();
    
        $student_data = DB::connection('dynamic')->table('student_registration')->where('id', $student_id)->first();
    
        // $data_student_name = DB::connection('dynamic')->table('inquiry_registration')->select('student_name','id')->get();
        $response = DB::table('inquiry_registration')
        ->select('inquiry_registration.*', 'student_registration.scholar_no')
        ->join('student_registration', 'student_registration.form_number', '=', 'inquiry_registration.form_number')
        ->get();
    
        $data_student_name = $response;
    
        // Check if "All Students" option is selected
        if ($request->search_student == 'all') {
            $student_id = null; // Set student_id to null to fetch data for all students
        }
    
        return view('backend.FeesTypeMaster.canclestudentledgershow', compact('data_student_name', 'challan_data', 'student_data', 'student_id'));
    }
    










    public function  student_ledger_delete($id)
    {
        // echo $id;
        // exit;
        $a = explode('-',$id);
        $b = $a[1];        
        $c = $a[0];
        // print_r($c);exit;
        $delete_resp = DB::connection('dynamic')->table($c)->where('id', $b);
        //CommanModel::soft_delete($c,['id'=>$b]);
        if($delete_resp=='TRUE'){
            return redirect('cancle_student_ledger')->with('success', 'Record successfully removed');
        }elseif($delete_resp=='FALSE'){
            return redirect('cancle_student_ledger')->with('error', 'Record not removed');
        }
    }
    public function registerstaff(Request $request){
         echo"<pre>";
         print_r($request->all());
    }
    public function view_student_ledger($id){
        
        return view('backend.FeesTypeMaster.view_student_ledger');

    }


    public function export_stu_Pdf($id){

        $student_id = $id;

        $feesreceiptchallan_student_data = DB::table('feesreceiptchallan')->select('str_json')->where('student_id',$student_id)->get();

        if(!empty($feesreceiptchallan_student_data[0])){
            $feesreceiptchallan_student_data_json = json_decode($feesreceiptchallan_student_data[0]->str_json);
            // $name_formno = $feesreceiptchallan_student_data_json->name_formno;
        }

        $challan_data = DB::table('feesreceiptchallan')->where('student_id', $student_id)->get();

        $student_data = DB::table('student_registration')->where('id', $student_id)->first();

        $data_student_name = DB::table('inquiry_registration')->select('student_name','id')->get();        
                           
        $pdf = PDF::loadView('backend.FeesTypeMaster.ledgershow_pdf', compact('data_student_name','challan_data','student_data'));
        return $pdf->download('Student-ledger.pdf');
    }


}