<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Student;
use Validator;
use App\User;
Use App\Course;
use DB;
use PDF;
use App\Workcontent;
use App\Outline;
use App\Selectedstudent;

class studentController extends Controller
{
    

    public function __construct()
	{
		$this->middleware('auth:student');
      //  $this->middleware('auth', ['except' => 'logout']);
	}

	public function index(){
		return view('student.shome');
	}


	public function sinclude(){

		return view('student.sinclude');
	}

	public function MarkRegShow(){

		return view('student.markregister');
	}

	public function MarkregView(){
		$id = Auth::user()->id;

		$courses = Student::find($id);

		return view('student.mark_register', compact('courses'));
	}

	public function Markregisterfunction(Request $req){
		$this->validate($req, [
            'course' => 'required',
           
            ]);

		$course = $req['course'];

		$selectedcourse = Selectedstudent::where('course_id', '=', $req->course)->where('student_id', '=', Auth::user()->id)->get();

		return view('student.markregister', compact('selectedcourse'));
	}


	public function registeredcourses(){

		$id = Auth::user()->id;

		$courses = Student::find($id);

		//$courses = Student::get()->last();
		//return $courses->courses;
		return view('student.courses', compact('courses', 'students'));
	}


	 public function downloadV(Request $req){


         $id = $req['id'];

        DB::table('course_student')->where('course_id', '=', $req->id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]);

        $scontents = Workcontent::select('*')->where('course_id', '=', $req->id)->get();
        view()->share('scontents', $scontents);

        //if($req->has('download')){
            $pdf = PDF::loadView('download.content');
            $pdf->getDomPDF()->set_option('enable_php', true);
            //$pdf->setPaper('L', 'landscape');
            $pdf->getDomPDF();
            //$pdf->stream('download_content');
            return $pdf->download('course_content.pdf');
        //}
       //return view('download.content');

        //$pdf = PDF::loadView('download.content', $scontents);
        //return $pdf->download('course_content.pdf');
        //return $scontents;
        //return view('download.content')->withScontents($scontents);
    

    }

     public function downloadoutline(Request $req){
         $id = $req['id'];

    
        $outlines = Outline::select('*')->where('course_id', '=', $req->id)->get();
        view()->share('outlines', $outlines);

        //if($req->has('download')){
            $pdf = PDF::loadView('download.outline');
            $pdf->getDomPDF()->set_option('enable_php', true);
            //$pdf->setPaper('L', 'landscape');
            $pdf->getDomPDF();
            //$pdf->stream('download_content');
           return $pdf->download('course_outline.pdf');
            // return view('download.outline')->withOutlines($outlines);
    }

	


    protected function guard(){
        //return Auth::guard('student');
    }
}
