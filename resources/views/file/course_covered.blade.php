@extends('content.include')


@section('title', 'course_covered')
@section('imag')
<link rel="icon" href="{{URL::asset('/images/images.jpg')}}" type="image/x-icon">
@endsection


@section('content')
@include('file.message')
<p>{{-- @foreach($courses as $course)
   		@if( App\Register::where('course_id', '=', $course->id)->where('L1', '=', 'A')->count() >2 )

   		<button class="w3-btn w3-blue w3-round">lesson one Tought</button>
   		
   		<button class="w3-btn w3-red w3-round">lesson one was not taught</button>
   		@else
   		@endif
   	@endforeach --}}
  </p>
  <?php $currentsem = App\Semester::where('active', 1)->get(); ?>

<div class="row container w3-white small-box w3-margin-bottom">
	<div class="row">
		<h4 class="blue-text col offset-l1 s12 m12 l12 w3-margin center">Select the Course from the semester you wish to check the total work done</h4>
	</div>
	@foreach($currentsem as $current)
	@if($current->id == 1)
  <div class="col s10 m8 l4 offset-s1 offset-m2 offset-l4">
		
	<form action="{{ route('teacher.coursecovered') }}" method="GET" class="validate">
		{{ csrf_field() }}
	<div class="input-field offset-l1 offset-m1 col s12 m12 l11">
		<h4 class="w3-margin blue-text">First Semester courses</h4>
	    <select class="validate" name="select_course">
	      <option value="" disabled selected>Select the Course</option>
	      @foreach($firsts as $first)
	      <option value="{{ $first->id }}">{{ $first->title }}</option>
	      @endforeach
	    </select>
  	</div>
  		<a onclick="load()"><input type="submit" value="Course Covered" class="w3-right w3-blue w3-btn waves-effect waves-blue w3-medium w3-round" style="background-color: #009999 !important;"></a>
  	</form><br>
  </div>

  @else

  <div class="col s10 m8 l4 offset-s1 offset-m2 offset-l4">
		{{-- for second semester courses --}}
  	<form action="{{ route('teacher.coursecovered') }}" method="GET" class="validate">
  		{{ csrf_field() }}
	<div class="input-field col s12 m12 l10">
		<h4 class="w3-margin blue-text">Second Semester courses</h4>
	    <select class="validate" name="select_course">
	      <option value="" disabled selected>Select the Course</option>
	     @foreach($seconds as $second)
	      <option value="{{ $second->id }}">{{ $second->title }}</option>
	      @endforeach
	    </select>
  	</div>
  		<a onclick="load()"><input type="submit" value="Course Covered" class="w3-right w3-blue w3-btn waves-effect waves-blue w3-medium w3-round" style="background-color: #009999 !important;"></a>
  	</form>
  </div>
	
	@endif
	@endforeach
</div>



@endsection