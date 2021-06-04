{{-- marking the register for real, thirty lessons total --}}

<!DOCTYPE html>
<html>
<head>


	<title>mark register</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="{{URL::asset('js/jquery-3.2.1.js')}}"></script>
	<script src="{{URL::asset('js/jquery-1.9.0.min.js')}}"></script>
	<script src="{{URL::asset('js/jquery.js')}}"></script>
	<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('materialize/css/materialize.css')}}">
	@yield('style') <!-- a link to shutcut image -->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/style/w3.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/style/w3-school.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/style/student.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('style/st.css')}}">
	<script>
		$(document).ready(function(){
			$("#submit").hide();
			$("#radio").click(function(){
				$("#submit").show();
			});$("#radio1").click(function(){
				$("#submit").show();
			});$("#radio2").click(function(){
				$("#submit").show();
			});$("#radio3").click(function(){
				$("#submit").show();
			});
		});
	</script>
	<style>
		.tab {
    overflow-x: auto;
    overflow-y: hidden;
    margin-top: -100px;
    border-bottom: 2px solid #fff;
}

}

/* Style the buttons inside the tab */
.tab a {
    background-color: inherit;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 15px;
}


/* Create an active/current tablink class */
.tab a.activ {
  color: #00ccff;
    background-color: #fff !important;
}

#message{
  position: absolute;
  top: 70px;
  font-size: 30px;
  right: 200px;
}
#message1{
  position: absolute;
  top: 70px;
  font-size: 25px;
  right: 120px;
  width: 3.2%;
  box-shadow: 0px 3px 4px 2px rgba(0,0,0,0.2);
  background-color: #00cccc !important;
}
#name{
  position: absolute;
  top: 25px;
  font-size: 17px;
  right: 230px;
  text-transform: uppercase;
  font-family: New Times Roman;

}
#messagecount{
  position: absolute;
  top: 75px;
  right: 210px;
  z-index: 10;
  opacity: .8;
}
#dropbtn{
  position: absolute;
  top: 50px;
  right: 40px;
}
.yearandsemester{
  text-transform: capitalize;
  color: #0a6fc2;
}
	</style>
</head>
<body>

<div class="col s12 header-r">
	<img src="images/2.png" class="w3-circle w3-border-white w3-margin dropbtn dropdown-button right" height="50" width="50" alt="logo" id="dropbtn">
  <a href="#"><i class="mdi-communication-email right white-text" id="message"></i></a>

	<i class="w3-badge-special right w3-circle w3-border hidden-xs" id="message1">
    <small><b class="w3-badge w3-white w3-medium" style="margin-bottom: 8px !important;"><small class="w3-color-text2">?</small></b></small>
  </i>
  
  <p class="right name w3-margin w3-padding-large" id="name">{{ Auth::user()->name }} ({{ Auth::user()->matricule }})<br>
   <b class="yearandsemester"style="font-size: 15px;"> @foreach($semesters = App\Semester::where('active', 1)->get() as $semester){{ $semester->name }},@endforeach  @foreach($years= App\Year::where('active', 1)->get() as $year){{ $year->year }}@endforeach</b></p><br>
 

<p class="w3-large hidden-xs w3-margin w3-padding white-text head1"><b class="w3-xlarge">{{ __('Go-Student')  }}</b><br><small class="w3-color-text">{{ __('The University of Buea') }}</small></p>

</div>


<a href="#" class="waves-effect waves-light w3-btn-floating-large w3-theme-action w3-right w3-hide-large w3-hide-medium" id="floating-btn">+</a>


				<div class="w3-border w3-padding dropdown-content1 right"  id="myDropdown" style="top: 150px">
			        <ul>
			            <a href="#">
			            	<span class="mdi-action-account-circle" id="span-in">&nbsp;Profile
			            	</span>
			            </a><hr class="divide">
			            <a href="#">
			            	<span class="mdi-content-create" id="span-in">&nbsp;Change Password
			            	</span>
			            </a><hr class="divide">
			            <a href="#">
			            	<span class="mdi-action-supervisor-account" id="span-in">&nbsp;User Account
			            	</span>
			            </a><hr class="divide">
			              <a href="/studentlogout">
			              	<strong id="dropdown-logout"><i class="mdi-action-settings-power"></i>&nbsp;logout {{ Auth::user()->name }}</strong>
			              </a>
			        </ul>
     			</div>

<!--tabs -->@include('file.message')
@foreach($selectedcourse as $selected)
@foreach($currentYear = App\Year::where('active', 1)->get() as $current)
<div class="row">
	<div class="container">
		
		<div class="w3-white w3-border col s12 m12 l12 s-r">
			<div class="w3-margin">
				

					<div class="container w3-margin">
						<h4 class="w3-center blue-text w3-xlarge">Knowledge With Wisdom</h4>

						<div class="row">
							<hr class="col s12 l11 m12 divide">
							<div class="col s12 l6 m6">
								<p class="left w3-medium w3-margin">
									<b>UNIVERSITY OF BUEA</b><br>
									<b>Department:</b> {{ $selected->course->department->name }}<br>
									<b>Student Name:</b> {{ $selected->student->name }}<br>
								</p>
							</div>

							<div class="col s12 l5 m6">
								<p class="right w3-medium w3-padding">

									<b>Course Master:</b> {{ $selected->course->user->fname }} 
														  {{ $selected->course->user->lname }}<br>
									<b>Course Code:</b> {{ $selected->course->code }}<br>
									<b>Course Title:</b> {{ $selected->course->title }}
								</p>
							</div>

							
						</div><h4 class="center black-text w3-large w3-text">Course Register Marking</h4>
								<hr class="col s12 l11 m12">
					</div>
			
			</div>

			{{-- the main register marking --}}


				<div class="white-text w3-margin w3-center w3-border w3-orange">
					 <span onclick="this.parentElement.style.display='none'" class="w3-close right w3-padding-xlarge w3-large w3-margin-top black-text w3-opacity w3-hover">x</span>

						<p class="w3-margin w3-center white-text"><b>Hi <b class="black-text"><i>{{ Auth::user()->name }},</i></b> 
							@lang('messages.lesson_acceptance_caption')</b>
						</p>

				</div><hr>
			

			{{-- starting with lesson one --}}


			{{-- @if(App\Register::where('course_id', '=', $selected->course->id)->where('L1', null)->count() == 0)--}}
				{{-- lesson 1 form here--}}


@if(!(App\Register::where('course_id', '=', $selected->course->id)->where('student_id', Auth::user()->id))->exists())	
							<center>
								@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 1)->count() > 0)

									@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 1)->get() as $taughtlesson)
										<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
												<p class="heading w3-xlarge">Mark Lesson number <b id="notification">one (1)</b>, start of lecture</p>
												<hr><br>
												
													<div class="row">
											        	<div class="col s12 l12 m12">
											          		<p class="w3-large">The lecturer claims the following was taught<p><br>
												          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
												          		</div>
											        	</div>
											        </div>

											        <div class="row">
												        <div class="col s11 m12 l7 w3-margin w3-border">
												         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

						   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

												        </div>
												         
											      	</div>

											      	<div class="row">
												        <div class="col s11 m11 l7 w3-margin w3-border">
												      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
												      	</div>
											      	</div>
											      	<hr class="divide">

											      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

											      	{{-- agreement form for lesson 1 --}}
											      	<div class="row w3-border">
												      	<form action="{{ route('lessonone') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
															{{ csrf_field() }}
															<input type="hidden" name="year" value="{{ $current->year }}">
															<input type="hidden" name="semester" value="{{ $selected->course->semester->name }}">
															<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
															<input type="hidden" name="L1" value="A">

													      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
												      	</form>


												      	{{-- disagreement form for lesson 1 --}}
												  
													<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id01').style.display='block'">disagree</a>
												    </div>	
												</div>

<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 1</p>
       <form action="{{ route('lessonone') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			@foreach($currentSemester = App\Semester::where('active', 1)->get() as $currentsem)
			<input type="hidden" name="semester" value="{{ $currentsem->name }}">
			@endforeach
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L1" value="D">
			<input type="hidden" name="lesson_number" value="1">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
										
									@endforeach
								
							
							 @else
								<script type="text/javascript">
																
									window.location='/student_markregister';
																
									{{ Session(['error' => 'Lesson one has not yet been uploaded by the lecturer, try later']) }}
								</script>
							@endif
							</center>




			{{--@elseif(App\Register::where('course_id', '=', $selected->course->id)->whereNull('L2')->count() < 0) --}}

@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L2')->exists())					
					@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 2)->count() > 0)
							<center>
								{{-- lesson two  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 2)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Two (2)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 2 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessontwo') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L2" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 2 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id02').style.display='block'">disagree</a>
												    </div>	
												</div>

<div id="id02" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id02').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 2</p>
       <form action="{{ route('lessontwo') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L2" value="D">
			<input type="hidden" name="lesson_number" value="2">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson two has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif






			@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L3')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 3)->count() > 0)
							<center>
								{{-- lesson three  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 3)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Three (3)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 3 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessonthree') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														
														<input type="hidden" name="L3" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green">														
												      		<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
												      		<input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 3 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id03').style.display='block'">disagree</a>
												    </div>	
												</div>

<div id="id03" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id03').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 3</p>
       <form action="{{ route('lessonthree') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L3" value="D">
			<input type="hidden" name="lesson_number" value="3">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson three has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
																
																									
																
																									
						
			@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L4')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 4)->count() > 0)
							<center>
								{{-- lesson four  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 4)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Four (4)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 4 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessonfour') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L4" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green">
												      		
												      		<input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 4 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id04').style.display='block'">disagree</a>
												    </div>	
												</div>

<div id="id04" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id04').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 4</p>
       <form action="{{ route('lessonfour') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L4" value="D">
			<input type="hidden" name="lesson_number" value="4">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson four has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif






			@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L5')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 5)->count() > 0)
							<center>
								{{-- lesson five  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 5)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Five (5)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 5 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessonfive') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L5" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green">
												      		<input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 5 --}}
											      	
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id05').style.display='block'">disagree</a>
												    </div>	
												</div>

<div id="id05" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id05').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 5</p>
       <form action="{{ route('lessonfive') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="text" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L5" value="D">
			<input type="hidden" name="lesson_number" value="5">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		        <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true"/>
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered"/>
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>

									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson five has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							








@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L6')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 6)->count() > 0)
							<center>
								{{-- lesson six  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 6)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Six (6)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 6 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessonsix') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L6" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 6 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id06').style.display='block'">disagree</a>
												    </div>
									</div>

<div id="id06" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id06').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 6</p>
       <form action="{{ route('lessonsix') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L6" value="D">
			<input type="hidden" name="lesson_number" value="6">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>		
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson six has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							









@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L7')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 7)->count() > 0)
							<center>
								{{-- lesson seven  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 7)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Seven (7)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 7 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessonseven') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L7" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 7 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id07').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id07" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id07').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagree with lesson 7</p>
       <form action="{{ route('lessonseven') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L7" value="D">
			<input type="hidden" name="lesson_number" value="7">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson seven has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							







@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L8')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 8)->count() > 0)
							<center>
								{{-- lesson eight  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 8)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Eight (8)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 8 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessoneight') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L8" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 8 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id08').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id08" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id08').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 8</p>
       <form action="{{ route('lessoneight') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L8" value="D">
			<input type="hidden" name="lesson_number" value="8">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson eight has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							








@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L9')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 9)->count() > 0)
							<center>
								{{-- lesson nine --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 9)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Nine (9)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 9 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessonnine') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L9" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 9 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id09').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id09" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id09').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 9</p>
       <form action="{{ route('lessonnine') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L9" value="D">
			<input type="hidden" name="lesson_number" value="9">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson nine has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							








@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L10')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 10)->count() > 0)
							<center>
								{{-- lesson ten  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 10)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Ten (10)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 10 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessonten') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L10" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 10 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id010').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id010" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id010').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 10</p>
       <form action="{{ route('lessonten') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L10" value="D">
			<input type="hidden" name="lesson_number" value="10">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson ten has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							






@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L11')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 11)->count() > 0)
							<center>
								{{-- lesson eleven  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 11)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Eleven (11)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ $taughtlesson->start_time }}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ $taughtlesson->stop_time }}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 11 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessoneleven') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L11" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 11 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id011').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id011" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id011').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagree with lesson 11</p>
       <form action="{{ route('lessoneleven') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L11" value="D">
			<input type="hidden" name="lesson_number" value="11">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson eleven has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							






@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L12')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 12)->count() > 0)
							<center>
								{{-- lesson 12  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 12)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Twelve (12)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 12 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessontwelve') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L12" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 12 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id012').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id012" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id012').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagree with lesson 12</p>
       <form action="{{ route('lessontwelve') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L12" value="D">
			<input type="hidden" name="lesson_number" value="12">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson twelve has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							






@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L13')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 13)->count() > 0)
							<center>
								{{-- lesson 13  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 13)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Thirteen (13)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 13 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessonthirteen') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L13" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 13 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id013').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id013" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id013').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagree with lesson 13</p>
       <form action="{{ route('lessonthirteen') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L13" value="D">
			<input type="hidden" name="lesson_number" value="13">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Thirteen has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							






@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L14')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 14)->count() > 0)
							<center>
								{{-- lesson 13  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 14)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Fourteen (14)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 14--}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessonfourteen') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L14" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 14 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id014').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id014" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id014').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagree with lesson 14</p>
       <form action="{{ route('lessonfourteen') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L14" value="D">
			<input type="hidden" name="lesson_number" value="14">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Fourteen has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							






@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L15')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 15)->count() > 0)
							<center>
								{{-- lesson 15  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 15)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Fiveteen (15)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 15--}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessonfiveteen') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L15" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 15 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id015').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id015" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id015').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagree with lesson 15</p>
       <form action="{{ route('lessonfiveteen') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L15" value="D">
			<input type="hidden" name="lesson_number" value="15">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Fiveteen has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							








@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L16')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 16)->count() > 0)
							<center>
								{{-- lesson 16  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 16)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Sixteen (16)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 16--}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessonsixteen') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L16" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 16 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id016').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id016" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id016').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagree with lesson 16</p>
       <form action="{{ route('lessonsixteen') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L16" value="D">
			<input type="hidden" name="lesson_number" value="16">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Sixteen has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif








			@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L17')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 17)->count() > 0)
							<center>
								{{-- lesson 17  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 17)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Seventeen (17)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 17--}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessonseventeen') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L17" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 17 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id017').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id017" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id017').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 17</p>
       <form action="{{ route('lessonseventeen') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L17" value="D">
			<input type="hidden" name="lesson_number" value="17">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Seventeen has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							









@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L18')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 18)->count() > 0)
							<center>
								{{-- lesson 18  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 18)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Eightteen (18)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 18 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessoneighteen') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L18" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 18 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id018').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id018" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id018').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 18</p>
       <form action="{{ route('lessoneighteen') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L18" value="D">
			<input type="hidden" name="lesson_number" value="18">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Eighteen has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							









@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L19')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 19)->count() > 0)
							<center>
								{{-- lesson 19  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 19)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Nineteen (19)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 19 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessonnineteen') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L19" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 19 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id019').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id019" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id019').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 19</p>
       <form action="{{ route('lessonnineteen') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L19" value="D">
			<input type="hidden" name="lesson_number" value="19">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Nineteen has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							









@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L20')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 20)->count() > 0)
							<center>
								{{-- lesson 20  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 20)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Twenty (20)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 20 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessontwenty') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L20" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 20 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id020').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id020" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id020').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 20</p>
       <form action="{{ route('lessontwenty') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L20" value="D">
			<input type="hidden" name="lesson_number" value="20">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Twenty has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							





@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L21')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 21)->count() > 0)
							<center>
								{{-- lesson 21  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 21)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Twenty-One (21)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 21 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessontwentyone') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L21" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 21 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id021').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id021" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id021').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 21</p>
       <form action="{{ route('lessontwentyone') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L21" value="D">
			<input type="hidden" name="lesson_number" value="21">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Twenty-One has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							






@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L22')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 22)->count() > 0)
							<center>
								{{-- lesson 22  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 22)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Twenty-Two (22)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 22 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessontwentytwo') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L22" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 22 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id022').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id022" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id022').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 22</p>
       <form action="{{ route('lessontwentytwo') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L22" value="D">
			<input type="hidden" name="lesson_number" value="22">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Twenty-Two has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							






@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L23')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 23)->count() > 0)
							<center>
								{{-- lesson 23  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 23)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Twenty-Three (23)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 23 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessontwentythree') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L23" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 23 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id023').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id023" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id023').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 23</p>
       <form action="{{ route('lessontwentythree') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L23" value="D">
			<input type="hidden" name="lesson_number" value="23">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Twenty-Three has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							





@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L24')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 24)->count() > 0)
							<center>
								{{-- lesson 24  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 24)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Twenty-Four (24)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 24 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessontwentyfour') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L24" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 24 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id024').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id024" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id024').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 24</p>
       <form action="{{ route('lessontwentyfour') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L24" value="D">
			<input type="hidden" name="lesson_number" value="24">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Twenty-Four has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							






@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L25')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 25)->count() > 0)
							<center>
								{{-- lesson 25  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 25)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Twenty-Five (25)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 25 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessontwentyfive') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L25" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 25 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id025').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id025" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id025').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 25</p>
       <form action="{{ route('lessontwentyfive') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L25" value="D">
			<input type="hidden" name="lesson_number" value="25">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Twenty-Five has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							






@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L26')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 26)->count() > 0)
							<center>
								{{-- lesson 26  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 26)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Twenty-Six (26)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 26 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessontwentysix') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L26" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 26 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id026').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id026" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id026').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 26</p>
       <form action="{{ route('lessontwentysix') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L26" value="D">
			<input type="hidden" name="lesson_number" value="26">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>						
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Twenty-Six has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							






@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L27')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 27)->count() > 0)
							<center>
								{{-- lesson 27  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 27)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Twenty-Seven (27)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 27 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessontwentyseven') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L27" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 27 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id027').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id027" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id027').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 27</p>
       <form action="{{ route('lessontwentyseven') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L27" value="D">
			<input type="hidden" name="lesson_number" value="27">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Twenty-Seven has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							







@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L28')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 28)->count() > 0)
							<center>
								{{-- lesson 28  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 28)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Twenty-Eight (28)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 278 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessontwentyeight') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L28" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 28 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id028').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id028" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id028').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 28</p>
       <form action="{{ route('lessontwentyeight') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L28" value="D">
			<input type="hidden" name="lesson_number" value="28">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Twenty-Eight has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							






@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L29')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 29)->count() > 0)
							<center>
								{{-- lesson 29  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 29)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Twenty-Nine (29)</b></p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 29 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessontwentynine') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L29" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 29 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id029').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id029" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id029').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 29</p>
       <form action="{{ route('lessontwentynine') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L29" value="D">
			<input type="hidden" name="lesson_number" value="29">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Twenty-Nine has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							






@elseif(\App\Register::where('course_id', '=', $selected->course->id)->where('student_id', '=', Auth::user()->id)->whereNull('L30')->exists())					
				@if( App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 30)->count() > 0)
							<center>
								{{-- lesson 30  --}}
									

								@foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $selected->course->id)->where('lesson_number', '=', 30)->get() as $taughtlesson)


									<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable m-r-s" id="#">
											<p class="heading w3-xlarge">Mark Lesson number <b id="notification">Thirty (30)</b>, final lesson</p>
											<hr><br>
											
												<div class="row">
										        	<div class="col s12 l12 m12">
										          		<p class="w3-large">The lecturer claims the following was taught<p><br>
											          		<div class="w3-border w3-center w3-large" id="label"><div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
											          		</div>
										        	</div>
										        </div>

										        <div class="row">
											        <div class="col s11 m12 l7 w3-margin w3-border">
											         <p class="w3-large">The lesson was taught on: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->date }}</b></p>

					   					      		 <p class="w3-large">This lesson took place in: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

											        </div>
											         
										      	</div>

										      	<div class="row">
											        <div class="col s11 m11 l7 w3-margin w3-border">
											      		<p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->start_time))}}</b></p>
											      
											      		<p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:ia', strtotime($taughtlesson->stop_time))}}</b></p>
											      	</div>
										      	</div>
										      	<hr class="divide">

										      	<p class="w3-xlarge"><b>Do you Agree or Disagree ??</b></p>

										      	{{-- agreement form for lesson 30 --}}
										      	<div class="row w3-border">
											      	<form action="{{ route('lessonthirty') }}" method="post" class="w3-margin w3-padding col s6 m6 l6">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
														<input type="hidden" name="L30" value="A">

												      	<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><input type="submit" value="agree"></a>
											      	</form>


											      	{{-- disagreement form for lesson 30 --}}
											      	<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												      	<a href="#" class="w3-btn w3-red w3-large w3-round waves-effect wave-white"  onclick="document.getElementById('id030').style.display='block'">disagree</a>
												    </div>
												</div>
<div id="id030" class="w3-modal">
    <div class="w3-modal-content w3-animate-right w3-card-2">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id030').style.display='none'" 
        class="w3-button w3-display-topright w3-padding w3-hover">X</span>
        <h2>Why do you Disagree??</h2>
      </header>
      <div class="w3-container">
      	<p>chose your reason for disagreeing with lesson 30</p>
       <form action="{{ route('lessonthirty') }}" method="post" class="w3-margin w3-padding cl s6 m6 l6">
			{{ csrf_field() }}
			<input type="hidden" name="year" value="{{ $current->year }}">
			<input type="hidden" name="course_id" value="{{ $selected->course_id }}">
			<input type="hidden" name="L30" value="D">
			<input type="hidden" name="lesson_number" value="30">
			<div class="w3-border w3-padding w3-margin">
			<p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The lecture was not Taught" />
		       <span class="w3-large" id="radio">The lecture was not Taught</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="The Date for the Lecture is not true" />
		        <span class="w3-large" id="radio1">The Date for the Lecture is not true</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input  type="radio" name="reason" class="with-gap" value="Wrong Start or Stop Time of Lecture" />
		        <span class="w3-large" id="radio2">Wrong Start or Stop Time of Lecture</span>
		      </label>
		    </p>
		    <p>
		      <label>
		        <input type="radio" name="reason" class="with-gap" value="Not all these sub-sections were covered" />
		        <span class="w3-large" id="radio3">Not all these sub-sections were covered</span>
		      </label>
		    </p>
			</div>

			<a href="#" class="w3-btn w3-blue right w3-padding w3-margin w3-large w3-round waves-effect wave-white" id="submit" onclick="load()"><input type="submit" value="Submit"></a>	
		</form>

      </div>
    </div>
</div>
									
								@endforeach
								</center>
								 @else
									<script type="text/javascript">
																
										window.location='/student_markregister';
																
										{{ Session(['error' => 'Lesson Thirty has not yet been uploaded by the lecturer, try later']) }}
									</script>
			@endif
							






{{-- when all the register is set --}}


			@else
		
			<script type="text/javascript">
																
				 window.location='/student_markregister';
																
				 {{ Session(['success' => 'you are done with the register marking for this course.']) }}
				</script>
			@endif
 


		</div>

	</div>
</div>




				<!-- general speaking to the authors -->
            <!-- view in desktop and tablet mode -->
            <a class="w3-hide-small modal-trigger waves-effect waves-light right m-button" href="#modal1" id="floating-btn1">Speack to us<br><i class="mdi-av-mic"></i></a>
            <!-- view in android mode -->
            <a href="#modal1" class="modal-trigger waves-effect waves-light w3-btn-floating-large w3-theme-action w3-right w3-hide-large w3-hide-medium" id="floating-btn"><i class="mdi-action-settings-voice"></i></a>


         <!-- Modal Structure -->
                <div id="modal1" class="modal modal-fixed-footer w3-border" style="font-size: 23px;">
                  <div class="row"  style="overflow-x: hidden;overflow-y: hidden;">
                    <h3 class="center m-h w3-hide-small">Talk to us <em class="w3-large w3-blue w3-circle w3-margin">Live</em> your mind</h3><hr class="w3-hide-small" style="border-top: 5px solid #00ccff">

                    <h6 class="center m-h w3-hide-medium w3-hide-large">Talk to us <em class="w3-large w3-blue w3-circle w3-margin">Live</em> your mind</h6><hr class="w3-border-color w3-hide-medium w3-hide-large">
                    <div><br></div>

                    <form action="#" method="post" class="w3-margin">
                      {{ csrf_field() }}


                <div class="input-field col s6" id="inp">
                  <input name="full_name" id="full_name" type="text" class="validate">
                  <label for="full_name" id="labels">Full Name</label>
                </div>


                <div class="input-field col s6" id="inp">
                  <input id="email" name="email" type="email" class="validate">
                  <label for="email" id="labels">email</label><br><br>
                </div>

                 <div class="input-field col s12" id="inp">
                  <textarea id="livechart" name="livechart" type="text" class="materialize-textarea validate"></textarea>
                  <label for="livechart" id="labels">Talk to us</label><br>
                </div>
                <div><br></div>

                      <input type="submit" value="send" class="right waves-effect waves-green w3-btn w3-round">

                    </form>

                  </div>
                      <div class="modal-footer m-f">
                        <button class="right modal-close waves-effect waves-green">close</button>
                      </div>
                </div>


 	@include('content.footer')

<script src="{{URL::asset('materialize/js/materialize.min.js')}}"></script>
<script src="{{ URL::asset('js/scripting.js') }}"></script>
@endforeach
@endforeach

<div id="menu" style="height: 800px !important; width: 100% !important; background-color: #2196F3 !important; position: fixed !important; top:0px; bottom: 0px; left: 0px; right: 0px; z-index: 1000;">
          <div class="w3-margin-top">
            <center>
            
            <div class="preloader-wrapper big active" style="margin-top: 300px !important;">
              <div class="spinner-layer spinner-white-only">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>
            </center>
          </div>

        </div>

<script type="text/javascript">
  

    document.getElementById('menu').style.display = 'none';

      function load(){
    document.getElementById('menu').style.display = 'block';

    }


</script>
</body>
</html>
