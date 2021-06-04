@extends('content.include')


@section('title', 'check_register')
@section('imag')
<link rel="icon" href="{{URL::asset('/images/images.jpg')}}" type="image/x-icon">


@endsection


@section('content')
@if(isset(Auth::user()->id))
@include('file.message')
@foreach($courses as $course)

<?php $total_lessons = App\Taughtlesson::where('course_id', $course->id)->count(); ?>

@if($course->department->id != Auth::user()->department_id)
<script>
	window.location = 'course_covered';
	{{ Session(['message' => 'You don\'t have access to this course']) }}	
</script>
@else

@endif

@if(!(App\Statistic::where('course_id', $course->id)->exists()))

	<div class="container w3-white small-box view-box" style="box-shadow: none !important;">
		<br><br><br>
		<div class="row">
			<div class="white-text w3-margin w3-center w3-border orange">
				<p class="w3-margin w3-center">@lang('messages.endcourse') @lang('messages.endcourse2')</p>
			</div>
		</div>

	  	<div class="row center">
			
			<form action="{{ route('teacher.endlecture') }}" method="get" class="validate">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ $course->id }}">
				@foreach($years = App\Year::where('active', 1)->get() as $year)
				<input type="hidden" name="year_id" value="{{ $year->id }}">
				@endforeach
				<input type="hidden" name="semester_id" value="{{ $course->semester->id }}">
				<input type="hidden" name="department_id" value="{{ $course->department->id }}">
				<input type="hidden" name="level_id" value="{{ $course->level->id }}">
				<input type="hidden" name="time" value="{{  $totaltime }}">
				@foreach($outlines as $totaloutline)
				<?php $percent = number_format((float)$totalpercent/($totaloutline->number_subsection) * 100, 2, '.', '') ?>
				<input type="hidden" name="percentage" value="{{ $percent }}">
				@endforeach
				<input type="hidden" name="totallecture" value="{{ $total_lessons }}">
				<input type="hidden" name="lectureconsidered" value="{{ $total_lessons - $totalsuspended }}"> 

			  	<a onclick="load()"><input type="submit" value="End lecture for this course" class="w3-center w3-red w3-btn waves-effect waves-blue w3-medium w3-round"></a>
			</form><br>
	  	</div>
	</div>






@else

<div class="container w3-white small-box w3-border view-box w3-margin-bottom">
	<div class="row">
		<div class="white-text w3-margin w3-center teal w3-border lighten-3">
			<p class="w3-margin w3-center w3-xlarge c-t">Course General Statistics</p>
		</div>
	</div>
	
  	<div class="row center">
		
		<div class="row">
			<p class="w3-medium left w3-margin col s4"><b>UNIVERSITY OF BUEA<br> {{ Auth::user()->department->faculty->name }}<br> {{ Auth::user()->department->name }} <br> Year: 2018-2019</b></p>

			<p class="w3-medium right w3-margin col s4">course title:<b> {{ $course->title }}</b><br>Course Code: <b> {{ $course->code }}</b><br>Course Master: <b> {{ $course->user->fname }} {{ $course->user->lname }}</b><br>
				<b>{{ $course->semester->name }}</b></p>


			<div align="center" class="row">

				<img src="/images/images.jpg" class="w3-circle w3-center w3-margin" width="70" height="70"><br>
				<h5 class="w3-center col s12 l12 m12 w3-large orange-text w3-margin-top">Statistics for 
					<br><br><b class="w3-medium blue-text">{{ $course->code }}</b></h5>
			</div>
				<hr id="divide-black">
		</div><br>


		{{-- total number of lessons taught --}}
		<div class="row w3-border w3-padding w3-margin">
			

			<div class="col s12 l6 m6">
			<p class="w3-large">Total number of lectures this semester:<b class="w3-xlarge blue-text"> {{ $total_lessons }}</b></p>
			</div>
		

				{{-- total number of lessons rejected --}}
			<div class="col s12 l6 m6">
				
				<p class="w3-large">Total number of lectures suspended:<b class="w3-xlarge red-text"> {{ $totalsuspended }}</b></p>
				
			</div>

				{{-- real number of lectures considered --}}
			<div class="row center"><br><br>
				
				<p class="w3-xlarge">Total number of lecture considered for this semester: <u><b class="w3-xxlarge orange-text" id="notification">  {{ $total_lessons - $totalsuspended }}</b></u></p>
				
			</div>

		</div>

		{{-- total time --}}
		<div class="row">
			<div class="col s11 l5 m6 w3-border w3-margin w3-padding">
				
				<p class="center w3-xlarge">Total time taken for all lectures this semeter <br>
				<h5 class="w3-btn right white-text shadow w3-padding" style="background-color: #009999"><i class=" w3-medium"></i>
                    <br><b class="w3-xlarge">{{  $totaltime }} hours</b></h5>
                </p>
			</div>


			{{-- total percentage cover --}}
			 @foreach($outlines as $totaloutline)
			<div class="col right s11 l6 m6 w3-border w3-margin w3-padding">
				
				<p class="center w3-xlarge">Total percentage covered for lectures this semeter<br>
				<a href="#" class="w3-btn right white-text shadow w3-margin" style="background-attachment: #009999;"><br><i class="mdi-action-bookmark-outline w3-medium"></i> <b class="w3-medium">
			<?php $checker = number_format((float)$totalpercent/($totaloutline->number_subsection) * 100, 2, '.', '') ?>
				@if($checker > 100) 100% @else	{{ $checker }}% @endif</b></a></p>
				
			</div>
		</div>
		
		 <script src="{{URL::asset('gstatic.js')}}"></script>

			<script>
				google.charts.load('current', {packages: ['corechart']});

				google.charts.setOnLoadCallback(drawChart);

				function drawChart()
				{
					var data = new google.visualization.DataTable();

					data.addColumn('string', 'Element');
					data.addColumn('number', 'percentage');

					data.addRows([['Completed',@if($checker > 100) 100 @else	{{ $checker }} @endif], ['incomplete', 100 - (@if($checker > 100) 100 @else	{{ $checker }} @endif)]]);
					var options = 
					{
						title: 'Pecentage of work Completed to work Incompleted',
						//is3D: true,
						pieHole:0.4
					};

					var chart = new google.visualization.PieChart(document.getElementById('mypiechart'));
					chart.draw(data, options);
				}

			</script>
		<div class="row w3-margin">
			<div id="mypiechart" class="col s12 l6 m11 w3-margin w3-padding w3-border w3-margin-top w3-margin-bottom w3-margin-right" style="width: 90%; height: 400px; background-color: #64B5F6 !important;"></div>
		</div>
  	</div>


  	@include('file.conditions')

	@endforeach
</div>
@endif


@endforeach


@else
<script>
	window.location = '/admin';
</script>
@endif
@endsection