@extends('admin.include')


@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
@endsection
@section('title', 'lecturers')


@section('content')

	<div class="row">
		<div class="container w3-border w3-box w3-white">
			<h4><em class="w3-xxlarge">A</em>ll the lecturers from the department of <i class="blue-text"> {{ Auth::user()->department->name }}</i></h4><hr class="divide">

			
				<div class="container">
				
						<div class="input-field center">
							<form action="#" method="#" class="w3-form-control">

					<a type="submit" class="w3-btn waves-effect waves-pink w3-round w3-large" onclick="submitChart()">click to load</a>

					</form>
					</div><br>
					
						
				</div>


		</div>
	</div>


			<div id="chartlogs" class="col s12 l8 m8 w3-margin">
			
					<div class="white-text box w3-black">
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

		<script type="text/javascript">
	
		document.getElementById('chartlogs').style.display = 'none';

			function submitChart(){
		document.getElementById('chartlogs').style.display = 'block';

	$(document).ready(function(e) {
		$.ajaxSetup({cache:false});
		
		 $('#chartlogs').load('lload');
		
			});
}
		</script>	
		

@endsection
