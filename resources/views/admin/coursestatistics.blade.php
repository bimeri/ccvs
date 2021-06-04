@extends('admin.include')



@section('title', 'course-statistics')
@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
@endsection
@section('content')
@foreach($courses as $course)


@if($course->department->id != Auth::user()->department_id)
<script>
	window.location = 'statistics';
	{{ Session(['message' => 'You don\'t have access to this course']) }}	
</script>
@else

@endif

		 
	<div class="container w3-white syllabus view-box w3-animate-opacity" style="width: 80%; margin-top: -10px;">
	<div class="row">
		<div class="light-green lighten-3 green-text w3-margin w3-center w3-border w3-animate-opacity green">
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
			@foreach($coursestatistics as $statistic)
				<div class="row w3-border w3-padding w3-margin">
					

					<div class="col s12 l12 m12">
					<p class="w3-large">Total number of lectures this semester:<b class="w3-xlarge blue-text"> {{ $statistic->total_lecture }}</b></p>


					<p class="w3-large">Total number of lectures rejected:<b class="w3-xlarge red-text"> {{ $statistic->total_lecture - $statistic->lecture_considered }}</b></p>

					<p class="w3-xlarge">Total number of lecture considered for this semeter: <u><b class="w3-xxlarge orange-text" id="notification">  {{ $statistic->lecture_considered }}</b></u></p>

					</div>


				</div>

				{{-- total time --}}
				<div class="row">
					<div class="col s11 l5 m6 w3-border w3-margin w3-padding w3-margin-right">
						
						<p class="center w3-xlarge">total time taken for all lectures this semeter: <br>
						<a href="#" class="w3-btn right orange white-text shadow w3-margin"><i class="mdi-av-timer w3-medium"></i> <b class="w3-xlarge">{{  $statistic->time }} hours</b></a></p>
					</div>


					{{-- total percentage cover --}}
					<div class="col s11 l6 m6 w3-border w3-margin w3-padding w3-margin-right">
						
						<p class="center w3-xlarge">total percentage covered for lectures this semeter: <br>
						<a href="#" class="w3-btn right green white-text shadow w3-margin"><i class="mdi-action-bookmark-outline w3-medium"></i> <b class="w3-xlarge">
					<?php $checker = $statistic->percent; ?>

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

							data.addRows([
								['Completed',{{ $statistic->percent }}], 
								['incomplete', {{ 100 - $statistic->percent }}]
								]);
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
					<div id="mypiechart" class="col s12 l6 m11 w3-margin w3-padding w3-border w3-margin-top w3-margin-bottom w3-margin-right" style="width: 90%; height: 400px; background-color: #00ccff!important;"></div>
				</div>
			@endforeach
	</div>			
</div><br><br>

@endforeach
@endsection
