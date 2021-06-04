@extends('student.sinclude')

@section('title', 'student-registered-courses')

@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
@endsection

@section('content')

		<div class="w3-margin"><br></div>
<?php $currentsem = App\Semester::where('active', 1)->get(); ?>
<div class=" w3-white w3-border w3-margin-bottom col offset-l1 offset-m2 s12 m8 l10" style="min-height: 100px; position: relative; z-index: 4">
	@foreach($currentsem as $current)
	@if($current->id == 1)
 		<div class="w3-border w3-margin">

 			@foreach ($courses->courses as $course)
 			@foreach($updates = DB::table('course_student')->where('course_id', '=', $course->id)->where('student_id', '=', Auth::user()->id)->where('status', 1)->get() as $update)
 			@if($course->semester_id == 1)

 			<p class="w3-margin w3-padding w3-yellow" style="text-align: center;">Course Syllabus has been updated, {{ $course->code }}</p>

 			@else
 			@endif
 			
 			@endforeach
 			@endforeach

 			<div class="w3-margin">
					<label id="labels">first semester</label><br>

				<div class="row" style="overflow-x: scroll;">
					<table class="w3-striped w3-table w3-centered w3-bordered w3-table-all">
					    <tr class="light-blue white-text"><?php $count = 1; ?>
					      <th>S/N<div><br></div></th>
					      <th>Course Code</th>
					      <th>Course Title</th>
					      <th>Course Master</th>
					      <th>download Course syllabus</th>
					      <th>Download Course outline</th>
					    </tr>
					

						@foreach ($courses->courses as $course)

						<tr>@if($course->semester_id == 1)
							<td>{{ $count++ }}</td>
							<td>{{ $course->code }}</td>
							<td>{{ $course->title }}</td>
							<td> {{ $course->user->fname }} {{ $course->user->lname }}</td>

							<td>
								<form action="{{ route('content.sdownload', ['download'=>'pdf']) }}" method="get">
									{{ csrf_field() }}

									<input type="hidden" name="id" value="{{ $course->id }}">

									@if(DB::table('course_student')->where('course_id', '=', $course->id)->where('student_id', '=', Auth::user()->id)->where('status', 1)->exists())

									
									<a href="#" class="w3-btn orange w3-round waves-effect w3-medium wave-green"><i class="mdi-file-file-download"></i><input type="submit" value="Download Updated Syllabus"></a>
									@else
									@if (\App\Workcontent::where('course_id', '=', $course->id)->count() > 0)

									<a href="#" class="w3-btn w3-blue w3-round waves-effect w3-medium wave-green"><i class="mdi-file-file-download"></i><input type="submit" value="Download Course Syllabus"></a>

									@else
									<a class="w3-btn w3-blue w3-opacity w3-round disabled">syllabus not available</a>

									@endif
									@endif
									
								</form>
							 </td>

							 <td>

							 	<form action="{{ route('outline.sdownload', ['download'=>'pdf']) }}" method="get">

									<input type="hidden" name="id" value="{{ $course->id }}">

									@if (\App\Outline::where('course_id', '=', $course->id)->count() > 0)
								 	<a href="#" class="w3-btn w3-green waves-effect waves-blue w3-medium w3-round"><input type="submit" value="Download Course Outline" onclick="first()"><i class="mdi-file-file-download"></i></a>
								     @else
									<a class="w3-btn w3-green w3-opacity w3-round disabled">Outline not available</a>

									@endif	
								</form>	
							  </td>

						 		@else

						 	@endif
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>





		@else

		<div class="w3-border w3-margin">
			@foreach ($courses->courses as $course)
 			@foreach($updates = DB::table('course_student')->where('course_id', '=', $course->id)->where('student_id', '=', Auth::user()->id)->where('status', 1)->get() as $update)
 			@if($course->semester_id == 2)

 			<p class="w3-margin w3-padding w3-yellow" style="text-align: center;">Course Syllabus has been updated, {{ $course->code }}</p>

 			@else
 			@endif
 			
 			@endforeach
 			@endforeach
 			<div class="w3-margin">
					<label id="labels">Second semester</label><br>

				<div class="row" style="overflow-x: scroll;">
					<table class="w3-striped w3-table w3-centered w3-bordered w3-table-all">
					    <tr class="light-blue white-text"><?php $count = 1; ?>
					      <th>S/N<div><br></div></th>
					      <th>Course Code</th>
					      <th>Course Title></th>
					      <th>Course Master</th>
					      <th>download Course content</th>
					      <th>Download Course outline</th>
					    </tr>
					

						@foreach ($courses->courses as $course) 
						<tr>@if($course->semester_id == 2)
							<td>{{ $count++ }}</td>
							<td>{{ $course->code }}</td>
							<td>{{ $course->title }}</td>
							<td> {{ $course->user->fname }} {{ $course->user->lname }}</td>

							<td>
								<form action="{{ route('content.sdownload', ['download'=>'pdf']) }}" method="get">
									{{ csrf_field() }}

									<input type="hidden" name="id" value="{{ $course->id }}">

									@if(DB::table('course_student')->where('course_id', '=', $course->id)->where('student_id', '=', Auth::user()->id)->where('status', 1)->exists())
									
									<a href="#" class="w3-btn orange w3-round waves-effect w3-medium wave-green"><i class="mdi-file-file-download"></i><input type="submit" value="Download Updated Content"></a>
									@else

									@if(\App\Workcontent::where('course_id', '=', $course->id)->count() > 0)

									<a href="#" class="w3-btn w3-blue w3-round waves-effect w3-medium wave-green"><i class="mdi-file-file-download"></i><input type="submit" value="Download Course Content"></a>

									@else
									<a class="w3-btn w3-blue w3-opacity w3-round disabled">syllabus not available</a>

									@endif
									@endif
									
								</form>
							 </td>

							 <td>

							 	<form action="{{ route('outline.sdownload', ['download'=>'pdf']) }}" method="get">

									<input type="hidden" name="id" value="{{ $course->id }}">

									@if (\App\Outline::where('course_id', '=', $course->id)->count() > 0)
								 	<a href="#" class="w3-btn w3-green waves-effect waves-blue w3-medium w3-round"><input type="submit" value="Download Course Outline" onclick="first()"><i class="mdi-file-file-download"></i></a>
								     @else
									<a class="w3-btn w3-green w3-opacity w3-round disabled">Outline not available</a>

									@endif	
								</form>	
							  </td>

						 		@else

						 	@endif
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
		@endif
		@endforeach
</div>

@endsection