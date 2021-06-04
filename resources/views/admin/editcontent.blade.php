@extends('admin.include')


@section('title', 'update-content')
@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">

	<script src="{{URL::asset('js/sweetalert.js')}}"></script>

 <script src='https://devpreview.tiny.cloud/demo/tinymce.min.js'></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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


			@if( $course->department_id != Auth::user()->department->id)

				{{ Session(['alarmred' => 'You don\'t have access to this course']) }}

			@else

			@if(App\Workcontent::where('course_id', '=', $course->id)->count() < 1)

				{{ Session(['alarmred' => 'No course content is available for this course']) }}

			@else

	<div class="row">
		<div class="container w3-box w3-white w3-animate-opacity tabl" style="margin-top: -75px; position: relative; z-index: 15">

			<div align="center" class="row">

				<div class="right">{{ Auth::user()->department->name }}</div>


					<h5 class="w3-center col s12 l12 m12" style="margin-top: 20px">Updating the course syllabus for {{ $course->code }}, {{ $course->title }}</h5><br>
			</div><hr class="divide">

				<div class="row">
					<form action="{{ route('content.update', $course->id) }}" method="post" id="form">
						{{ csrf_field() }}

				       	@foreach($workcontents as $content)
					        <div class="row">
						        <div class="col offset-l2 offset-m2 s12 m8 l8">
						        	<center>
						        		<label for="mytextarea" id="label" style="font-size: 20px; margin-top: -10px">update the course objectives, theme, goal (header)</label>

						          		<textarea id="mytextarea" name="description" class="validate">{{ $content->description }}</textarea>
						          	</center>
						        </div>
					    	</div><br><br><br>

					    	<div class="row">
						        <div class="col offset-l2 offset-m2 s12 m8 l8">
						        	<center>
						        		<label for="mytext" id="label" style="font-size: 20px; margin-top: -10px">update the course Syllabus, overview and work to be done</label>

						          		<textarea id="mytextarea" name="main_content" class="validate">{{ $content->main_content }}</textarea>
						          	</center>
						        </div>
					    	</div>
				    	@endforeach

				  	  <input type="hidden" name="course_id" value="{{ $course->id }}">

				      	<div class="container w3-border" style="width: 50%">
				      		<div class="row w3-margin w3-center w3-large">

				      			<a href="syllabus" class="w3-margin w3-round w3-btn w3-red waves-red left waves-effect">cancel</a>

				   		 		<input type="submit" value="Update" class="w3-btn right orange waves-effect waves-white w3-round w3-margin" onclick="save()" id="btn-submit">
				      		</div>
				      	</div>
					</form>
				</div>
			@endif
			@endif
		</div>
	</div>
@endforeach


{{-- @foreach($courses = \App\Course::select('*')->where('department', '=', Auth::user()->department->name)->where('code', '=', $course->code)->get() as $course)
@endforeach
			  --}}

<script>

	function save(){
$(document).on('click', '#btn-submit', function(e) {
    e.preventDefault();
   swal({
  title: "Are you sure you want to update?",
  text: "Once updated, teacher and students will be informed of the new update!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
}).then(function (willUpdate) {
	if (willUpdate) {
    swal("Great! The work content has been updated", {
      icon: "success",
    });
    $('#form').submit();
  } else {
    swal("The Syllabus is unchange!");
  }

    });
});

}

function alarm(){

	swal({
  title: "Are you sure?",
  text: "Once Udated, user will recieve a notification to redownload the content!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
  	event.preventDefault();
    document.getElementById('form').submit();
    swal("Congrat the content has been successfully updated!", {
      icon: "success",
    });
  } else {
    swal("all is done!");
  }
});
}

</script>
@endsection
