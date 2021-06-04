@extends('student.sinclude')

@section('title', 'mark-register')

@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
@endsection

@section('content')

<div><br><br><br></div>

@include('file.message')

<div class=" w3-white w3-border col offset-l1 offset-m1 s12 m8 l10 w3-margin-bottom" style="min-height: 100px;">
	<div class="row center">
		<div class="w3-margin">
			<h4 class="blue-text col s12 m12 l12 w3-margin">
				<div class="w3-margin w3-center w3-border w3-yellow">
					<p class="w3-margin w3-center">@lang('messages.studentalert')</p>
				</div>
				<br>Chose the course you wish to mark it register</h4><hr>
		</div><br>
	
		<form action="{{ route('markregsterfunction') }}" method="GET" class="validate">

			<div class="input-field offset-l4 col s12 m6 l4">
			    <select class="validate" name="course">
			     			<option value="" disabled selected>Select the Course</option>
			      	@foreach ($courses->courses as $course)
			      		@if($course->semester->active == 1)
			    			@if(\App\Selectedstudent::where('course_id', '=', $course->id)->where('student_id', '=', Auth::user()->id)->count() > 0)
			      				<option value="{{ $course->id }}">{{ $course->title }}</option>
			      				@else
			      			@endif
			      		@endif
			      	@endforeach
			    </select>

			    <a onclick="load()"><input type="submit" value="Mark Register" class="w3-right w3-blue w3-btn waves-effect waves-blue w3-medium w3-round"></a>
		  	</div>	
	  	</form>
  	</div>
</div>

@endsection