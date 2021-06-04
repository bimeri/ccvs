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
	@yield('style')
	<link rel="stylesheet" type="text/css" href="{{URL::asset('materialize/css/materialize.css')}}">
	@yield('imag') <!-- a link to shutcut image -->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/style/w3.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/style/w3-school.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('/style/content.css')}}">

	<style>

body {font-family: Arial;}

/* Style the tab */
.tab {
    overflow-x: auto;
    overflow-y: hidden;
    width: auto;
    background-color:  transparent !important;
    margin-top: -170px;
    border-bottom: 2.3px solid #fff;
}

}

/* Style the buttons inside the tab */
.tab a {
    background-color: inherit;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 14px;
}


/* Create an active/current tablink class */
.tab a.activ {
  color: #009999;
  background-color: #fff !important;
}

#message{
  position: absolute;
  top: 70px;
  font-size: 35px;
  right: 220px;
}
#message1{
  position: absolute;
  top: 70px;
  font-size: 27px;
  right: 130px;
  width: 4.2%;
  box-shadow: 0px 3px 4px 2px rgba(0,0,0,0.2);
  background-color: #009999 !important;
}
#name{
  position: absolute;
  top: 50px;
  font-size: 17px;
  right: 260px;
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
  color: #000;
}
</style>

</head>
<body>
  <center><div class="w3-margin w3-right w3-padding hide-on-med-and-down" style="position: absolute; display: inline-block; top:-15px; margin-left: -60px !important;">
    <canvas id="canvas" width="110" height="110" style=""></canvas>
<script>
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.90
setInterval(drawClock, 1000);

function drawClock() {
    ctx.arc(0, 0, radius, 0 , 2*Math.PI);
    ctx.fillStyle = "#ccc";
    ctx.fill();
}

function drawClock() {
    drawFace(ctx, radius);
}

function drawFace(ctx, radius) {
    var grad;

    ctx.beginPath();
    ctx.arc(0, 0, radius, 0, 2*Math.PI);
    ctx.fillStyle = '#ccc';
    ctx.fill();

    grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
    grad.addColorStop(0, '#009999');
    grad.addColorStop(0.5, '#ccc');
    grad.addColorStop(1, '#aaa');
    ctx.strokeStyle = grad;
    ctx.lineWidth = radius*0.1;
    ctx.stroke();

    ctx.beginPath();
    ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
    ctx.fillStyle = '#333';
    ctx.fill();
}

function drawClock() {
    drawFace(ctx, radius);
    drawNumbers(ctx, radius);
}

function drawNumbers(ctx, radius) {
    var ang;
    var num;
    ctx.font = radius*0.15 + "px Comic Sans MS";
    ctx.textBaseline="middle";
    ctx.textAlign="center";
    
    for(num= 1; num < 13; num++){
        ang = num * Math.PI / 6;
        ctx.rotate(ang);
        ctx.translate(0, -radius*0.85);
        ctx.rotate(-ang);
        ctx.fillText(num.toString(), 0, 0);
        ctx.rotate(ang);
        ctx.translate(0, radius*0.85);
        ctx.rotate(-ang);
    }
}

function drawClock() {
    drawFace(ctx, radius);
    drawNumbers(ctx, radius);
    drawTime(ctx, radius);
}

function drawTime(ctx, radius){
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    //hour
    hour=hour%12;
    hour=(hour*Math.PI/6)+(minute*Math.PI/(6*60))+(second*Math.PI/(360*60));
    drawHand(ctx, hour, radius*0.5, radius*0.07);
    //minute
    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
    drawHand(ctx, minute, radius*0.8, radius*0.07);
    // second
    second=(second*Math.PI/30);
    drawHand(ctx, second, radius*0.9, radius*0.02);
}

function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0,0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
}


</script>
  </div>
</center>

@if(Auth::guard('web')->check())
@if(isset(Auth::user()->id))
<div class="col s12 header" style="background-color: #009999 !important;">
	<img src="{{URL::asset('images/2.png')}}" class="w3-circle w3-border-white w3-margin dropbtn dropdown-button right" height="60" width="60" alt="logo" id="dropbtn">

<?php $courses = App\Course::where('user_id', Auth::user()->id)->get();

$counter = null;
foreach ($courses as $course) {
  if ($course->semester->active == 1) {
    if (App\Outline::where('course_id', '=', $course->id)->where('status', '=', 1)->exists()) {
   $counter++;
 }
  }

 
 } 

 ?>
@foreach($courses as $course)
  @if(!(App\Outline::where('course_id', $course->id)->where('status', 1)->exists()))
    <a href="#"><i class="mdi-communication-email right white-text" id="message"></i></a>

  @else
    <a href="/home"><i class="mdi-communication-email right white-text" id="message"></i><b class="w3-badge orange w3-tiny w3-border" id="messagecount">{{ $counter }}</b></a>
  @endif
@endforeach
  <i class="w3-badge-special right w3-circle w3-border w3-hide-small" id="message1"><b class="w3-badge w3-aqua w3-medium w3-margin-bottom">?</b></i>
  
	<p class="right name w3-margin" id="name">{{ Auth::user()->fname }} {{ Auth::user()->lname }}<br>
   <b class="yearandsemester"style="font-size: 15px;"> @foreach($semesters = App\Semester::where('active', 1)->get() as $semester){{ $semester->name }},@endforeach  @foreach($years= App\Year::where('active', 1)->get() as $year){{ $year->year }}@endforeach</b></p><br>
 

		<p class="w3-padding w3-xlarge blue-text head1 w3-hide-small">{{ Auth::user()->faculty }}</p>
    <p class="w3-xlarge w3-padding white-text w3-hide-small">{{ Auth::user()->department->name }}</p>  
</div>

			<div class="w3-border w3-padding dropdown-content1 right"  id="myDropdown">
			        <ul>
			            <a href="#">
			            	<span class="mdi-action-account-circle" id="span-in">&nbsp;Profile
			            	</span>
			            </a><hr class="coc-menu1">
			            <a href="#">
			            	<span class="mdi-content-create" id="span-in">&nbsp;Change Password
			            	</span>
			            </a><hr class="coc-menu1">
			            <a href="#">
			            	<span class="mdi-action-supervisor-account" id="span-in">&nbsp;User Account
			            	</span>
			            </a><hr class="coc-menu1">
			              <a href="/logout">
			              	<strong id="dropdown-logout"><i class="mdi-action-settings-power"></i>&nbsp;logout {{ Auth::user()->fname }}</strong>
			              </a>
			        </ul>
     		</div>

<!--tabs -->

<div class="tab center container hide-on-med-and-down">
  <a href="home" class=" w3-btn-s {{ Request::is('home') ? 'activ' : '' }}"  onclick="load()"><i class="mdi-action-home w3-xlarge"></i></a>

  <a href="course_content" class=" w3-btn-s {{ Request::is('course_content', 'seeoutline') ? 'activ' : '' }}"  onclick="load()">Course Syllabus/Outline</a>
  <a href="registered_Students" class=" w3-btn-s {{ Request::is('registered_Students', 'sstudents') ? 'activ' : '' }}"  onclick="load()">Registered Students</a>
  <a href="mark_register" class=" w3-btn-s {{ Request::is('mark_register', 'markregister') ? 'activ' : '' }}"  onclick="load()">Mark Register</a>
  <a href="check_register" class=" w3-btn-s {{ Request::is('check_register', 'checkregister') ? 'activ' : '' }}"  onclick="load()">Check Register</a>
  <a href="course_covered" class=" w3-btn-s {{ Request::is('course_covered', 'coursecovered') ? 'activ' : '' }}"  onclick="load()">Course Covered</a>
</div>

 

    <div class="nav-wrapper" style="font-size: 20px !important;">

      <a href="#" data-activates="mobile-demo" class="button-collapse w3-hide-large white-text w3-xxxlarge w3-margin w3-right" style="margin-top: -60px !important; margin-right: 50px !important; ">
        <i class="material-icons mdi-action-view-headline"></i></a>
      
      <ul class="side-nav" id="mobile-demo" style="background-color: #ddeebb;">
        <li><a href="home" class="w3-large w3-btn-s {{ Request::is('home') ? 'activ' : '' }}"  onclick="load()"><i class="mdi-action-home w3-xlarge"></i></a></li>
        <li><a href="course_content" class="w3-large w3-btn-s {{ Request::is('course_content') ? 'activ' : '' }}"  onclick="load()">Course Syllabus/Outline</a></li>
        <li><a href="registered_Students" class="w3-large w3-btn-s {{ Request::is('registered_Students') ? 'activ' : '' }}"  onclick="load()">Registered Students</a></li>
        <li><a href="mark_register" class="w3-large w3-btn-s {{ Request::is('mark_register', 'markregister') ? 'activ' : '' }}"  onclick="load()">Mark Register</a></li>
        <li><a href="check_register" class="w3-large w3-btn-s {{ Request::is('check_register', 'checkregister') ? 'activ' : '' }}"  onclick="load()">Check Register</a></li>
        <li><a href="course_covered" class="w3-large w3-btn-s {{ Request::is('course_covered', 'coursecovered') ? 'activ' : '' }}"  onclick="load()">Course Covered</a></li>
      </ul>
    </div>




 

				<!-- general speaking to the authors -->
            <!-- view in desktop and tablet mode -->
            <a class="w3-hide-small modal-trigger waves-effect waves-light right m-button" href="#modal1" id="floating-btn1" style="background-color: #009999 !important;">
              <b class="left w3-margin w3-medium" style="letter-spacing: 2px;">Offline</b>
              <b class="right">
                <i class="mdi-hardware-keyboard-arrow-up w3-margin w3-medium"></i>
              </b>
            </a>
            <!-- view in android mode -->
            <a href="#modal1" class="modal-trigger waves-effect waves-light w3-btn-floating-large w3-theme-action w3-right w3-hide-large w3-hide-medium" id="floating-btn"  style="position: fixed;z-index: 30;background-color: #009999 !important;"><i class="mdi-action-settings-voice"></i></a>

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

				  

 		<div class="container cont" style="width: 90% !important">
 		
 			@yield('content')
 		</div><br><br>
    
<div class="footer_one w3-padding" style="background-color: #003333 !important;">

    <center>
        <p id="dateField" style="color: white;"></p>
        <p style="text-align: center; color: #fff">
            &copy;Powered by
            <a  target="_blank" href ="http://www.go-groups.net" style="color:#00ccff"> Go-Groups. Ltd</a>
        </p>
    </center>
</div>


{{-- <div id="menu" style="height: 800px !important; width: 100% !important; background-color: #009999 !important; position: fixed !important; top:0px; bottom: 0px; left: 0px; right: 0px; z-index: 1000;">
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

        </div> --}}
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
 function load(){
    var timerStart = Date.now();

  $(document).ready(function()
  {
     setInterval(function()
     {
        $('#menu').hide(Date.now()-timerStart);
      }, Date.now()-timerStart);
    
  });

    }
</script>

     <div id="menu" style="height: 800px !important; width: 100% !important; background-color: #009999 !important; position: fixed !important; top:0px; bottom: 0px; left: 0px; right: 0px; z-index: 1000; opacity: .8">
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

{{-- <script type="text/javascript">
  

    document.getElementById('menu').style.display = 'none';

      function load(){
    document.getElementById('menu').style.display = 'block';

    }


</script> --}}

<script src="{{URL::asset('materialize/js/materialize.min.js')}}"></script>
<script src="{{ URL::asset('js/scripting.js') }}"></script>

@else
  <script> window.location= "/admin"; </script>
@endif
@else
 	<script> window.location= "/admin"; </script>
@endif
</body>
</html>

<!--
<i class="mdi-action-stars" style="color:green; margin-left: 20px;"></i>
<center><i class="mdi-action-stars center" style="color: red; margin-top: -50px"></i> </center>
<i class="mdi-action-stars w3-right" style="color: yellow; margin-right: 30px; margin-top: -63px;" ></i>