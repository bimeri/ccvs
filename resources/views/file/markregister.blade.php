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
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/style/w3.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/style/w3-school.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/style/student.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('style/st.css')}}">

	<script src='https://devpreview.tiny.cloud/demo/tinymce.min.js'></script>
  <script>
  tinymce.init({
    selector: '#mytextarea',
    height: '300px',  // change this value according to your HTML
  plugins : 'advlist autolink link image lists charmap print preview',
   toolbar: 'undo redo | styleselect | bold italic | link image | underline fontsizeselect| strikethrough | alignleft | aligncenter | alignright alignjustify',
  });
  </script>

<style>

body {font-family: Arial;}

/* Style the tab */
.tab {
    overflow-x: auto;
    overflow-y: hidden;

    background-color:  transparent !important;
    margin-top: -100px;
    border-bottom: 1.5px solid #fff;
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
  font-size: 35px;
  right: 220px;
}
#message1{
  position: absolute;
  top: 70px;
  font-size: 27px;
  right: 130px;
  width: 4.2%;
  box-shadow: 0px 3px 4px 2px rgba(0,0,0,0.2);
  background-color: #009999 !important;
}
#name{
  position: absolute;
  top: 50px;
  font-size: 17px;
  right: 260px;
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
  color: #000;
}
</style>
</head>
<body>

	<a href="/mark_register" class="w3-btn w3-black w3-medium w3-border w3-round" style="left: 10px; bottom: 10%; position: fixed; z-index: 10"><i class="mdi-communication-call-missed orange-text"></i> go back</a>

       @if(!isset(Auth::user()->id))
      <script>
        window.location="/admin";
      </script>
      @else

<div class="col s12 header-s" style="background-color: #009999 !important;">
	<img src="/images/2.png" class="w3-circle w3-border-white w3-margin dropbtn dropdown-button right" height="60" width="60" alt="logo" id="dropbtn">
	 <a href="#"><i class="mdi-communication-email right white-text" id="message"></i></a>
	
	<i class="w3-badge-special right w3-circle w3-border" id="message1"><b class="w3-badge w3-aqua w3-medium w3-margin-bottom">?</b></i>
  
  <p class="w3-xlarge w3-padding white-text">{{-- __('Go-Student') --}} Final Year Project</p>

	<p class="right name w3-margin" id="name">{{ Auth::user()->fname }} {{ Auth::user()->lname }}<br>
   <b class="yearandsemester"style="font-size: 15px;"> @foreach($semesters = App\Semester::where('active', 1)->get() as $semester){{ $semester->name }},@endforeach  @foreach($years= App\Year::where('active', 1)->get() as $year){{ $year->year }}@endforeach</b></p><br>
 

		<p class="w3-padding w3-xlarge blue-text head1">{{ Auth::user()->faculty }}</p><p class="w3-xlarge w3-padding white-text">{{ Auth::user()->department->name }}</p>


	

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
			              <a href="/logout">
			              	<strong id="dropdown-logout"><i class="mdi-action-settings-power"></i>&nbsp;logout {{ Auth::user()->lname }}</strong>
			              </a>
			        </ul>
     			</div>

<!--tabs -->@include('file.message')

@foreach($selectedcourses as $selected)

				@if( $selected->user->id != Auth::user()->id)

				<script type="text/javascript">
					window.location = '/mark_register';
				</script>
				{{ Session(['error' => 'You don\'t have access to this Course']) }}

				@else

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
									<b>Department:</b> {{ Auth::user()->department->name }}<br>
								</p>
							</div>

							<div class="col s12 l5 m6">
								<p class="right w3-medium w3-padding">

									<b>Course Master: {{ $selected->user->fname }} {{ $selected->user->lname }}</b><br>
									<b>Course Code:</b> {{ $selected->code }}<br>
									<b>Course Title:</b> {{ $selected->title }}
								</p>
							</div>

							
						</div>
								<hr class="col s12 l11 m12">

					</div>
					<h4 class="center black-text w3-large w3-text">Register for <b class="waves-green blue-text">{{ $selected->code }} {{ $selected->title }}</b> </h4>
				
			</div>

			{{-- the main register marking --}}


				<div class="white-text w3-margin w3-center w3-border w3-orange w3-animate-opacity">
					 <span onclick="this.parentElement.style.display='none'" class="w3-close right w3-padding-xlarge white-text w3-hover w3-medium">x</span>

						<p class="w3-margin w3-center white-text">Hello {{ Auth::user()->fname }}, @lang('messages.compulsary')
						</p>
				</div><hr>

				<center> 	
				 	<div id="courses" class="loader" style="position: fixed; top: 300px; left: 200px; z-index: 10">
						<div class="preloader-wrapper big active">
					    <div class="spinner-layer spinner-green-only">
					      <div class="circle-clipper left">
					        <div class="circle"></div>
					      </div>
							<div class="gap-patch">
					        <div class="circle"></div>
					      </div><div class="circle-clipper right">
					        <div class="circle"></div>
					      </div>
					    </div>
					    </div>
			 		</div>
				</center>
<script>
	document.getElementById('courses').style.display = 'none';
		function save(){

		document.getElementById('courses').style.display = 'block';
	 $("#form").submit();
	}
</script>

			@foreach($current_years = App\Year::where('active', 1)->get() as $current_year)
			

			{{-- starting with lesson one --}}

			@if(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 1)->count() < 1)
			
			{{-- lesson 1 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification"> one (1)</b> Start of lecture</p><p class="w3-large orange-text">Tick the subsections Taught</p>
						<hr><br>

			    <form action="{{ route('savesubsection') }}" method="post" id="form">
			    	{{ csrf_field() }}
			    	<input type="hidden" name="statuss" value="1">
			        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
			            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
					        <p>
							    <label><sup>{{ $key+1 }}</sup>
							        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
							        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
							    </label>
							</p>
						@endforeach
					</div>
			    </form><hr>

			    <?php 
				   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
				    ->where('status', 1)
				    ->count(); 
			    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
								<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="1">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
						
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 1)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>
					       

					      	<div class="row">
					      		<div class="input-field col s12 l8 m12">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from this lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			

			{{-- lesson two --}}

			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 2)->count() < 1)
			{{-- lesson 2 form here--}}

			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Two (2)</b></p>
							<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="2">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}
									        </span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 2)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="2">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 2)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 2<sup>nd</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			
			


			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 3)->count() < 1)
			{{-- lesson 3 form here--}}
			
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Three (3)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
						    	{{ csrf_field() }}
						    	<input type="hidden" name="statuss" value="3">
						        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
						            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
								        <p>
										    <label><sup>{{ $key+1 }}</sup>
										        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
										        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
										    </label>
										</p>
									@endforeach
								</div>
						    </form> <hr>
						    <?php 
							   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
							    ->where('status', 3)
							    ->count(); 
						    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="3">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 3)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 3<sup>rd</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
		



			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 4)->count() < 1)

			{{-- lesson 4 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Four (4)</b></p>
						<hr><br>
					<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="4">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 4)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="4">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 4)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 4<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>
							

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			




			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 5)->count() < 1)

			{{-- lesson 5 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Five (5)</b></p>
						<hr><br>
							<form action="{{ route('savesubsection') }}" method="post" id="form">
						    	{{ csrf_field() }}
						    	<input type="hidden" name="statuss" value="5">
						        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
						            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
								        <p>
										    <label><sup>{{ $key+1 }}</sup>
										        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
										        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
										    </label>
										</p>
									@endforeach
								</div>
						    </form> <hr>
						    <?php 
							   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
							    ->where('status', 5)
							    ->count(); 
						    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="5">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 5)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 5<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			




			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 6)->count() < 1)
			{{-- lesson 6 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Six (6)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="6">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 6)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="6">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 6)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 6<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
		





			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 7)->count() < 1)
			{{-- lesson 7 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Seven (7)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
						    	{{ csrf_field() }}
						    	<input type="hidden" name="statuss" value="7">
						        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
						            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
								        <p>
										    <label><sup>{{ $key+1 }}</sup>
										        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
										        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
										    </label>
										</p>
									@endforeach
								</div>
						    </form> <hr>
						    <?php 
							   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
							    ->where('status', 7)
							    ->count(); 
						    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="7">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 7)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 7<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			





			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 8)->count() < 1)
			{{-- lesson 8 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Eight (8)</b></p>
						<hr><br>
					<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="8">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 8)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="8">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 8)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 8<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			





			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 9)->count() < 1)

			{{-- lesson 9 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Nine (9)</b></p>
						<hr><br>
					<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="9">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 9)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="9">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 9)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 9<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			







			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 10)->count() < 1)
			{{-- lesson 10 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Ten (10)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="10">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 10)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="10">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 10)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 10<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			





			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 11)->count() < 1)
			
			{{-- lesson 11 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Eleven (11)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="11">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 11)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="11">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 11)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 11<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			






			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 12)->count() < 1)
			{{-- lesson 12 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Twelve (12)</b></p>
						<hr><br>

						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="12">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 12)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="12">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 12)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 12<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			







			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 13)->count() < 1)
			{{-- lesson 13 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Thirteen (13)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="13">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 13)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
								<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="13">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 13)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 13<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			






			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 14)->count() < 1)
			{{-- lesson 14 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Fourteen (14)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="14">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 14)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="14">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 14)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 14<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			





			
			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 15)->count() < 1)
			{{-- lesson 15 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Fifteen (15)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="15">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 15)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="15">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 15)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 15<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			





			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 16)->count() < 1)
			{{-- lesson 16 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Sixteen (16)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="16">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 16)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="16">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 16)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 16<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
	





			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 17)->count() < 1)
			{{-- lesson 17 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Seventeen (17)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="17">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 17)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="17">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 17)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 17<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			





			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 18)->count() < 1)
			{{-- lesson 18 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Eighteen (18)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="18">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 18)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="18">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 18)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 18<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			






			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 19)->count() < 1)
			{{-- lesson 19 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Nineteen (19)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="19">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 19)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
								<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="19">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 19)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 19<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>
	
						</form>
				</div>
			</center>
			







			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 20)->count() < 1)
			{{-- lesson 20 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Twenty (20)</b></p>
						<hr><br>
							<form action="{{ route('savesubsection') }}" method="post" id="form">
						    	{{ csrf_field() }}
						    	<input type="hidden" name="statuss" value="20">
						        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
						            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
								        <p>
										    <label><sup>{{ $key+1 }}</sup>
										        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
										        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
										    </label>
										</p>
									@endforeach
								</div>
						    </form> <hr>
						    <?php 
							   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
							    ->where('status', 20)
							    ->count(); 
						    ?>

							<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="20">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 20)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 20<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate"/>
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			



			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 21)->count() < 1)
			{{-- lesson 21 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Twenty-One (21)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="21">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 21)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="21">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 21)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 21<sup>st</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			




			

			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 22)->count() < 1)
			{{-- lesson 22 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Twenty-Two (22)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="22">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 22)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="22">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 22)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 22<sup>nd</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			





			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 23)->count() < 1)
			{{-- lesson 23 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Twenty-Three (23)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="23">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 23)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="23">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 23)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 23<sup>rd</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			





			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 24)->count() < 1)
			{{-- lesson 24 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Twenty-Four (24)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="24">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 24)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="24">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 24)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 24<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			






			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 25)->count() < 1)
			{{-- lesson 25 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Twenty-Five (25)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="25">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 25)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="25">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 25)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 25<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			





			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 26)->count() < 1)
			{{-- lesson 26 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Twenty-Six (26)</b></p>
											<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="26">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 26)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="26">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 26)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 26<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			







			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 27)->count() < 1)
			{{-- lesson 27 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Twenty-Seven (27)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="27">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 27)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
								<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="27">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 27)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 27<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			






			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 28)->count() < 1)
			{{-- lesson 28 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Twenty-Eight (28)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="28">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 28)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="28">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 28)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 28<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			






			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 29)->count() < 1)
			{{-- lesson 29 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Twenty-Nine (29)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="29">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 29)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="28">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 29)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 29<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			





			@elseif(App\Taughtlesson::where('course_id', '=', $selected->id)->where('lesson_number', '=', 30)->count() < 1)
			{{-- lesson 30 form here--}}
			<center>
				<div class="center-align w3-padding center w3-border w3-margin-bottom card-panel hoverable" style="width: 70%; min-height: 70px;">
						<p class="heading w3-xlarge">Lesson number <b id="notification">Thirty (30)</b></p>
						<hr><br>
						<form action="{{ route('savesubsection') }}" method="post" id="form">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="statuss" value="30">
					        <div class=" w3-padding blue-text" style="margin-left: 10px !important;">
					            @foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('course_id', $selected->id)->where('status', NULL)->get() as $key => $subsection)      
							        <p>
									    <label><sup>{{ $key+1 }}</sup>
									        <input type="radio" name="subsectionid" class="with-gap" value="{{ $subsection->id }}" onclick="save()" />
									        <span class="w3-large blue-text">{{ $subsection->sub_section }}</span>
									    </label>
									</p>
								@endforeach
							</div>
					    </form> <hr>
					    <?php 
						   $number_of_subsection = App\Subsection::where('course_id', $selected->id)
						    ->where('status', 30)
						    ->count(); 
					    ?>

						<form action="{{ route('lessons') }}" method="post">
							{{ csrf_field() }}
							@foreach($selectedcourses as $selected)
							<input type="hidden" name="course_id" value="{{ $selected->id }}">
							@endforeach
							<input type="hidden" name="lesson_number" value="30">
							<input name="number_subsection" type="hidden" value="{{ $number_of_subsection }}">
							<input name="yearid" type="hidden" value="{{ $current_year->id }}">
							
				          		<textarea id="mytextarea" name="what_taught" style="display: none;">
				          			@foreach($subsections = App\Subsection::where('course_id', $selected->id)->where('status', 30)->get() as $sub) {{ $sub->sub_section }}<br> @endforeach
				          		</textarea>


					      	<div class="row">
					      		 <div class="input-field col s6 l6 m6">
						          <input id="date" name="date" type="date" class="datepicker">
						          <label for="date">when did you teach this lesson ??</label>
						        </div>
					      		<div class="col s12 m7 l6">
					      			<label for="mytextarea" id="label" style="font-size: 15px;">any assigment from the 30<sup>th</sup> lecture?? (Optional)</label><br><br>
					      			<textarea id="mytextarea" name="assignment" class="validate" placeholder="enter the assignment"></textarea>
					      		</div>
					      	</div>

					      	<div class="row">
						        <div class="col s6 m6 l6">
						      		<label for="start_time" id="labels">Start time</label>
						      		<input type="time" id="Start_time" name="start_time" class="timepicker" placeholder="--:--:--">
						      	</div>

						      	<div class="col s6 m6 l6">
						      		<label for="stop_time" id="labels">stop time</label>
						      		<input type="time" id="stop_time" name="stop_time" class="timepicker" placeholder="--:--:--">
						      	</div>
					      	</div>
					      	<div class="row">
					      		<div class="input-field col s6 m6 l6">
					      			<input type="text" name="venue" class="validate">
					      			<label for="venue" >Where was this lesson taught?? (Venue)</label>
					      		</div>
					      	</div>

					      	<a class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><input type="submit" value="Submit"></a>

							
						</form>
				</div>
			</center>
			


			@else
			 {{-- every thing done--}}
			<p class="w3-green w3-margin w3-large w3-padding"> every thing is done for this semester</p>
			
			@endif
			

		</div>

	</div>
</div>


@endforeach

<!-- general speaking to the authors -->
<!-- view in desktop and tablet mode -->
<a class="w3-hide-small modal-trigger waves-effect waves-light right m-button" href="#modal1" id="floating-btn1" style="background-color: #009999 !important; width: 18%; height: 45px;">
    <b class="left w3-margin w3-medium" style="letter-spacing: 2px;">Offline</b>
    <b class="right">
        <i class="mdi-hardware-keyboard-arrow-up w3-margin w3-medium"></i>
    </b>
</a>
<!-- view in android mode -->
<a href="#modal1" class="modal-trigger waves-effect waves-light w3-btn-floating-large w3-theme-action w3-right w3-hide-large w3-hide-medium" id="floating-btn"  style="position: fixed;z-index: 30;background-color: #009999 !important;"><i class="mdi-action-settings-voice"></i></a>

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

                

 		<div class="container">
 			@yield('content')
 		</div>

<div class="footer_one w3-padding" style="background-color: #003333 !important;">

    <center>
        <p id="dateField" style="color: white;"></p>
        <p style="text-align: center; color: #fff">
            &copy;Powered by
            <a  target="_blank" href ="http://www.go-groups.net" style="color:#00ccff"> Go-Groups. Ltd</a>
        </p>
    </center>
</div>
<div id="menu" style="height: 800px !important; width: 100% !important; background-color: #009999 !important; position: fixed !important; top:0px; bottom: 0px; left: 0px; right: 0px; z-index: 1000;">
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
<script src="{{URL::asset('materialize/js/materialize.min.js')}}"></script>
<script src="{{ URL::asset('js/scripting.js') }}"></script>

	@endif
	@endforeach
@endif
</body>
</html>
