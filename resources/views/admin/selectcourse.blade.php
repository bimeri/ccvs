@extends('admin.include')


@section('title', 'register')

@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
@endsection

@section('content')

	<div class="row">
		<div class="container w3-box w3-white">
			
			<p class="w3-large w3-margin">All the courses available for @foreach($levels as $level) <b class="w3-xlarge">{{ $level->name }}</b> @endforeach </p>

				{{--<img src="/images/images.jpg" class="w3-circle" width="70" height="70"><br> --}}

				<hr class="divide">
				
						<div id="courses" class="s12 loader">
							<div class="preloader-wrapper big active">
							    <div class="spinner-layer spinner-blue-only">
							      <div class="circle-clipper left">
							        <div class="circle"></div>
							      </div><div class="gap-patch">
							        <div class="circle"></div>
							      </div><div class="circle-clipper right">
							        <div class="circle"></div>
							      </div>
							    </div>
							</div>
					 	</div>
					

					<script>
						// my loader
					    document.getElementById('courses').style.display = 'none';

					      function load(){
							   document.getElementById('courses').style.display = 'block';
							}

					</script>

			<div class="w3-border w3-box w3-center w3-large w3-container w3-margin">
												
				<div class="row">

							<hr class="divide">		
						<div class="w3-white tabl">
							<h3 class="w3-margin w3-opacity semester w3-left blue-text">@foreach($semesters as $semester) {{ $semester->name }} @endforeach</h3>

							@foreach($levels as $level)

							<form action="{{ route('admin.levelregister') }}" method="get">
								{{ csrf_field() }}

								<input type="hidden" name="semester_id" value="{{$semester->id}}"/>
    						 	<input type="hidden" name="level_id" value="{{$level->id}}"/>

    						<a href="#" class="w3-margin w3-btn w3-green semester w3-right blue-text" onclick="load()"> Register for <b class="w3-xlarge"><i class="mdi-hardware-keyboard-arrow-right"></i><input type="submit" value="{{ $level->name }}" style="background-color: transparent; border:none;"></b></a>
							</form>
							
    						
							@endforeach


							<table class="w3-table w3-striped w3-bordered w3-margin">

								<tr class="w3-blue">
									<th>S/N</th>
									<th>course Code</th>
									<th>Course Title</th>
									<th>
										<div class="center">
											Action
										</div>
									</th>
								</tr>
						
								@foreach($courses as $key => $course)
						
									<tr>
										<td>{{ $key+1 }}</td>
										<td> {{ $course->code }}</td>
										<td>{{ $course->title}}</td>

										<td>
											<div class="row">
												<div class="col s16 m6 l6">
													<form method="get" action="{{ route('admin.courseregister') }}" class="validate">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $course->id }}">
														<input type="submit" value="See Register" class="w3-btn w3-color waves-effect waves-blue w3-medium w3-round"  onclick="load()"><br><i class="mdi-image-remove-red-eye w3-text-color"></i>
													</form>

												</div>

												<div class="col s16 m6 l6">
													@if(App\Outline::where('course_id', $course->id)->count() >0)

													<form method="get" action="{{ route('outline.admindownload', ['download'=>'pdf']) }}" class="validate">
														{{ csrf_field() }}
														<input type="hidden" name="course_id" value="{{ $course->id }}">
														<input type="submit" value="Download Outline" class="w3-btn orange waves-effect waves-blue w3-medium w3-round"><br><i class="mdi-file-file-download w3-text-orange"></i>
													</form>

													@else
												
													<input type="submit" value="Outline unavailable" class="w3-btn w3-opacity orange w3-medium w3-round disabled"><br><i class="mdi-action-visibility-off w3-text-orange"></i>
													@endif
												</div>
											</div>
											
											
										</td>
										
									</tr>

								 @endforeach

							</table>
						</div>




					
				 </div>

			</div>	
		
		</div>
	</div>

@endsection