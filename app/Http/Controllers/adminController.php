<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Taughtlesson;
use App\Statistic;
use Session;
use App\Register;
use App\Semester;
use App\Course;
use App\Outline;
use Validator;
use App\Level;
use App\Admin;
use App\User;
use App\Year;
use PDF;
use DB;

class adminController extends Controller
{
   public function __construct()
	{
		$this->middleware('auth:admin');
      //  $this->middleware('auth', ['except' => 'logout']);
	}


	public function index(){
        return view('admin.home');
    }

    public function Include(){
        
		return view('admin.include');
	}

    public function log() {


       
        return view('ajax.logs');
    }

    public function fstatistics(Request $req)
    {

        $semestercurrent = Semester::where('active', 1)->get();
        $yearcurrent = Year::where('active', 1)->get();
        
        foreach ($yearcurrent as $yy) {
            foreach ($semestercurrent as $ss) {

        $statistics = Statistic::where('year_id', $yy->id)->where('semester_id', $ss->id)->where('department_id', auth::user()->department->id)->orderBy('percent', 'dsc')->get();

            }
        }
           
           if ($statistics->count() > 0) {
           
            return view('admin.fstatistics',  compact('statistics', 'yearcurrent', 'semestercurrent'));


             } else{

            Session::flash('adminmessage', 'Statistics not available for this semester');

            return view('admin.fstatistics')->with('adminmessage', 'Statistics not yet available, Semester or Year have no record');

        }
        

    } 

    public function AllcourseStatistics(Request $req)
    {
         $yearid = $req['year'];
         $semesterid = $req['semester'];

        $semestercurrent = Semester::where('id', $semesterid)->get();
        $yearcurrent = Year::where('id', $yearid)->get();

        $statistics = Statistic::where('year_id', $yearid)->where('semester_id', $semesterid)->where('department_id', auth::user()->department->id)->orderBy('percent', 'asc')->get();

        if ($statistics->count() > 0) {

            return view('admin.fstatistics',  compact('statistics', 'yearcurrent', 'semestercurrent'));
           
        } else{

            Session::flash('adminmessage', 'Statistics not available for this semester');

            return redirect()->back()->with('adminmessage', 'Statistics not yet available, Semester or Year has no record');

        }

    }
    
    public function downloadfinal(Request $req){
          $yid = $req['yearresult'];
        $sid = $req['semesterresult'];

        $year = Year::Select('year')->where('id', $yid)->get();
        $semester = Semester::Select('name')->where('id', $sid)->get();

        $statistics = Statistic::where('year_id', $yid)->where('semester_id', $sid)->where('department_id', auth::user()->department->id)->orderBy('percent', 'dsc')->get();

        
       view()->share('semester', $semester);
        view()->share('statistics', $statistics);
        view()->share('year', $year);

        //if($req->has('download')){
            $pdf = PDF::loadView('download.final');
            $pdf->getDomPDF()->set_option('enable_php', true);
            //$pdf->setPaper('L', 'landscape');
            //$pdf->getDomPDF();
            //$pdf->stream('download_content');
            return $pdf->download('final.pdf');
             //return view('download.final')->withStatistics($statistics);
    }

    public function finalStatistics(Request $req){
        $yid = $req['semesterresult'];
        $sid = $req['semesterresult'];


        $year = Year::Select('year')->where('id', $yid)->get();
        $semester = Semester::Select('name')->where('id', $sid)->get();

        $statistics = Statistic::where('year_id', $yid)->where('semester_id', $sid)->where('department_id', auth::user()->department->id)->orderBy('percent', 'dsc')->get();

        return view('download.final', compact('statistics', 'year', 'semester'));
    }


    public function logg() {
        return view('ajax.logg');
    }
	 
     public function load() {
        return view('ajax.lload');
    }


    public function syllabus(){

         $levels = Level::all();
        $semesters = Semester::all();
        return view('admin.syllabus', compact('levels', 'semesters'));
    } 

    public function lecturer(){
        return view('admin.lecturer');
    }

     public function statistics(){
        $levels = Level::all();
        return view('admin.statistics', compact('levels'));
    }
 
    public function Register(){

        $levels = Level::all();
        $semesters = Semester::all();
        return view('admin.register', compact('levels', 'semesters'));
    }

    public function SelectCourse(){

        return view('admin.selectcourse');
    }

    public function seeRegister(Request $req){

        $this->validate($req, [
            'Select_Semester' => 'required|',
            'Select_Level' => 'required|',
            ]);

        $level = $req['Select_Level'];
        $semester = $req['Select_Semester'];


       $semesters = Semester::where('id', $semester)->get();
       $courses = Course::where('semester_id', $semester)->where('level_id', $level)->where('department_id', Auth::user()->department_id)->orderBy('code')->get();
        $levels = Level::where('id', $level)->get();
        return view('admin.selectcourse', compact('courses', 'levels', 'semesters'));

    }

    public function CourseRegister(Request $req){
        
        $course_id = $req['course_id'];

        if (Taughtlesson::where('course_id', $course_id)->exists()) {
                
            
            $taughtlessons = Taughtlesson::where('course_id', $course_id)->get();
            $registers = Register::where('course_id', $course_id)->get();
            $courses = Course::where('id', $course_id)->get();


foreach($totalsubsection = Outline::where('course_id', '=', $course_id)->get() as $total){

// lesson1
        $l1 = Register::where('course_id', $course_id)->where('L1', 'A')->count();

        if ($l1 > 2) {
            
            $lesson1 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 1)->get();


            foreach ($lesson1 as $one) {
                $time1 = strtotime($one->stop_time)  - strtotime($one->start_time);

                $taught1 = $one->number_subsection;
            }


        } else{ $time1 = null; $taught1 = null; }

// leson 2
        $l2 = Register::where('course_id', $course_id)->where('L2', 'A')->count();

        if ($l2 > 2) {
            
            $lesson2 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 2)->get();


            foreach ($lesson2 as $two) {
                $time2 = strtotime($two->stop_time)  - strtotime($two->start_time);

                $taught2 = $two->number_subsection;
            }


        } else{ $time2 = null; $taught2 = null;}

// leson 3
        $l3 = Register::where('course_id', $course_id)->where('L3', 'A')->count();

        if ($l3 > 2) {
            
            $lesson3 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 3)->get();


            foreach ($lesson3 as $three) {
                $time3 = strtotime($three->stop_time)  - strtotime($three->start_time);

                $taught3 = $three->number_subsection;
            }


        } else{ $time3 = null; $taught3 = null;}

// leson 4
        $l4 = Register::where('course_id', $course_id)->where('L4', 'A')->count();

        if ($l4 > 2) {
            
            $lesson4 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 4)->get();


            foreach ($lesson4 as $four) {
                $time4 = strtotime($four->stop_time)  - strtotime($four->start_time);

                $taught4 = $four->number_subsection;
            }


        } else{ $time4 = null; $taught4 = null; }

// leson 5
        $l5 = Register::where('course_id', $course_id)->where('L5', 'A')->count();

        if ($l5 > 2) {
            
            $lesson5 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 5)->get();


            foreach ($lesson5 as $five) {
                $time5 = strtotime($five->stop_time)  - strtotime($five->start_time);

                $taught5 = $five->number_subsection;
            }


        } else{ $time5 = null; $taught5 = null; }

// leson 6
        $l6 = Register::where('course_id', $course_id)->where('L6', 'A')->count();

        if ($l6 > 2) {
            
            $lesson6 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 6)->get();


            foreach ($lesson6 as $six) {
                $time6 = strtotime($six->stop_time)  - strtotime($six->start_time);

                $taught6 = $six->number_subsection;
            }


        } else{ $time6 = null; $taught6 = null;}

// leson 7
        $l7 = Register::where('course_id', $course_id)->where('L7', 'A')->count();

        if ($l7 > 2) {
            
            $lesson7 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 7)->get();


            foreach ($lesson7 as $seven) {
                $time7 = strtotime($seven->stop_time)  - strtotime($seven->start_time);

                $taught7 = $seven->number_subsection;
            }


        } else{ $time7 = null; $taught7 = null;}

// leson 8
        $l8 = Register::where('course_id', $course_id)->where('L8', 'A')->count();

        if ($l8 > 2) {
            
            $lesson8 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 8)->get();


            foreach ($lesson8 as $eight) {
                $time8 = strtotime($eight->stop_time)  - strtotime($eight->start_time);

                $taught8 = $eight->number_subsection;
            }


        } else{ $time8 = null; $taught8 = null;}

// leson 9
        $l9 = Register::where('course_id', $course_id)->where('L9', 'A')->count();

        if ($l9 > 2) {
            
            $lesson9 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 9)->get();


            foreach ($lesson9 as $nine) {
                $time9 = strtotime($nine->stop_time)  - strtotime($nine->start_time);

                $taught9 = $nine->number_subsection;
            }


        } else{ $time9 = null; $taught9 = null; }


// leson 10
        $l10 = Register::where('course_id', $course_id)->where('L10', 'A')->count();

        if ($l10 > 2) {
            
            $lesson10 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 10)->get();


            foreach ($lesson10 as $ten) {
                $time10 = strtotime($ten->stop_time)  - strtotime($ten->start_time);

                $taught10 = $ten->number_subsection;
            }


        } else{ $time10 = null; $taught10 = null;}

// leson 11
        $l11 = Register::where('course_id', $course_id)->where('L11', 'A')->count();

        if ($l11 > 2) {
            
            $lesson11 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 11)->get();


            foreach ($lesson11 as $eleven) {
                $time11 = strtotime($eleven->stop_time)  - strtotime($eleven->start_time);

                $taught11 = $eleven->number_subsection;
            }


        } else{ $time11 = null; $taught11 = null;}

// leson 12
        $l12 = Register::where('course_id', $course_id)->where('L12', 'A')->count();

        if ($l12 > 2) {
            
            $lesson12 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 12)->get();


            foreach ($lesson12 as $twelve) {
                $time12 = strtotime($twelve->stop_time)  - strtotime($twelve->start_time);

                $taught12 = $twelve->number_subsection;
            }


        } else{ $time12 = null; $taught12 = null;}

// leson 13
        $l13 = Register::where('course_id', $course_id)->where('L13', 'A')->count();

        if ($l13 > 2) {
            
            $lesson13 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 13)->get();


            foreach ($lesson13 as $thirteen) {
                $time13 = strtotime($thirteen->stop_time)  - strtotime($thirteen->start_time);

                $taught13 = $thirteen->number_subsection;
            }


        } else{ $time13 = null; $taught13 = null;}


// lesson 14
        $l14 = Register::where('course_id', $course_id)->where('L14', 'A')->count();

        if ($l14 > 2) {
            
            $lesson14 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 14)->get();


            foreach ($lesson14 as $fourteen) {
                $time14 = strtotime($fourteen->stop_time)  - strtotime($fourteen->start_time);

                $taught14 = $fourteen->number_subsection;
            }


        } else{ $time14 = null; $taught14 = null;}

// lesson 15
        $l15 = Register::where('course_id', $course_id)->where('L15', 'A')->count();

        if ($l15 > 2) {
            
            $lesson15 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 15)->get();


            foreach ($lesson15 as $fiveteen) {
                $time15 = strtotime($fiveteen->stop_time)  - strtotime($fiveteen->start_time);

                $taught15 = $fiveteen->number_subsection;
            }


        } else{ $time15 = null; $taught15 = null;}


// lesson 16
        $l16 = Register::where('course_id', $course_id)->where('L16', 'A')->count();

        if ($l16 > 2) {
            
            $lesson16 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 16)->get();


            foreach ($lesson16 as $sixteen) {
                $time16 = strtotime($sixteen->stop_time)  - strtotime($sixteen->start_time);

                $taught16 = $sixteen->number_subsection;
            }


        } else{ $time16 = null; $taught16 = null;}

// lesson 17
        $l17 = Register::where('course_id', $course_id)->where('L17', 'A')->count();

        if ($l17 > 2) {
            
            $lesson17 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 17)->get();


            foreach ($lesson17 as $seventeen) {
                $time17 = strtotime($seventeen->stop_time)  - strtotime($seventeen->start_time);

                $taught17 = $seventeen->number_subsection;
            }


        } else{ $time17 = null; $taught17 = null;}

// lesson 18
        $l18 = Register::where('course_id', $course_id)->where('L18', 'A')->count();

        if ($l18 > 2) {
            
            $lesson18 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 18)->get();


            foreach ($lesson18 as $eighteen) {
                $time18 = strtotime($eighteen->stop_time)  - strtotime($eighteen->start_time);

                $taught18 = $eighteen->number_subsection;
            }


        } else{ $time18 = null; $taught18 = null;}

// lesson 19
        $l19 = Register::where('course_id', $course_id)->where('L19', 'A')->count();

        if ($l19 > 2) {
            
            $lesson19 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 19)->get();


            foreach ($lesson19 as $nineteen) {
                $time19 = strtotime($nineteen->stop_time)  - strtotime($nineteen->start_time);

                $taught19 = $nineteen->number_subsection;
            }


        } else{ $time19 = null; $taught19 = null;}

// lesson 20
        $l20 = Register::where('course_id', $course_id)->where('L20', 'A')->count();

        if ($l20 > 2) {
            
            $lesson20 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 20)->get();


            foreach ($lesson20 as $twenty) {
                $time20 = strtotime($twenty->stop_time)  - strtotime($twenty->start_time);

                $taught20 = $twenty->number_subsection;
            }


        } else{ $time20 = null; $taught20 = null;}

// lesson 21
        $l21 = Register::where('course_id', $course_id)->where('L21', 'A')->count();

        if ($l21 > 2) {
            
            $lesson21 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 21)->get();


            foreach ($lesson21 as $twentyone) {
                $time21 = strtotime($twentyone->stop_time)  - strtotime($twentyone->start_time);

                $taught21 = $twentyone->number_subsection;
            }


        } else{ $time21 = null; $taught21 = null;}

// lesson 22
        $l22 = Register::where('course_id', $course_id)->where('L22', 'A')->count();

        if ($l22 > 2) {
            
            $lesson22 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 22)->get();


            foreach ($lesson22 as $twentytwo) {
                $time22 = strtotime($twentytwo->stop_time)  - strtotime($twentytwo->start_time);

                $taught22 = $twentytwo->number_subsection;
            }


        } else{ $time22 = null; $taught22 = null;}

// lesson 23
        $l23 = Register::where('course_id', $course_id)->where('L23', 'A')->count();

        if ($l23 > 2) {
            
            $lesson23 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 23)->get();


            foreach ($lesson23 as $twentythree) {
                $time23 = strtotime($twentythree->stop_time)  - strtotime($twentythree->start_time);

                $taught23 = $twentythree->number_subsection;
            }


        } else{ $time23 = null; $taught23 = null;}

// lesson 24
        $l24 = Register::where('course_id', $course_id)->where('L24', 'A')->count();

        if ($l24 > 2) {
            
            $lesson24 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 24)->get();


            foreach ($lesson24 as $twentyfour) {
                $time24 = strtotime($twentyfour->stop_time)  - strtotime($twentyfour->start_time);

                $taught24 = $twentyfour->number_subsection;
            }


        } else{ $time24 = null; $taught24 = null;}

// lesson 25
        $l25 = Register::where('course_id', $course_id)->where('L25', 'A')->count();

        if ($l25 > 2) {
            
            $lesson25 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 25)->get();


            foreach ($lesson25 as $twentyfive) {
                $time25 = strtotime($twentyfive->stop_time)  - strtotime($twentyfive->start_time);

                $taught25 = $twentyfive->number_subsection;
            }


        } else{ $time25 = null; $taught25 = null;}

// lesson 26
        $l26 = Register::where('course_id', $course_id)->where('L26', 'A')->count();

        if ($l26 > 2) {
            
            $lesson26 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 26)->get();


            foreach ($lesson26 as $twentysix) {
                $time26 = strtotime($twentysix->stop_time)  - strtotime($twentysix->start_time);

                $taught26 = $twentysix->number_subsection;
            }


        } else{ $time26 = null; $taught26 = null;}

// lesson 27
        $l27 = Register::where('course_id', $course_id)->where('L27', 'A')->count();

        if ($l27 > 2) {
            
            $lesson27 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 27)->get();


            foreach ($lesson27 as $twentyseven) {
                $time27 = strtotime($twentyseven->stop_time)  - strtotime($twentyseven->start_time);

                $taught27 = $twentyseven->number_subsection;
            }


        } else{ $time27 = null; $taught27 = null;}


// lesson 28
        $l28 = Register::where('course_id', $course_id)->where('L28', 'A')->count();

        if ($l28 > 2) {
            
            $lesson28 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 28)->get();


            foreach ($lesson28 as $twentyeight) {
                $time28 = strtotime($twentyeight->stop_time)  - strtotime($twentyeight->start_time);

                $taught28 = $twentyeight->number_subsection;
            }


        } else{ $time28 = null; $taught28 = null;}


// lesson 29
        $l29 = Register::where('course_id', $course_id)->where('L29', 'A')->count();

        if ($l29 > 2) {
            
            $lesson29 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 29)->get();


            foreach ($lesson29 as $twentynine) {
                $time29 = strtotime($twentynine->stop_time)  - strtotime($twentynine->start_time);

                $taught29 = $twentynine->number_subsection;
            }


        } else{ $time29 = null; $taught29 = null;}

// lesson 30
        $l30 = Register::where('course_id', $course_id)->where('L30', 'A')->count();

        if ($l30 > 2) {
            
            $lesson30 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $course_id)->where('lesson_number', 30)->get();


            foreach ($lesson30 as $thirty) {
                $time30 = strtotime($thirty->stop_time)  - strtotime($thirty->start_time);

                $taught30 = $thirty->number_subsection;
            }


        } else{ $time30 = null; $taught30 = null;}

         $totalpercentages = ($taught1 + $taught2 + $taught3 + $taught4 + $taught5 + $taught6 + $taught7 + $taught8 + $taught9 + $taught10 + $taught11 + $taught12 + $taught13 + $taught14 + $taught15 + $taught16 + $taught17 + $taught18 + $taught19 + $taught20 + $taught21 + $taught22 + $taught23 + $taught24 + $taught25 + $taught26 + $taught27 + $taught28 + $taught29 + $taught30 )/($total->number_subsection) * 100;

    }

        $totalpercentage = $totalpercentages;
        $totaltime = ($time1 + $time2 + $time3 + $time4 + $time5 + $time6 + $time7 + $time8 + $time9 + $time10 + $time11 + $time12 + $time13 + $time14 + $time15 + $time16 + $time17 + $time18 + $time19 + $time20 + $time21 + $time22 + $time23 + $time24 + $time25 + $time26 + $time27 + $time28 + $time29 + $time30)/3600;

       








             return view('admin.courseregister', compact('taughtlessons', 'registers', 'courses'))->withTotaltime($totaltime)->withTotalpercentage($totalpercentage);
        }

        else{ return redirect()->back()->with('message', 'Nothing recorded for this course. Try later !!'); }

    }



    public function LevelRegister(Request $req){
        $semester = $req['semester_id'];
        $level = $req['level_id'];

        $semesters = Semester::select('*')->where('id', $semester)->get();
        $levels = Level::where('id', $level)->get();
        $levelcourses = Course::all()->where('semester_id', $semester)->where('level_id', $level)->where('department_id', Auth::user()->id);

        return view('admin.levelregister', compact('levelcourses', 'levels', 'semesters'));
    }


     public function LevelStatistics(Request $req){
        $this->validate($req, [
            'Select_Level' => 'required|',
            ]);

        $level = $req['Select_Level'];
        
        $currentYear = Year::where('active', 1)->get();
        $currentSemester = Semester::where('active', 1)->get();
        $years = Year::all();
        $semesters = Semester::all();
        $levels = Level::where('id', $level)->get();
       $levelcourses = Course::where('level_id', $level)->where('level_id', $level)->where('department_id', Auth::user()->department_id)->orderBy('code')->get();

        return view('admin.levelstatistics', compact('levelcourses', 'levels', 'semesters', 'years', 'currentYear', 'currentSemester'));
    }



    public function CourseStatistics(Request $req){

        $this->validate($req, [
            'Select_Year' => 'required|',
            'Select_Semester' => 'required|',
            'Select_Course' => 'required|',
            ]);

        $year = $req['Select_Year'];
        $semesterid = $req['Select_Semester'];
        $courseid = $req['Select_Course'];

        if (Statistic::where('course_id', $courseid)->exists()) {
                

        $courses = Course::where('id', $courseid)->get();

        $coursestatistics = Statistic::where('course_id', $courseid)->where('year_id', $year)->where('semester_id', $semesterid)->get();

           return view('admin.coursestatistics', compact('courses', 'coursestatistics'));
            //return redirect()->back()->withCourses($courses)->withCoursestatistics($coursestatistics);

        }


        else{

            Session::flash('message', 'Statistics not available for this course, the lecturer have not ended lectures');
         return redirect()->back(); }
        
    }






 // level statistics view and function
    public function levelstatisticsview(Request $req){
       $this->validate($req, [
        'select_level' => 'required|',]);

       $levelid = $req['select_level'];
        
        $currentYear = Year::where('active', 1)->get();
        $currentSemester = Semester::where('active', 1)->get();
        $years = Year::all();
        $semesters = Semester::all();
        $levels = Level::where('id', $levelid)->get();

    return view('admin.levelstatisticsview', compact('years', 'levels', 'semesters', 'currentYear', 'currentSemester'));
    }




    public function LevelStatistic(Request $req){
        $level_id = $req['level_id'];
        $year_id = $req['Select_Year'];
        $semester_id = $req['Select_Semester'];


        $levels = Level::select('*')->where('id', $level_id)->get();
        $years = Year::select('*')->where('id', $year_id)->get();
        $semesters = Semester::select('*')->where('id', $semester_id)->get();

        $courses = Course::where('department_id', Auth::user()->department->id)->where('level_id', $level_id)->where('semester_id', $semester_id)->orderBy('code')->get();

        $numberofcourses = Course::where('department_id', Auth::user()->department->id)->where('semester_id', $semester_id)->where('level_id', $level_id)->count();

        $sumation = Statistic::where('level_id', $level_id)->where('department_id', Auth::user()->department->id)->sum('total_lecture');

        if ($sumation > 0) {
            
            if (Statistic::where('year_id', $year_id)->where('department_id', Auth::user()->department->id)->exists()) {
                
                 return view('admin.levelstatistic', compact('years', 'semesters', 'courses', 'levels', 'numberofcourses'));
            } 

            else { Session::flash('message', 'No level Statistics for this year'); return redirect()->back();}

        }else{ Session::flash('message', 'No Result recorded for this Year'); return redirect()->back();}
        
        
        
        
       
    }




    // department statistics view and function

    public function departmentalStatisticsview(){

         $semesters = Semester::all();
         $years = Year::all();

         $currentYear = Year::where('active', 1)->get();
         $currentSemester = Semester::where('active', 1)->get();

    return view('admin.departmentstatistics', compact('semesters', 'years', 'currentSemester', 'currentYear'));
    }


    public function departmentStatistics(Request $req){

      $this->validate($req, [
            'select_year' => 'required|',
            'select_semester' => 'required|',
            ]);

        $year_id = $req['select_year'];
        $semester_id = $req['select_semester'];


        $years = Year::select('*')->where('id', $year_id)->get();
        $semesters = Semester::select('*')->where('id', $semester_id)->get();

        $courses = Course::where('department_id', Auth::user()->department->id)->where('semester_id', $semester_id)->orderBy('code')->get();
        $numberofcourses = Course::where('department_id', Auth::user()->department->id)->where('semester_id', $semester_id)->count();

        $sumation = Statistic::where('year_id', $year_id)->where('department_id', Auth::user()->department->id)->sum('total_lecture');

        if ($sumation > 0) 
        {
            if (Statistic::where('year_id', $year_id)->where('department_id', Auth::user()->department->id)->where('semester_id', $semester_id)->exists()) 
            {
                 return view('admin.departmentalstatistics', compact('courses', 'numberofcourses', 'year', 'semesters'))->withSemesters($semesters)->withYears($years);
            } else { Session::flash('message', 'No Statistic for this Semester. IT is not yet available'); return redirect()->back(); }
           
        } else{ Session::flash('message', 'No result recorded for this year'); return redirect()->back(); }
    }
    





    public function DownloadOutline(Request $req){


         $course_id = $req['course_id'];

        $outlines = Outline::select('*')->where('course_id', '=', $course_id)->get();
        view()->share('outlines', $outlines);

            $pdf = PDF::loadView('download.outline');
            $pdf->getDomPDF()->set_option('enable_php', true);
            $pdf->getDomPDF();
            return $pdf->download('course_outline.pdf');
        }



    protected function guard(){
        return Auth::guard('admin');
    }


    

 /*   public function teacher(Request $req)
    {
        //validation
        $this->validate($req, [
            'department'  => 'required'
       ]);
        //requesting the values

        $department = $req['department'];

       //$course = DB::table('courses')->select('id', 'name', 'code') ->where('code','=', $req->code)->get();

        $users = User::select('*')->where('department','=', $req->department) ->get();

        
        //return $user;

       if (count($users) > 0) {

        
         return view('admin.lecturer')->withData($users);


       }

       else {
            return redirect()->back()->with('error', 'teachers not available please try later');
        }
 
        
        } */
}
