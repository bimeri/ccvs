@extends('content.include')


@section('title', 'registered-students')
@section('imag')
<link rel="icon" href="{{URL::asset('/images/images.jpg')}}" type="image/x-icon">
@endsection


@section('content')
@include('file.message')

<div class="container w3-white small-box w3-margin-bottom">
	<div class="row w3-white col offset-m2 s12 m8 l10" style="margin-top: 50px;">

@if(!isset(Auth::user()->id))

<script type="text/javascript">
	window.location = "/";
</script>

@else

<?php $firsts =\App\Course::select('*')->where('user_id', '=', Auth::user()->id)->where('semester_id', '=', 1)->get();?>


		
		<form action="{{ route('sstudents') }}" method="GET" class="validate">
			<div class="row">
				<div class="w3-border col offset-l2 s12 l8 m10 w3-padding w3-orange">
			 	 	<div class="w3-margin white-text">
			      		@lang('messages.chose') <i>five</i> @lang('messages.assist')
			     	</div>
			 	</div>
			 </div><hr class="divide">
				<div class="row">
					<h4 class="center blue-text w3-margin w3-padding">Select Course to see all registered or available students</h4>
				<br>
				<div class="input-field offset-l3 col s12 m6 l5">

				    <select class="validate" name="select_course">

				      	<option value="" disabled selected>Select the Course</option>
				      	<?php $currentsem = App\Semester::where('active', 1)->get(); ?>
					    	@foreach($currentsem as $current)
								@if($current->id == 1)

						     		@foreach($firsts as $first)
						      			<option value="{{ $first->id }}">{{ $first->title }}</option>
						     		@endforeach

					      		@else

							    	@foreach($seconds =\App\Course::select('*')->where('user_id', '=', Auth::user()->id)->where('semester_id', '=', 2)->get() as $second)
							     		<option value="{{ $second->id }}">{{ $second->title }}</option>
							    	@endforeach
					      		@endif
					    	@endforeach
				    </select><br>
				    <input type="submit" value="Load Students" class="w3-right w3-blue w3-btn waves-effect waves-blue w3-medium w3-round" style="background-color: #009999 !important;" onclick="load()">
			  	</div>
			  	
		 	</div>
  		</form>

 

	
</div>
</div>

		

	@endif
@endsection