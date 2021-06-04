<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>GG-course_coverage</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="{{URL::asset('js/jquery-3.2.1.js')}}"></script>
        <script src="{{URL::asset('js/live.js')}}"></script>
        <script src="{{URL::asset('js/jquery.js')}}"></script>
        

        <link rel="icon" href="{{URL::asset('/images/images.jpg')}}" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('style/w3.css')}}">
         <link rel="stylesheet" type="text/css" href="{{URL::asset('style/w3-school.css')}}">
          <link rel="stylesheet" type="text/css" href="{{URL::asset('style/stud.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('style/maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('materialize/css/materialize.css')}}">

        <!-- Fonts -->
    </head>


    <body>
      @if(Auth::guard('student')->check())
      <script>
        window.location="/student.shome";
      </script>
     
      @endif

       @if(Auth::check())
      <script>
        window.location="/home";
      </script>
     
      @endif

        <div  class="col s12 heading">
            <h3 class="center">
                <em id="em-font">G</em>o-Student
                <em id="em-font">C</em>ourse
                <em id="em-font">C</em>overage
                <em id="em-font">P</em>latform
            </h3>
                 <div class="container">
                    <hr class="divide">
                    <hr class="divide">
                 </div>
        </div>

        <!--student login-->

         @include('file.message')

             
            
             <!-- teachers login -->
             <div class="login-form row col s12 m8 l8 w3-hide-small" style="width: 35%">
                    <div class="blue white-text stud"><br>
                      <h4 class="center login-header"><b class="w3-margin" style="color: #ccd">Enter your Matriculation number and password to login</b></h4>
                    </div>
                <div class="row">
                    <form method="post" action="{{ route('student.login') }}" class="col s12">
                      {{ csrf_field() }}
                      <div class="container">
                        <div class="input-field col s12 l12 m12">
                          <input  id="matricule" name="matricule" type="text" class="validate">
                          <label for="matricule" id="labels">Matriculation N<sup>o</sup></label>
                        </div>
                      </div>

                       <div class="container">
                         <div class="input-field col s12 l12 m12">
                          <input name="password" id="password1" type="password" class="validate" value="Bimeri@89">
                          <label for="password" id="labels">Password</label><i id="showw" class="mdi-action-visibility right"></i>
                        </div>
                       </div>
                            <div class="center">
                              <button class="waves-effect waves-light btn w3-border w3-round-large w3-blue" id="login-btn">{{ __('Login') }}</button></div>

                       <!-- remember me and forgot password -->
                        <p>
                          <input type="checkbox" name="rememberme" class="filled-in" id="filled-in-box" />
                          <label for="filled-in-box">remember me</label>
                        </p> 

                        <div class="foot">
                          <a href="#" id="forgot-password"><i class="mdi-action-lock right w3-margin w3-large">Forgot Password</i></a>
                        </div>
                    </form>
                </div>
            </div>





              {{-- showing in android view --}}


             <div class="login-form row col s12 m8 l8 w3-hide-large w3-hide-medium">
                    <div class="blue white-text stud"><br>
                      <h4 class="center login-header"><b class="w3-margin">Login as Student</b></h4>
                    </div>
                <div class="row">
                    <form method="post" action="{{ route('student.login') }}" class="col s12">
                      {{ csrf_field() }}
                      <div class="container">
                        <div class="input-field col s12 l12 m12">
                          <input  id="t-email" name="matricule" type="text" class="validate">
                          <label for="t-email" id="labels">Matriculation N<sup>o</sup></label>
                        </div>
                      </div>

                       <div class="container">
                         <div class="input-field col s12 l12 m12">
                          <input name="password" id="password1" type="password" class="validate">
                          <label for="password" id="labels">Password</label><i id="showw" class="mdi-action-visibility right"></i>
                        </div>
                       </div>
                            <div class="center">
                              <button class="waves-effect waves-light btn w3-border w3-round-large w3-blue" id="login-btn">{{ __('Login') }}</button></div>

                       <!-- remember me and forgot password -->
                        <p>
                          <input type="checkbox" name="rememberme" class="filled-in" id="filled-in-box" />
                          <label for="filled-in-box">remember me</label>
                        </p> 

                        <div class="foot">
                          <a href="#" id="forgot-password"><i class="mdi-action-lock right w3-margin">Forgot Password</i></a>
                        </div>
                    </form>
                </div>
            </div>
                


                <div class="footer_one" style="margin-top: 150px;">
                    <center>
                        <p id="dateField" style="color: white;">&nbsp;
                        </p>
                        <p style="text-align: center; color: #fff">

                            &copy;Powered by
                             <a  target="_blank" href ="http://www.go-groups.net" style="color:#00ccff"> Go-Groups. Ltd</a>
                        </p>
                    </center>
              </div>




         
        <script src="{{ URL::asset('js/scripting.js') }}"></script>
        <script src="{{URL::asset('materialize/js/materialize.js')}}"></script>

    </body>
</html>

