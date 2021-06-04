@extends('admin.include')


@section('title', 'scheme_of_worK')


@section('content')
			
	<div class="row">
		<div class="container w3-box w3-white">
			<h4>Free to set Up the Course Syllabus or edit them for the department of <i class="blue-text">{{ Auth::user()->department->name}}</i> </h4><hr class="divide">
			<p class="w3-medium">Chose the semester in which you want to set the scheme of work</p>

				@include('file.message')

			<form name="form1"  class="container w3-border" style="width: 100%">
				
				<div class="container">
					

						<div class="col s6 input-field">
							<div class="col s4">
								<h4>First semester</h4>
							</div>

							<div class="col s2">
							<a class="w3-btn waves-effect waves-green w3-medium w3-round" onclick="first()">Load Courses</a>
							</div>
						</div>

						<div class="col s6 input-field">
							<div class="col s4">
								<h4>Second semester</h4>
							</div>

							<div class="col s2">
							<a href="#" class="w3-btn waves-effect waves-green w3-medium w3-round" onclick="second()">Load Courses</a>
							</div>
						</div><br>
				</div><br>
			</form>

		</div>
	</div>

	 <center> 	<div id="courses">

		
					<div class="white-tex box w3-black"> loading, please wait...</div>
		

			 	</div>
	</center>

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

