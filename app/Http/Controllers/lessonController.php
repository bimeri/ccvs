<?php

namespace App\Http\Controllers;

use App\http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Selectedstudent;
use App\Subsection;
use Validator;
use Auth;
use App\User;
use Session;
use App\Register;
use App\Taughtlesson;
use App\Outline;
use DB;
/**
*created by bimeri noel @ go-groups
*malingo Buea
* in November 30 2018 4:01pm
**/
class lessonController extends Controller
{
     public function __construct()
    {
         $this->middleware('web');    
    }

    public function SaveSubsection(Request $req){
         $this->validate($req, [
            'subsectionid' => 'required|',
            'statuss' => 'required|'
            ]);
        $subsectionid = $req['subsectionid'];
        $statuss = $req['statuss'];

    

            DB::table('subsections')->where('id', '=', $req->subsectionid)->update(['status' => $statuss]);
         
            Session::flash('messagegreen', 'subsection covered and saved successfully !!');
         return redirect()->back();
        
    
         
        
    }


    public function lesson(Request $req){

    	   $this->validate($req, [
            'course_id' => 'required|',
            'yearid' => 'required|',
            'lesson_number' => 'required|',
            'what_taught' => 'required|',
            'date' => 'required|before_or_equal:tomorrow|',
            'number_subsection'  => 'required|integer|',
            'start_time' => 'required|',
            'stop_time' => 'required|after:start_time',
            'venue' => 'required|'
            ]);
        $course_id = $req['course_id'];
        $lesson_number = $req['lesson_number'];
        $what_taught = $req['what_taught'];
        $date = $req['date'];
        $number_subsection =  $req['number_subsection'];
        $yearid =  $req['yearid'];
        $assignment = $req['assignment'];
        $start_time = $req['start_time'];
        $stop_time = $req['stop_time'];
        $venue = $req['venue'];


        if ($what_taught != '') {

            if(Taughtlesson::where('course_id', '=', $course_id)->where('lesson_number', '=', $lesson_number)->exists() ){

            Session::flash('error', 'You are done with this lesson already');
               
             return redirect()->back();


            }
             else{     

           
            DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->update(['status' => 1]);

            $lessons = new Taughtlesson();

            $lessons->course_id = $course_id;
            $lessons->lesson_number = $lesson_number;
            $lessons->what_taught= $what_taught;
            $lessons->date= $date;
            $lessons->number_subsection = $number_subsection;
            $lessons->year_id = $yearid;
            $lessons->assignment = $assignment;
            $lessons->start_time = $start_time;
            $lessons->stop_time = $stop_time;
            $lessons->venue = $venue;

            $lessons->save();


             $totalsections = Outline::where('course_id', $course_id)->get();
            $totalsum = Taughtlesson::where('course_id', $course_id)->sum('number_subsection');

            foreach ($totalsections as $totalsection) {
                $averageCA = $totalsection->number_subsection;
            }
            

            if ($totalsum >= ($averageCA/($totalsection->number_of_continuous_accessment)*4)) {
                DB::table('outlines')->where('course_id', '=', $course_id)->update(['status' => 1]);
            }

            elseif ($totalsum >= ( $averageCA/($totalsection->number_of_continuous_accessment)*3)) {
                DB::table('outlines')->where('course_id', '=', $course_id)->update(['status' => 1]);
            }

            elseif ($totalsum >= ($averageCA/($totalsection->number_of_continuous_accessment)*2)) {
                DB::table('outlines')->where('course_id', '=', $course_id)->update(['status' => 1]);
            }

            elseif ($totalsum >= ($averageCA/($totalsection->number_of_continuous_accessment))) {
                DB::table('outlines')->where('course_id', '=', $course_id)->update(['status' => 1]);
            }
            else{ }
            
          Session::flash('success', 'This lesson was saved successfully!!');

            return redirect()->route('mark_register');
            
            
        }
        }


        else{

            Session::flash('error', 'wrong filled form.');
            return redirect()->back();
        } 
    }

    public function ClearNotifocation($course){

         DB::table('outlines')->where('course_id', '=', $course)->update(['status' => 0]);

         return redirect()->back();
    }




    // number of lesson 30, 
}
