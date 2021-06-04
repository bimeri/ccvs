<?php

namespace App\Http\Controllers;

use App\http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Selectedstudent;
use App\Topic;
use App\Section;
use App\Subsection;
use App\Workcontent;
use App\Taughtlesson;
use App\Statistic;
use App\Register;
use App\Outline;
use App\Student;
use App\Course;
use App\User;
use Validator;
use Session;
use Auth;
use PDF;
use App;
use DB; 





class userController extends Controller

{



	 public function index()
    {
        return view('home');
    }

    public function sload(){

        return view('file.see_students');
    }



     public function Signup(Request $req)
    {

        $this->validate($req, [
            'fname' => 'required|alpha|min:3',
            'lname' => 'required|min:4',
            'email' => 'required|email',
            'phone'  => 'required|digits:9|integer|',
            'password' => 'required|min:6',
            'faculty' => 'required|',
            'department_id' => 'required|'
            ]);

        $fname = $req['fname'];
        $lname = $req['lname'];
        $phone = $req['phone'];
        $email = $req['email'];
        $faculty =  $req['faculty'];
        $department = $req['department_id'];
        $password = $req['password'];
        $password2 = $req['password2'];

        if ($password==$password2) {

            $password = bcrypt($req['password']);

            $user = new User();

            $user->fname = $fname;
            $user->lname = $lname;
            $user->phone= $phone;
            $user->email= $email;
            $user->faculty = $faculty;
            $user->department_id = $department;
            $user->password = $password;

            $user->save();
            
          Session::flash('success', 'Register successfully! Now login...');

            return view('index');
            
            
        }


        else{

            return redirect()->back()->with('error', 'wrong filled form. Either the passwords do not match, or it should contain atleast 6 character, an upper case leter and a lower case leter, and at least a number.');
        } 

    }

    public function setOutline(Request $req){

        $this->validate($req, [
            
        
            'course_id' => 'required|',
            'description'  => 'required|',
            'number_subsection' => 'required|integer',
            'number_of_weeks' => 'required|integer',
            'number_of_assignment' => 'required|integer',
            'number_of_continuous_accessment' => 'required|integer',
            ]);


        $course_id = $req['course_id'];
        $description = $req['description'];
        $number_subsection= $req['number_subsection'];
        $number_of_weeks =  $req['number_of_weeks'];
        $number_of_assignment = $req['number_of_assignment'];
        $number_of_continuous_accessment = $req['number_of_continuous_accessment'];
        

  
            if (!(App\Outline::where('course_id', $course_id)->exists())) {
                
                $outlines = new Outline;


            $outlines->course_id = $course_id;
            $outlines->description = $description;
            $outlines->number_subsection = $number_subsection;
            $outlines->number_of_weeks = $number_of_weeks;
            $outlines->number_of_assignment = $number_of_assignment;
            $outlines->number_of_continuous_accessment = $number_of_continuous_accessment;

            $outlines->save();

            

        $scontents = Workcontent::select('*')->where('course_id', '=', $course_id)->get();
        $outlines = Outline::select('*')->where('course_id', '=', $course_id)->get();

        Session::flash('success',  'Course Outline Created Successfully.');
         return view('file.seeoutline', compact('scontents', 'outlines'));

            }else {
                Session::flash('error', 'Course Outline already Exist');
                return redirect()->back();
            }


}   


 public function setCourseTopic(Request $req){

        $this->validate($req, [
            
        
            'course_id' => 'required|',
            'topic' => 'required|',
            ]);


        $course_id = $req['course_id'];
        $topic = $req['topic'];

        if($course_id != '') {  

            $topics = new Topic;

            $topics->course_id = $course_id;
            $topics->topic = $topic;
           
            $topics->save();

            Session::flash('messagegreen',  'Topic added successfully, Continue...');

            return redirect()->back();
        }

    else{
        return redirect()->back()->with('error', 'an error occure, try again');
    }

}  

    public function setCourseSection(Request $req){

        $this->validate($req, [
            
        
            'topic_id' => 'required|',
            'section' => 'required|',
            ]);


        $topic_id = $req['topic_id'];
        $section= $req['section'];

        if($topic_id != '') {  

            $sections = new Section;

            $sections->topic_id = $topic_id;
            $sections->subtopic = $section;
           
            $sections->save();

            Session::flash('messagegreen',  'Sub-Topic added successfully, Continue...');

            return redirect()->back();
        }

    else{
        return redirect()->back()->with('error', 'error occure. try again');
    }

}

        public function setCourseSubSection(Request $req)
        {

                $this->validate($req, [
                    
                    'course_id' => 'required',
                    'subtopic_id' => 'required|',
                    'subsection' => 'required|',
                    ]);


                $course_id = $req['course_id'];
                $subtopic_id = $req['subtopic_id'];
                $subsection= $req['subsection'];

                if($subsection != '') 
                {  

                    $subsections = new Subsection;

                    $subsections->course_id = $course_id;
                    $subsections->section_id = $subtopic_id;
                    $subsections->sub_section = $subsection;
                   
                    $subsections->save();

                    Session::flash('messagegreen',  'Sub-Section added successfully, Continue...');

                    return redirect()->back();
                }

            else
            {
                return redirect()->back()->with('error', 'error occure. try again');
            }

        }   

    public function Students(Request $req){
        $student_id = $req['student_id'];
        $course_id = $req['course_id'];
        $year_id = $req['academic_year'];
        $student_matricule = $req['student_matricule'];

        if ($student_id != '') {

            $selectedstudents = new Selectedstudent;

            $selectedstudents->student_id = $student_id;
            $selectedstudents->course_id = $course_id;
            $selectedstudents->year_id = $year_id;
            $selectedstudents->student_matricule = $student_matricule;

            $selectedstudents->save();
            Session::flash('messagegreen', 'student selected successfully');

            return redirect()->back();
        }
    }

    public function removeselectedstudent(Request $req){
        $student_id = $req['student_id'];
        $course_id = $req['course_id'];

        $selectedstudent = DB::table('selectedstudents')->where('course_id', $course_id)->where('student_id', $student_id)->delete(); 

        Session::flash('messagesuccess', 'student unselected, select another!!');

            return redirect()->back();  
    }


     public function SelectCourse(Request $req){
         $this->validate($req, [
            'select_course' => 'required',
           
            ]);

        $select_course = $req['select_course'];

         if (!(Statistic::where('course_id', $select_course)->exists()))
        {
                         //$scontents = Workcontent::select('*')->where('course_id', '=', $req->course)->get();

                    $selectedcourses = Course::where('id', '=', $req->select_course)->get();
                  
                    if (Selectedstudent::where('course_id', '=', $req->select_course)->count() > 4) 
                    {

                    if(Outline::where('course_id', $req->select_course)->count() > 0) 
                    {
                        
                        return view('file.markregister', compact('selectedcourses'));
                    }

                        else
                        {

                            return redirect()->back()->with('error', 'course Outline doesn\'t exit for this course, create it first !!');
                        }

                    }

                    else{
                        return redirect()->back()->with('error', 'you need to select exactly five (5) student to sign the register');
                    }

        }
         else
         {
            Session::flash('success', 'you have ended lectures already, you can\'t continue to mark the register');
            return redirect()->back();
         }

    
    }

    public function TeacherRegister(){

        return view('file.markregister');
    }


    public function TeacherCheckRegister(Request $req){
        $select_course = $req['select_course'];

        if (Taughtlesson::where('course_id', $select_course)->count() > 0) {

            if (Outline::where('course_id',  $select_course)->exists()) {
                if (Register::where('course_id', $select_course)->exists()) {
                    
                    $courses = Course::where('id',  $req->select_course)->get();

            return view('file.registerstatistics', compact('courses'));
                }else{Session::flash('message', 'no result for now, student have not yet mark first lesson.'); return redirect()->back();}

            
        }
        else{

        Session::flash('message', 'You have not yet creaated the outline for this course.');

            return redirect()->back();
    }
    
    }
        else{

            Session::flash('error', 'No record Exist for this course, maybe you haven\'t selected students or students have not started marking the register.');

            return redirect()->back();
        }

     }


     public function Course_Statistics(){

        return view('file.registerstatistics');
    }



    public function downloadContent(Request $req){


         $id = $req['id'];

    
        $scontents = Workcontent::select('*')->where('course_id', '=', $req->id)->get();
        view()->share('scontents', $scontents);

        //if($req->has('download')){
            $pdf = PDF::loadView('download.content');
            $pdf->getDomPDF()->set_option('enable_php', true);
            //$pdf->setPaper('L', 'landscape');
            //$pdf->stream('download_content');
            return $pdf->download('course content.pdf');
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
            //$pdf->getDomPDF();
            //$pdf->stream('download_content');
            return $pdf->download('course_outline.pdf');
             //return view('download.outline')->withOutlines($outlines);
    }

    public function seecontents(Request $req){
         $this->validate($req, [
            'course' => 'required',
           
            ]);

        $course = $req['course'];

    
        $seecontents = Workcontent::select('*')->where('course_id', '=', $req->course)->get();
      
        if (Workcontent::where('course_id', '=', $req->course)->count() > 0) {

             DB::table('workcontents')->where('course_id', '=', $req->course)->update(['status' => 0]);

             Session::flash('messagesuccess', 'the course Syllabus is available, you can download it');
            
            return view('file.seecontent')->withSeecontents($seecontents)->with('success', 'the Course Syllabus is available, you can download it.');
        }
        else{
            return redirect()->back()->with('error', 'the Syllabus for this course is not yet available');
        }

    }



    public function seeoutline(Request $req){

        $id = $req['id'];

        $scontents = Workcontent::select('*')->where('course_id', '=', $req->id)->get();
        $outlines = Outline::select('*')->where('course_id', '=', $req->id)->get();

        //return $getoutlines;
         return view('file.seeoutline', compact('scontents', 'outlines'));
    }


    public function UpdateOutline(Request $req){
        $course_id = $req['course_id'];

        $courses = Course::select('*')->where('id', $course_id)->get();
        $outlines = Outline::select('*')->where('course_id', $course_id)->get();

        return view('file.updateoutline')->withOutlines($outlines)->withCourses($courses);
    }

    public function UpdateOutlineFunction(Request $req){
        $course_id = $req['course_id'];
        $description = $req['description'];
        $number_subsection = $req['number_subsection'];
        $number_of_weeks = $req['number_of_weeks'];
        $number_of_assignment = $req['number_of_assignment'];
        $number_of_continuous_accessment = $req['number_of_continuous_accessment'];


       // DB::table('course_student')->where('course_id', '=', $req->course_id)->update(['status' => 0]);
        if ($description != '') {
            
        
       $syllabus = DB::table('outlines')->where('course_id', $course_id)->update(['description' => $description, 'number_subsection' => $number_subsection, 'number_of_weeks' => $number_of_weeks, 'number_of_assignment' => $number_of_assignment, 'number_of_continuous_accessment' => $number_of_continuous_accessment]);   

             Session::flash('success', 'the course outline was updated successfully!');

            return  redirect()->route('course_content');

        }else{Session::flash('error', 'fail to update the content'); return redirect()->back();}


    }

    public function seestudents(Request $req){
        $this->validate($req, [
            'select_course' => 'required',
        ]);

        $id = $req['select_course'];
        $courses = Course::where('id', '=', (int)$id)->get();
        $students = Course::find((int)$id);
       /* if ($req->ajax()) {
            return ['courses' => view('ajax.sload', compact('course'))];
        } */

        //view()->share('ajax.sload', $courses);
        return view('file.see_students', compact('courses', 'students'));
    }


     public function checkregister(){
        if (Auth::check()) {
           
        
        $firsts = Course::select('*')->where('user_id', '=', Auth::user()->id)->where('semester_id', '=', 1)->get();
        $seconds = Course::select('*')->where('user_id', '=', Auth::user()->id)->where('semester_id', '=', 2)->get();

        return view('file.check_register', compact('firsts', 'seconds'));
    }else{return redirect('/admin');}
    }

    public function coursecovered(){

        if(Auth::check()){
        
        $firsts = Course::select('*')->where('user_id', '=', Auth::user()->id)->where('semester_id', '=', 1)->get();
        $seconds = Course::select('*')->where('user_id', '=', Auth::user()->id)->where('semester_id', '=', 2)->get();

        return view('file.course_covered', compact('firsts', 'seconds'));
    }
    

    else{ return view('index')->with('error', 'not loggin');}
 }



    public function CourseCoveredFunction(Request $req){
        $this->validate($req, [
            'select_course' => 'required',
        ]);
        $id = $req['select_course'];

        $courses = Course::where('id', $id)->get();
        $registers = Register::where('course_id', $id)->get();
        $outlines = Outline::where('course_id', $id)->get();


        if (Register::where('course_id', $id)->count() > 4) {
           

//L1
        if (Register::where('course_id', $id)->where('L1', '=', null)->count() < 1) {
            $l1 = Register::where('course_id', $id)->where('L1', '=', 'A')->count();


        if ($l1 < 3) {
            
        $counter1 = 1;

        } else{ $counter1 = null;}
        }else { $counter1 = null;}

//L2
        if (Register::where('course_id', $id)->where('L2', '=', null)->count() < 1) {
            $l2 = Register::where('course_id', $id)->where('L2', '=', 'A')->count();


        if ($l2 < 3) {
            
        $counter2 = 1;

        } else{ $counter2 = null;}
        }else { $counter2 = null;}

//L3
       if (Register::where('course_id', $id)->where('L3', '=', null)->count() < 1) {
            $l3 = Register::where('course_id', $id)->where('L3', '=', 'A')->count();


        if ($l3 < 3) {
            
        $counter3 = 1;

        } else{ $counter3 = null;}
        }else { $counter3 = null;}

//L4
        if (Register::where('course_id', $id)->where('L4', '=', null)->count() < 1) {
            $l4 = Register::where('course_id', $id)->where('L4', '=', 'A')->count();


        if ($l4 < 3) {
            
        $counter4 = 1;

        } else{ $counter4 = null;}
        }else { $counter4 = null;}

//L5
        if (Register::where('course_id', $id)->where('L5', '=', null)->count() < 1) {
            $l5 = Register::where('course_id', $id)->where('L5', '=', 'A')->count();


        if ($l5 < 3) {
            
        $counter5 = 1;

        } else{ $counter5 = null;}
        }else { $counter5 = null;}

//L6 
        if (Register::where('course_id', $id)->where('L6', '=', null)->count() < 1) {
            $l6 = Register::where('course_id', $id)->where('L6', '=', 'A')->count();


        if ($l6 < 3) {
            
        $counter6 = 1;

        } else{ $counter6 = null;}
        }else { $counter6 = null;}

//L7 
        if (Register::where('course_id', $id)->where('L7', '=', null)->count() < 1) {
            $l7 = Register::where('course_id', $id)->where('L7', '=', 'A')->count();


        if ($l7 < 3) {
            
        $counter7 = 1;

        } else{ $counter7 = null;}
        }else { $counter7 = null;}

//L8 
        if (Register::where('course_id', $id)->where('L8', '=', null)->count() < 1) {
            $l8 = Register::where('course_id', $id)->where('L8', '=', 'A')->count();


        if ($l8 < 3) {
            
        $counter8 = 1;

        } else{ $counter8 = null;}
        }else { $counter8 = null;}

//L9 
        if (Register::where('course_id', $id)->where('L9', '=', null)->count() < 1) {
            $l9 = Register::where('course_id', $id)->where('L9', '=', 'A')->count();


        if ($l9 < 3) {
            
        $counter9 = 1;

        } else{ $counter9 = null;}
        }else { $counter9 = null;}

//L10 
        if (Register::where('course_id', $id)->where('L10', '=', null)->count() < 1) {
            $l10 = Register::where('course_id', $id)->where('L10', '=', 'A')->count();


        if ($l10 < 3) {
            
        $counter10 = 1;

        } else{ $counter10 = null;}
        }else { $counter10 = null;}

//L11 
        if (Register::where('course_id', $id)->where('L11', '=', null)->count() < 1) {
            $l11 = Register::where('course_id', $id)->where('L11', '=', 'A')->count();


        if ($l11 < 3) {
            
        $counter11 = 1;

        } else{ $counter11 = null;}
        }else { $counter11 = null;}

//L12 
        if (Register::where('course_id', $id)->where('L12', '=', null)->count() < 1) {
            $l12 = Register::where('course_id', $id)->where('L12', '=', 'A')->count();


        if ($l12 < 3) {
            
        $counter12 = 1;

        } else{ $counter12 = null;}
        }else { $counter12 = null;}

//L13 
        if (Register::where('course_id', $id)->where('L13', '=', null)->count() < 1) {
            $l13 = Register::where('course_id', $id)->where('L13', '=', 'A')->count();


        if ($l13 < 3) {
            
        $counter13 = 1;

        } else{ $counter13 = null;}
        }else { $counter13 = null;}
            
//L14 
        if (Register::where('course_id', $id)->where('L14', '=', null)->count() < 1) {
            $l14 = Register::where('course_id', $id)->where('L14', '=', 'A')->count();


        if ($l14 < 3) {
            
        $counter14 = 1;

        } else{ $counter14 = null;}
        }else { $counter14 = null;}

//L15 
        if (Register::where('course_id', $id)->where('L15', '=', null)->count() < 1) {
            $l15 = Register::where('course_id', $id)->where('L15', '=', 'A')->count();


        if ($l15 < 3) {
            
        $counter15 = 1;

        } else{ $counter15 = null;}
        }else { $counter15 = null;}

//L16 
        if (Register::where('course_id', $id)->where('L16', '=', null)->count() < 1) {
            $l16 = Register::where('course_id', $id)->where('L16', '=', 'A')->count();


        if ($l16 < 3) {
            
        $counter16 = 1;

        } else{ $counter16 = null;}
        }else { $counter16 = null;}

//L17 
        if (Register::where('course_id', $id)->where('L17', '=', null)->count() < 1) {
            $l17 = Register::where('course_id', $id)->where('L17', '=', 'A')->count();


        if ($l17 < 3) {
            
        $counter17 = 1;

        } else{ $counter17 = null;}
        }else { $counter17 = null;}

//L18 
        if (Register::where('course_id', $id)->where('L18', '=', null)->count() < 1) {
            $l18 = Register::where('course_id', $id)->where('L18', '=', 'A')->count();


        if ($l18 < 3) {
            
        $counter18 = 1;

        } else{ $counter18 = null;}
        }else { $counter18 = null;}

//L19 
        if (Register::where('course_id', $id)->where('L19', '=', null)->count() < 1) {
            $l19 = Register::where('course_id', $id)->where('L19', '=', 'A')->count();


        if ($l19 < 3) {
            
        $counter19 = 1;

        } else{ $counter19 = null;}
        }else { $counter19 = null;}

//L20 
        if (Register::where('course_id', $id)->where('L20', '=', null)->count() < 1) {
            $l20 = Register::where('course_id', $id)->where('L20', '=', 'A')->count();


        if ($l20 < 3) {
            
        $counter20 = 1;

        } else{ $counter20 = null;}
        }else { $counter20 = null;}

//L21 
        if (Register::where('course_id', $id)->where('L21', '=', null)->count() < 1) {
            $l21 = Register::where('course_id', $id)->where('L21', '=', 'A')->count();


        if ($l21 < 3) {
            
        $counter21 = 1;

        } else{ $counter21 = null;}
        }else { $counter21 = null;}

//L22 
        if (Register::where('course_id', $id)->where('L22', '=', null)->count() < 1) {
            $l22 = Register::where('course_id', $id)->where('L22', '=', 'A')->count();


        if ($l22 < 3) {
            
        $counter22 = 1;

        } else{ $counter22 = null;}
        }else { $counter22 = null;}

//L23 
        if (Register::where('course_id', $id)->where('L23', '=', null)->count() < 1) {
            $l23 = Register::where('course_id', $id)->where('L23', '=', 'A')->count();


        if ($l23 < 3) {
            
        $counter23 = 1;

        } else{ $counter23 = null;}
        }else { $counter23 = null;}

//L24 
        if (Register::where('course_id', $id)->where('L24', '=', null)->count() < 1) {
            $l24 = Register::where('course_id', $id)->where('L24', '=', 'A')->count();


        if ($l24 < 3) {
            
        $counter24 = 1;

        } else{ $counter24 = null;}
        }else { $counter24 = null;}

//L25 
        if (Register::where('course_id', $id)->where('L25', '=', null)->count() < 1) {
            $l25 = Register::where('course_id', $id)->where('L25', '=', 'A')->count();


        if ($l25 < 3) {
            
        $counter25 = 1;

        } else{ $counter25 = null;}
        }else { $counter25 = null;}

//L26 
        if (Register::where('course_id', $id)->where('L26', '=', null)->count() < 1) {
            $l26 = Register::where('course_id', $id)->where('L26', '=', 'A')->count();


        if ($l26 < 3) {
            
        $counter26 = 1;

        } else{ $counter26 = null;}
        }else { $counter26 = null;}

//L27 
        if (Register::where('course_id', $id)->where('L27', '=', null)->count() < 1) {
            $l27 = Register::where('course_id', $id)->where('L27', '=', 'A')->count();


        if ($l27 < 3) {
            
        $counter27 = 1;

        } else{ $counter27 = null;}
        }else { $counter27 = null;}
            
//L28 
        if (Register::where('course_id', $id)->where('L28', '=', null)->count() < 1) {
            $l28 = Register::where('course_id', $id)->where('L28', '=', 'A')->count();


        if ($l28 < 3) {
            
        $counter28 = 1;

        } else{ $counter28 = null;}
        }else { $counter28 = null;}

//L29 
        if (Register::where('course_id', $id)->where('L29', '=', null)->count() < 1) {
            $l29 = Register::where('course_id', $id)->where('L29', '=', 'A')->count();


        if ($l29 < 3) {
            
        $counter29 = 1;

        } else{ $counter29 = null;}
        }else { $counter29 = null;}


//L30 
        if (Register::where('course_id', $id)->where('L30', '=', null)->count() < 1) {
            $l30 = Register::where('course_id', $id)->where('L30', '=', 'A')->count();


        if ($l30 < 3) {
            
        $counter30 = 1;

        } else{ $counter30 = null;}
        }else { $counter30 = null;}
            


            $totalsuspended = $counter1 + $counter2 + $counter3 + $counter4 + $counter5 + $counter6 + $counter7 + $counter8 + $counter9 + $counter10 + $counter11 + $counter12 + $counter13 + $counter14 + $counter15 + $counter16 + $counter17 + $counter18 + $counter19 + $counter20 + $counter21 + $counter22 + $counter23 + $counter24 + $counter25 + $counter29 + $counter30; 



    // total time for the whole course during the current semester

    // lesson1
        $l1 = Register::where('course_id', $id)->where('L1', 'A')->count();

        if ($l1 > 2) {
            
            $lesson1 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 1)->get();


            foreach ($lesson1 as $one) {
                $time1 = strtotime($one->stop_time) - strtotime($one->start_time);

                $taught1 = $one->number_subsection;
            }


        } else{ $time1 = null; $taught1 = null; }

 // lesson2
        $l2 = Register::where('course_id', $id)->where('L2', 'A')->count();

        if ($l2 > 2) {
            
            $lesson2 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 2)->get();


            foreach ($lesson2 as $two) {
                $time2 = strtotime($two->stop_time) - strtotime($two->start_time);

                $taught2 = $two->number_subsection;
            }


        } else{ $time2 = null; $taught2 = null; }

// lesson3
        $l3 = Register::where('course_id', $id)->where('L3', 'A')->count();

        if ($l3 > 2) {
            
            $lesson3 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 3)->get();


            foreach ($lesson3 as $three) {
                $time3 = strtotime($three->stop_time)  - strtotime($three->start_time);

                $taught3 = $three->number_subsection;
            }


        } else{ $time3 = null; $taught3 = null; }

// lesson4
        $l4 = Register::where('course_id', $id)->where('L4', 'A')->count();

        if ($l4 > 2) {
            
            $lesson4 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 4)->get();


            foreach ($lesson4 as $four) {
                $time4 = strtotime($four->stop_time)  - strtotime($four->start_time);

                $taught4 = $four->number_subsection;
            }


        } else{ $time4 = null; $taught4 = null; }

// lesson5
        $l5 = Register::where('course_id', $id)->where('L5', 'A')->count();

        if ($l5 > 2) {
            
            $lesson5 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 5)->get();


            foreach ($lesson5 as $five) {
                $time5 = strtotime($five->stop_time)  - strtotime($five->start_time);

                $taught5 = $five->number_subsection;
            }


        } else{ $time5 = null; $taught5 = null; }

// lesson6
        $l6 = Register::where('course_id', $id)->where('L6', 'A')->count();

        if ($l6 > 2) {
            
            $lesson6 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 6)->get();


            foreach ($lesson6 as $six) {
                $time6 = strtotime($six->stop_time)  - strtotime($six->start_time);

                $taught6 = $six->number_subsection;
            }


        } else{ $time6 = null; $taught6 = null; }

// lesson7
        $l7 = Register::where('course_id', $id)->where('L7', 'A')->count();

        if ($l7 > 2) {
            
            $lesson7 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 7)->get();


            foreach ($lesson7 as $seven) {
                $time7 = strtotime($seven->stop_time)  - strtotime($seven->start_time);

                $taught7 = $seven->number_subsection;
            }


        } else{ $time7 = null; $taught7 = null; }


// lesson8
        $l8 = Register::where('course_id', $id)->where('L8', 'A')->count();

        if ($l8 > 2) {
            
            $lesson8 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 8)->get();


            foreach ($lesson8 as $eight) {
                $time8 = strtotime($eight->stop_time)  - strtotime($eight->start_time);

                $taught8 = $eight->number_subsection;
            }


        } else{ $time8 = null; $taught8 = null; }

// lesson9
        $l9 = Register::where('course_id', $id)->where('L9', 'A')->count();

        if ($l9 > 2) {
            
            $lesson9 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 9)->get();


            foreach ($lesson9 as $nine) {
                $time9 = strtotime($nine->stop_time)  - strtotime($nine->start_time);

                $taught9 = $nine->number_subsection;
            }


        } else{ $time9 = null; $taught9 = null; }

// lesson10
        $l10 = Register::where('course_id', $id)->where('L10', 'A')->count();

        if ($l10 > 2) {
            
            $lesson10 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 10)->get();


            foreach ($lesson10 as $ten) {
                $time10 = strtotime($ten->stop_time)  - strtotime($ten->start_time);

                $taught10 = $ten->number_subsection;
            }


        } else{ $time10 = null; $taught10 = null; }
// lesson11
        $l11 = Register::where('course_id', $id)->where('L11', 'A')->count();

        if ($l11 > 2) {
            
            $lesson11 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 11)->get();


            foreach ($lesson11 as $eleven) {
                $time11 = strtotime($eleven->stop_time)  - strtotime($eleven->start_time);

                $taught11 = $eleven->number_subsection;
            }


        } else{ $time11 = null; $taught11 = null; }

        // lesson12
        $l12 = Register::where('course_id', $id)->where('L12', 'A')->count();

        if ($l12 > 2) {
            
            $lesson12 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 12)->get();


            foreach ($lesson12 as $twelve) {
                $time12 = strtotime($twelve->stop_time)  - strtotime($twelve->start_time);

                $taught12 = $twelve->number_subsection;
            }


        } else{ $time12 = null; $taught12 = null; }

        // lesson13
        $l13 = Register::where('course_id', $id)->where('L13', 'A')->count();

        if ($l13 > 2) {
            
            $lesson13 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 13)->get();


            foreach ($lesson13 as $thirteen) {
                $time13 = strtotime($thirteen->stop_time)  - strtotime($thirteen->start_time);

                $taught13 = $thirteen->number_subsection;
            }


        } else{ $time13 = null; $taught13 = null; }

        // lesson14
        $l14 = Register::where('course_id', $id)->where('L14', 'A')->count();

        if ($l14 > 2) {
            
            $lesson14 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 14)->get();


            foreach ($lesson14 as $fourteen) {
                $time14 = strtotime($fourteen->stop_time)  - strtotime($fourteen->start_time);

                $taught14 = $fourteen->number_subsection;
            }


        } else{ $time14 = null; $taught14 = null; }

        // lesson15
        $l15 = Register::where('course_id', $id)->where('L15', 'A')->count();

        if ($l15 > 2) {
            
            $lesson15 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 15)->get();


            foreach ($lesson15 as $fiveteen) {
                $time15 = strtotime($fiveteen->stop_time)  - strtotime($fiveteen->start_time);

                $taught15 = $fiveteen->number_subsection;
            }


        } else{ $time15 = null; $taught15 = null; }

        // lesson16
        $l16 = Register::where('course_id', $id)->where('L16', 'A')->count();

        if ($l16 > 2) {
            
            $lesson16 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 16)->get();


            foreach ($lesson16 as $sixteen) {
                $time16 = strtotime($sixteen->stop_time)  - strtotime($sixteen->start_time);

                $taught16 = $sixteen->number_subsection;
            }


        } else{ $time16 = null; $taught16 = null; }

        // lesson17
        $l17 = Register::where('course_id', $id)->where('L17', 'A')->count();

        if ($l17 > 2) {
            
            $lesson17 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 17)->get();


            foreach ($lesson17 as $seventeen) {
                $time17 = strtotime($seventeen->stop_time)  - strtotime($seventeen->start_time);

                $taught17 = $seventeen->number_subsection;
            }


        } else{ $time17 = null; $taught17 = null; }

        // lesson18
        $l18 = Register::where('course_id', $id)->where('L18', 'A')->count();

        if ($l18 > 2) {
            
            $lesson18 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 18)->get();


            foreach ($lesson18 as $eighteen) {
                $time18 = strtotime($eighteen->stop_time)  - strtotime($eighteen->start_time);

                $taught18 = $eighteen->number_subsection;
            }


        } else{ $time18 = null; $taught18 = null; }

// lesson19
        $l19 = Register::where('course_id', $id)->where('L19', 'A')->count();

        if ($l19 > 2) {
            
            $lesson19 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 19)->get();


            foreach ($lesson19 as $nineteen) {
                $time19 = strtotime($nineteen->stop_time)  - strtotime($nineteen->start_time);

                $taught19 = $nineteen->number_subsection;
            }


        } else{ $time19 = null; $taught19 = null; }

        // lesson20
        $l20 = Register::where('course_id', $id)->where('L20', 'A')->count();

        if ($l20 > 2) {
            
            $lesson20 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 20)->get();


            foreach ($lesson20 as $twenty) {
                $time20 = strtotime($twenty->stop_time)  - strtotime($twenty->start_time);

                $taught20 = $twenty->number_subsection;
            }


        } else{ $time20 = null; $taught20 = null; }

        // lesson21
        $l21 = Register::where('course_id', $id)->where('L21', 'A')->count();

        if ($l21 > 2) {
            
            $lesson21 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 21)->get();


            foreach ($lesson21 as $twentyone) {
                $time21 = strtotime($twentyone->stop_time)  - strtotime($twentyone->start_time);

                $taught21 = $twentyone->number_subsection;
            }


        } else{ $time21 = null; $taught21 = null; }

        // lesson22
        $l22 = Register::where('course_id', $id)->where('L22', 'A')->count();

        if ($l22 > 2) {
            
            $lesson22 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 22)->get();


            foreach ($lesson22 as $twentytwo) {
                $time22 = strtotime($twentytwo->stop_time)  - strtotime($twentytwo->start_time);

                $taught22 = $twentytwo->number_subsection;
            }


        } else{ $time22 = null; $taught22 = null; }



        // lesson23
        $l23 = Register::where('course_id', $id)->where('L23', 'A')->count();

        if ($l23 > 2) {
            
            $lesson23 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 23)->get();


            foreach ($lesson23 as $twentythree) {
                $time23 = strtotime($twentythree->stop_time)  - strtotime($twentythree->start_time);

                $taught23 = $twentythree->number_subsection;
            }


        } else{ $time23 = null; $taught23 = null; }

        // lesson24
        $l24 = Register::where('course_id', $id)->where('L24', 'A')->count();

        if ($l24 > 2) {
            
            $lesson24 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 24)->get();


            foreach ($lesson24 as $twentyfour) {
                $time24 = strtotime($twentyfour->stop_time)  - strtotime($twentyfour->start_time);

                $taught24 = $twentyfour->number_subsection;
            }


        } else{ $time24 = null; $taught24 = null; }

// lesson25
        $l25 = Register::where('course_id', $id)->where('L25', 'A')->count();

        if ($l25 > 2) {
            
            $lesson25 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 25)->get();


            foreach ($lesson25 as $twentyfive) {
                $time25 = strtotime($twentyfive->stop_time)  - strtotime($twentyfive->start_time);

                $taught25 = $twentyfive->number_subsection;
            }


        } else{ $time25 = null; $taught25 = null; }

// lesson26
        $l26 = Register::where('course_id', $id)->where('L26', 'A')->count();

        if ($l26 > 2) {
            
            $lesson26 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 26)->get();


            foreach ($lesson26 as $twentysix) {
                $time26 = strtotime($twentysix->stop_time)  - strtotime($twentysix->start_time);

                $taught26 = $twentysix->number_subsection;
            }


        } else{ $time26 = null; $taught26 = null; }

// lesson27
        $l27 = Register::where('course_id', $id)->where('L27', 'A')->count();

        if ($l27 > 2) {
            
            $lesson27 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 27)->get();


            foreach ($lesson27 as $twentyseven) {
                $time27 = strtotime($twentyseven->stop_time)  - strtotime($twentyseven->start_time);

                $taught27 = $twentyseven->number_subsection;
            }


        } else{ $time27 = null; $taught27 = null; }


        // lesson28
        $l28 = Register::where('course_id', $id)->where('L28', 'A')->count();

        if ($l28 > 2) {
            
            $lesson28 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 28)->get();


            foreach ($lesson28 as $twentyeight) {
                $time28 = strtotime($twentyeight->stop_time)  - strtotime($twentyeight->start_time);

                $taught28 = $twentyeight->number_subsection;
            }


        } else{ $time28 = null; $taught28 = null; }


        // lesson29
        $l29 = Register::where('course_id', $id)->where('L29', 'A')->count();

        if ($l29 > 2) {
            
            $lesson29 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 29)->get();


            foreach ($lesson29 as $twentynine) {
                $time29 = strtotime($twentynine->stop_time)  - strtotime($twentynine->start_time);

                $taught29 = $twentynine->number_subsection;
            }


        } else{ $time29 = null; $taught29 = null; }

 // lesson30
        $l30 = Register::where('course_id', $id)->where('L30', 'A')->count();

        if ($l30 > 2) {
            
            $lesson30 = Taughtlesson::select('start_time', 'stop_time', 'number_subsection')->where('course_id', $id)->where('lesson_number', 30)->get();


            foreach ($lesson30 as $thirty) {
                $time30 = strtotime($thirty->stop_time)  - strtotime($thirty->start_time);

                $taught30 = $thirty->number_subsection;
            }


        } else{ $time30 = null; $taught30 = null; }





        $totaltimer = ($time1 + $time2 + $time3 + $time4 + $time5 + $time6 + $time7 + $time8 + $time9 + $time10+ $time11 + $time12 + $time13 + $time14 + $time15 + $time16 + $time17 + $time18 + $time19 + $time20 + $time21 + $time22 + $time23 + $time24 + $time25 + $time26 + $time27 + $time28 + $time29 + $time30)/3600;

        $totalpercent = ($taught1 + $taught2 + $taught3 + $taught4 + $taught5 + $taught6 + $taught7 + $taught8 + $taught9 + $taught10 + $taught11 + $taught12 + $taught13 + $taught14 + $taught15 + $taught16 + $taught17 + $taught18 + $taught19 + $taught20 + $taught21 + $taught22 + $taught23 + $taught24 + $taught25 + $taught26 + $taught27 + $taught28 + $taught29 + $taught30);

      $totaltime =  number_format((float)$totaltimer, 1, '.', '');


        return view('file.coveredview', compact('courses', 'registers', 'outlines'))->withTotalsuspended($totalsuspended)->withTotaltime($totaltime)->withTotalpercent($totalpercent);

        
        }

        else{
            Session::flash('message', 'No record exists for this course'); 
            return redirect()->back(); }

   
   
    }


    public function TeacherEndLecture(Request $req){

        $id = $req['id'];
        $year = $req['year_id'];
        $semester = $req['semester_id'];
        $department = $req['department_id'];
        $level = $req['level_id'];
        $time = $req['time'];
        $percentage = $req['percentage'];
        $totallecture = $req['totallecture'];
        $lectureconsidered = $req['lectureconsidered'];


        $statistic = new Statistic;

         $statistic->course_id = $id;
         $statistic->year_id = $year;
         $statistic->semester_id = $semester;
         $statistic->department_id = $department;
         $statistic->level_id = $level;
         $statistic->time = $time;
         $statistic->percent = $percentage;
         $statistic->total_lecture = $totallecture;
         $statistic->lecture_considered = $lectureconsidered;

         $statistic->save();

        Session::flash('success', 'You successfully ended lectures for this course, you can now see your statistics');

        return redirect()->back();
    }

    public function Outline(Request $req)
    {
        $code = $req['code'];

        $courses = Course::select('*')->where('code', '=', $req->code)->get();

        return view('file.outline')->withCourses($courses);
    }

   

    function checklogin(Request $req){
        $phone = $req->input('phone');
        $password = $req->input('password');
        $this->validate($req, [
            'phone' => 'required|',
            'password' => 'required|min:6']);
        $user_data = array(
            'phone' => $req->get('phone'),
            'password' => $req->get('password'));
    

    // attempt to log the user in
    if (Auth::attempt(['phone' => $req->phone, 'password' => $req->password], $req->remember)) {
        return redirect()->intended('/home');
  
    }

    else{
       if(Auth::guard('admin')->attempt(['email' => $req->phone, 'password' => $req->password], $req->rememberme)){ 
            return redirect()->route('admin.home');

        }
        
        else{
            //else return back with error

            return redirect()->back()->with('error', 'fail to login, wrong user email/phone number or password, check and try again');
        }
    }
    //return redirect()->back();


    }


    function logout(){
    Auth::logout();
    return redirect('/admin');
    }    
}
