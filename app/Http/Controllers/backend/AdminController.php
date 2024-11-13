<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use DB;
use Illuminate\Support\Facades\Config;

class AdminController extends Controller
{
    /**
     * redirect admin after login
     *
     * @return \Illuminate\View\View
     */
    public $db_name = '';
    public function __construct(Request $request){
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
    public function dashboard()
    {   
        $currentSchoolYear = $this->db_name;
        $preenquirecount = DB::connection('dynamic')->table('inquiry_registration')->where('status','p')->where('session_name', $currentSchoolYear)->count();
        $enquirecount = DB::connection('dynamic')->table('inquiry_registration')->where('status','i')->where('session_name', $currentSchoolYear)->count();
        $registrationcount = DB::connection('dynamic')->table('totalnextyear')->select(DB::raw('COUNT(DISTINCT scholar_no) as count'))
        ->from('totalnextyear')
        ->value('count');
    
        // print_r($registrationcount);exit;
        // $comman_model->insertData('inquiry_registration',$insertArr);
        return view('backend.index',compact('preenquirecount','enquirecount','registrationcount'));
    }

}