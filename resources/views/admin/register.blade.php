@extends('admin.include')


@section('title', 'register')
@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
@endsection
@section('content')

	<div class="row">
		<div class="container w3-box w3-white w3-animate-opacity">
			<h4> Courses Register</h4><hr>
			<p class="w3-medium">Select the Semester and the Level</p>

				{{--<img src="/images/images.jpg" class="w3-circle" width="70" height="70"><br> --}}

				<hr class="divide">

			<div class="w3-border w3-box w3-center w3-large w3-container w3-margin">
				
				<div class="row">
		
					<form action="{{ route('admin.seeregister') }}" method="get" class="validate">
						{{ csrf_field() }}
						<div class="input-field col s6 m6 offset-l3 l3">
							<select class="validate" name="Select_Semester">
								@foreach($currentSemester = App\Semester::where('active', 1)->get() as $currentsem)
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

						<div class="input-field offset-l1 col s6 m6 l3">
						    <select class="validate" name="Select_Level">
						     	<option value="" disabled selected>Select Level</option>
						     	@foreach($levels as $level)
						      		<option value="{{ $level->id }}">{{ $level->name }}</option>
						      	@endforeach
						    </select>
					  	</div>
					  					<br><br><br>

					  	<div class="row">
					  		<div class="col offset-l4 offset-m3 offset-s3 l3 m3 s4">
					  			<a onclick="load()"><input type="submit" value="continue" class="w3-right w3-color w3-large w3-btn waves-effect waves-blue w3-medium w3-round"></a>
					  		</div>
					  	</div>
				  		
				  	</form>
				 </div>

			</div>	
		
		</div>
	</div>

@endsection