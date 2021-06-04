<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Admin;

class adminLoginController extends Controller
{
    /**
    * shiw the appliation login form.
    * @return
    \Illuminate\Http\Response
    */

    public function showLoginForm(){
    	return view('index');
    }
    protected function guard(){

        return Auth::guard('admin');
    }

    
    use AuthenticatesUsers;

    /**
    * where to redirect user after login.
    *
    * @var string
    */

    protected $redirectTo = '/adminhome';


    /*create a new controller instance.
    *
    * @return void
    */

    public function __construct()
    {
    	$this->middleware('guest:admin')->except('adminlogout');
    }

    public function login(Request $request){
    	//validate form data

    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);

    	if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->rememberme)){ 
    		return redirect()->route('admin.home');

    	}
        
    	else{
    		//else return back with error

    		return redirect()->back()->with('error', 'fail to login, wrong user email or password, check and try again');
    	}
    	

    }


    public function adminlogout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
