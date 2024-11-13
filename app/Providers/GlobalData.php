<?php

namespace App\Providers;
use App\Http\Controllers\Controller;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use DB;

class GlobalData extends ServiceProvider
{

    public function register()
    {
        
        $db_name = "hr_project";
        $sessionName = Session::getName();
        $dynamicConnectionName = 'dynamic';
        $dynamicConfig = Config::get("database.connections.{$dynamicConnectionName}");
        $dynamicConfig['database'] = $db_name;
        Config::set('database.connections.dynamic', $dynamicConfig);
        DB::reconnect('dynamic');
        // $inqArr = DB::connection('dynamic')->table('inquiry_registration')->where('save_status','=','Form Selected')->where('status','=','i')->get();
        $inqArr = DB::connection('dynamic')->table('student_registration')->get();
        $this->app->bind('global_areas', function () use ($inqArr) {
            return $inqArr;
        });
    }
}

