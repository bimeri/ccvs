
        @if(Session::has('error'))
        <div class="red-text w3-card-8 w3-round w3-animate-right materialize-red lighten-4" id="alert" style="display: block; position: fixed;z-index: 30; right:25px;top:260px;">
            <span onclick="this.parentElement.style.display='none'" class="close">x</span>
            <strong id="error"><i class="mdi-action-thumb-down" style="font-size: 25px;"></i> {{ Session::get('error') }} {{ Session::forget('error') }} </strong>
        </div>

        @endif


         @if(Session::has('message'))
        <div class="row w3-container orange-text yellow accent-1 w3-card-4 w3-animate-left w3-left w3-round w3-margin-left w3-margin-top" id="alert" style="display: block; position: fixed;z-index: 30">
            <span onclick="this.parentElement.style.display='none'" class="close">x</span>
            <strong id="error"><i class="mdi-action-visibility-off" style="font-size: 25px;"></i> {{ Session::get('message') }} {{ Session::forget('message') }} </strong>
        </div>

        @endif

        

         @if(Session::has('messagesuccess'))
        <div class="row w3-container orange-text yellow accent-1 w3-card-4 w3-animate-left w3-round w3-margin w3-margin-top" id="alert" style="display: block; position: fixed;z-index: 30;left: 10px; top: 70px; width:25%;">
            <span onclick="this.parentElement.style.display='none'" class="close">x</span>
            <strong id="error"><i class="mdi-action-thumb-up" style="font-size: 25px;"></i> {{ Session::get('messagesuccess') }} {{ Session::forget('messagesuccess') }} </strong>
        </div>

        @endif

        @if(Session::has('messagegreen'))
        <div class="row w3-container green-text light-green lighten-3 w3-card-4 w3-animate-left w3-round w3-margin w3-margin-top" id="alert" style="display: block; position: fixed;z-index: 30; left: 10px; top: 70px; width:25%;">
            <span onclick="this.parentElement.style.display='none'" class="close">x</span>
            <strong id="error"><i class="mdi-action-thumb-up" style="font-size: 25px; color: green"></i> {{ Session::get('messagegreen') }} {{ Session::forget('messagegreen') }} </strong>
        </div>

        @endif


       @if(Session::has('success'))
             <div class="row col s8 w3-container w3-green w3-card-8  w3-animate-zoom w3-right" id="alert" style="display: block; width: 30%; min-height: 100px; position: relative;bottom: 0px; margin-right: 20px; z-index: 30">
             <span onclick="this.parentElement.style.display='none'" class="close">x</span>
            <strong id="error"><i class="mdi-action-thumb-up" style="font-size: 30px;"></i>  Good Job !!<br>  {{ Session::get('success') }} {{ Session::forget('success') }} </strong>
        </div>
         @endif 

         @if(isset(Auth::user()->id))

          @if(Session::has('alarm'))
            <div class="row col s8 w3-container w3-blue w3-card-8 white-text w3-animate-left alarm" id="alert">
                <strong id="error"> <b class="w3-margin">hi, {{ Auth::user()->name }} {{ Auth::user()->fname }},  {{ Session::get('alarm') }} {{ Session::forget('alarm') }} </b> </strong>
            </div>


         @elseif(Session::has('alarmred'))
             <div class="row col s8 w3-container w3-red w3-card-8 white-text w3-animate-left alarm" id="alert">
            <strong id="error"> <b class="w3-margin">hi, {{ Auth::user()->name }} {{ Auth::user()->fname }},  {{ Session::get('alarmred') }} {{ Session::forget('alarmred') }} </b> </strong>
        </div>

        @else
        
        @endif
         @endif  



        @if(count($errors) > 0)
        <center> 
            <div class="row col s10 w3-container red-text w3-card-8 w3-round w3-margin-top errors materialize-red lighten-4" style="display: block; width: 30%; min-height: 100px; position: relative;bottom: 0px; margin-right: 20px; z-index: 30">
                 <span onclick="this.parentElement.style.display='none'" class="close">x</span>
                <ol id="error" class="w3-margin w3-padding">
                    @foreach($errors->all() as $error)
                        <li style="text-align: center;">{{ $error }} </li>
                    @endforeach  <center><i class="mdi-action-thumb-down" style="font-size: 25px;"></i></center>
                </ol>
            </div>
        </center>
        @endif