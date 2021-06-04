@extends('content.include')


@section('title', 'Course_Content')
@section('imag')
<link rel="icon" href="{{URL::asset('/images/images.jpg')}}" type="image/x-icon">
@endsection


@section('content')
@include('file.message')

@if(!isset(Auth::user()->id))

	<script type="text/javascript">
		window.location = "/";
	</script>

@else

		<?php $firsts =\App\Course::select('*')->where('user_id', '=', Auth::user()->id)->where('semester_id', '=', 1)->get(); ?>


	<div class="w3-center">
		@foreach($courses = App\Course::where('user_id', '=', Auth::user()->id)->get() as $course)
			@if($course->semester->active == 1)
				@foreach($updates = App\Workcontent::where('course_id', '=', $course->id)->where('status', 1)->get() as $update)
					<a class="w3-margin w3-medium orange w3-btn w3-round">Syllabus for {{ $update->course->code }} was updated</a><br>
				@endforeach
			@endif
		@endforeach
	</div>
	<div class="container w3-white small-box w3-margin-bottom">
		<br><br>
		<div class="row">
			<div class="col s12 l5 m12">
				<div class="row">
					<h4 class="blue-text col offset-l1 s12 m12 l12 w3-margin">Chose the course you wish to check the Syllabus</h4>
				</div>

				<?php $currentsem = App\Semester::where('active', 1)->get(); ?>
					@foreach($currentsem as $current)
						@if($current->id == 1)
			
							<form action="{{ route('scontents') }}" method="GET" class="validate">

								<div class="input-field offset-l1 col s12 m12 l11">
									<h4 class="w3-margin blue-text">Fisrt Semester courses</h4>
								    <select class="validate" name="course">
								      <option value="" disabled selected>Select the Course</option>
								      @foreach($firsts as $first)
								      	<option value="{{ $first->id }}">{{ $first->title }}</option>
								      @endforeach
								    </select>
							  	</div>
						  		<a onclick="load()"><input type="submit" value="see syllabus" class="w3-right w3-blue w3-btn waves-effect waves-blue w3-medium w3-round" style="background-color: #009999 !important;"></a>
						  	</form><br>

		  				@else

								{{-- for second semester courses --}}
						  	<form action="{{ route('scontents') }}" method="GET" class="validate">

							<div class="input-field offset-l1 col s12 m12 l11">
								<h4 class="w3-margin blue-text">Second Semester courses</h4>
							    <select class="validate" name="course">
							      <option value="" disabled selected>Select the Course</option>
							     @foreach($seconds =\App\Course::select('*')->where('user_id', '=', Auth::user()->id)->where('semester_id', '=', 2)->get() as $second)
							      <option value="{{ $second->id }}">{{ $second->title }}</option>
							      @endforeach
							    </select>
						  	</div>
						  		<a onclick="load()"><input type="submit" value="see syllabus" class="w3-right w3-black w3-btn waves-effect waves-blue w3-medium w3-round" onclick="load()" style="background-color: #000 !important;"></a>
						  	</form>
		  				@endif
		  			@endforeach
	  			</div>


  		<div class="col s12 offset-l1 l5 m12">
		  	<h4 class="blue-text col  s12 m12 l12 w3-margin">All the Courses Assigned for this year</h4><br>
		  	
		 <?php $currentsem = App\Semester::where('active', 1)->get(); ?>
			@foreach($currentsem as $current)
				@if($current->id == 1)
					<?php $counter = \App\Course::select('*')->where('user_id', '=', Auth::user()->id)->where('semester_id', '=', 1)->count(); ?>
						@if($counter > 0)
						  	<div class="w3-bordered">
						  			<h5 class="w3-center">first semester</h5>
									<table class="w3-table w3-striped">
									  	<tr class="w3-blue" style="background-color: #009999 !important;">
											<th>S/N</th>
											<th>Course Code</th>
											<th>Course Title</th>
										</tr>

										@foreach($firsts as $key => $first)
											<tr>					
												<td> {{ $key+1 }} </td>
												<td> {{ $first->code }}</td>
												<td>{{ $first->title}}</td>						
											</tr>
										@endforeach
									</table>
								@else

											<div><br><br><p class="white-text orange w3-margin-top w3-padding center w3-margin"><b class="w3-large">no course for First Semester</b></p></div>

								@endif
							</div>

				@else

					<?php $counter = \App\Course::select('*')->where('user_id', '=', Auth::user()->id)->where('semester_id', '=', 2)->count(); ?>
					@if($counter > 0)
							<div class="w3-bordered">
								<h5 class="w3-center">Second semester</h5>
								<table class="w3-table w3-striped">
									<tr class="w3-black">
										<th>S/N</th>
										<th>Course Code</th>
										<th>Course Title</th>
									</tr>

									@foreach($seconds = \App\Course::select('*')->where('user_id', '=', Auth::user()->id)->where('semester_id', '=', 2)->get() as $keys => $second) 
										<tr>
											<td> {{ $keys+1 }} </td>
											<td> {{ $second->code }}</td>
											<td>{{ $second->title}}</td>
										</tr>
									@endforeach
								</table>
							</div>
					@else

						<div><br><br><p class="white-text orange w3-margin-top w3-padding center w3-margin"><b class="w3-large">no course for second semester</b></p></div>

					@endif

			@endif
			@endforeach											
  		</div>
  	</div>
	</div>
@endif

@endsection