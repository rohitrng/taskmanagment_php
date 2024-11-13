<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use DB;

class StudentPanelController extends Controller
{
    /**
     * redirect admin after login
     *
     * @return \Illuminate\View\View
     */
    public function student_calender()
    {   
        // $comman_model->insertData('inquiry_registration',$insertArr);
        return view('backend.student_panel.calender');
    }

    public function student_announcement()
    {   
        // $comman_model->insertData('inquiry_registration',$insertArr);
        return view('backend.student_panel.student_announcement');
    }

}