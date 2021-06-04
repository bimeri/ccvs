@extends('content.include')


@section('title', 'Course_outline')
@section('imag')
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
@endsection


@section('content')

	@if(!isset(Auth::user()->id))

	<script type="text/javascript">
		window.location = '/';
	</script>
	@else



			@foreach($scontents as $content) 
				@if($content->course->department_id != Auth::user()->department_id)

				<script>
					window.location ="/course_content";
				</script>
			{{ Session(['error' => 'you don\'t have access to this course']) }}
				@else 

				@if ($content->course->user_id != Auth::user()->id)

				<script>
					window.location="/course_content";
				</script>

				{{ Session(['error' => 'you don\'t have access to this course']) }}
				@else

				@endif
				@endif

		<div class="row">
			<div class="row container w3-white small-box w3-margin-bottom">
				<br>

				@if (\App\Outline::where('course_id', '=', $content->course->id)->count() > 0)

					<div class="w3-margin w3-center w3-border blue lighten-4 blue-text">
							<span onclick="this.parentElement.style.display='none'" class="w3-close right w3-padding-xlarge white-text w3-hover">x</span>
						<p class="w3-margin"><b> @lang('messages.outlineMessage')</b>
						</p>

					</div>

				@else 

				<div class="w3-red white-text w3-margin w3-center w3-border notifyred">
					 <span onclick="this.parentElement.style.display='none'" class="close white-text w3-close right w3-padding w3-hover">x</span>
						<p class="w3-margin">Your have not yet set any outline for this course. Your are to set a maximum of one course outline.
						</p>

				</div>

				@endif

				<div class="border">
					<p class="w3-medium left w3-margin"><b>UNIVERSITY OF BUEA<br> {{ Auth::user()->department->faculty->name }}<br> {{ Auth::user()->department->name }} <br> Year: 2018-2019</b></p>


					<p class="w3-medium right w3-margin"><b>course title:</b> {{ $content->course->title }}<br><b>Course Code:</b> {{ $content->course->code }}<br><b>Course Master: </b>{{ $content->course->user->fname }} {{ $content->course->user->lname }}<br>
						<b>{{ $content->course->semester->name }} </b>
					</p>


						<div align="center" class="row">

							<img src="/images/images.jpg" class="w3-circle w3-center w3-margin" width="70" height="70"><br>
								<h5 class="w3-center col s12 l12 m12 blue-text w3-margin"><b>Course Outline for {{ $content->course->code }}</b> </h5>
				 
						</div>
				</div><hr class="divide">

			@foreach($outlines as $outline)

			<div class="w3-border w3-margin">
				<div class="w3-margin">
					@foreach($topics = App\Topic::where('course_id', $outline->course->id)->get() as $key => $topic)
										
							Topic: {{ $key+1 }}. <u>{{ $topic->topic }}</u><br><br>
										

								{{-- form for the subtopic --}}
										
						@foreach($sections = App\Section::where('topic_id', $topic->id)->get() as $keyy => $section)<b class="w3-padding-xlarge green-text">
									{{ $key+1 }}.{{ $keyy+1 }}- {{ $section->subtopic }}</b><br>			
							@foreach($subsections = App\Subsection::where('section_id', $section->id)->get() as $keyyy => $subsection)
								<div class=" w3-padding blue-text" style="margin-left: 80px !important;">
									{{ $key+1 }}.{{ $keyy+1 }}.{{ $keyyy+1 }}- {{ $subsection->sub_section }}
								</div>
							@endforeach
						@endforeach<br><hr>
					@endforeach
				</div><br>
			 <p class="w3-margin-top w3-margin">
			 	You planned to finish your program for this course in <b class="blue-text">{{ $outline->number_of_weeks }}</b> weeks time, and also to give <b class="blue-text">{{ $outline->number_of_assignment }} assignments</b><br> You also wish to evaluate your Students with the overall number of<b class="blue-text"> {{ $outline->number_of_continuous_accessment }}</b> Continuous Accessment by the end of the semester.
			 		<b class="green-text right">Congratulation !!</b><br><br>
			 </p> 
			</div>
			@endforeach
			
		</div>
	</div>

		{{-- updating the course outline --}}
		@if(App\Taughtlesson::where('course_id', $content->course->id)->exists())

		@else
			<form method="get" action="{{ route('outline.update') }}">
				@foreach($outlines as $outline)
					<input type="hidden" name="course_id" value="{{ $outline->course->id }}">
				@endforeach
					<br>
					<input type="submit" class="w3-btn w3-color w3-large w3-padding w3-margin b-t" value="update Outlne"><br><i class="mdi-content-create yellow-text w3-xlarge i-b" style=""></i>	
			</form>
		@endif
			<div class="w3-right w3-padding w3-margin">
				<form action="{{ route('outline.download', ['download'=>'pdf']) }}" method="get">
					<!-- download the outline -->
						<input type="hidden" name="id" value="{{ $content->course->id }}">
					@if (\App\Outline::where('course_id', '=', $content->course->id)->count() > 0)

						<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" style="background-color: #009999 !important;"><i class="mdi-file-file-download"></i><input type="submit" value="Download the Course Outline"></a>

					@else
					<a href="#" class="w3-btn w3-blue w3-large w3-round w3-opacity waves-effect wave-green disabled"><i class="mdi-file-file-download"></i>Nothing to download</a>
					@endif	
				</form>			
			</div>


  <div class="w3-right w3-padding w3-margin">
    <a href="course_content" class="w3-btn w3-orange w3-text-shadow w3-border w3-blue w3-large w3-round waves-effect wave-green" onclick="load()"><i class="mdi-communication-call-missed white-text"></i>Go Back</a>
  </div>
<script type="text/javascript">
	$(document).ready(function() {
   
        $('html, body').animate({scrollTop:$(document).height()}, 3000);
        return false;
    

});
</script>

@endforeach
@endif
 <a href="#" class="scrollToTop w3-btn blue white-text shadow w3-opacity"><i class="mdi-navigation-arrow-drop-up w3-xlarge"></i></a>

@endsection