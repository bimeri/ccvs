@extends('admin.include')

@section('title', 'set syllabus')

		

		@section('content')

		<div class="row">
			<div class="container w3-white syllabus w3-box w3-animate-opacity">
				<hr class="divide">
				<p class="w3-medium left" style="margin-left: -10px;">UNIVERSITY OF bUEA<br> {{ Auth::user()->department->faculty->name }}<br> {{ Auth::user()->department->name }} <br> Year: 2018-2019</p>


				@foreach($courses as $course)
								

					<p class="w3-medium right">course title: {{ $course->title }}<br>Course Code: {{ $course->code }}<br>
						 @if($course->semester_id==1) First Semester @else Second Semester  @endif 
					</p>


						<div align="center" class="row">

							<center><img src="/images/images.jpg" class="w3-circle w3-center" width="70" height="70"><br></center>
								<h5 class="w3-center col s12 l12 m12">scheme of work for {{ $course->code }}</h5>
				 @endforeach
					</div><hr class="divide">
						@include('file.message')

						@if(!isset(Auth::user()->scheme->id))

						<div class="red" id="s-b">
							<p class="center w3-padding white-text">there is no Scheme of work for this Course<br>You need to<b><i><u> create </u></i></b> one</p>
						</div>
						<div><br><br></div>
						<a href="scheme" class="right w3-btn w3-round w3-red" onclick="load()">go back</a>

						@else

						<p>lets beggin</p>

						@endif
				
			</div>
		</div>

		@endsection