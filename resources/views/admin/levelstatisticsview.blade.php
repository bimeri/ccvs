@extends('admin.include')


@section('title', 'level-statisticsview')
@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
@endsection
@section('content')

	
		<div class="row">
		<div class="container w3-box w3-white w3-animate-opacity">
			<h4 class="w3-large" style="text-transform: capitalize;">Course Coverage Statistics for @foreach($levels as $level) {{ $level->name }} @endforeach</h4><br><b class="w3-large">{{ Auth::user()->department->name }}</b><b class="blue-text w3-large">@foreach($currentSemester as $currentsem) {{ $currentsem->name }}, @endforeach @foreach($currentYear as $current) {{ $current->year }} @endforeach</b><hr>
			<p class="w3-medium">Select the year</p>

				{{--<img src="/images/images.jpg" class="w3-circle" width="70" height="70"><br> --}}
			
			
				<hr class="divide">


			<div class="w3-border w3-box w3-center w3-large w3-container w3-margin">

				
				<div class="row">
		
					<form action="{{ route('admin.levelstatistic') }}" method="get" class="validate">
						{{ csrf_field() }}
						<div class="input-field col s6 m6 offset-l3 l3">
							<select class="validate" name="Select_Year">
								@foreach($currentYear as $current)
						      		<option value="{{ $current->id }}">{{ $current->year }}</option>
						      		@foreach($years as $year)
						      			@if($year->id == $current->id)
						      				<option value="" disabled>Select Year</option> 
						      			@else
						      				<option value="{{ $year->id }}">{{ $year->year }}</option>
						      			@endif
						      		@endforeach
						      	@endforeach
						    </select>
						</div>

						@foreach($levels as $level) 
							<input type="hidden" name="level_id" value="{{ $level->id }}"> 
						@endforeach
			
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

					  					<br><br><br>

					  	<div class="row">
					  		<div class="col offset-l4 offset-m3 offset-s3 l3 m3 s4">
					  			<a onclick="load()"><input type="submit" value="See Statistic" class="w3-right w3-color w3-large w3-btn waves-effect waves-blue w3-medium w3-round"></a>
					  		</div>
					  	</div>
				  	</form>
				 </div>
			</div>	
		</div>
	</div>


@endsection
