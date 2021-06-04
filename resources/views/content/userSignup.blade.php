<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Teachers_registration</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="{{URL::asset('js/jquery-3.2.1.js')}}"></script>
        <script src="{{URL::asset('materialize/js/materialize.js')}}"></script>
         <script src="{{URL::asset('materialize/js/materialize.min.js')}}"></script>
        <script src="{{URL::asset('js/jquery.js')}}"></script>

        

        <link rel="icon" href="{{URL::asset('/images/images.jpg')}}" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('style/w3.css')}}">
         <link rel="stylesheet" type="text/css" href="{{URL::asset('style/w3-school.css')}}">
          <link rel="stylesheet" type="text/css" href="{{URL::asset('style/quiz.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('materialize/css/materialize.css')}}">

        <script src="{{URL::asset('js/jquery-3.2.1.js')}}"></script>
<script src="{{URL::asset('materialize/js/materialize.js')}}"></script>

<script src="{{URL::asset('materialize/js/materialize.min.js')}}"></script>
     
        <!-- Fonts -->
        
        <script>
      window.liveSettings = {
        api_key: "a0b49b34b93844c38eaee15690d86413",
        picker: "bottom-right",
        detectlang: true,
        dynamic: true,
        autocollect: true
      };
    </script>
    <script>
        function loadDemo(){
            if (navigator.onLine) {
                log("onLine");
            }
            else{
                log("offline");
            }
        }
        window.addEventListener("online", function(e){
            log("Online");
        }, true);
         window.addEventListener("offline", function(e){
            log("Offline");
        }, true);

          $('#textarea1').val('New Text');
  $('#textarea1').trigger('autoresize');

   $(document).ready(function() {
    $('select').material_select();
  });
   $('select').material_select('destroy');

   var slider = document.getElementById('test5');
  noUiSlider.create(slider, {
   start: [20, 80],
   connect: true,
   step: 1,
   range: {
     'min': 0,
     'max': 100
   },
   format: wNumb({
     decimals: 0
   })
  });
       
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
        $(document).ready(function() {
    $('input#input_text, textarea#textarea1').characterCounter();
  });
    </script>

    </head>


    <body>

        <script>
           
        </script>

        <div  class="col s12 heading">
            <h3 class="center">
                <em id="em-font">C</em>ourse
                <em id="em-font">C</em>overage
                <em id="em-font">S</em>ystem
            </h3>
                 <div class="container">
                    <hr class="divide">
                 </div>
        </div>

       @include('file.message')
        <br>

        <div class="container col s10 signup w3-round">
            <div class="w3-blue signup-heading">
                <h3>Registration for teachers</h3><br>
                <p id="fresh">Please fill in the form to register in the course assessment system if you are a teacher</p>
            </div>


            <form method="POST" action="{{ route('signup') }}" class="col s12">
               {{ csrf_field() }}
              <div class="row">
                <div class="input-field col s6">
                  <input name="fname" id="first_name" type="text" class="validate">
                  <label for="first_name">First Name</label>
                </div>
                <div class="input-field col s6">
                  <input name="lname" id="first_name" type="text" class="validate">
                  <label for="last_name">Last Name</label>
                </div>
              </div>

              <div class="row">
                  <div class="input-field col s6">
                  <input name="phone" id="Phone" type="text" class="validate">
                  <label for="uid">ID or Phone Number</label>
                </div>
                <div class="input-field col s6">
                  <input name="email" id="email" type="email" class="validate">
                  <label for="email">email</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s6">
                      <select name="faculty">
                        <option value="" disabled selected>faculty</option>
                        <option value="Engineering and Technology">Engineering and Technology</option>
                        <option value="Social and Management Science">Social and Management Science</option>
                        <option value="Arts">Arts</option>
                        <option value="Aducation">Education</option>
                        <option value="Science">Science</option>
                      </select>
                       <label>choose yor faculty</label>
                </div>

                <div class="input-field col s6">
                      <select name="department_id">
                        <option value="" disabled selected>department</option>
                        <option value="1">Computer Engineering</option>
                        <option value="2">Electrical and electronic engineering</option>
                        <option value="3">Law</option>
                        <option value="5">History</option>
                        <option value="6">Geography</option>
                        <option value="4">Jornalism and mass com.</option>
                        <option value="7">English</option>
                      </select>
                       <label>choose yor Department</label>
                </div>
              </div>

               <div class="row">
                  <div class="input-field col s6">
                   <i class="mdi-action-visibility-off prefix"></i>
                    <input name="password" id="icon_prefix" type="password" class="validate">
                    <label for="icon_prefix">Password</label>
                  </div>
                  <div class="input-field col s6">
                     <i class="mdi-image-remove-red-eye prefix"></i>
                    <input name="password2" id="icon_telephone" type="password" class="validate">
                    <label for="icon_telephone">Re-enter the password</label>
                  </div>
               </div>
                <div class="row col s12 center">
                  <button class="waves-effect waves-light w3-btn w3-round w3-xlarge center w3-blue">Sign Up</button>
                </div>
            </form>
            
        </div>

        <div><br><br></div>

               @include('content.footer')
               
        <script src="{{ URL::asset('js/scripting.js') }}"></script>
</body>