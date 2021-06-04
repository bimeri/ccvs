<center>
			
				<div class="w3-white w3-margin-bottom" style="width: 80%; overflow-x: auto;">

						<table class="w3-table w3-striped w3-bordered">

							<tr class="w3-blue w3-opacity">
								<th>S/N</th>
								<th>Icon</th>
								<th>first name</th>
								<th>last name</th>
								<th>email</th>
								<th>phone Number</th>
								<th>Courses</th>
							</tr>
								@foreach($users =\App\User::select('*')->where('department_id', '=', Auth::user()->department->id )->get() as $key => $user)


									<tr>
										<td>{{ $key+1 }}</td>
										<td><img src="images/man.png" class="w3-circle" height="50" width="50"></td>
										<td>{{ $user->fname }}</td>
										<td>{{ $user->lname }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->phone }}</td>
										<td>
											<div class="w3-container w3-margin w3-padding cl s6 m6 l6">
												<a href="#" class="w3-btn orange w3-large w3-round waves-effect wave-white white-text"  onclick="document.getElementById('{{ $key+1 }}').style.display='block'">View
												</a><br><i class="mdi-image-remove-red-eye orange-text"></i>
											</div>
										</td>
									</tr>

<style>
	.teacherinfo{
  max-height: 500px;overflow-y: auto; overflow-x: hidden;
}
.teacherinfo::-webkit-scrollbar {
  width: 8px;
}
.teacherinfo::-webkit-scrollbar-thumb {
  border-radius: 100px;
  background: #2196F3 !important;
}
</style>


<div id="{{ $key+1 }}" class="w3-modal">
    <div class="w3-modal-content w3-animate-right">
	    <header class="w3-container w3-blue"> 
	    	<span onclick="document.getElementById('{{ $key+1 }}').style.display='none'" 
	        class="w3-button w3-display-topright w3-padding w3-hover w3-margin">X</span>
	        	<h2>{{ $user->fname }}'s Personal Profile</h2>
	    </header>

	    <div class="row">

	    	<div class="w3-margin-left col s12 m12 l4 w3-card-4 w3-padding">
	    		<div class="w3-container w3-padding">
	    			<img src="images/man.png" class="w3-rounded" height="240" width="240">
	    		</div>
	    		<p><b class="upper orange-text w3-padding w3-large">{{ $user->fname }} {{ $user->lname }}</b></p>
	    	</div>

	    	<div class="w3-margin col s12 m12 l7 w3-padding w3-border teacherinfo">
	    		<p class="blue-text w3-xlarge">Personal Information</p><hr class="divide">
	    		<div class="w3-container w3-center">
	    			<p><i class="blue-text w3-large">First Name:</i> {{ $user->fname }},&nbsp; <i class="blue-text w3-large">Last Name:</i> {{ $user->lname }}</p>

	    			<i class="blue-text w3-large">Full Name:</i> {{ $user->fname }} {{ $user->lname }}<br>
	    			<i class="blue-text w3-large">Email:</i> {{ $user->email }}<br>
	    			<i class="blue-text w3-large">Contact:</i> {{ $user->phone }}
	    		</div><hr class="divide"><hr class="divide" style="margin-top: -15px;">
	    		@foreach($currentyear = App\Year::where('active', 1)->get() as $current)
	    		 <p class="center w3-xlarge" style="font-family: Times New Roman"><b>All course for the year <i class="w3-xlarge blue-text">{{ $current->year }}</i></b></p><hr class="divide" style="margin-top: -15px;">
	    		 @endforeach

	    		<div class="row">
		    		<div class="col s12 l6 m6">
		    		 	<h4>First Semester</h4><hr class="divide">
		    		 	@foreach($courses = App\Course::where('user_id', $user->id)->where('semester_id', 1)->orderBy('code')->get() as $course) 
						 	{{ $course->code }} {{ $course->title }}<hr>
						@endforeach
		    		</div>

		    		<div class="col s12 l6 m6">
		    		 	<h4>Second Semester</h4><hr class="divide">
		    		 	@foreach($courses = App\Course::where('user_id', $user->id)->where('semester_id', 2)->orderBy('code')->get() as $course) 
						 	{{ $course->code }} {{ $course->title }}<hr>
						@endforeach
		    		</div>
	    		</div>
	    	</div>

			{{--@foreach($courses = App\Course::where('user_id', $user->id)->get() as $course) 
					 			{{ $course->code }} {{ $course->title }},
					 				<sup class="blue-text">{{ $course->semester->name }}</sup><br><br>
					 		@endforeach --}} 
	    </div>
    </div>
</div>

								 @endforeach
						</table>
				

					
				</div>
			</center>


