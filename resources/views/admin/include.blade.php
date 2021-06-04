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

	<link rel="stylesheet" type="text/css" href="{{URL::asset('materialize/css/materialize.css')}}">
	@yield('imag') <!-- a link to shutcut image -->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/style/w3.css')}}">


	<link rel="stylesheet" type="text/css" href="{{URL::asset('/style/w3-school.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/style/content.css')}}">

	<!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->

 @yield('style')
 <script src="{{URL::asset('Chart.js')}}"></script>

 <script src="{{URL::asset('graph.js')}}"></script>

	<script src="{{ URL::asset('js/scripting.js') }}"></script>


	<script src="{{URL::asset('materialize/js/materialize.js')}}"></script>

<script src="{{URL::asset('materialize/js/materialize.min.js')}}"></script>


 <script>

      window.liveSettings = {
        api_key: "a0b49b34b93844c38eaee15690d86413",
        picker: "bottom-right",
        detectlang: true,
        dynamic: true,
        autocollect: true
      };
 </script>

<style>

body {font-family: Arial;}

/* Style the tab */
.tab {
    overflow-x: auto;
    overflow-y: hidden;

    background-color:  transparent !important;
    margin-top: -178px;
    border-bottom: 2.5px solid #fff;
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
  top: 65px;
  font-size: 15px;
  right: 128px;
  width: 3.8%;
  box-shadow: 0px 3px 4px 2px rgba(0,0,0,0.2);
  background-color: #00cccc !important;
}
#name{
  position: absolute;
  top: 50px;
  font-size: 17px;
  right: 260px;
  text-transform: uppercase;
  font-family: New Times Roman;

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
.w3-box{
  margin-top: 50px;
}
</style>
</head>
<body>
	@if(Auth::guard('admin')->check())
  @if(isset(Auth::user()->id))


<div class="col s12 header">

	<img src="images/2.png" class="w3-circle w3-border-white w3-margin dropbtn dropdown-button right" height="50" width="50" alt="logo" id="dropbtn">
 <i class="w3-badge-special right w3-circle w3-border w3-hide-small" id="message1"><b class="w3-badge w3-aqua w3-small w3-margin-bottom" style="margin-top: 12px !important; color: #fff !important">?</b></i>
 <a href="#"><i class="mdi-communication-email right white-text" id="message"></i></a>

 <p class="right name w3-margin" id="name">{{ Auth::user()->name }}<br>
   <b class="yearandsemester"style="font-size: 15px;"> @foreach($semesters = App\Semester::where('active', 1)->get() as $semester){{ $semester->name }},@endforeach  @foreach($years= App\Year::where('active', 1)->get() as $year){{ $year->year }}@endforeach</b></p><br>
 



<div class="blue-text w3-padding head w3-hide-small"><h2>{{ __('Course Coverage')}}</h2></div>
<div><br><br></div>
<div class="white-text w3-padding w3-margin w3-hide-small" style="position: absolute;"><h4>{{ Auth::user()->department->faculty->name}}<br><br><b class="w3-medium w3-margin">{{ Auth::user()->department->name }}</b></h4></div>
     		
	
</div>


<a href="#" class="waves-effect waves-light w3-btn-floating-large w3-theme-action w3-right w3-hide-large w3-hide-medium" id="floating-btn">+</a>


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
			              <a href="{{ route('admin.logout') }}">
			              	<strong id="dropdown-logout"><i class="mdi-action-settings-power"></i>&nbsp;logout, <small>{{ Auth::user()->name }}</small></strong>
			              </a>
			        </ul>
     		</div>

<!--tabs -->

<div class="tab center container hide-on-med-and-down">
  <a href="lecturer" class="w3-btn-s {{ Request::is('lecturer') ? 'activ' : '' }}" onclick="load()">All Lecturers</a>
  <a href="syllabus" class="w3-btn-s {{ Request::is('syllabus', 'create-syllabus') ? 'activ' : '' }}" onclick="load()">All syllabus</a>
  <a href="register" class="w3-btn-s {{ Request::is('register', 'seeregister', 'levelregister', 'coursesregister') ? 'activ' : '' }}" onclick="load()">View Register</a>
  <a href="statistics" class="w3-btn-s {{ Request::is('statistics', 'levelstatistics', 'coursestatistics', 'departmentstatisticsview', 'levelstatisticsview', 'departmentstatistics', 'levelstatistic') ? 'activ' : '' }}" onclick="load()">Statistics</a>
  <a href="fstatistics" class="w3-btn-s {{ Request::is('fstatistics', 'allcourseStatistics') ? 'activ' : '' }}" onclick="load()">Final Statistics</a>
</div>



    <div class="nav-wrapper" style="font-size: 20px !important;">

      <a href="#" data-activates="mobile-demo" class="button-collapse w3-hide-large white-text w3-xxxlarge w3-margin w3-right" style="margin-top: -60px !important; margin-right: 50px !important; ">
        <i class="material-icons mdi-action-view-headline"></i></a>
      
      <ul class="side-nav" id="mobile-demo" style="background-color: #ddeebb;">
        <li><a href="lecturer" class="w3-large w3-btn-s {{ Request::is('lecturer') ? 'activ' : '' }}" >All Lecturers</a></li>
        <li><a href="syllabus" class="w3-large w3-btn-s {{ Request::is('syllabus', 'create-syllabus') ? 'activ' : '' }}" >All syllabus</a></li>
        <li><a href="register" class="w3-large w3-btn-s {{ Request::is('register', 'seeregister', 'levelregister', 'coursesregister') ? 'activ' : '' }}">View Register</a></li>
        <li><a href="statistics" class="w3-large w3-btn-s {{ Request::is('statistics', 'levelstatistics', 'coursestatistics', 'departmentstatisticsview', 'departmentstatistics', 'levelstatisticsview', 'levelstatistic') ? 'activ' : '' }}">Statistics</a></li>
        <li><a href="#" class="w3-large w3-btn-s {{ Request::is('fstatistics', 'allcourseStatistics') ? 'activ' : '' }}">Final Statistics</a></li>
        <a href="{{ route('admin.logout') }}" style="bottom: 50px; position: absolute; text-decoration: none;">
          <strong id="dropdown-logout"><i class="mdi-action-settings-power"></i>&nbsp;logout, <small>{{ Auth::user()->name }}</small></strong>
        </a>
      </ul>
    </div>

<!-- general speaking to the authors -->
            <!-- view in desktop and tablet mode -->
             <a class="w3-hide-small modal-trigger waves-effect waves-light right m-button" href="#modal1" id="floating-btn1"><b class="left w3-margin w3-medium" style="letter-spacing: 2px;">Offline</b><b class="right"><i class="mdi-hardware-keyboard-arrow-up w3-margin w3-medium"></i></b></a>
            <!-- view in android mode -->
            <a href="#modal1" class="modal-trigger waves-effect waves-light w3-btn-floating-large w3-theme-action w3-right w3-hide-large w3-hide-medium w3-rounded" id="floating-btn"><i class="mdi-action-settings-voice"></i></a>


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



 		<div class="w3-center cont">
      @include('file.message')
      <div><br><br></div>
 			@yield('content')
 		</div>
    

 	@include('content.footer')

  @else
  <script> window.location= "/admin";</script>
  @endif

  @else
 	<script> window.location= "/admin";</script>
  @endif

<script type="text/javascript">
  var timerStart = Date.now();

  $(document).ready(function()
  {
     setInterval(function()
     {
        $('#menu').hide(Date.now()-timerStart);
      }, Date.now()-timerStart);
    
  });

$(document).ready(function(){
    $('ul.tabs').tabs('select_tab', 'tab_id');
  });
</script>

     <div id="menu" style="height: 800px !important; width: 100% !important; background-color: #00ccff !important; position: fixed !important; top:0px; bottom: 0px; left: 0px; right: 0px; z-index: 1000; opacity: .7">
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
 {{--  <div id="menu" style="height: 800px !important; width: 100% !important; background-color: #00ccff!important; position: fixed !important; top:0px; bottom: 0px; left: 0px; right: 0px; z-index: 1000;">
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
</body>
</html>
<script>
  
	$(document).ready(function(){

  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
});
/*	$(document).ready(function(){
		$('.timepicker').pickatime({
    default: 'now',
    twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
    donetext: 'OK',
  autoclose: false,
  vibrate: true // vibrate the device when dragging clock hand
});
<i class="mdi-action-stars" style="color:green; margin-left: 20px;"></i>
<center><i class="mdi-action-stars center" style="color: red; margin-top: -50px"></i> </center>
<i class="mdi-action-stars w3-right" style="color: yellow; margin-right: 30px; margin-top: -63px;" ></i>
	}); */
$(".button-collapse").sideNav();
  // Initialize collapsible (uncomment the line below if you use the dropdown variation)
  $('.collapsible').collapsible();


</script>