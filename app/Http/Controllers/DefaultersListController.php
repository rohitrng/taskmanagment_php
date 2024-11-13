<?php

namespace App\Http\Controllers;

// use App\Models\TeacherSubject;
use App\Http\Controllers\Controller;
// use App\Models\CommanModel;
use App\Models\Student_registration;
use App\Models\Subject;
use App\Models\DefaultersList;
use App\Models\Generate_duechartstatus;
use App\Models\Course_fees_head_master;
use Illuminate\Http\Request;
use League\Csv\Writer;
use DB;
use PDF;
class DefaultersListController extends Controller
{      
    // public function index(){        
    //     return view('backend.Fees-module.Defaulters_list');
    // }

    public function index(){
        $studentclasses = DB::table('classes')->select('class_name')->distinct()->get();

        $headss = Course_fees_head_master::select('ac_head_name')->distinct()->get();
        

        $student_ids = DB::table('generate_duechartstatus')
        ->join('student_registration', 'generate_duechartstatus.student_id', '=', 'student_registration.id')
        ->select('generate_duechartstatus.student_id', 'student_registration.student_name')
        ->get();


        $studentsession = Student_registration::select('session_name')->distinct()->get();
        $subjects = Subject::select('id','subject_name')->distinct('subject_name')->get();
        $session = Student_registration::select('id','session_name')->distinct('session_name')->get();
        $teachersession = Student_registration::all();
        $classlist = DB::table('classes')->select('class_name')->distinct()->get();

        return view('backend.Fees-module.Defaulters_list', compact('studentclasses', 'classlist', 'subjects', 'session', 'studentsession','teachersession', 'headss','student_ids'));
    }

    public function exportPdf(){        
        $teachersubjects = DB::table('defaulters_lists')
        ->join('student_registration', 'defaulters_lists.student_id', '=', 'student_registration.id')        
        ->select('defaulters_lists.*', 'student_registration.student_name')
        ->get();

        // return view('backend.Fees-module.Defaulters_list', compact('teachersubjects'));

        // $pdfs = DefaultersList::get();
        $pdf = PDF::loadView('backend.Fees-module.Defaulters_list_pdf', compact('teachersubjects'));  
        // return view('backend.Fees-module.Defaulters_list', compact('pdfs'));

        $Data = DefaultersList::get();
        $pdf = PDF::loadView('backend.Fees-module.Defaulters_list_pdf', ['teachersubjects' => $teachersubjects])->setOptions(['defaultFont' => 'sans-serif'] , compact('teachersubjects'));
        return $pdf->download('defaulters_list.pdf');
    }

    public function export_Pdfdefaulter(){
        
    }

    public function export(Request $request){
        // echo "<pre>";print_r($request->all());exit;

        $tableName = $request->input('table_name');
        $columnNames = $request->input('column_names');
        // print_r($columnNames);exit;
        $data = DB::table('defaulters_lists')
        ->join('student_registration', 'defaulters_lists.student_id', '=', 'student_registration.id')        
        ->select('defaulters_lists.*', 'student_registration.student_name')
        ->get();
        
         // Create a new CSV writer
         $csv = Writer::createFromFileObject(new \SplTempFileObject());

         // Add CSV headers
         $csv->insertOne($columnNames);
 
          // Add CSV data rows
          foreach ($data as $item) {
             $row = [];
             foreach ($columnNames as $column) {
                 // Check if the column contains JSON data
                 if (strpos($column, 'json_') === 0) {
                     $jsonData = json_decode($item->{$column}, true);
                     $row[] = implode(", ", $jsonData);
                 } else {
                     $row[] = $item->{$column};
                 }
             }
             $csv->insertOne($row);
         }
         // echo"<pre>";
         // print_r($csv);
         // exit;
 
         // Set the response headers
         $headers = [
             'Content-Type' => 'text/csv',
             'Content-Disposition' => 'attachment; filename='.$tableName.'.csv',
         ];
 
         // Return the CSV file as a response
         return response($csv->getContent(), 200, $headers);
    }
    
    public function search(Request $request)
    {
        $keyword = $request->query('keyword');
    
        // Perform your search logic here
        $searchResults = DefaultersList::where('column_name', 'like', "%$keyword%")->get();
    
        return response()->json($searchResults);
    }

    public function create(Request $request){
        $pdf = $request->pdf;
        $csv = $request->csv;
        $scholar_no = $request->scholar_no;
        $enrollment_no = $request->enrollment_no;
        $student_name = $request->student_name;
        $class_name = $request->class_name;
        $section_name = $request->section_name;
        $account_name = $request->account_name;
        $balance_amount = $request->balance_amount;
        $min_date = $request->min_date;
        $max_date = $request->remark;
        $student = $request->student;
        $year = $request->year;
        $date_type = (!empty($request->date_type) ? $request->date_type : '');
        $date = (!empty($request->date) ? $request->date : '');
        $status = $request->status;
        $ac_head_name = (!empty($request->ac_head_name) ? $request->ac_head_name : '');
        $next_yesr_fees = $request->next_yesr_fees;
        $rte = $request->rte;
        $staff_ward = $request->staff_ward;
        $session_name = $request->session_name;
        $scholarship = $request->scholarship;
        $student_id = !empty($request->student_id) ? $request->student_id: '';
        $studentname = Student_registration::where('id',$student_id)->get('student_name');
        $studentclasses = Student_registration::select('class_name')->distinct()->get();
        $headss = Course_fees_head_master::select('ac_head_name')->distinct()->get();
        $student_ids = DB::table('generate_duechartstatus')
    ->join('student_registration', 'generate_duechartstatus.student_id', '=', 'student_registration.id')
    ->select(
        'generate_duechartstatus.student_id',
        'student_registration.student_name',
        DB::raw("JSON_UNQUOTE(JSON_EXTRACT(student_registration.json_str, '$.father_mobile')) as father_mobile"),
        DB::raw("JSON_UNQUOTE(JSON_EXTRACT(student_registration.json_str, '$.mobile_number')) as mobile_number")
    )
    ->get();
        // $student_id = Generate_duechartstatus::select('student_id', 'student_name')->distinct()->get();

        $studentsession = Student_registration::select('session_name')->distinct()->get();
        $subjects = Subject::select('id','subject_name')->distinct('subject_name')->get();
        $session = Student_registration::select('id','session_name')->distinct('session_name')->get();
        $teachersession = Student_registration::all();
        // $teachersubjects = DefaultersList::all();
        // $results = DB::table('generate_duechartstatus')->select('json_str')
        // ->leftJoin('feesreceiptchallan', 'generate_duechartstatus.student_id', '=', 'feesreceiptchallan.student_id')
        // ->get();
                // sending the form data 
                $formdata[] = [
                    'scholar_no' => $scholar_no,
                    'enrollment_no' => $enrollment_no,
                    'class_name' => $class_name,
                    'section_name' => $section_name,
                    'account_name' => $account_name,
                    'balance_amount' => $balance_amount,
                    'min_date' => $min_date,
                    'max_date' => $max_date,
                    'student' => $student,
                    'year' => $year,
                    'date_type' => $date_type,
                    'date' => $date,
                    'status' => $status,
                    'ac_head_name' => $ac_head_name,
                    'next_yesr_fees' => $next_yesr_fees,
                    'rte' => $rte,
                    'staff_ward' => $staff_ward,
                    'session_name' => $session_name,
                    'scholarship' => $scholarship,
                    'student_id' => $student_id
                    
                ];
                // echo "<pre>";print_r($formdata);exit;
                $currentDate = date('d-m-Y');
                // $currentDate = now()->toDateString(); // Get the current date

                $results = DB::connection('dynamic')->table('generate_duechartstatus')
    ->select(
        'generate_duechartstatus.id as gid',
        'feesreceiptchallan.id as fid',
        'generate_duechartstatus.student_id',
        'generate_duechartstatus.class_name as class_name',
        'generate_duechartstatus.session_name',
        'generate_duechartstatus.sectionname',
        'generate_duechartstatus.json_str',
        'feesreceiptchallan.str_json',
        DB::connection('dynamic')->raw('JSON_UNQUOTE(JSON_EXTRACT(JSON_UNQUOTE(JSON_EXTRACT(json_str, "$[0].json_str")), "$.due_date[0]")) as due_date')
    )
    ->leftJoin('feesreceiptchallan', 'generate_duechartstatus.student_id', '=', 'feesreceiptchallan.student_id')
    ->when($student_id, function ($query) use ($student_id) {
        return $query->where('generate_duechartstatus.student_id', $student_id);
    })
    ->where('generate_duechartstatus.class_name', $class_name)
    ->whereRaw('JSON_UNQUOTE(JSON_EXTRACT(JSON_UNQUOTE(JSON_EXTRACT(json_str, "$[0].json_str")), "$.due_date[0]")) < ?', [$currentDate])
    ->get();

        $termHeadMap = [];
        // echo '<pre>';
        
            // print_r($results);exit;
        foreach ($results as $object) {
            if (!empty($object->fid)) {
                $jsonData = json_decode($object->str_json, true);
                $records[] = $jsonData;

                $heads = explode(',', $jsonData['head_name']);
                $termStr = explode(',', $jsonData['term_str']);
                $recAmounts = explode(',', $jsonData['head_rec_ammount']);
                $headDueAmounts = explode(',', $jsonData['head_due_amount']);
                $headduedate = explode(',', $jsonData['head_due_date']);
                $headtodate = explode(',', $jsonData['head_to_date']);

                $diff = 0;
                foreach ($termStr as $key => $term) {
                    $head = $heads[$key];
                    $recAmount = $recAmounts[$key];
                    $headDueAmount = $headDueAmounts[$key];
                    $headduedateq = $headduedate[$key];
                    $headtodateq = $headtodate[$key];
                    $student_id = $object->student_id;
                    if($date_type == 'DUE DATE'){
                        if($headduedateq > $date){
                            continue;
                        }
                    }
                    if($date_type == 'ENTRY DARE'){
                        if($headtodateq > $date){
                            continue;
                        }
                    }
                    if(!empty($ac_head_name) && $ac_head_name != $head){
                        continue;
                    }

                    // Initialize an empty array for this term if it doesn't exist
                    if (!isset($termHeadMap[$term])) {
                        $termHeadMap[$term][$student_id][$head] = [];
                    }

                    // Create a unique identifier combining head_name and student_id
                    $uniqueIdentifier = "$head - student_id: $student_id - class_name : $object->class_name - session_name : $object->session_name - duedate : $headduedateq - todate : $headtodateq - flag: p - sectionname: $object->sectionname";

                    if ($recAmount != 0) {
                        // Include "pay" and "Due" if recAmount is not 0
                        $uniqueIdentifier .= " - pay: $recAmount - due: $headDueAmount";
                        
                        // Calculate the "Diff" value by subtracting "pay" from "Due"
                        $payAmount = (int)$recAmount;
                        $dueAmount = (int)$headDueAmount;
                        $diff = $dueAmount - $payAmount;
                        $uniqueIdentifier .= " - diff: $diff";
                    } elseif (!empty($headDueAmount)) {
                        // Include only "Due" if headDueAmount is not empty
                        $uniqueIdentifier .= " - due: $headDueAmount";
                    }

                    // Add the unique identifier to the term array if it's not already there
                    if (!in_array($uniqueIdentifier, $termHeadMap[$term])) {
                        $termHeadMap[$term][$student_id][$head] = $uniqueIdentifier;
                    }
                }
            }
        }

        $result1 = [];

        foreach ($results as $object) {
            if (!empty($object->gid) && empty($object->str_json)) {
                
                // Iterate through the JSON objects
                foreach (json_decode($object->json_str, true) as $jsonData1) {
                    // $jsonData1 = json_decode($object->json_str, 1);
                    $jsonData2 = json_decode($jsonData1['json_str'], 1);
                    if (isset($jsonData2['term']) && isset($jsonData2['account_name']) && isset($jsonData2['due_date'])) {
                        $terms = $jsonData2['term'];
                        $accountNames = $jsonData2['account_name'];
                        $dueDates = $jsonData2['due_date'];
                        
                        foreach ($terms as $index => $term) {
                            $accountName = $accountNames[$index];
                            $dueDate = $dueDates[$index];

                            if($date_type == 'DUE DATE'){
                                if($dueDate > $date){
                                    continue;
                                }
                            }
                            if($date_type == 'ENTRY DARE'){
                                if($jsonData2['fees_date'][$index] > $date){
                                    continue;
                                }
                            }
                            if(!empty($ac_head_name) && $ac_head_name != $accountName){
                                continue;
                            }

                            $entry = "$accountName - student_id: {$object->student_id} - class_name: {$object->class_name} - session_name: {$object->session_name} - duedate: $dueDate - todate : {$jsonData2['fees_date'][$index]} - flag: u - sectionname: $object->sectionname - pay:  - due: {$jsonData2['fees'][$index]} - diff: {$jsonData2['fees'][$index]}";

                            if (!isset($result1[$term])) {
                                $result1[$term] = [];
                            }

                            if (!isset($result1[$term][$object->student_id])) {
                                $result1[$term][$object->student_id] = [];
                            }

                            // Add an entry to the result array
                            $result1[$term][$object->student_id][$accountName] = $entry;
                            // echo '<pre>';print_r($result1);
                        }
                    }
                }
            }
        }
        // echo '<pre>';print_r($result1);
        // echo '<pre>';print_r($result1);
        // echo '<pre>';print_r($termHeadMap);
        // die();
        if(!empty($result1)) {
            $result_data = array_merge_recursive($termHeadMap, $result1);
        } else {
            $result_data = $termHeadMap;
        }

        // die();
        // Re-index the arrays
        foreach ($result_data as &$headNames) {
            $headNames = array_values($headNames);
        }

        $result = [];

        foreach ($result_data as $term => $termArray) {
            foreach ($termArray as $studentArray) {
                foreach ($studentArray as $head => $entry) {
                    // Check if the entry contains "Diff: 0", and skip it
                    if (strpos($entry, 'diff: 0') !== false) {
                        continue;
                    }
                    
                    // Add the entry to the result
                    $result[$term][] = $entry;
                }
            }
        }
        // echo '<pre>';
        // print_r($result);die();
        // DefaultersList::create($request->post());
        $classlist = DB::table('classes')->select('class_name')->distinct()->get();
        if(!empty($pdf)){
            $pdf = PDF::loadView('backend.Fees-module.Defaulters_list_pdf', compact('classlist','result','formdata','studentclasses', 'studentname','subjects', 'session', 'studentsession','teachersession', 'headss','student_ids'));
            return $pdf->download('defaulters_list.pdf');
        }
        if(!empty($csv)){
                // Create a new CSV Writer
    $csv = Writer::createFromFileObject(new \SplTempFileObject());

    // Add headers to the CSV
    $csv->insertOne(['Section', 'Description', 'Student ID', 'Class Name', 'Session Name', 'Due Date', 'To Date', 'Flag', 'Section Name', 'Pay', 'Due', 'Diff']);        
    // $csv->insertOne(['SN','Class','Sesstion','Student Name','Roll No','Scholar No.','Enrollment No.','Stu Mob.','Father Mob.','Fees']);
    // Iterate through each section in $result
    $fp = fopen('/Applications/XAMPP/xamppfiles/htdocs/lvn-school/test.txt','a');
    fwrite($fp,print_r($result,1)."\n");
    foreach ($result as $section => $data) {
        // Iterate through each row of data in the section
        foreach ($data as $rowData) {
            // Split the row data by "-" to get individual fields
            $fields = explode(" - ", $rowData);


            $outputArray = [];
            foreach ($fields as $item) {
                $parts = explode(":", $item, 2);
                if (count($parts) === 2) {
                    $outputArray[] = trim($parts[1]);
                } else {
                    $outputArray[] = $item;
                }
            }
            // print_r($outputArray);

            
            // print_r($fields);
            // die();
            // Extract values from the fields
            $description = substr($outputArray[0], 0, strpos($outputArray[0], ':'));
            $studentInfo = substr($outputArray[0], strpos($outputArray[0], ':') + 2);

            // Split student info by " - " to get individual student-related fields
            $studentFields = explode(" - ", $studentInfo);

            // Add the section as the first field
            array_unshift($outputArray, $section);

            // Insert the row into the CSV
            $csv->insertOne($outputArray);
        }
    }

    // Set the headers for the CSV download
    $tableName = 'defaulters_list';
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename=' . $tableName . '.csv',
    ];

    // Output the CSV to the browser and exit
    $csv->output($tableName . '.csv');
    }
        return view('backend.Fees-module.Defaulters_list', compact('classlist','result','formdata','studentclasses', 'studentname','subjects', 'session', 'studentsession','teachersession', 'headss','student_ids'));
    }

    public function view($id){
        $defaulters_list = DefaultersList::whereId($id)->get();
        $defaulters = DefaultersList::orderBy('id','desc')->paginate(5);
        return view('backend.Fees-module.Defaulters_list', compact('defaulters_list','defaulters'));
    }

    public function defaulter_list_csv($id){
        $df = json_decode($id);
        if(!empty($df)){

            // Create a new CSV Writer
$csv = Writer::createFromFileObject(new \SplTempFileObject());

// Add headers to the CSV
$csv->insertOne(['SN','Class','Sesstion','Student Name','Roll No','Scholar No.','Enrollment No.','Stu Mob.','Father Mob.','Fees']);        
// Iterate through each section in $result
// echo '<pre>';print_r($df);die();
$outputArray= [];
$k = 1;
foreach ($df as $data) {
    $outputArray["id"] = $k;
    $outputArray["class"] = $data->Class;
    $outputArray["Session"] = $data->Sesstion;
    $outputArray["Student_Name"] = $data->Student_Name;
    $outputArray["Roll_No"] = $data->Roll_No;
    $outputArray["Scholar_No"] = $data->Scholar_No;
    $outputArray["Enrollment_No"] = $data->Enrollment_No;
    $outputArray["Stu_Mob"] = $data->Stu_Mob;
    $outputArray["Father_Mob"] = $data->Father_Mob;
    $outputArray["Fees"] = $data->Fees;

    // Iterate through each row of data in the section
    // foreach ($data as $rowData) {

        // Split the row data by "-" to get individual fields
        // $fields = explode(" - ", $rowData);


        
        // foreach ($fields as $item) {
        //     $parts = explode(":", $item, 2);
        //     if (count($parts) === 2) {
        //         $outputArray[] = trim($parts[1]);
        //     } else {
        //         $outputArray[] = $item;
        //     }
        // }
        // print_r($outputArray);

        
        // print_r($fields);
        // die();
        // Extract values from the fields
        // $description = substr($outputArray[0], 0, strpos($outputArray[0], ':'));
        // $studentInfo = substr($outputArray[0], strpos($outputArray[0], ':') + 2);

        // Split student info by " - " to get individual student-related fields
        // $studentFields = explode(" - ", $studentInfo);

        // Add the section as the first field
        // array_unshift($outputArray, $section);

        // Insert the row into the CSV
        
    // }
    $csv->insertOne($outputArray);
    $k++;
}

// Set the headers for the CSV download
$tableName = 'defaulters_list';
$headers = [
    'Content-Type' => 'text/csv',
    'Content-Disposition' => 'attachment; filename=' . $tableName . '.csv',
];

// Output the CSV to the browser and exit
$csv->output($tableName . '.csv');
    }
    exit;
    
    }

}