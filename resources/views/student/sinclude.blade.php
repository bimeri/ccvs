<!DOCTYPE html>
<html>
<head>


	<title>@yield('title')</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="{{URL::asset('js/jquery-3.2.1.js')}}"></script>
	<script src="{{URL::asset('js/jquery-1.9.0.min.js')}}"></script>
	<script src="{{URL::asset('js/jquery.js')}}"></script>
	@yield('imag')
	<link rel="stylesheet" type="text/css" href="{{URL::asset('materialize/css/materialize.css')}}">
	@yield('style') <!-- a link to shutcut image -->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/style/w3.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/style/w3-school.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/style/student.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('style/st.css')}}">

<style type="text/css">
.cont{
  min-height: calc(100vh - 300px);
}
/* Style the tab */
.tab {
    overflow-x: auto;
    overflow-y: hidden;
    margin-top: -100px;
    border-bottom: 2px solid #fff;
}

}

/* Style the buttons inside the tab */
.tab a {
    background-color: inherit;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 15px;
}


/* Create an active/current tablink class */
.tab a.activ {
  color: #00ccff;
    background-color: #fff !important;
}

#message{
  position: absolute;
  top: 70px;
  font-size: 30px;
  right: 200px;
}
#message1{
  position: absolute;
  top: 70px;
  font-size: 25px;
  right: 120px;
  width: 3.2%;
  box-shadow: 0px 3px 4px 2px rgba(0,0,0,0.2);
  background-color: #00cccc !important;
}
#name{
  position: absolute;
  top: 25px;
  font-size: 17px;
  right: 230px;
  text-transform: uppercase;
  font-family: New Times Roman;

}
#messagecount{
  position: absolute;
  top: 75px;
  right: 210px;
  z-index: 10;
  opacity: .8;
}
#dropbtn{
  position: absolute;
  top: 50px;
  right: 40px;
}
.yearandsemester{
  text-transform: capitalize;
  color: #0a6fc2;
}
#question{
 
}
</style>
</head>
<body>
	@if(Auth::guard('student')->check())


<div class="col s12 header">
	<img src="images/2.png" class="w3-circle w3-border-white w3-margin dropbtn dropdown-button right" height="50" width="50" alt="logo" id="dropbtn">
  <a href="#"><i class="mdi-communication-email right white-text" id="message"></i></a>

	<i class="w3-badge-special right w3-circle w3-border hidden-xs" id="message1">
    <small><b class="w3-badge w3-white w3-medium" style="margin-bottom: 8px !important;"><small class="w3-color-text2">?</small></b></small>
  </i>
  
  <p class="right name w3-margin w3-padding-large" id="name">{{ Auth::user()->name }} ({{ Auth::user()->matricule }})<br>
   <b class="yearandsemester"style="font-size: 15px;"> 
    @foreach($semesters = App\Semester::where('active', 1)->get() as $semester){{ $semester->name }},@endforeach  @foreach($years= App\Year::where('active', 1)->get() as $year){{ $year->year }}@endforeach</b></p><br>
 

<p class="w3-large hidden-xs w3-margin w3-padding white-text head1"><b class="w3-xlarge">{{ __('Course Coverage')  }}</b><br><small class="w3-color-text">{{ __('The University of Buea') }}</small></p>


</div>



<a href="#" class="waves-effect waves-light w3-btn-floating-large w3-theme-action w3-right w3-hide-large w3-hide-medium" id="floating-btn">+</a>


				<div class="w3-border w3-padding dropdown-content1 right"  id="myDropdown">
			        <ul>
			            <a href="#">
			            	<span class="mdi-action-account-circle" id="span-in">&nbsp;Profile
			            	</span>
			            </a><hr class="divide">
			            <a href="#">
			            	<span class="mdi-content-create" id="span-in">&nbsp;Change Password
			            	</span>
			            </a><hr class="divide">
			            <a href="#">
			            	<span class="mdi-action-supervisor-account" id="span-in">&nbsp;User Account
			            	</span>
			            </a><hr class="divide">
			              <a href="/studentlogout">
			              	<strong id="dropdown-logout"><i class="mdi-action-settings-power"></i>&nbsp;logout {{ Auth::user()->name }}</strong>
			              </a>
			        </ul>
     			</div>

<!--tabs -->

<div class="tab center container">
  <a href="courses" class="w3-btn-s {{ Request::is('courses') ? 'activ' : '' }}" onclick="load()">Registered courses</a>

  @foreach($current_years = App\Year::where('active', 1)->get() as $current_year)
  @foreach($current_semeters = App\Semester::where('active', 1)->get() as $current_semester)
  		@if (\App\Selectedstudent::where('student_id', '=', Auth::user()->id)->where('year_id', $current_year->id)->exists())

  <a href="student_markregister" class="w3-btn-s {{ Request::is('student_markregister') ? 'activ' : '' }}" onclick="load()">Mark Register</a>


  <?php $selected = App\Selectedstudent::where('student_id', Auth::user()->id)->where('status', 1)->get(); 
    $notifications = null;
    foreach ($selected as $select) 
    {
      if ($select->course->semester->active == 1) 
      {
        $notifications++;
      }
    }
  ?>
        

  @if($notifications == 0)
    <a href="#" class="w3-btn-s disabled {{ Request::is('notification') ? 'activ' : '' }}">Notification <span class="w3-badge w3-green">0</span></a>

   @else
      <a href="#" class="tablinks w3-btn-s disabled w3-border dropdown-button  {{ Request::is('notification') ? 'activ' : '' }}" data-activates='dropdown2' id="action">Notification <span class="w3-badge orange">{{ $notifications }}</span></a>



      <ul id='dropdown2' class='dropdown-content'>
        @foreach($notifications = App\Selectedstudent::where('student_id', '=', Auth::user()->id)->where('status', 1)->get() as $notification)
        
          @foreach($courses = App\Course::where('id', $notification->course_id)->get() as $course)
           @if($course->semester->active == 1)
            <p><small class="w3-margin blue-text">{{ $course->code }}, not marked</small></p>
              <hr class="divide">
              @else
              @endif
     
          @endforeach
        @endforeach
      </ul>
    @endif


    <button class="w3-btn-s dropdown-button" data-activates='dropdown1'>Delegate for 

      <?php $selected = App\Selectedstudent::where('student_id', Auth::user()->id)->get(); 
          $count = 0;
          foreach ($selected as $select) 
          {
            if ($select->course->semester->active == 1) 
            {
              $count++;
            }
          }
        ?>
 
      @if($count == 1) 
    	   <span class="black-text">{{ $count }}</span> 
         Course

      @else
        <span class="red-text"> {{ $count }}</span> 
          Courses
      @endif
    </button>

  	@else

  	@endif
    <!-- Dropdown Structure -->
  <ul id='dropdown1' class='dropdown-content'>
    @foreach($students = App\Selectedstudent::where('student_matricule', '=', Auth::user()->matricule)->get() as $student)
      @if($student->course->semester->active == 1)
        <p><small class="w3-margin blue-text">{{ $student->course->code }}, {{ $student->course->title }}</small></p>
        <li class="divider"></li><br>
      @else
       @endif
    @endforeach
  </ul>

  @endforeach
  @endforeach
</div>




				<!-- general speaking to the authors -->
            <!-- view in desktop and tablet mode -->
           <a class="w3-hide-small modal-trigger waves-effect waves-light right m-button" href="#modal1" id="floating-btn1"><b class="left w3-margin w3-medium" style="letter-spacing: 2px;">Offline</b><b class="right"><i class="mdi-hardware-keyboard-arrow-up w3-margin w3-medium"></i></b></a>
            <!-- view in android mode -->
            <a href="#modal1" class="modal-trigger waves-effect waves-light w3-btn-floating-large w3-theme-action w3-right w3-hide-large w3-hide-medium" id="floating-btn"><i class="mdi-action-settings-voice"></i></a>


         <!-- Modal Structure -->
                <div id="modal1" class="modal modal-fixed-footer w3-border" style="font-size: 23px;">
                  <div class="row"  style="overflow-x: hidden;overflow-y: hidden;">
                    <h3 class="center m-h w3-hide-small">Talk to us <em class="w3-large w3-blue w3-circle w3-margin">Live</em> your mind</h3><hr class="w3-hide-small" style="border-top: 5px solid #00ccff">

                    <h6 class="center m-h w3-hide-medium w3-hide-large">Talk to us <em class="w3-large w3-blue w3-circle w3-margin">Live</em> your mind</h6><hr class="w3-border-color w3-hide-medium w3-hide-large">
                    <div><br></div>

                    <form action="#" method="post" class="w3-margin">
                      {{ csrf_field() }}


                <div class="input-field col s6" id="inp">
                  <input name="full_name" id="full_name" type="text" class="validate">
                  <label for="full_name" id="labels">Full Name</label>
                </div>


                <div class="input-field col s6" id="inp">
                  <input id="email" name="email" type="email" class="validate">
                  <label for="email" id="labels">email</label><br><br>
                </div>

                 <div class="input-field col s12" id="inp">
                  <textarea id="livechart" name="livechart" type="text" class="materialize-textarea validate"></textarea>
                  <label for="livechart" id="labels">Talk to us</label><br>
                </div>
                <div><br></div>

                      <input type="submit" value="send" class="right waves-effect waves-green w3-btn w3-round">

                    </form>

                  </div>
                      <div class="modal-footer m-f">
                        <button class="right modal-close waves-effect waves-green">close</button>
                      </div>
                </div>


 		<div class="container cont">
      <div><br></div>
 			@yield('content')
 		</div>


 	@include('content.footer')

@else
<script type="text/javascript">
	window.location='slogin';
</script>
@endif

<script type="text/javascript">
  var timerStart = Date.now();

  $(document).ready(function()
  {
     setInterval(function()
     {
        $('#menu').fadeOut();
      }, Date.now()-timerStart);
    
  });

$(document).ready(function(){
    $('ul.tabs').tabs('select_tab', 'tab_id');
  });
</script>

     <div id="menu" style="height: 800px !important; width: 100% !important; background-color: #2196F3 !important; position: fixed !important; top:0px; bottom: 0px; left: 0px; right: 0px; z-index: 1000; opacity: .7">
          <div class="w3-margin-top">
            <center>
            
            <div class="preloader-wrapper big active" style="margin-top: 300px !important;">
              <div class="spinner-layer spinner-white-only">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>
            </center>
          </div>

        </div>

{{-- <div id="menu" style="height: 800px !important; width: 100% !important; background-color: #2196F3 !important; position: fixed !important; top:0px; bottom: 0px; left: 0px; right: 0px; z-index: 1000;">
          <div class="w3-margin-top">
            <center>
            
            <div class="preloader-wrapper big active" style="margin-top: 300px !important;">
              <div class="spinner-layer spinner-white-only">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>
            </center>
          </div>

        </div>

<script type="text/javascript">
  

    document.getElementById('menu').style.display = 'none';

      function load(){
    document.getElementById('menu').style.display = 'block';

    }

</script> --}}
<script src="{{URL::asset('materialize/js/materialize.min.js')}}"></script>
<script src="{{ URL::asset('js/scripting.js') }}"></script>
</body>
</html>
