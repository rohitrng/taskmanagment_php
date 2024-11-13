<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student_registration;
use App\Models\Generate_duechartstatus;
use App\Models\Feesreceiptchallan;
use DB;


class PublicController extends Controller
{
    public function index()
    {
        return view('public');
    }


    // public function indexpay()
    // {
    //     return view('payreciept');
    // }

    public function getStudentDetails(Request $request)
    {
        $scholarNumber = $request->input('scholarNumber');
        $student = Student_registration::where('scholar_no', $scholarNumber)->first();
    
        // return response()->json(['error' => $student], 404);
        if ($student) {
            // Find Generate_duechartstatus record by student_id

            $feesrecipt_chalan = Feesreceiptchallan::where('student_id', $student->id)->get();

            if (!empty($feesrecipt_chalan)){
                $json_str = $feesrecipt_chalan;
                print_r($json_str[0]->str_json);
                return response()->json([
                    'duechart_data' => $feesrecipt_chalan,
                    // 'id' => $student->id,
                    // 'student_name' => ucwords($student->student_name),
                    // 'amount' => $dueChartStatus->amount,
                    // 'bus_fees' => $busFees // Include bus fees in the response

                ]);
            } else {
                $dueChartStatus = Generate_duechartstatus::where('student_id', $student->id)->first();
            
                if ($dueChartStatus) {
                    $busFees = json_decode($dueChartStatus->json_str, true)['bus_fees'] ?? 18000;
                    
                    return response()->json([
                        'duechart_data' => $dueChartStatus,
                        'id' => $student->id,
                        'student_name' => ucwords($student->student_name),
                        'amount' => $dueChartStatus->amount,
                        'bus_fees' => $busFees // Include bus fees in the response
    
                    ]);
                } else {
                    return response()->json(['error' => 'Due chart status not found for the student'], 404);
                }
            }
            
        } else {
            return response()->json(['error' => 'Student not found'], 404);
        }
    }

//     public function getStudentDetails(Request $request)
//     {
//         $scholarNumber = $request->input('scholarNumber');
//         $student = Student_registration::where('scholar_no', $scholarNumber)->first();

//         if ($student) {
//             $dueChartStatus = Generate_duechartstatus::where('student_id', $student->id)->first();

//             if ($dueChartStatus) {
//                 $data = json_decode($dueChartStatus->json_str, true);
//                 $termPayments = $data['term_payments'] ?? [];
//                 $busInstallments = $data['bus_installments'] ?? [];
//                 $paymentSummary = $data['payment_summary'] ?? [];

//                 return response()->json([
//                     'student_name' => ucwords($student->student_name),
//                     'id' => $student->id,
//                     'term_payments' => $termPayments,
//                     'bus_installments' => $busInstallments,
//                     'payment_summary' => $paymentSummary,
//                 ]);
//             } else {
//                 return response()->json(['error' => 'Due chart status not found for the student'], 404);
//             }
//         } else {
//             return response()->json(['error' => 'Student not found'], 404);
//         }
//     }
}

    


       



   

