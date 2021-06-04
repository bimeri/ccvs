@extends('content.include')


@section('title', 'check_register')
@section('imag')
<link rel="icon" href="{{URL::asset('/images/images.jpg')}}" type="image/x-icon">
@endsection


@section('content')
@include('file.message')

<div class="row container w3-white small-box w3-margin-bottom">
	<div class="row"><br><br>
			<h4 class="blue-text col offset-l1 s12 m12 l12 w3-margin center">Select the Course from the semester you wish to check the register</h4>
		</div>
	
	<?php $currentsem = App\Semester::where('active', 1)->get(); ?>
	@foreach($currentsem as $current)
	@if($current->id == 1)

  <div class="col s10 m8 l4 offset-s1 offset-m2 offset-l4">
		
	<form action="{{ route('teacher.checkregister') }}" method="GET" class="validate">

        <div class="input-field offset-l1 offset-m1 col s12 m12 l11">
            <h4 class="w3-margin blue-text">First Semester courses</h4>
            <select class="validate" name="select_course">
              <option value="" disabled selected>Select the Course</option>
              @foreach($firsts as $first)
              <option value="{{ $first->id }}">{{ $first->title }}</option>
              @endforeach
            </select>
        </div>
  		<a onclick="load()"><input type="submit" value="Check Register" class="w3-right w3-blue w3-btn waves-effect waves-blue w3-medium w3-round" style="background-color: #009999 !important;"></a>
  	</form><br>
  </div>


  @else
  <div class="col s10 m8 l4 offset-s1 offset-m2 offset-l4">
		{{-- for second semester courses --}}
  	<form action="{{ route('teacher.checkregister') }}" method="GET" class="validate">
        <div class="input-field col s12 m12 l10">
            <h4 class="w3-margin blue-text">Second Semester courses</h4>
            <select class="validate" name="select_course">
              <option value="" disabled selected>Select the Course</option>
             @foreach($seconds as $second)
              <option value="{{ $second->id }}">{{ $second->title }}</option>
              @endforeach
            </select>
        </div>
  		<a onclick="load()"><input type="submit" value="Check Register" class="w3-right w3-blue w3-btn waves-effect waves-blue w3-medium w3-round"></a>
  	</form>
  </div>
	
	@endif
	@endforeach
</div>



@endsection