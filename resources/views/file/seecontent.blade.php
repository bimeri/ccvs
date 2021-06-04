@extends('content.include')


@section('title', 'view content')
@section('imag')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
@endsection

@section('style')
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
@if(Request::is('scontent'))
<script>
	$(document).ready(function(){
		$(".tab").hide();
	});
</script>
@else

@endif
<a href="/course_content" class="w3-btn w3-grey w3-border w3-round" style="left: 10px; bottom: 250px; position: fixed; z-index: 10" onclick="load()"><i class="mdi-hardware-keyboard-arrow-left red-text"></i> go back</a>
@if(!isset(Auth::user()->id))

<script type="text/javascript">
	window.location = '/';
</script>
@else

@endif
@include('file.message')
@foreach($seecontents as $content)
				

				@if($content->course->user_id != Auth::user()->id)

				<script>
					window.location ="course_content";
				</script>

				{{ Session(['error' => 'You don\'t have access to this course']) }}

				@else



		<div class="row" style="margin-top: -120px">
			<div class="row container w3-white small-box w3-margin-bottom">
				<br>
				<div class="border">
					<p class="w3-medium left w3-margin"><b>UNIVERSITY OF BUEA<br> {{ Auth::user()->department->faculty->name }}<br> {{ Auth::user()->department->name }} <br> Year: @foreach($currentyear = App\Year::where('active', 1)->get() as $current) {{ $current->year }} @endforeach</b></p>


					<p class="w3-medium right w3-margin"><b>course title:</b> {{ $content->course->title }}<br><b>Course Code:</b> {{ $content->course->code }}<br><b>Course Master:</b>{{ $content->course->user->fname }} {{ $content->course->user->lname }}<br>
						<b>{{ $content->course->semester->name }} </b>
					</p>


						<div align="center" class="row">

							<img src="/images/images.jpg" class="w3-circle w3-center w3-margin" width="70" height="70"><br>
								<h5 class="w3-center col s12 l12 m12 blue-text w3-margin"><b>Course Syllabus for {{ $content->course->code }}</b> </h5>
				 
						</div>
				</div><hr class="divide">

						<div class="w3-border">
							<div class="w3-margin"> 	
								{!! $content->description !!}
								{!! $content->main_content !!}<hr>
							</div>
						</div>

		

				 <div><br></div>			
			</div>	
		</div>
		<div class="container small-box">
			<div class="w3-left w3-padding w3-margin">


@if (\App\Outline::where('course_id', '=', $content->course->id)->count() > 0)
	{{-- if outline aleady exist, then view it --}}
				<form action="{{ route('course.seeoutline') }}" method="get">
					
					{{ csrf_field() }}
					<input type="hidden" name="id" value="{{ $content->course->id }}">

					<a href="#" class="w3-btn w3-green w3-large w3-round waves-effect wave-green" onclick="load()"><i class="mdi-image-remove-red-eye white-text"></i><input type="submit" value="See Your Course Outline"></a>
					
				</form>

				
				

				@else

				{{-- if no outline exist, then create one --}}

				<form action="{{ route('course.outline') }}" method="get">
					
					{{ csrf_field() }}
					<input type="hidden" name="code" value="{{ $content->course->code }}">

					<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green" onclick="load()" style="background-color: #009999 !important;"><i class="mdi-action-settings white-text"></i><input type="submit" value="Proceed to set the Course Outline"></a>
					
					
				</form>
				

@endif



				
			</div>
			{{-- download the course syllabus --}}
			<div class="w3-right w3-padding w3-margin">
				<form action="{{ route('content.download', ['download'=>'pdf']) }}" method="get">
					{{ csrf_field() }}

					<input type="hidden" name="id" value="{{ $content->course->id }}">

					<a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><i class="mdi-file-file-download"></i><input type="submit" value="Download the Course Syllabus"></a>


					
				</form>			
			</div>
		</div>



<script type="text/javascript">
	$(document).ready(function() {
   
        $('html, body').animate({scrollTop:$(document).height()}, 3000);
        return false;
    

});
</script>

	@endif
 @endforeach
 <a href="#" class="scrollToTop w3-btn blue white-text shadow w3-opacity"><i class="mdi-navigation-arrow-drop-up w3-xlarge"></i></a>
@endsection


