@extends('content.include')


@section('title', 'Course_Outline')
@section('imag')
<link rel="icon" href="{{URL::asset('/images/images.jpg')}}" type="image/x-icon">
@endsection
@section('style')
<script src='https://devpreview.tiny.cloud/demo/tinymce.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>
  tinymce.init({
    selector: '#question',
    height: '300px',  // change this value according to your HTML
  plugins : 'advlist autolink link image lists charmap print preview',
   toolbar: 'undo redo | styleselect | bold italic | link image | underline fontsizeselect| strikethrough | alignleft | aligncenter | alignright | alignjustify',
  });
  </script>

<style>
	fieldset{
		border: solid 1px #000;
		padding: 10px;
		display: block;
		clear: both;
		margin:5px 0px;
	}
	legend{
		padding: 0px 10px;
		color: #fff;
	}
	input.add{
		float: left;
	}
	input.fielname{
		float: left;
		display: block;
		margin:5px;
	}
	select.fieldtype{
		float: left;
		display: block;
		margin: 5px;
	}
	#form{
		float: left;
		clear: both;
		display: block;
		margin: 5px;
	}
	#form input, #form textarea{
		float: left;
		display: block;
		margin: 5px;
	}
	.add{
		position: relative; 
		margin-top: -18px !important; 
		margin-left: 100px !important;
	}
	.subtract{
		position: relative; 
		margin-top: -18px !important; 

	}
	.upper{
		text-transform: uppercase;
		font-family: Times New Roman;
	}
	.f-f{
		font-family: Times New Roman;
	}
</style>
@endsection

@section('content')
@if(Request::is('setOutline'))
<script>
	$(document).ready(function(){
		$(".tab").hide();
	});
</script>
@else

@endif


	@include('file.message')
	@if(isset(Auth::user()->id))

	<a href="/course_content" class="w3-btn w3-grey w3-border w3-round" style="left: 10px; bottom: 250px; position: fixed; z-index: 10"><i class="mdi-hardware-keyboard-arrow-left red-text"></i> go back</a>

@foreach($courses as $course) 
				@if($course->department_id != Auth::user()->department_id)

				<script>
					window.location ="/course_content";
				</script>

				@else 

				@if($course->user->id != Auth::user()->id)
				<script>
					window.location = "/course_content";
				</script>
				@else

				@if (\App\Workcontent::where('course_id', '=', $course->id)->count() < 1)
				<script>
					window.location = "/course_content";
				</script>

				@else

				@if (\App\Outline::where('course_id', '=', $course->id)->count() > 0)



				<script type="text/javascript">
					window.location= '/course_content';
				</script>

				@else

<div class="row">

<div class="container w3-white syllabus" style="width: 95%; margin-top: -40px;">
				<br>
					<div class="w3-border">
						<div align="center" class="row">
							<center>
								<p class="w3-medium center upper w3-padding">
									<b>UNIVERSITY OF BUEA<br> Faculty of {{ Auth::user()->department->faculty->name }}<br> Department of {{ Auth::user()->department->name }}<br>
										<b class="blue-text">{{ $course->semester->name }}, 2018-2019
										</b>
									</b>
								</p>

								<label class="w3-margin blue-text w3-xlarge text-shadow">
									<b>Knowledge with wisdom</b>
								</label>
							</center>
							
							<h5 class="w3-center col s12 l12 m12 w3-medium w3-padding">
								<b class="w3-large blue-text">Setting up the Course Ouline for
									<i> {{ $course->code }} {{ $course->title }}
									</i>
								</b> 
							</h5>

							{{ date('M j, Y h:ia', strtotime( Carbon\Carbon::now())) }} 
						</div>
					</div><hr class="d-s">


	<div class="w3-padding">{{-- start of this dive for setting the course outline --}}
					
					<div class="col offset-l1 l10 s12 m12 w3-padding center w3-border w3-padding">
						<div class="col s12 m12 l8 offset-l2">
				        	<label for="question" style="font-size: 17px;" class="w3-margin w3-padding black-text">Enter the course Outline objectives (Topic per Topic). In each Topic you can add as much section and subsetion as you wish.<br><br>Save and add more topics, sections and subsection with respect to your syllabus</label>
				        </div>

				        {{-- form for adding only topics --}}
				    	<form method="post" action="{{ route('course.setopic') }}">
				    		{{ csrf_field() }}
				    		<div class='input-field col s12 offset-l1 l10 w3-border white'>
				    				<input type="hidden" name="course_id" value="{{ $course->id }}">
				    			<div class="input-field col offset-l3 s8 l6">
				    				<input name='topic' id='topic' type='text' class='validate'>
				    					<label for='topic'>Enter one Topic</label>
				    			</div>	
				    		</div>

				    		
				    		<div class="col s3 l3 l3 center w3-padding offset-l4">
				    			<input class="w3-btn w3-medium  Blue w3-round" type="submit" value="Save" style="background-color: #009999 !important;">
				    		</div>
				    	</form>
				    </div>




@if(App\Topic::where('course_id', $course->id)->exists())
<script type="text/javascript">
	$(document).ready(function() {
		var h = window.innerHeight;
   
        $('html, body').animate({scrollTop:$(document).height() - (h + 450)}, 2000);
        return false;
    

		});
	</script>

		<div class="col w3-margin w3-white syllabus view-box w3-animate-opacity" style="width: 95%">
				<br>

				<div class="border f-f">
					<p class="w3-medium left w3-margin"><b>UNIVERSITY OF BUEA<br> {{ Auth::user()->department->faculty->name }}<br> {{ Auth::user()->department->name }} <br> Year: 2018-2019</b></p>


					<p class="w3-medium right w3-margin"><b>course title:</b> {{ $course->title }}<br><b>Course Code:</b> {{ $course->code }}<br><b>Course Master: </b>{{ $course->user->fname }} {{ $course->user->lname }}<br>
						<b>{{ $course->semester->name }} </b>
					</p>


					<div align="center" class="row">

						<img src="/images/images.jpg" class="w3-circle w3-center w3-margin" width="70" height="70"><br>
							<h5 class="w3-center col s12 l12 m12 blue-text w3-margin">
								<b>Course Outline for {{ $course->code }}</b>
							</h5>
				 
					</div>
				</div><hr class="divide">


			<div class="w3-padding row">
				@foreach($topics = App\Topic::where('course_id', $course->id)->get() as $key => $topic)
					<div class="left w3-padding w3-border col offset-l1 s12 l10 m12"> 
						Topic: {{ $key+1 }}. <u>{{ $topic->topic }}</u>
					

						{{-- form for the subtopic --}}
						<div class="w3-padding-xxlarge">
							@foreach($sections = App\Section::where('topic_id', $topic->id)->get() as $keyy => $section)
							<div class="col s12 m12 l12">
								<b class="w3-margin-top w3-padding-xxlarge green-text">
									{{ $key+1 }}.{{ $keyy+1 }}- {{ $section->subtopic }}
								</b>
								@foreach($subsections = App\Subsection::where('section_id', $section->id)->get() as $keyyy => $subsection)
									<div class=" w3-padding blue-text" style="margin-left: 80px !important;">
										{{ $key+1 }}.{{ $keyy+1 }}.{{ $keyyy+1 }}- {{ $subsection->sub_section }}
									</div>
								@endforeach


								<div class="w3-padding">
									<form action="{{ route('course.setsubsection') }}" method="post">
										{{ csrf_field() }}
										<div class="col offset-l4 s6 l4 m6">
											<input type="hidden" name="subtopic_id" value="{{ $section->id }}" class="validate">
											<input type="hidden" name="course_id" value="{{ $course->id }}">

											<div class="input-field validate">
												<input type="text" name="subsection" id="subsection">
												<label for="subsection" id="label1">Add more sub-section</label>
											</div>
										</div>
									</form>
								</div><br><br>
							</div>
							@endforeach
							<div class="col s12 m12 l12">
							<form action="{{ route('course.setsection') }}" method="post">
								{{ csrf_field() }}
								<input type="hidden" name="topic_id" value="{{ $topic->id }}">
								<div class="input-field validate">
									<input type="text" name="section" id="section">
										<label for="section" id="label2">Add more section</label>
								</div>
							</form>
							</div>
						</div>
					</div><hr>
				@endforeach
			</div>
		</div>

@else

@endif






				{{-- final form submission --}}

					<form action="{{ route('setoutline') }}" method="post" class="validate">
						{{ csrf_field() }}

						<div class="row">
							
								<input type="hidden" name="course_id" value="{{ $course->id }}">
			      
					        <div class="col s12 m12 l8 offset-l2">
					        	
					         	<textarea id="question" name="description" style="display: none;">
									@foreach($topics = App\Topic::where('course_id', $course->id)->get() as $key => $topic)
										
											Topic: {{ $key+1 }}. <u>{{ $topic->topic }}</u><br><br>
										

										{{-- form for the subtopic --}}
										
											@foreach($sections = App\Section::where('topic_id', $topic->id)->get() as $keyy => $section)
												<b class="w3-padding-xlarge green-text">
													{{ $key+1 }}.{{ $keyy+1 }}- {{ $section->subtopic }}<br>
												</b>
												@foreach($subsections = App\Subsection::where('section_id', $section->id)->get() as $keyyy => $subsection)
													<div class=" w3-padding blue-text" style="margin-left: 80px !important;">
														{{ $key+1 }}.{{ $keyy+1 }}.{{ $keyyy+1 }}- {{ $subsection->sub_section }}
													</div>
												@endforeach
											@endforeach<br><hr>
									@endforeach
					          	</textarea>
					        </div>
			      		</div>


			      			<p class="w3-center w3-large w3-margin-top"> Additional options</p><br><br>
				      	 
				      		
				      			{{-- Total number of subsection --}}
				      		<?php $subsection = App\Subsection::where('course_id', $course->id)->count(); ?>
				      			<input type="hidden" name="number_subsection" class="validate" id="num_weeks" value="{{ $subsection }}">
				      	

					      	<div class="row w3-margin">
					      		<div class="input-field col s6 l3 m3 offset-l2">
					      			<input type="number" name="number_of_weeks" class="validate" id="num_weeks">
					      				<label for="num_weeks" class="w3-medium">Number of week(s)</label>
					      		</div>

					      		<div class="input-field col s6 l3 m3">
					      			<input type="number" name="number_of_assignment" class="validate" id="num_ass">
					      				<label for="num_ass" class="w3-medium">Number of assignment(s)</label>
					      		</div>

					      		<div class="input-field col s6 l3 m3">
					      			<input type="number" name="number_of_continuous_accessment" class="validate" id="num_ca">
					      				<label for="num_ca" class="w3-medium">Number of CA(s)</label>
					      		</div> 
					      	</div>
				      		
				      	
				      	
				    
				      			<div><br><br></div>

				      		<div class="w3-margin w3-center w3-large">

					   		 	<a href="#" class="w3-btn w3-green waves-effect waves-white w3-round" onclick="load()" style="background-color: #009999 !important;"><i class="mdi-action-settings white-text w3-medium"></i><input type="submit" value="Generate Outline"></a>
					      	</div>
					</form>
	</div>{{-- end of the div for setting up outline --}}
					
</div>	
				<div><br><br><br></div>

</div>

		
		@endif

		@endif
		@endif
		@endif


@endforeach

@else
<script>
	window.location = '/admin';
</script>
@endif
@endsection

