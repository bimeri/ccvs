<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workcontent;
use App\Course;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use Validator;
use App\User;
use Session;
use App\Semester; 
use DB;

class syllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
      //  $this->middleware('auth', ['except' => 'logout']);
    }


    public function index()
    {
        //return view('admin.view_syllabus');
    }

    public function EditContent()
    {
        return view('admin.editcontent');
    }

   public function view(Request $req){
        $this->validate($req, [
            'course_id' => 'required'
        ]);

        $course_id = $req['course_id'];


        $courses = DB::table('courses')->select('*')->where('id','=', $req->course_id)->get();
        $contents = DB::table('Workcontents')->select('*')->where('course_id','=', $req->course_id)->get();

        if (count([$contents]) < 0) {

            Session::flash('alarmred', 'Course don\'t have a Syllabus');
           return redirect()->route('admin.syllabus');
        }
        else

        // return count([$contents]);
        return view('admin.view_syllabus', compact('courses', 'contents'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
       
        $id = $req['id'];

        $courses = Course::select('*')->where('id', $id)->get();

        if (!(Workcontent::where('course_id', '=', $id)->exists())){
            foreach ($courses as $course) {
                if ($course->department_id != Auth::user()->department->id) {

                    Session::flash('alarmred', 'You don\'t have access to this course');
                    return redirect()->route('admin.syllabus');
                } else{

        $courses = DB::table('courses')->select('*')->where('id','=', $id)->get();
        $departments = DB::table('departments')->get();
        
        Session::flash('alarm', 'you are ready to create the Syllabus');
        return view('admin.create-syllabus', compact('departments', 'courses'));
            }
        }
        
    }
    else{
        return redirect()->back()->with('error', 'The Syllabus already exist for this course, a course can\'t have more than one syllabus');
    }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
    
            'description' =>'required',
            'main_content' => 'required',

            
        ]);
         //requesting the values

      
        $description = $request['description'];
        $main_content = $request['main_content'];
        $course_id = $request['course_id'];
        $admin_id = $request['admin_id'];

        if ($description != '' || $main_content != '') {


           
       
        $schemes = new Workcontent;

     
        $schemes->description= $description;        
        $schemes->main_content = $main_content;
        $schemes->course_id = $course_id;
        $schemes->admin_id = $admin_id;


        $schemes->save();

        return redirect()->route('admin.syllabus')->with('success', 'course Syllabus was successfully created');
 
        }
        else {
            return redirect()->route('admin.syllabus')->with('error', 'fail to create the course Syllabus, try again !!');
        }


    }


    public function delete(Request $req)
    {
        $user_id = $req['content_id'];
        $course_id = $req['course_id'];

        DB::table('course_student')->where('course_id', '=', $req->course_id)->update(['status' => 0]);
       $syllabus = DB::table('Workcontents')->where('id', '=', $req->content_id)->delete();   

             Session::flash('success', 'the course Syllabus has been deleted successfully!');

            return  redirect()->route('admin.syllabus');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //return view('admin.create');
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
         $course_id = $request['course_id'];

         $courses = Course::where('id', '=', $request->course_id)->get();
        $workcontents = Workcontent::where('course_id', '=', $request->course_id)->get();
        return view('admin.editcontent', compact('workcontents', 'courses'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateContent(Request $req)
    {
        $this->validate($req, [
            'course_id' => 'required|',
            'description' => 'required|',
            'main_content' => 'required|',
            
            ]);

        $course_id = $req['course_id'];
        $description = $req['description'];
        $main_content = $req['main_content'];
   

        if(Workcontent::where('course_id', '=', $req->course_id)->count() > 0 ){


            DB::table('course_student')->where('course_id', '=', $req->course_id)->update(['status' => 1]);
            DB::table('workcontents')->where('course_id', $req->course_id)->update(['main_content' => $main_content, 'description' => $description, 'status' => 1]); 
            
          Session::flash('success', 'Course Syllabus has been successfully Updated');

            return redirect()->route('admin.syllabus');
            
            
        }


        else{

            return redirect()->back()->with('error', 'fail to update, try to create the Syllabus first');
        } 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
