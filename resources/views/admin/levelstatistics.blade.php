@extends('admin.include')


@section('title', 'level-statistics')
@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
@endsection
@section('content')

	<div class="row">
		<div class="container w3-box w3-white w3-animate-opacity">
			<h4>All Courses available for @foreach($levels as $level)<b class="blue-text w3-large"> {{ $level->name }}.</b> @endforeach </h4><hr>

			<p class="w3-medium">Select the Year and the Course</p>

				{{--<img src="/images/images.jpg" class="w3-circle" width="70" height="70"><br> --}}
			 @foreach($levels as $level)
				<form action="{{ route('admin.levelstatisticsview') }}" method="get">
		 		 	{{ csrf_field() }}

				 	<input type="hidden" name="select_level" value="{{ $level->id }}">
				 	
				 	<a href="" class="shadow right w3-btn waves-effect waves-blue w3-medium levelStatistics">
				 		<input type="submit" value="{{ $level->name }} STATISTIC" class="w3-large" style="text-shadow: 1px 2px 1px #00ccff !important">
				 	</a>
				</form>
			 
			 @endforeach<br>
				<hr class="divide">


			<div class="w3-border w3-box w3-center w3-large w3-container w3-margin">
				
				<div class="row">
		
					<form action="{{ route('admin.coursestatistic') }}" method="get" class="validate">
						{{ csrf_field() }}
						<div class="input-field col s6 m6 offset-l1 l3">
							<select class="validate" name="Select_Year">
								@foreach($currentYear as $current)
						      		<option value="{{ $current->id }}">{{ $current->year }}</option>
						      		@foreach($years as $year)
						      			@if($year->year == $current->year)
						      				<option value="" disabled>Select Year</option> 
						      			@else
						      				<option value="{{ $year->id }}">{{ $year->year }}</option>
						      			@endif
						      		@endforeach
						      	@endforeach
						    </select>
						</div>

						<div class="input-field col s6 m6  l3">
							<select class="validate" name="Select_Semester">
								@foreach($currentSemester as $currentsem)
						      		<option value="{{ $currentsem->id }}">{{ $currentsem->name }}</option>
						      		@foreach($semesters as $semester)
						      			@if($semester->name == $currentsem->name)
						      			@else
						      				<option value="{{ $semester->id }}">{{ $semester->name }}</option>
						      			@endif
						      		@endforeach
						      	@endforeach
						    </select>
						</div>

						<div class="input-field col s6 m6 l3">
						    <select class="validate" name="Select_Course">
						      <option value="" disabled selected>Select course</option>
						      @foreach($levelcourses as $course)
						      @if($course->semester->active == 1)
						      	<option value="{{ $course->id }}">{{ $course->code }}, {{ $course->title }}</option>
						      	@else
						      	@endif
						      @endforeach
						    </select>
					  	</div>
					  					<br><br><br>

					  	<div class="row">
					  		<div class="col offset-l4 offset-m3 offset-s3 l3 m3 s4">
					  			<a onclick="load()"><input type="submit" value="See Statistics" class="w3-right w3-color w3-large w3-btn waves-effect waves-blue w3-medium w3-round"></a>
					  		</div>
					  	</div>
				  	</form>
				 </div>
			</div>	
		</div>
	</div>
@endsection
