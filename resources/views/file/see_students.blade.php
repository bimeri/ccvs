@extends('content.include')


@section('title', 'registered-students')
@section('imag')
<link rel="icon" href="{{URL::asset('/images/images.jpg')}}" type="image/x-icon">
@endsection


@section('content')
@if(isset(Auth::user()->id))

<div class="row">
		<div class="container w3-white small-box w3-margin-bottom">

			@foreach($courses as $course)
			<?php $counter = \App\Selectedstudent::where('course_id', '=', $course->id)->count() ?>
			@if($course->department_id != Auth::user()->department_id)
			<p class="red-text w3-xlarge w3-center">No Access right</p>
			<script type="text/javascript">
				window.location = 'registered_Students';
			</script>

			@else

			@if($course->user_id != Auth::user()->id)
			<p class="red-text w3-xlarge w3-center">No Access</p>
			<script type="text/javascript">
				window.location = 'registered_Students';
			</script>
			@else

			@endif
			@endif
			@endforeach
			@include('file.message')

			@if(!isset(Auth::user()->id))

			<script type="text/javascript">
				window.location = "/";
			</script>

			@else


			<div class="row">

				@foreach($courses as $course)

				@if (\App\Selectedstudent::where('course_id', '=', $course->id)->count() > 4)

				<div class="w3-border w3-margin  w3-animate-opacity">
				 <span onclick="this.parentElement.style.display='none'" class="w3-close right w3-padding-xxlarge w3-margin-top black-text w3-opacity w3-hover">x</span>

				<div class="w3-margin w3-center w3-border green-text" style="background-color: #C8E6C9">
						<p class="w3-margin w3-center"> @lang('messages.congratulation') <i class="w3-badge w3-green"> {{ $counter }}</i> @lang('messages.congratulation2')
						</p>

				</div>
				</div>

				@else
				<div class="w3-border w3-animate-opacity">

				<div class="red-text w3-margin w3-center w3-border materialize-red lighten-4 w3-medium">
						<p class="w3-margin w3-center">
							<b>
								@lang('messages.alert')
								@if($counter == 0)
								 	<i class="w3-badge w3-red">{{ "No" }}</i> Student.
								 		@else
								 	<i class="w3-badge w3-red">{{ $counter }}</i> student(s).
								@lang('messages.alert2')
								@endif
							</b>
						</p>

				</div>
				</div>
				@endif
				@endforeach<hr>

				<center>
				 	<div id="courses" class="loader">
						<div class="preloader-wrapper big active">
					    <div class="spinner-layer spinner-red-only">
					      <div class="circle-clipper left">
					        <div class="circle"></div>
					      </div><div class="gap-patch">
					        <div class="circle"></div>
					      </div><div class="circle-clipper right">
					        <div class="circle"></div>
					      </div>
					    </div>
					    </div>
			 		</div>
				</center>

		<script type="text/javascript">


		document.getElementById('courses').style.display = 'none';
			function first(){
		document.getElementById('courses').style.display = 'block';

		}


		</script>

				@foreach($courses as $course)

				<div class="w3-border-color w3-margin">
					<p class="w3-margin col s12 m6 l6">
						<label id="labeling">Course code:</label> {{ $course->code }}<br>
						<label id="labeling">Course title:</label> {{ $course->title }}
					</p>
					<p class="w3-margin s12 m6 right l6">
					 	<label id="labels"> <b>{{ $course->semester->name }}</b></label><br>
					 	<label id="labeling">Lecturer:</label> {{ $course->user->fname }} {{ $course->user->lname }}
					</p>

				</div>

				@endforeach
			</div><hr>

				<div class="w3-margin-top w3-margin">

					<div class="row" style="overflow-x: scroll;">
					  <table class="w3-striped w3-table w3-centered w3-bordered w3-table-all">
					    <tr class="w3-blue" style="background-color: #009999 !important;"><?php $count = 1; ?>
					      <th>S/N<div><br></div></th>
					      <th>Student Name</th>
					      <th>Student matricule N<sup>o</sup></th>
					      <th>select status</th>
					    </tr>
					    @foreach($students->students as $student)

					    <tr>
						      <td>{{ $count++ }}</td>
						      <td>{{ $student->name }}</td>
						      <td>{{ $student->matricule }}</td>

						      <td>
						      	@foreach($courses as $course)

						      		@if (\App\Selectedstudent::where('course_id', '=', $course->id)->where('student_id', '=', $student->id)->exists())


						      		@if(App\Register::where('course_id', $course->id)->exists())
						      		<a class="w3-btn w3-green w3-round"><i class="mdi-action-thumb-up"></i> selected</a>
						      		@else
						      		<form action="{{ route('teacher.removeselectedstudent') }}" method="get">
						      			<input type="hidden" name="student_id" value="{{ $student->id }}">
							      		<input type="hidden" name="course_id" value="{{ $course->id }}">

							      		<a href="#" class="w3-btn orange waves-effect waves-blue w3-medium w3-round"><input type="submit" value="unselect" onclick="first()"><i class="mdi-content-create yellow-text">
						      		</form>

						      		@endif


						      		@else

						      		@if (App\Selectedstudent::where('course_id', '=', $course->id)->count() > 4)

						      		<a class="w3-btn w3-red w3-round"><i class="mdi-av-not-interested"></i> can't add</a>

						      		@else

						      		<form action="{{ route('seestudents') }}" method="post">
						      			{{ csrf_field() }}

							      		<input type="hidden" name="student_id" value="{{ $student->id }}">
							      		<input type="hidden" name="course_id" value="{{ $course->id }}">
							      		<input type="hidden" name="student_matricule" value="{{ $student->matricule }}">
							      		<?php $academic_year = App\Year::where('active', 1)->get(); ?>
							      		@foreach($academic_year as $current_year)
							      			<input type="hidden" name="academic_year" value="{{ $current_year->id }}">
							      		@endforeach

								      	<a href="#" class="w3-btn w3-color waves-effect waves-blue w3-medium w3-round"><input type="submit" value="Select" onclick="first()"><i class="mdi-av-my-library-add white-text"></i>
								      	</a>
							      	</form>

							      	@endif
							      	@endif

							    @endforeach
						      </td>
					    </tr>
					    @endforeach
					  </table>
					</div>
				</div><div><br></div>

		</div>
</div>

<div class="row">
<div class="w3-margin-12 w3-center w3-padding">
    <a href="registered_Students" class="w3-btn w3-blue w3-text-shadow w3-border w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><i class="mdi-communication-call-missed white-text"></i>Go Back</a>

</div>
</div>

@endif

@else

<script type="text/javascript">
	window.location='/';
</script>
@endif
@endsection
