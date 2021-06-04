<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Course;

class pagesController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
      
    }

     public function index(){
    	return view('index');
    }

    public function include(){

    	return view('content.include');
    }

     public function userSignup(){
    	return view('content.userSignup');
    }


    public function home(){
    	return view('file.home');
    }
    
    public function footer(){
        return view('content.footer');
    }
   

    public function message(){
        return view('file.message');
    }

    public function coursecontent(){

        return view('file.course_content');
    }

    public function markregister(){
        return view('file.mark_register');
    }

    public function registeredStudents(){
        return view('file.registered_Students');
    }

    public function seeContent(){
        return view('file.seecontent');
    }

    public function Condition(){
        return view('file.conditions');
    }

}
