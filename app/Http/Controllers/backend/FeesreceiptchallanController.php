<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feesreceiptchallan;
use App\Models\Student_registration;
use App\Models\Generate_duechartstatus;
use DB;
use App\Models\Course_fees_head_master;
use App\Models\Late_fees_master;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

class FeesreceiptchallanController extends Controller
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

    }

    public function index(){
        $data_student_name = DB::connection('dynamic')->table('student_registration')->select('id','student_name','form_number')->where('type','s')->get();
        $course_fees_head_orders_list_arr = DB::connection('dynamic')->table('course_fees_head_master')->orderBy('order','ASC')->get();
        // echo"<pre>";print_r($$course_fees_head_orders_list_arr);exit;
        $late_fees_master = DB::connection('dynamic')->table('late_fees_master')->where('id',1)->first();
        $lumpsum_fees = DB::connection('dynamic')->table('fees_types_master')->where('fees_type','=','Lum Sum Rebate')->first();
        $siblings = DB::connection('dynamic')->table('fees_types_master')->where('fees_type','=','Sibling')->first();
        $staff_ward = DB::connection('dynamic')->table('fees_types_master')->where('fees_type','=','Staff Ward')->first();
        $lvn = DB::connection('dynamic')->table('fees_types_master')->where('fees_type','=','Member OF Lokmanya Shiksha Samiti')->first();
        return view('backend.Fees-module.Fees_receipt_challan',compact('data_student_name','course_fees_head_orders_list_arr','late_fees_master','lumpsum_fees','siblings','staff_ward','lvn'));
    }

    public function search_student_name(Request $request){
        $result = DB::connection('dynamic')->table('inquiry_registration')->select('student_name','id')->where("student_name","LIKE", "%{$request->post('student_name')}%")->get();
        return json_encode($result);
    }

    public function get_student_info(Request $request){
        $result = DB::connection('dynamic')->table('student_registration')->where('id',$request->post('student_id'))->first();//Student_registration::where('id',$request->post('student_id'))->first();
        $due_chart_data = DB::connection('dynamic')->table('feesreceiptchallan')->select('str_json')->where('student_id',$request->post('student_id'))->first();//Feesreceiptchallan::select('str_json')->where('student_id',$request->post('student_id'))->first();

        $due_dates = DB::connection('dynamic')->table('course_fees_structure_master')->select('json_str')->where('class_name','=',$result->class_name)->first();
        
        $due_dates_j = (!empty($due_dates)) ? json_decode($due_dates->json_str,1) : '' ;
        $due_dates_ja = (!empty($due_dates_j)) ? $due_dates_j['due_date'] : '' ;
        // $due_dates_j = json_decode($due_dates->json_str,1);
        // $due_dates_ja = $due_dates_j['due_date'];

       $course_fees_head_orders_list_arr = DB::connection('dynamic')->table('course_fees_head_master')->select('ac_head_name')->orderBy('order','ASC')->get();

       $arr = json_decode($result->json_str,1);
    //    print_r($arr['is_sibling_applied_for_admission']);die();
        $result1 = [];
        $data2 = [];
        foreach($arr as $k => $ar){

            if('fathername' == $k) {
                $result->fathername = $ar;
                $data[] = [
                        $k => $ar,             
                ];
            }
            if('siblings_name' == $k) {
                $result1['1'] = [
                    $k => $ar,
                ];
            }
        }
        
        $data_dt[] = ['adm_dt' => $result->created_at];
        $data1 = array_merge($data,$data_dt);

        for ($i=0;$i<count($data1);$i++){
            $data2 = [
                'formno' => (!empty($result->form_number)) ? $result->form_number : '',
                'student_name' => (!empty($result->student_name)) ? $result->student_name : '',
                'fathername' => (!empty($result->fathername)) ? $result->fathername : '',
                'scholar_no' => (!empty($result->scholar_no)) ? $result->scholar_no : '',
                // 'siblings' => (!empty($result1['siblings_name'])) ? $result1['siblings_name'] : '',
                'adm_dt' => (!empty($result->created_at)) ? $result->created_at : '',
                'class_name' => (!empty($result->class_name)) ? $result->class_name : '',
                'fee_commitment_remarks' => (!empty($result->fee_commitment_remarks)) ? $result->fee_commitment_remarks : '',
                'due_upto' => (!empty($due_dates_ja)) ? array_unique($due_dates_ja) : '' ,
            ];
        }

        // if(!empty($due_chart_data) && $due_chart_data->json_str!==null){
            
        //     $json_str_arr = json_decode($due_chart_data->json_str,1);
        //     $decode_json = json_decode($json_str_arr[0]['json_str'],1);
        //     $result = [];
        //     $demoIndex = 1;
        //     for ($i = 0; $i < count($decode_json["fees_date"]); $i++) {
        //         $demoData = [
        //             "fees_date" => $decode_json["fees_date"][$i],
        //             "account_name" => $decode_json["account_name"][$i],
        //             "fees" => $decode_json["fees"][$i],
        //             "due_date" => $decode_json["due_date"][$i],
        //             "term" => $decode_json["term"][$i]
        //         ];
        //         $result["Demo" . $demoIndex] = $demoData;
        //         $demoIndex++;
        //     }

        //     $data2['due_chart_data'] = $result;
        // }
        $data2['siblings'] = (!empty($arr['is_sibling_applied_for_admission']) ? $arr['is_sibling_applied_for_admission'] : '0');
        $data2['course_fees_head_orders_list_arr'] = $course_fees_head_orders_list_arr;
        // $data2['generate_due_chat'] = $generate_due_chat;
        return json_encode($data2);
    }

    public function student_fees_leadger(){
        $user = auth()->user();
        $sessionId = Auth::user()->id;
        $challan_data = DB::connection('dynamic')->table('feesreceiptchallan')->where('student_id', $sessionId)->get();
        $student_data = DB::connection('dynamic')->table('student_registration')->where('id', $sessionId)->first();
        return view('backend.student_panel.studentledgershow',compact('challan_data','student_data')); 
        // print_r($data);exit;

    }
    public function get_student_fees_struct(Request $request){

        $generate_due = DB::connection('dynamic')->table('generate_duechartstatus')->where('student_id','=',$request->post('student_id'))->first();
        $generate_due_j = json_decode($generate_due->json_str,1);
        $generate_due_chat = json_decode($generate_due_j[0]['json_str']);

        $due_chart_data = DB::connection('dynamic')->table('feesreceiptchallan')->select('str_json')->where('student_id','=',$request->post('student_id'))->get();
        $data2 = [];
        $advance_received = 0;
        $tuition_amount_ = 0;
        if(!empty($due_chart_data)){
            
            $json_str_arr = json_decode($due_chart_data,1);
            // $decode_json = json_decode('{"head_name":"ADMISSION FEES,ALUMNI FEES,CUATION MONEY","head_due_amount":"3000,1050,2000","head_rec_ammount":"3000,,","term_str":"1st,1st,1st","head_to_date":"2023-08-10,2023-08-10,2023-08-10","head_due_date":"2023-08-24,2023-08-24,2023-08-24","name_father":"Balram Prajapat","name_classsection":null,"name_admdt":"2023-07-18T09:29:21.000000Z","name_formno":"7303","name_scholarno":null,"feestype":"0","total_dueamount":null,"fee_commitment_remarks":null,"received_amount_details_remarks":null,"by_cash":"3000","late_fees_rate":"23434","late_fees_rate_due":null,"late_fees_rate_received":null,"payment_by_select":null,"late_fees_waive_off_due":null,"late_fees_waive_off_received":null,"from_employee":null,"old_advance_fees_due":null,"old_advance_fees_received":null,"from_party":null,"transfer_to_party":null,"late_fees_on_posting_due":null,"late_fees_on_posting_received":null,"advance_due":null,"advance_received":null,"late_fees_account":null,"advance_fees_account":null}',1);
            $result = [];
            $demoIndex = 1;
            foreach($json_str_arr as $json_str){
                $json_str_json = json_decode($json_str['str_json'],1);
                $head_names = explode(',', $json_str_json['head_name']);
                $head_due_amount = explode(',', $json_str_json['head_due_amount']);
                $head_rec_ammount = explode(',', $json_str_json['head_rec_ammount']);
                $term_str = explode(',', $json_str_json['term_str']);
                $head_to_date = explode(',', $json_str_json['head_to_date']);
                $head_due_date = explode(',', $json_str_json['head_due_date']);
                $advance_received = $json_str_json['advance_received'];
                $tuition_amount_ = $json_str_json['tuition_amount_'];
                for ($i = 0; $i < count($head_names); $i++) {
                    if($head_due_amount[$i] === $head_rec_ammount[$i]){
                        $demoData = [
                            "head_name" => $head_names[$i],
                            "head_due_amount" => $head_due_amount[$i],
                            "head_rec_ammount" => $head_rec_ammount[$i],
                            "term_str" => $term_str[$i],
                            "head_to_date" => $head_to_date[$i],
                            "head_due_date" => $head_due_date[$i],
                        ];
                    } else {
                        $demoData = [
                            "head_name" => $head_names[$i],
                            "head_due_amount" => $head_due_amount[$i],
                            "head_rec_ammount" => $head_rec_ammount[$i],
                            "term_str" => $term_str[$i],
                            "head_to_date" => $head_to_date[$i],
                            "head_due_date" => $head_due_date[$i],
                        ];
                        
                    }
                    $demoIndex++;
                    $result[$demoIndex] = $demoData;
                    $demoIndex++;
                }
                
            }
            $uniqueData = [];

            foreach ($result as $key => $value) {
                $headName = $value['head_name'].'_'.$value['term_str'];
                $headRecAmount = $value['head_rec_ammount'];
            
                if (!isset($uniqueData[$headName])) {
                    $uniqueData[$headName] = [
                        "head_name" => $value['head_name'],
                        "head_due_amount" => $value['head_due_amount'],
                        "term_str" => $value['term_str'],
                        "head_to_date" => $value['head_to_date'],
                        "head_due_date" => $value['head_due_date'],
                        'head_rec_ammount' => 0,
                    ];
                }
            
                // Calculate the total received amount for each head_name
                if (!empty($headRecAmount)) {
                    $uniqueData[$headName]['head_rec_ammount'] += (float) $headRecAmount;
                }
            }

            $finalUniqueData = array_values($uniqueData);

            
            // $head_names = explode(',', $json_str_arr['head_name']);
            // $head_due_amount = explode(',', $json_str_arr['head_due_amount']);
            // $head_rec_ammount = explode(',', $json_str_arr['head_rec_ammount']);
            // $term_str = explode(',', $json_str_arr['term_str']);
            // $head_to_date = explode(',', $json_str_arr['head_to_date']);
            // $head_due_date = explode(',', $json_str_arr['head_due_date']);

            // for ($i = 0; $i < count($head_names); $i++) {
            //     if($head_due_amount[$i] === $head_rec_ammount[$i]){
            //         $demoData = [
            //             "head_name" => $head_names[$i],
                        // "head_due_amount" => $head_due_amount[$i],
                        // "head_rec_ammount" => $head_rec_ammount[$i],
                        // "term_str" => $term_str[$i],
                        // "head_to_date" => $head_to_date[$i],
                        // "head_due_date" => $head_due_date[$i],
            //         ];
            //         $demoIndex++;
            //     }
            //     $result["Demo" . $demoIndex] = $demoData;
            //     // $demoIndex++;
            // }

            $data2['due_chart_data']= $finalUniqueData;
        }
        $data2['advance_received'] = $advance_received;
        $data2['generate_due_chat'] = $generate_due_chat;
        $data2['tuition_amount_'] = $tuition_amount_;
        return json_encode($data2);
    }

    public function get_student_fees_struct_view(Request $request){

        $generate_due = DB::connection('dynamic')->table('generate_duechartstatus')->where('student_id','=',$request->post('student_id'))->first();
        $generate_due_j = json_decode($generate_due->json_str,1);
        $generate_due_chat = json_decode($generate_due_j[0]['json_str']);

        $due_chart_data = DB::connection('dynamic')->table('feesreceiptchallan')->select('str_json')->where('student_id','=',$request->post('student_id'))->where('due_upto','=',$request->post('date'))->get();
        $all_value_s = DB::connection('dynamic')->table('feesreceiptchallan')->select('str_json')->where('student_id','=',$request->post('student_id'))->where('due_upto','=',$request->post('date'))->get();
        
        $data2 = [];
        $advance_received = 0;
        if(!empty($due_chart_data)){
            
            $json_str_arr = json_decode($due_chart_data,1);
            $json_all_value = json_decode($all_value_s,1);
            // $decode_json = json_decode('{"head_name":"ADMISSION FEES,ALUMNI FEES,CUATION MONEY","head_due_amount":"3000,1050,2000","head_rec_ammount":"3000,,","term_str":"1st,1st,1st","head_to_date":"2023-08-10,2023-08-10,2023-08-10","head_due_date":"2023-08-24,2023-08-24,2023-08-24","name_father":"Balram Prajapat","name_classsection":null,"name_admdt":"2023-07-18T09:29:21.000000Z","name_formno":"7303","name_scholarno":null,"feestype":"0","total_dueamount":null,"fee_commitment_remarks":null,"received_amount_details_remarks":null,"by_cash":"3000","late_fees_rate":"23434","late_fees_rate_due":null,"late_fees_rate_received":null,"payment_by_select":null,"late_fees_waive_off_due":null,"late_fees_waive_off_received":null,"from_employee":null,"old_advance_fees_due":null,"old_advance_fees_received":null,"from_party":null,"transfer_to_party":null,"late_fees_on_posting_due":null,"late_fees_on_posting_received":null,"advance_due":null,"advance_received":null,"late_fees_account":null,"advance_fees_account":null}',1);
            $result = [];
            $demoIndex = 1;
            foreach($json_all_value as $json_str){
                $objs = json_decode($json_str['str_json'],1);
                $all_value = [
                    'by_cash' => $objs['by_cash'],
                    // 'payment_by' => $json_str_json['payment_by'],
                    'payment_by_select' => $objs['payment_by_select'],
                    'total_received' => $objs['total_received'],
                    'balance_f' => $objs['balance_f'],
                    'late_fees_rate_due' => $objs['late_fees_rate_due'],
                    'late_fees_rate_received' => $objs['late_fees_rate_received'],
                    'late_fees_waive_off_due' => $objs['late_fees_waive_off_due'],
                    'old_advance_fees_due' => $objs['old_advance_fees_due'],
                    'old_advance_fees_received' => $objs['old_advance_fees_received'],
                    'sub_total_due' => $objs['sub_total_due'],
                    'sub_total_received' => $objs['sub_total_received'],
                    'late_fees_on_posting_due' => $objs['late_fees_on_posting_due'],
                    'late_fees_on_posting_received' => $objs['late_fees_on_posting_received'],
                    'advance_received' => $objs['advance_received'],
                    'grand_total_due' => $objs['grand_total_due'],
                    'grand_total_received' => $objs['grand_total_received'],
                    'balance_due' => $objs['balance_due'],
                    'late_fees_account' => $objs['late_fees_account'],
                    'advance_fees_account' => $objs['advance_fees_account'],
                ];
            }

            foreach($json_str_arr as $json_str){
                $json_str_json = json_decode($json_str['str_json'],1);
                $head_names = explode(',', $json_str_json['head_name']);
                $head_due_amount = explode(',', $json_str_json['head_due_amount']);
                $head_rec_ammount = explode(',', $json_str_json['head_rec_ammount']);
                $term_str = explode(',', $json_str_json['term_str']);
                $head_to_date = explode(',', $json_str_json['head_to_date']);
                $head_due_date = explode(',', $json_str_json['head_due_date']);
                $advance_received = $json_str_json['advance_received'];
                for ($i = 0; $i < count($head_names); $i++) {
                    if($head_due_amount[$i] === $head_rec_ammount[$i]){
                        $demoData = [
                            "head_name" => $head_names[$i],
                            "head_due_amount" => $head_due_amount[$i],
                            "head_rec_ammount" => $head_rec_ammount[$i],
                            "term_str" => $term_str[$i],
                            "head_to_date" => $head_to_date[$i],
                            "head_due_date" => $head_due_date[$i],
                        ];
                    } else {
                        $demoData = [
                            "head_name" => $head_names[$i],
                            "head_due_amount" => $head_due_amount[$i],
                            "head_rec_ammount" => $head_rec_ammount[$i],
                            "term_str" => $term_str[$i],
                            "head_to_date" => $head_to_date[$i],
                            "head_due_date" => $head_due_date[$i],
                        ];
                        
                    }
                    $demoIndex++;
                    $result[$demoIndex] = $demoData;
                    $demoIndex++;
                }
                
            }
            $uniqueData = [];

            foreach ($result as $key => $value) {
                $headName = $value['head_name'].'_'.$value['term_str'];
                $headRecAmount = $value['head_rec_ammount'];
            
                if (!isset($uniqueData[$headName])) {
                    $uniqueData[$headName] = [
                        "head_name" => $value['head_name'],
                        "head_due_amount" => $value['head_due_amount'],
                        "term_str" => $value['term_str'],
                        "head_to_date" => $value['head_to_date'],
                        "head_due_date" => $value['head_due_date'],
                        'head_rec_ammount' => 0,
                    ];
                }
            
                // Calculate the total received amount for each head_name
                if (!empty($headRecAmount)) {
                    $uniqueData[$headName]['head_rec_ammount'] += (float) $headRecAmount;
                }
            }

            $finalUniqueData = array_values($uniqueData);

            
            // $head_names = explode(',', $json_str_arr['head_name']);
            // $head_due_amount = explode(',', $json_str_arr['head_due_amount']);
            // $head_rec_ammount = explode(',', $json_str_arr['head_rec_ammount']);
            // $term_str = explode(',', $json_str_arr['term_str']);
            // $head_to_date = explode(',', $json_str_arr['head_to_date']);
            // $head_due_date = explode(',', $json_str_arr['head_due_date']);

            // for ($i = 0; $i < count($head_names); $i++) {
            //     if($head_due_amount[$i] === $head_rec_ammount[$i]){
            //         $demoData = [
            //             "head_name" => $head_names[$i],
                        // "head_due_amount" => $head_due_amount[$i],
                        // "head_rec_ammount" => $head_rec_ammount[$i],
                        // "term_str" => $term_str[$i],
                        // "head_to_date" => $head_to_date[$i],
                        // "head_due_date" => $head_due_date[$i],
            //         ];
            //         $demoIndex++;
            //     }
            //     $result["Demo" . $demoIndex] = $demoData;
            //     // $demoIndex++;
            // }

            $data2['due_chart_data']= $finalUniqueData;
        }
        $data2['advance_received'] = $advance_received;
        $data2['generate_due_chat'] = $generate_due_chat;
        $data2['all_value'] = $all_value;
        return json_encode($data2);
    }

    public function save_feesreceipt_challan(Request $request){
        $check = DB::connection('dynamic')->table('feesreceiptchallan')->where('student_id','=',$request->post('search_student'))->first();
        // print_r($check);die();

        if(empty($check)){
            $json = [
                'head_name' => implode(',', $request->post('head_name1')),
                'head_due_amount' => implode(',', $request->post('head_due_amount1')),
                'head_rec_ammount' => implode(',', $request->post('head_rec_ammount1')),
                // 'head_from_ammount' => implode(',', $request->post('head_from_ammount')),
                'term_str' => implode(',',$request->post('term_str1')),
                'head_to_date' => implode(',', $request->post('head_to_date1')),
                'head_due_date' => implode(',', $request->post('head_due_date1')),
                'tuition_amount_' => $request->post('tuition_amount_'),
                'name_father' => $request->post('name_father'),
                'name_classsection' => $request->post('name_classsection'),
                'name_admdt' => $request->post('name_admdt'),
                'name_formno' => $request->post('name_formno'),
                'name_scholarno' => $request->post('name_scholarno'),
                'feestype' => $request->post('feestype'),
                'total_dueamount' => $request->post('hidden_total_dueamount'),
                'sub_total_due' => $request->post('hidden_sub_total_due'),
                'sub_total_received' => $request->post('hidden_sub_total_received'),
                'total_received' => $request->post('hidden_total_received'),
                'balance_f' => $request->post('hidden_balance_f'),
                'grand_total_due' => $request->post('hidden_grand_total_due'),
                'grand_total_received' => $request->post('hidden_grand_total_received'),
                'balance_due' => $request->post('hidden_balance_due'),
                'fee_commitment_remarks' => $request->post('fee_commitment_remarks'),
                'received_amount_details_remarks' => $request->post('received_amount_details_remarks'),
                'by_cash' => $request->post('by_cash'),
                'late_fees_rate' => $request->post('late_fees_rate'),
                'late_fees_rate_due' => $request->post('late_fees_rate_due'),
                'late_fees_rate_received' => $request->post('late_fees_rate_received'),
                'payment_by_select' => $request->post('payment_by_select'),
                'late_fees_waive_off_due' => $request->post('late_fees_waive_off_due'),
                'late_fees_waive_off_received' => $request->post('late_fees_waive_off_received'),
                'from_employee' => $request->post('from_employee'),
                'old_advance_fees_due' => $request->post('old_advance_fees_due'),
                'old_advance_fees_received' => $request->post('old_advance_fees_received'),
                'from_party' => $request->post('from_party'),
                'transfer_to_party' => $request->post('transfer_to_party'),
                'late_fees_on_posting_due' => $request->post('late_fees_on_posting_due'),
                'late_fees_on_posting_received' => $request->post('late_fees_on_posting_received'),
                'advance_due' => $request->post('advance_due'),
                'advance_received' => $request->post('hidden_advance_received'),
                'late_fees_account' => $request->post('late_fees_account'),
                'advance_fees_account' => $request->post('advance_fees_account'),
            ];
            $data = [
                'student_id' => $request->post('search_student'),
                'student_dob' => $request->post('student_dob'),
                'recpt_chain' => $request->post('recpt_chain'),
                'due_upto' => $request->post('due_upto'),
                'name_student' => $request->post('name_student'),
                'str_json' => json_encode($json),
            ];
            $cfs_list = DB::connection('dynamic')->table('feesreceiptchallan')->insert($data);//Feesreceiptchallan::Create($data);
        }

        $json = [
            'head_name' => implode(',', $request->post('head_name')),
            'head_due_amount' => implode(',', $request->post('head_due_amount')),
            'head_rec_ammount' => implode(',', $request->post('head_rec_ammount')),
            // 'head_from_ammount' => implode(',', $request->post('head_from_ammount')),
            'term_str' => implode(',',$request->post('term_str')),
            'head_to_date' => implode(',', $request->post('head_to_date')),
            'head_due_date' => implode(',', $request->post('head_due_date')),
            'tuition_amount_' => $request->post('tuition_amount_'),
            'name_father' => $request->post('name_father'),
            'name_classsection' => $request->post('name_classsection'),
            'name_admdt' => $request->post('name_admdt'),
            'name_formno' => $request->post('name_formno'),
            'name_scholarno' => $request->post('name_scholarno'),
            'feestype' => $request->post('feestype'),
            'total_dueamount' => $request->post('hidden_total_dueamount'),
            'sub_total_due' => $request->post('hidden_sub_total_due'),
            'sub_total_received' => $request->post('hidden_sub_total_received'),
            'total_received' => $request->post('hidden_total_received'),
            'balance_f' => $request->post('hidden_balance_f'),
            'grand_total_due' => $request->post('hidden_grand_total_due'),
            'grand_total_received' => $request->post('hidden_grand_total_received'),
            'balance_due' => $request->post('hidden_balance_due'),
            'fee_commitment_remarks' => $request->post('fee_commitment_remarks'),
            'received_amount_details_remarks' => $request->post('received_amount_details_remarks'),
            'by_cash' => $request->post('by_cash'),
            'late_fees_rate' => $request->post('late_fees_rate'),
            'late_fees_rate_due' => $request->post('late_fees_rate_due'),
            'late_fees_rate_received' => $request->post('late_fees_rate_received'),
            'payment_by_select' => $request->post('payment_by_select'),
            'late_fees_waive_off_due' => $request->post('late_fees_waive_off_due'),
            'late_fees_waive_off_received' => $request->post('late_fees_waive_off_received'),
            'from_employee' => $request->post('from_employee'),
            'old_advance_fees_due' => $request->post('old_advance_fees_due'),
            'old_advance_fees_received' => $request->post('old_advance_fees_received'),
            'from_party' => $request->post('from_party'),
            'transfer_to_party' => $request->post('transfer_to_party'),
            'late_fees_on_posting_due' => $request->post('late_fees_on_posting_due'),
            'late_fees_on_posting_received' => $request->post('late_fees_on_posting_received'),
            'advance_due' => $request->post('advance_due'),
            'advance_received' => $request->post('hidden_advance_received'),
            'late_fees_account' => $request->post('late_fees_account'),
            'advance_fees_account' => $request->post('advance_fees_account'),
        ];
        $data = [
            'student_id' => $request->post('search_student'),
            'student_dob' => $request->post('student_dob'),
            'recpt_chain' => $request->post('recpt_chain'),
            'due_upto' => $request->post('due_upto'),
            'name_student' => $request->post('name_student'),
            'str_json' => json_encode($json),
        ];
        $cfs_list = DB::connection('dynamic')->table('feesreceiptchallan')->insert($data);//Feesreceiptchallan::Create($data);
        // echo '<pre>';
        // print_r($request->post());
        // die();
        return redirect()->back()->with('success','Fees Structure created successfully');
    }

    public function save_feesreceipt_challan_public(Request $request){
        $db_name = "hr_project";
        $dynamicConnectionName = 'dynamic';
        $dynamicConfig = Config::get("database.connections.{$dynamicConnectionName}");
        $dynamicConfig['database'] = $db_name;
        Config::set('database.connections.dynamic', $dynamicConfig);
        DB::reconnect('dynamic');

        $TotelTermAmount = $request->post('TotelTermAmount');
        $student_id = DB::connection('dynamic')->table('student_registration')->where('scholar_no','=',$request->post('student_id'))->first();
        $json_array_student = json_decode($student_id->json_str);
        $data_amount = $request->post('data_amount');
        $matchedValues1 = array();
        $check = DB::connection('dynamic')->table('feesreceiptchallan')->where('student_id','=',$student_id->id)->first();
        if(!$check){
            $update = DB::connection('dynamic')->table('generate_duechartstatus')->where('student_id','=',$student_id->id)->first();
            $json_arr = json_decode($update->json_str,true);
            $json_data = json_decode($json_arr[0]['json_str']);

            foreach ($json_data as $key => $termValue) {
                foreach($termValue as $val){
                    $matchedValues1[$key][] = $val;
                    $matchedValues1['fees_rec'][] = '';
                }
            }

            $json = [
                'head_name' => implode(',', $matchedValues1['account_name']),
                'head_due_amount' => implode(',', $matchedValues1['fees']),
                'head_rec_ammount' => implode(',', $matchedValues1['fees_rec']),
                // // 'head_from_ammount' => implode(',', $request->post('head_from_ammount')),
                'term_str' => implode(',',$matchedValues1['term']),
                'head_to_date' => implode(',', $matchedValues1['fees_date']),
                'head_due_date' => implode(',', $matchedValues1['due_date']),
                'tuition_amount_' => "",
                'name_father' => $json_array_student->fathername,
                'name_classsection' => "",
                'name_admdt' => "",
                'name_formno' => $json_array_student->form_number,
                'name_scholarno' => $json_array_student->scholar_no,
                'feestype' => "",
                'total_dueamount' => $TotelTermAmount,
                'sub_total_due' => $TotelTermAmount,
                'sub_total_received' => "",
                'total_received' => "",
                'balance_f' => "",
                'grand_total_due' => $TotelTermAmount,
                'grand_total_received' => $TotelTermAmount,
                'balance_due' => "",
                'fee_commitment_remarks' => "",
                'received_amount_details_remarks' => "",
                'by_cash' => $TotelTermAmount,
                'late_fees_rate' => "",
                'late_fees_rate_due' => "",
                'late_fees_rate_received' => "",
                'payment_by_select' => "",
                'late_fees_waive_off_due' => "",
                'late_fees_waive_off_received' => "",
                'from_employee' => "",
                'old_advance_fees_due' => "",
                'old_advance_fees_received' => "",
                'from_party' => "",
                'transfer_to_party' => "",
                'late_fees_on_posting_due' => "",
                'late_fees_on_posting_received' => "",
                'advance_due' => "",
                'advance_received' => "",
                'late_fees_account' => "",
                'advance_fees_account' => "",
            ];

            $data = [
                'student_id' => $student_id->id,
                'student_dob' => $student_id->date_of_birth,
                // 'recpt_chain' => $request->post('recpt_chain'),
                // 'due_upto' => $request->post('due_upto'),
                'name_student' => $student_id->student_name,
                'str_json' => json_encode($json),
            ];
            // print_r($data);die();
            $cfs_list = DB::connection('dynamic')->table('feesreceiptchallan')->insert($data);//Feesreceiptchallan::Create($data);
        }
        $busInstallmentFee = $request->post('hiddenInput_busInstallmentFee');
        $indexbus = $request->post('hiddenInput_indexbus');
        $bus_data = array();
        if (!empty($busInstallmentFee)){
            for ($i = 0; $i < count($busInstallmentFee); $i++) {
                $bus_data[] = array(
                    'busInstallmentFee' => $busInstallmentFee[$i],
                    'indexbus' => $indexbus[$i]
                );
            }
        }
        
        $g_duechart = DB::connection('dynamic')->table('generate_duechartstatus')->where('student_id','=',$student_id->id)->first();
        $g_json_to_array = json_decode($g_duechart->json_str);
        $g_json_str_arr = json_decode($g_json_to_array[0]->json_str);
        $term = $request->post('hiddentermsArray');

        
        $matchedValues = array();

        foreach ($g_json_str_arr->term as $key => $value) {
            foreach ($term as $termValue) {
                if ($value == $termValue) {
                    // Add values to the arrays under their corresponding keys
                    $matchedValues['fees_date'][] = $g_json_str_arr->fees_date[$key];
                    $matchedValues['account_and_fees'][] = $g_json_str_arr->account_name[$key];
                    $matchedValues['due_date'][] = $g_json_str_arr->due_date[$key];
                    $matchedValues['fees'][] = $g_json_str_arr->fees[$key];
                    $matchedValues['term'][] = $g_json_str_arr->term[$key];
                }
            }
        }
        $total = array_sum($matchedValues['fees']);

        $json = [
            'head_name' => implode(',', $matchedValues['account_and_fees']),
            'head_due_amount' => implode(',', $matchedValues['fees']),
            'head_rec_ammount' => implode(',', $matchedValues['fees']),
            // // 'head_from_ammount' => implode(',', $request->post('head_from_ammount')),
            'term_str' => implode(',',$matchedValues['term']),
            'head_to_date' => implode(',', $matchedValues['fees_date']),
            'head_due_date' => implode(',', $matchedValues['due_date']),
            'tuition_amount_' => "",
            'name_father' => $json_array_student->fathername,
            'name_classsection' => "",
            'name_admdt' => "",
            'name_formno' => $json_array_student->form_number,
            'name_scholarno' => $json_array_student->scholar_no,
            'feestype' => "",
            'total_dueamount' => $TotelTermAmount,
            'sub_total_due' => $TotelTermAmount,
            'sub_total_received' => "",
            'total_received' => "",
            'balance_f' => "",
            'grand_total_due' => $TotelTermAmount,
            'grand_total_received' => $TotelTermAmount,
            'balance_due' => "",
            'fee_commitment_remarks' => "",
            'received_amount_details_remarks' => "",
            'by_cash' => $TotelTermAmount,
            'late_fees_rate' => "",
            'late_fees_rate_due' => "",
            'late_fees_rate_received' => "",
            'payment_by_select' => "",
            'late_fees_waive_off_due' => "",
            'late_fees_waive_off_received' => "",
            'from_employee' => "",
            'old_advance_fees_due' => "",
            'old_advance_fees_received' => "",
            'from_party' => "",
            'transfer_to_party' => "",
            'late_fees_on_posting_due' => "",
            'late_fees_on_posting_received' => "",
            'advance_due' => "",
            'advance_received' => "",
            'late_fees_account' => "",
            'advance_fees_account' => "",
        ];
        $data = [
            'student_id' => $student_id->id,
            'student_dob' => $student_id->date_of_birth,
            // 'recpt_chain' => $request->post('recpt_chain'),
            // 'due_upto' => $request->post('due_upto'),
            'name_student' => $student_id->student_name,
            'str_json' => json_encode($json),
        ];
        // print_r($data);die();
        $cfs_list = DB::connection('dynamic')->table('feesreceiptchallan')->insert($data);//Feesreceiptchallan::Create($data);
        // echo '<pre>';
        // print_r($request->post());
        // die();
        $data['bus_data'] = $bus_data;
        $data['student_data'] = [
            'student_id' => $student_id->id,
            'student_dob' => $student_id->date_of_birth,
            'name_student' => $student_id->student_name,
            'class_name' => $student_id->class_name,
            'payment_date' => date("d-m-yy"),
            'str_json' => json_encode($json),
        ];
        $data['success'] = ['success'=>'Fees Structure created successfully'];
        return $data;
    }

    public function student_ledger_receipt_challan(Request $request){
        $data = $request->all();
        $data_student_name = Student_registration::select('student_name','id','form_number')->get();
        $course_fees_head_orders_list_arr = Course_fees_head_master::orderBy('order','ASC')->get();
        $late_fees_master = Late_fees_master::where('id',1)->first();
        $lumpsum_fees = DB::connection('dynamic')->table('fees_types_master')->where('fees_type','=','lumpsum fees deposit')->first();
        $siblings = DB::connection('dynamic')->table('fees_types_master')->where('fees_type','=','siblings')->first();
        return view('backend.Fees-module.Student_ledger_Fees_receipt_challan',compact('data','data_student_name','course_fees_head_orders_list_arr','late_fees_master','lumpsum_fees','siblings'));
    }
    public function student_view_part(Request $request){
        $data = $request->all();
        $data_student_name = Student_registration::select('student_name','id','form_number')->get();
        $course_fees_head_orders_list_arr = Course_fees_head_master::orderBy('order','ASC')->get();
        $late_fees_master = Late_fees_master::where('id',1)->first();
        $lumpsum_fees = DB::connection('dynamic')->table('fees_types_master')->where('fees_type','=','lumpsum fees deposit')->first();
        $siblings = DB::connection('dynamic')->table('fees_types_master')->where('fees_type','=','siblings')->first();
        return view('backend.student_panel.view_fees_part',compact('data','data_student_name','course_fees_head_orders_list_arr','late_fees_master','lumpsum_fees','siblings'));
    }
}
