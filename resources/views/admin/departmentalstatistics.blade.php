@extends('admin.include')


@section('title', 'department-statistics')
@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
<style type="text/css">
#upper{
	text-transform: uppercase;
}
table{
  border:3px solid #2196F3 !important;
}
tr{
  background-color: #e6e6e6;
}
td{
  border: 0.5px dotted black !important;
}

</style>

  
@endsection	
@section('content')
		
<div class="row">
	<div class="container w3-white syllabus view-box w3-animate-opacity" style="width: 80%; margin-top: 50px;">
		<img src="/images/images.jpg" class="w3-circle w3-right w3-margin" width="80" height="80">
		<img src="/images/images.jpg" class="w3-circle w3-left w3-margin" width="80" height="80">
		<p class="w3-large w3-padding w3-margin-top" id="upper" style="font-family: Times New Romans"><b>university of buea<br>faculty of {{ Auth::user()->department->faculty->name }}<br>department of {{ Auth::user()->department->name }}</b>
			<br><br>
			<em>General Course Covered statistics for @foreach($semesters as $semester)<b class="blue-text"> {{ $semester->name }}</b>, @endforeach @foreach($years as $year)<b class="blue-text"> {{ $year->year }}</b>. @endforeach</em><hr class="divides"><br>
		</p>

		@foreach($years as $year)
			@foreach($semesters as $semester)
				@if(App\Register::where('year', $year->year)->where('semester', $semester->name)->exists())

					<div class="col s12 m12 l12 w3-padding w3-border w3-margin-bottom">
						

						<?php 
							$counter = 0;

							foreach ($courses as $course) {

							 if (App\Statistic::where('course_id', '=', $course->id)->exists()) {
							   $counter++;
							 }
							 } 
						?>
						<div class="row w3-margin w3-padding w3-large">
						<div class="col s12 m6 l6">
							Total number of Course for this Semester <b class="w3-large"><u>{{ $numberofcourses }}</u></b>
						</div>
						<div class="col s12 m6 l6">
							Number of lecturers who ended lectures already <b class="w3-large blue-text">{{ $counter }}</b>
						</div>
						</div>
						<hr id="divide1">
						<hr id="divide1" class="top"><br>

						<div class="col s12 m3 l2 left w3-border w3-padding w3-margin">
							<h3>All courses</h3>
						@foreach($courses as $course)
						@if(App\Statistic::where('course_id', $course->id)->exists()) {{ $course->code }}<i class="mdi-action-done blue-text w3-xxlarge"></i><hr style="margin-top: -1px"> @else {{ $course->code }}<hr style="margin-top: -1px"> @endif @endforeach
						</div>
					

					<div class="col s12 m8 l9 w3-border w3-padding  w3-animate-zoom" style="background-color: #e6e6e6">
				 		<span onclick="this.parentElement.style.display='none'" class="w3-close w3-closebtn right w3-xlarge red-text">x</span>
						<div class="blue-text w3-margin w3-large">Only Statistics for course that ended lectures are recorded</div>
					</div>

<div class="col s12 l9 m7 w3-border w3-padding-xlarge w3-margin-right w3-margin-bottom">

	{{-- all the calculation --}}

{{-- avereage lecture --}}

		@foreach($years as $year)
			@foreach($semesters as $semester)
			<?php $considered_lecture = App\Statistic::select('*')->where('year_id', $year->id)->where('semester_id', $semester->id)->where('department_id', Auth::user()->department_id)->sum('lecture_considered'); ?>

			<?php $total_lecture = App\Statistic::select('*')->where('year_id', $year->id)->where('semester_id', $semester->id)->where('department_id', Auth::user()->department_id)->sum('total_lecture'); ?>

			<?php $time = App\Statistic::select('*')->where('year_id', $year->id)->where('semester_id', $semester->id)->where('department_id', Auth::user()->department_id)->sum('time'); ?>

			<?php $percent = App\Statistic::select('*')->where('year_id', $year->id)->where('semester_id', $semester->id)->where('department_id', Auth::user()->department_id)->sum('percent'); ?>
			@endforeach
		@endforeach

	<table cellpadding="5">

        <tr>
          <td class="w3-padding"><b class="blue-text w3-large" id="upper">index</b></td>
          <td class="w3-padding"><b class="blue-text w3-large" id="upper">Evaluation per course</b></td>
        </tr>

        <tr>
          <td class="w3-padding"><b id="upper">average participation</b></td>
          <td class="w3-padding">{{ number_format((float)($counter/$numberofcourses)*100, 2, '.', '')   }} %</td>
        </tr>

        <tr>
          <td class="w3-padding"><b id="upper">average lecture</b></td>
          <td class="w3-padding">{{ number_format((float)(($considered_lecture/$total_lecture)*100/$numberofcourses), 2, '.', '')   }} %</td>
        </tr>

        <tr>
          <td class="w3-padding"><b id="upper">average time for lectures</b></td>
          <td class="w3-padding">{{ number_format((float)($time/$numberofcourses), 2, '.', '')   }} hours</td>
        </tr>

        <tr>
          <td class="w3-padding"><b id="upper">average percentage covered</b></td>
          <td class="w3-padding">{{ number_format((float)($percent/$numberofcourses), 2, '.', '')   }} %</td>
        </tr>

    </table>
    <?php $checker = number_format((float)($percent/$numberofcourses), 2, '.', ''); ?>
    	<div class="center w3-padding w3-border w3-margin orange white-text w3-large" id="upper">General Recommendation<br>

    		@if($checker > 98)
    		<div class="col offset-l1 s7 l5 m5 white-text w3-padding-tiny w3-border center w3-green" style="height: 30px; position: absolute; text-transform: capitalize;">Excellent work: grade a
    		</div>

    		@elseif($checker > 84)
    		<div class="col offset-l1 s7 l5 m5 w3-padding-tiny w3-border center w3-blue" style="height: 30px; position: absolute; text-transform: capitalize;">very good work: grade b+
    		</div>
    		@elseif($checker > 79)
    		<div class="col offset-l1 s7 l5 m5 white-text w3-padding-tiny w3-border center w3-aqua" style="height: 30px; position: absolute; text-transform: capitalize;">good work: grade b
    		</div>

    		@elseif($checker > 76)
    		<div class="col offset-l1 s7 l5 m5 w3-padding-tiny w3-border center w3-teal" style="height: 30px; position: absolute; text-transform: capitalize;">above average: grade c+
    		</div>
    		@elseif($checker > 69)
    		<div class="col offset-l1 s7 l5 m5 black-text w3-padding-tiny w3-border center" style="height: 30px; position: absolute; text-transform: capitalize;">average work: grade c
    		</div>

    		@elseif($checker > 65)
    		<div class="col offset-l1 s7 l5 m5 red-text w3-padding-tiny w3-border center" style="height: 30px; position: absolute; text-transform: capitalize;">below average work: grade d+
    		</div>

    		@elseif($checker > 59)
    		<div class="col offset-l1 s7 l5 m5 white-text w3-padding-tiny w3-border center w3-black" style="height: 30px; position: absolute; text-transform: capitalize;">poor work: grade d
    		</div>

    		@else
    		<div class="col offset-l1 s7 l5 m5 w3-red w3-padding-tiny w3-border center" style="height: 30px; position: absolute; text-transform: capitalize;">failing work: grade f
    		</div>

    		@endif
		</div>
		
</div>

	{{-- draw the pie chart --}}

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
						['Completed',{{number_format((float)($percent/$numberofcourses), 2, '.', '') }}], 
						['incomplete', {{ 100 - number_format((float)($percent/$numberofcourses), 2, '.', '') }}]
						]);
					var options = 
					{
						title: 'Average work Completed to work Incompleted',
						//is3D: true,
						pieHole: 0.4
					};

					var chart = new google.visualization.PieChart(document.getElementById('mypiechart'));
					chart.draw(data, options);
				}

			</script>

	<div class="row w3-margin">
		<div id="mypiechart" class="col s10 l9 m7 w3-margin w3-padding w3-border w3-margin-top w3-margin-bottom w3-margin-right" style="height: 300px; background-color: #e6e6e6 !important;">		
		</div>
		</div>
						


<a href="departmentstatisticsview" class="w3-btn w3-grey w3-border w3-round" onclick="load()" style="left: 10px; bottom: 50px; position: fixed;"><i class="mdi-hardware-keyboard-arrow-left red-text"></i> go back</a>

				@else
					<div class="w3-padding w3-border w3-margin-bottom">

						<p class="orange white-text w3-padding w3-margin w3-medium w3-animate-right">@lang('messages.NoResult')</p>


					</div>
					<a href="departmentstatisticsview" class="right w3-btn w3-red" onclick="load()"><i class="mdi-communication-call-missed white-text"></i> go back</a>
				@endif
			@endforeach
		@endforeach


		</div>
	</div>
</div>


@endsection