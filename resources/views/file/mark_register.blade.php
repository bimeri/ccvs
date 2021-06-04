@extends('content.include')


@section('title', 'mark-register')
@section('imag')
<link rel="icon" href="{{URL::asset('/images/images.jpg')}}" type="image/x-icon">
@endsection

@section('content')
@include('file.message')

@if(!isset(Auth::user()->id))


<script type="text/javascript">
	window.location = "/admin";
</script>

@else


<div class="row w3-white w3-padding w3-margin w3-border innerdiv">
	<div class="row">
			<h4 class="blue-text col s12 m12 l12 w3-padding center">Select the Course from the semester you wish to mark the register</h4>
	</div>
<?php $currentsem = App\Semester::where('active', 1)->get(); ?>
	@foreach($currentsem as $current)
	@if($current->id == 1)

	<?php $firsts =\App\Course::select('*')->where('user_id', '=', Auth::user()->id)->where('semester_id', '=', 1)->get();  ?>
  <div class="col s10 m8 l4 offset-s1 offset-l2 offset-l4">
		
	<form action="{{ route('teacher.selectcourse') }}" method="GET" class="validate">

	<div class="input-field offset-l1 col s12 m12 l11">
		<h4 class="w3-margin blue-text">First Semester courses</h4>
	    <select class="validate" name="select_course">
	      <option value="" disabled selected>Select the Course</option>
	      @foreach($firsts as $first)
	      <option value="{{ $first->id }}">{{ $first->title }}</option>
	      @endforeach
	    </select>
  	</div>
  		<a onclick="load()"><input type="submit" value="continue" class="w3-right w3-blue w3-btn waves-effect waves-blue w3-medium w3-round" style="background-color: #009999 !important;"></a>
  	</form><br>
  </div>

@else

<?php $seconds =\App\Course::select('*')->where('user_id', '=', Auth::user()->id)->where('semester_id', '=', 2)->get();  ?>
  <div class="col s10 m8 l4 offset-s1 offset-l2 offset-l4">
		{{-- for second semester courses --}}
  	<form action="{{ route('teacher.selectcourse') }}" method="GET" class="validate">

	<div class="input-field col s12 m12 l10">
		<h4 class="w3-margin blue-text">Second Semester courses</h4>
	    <select class="validate" name="select_course">
	      <option value="" disabled selected>Select the Course</option>
	     @foreach($seconds as $second)
	      <option value="{{ $second->id }}">{{ $second->title }}</option>
	      @endforeach
	    </select>
  	</div>
  		<a onclick="load()"><input type="submit" value="continue" class="w3-right w3-blue w3-btn waves-effect waves-blue w3-medium w3-round"></a>
  	</form>
  </div>
	
	@endif
	@endforeach
</div>

@endif

@endsection