<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Selectedstudent;
use App\Rejectedlesson;
use App\Register;
use Validator;
Use App\Course;
use Session;
use DB;


class studentregisterController extends Controller
{
     public function __construct()
	{
		$this->middleware('auth:student');
      //  $this->middleware('auth', ['except' => 'logout']);
	}


	// lesson one
	 public function lesson_one(Request $req)
	{
		$year = $req['year'];
		$semester = $req['semester'];
		$student_id =  Auth::user()->id;
		$course_id = $req['course_id'];
		$L1 =$req['L1'];

		if ($L1 != '') {

			if(!(Register::where('course_id', '=', $req->course_id)->where('student_id', Auth::user()->id))->exists() ){

		 DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]);

			$registers = new Register();

			$registers->year = $year;
			$registers->semester = $semester;
			$registers->student_id= $student_id;
			$registers->course_id = $course_id;
			$registers->L1 = $L1;
	

			$registers->save();
			
			if ($L1 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}
			Session::flash('success', 'you successfully marked lesson one in the register.');

			return redirect()->route('student.shome');
		
		}
	 
				else{

					 return back()->with('error', 'You have already marked this lesson');
								
				 }

	  }

				else{
					
					return back()->with('error', 'wrong filled form');
				} 



	}


	public function lesson_two(Request $req)
	{
		$course_id = $req['course_id'];
		$L2 = $req['L2'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L2')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L2' => $req->L2]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]);

			if ($L2 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

			 Session::flash('success', 'you successfully marked lesson two (2) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson number two');
		 return redirect()->route('student.shome');;

		}


	}

// lesson 3

	public function lesson_three(Request $req)
	{
		$course_id = $req['course_id'];
		$L3 = $req['L3'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L3')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L3' => $req->L3]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]);  

			if ($L3 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

			 Session::flash('success', 'you successfully marked lesson three (3) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson three');
		 return redirect()->route('student.shome');;

		}

			
	}

// lesson four
	public function lesson_four(Request $req)
	{
		$course_id = $req['course_id'];
		$L4 = $req['L4'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L4')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L4' => $req->L4]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]);   

			if ($L4 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}
			 Session::flash('success', 'you successfully marked lesson four (4) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson four');
		 return redirect()->route('student.shome');;

		}

	}

 // lesson five
	public function lesson_five(Request $req)
	{
		$course_id = $req['course_id'];
		$L5 = $req['L5'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L5')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L5' => $req->L5]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]);

			if ($L5 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}
			 Session::flash('success', 'you successfully marked lesson five (5) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson five');
		 return redirect()->route('student.shome');;

		}


	}
// lesson six
	public function lesson_six(Request $req)
	{
		$course_id = $req['course_id'];
		$L6 = $req['L6'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L6')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L6' => $req->L6]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]);   
			
			if ($L6 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}


			 Session::flash('success', 'you successfully marked lesson six (6) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson six');
		 return redirect()->route('student.shome');;

		}


	}
// lesson seven
	public function lesson_seven(Request $req)
	{
		$course_id = $req['course_id'];
		$L7 = $req['L7'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L7')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L7' => $req->L7]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]);   

			if ($L7 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}
			 Session::flash('success', 'you successfully marked lesson Seven (7) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson seven');
		 return redirect()->route('student.shome');;

		}


	}

// lesson Eight
	public function lesson_eight(Request $req)
	{
		$course_id = $req['course_id'];
		$L8 = $req['L8'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L8')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L8' => $req->L8]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]);   
			
			if ($L8 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}
			 Session::flash('success', 'you successfully marked lesson Eight (8) two in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson eight');
		 return redirect()->route('student.shome');;

		}


	}

// lesson nine
	public function lesson_nine(Request $req)
	{
		$course_id = $req['course_id'];
		$L9 = $req['L9'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L9')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L9' => $req->L9]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]);   

			if ($L9 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}
			 Session::flash('success', 'you successfully marked lesson Nine (9) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson nine');
		 return redirect()->route('student.shome');;

		}


	}


// lesson ten
	public function lesson_ten(Request $req)
	{
		$course_id = $req['course_id'];
		$L10 = $req['L10'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L10')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L10' => $req->L10]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]);   
			
			if ($L10 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}



			 Session::flash('success', 'you successfully marked lesson Ten (10) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson ten');
		 return redirect()->route('student.shome');;

		}


	}

// lesson eleven
	public function lesson_eleven(Request $req)
	{
		$course_id = $req['course_id'];
		$L11 = $req['L11'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L11')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L11' => $req->L11]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]);   

			if ($L11 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}
			 Session::flash('success', 'you successfully marked lesson Eleven (11) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson eleven');
		 return redirect()->route('student.shome');;

		}


	}

// twelve
	public function lesson_twelve(Request $req)
	{
		$course_id = $req['course_id'];
		$L12 = $req['L12'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L12')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L12' => $req->L12]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L12 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Twelve (12) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson twelve');
		 return redirect()->route('student.shome');;

		}


	}
// thirteen
	public function lesson_thirteen(Request $req)
	{
		$course_id = $req['course_id'];
		$L13 = $req['L13'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L13')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L13' => $req->L13]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L13 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Thirteen (13) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson thirteen');
		 return redirect()->route('student.shome');;

		}


	}
// fourteen
	public function lesson_fourteen(Request $req)
	{
		$course_id = $req['course_id'];
		$L14 = $req['L14'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L14')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L14' => $req->L14]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L14 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}
		 Session::flash('success', 'you successfully marked lesson Fourteen (14) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson fourteen');
		 return redirect()->route('student.shome');;

		}


	}
// fiveteen
	public function lesson_fiveteen(Request $req)
	{
		$course_id = $req['course_id'];
		$L15 = $req['L15'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L15')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L15' => $req->L15]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L15 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}
		 Session::flash('success', 'you successfully marked lesson Fiveteen (15) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson fiveteen');
		 return redirect()->route('student.shome');;

		}


	}
// sixteen
	public function lesson_sixteen(Request $req)
	{
		$course_id = $req['course_id'];
		$L16 = $req['L16'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L16')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L16' => $req->L16]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L16 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Sixteen (16) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson sixteen');
		 return redirect()->route('student.shome');;

		}


	}
// seventeen
	public function lesson_seventeen(Request $req)
	{
		$course_id = $req['course_id'];
		$L17 = $req['L17'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L17')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L17' => $req->L17]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L17 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Seventeen (17) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson seventeen');
		 return redirect()->route('student.shome');;

		}


	}
// eighteen
	public function lesson_eighteen(Request $req)
	{
		$course_id = $req['course_id'];
		$L18 = $req['L18'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L18')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L18' => $req->L18]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L18 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Eighteen (18) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson eight');
		 return redirect()->route('student.shome');;

		}


	}
// nineteen
	public function lesson_nineteen(Request $req)
	{
		$course_id = $req['course_id'];
		$L19 = $req['L19'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L19')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L19' => $req->L19]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L19 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Nineteen (19) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson nineteen');
		 return redirect()->route('student.shome');;

		}


	}
// twenty
	public function lesson_twenty(Request $req)
	{
		$course_id = $req['course_id'];
		$L20 = $req['L20'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L20')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L20' => $req->L20]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L20 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Twenty (20) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson twenty');
		 return redirect()->route('student.shome');;

		}


	}// twenty-one
	public function lesson_twenty_one(Request $req)
	{
		$course_id = $req['course_id'];
		$L21 = $req['L21'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L21')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L21' => $req->L21]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L21 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Twenty-one (21) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson twenty-one');
		 return redirect()->route('student.shome');;

		}


	}// twenty-two
	public function lesson_twenty_two(Request $req)
	{
		$course_id = $req['course_id'];
		$L22 = $req['L22'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L22')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L22' => $req->L22]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L22 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Twenty-two (22) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson twenty_two');
		 return redirect()->route('student.shome');;

		}


	}// twenty_three
	public function lesson_twenty_three(Request $req)
	{
		$course_id = $req['course_id'];
		$L23 = $req['L23'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L23')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L23' => $req->L23]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L23 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Twenty-three (23) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson twenty-three');
		 return redirect()->route('student.shome');;

		}


	}// twenty_four
	public function lesson_twenty_four(Request $req)
	{
		$course_id = $req['course_id'];
		$L24 = $req['L24'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L24')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L24' => $req->L24]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L24 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Twenty-four (24) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson twenty-four');
		 return redirect()->route('student.shome');;

		}


	}// twenty-five
	public function lesson_twenty_five(Request $req)
	{
		$course_id = $req['course_id'];
		$L25 = $req['L25'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L25')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L25' => $req->L25]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L25 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Twenty-five (25) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson twenty-five');
		 return redirect()->route('student.shome');;

		}


	}// twenty-six
	public function lesson_twenty_six(Request $req)
	{
		$course_id = $req['course_id'];
		$L26 = $req['L26'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L26')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L26' => $req->L26]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L26 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Twenty-six (26) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson twenty-six');
		 return redirect()->route('student.shome');;

		}


	}// twenty-seven
	public function lesson_twenty_seven(Request $req)
	{
		$course_id = $req['course_id'];
		$L27 = $req['L27'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L27')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L27' => $req->L27]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L27 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Twenty-seven (27) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson twenty-seven');
		 return redirect()->route('student.shome');;

		}


	}// twenty-eight
	public function lesson_twenty_eight(Request $req)
	{
		$course_id = $req['course_id'];
		$L28 = $req['L28'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L28')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L28' => $req->L28]); 

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]);

			if ($L28 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Twenty-eight (28) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson twenty-eight');
		 return redirect()->route('student.shome');;

		}


	}// twenty-nine
	public function lesson_twenty_nine(Request $req)
	{
		$course_id = $req['course_id'];
		$L29 = $req['L29'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L29')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L29' => $req->L29]);

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]); 

			if ($L29 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Twenty-nine (29) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson twenty-nine');
		 return redirect()->route('student.shome');;

		}


	}// thirty
	public function lesson_thirty(Request $req)
	{
		$course_id = $req['course_id'];
		$L30 = $req['L30'];

		if(Register::where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->whereNull('L30')->exists() )
		{
			DB::table('registers')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['L30' => $req->L30]); 

			DB::table('selectedstudents')->where('course_id', '=', $req->course_id)->where('student_id', '=', Auth::user()->id)->update(['status' => 0]);

			if ($L30 == 'D') {
				$year = $req['year'];
				$lesson_number = $req['lesson_number'];
				$reason = $req['reason'];
				$student_id = Auth::user()->id;

				 $rejectedlesson = new Rejectedlesson;

            $rejectedlesson->year = $year;
            $rejectedlesson->course_id = $course_id;
            $rejectedlesson->student_id = $student_id;
            $rejectedlesson->lesson_number = $lesson_number;
            $rejectedlesson->reason = $reason;

            $rejectedlesson->save();

			}

		 Session::flash('success', 'you successfully marked lesson Thirty (30) in the register.');

			return redirect()->route('student.shome');
		}

		else{
			 Session::flash('error', 'You have already marked lesson thirty');
		 return redirect()->route('student.shome');;

		}


	}

}
