<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>course-coverage</title>
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
          <link rel="stylesheet" type="text/css" href="{{URL::asset('style/quiz.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('style/maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('materialize/css/materialize.css')}}">

        <!-- Fonts 
                <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        -->
<style>
  .tab {
    overflow: hidden;
    background-image: url('/images/4.jpg'); 
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover; */
    margin-top: -50px;
    

   /* box-shadow: 0px 0px 8px 8px rgba(0,0,0,0.2);*/

}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #0cdeaa;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
     margin-bottom: 70px;
    padding: 6px 12px;
    margin-top: 40px;
    border-top: none;
    height: auto;
    background-color: #e6e6e6;
    box-shadow: 0px 0px 8px 8px rgba(0,0,0,0.2);
}

</style>
    </head>


    <body>

      @if(Auth::guard('admin')->check())
      <script>
        window.location="admin.home";
      </script>
     
      @endif

      @if(Auth::guard('student')->check())
      <script>
        window.location="/shome";
      </script>
     
      @endif

       @if(Auth::check())
      <script>
        window.location="/home";
      </script>
     
      @endif
  
        <img src="{{URL::asset('/images/index.png')}}" class="w3-rounded w3-left circle w3-margin" height="75" width="75" style="position: sticky;">
      
     

        <div  class="col s12 heading" style="margin-top: -50px;">
            <h3 class="center">
                <em id="em-font">P</em>latform
                <em id="em-font">F</em>or
                <em id="em-font">U</em>niversity
                <em id="em-font">C</em>ourse
                <em id="em-font">C</em>overage
                <em id="em-font">S</em>ystem
            </h3>
                 <div class="container">
                    <hr class="divide">
                    <hr class="divide">
                 </div>
        </div>


        
  @include('file.message')


       

         <div class="tab center container w3-border w3-margin-top">

          <div id="Teacher" class="tabcontent container w3-border col s12 l12 m12" style="display: block;">
  <div class="row">

        <!--teachers login-->
        
          <div class="login-form col offset-l1 s12 m12 l10 w3-margin-top">

                <h4 class="center login-header">Enter your Credentials to Login {{-- as Teacher --}}</h4>

                <div class="row">
                    <form method="POST" action="{{ route('checklogin') }}" class="col s12">
                       {{ csrf_field() }}
                      <div class="row">
                        <div class="input-field col s6">
                          <input  id="phone" name="phone" type="text" class="validate" required>
                          <label for="phone" id="label1">email or telephone N<sup>o</sup></label>
                        </div>
                        <div class="input-field col s6">
                          <input name="password" id="password" type="password" class="validate" value="Bimeri@89">
                          <label for="password" id="label1">Password</label><i id="show" class="mdi-action-visibility right"></i>
                        </div>
                       </div><div class="center"><input type="submit" value="Login" class="waves-effect waves-light btn w3-border w3-round-large w3-blue"></div>

                       <!-- remember me and forgot password -->
                        <p>
                          <input type="checkbox" name="rememberme" class="filled-in" id="filled-in-box"/>
                          <label for="filled-in-box">remember me</label>
                        </p>
                       <a href="#" class="right" id="forgot-password"><i class="mdi-action-lock">Forgot Password
                       </i></a><br>
                       <p><a href="userSignup" id="click-here">click here</a> if you don't have an account</p>
                    </form>
                </div>
        </div>
</div>
</div>


        </div>

        

          
                <div><br><br></div>

                <div class="footer_one">
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

