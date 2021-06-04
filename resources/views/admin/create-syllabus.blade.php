@extends('admin.include')


@section('title', 'create')
@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">

 <script src='https://devpreview.tiny.cloud/demo/tinymce.min.js'></script>
  <script>
  tinymce.init({
    selector: '#mytextarea, #mytext',
    height: '300px',  // change this value according to your HTML
  plugins : 'advlist autolink link image lists charmap print preview',
   toolbar: 'undo redo | styleselect | bold italic | link image | underline fontsizeselect| strikethrough | alignleft | aligncenter | alignright | alignjustify',
  });
  </script>
  
@endsection	
@section('content')
		
	
				@foreach($courses as $course)

				
					 
				<div class="row">
		<div class="container w3-white small-box view-box" style="box-shadow: none !important; margin-top: 5px !important;">
			 
			<div align="center" class="row">

				<div class="right">{{ Auth::user()->department->name }}</div>
			 
            
					<h5 class="w3-center col s12 l12 m12" style="margin-top: 20px">set up the syllabus for {{ $course->code }}, {{ $course->title }}</h5><br>
			</div><hr class="divide">
					
				<div class="row">
					<form action="{{ route('store') }}" method="post">
						{{ csrf_field() }}

				       
				        <div class="row">
				        <div class="col offset-l2 offset-m2 s12 m8 l8">
				        	 <center>
				        	<label for="mytextarea" id="label" style="font-size: 20px; margin-top: -10px">enter the course objectives, theme, goal (header)</label>
				          <textarea id="mytextarea" name="description" class="validate" placeholder="enter the sub section"></textarea>
				          </center>
				        </div>
				    	</div><br><br><br>

				    	<div class="row">
				        <div class="col offset-l2 offset-m2 s12 m8 l8">
				        	 <center>
				        	<label for="mytext" id="label" style="font-size: 20px; margin-top: -10px">enter the course content, overview and work to be done</label>
				          <textarea id="mytextarea" name="main_content" class="validate" placeholder="enter the sub section"></textarea>
				          </center>
				        </div>
				    	</div>
				  
				  	  <input type="hidden" name="course_id" value="{{ $course->id }}">
				  	  
				  	  <input type="hidden" name="admin_id" value="{{ Auth::user()->id }}">

				   

				      <div class="row">
				      	<div class="w3-margin w3-center w3-large">
				   		 <a onclick="load()"><input type="submit" value="Save" class="w3-btn blue waves-effect waves-white w3-round"></a>
				      	</div>
				      </div>

					</form>
				</div>
				
				@endforeach

		
		</div>

	</div>	


@endsection