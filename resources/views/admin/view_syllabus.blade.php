@extends('admin.include')

@section('title', 'view syllabus')

@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">

<script>
  //croll to top
$(document).ready(function(){

    //Check to see if the window is top if not then display button
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });

});

</script>

 <script src='https://devpreview.tiny.cloud/demo/tinymce.min.js'></script>
  <script>
  tinymce.init({
    selector: '#mytextarea'
  });
  </script>
  
@endsection	

		@section('content')
		
				@foreach($courses as $course)
				@if($course->department_id != Auth::user()->department_id)

				{{ Session(['error' => 'You don\'t Have access to this Course']) }}

				@else 

		<div class="row">
			<div class="container w3-white syllabus view-box w3-border" style="margin-top: 50px !important;">
				<hr class="divide">
				<p class="w3-medium left w3-margin">UNIVERSITY OF BUEA<br> {{ Auth::user()->department->faculty->name }}<br> {{ Auth::user()->department->name }} <br> Year: 2018-2019</p>


				
								

					<p class="w3-medium right w3-margin">course title: {{ $course->title }}<br>Course Code: {{ $course->code }}<br>
						 @if($course->semester_id == 1) First Semester @else Second Semester  @endif 
					</p>


						<div align="center" class="row">

							<center><img src="/images/images.jpg" class="w3-circle w3-center" width="70" height="70"><br></center>
								<h5 class="w3-center col s12 l12 m12 w3-margin">Course syllabus for {{ $course->code }}</h5>
				 
					</div><hr class="divide">
						


						
		@if (\App\Workcontent::where('course_id', '=', $course->id)->exists())
					@foreach($contents as $content)	
		<div class="w3-border">

				<div class="w3-margin"> 
				{!! $content->description !!}<br>	
				 {!! $content->main_content !!}
				 
																 
				</div>
							
				 </div>



				 @endforeach	

						@else

						
				 		<div class="red" id="s-b">
							<p class="center w3-padding white-text">@lang('messages.display')</p>
						</div>
						<div><br><br></div>
						<a href="syllabus" class="right w3-btn w3-round w3-red">go back</a>


	
	@endif

				 <div><br></div>

					
				
			</div>

		@if (\App\Workcontent::where('course_id', '=', $course->id)->exists())
		<div class="w3-margin-12 w3-left w3-padding">
   			<a href="syllabus" class="w3-btn w3-blue w3-text-shadow w3-border w3-blue w3-large w3-round waves-effect wave-green"><i class="mdi-communication-call-missed white-text"></i>Go Back</a>
   
		</div>
		@else
		@endif
		</div>
		@endif

 @endforeach

 <a href="#" class="scrollToTop w3-btn blue white-text shadow w3-opacity"><i class="mdi-navigation-arrow-drop-up w3-xlarge"></i></a>
		@endsection