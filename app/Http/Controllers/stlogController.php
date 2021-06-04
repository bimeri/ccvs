<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Student;

class stlogController extends Controller
{
     /**
    * shiw the appliation login form.
    * @return
    \Illuminate\Http\Response
    */

    public function loginform(){
    	return view('content.slogin');
    }

    protected function guard(){

        return Auth::guard('student');
    }

    
    use AuthenticatesUsers;

    /**
    * where to redirect user after login.
    *
    * @var string
    */

    protected $redirectTo = 'student.shome';


    /*create a new controller instance.
    *
    * @return void
    */

    public function __construct()
    {
    	$this->middleware('guest:student')->except('studentlogout');
    }

    public function slogin(Request $request){
    	//validate form data

    	$this->validate($request, [
    		'matricule' => 'required|',
    		'password' => 'required|'
    	]);

       //  $courses = Admin::select('*')->where('email','=', $request->email)->get();
    	//attempt to login the teacher
    	if(Auth::guard('student')->attempt(['matricule' => $request->matricule, 'password' => $request->password], $request->rememberme)){
    		//if successful return redirect
      
    		return redirect()->intended('shome');

    	}
        
    	else{
    		//else return back with error

    		return redirect()->back()->with('error', 'fail to login, wrong user matricule or password, check and try again');
    	}
    	

    }



     public function studentlogout(){
        Auth::guard('student')->logout();
        return redirect('/slogin');
    }
}
