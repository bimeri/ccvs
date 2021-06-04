@extends('admin.include')

@section('title', 'syllabus')

@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
	<script src="{{URL::asset('js/sweetalert.js')}}"></script>

	

@endsection
@section('content')
			
	<div class="row">
		<div class="container w3-box w3-white">
			<h4 class="w3-margin">@lang('messages.describe') <i class="blue-text">{{ Auth::user()->department->name}}</i> </h4><hr class="divide">
			<p class="w3-medium w3-margin">Chose the semester in which you want to set the scheme of work</p>


			<form name="form1"  class="container w3-border" style="width: 70%">
				
				<div class="row">
					

						<div class="input-field">
							<div class="col s12 l4 m12">
								<h4>First semester</h4>
								<a class="w3-btn waves-effect waves-green w3-medium w3-round" onclick="first()">Load Courses</a>
							</div>
						</div>

						<div align="center" class="col s12 l4 m12">

							<center><img src="/images/images.jpg" class="w3-circle w3-center" width="70" height="70"><br></center>
								
				 
						</div>

						<div class="input-field">
							<div class="col s12 l4 m12">
								<h4>Second semester</h4>
								<a class="w3-btn waves-effect waves-green w3-medium w3-round" onclick="second()">Load Courses</a>
							</div>

						</div><br>
				</div><br>
			</form><br>
	

	 					<div id="courses" class="s12">
							<div class="white-tex box w3-black">
								<p> loading, please wait...</p>
								<div class="preloader-wrapper big active">
							    <div class="spinner-layer spinner-blue-only">
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
					 	</div>
		</div>
	</div>

	
		<script type="text/javascript">
	
		document.getElementById('courses').style.display = 'none';

			function first(){
		document.getElementById('courses').style.display = 'block';

	$(document).ready(function(e) {
		$.ajaxSetup({cache:false});
		
		 $('#courses').load('logs');
		
			});
}

function second(){
		document.getElementById('courses').style.display = 'block';

	$(document).ready(function(e) {
		$.ajaxSetup({cache:false});
		
		 $('#courses').load('logg');
		
			});
}
		</script>

@endsection




{{-- <form name="form1"  class="container w3-border" style="width: 70%">

				<div class="row w3-margin">
					<div align="center" class="col offset-l4 s12 l4 m12">

							<center><img src="/images/images.jpg" class="w3-circle w3-center" width="70" height="70"><br></center>
						
						</div>
				</div>
				
				<div class="row">
					

						

						<form action="{{ route('admin.seeregister') }}" method="get" class="validate">
						{{ csrf_field() }}
						<div class="input-field col s6 m6 offset-l2 l3">
							<select class="validate" name="Select_Semester">
						      <option value="" disabled selected>Select Semester</option>
						      @foreach($semesters as $semester)
						      <option value="{{ $semester->id }}">{{ $semester->name }}</option>
						      @endforeach
						    </select>
						</div>

						<div class="input-field offset-l2 col s6 m6 l3">
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
					  			<input type="submit" value="continue" class="w3-right w3-green w3-large w3-btn waves-effect waves-blue w3-medium w3-round">
					  		</div>
					  	</div>
				  		
				  	</form>

						
				</div><br>
			</form> --}}