		<hr class="divide">
		<hr class="divide">
		<h2 class="blue-text">Second Semester</h2>

<div class="w3-margin w3-border">


			<h4>level 200</h4>
				<div class="w3-border w3-white w3-animate-zoom tabl w3-margin" style="overflow-x: scroll;">

						<table class="w3-table w3-striped w3-bordered w3-margin">

							<tr class="w3-blue">
								<th>S/N</th>
								<th>course Code</th>
								<th>Course Title</th>
								<th>Name of Lecturer</th>

								<th colspan="4" style="text-align: center;">Action</th>

							</tr>
								@foreach($courses =\App\Course::select('*')->where('department_id', '=', Auth::user()->department_id)->where('semester_id', '=', 2)->where('level_id', 2)->orderBy('code','asc')->get() as $key => $course)

									<tr>
										<td> {{ $key+1 }} </td>
										<td> {{ $course->code }}</td>
										<td>{{ $course->title}}</td>
										<td>{{ $course->user->fname}} {{ $course->user->lname}} </td>

										<td><!-- creating the course content -->
											<form method="get" action="{{ route('create') }}">

													<input type="hidden" name="id" value="{{ $course->id }}">

	        									@if (\App\Workcontent::where('course_id', '=', $course->id)->count() > 0)
	        										<a class="w3-btn blue blue-text lighten-4 w3-opacity w3-round disabled">disabled</a>

	        									@else

													<input type="submit" value="Create" class="w3-btn blue blue-text lighten-4 waves-effect waves-blue w3-medium w3-round"><br><i class="mdi-av-my-library-add blue-text"></i>

												@endif
											</form>
										</td>


										<td><!-- viewing the course content -->
											<form method="get" action="{{ route('view') }}">
												{{ csrf_field() }}
												<input type="hidden" name="course_id" value="{{ $course->id }}">
												<input type="submit" value="View" class="w3-btn light-green lighten-3 waves-effect waves-blue w3-medium w3-round" style="color:green;"><br><i class="mdi-image-remove-red-eye green-text"></i>

											</form>
										</td>

										<td><!-- editing the scheme of work -->
											<form method="get" action="{{ route('getedit') }}">
														{{ csrf_field() }}
												<input type="hidden" name="course_id" value="{{ $course->id }}">

												@if(\App\Workcontent::where('course_id', '=', $course->id)->exists())
											<input type="submit" value="Edit" class="w3-btn orange-text yellow accent-1  waves-effect waves-blue w3-medium w3-round"><br><i class="mdi-content-create yellow-text"></i>

											@else

											<a class="w3-btn w3-orange w3-round w3-opacity w3-round disabled">disabled</a>
												@endif

											</form>
										</td>

										<td><!-- delete the scheme of work -->
											<form method="post" action="{{ route('delete') }}">
													{{ csrf_field() }}
													@foreach($workcontent = App\Workcontent::where('course_id', '=', $course->id)->get() as $content)
												<input type="hidden" name="content_id" value="{{ $content->id }}">
												<input type="hidden" name="course_id" value="{{ $content->course_id}}">

													@endforeach

												@if (\App\Workcontent::where('course_id', '=', $course->id)->exists())
													<input type="submit" value="Delete" class="w3-btn red-text materialize-red lighten-4 waves-effect waves-blue w3-medium w3-round" style="color:#F44336"><br><i class="mdi-action-delete red-text"></i>


												@else

													<a class="w3-btn w3-pink w3-round w3-opacity w3-round disabled">disabled</a>
												@endif

											</form>
										</td>


									</tr>



								 @endforeach
						</table>
				</div><br>



			<h4>level 300</h4>
				<div class="w3-border w3-white w3-animate-zoom tabl w3-margin" style="overflow-x: scroll;">

						<table class="w3-table w3-striped w3-bordered w3-margin">

							<tr class="w3-blue">
								<th>S/N</th>
								<th>course Code</th>
								<th>Course Title</th>
								<th>Name of Lecturer</th>
								<th colspan="4" style="text-align: center;">Action</th>


							</tr>
								@foreach($courses =\App\Course::select('*')->where('department_id', '=', Auth::user()->department_id)->where('semester_id', '=', 2)->where('level_id', 3)->orderBy('code','asc')->get() as $key => $course)

									<tr>
										<td> {{ $key+1 }} </td>
										<td> {{ $course->code }}</td>
										<td>{{ $course->title}}</td>
										<td>{{ $course->user->fname}} {{ $course->user->lname}} </td>

										<td><!-- creating the course content -->
											<form method="get" action="{{ route('create') }}">

													<input type="hidden" name="id" value="{{ $course->id }}">

	        									@if (\App\Workcontent::where('course_id', '=', $course->id)->count() > 0)
	        										<a class="w3-btn blue blue-text lighten-4 w3-opacity w3-round disabled">disabled</a>

	        									@else

													<input type="submit" value="Create" class="w3-btn blue blue-text lighten-4 waves-effect waves-blue w3-medium w3-round"><br><i class="mdi-av-my-library-add blue-text"></i>

												@endif

											</form>
										</td>


										<td><!-- viewing the course content -->
											<form method="get" action="{{ route('view') }}">
												{{ csrf_field() }}
												<input type="hidden" name="course_id" value="{{ $course->id }}">
												<input type="submit" value="View" class="w3-btn light-green lighten-3 waves-effect waves-blue w3-medium w3-round" style="color:green;"><br><i class="mdi-image-remove-red-eye green-text"></i>

											</form>
										</td>


										<td><!-- editing the scheme of work -->
											<form method="get" action="{{ route('getedit') }}">
														{{ csrf_field() }}
													<input type="hidden" name="course_id" value="{{ $course->id }}">

												@if(\App\Workcontent::where('course_id', '=', $course->id)->exists())
											<input type="submit" value="Edit" class="w3-btn orange-text yellow accent-1  waves-effect waves-blue w3-medium w3-round"><br><i class="mdi-content-create yellow-text"></i>

											@else

											<a class="w3-btn w3-orange w3-round w3-opacity w3-round disabled">disabled</a>
												@endif

											</form>
										</td>

										<td><!-- delete the scheme of work -->
											<form method="post" action="{{ route('delete') }}">
													{{ csrf_field() }}
													@foreach($workcontent = App\Workcontent::where('course_id', '=', $course->id)->get() as $content)
												<input type="hidden" name="content_id" value="{{ $content->id }}">
												<input type="hidden" name="course_id" value="{{ $content->course_id}}">

													@endforeach

												@if (\App\Workcontent::where('course_id', '=', $course->id)->exists())
													<input type="submit" value="Delete" class="w3-btn red-text materialize-red lighten-4 waves-effect waves-blue w3-medium w3-round" style="color:#F44336"><br><i class="mdi-action-delete red-text"></i>


												@else

													<a class="w3-btn w3-pink w3-round w3-opacity w3-round disabled">disabled</a>
												@endif

											</form>
										</td>


									</tr>



								 @endforeach
						</table>
				</div><br>



				<h4>level 400</h4>
				<div class="w3-border w3-white w3-animate-zoom tabl w3-margin" style="overflow-x: scroll;">

						<table class="w3-table w3-striped w3-bordered w3-margin">

							<tr class="w3-blue">
								<th>S/N</th>
								<th>course Code</th>
								<th>Course Title</th>
								<th>Name of Lecturer</th>
								<th colspan="4" style="text-align: center;">Action</th>


							</tr>
								@foreach($courses =\App\Course::select('*')->where('department_id', '=', Auth::user()->department_id)->where('semester_id', '=', 2)->where('level_id', 4)->orderBy('code','asc')->get() as $key => $course)

									<tr>
										<td> {{ $key+1 }} </td>
										<td> {{ $course->code }}</td>
										<td>{{ $course->title}}</td>
										<td>{{ $course->user->fname}} {{ $course->user->lname}} </td>

										<td><!-- creating the course content -->
											<form method="get" action="{{ route('create') }}">

													<input type="hidden" name="id" value="{{ $course->id }}">

	        									@if (\App\Workcontent::where('course_id', '=', $course->id)->count() > 0)
	        										<a class="w3-btn blue blue-text lighten-4 w3-opacity w3-round disabled">disabled</a>

	        									@else

													<input type="submit" value="Create" class="w3-btn blue blue-text lighten-4 waves-effect waves-blue w3-medium w3-round"><br><i class="mdi-av-my-library-add blue-text"></i>

												@endif

											</form>
										</td>


										<td><!-- viewing the course content -->
											<form method="get" action="{{ route('view') }}">
												{{ csrf_field() }}
												<input type="hidden" name="course_id" value="{{ $course->id }}">
												<input type="submit" value="View" class="w3-btn light-green lighten-3 waves-effect waves-blue w3-medium w3-round" style="color:green;"><br><i class="mdi-image-remove-red-eye green-text"></i>

											</form>
										</td>


										<td><!-- editing the scheme of work -->
											<form method="get" action="{{ route('getedit') }}">
														{{ csrf_field() }}
													<input type="hidden" name="course_id" value="{{ $course->id }}">

												@if(\App\Workcontent::where('course_id', '=', $course->id)->exists())
											<input type="submit" value="Edit" class="w3-btn orange-text yellow accent-1  waves-effect waves-blue w3-medium w3-round"><br><i class="mdi-content-create yellow-text"></i>

											@else

											<a class="w3-btn w3-orange w3-round w3-opacity w3-round disabled">disabled</a>
												@endif

											</form>
										</td>

										<td><!-- delete the scheme of work -->
											<form method="post" action="{{ route('delete') }}">
													{{ csrf_field() }}
													@foreach($workcontent = App\Workcontent::where('course_id', '=', $course->id)->get() as $content)
												<input type="hidden" name="content_id" value="{{ $content->id }}">
												<input type="hidden" name="course_id" value="{{ $content->course_id}}">

													@endforeach

												@if (\App\Workcontent::where('course_id', '=', $course->id)->exists())
													<input type="submit" value="Delete" class="w3-btn red-text materialize-red lighten-4 waves-effect waves-blue w3-medium w3-round" style="color:#F44336"><br><i class="mdi-action-delete red-text"></i>


												@else

													<a class="w3-btn w3-pink w3-round w3-opacity w3-round disabled">disabled</a>
												@endif

											</form>
										</td>


									</tr>



								 @endforeach
						</table>
				</div><br>




				<h4>level 500</h4>
				<div class="w3-border w3-white w3-animate-zoom tabl w3-margin" style="overflow-x: scroll;">

						<table class="w3-table w3-striped w3-bordered w3-margin">

							<tr class="w3-blue">
								<th>S/N</th>
								<th>course Code</th>
								<th>Course Title</th>
								<th>Name of Lecturer</th>
								<th colspan="4" style="text-align: center;">Action</th>


							</tr>
								@foreach($courses =\App\Course::select('*')->where('department_id', '=', Auth::user()->department_id)->where('semester_id', '=', 2)->where('level_id', 5)->orderBy('code','asc')->get() as $key => $course)

									<tr>
										<td> {{ $key+1 }} </td>
										<td> {{ $course->code }}</td>
										<td>{{ $course->title}}</td>
										<td>{{ $course->user->fname}} {{ $course->user->lname}} </td>

										<td><!-- creating the course content -->
											<form method="get" action="{{ route('create') }}">

													<input type="hidden" name="id" value="{{ $course->id }}">

	        									@if (\App\Workcontent::where('course_id', '=', $course->id)->count() > 0)
	        										<a class="w3-btn blue blue-text lighten-4 w3-opacity w3-round disabled">disabled</a>

	        									@else

													<input type="submit" value="Create" class="w3-btn blue blue-text lighten-4 waves-effect waves-blue w3-medium w3-round"><br><i class="mdi-av-my-library-add blue-text"></i>

												@endif

											</form>
										</td>


										<td><!-- viewing the course content -->
											<form method="get" action="{{ route('view') }}">
												{{ csrf_field() }}
												<input type="hidden" name="course_id" value="{{ $course->id }}">
												<input type="submit" value="View" class="w3-btn light-green lighten-3 waves-effect waves-blue w3-medium w3-round" style="color:green;"><br><i class="mdi-image-remove-red-eye green-text"></i>

											</form>
										</td>


										<td><!-- editing the scheme of work -->
											<form method="get" action="{{ route('getedit') }}">
														{{ csrf_field() }}
													<input type="hidden" name="course_id" value="{{ $course->id }}">
												<input type="hidden" name="course_id" value="{{ $content->course_id}}">


												@if(\App\Workcontent::where('course_id', '=', $course->id)->exists())
											<input type="submit" value="Edit" class="w3-btn orange-text yellow accent-1  waves-effect waves-blue w3-medium w3-round"><br><i class="mdi-content-create yellow-text"></i>

											@else

											<a class="w3-btn w3-orange w3-round w3-opacity w3-round disabled">disabled</a>
												@endif

											</form>
										</td>

										<td><!-- delete the scheme of work -->
											<form method="post" action="{{ route('delete') }}">
													{{ csrf_field() }}
													@foreach($workcontent = App\Workcontent::where('course_id', '=', $course->id)->get() as $content)
												<input type="hidden" name="content_id" value="{{ $content->id }}">
													@endforeach

												@if (\App\Workcontent::where('course_id', '=', $course->id)->exists())
													<input type="submit" value="Delete" class="w3-btn red-text materialize-red lighten-4 waves-effect waves-blue w3-medium w3-round" style="color:#F44336"><br><i class="mdi-action-delete red-text"></i>


												@else

													<a class="w3-btn w3-pink w3-round w3-opacity w3-round disabled">disabled</a>
												@endif

											</form>
										</td>


									</tr>



								 @endforeach
						</table>
				</div>
</div>
