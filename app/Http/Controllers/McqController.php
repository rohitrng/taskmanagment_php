<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class McqController extends Controller
{
    // public function index(){
    //     return view('backend.AcademicsModules.stream');
    // }

    public function index(){
        return view('backend.mcq.index');
    }

}
?>
