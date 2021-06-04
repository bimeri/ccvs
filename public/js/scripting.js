
// show and hide password
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });

 $(document).ready(function(){
    $('#show, #showw').on('click', function(){
      var passwordField = $('#password, #password1');
      var passwordFieldType = passwordField.attr('type');

      if (passwordFieldType == 'password') {
        passwordField.attr('type', 'text');
        $(this).text('');
      }
      else{
        passwordField.attr('type', 'password');
        $(this).text('');
      }
    });
  });

  

 // include page . logo controller, profile, logout, useraccount
$("#myDropdown").hide();
  $(document).ready(function(){

  $("#dropbtn, #dropbtn1").click(function(){
        $("#myDropdown").fadeIn(1000);
        
        });  

           window.onclick=function(e){
         if (!e.target.matches('#myDropdown')) {
            if (!e.target.matches('.dropbtn, .dropbtn1')) {
              

   $("#myDropdown").fadeOut();
  
}
}
}
    });

// for the animate
$(document).ready(function(){

    setInterval(function(){
                  $('#alert').fadeOut(6000);
                    }, 6000);

  });


        // for the tabs
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

  // function for the running  date

setInterval(displayclock, 100);
                            function displayclock() {

                              var months =['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                              var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                               var time = new Date();
                               var day = days[time.getDay().toString()];
                               var month = months[time.getMonth().toString()];
                               var dates = time.getDate().toString();
                               var year = time.getFullYear().toString();
                               var hrs = time.getHours();
                               var min = time.getMinutes();
                               var sec = time.getSeconds();
                               var en = 'AM';

                               if (hrs > 12) {
                                en = 'PM';
                               }

                               if (hrs > 12) {
                                hrs = hrs -12;
                               }
                               if (hrs == 0) {
                                hrs = 12;
                               }

                               if (hrs < 10) {
                                hrs = '0' + hrs;
                               }
                               if (min < 10) {
                                min = '0' + min;
                               }
                               if (sec < 10) {
                                sec = '0' + sec;
                               }

                                var mat = document.getElementById("dateField");
  if (typeof mat !== 'undefined' && mat !== null) {
                               document.getElementById("dateField").innerHTML = day + ' ' + dates + ' ' + month + ' ' + year + ' <br> ' + hrs + ':' + min + ':' +sec + ' ' + en;
                             }
                            }

   $(document).ready(function() {
    $('select').material_select();
  });
//$('select').material_select('destroy');
 

  $(document).ready(function() {
    $('input#input_text, textarea#textarea1').characterCounter();
  });

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


   
     $(document).ready(function(){
       $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
     });  
 
        $(document).ready(function() {
    $('input#input_text, textarea#textarea1').characterCounter();
  });
        
/*
 * Detact Mobile Browser
 */
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
   $('html').addClass('ismobile');
}

$(window).load(function () {
    /* --------------------------------------------------------
        Page Loader
        commented the mobile detachment to allow mobile devices to have the loading screen
     ---------------------------------------------------------*/
    // if(!$('html').hasClass('ismobile')) {  
        if($('.page-loader')[0]) {
            setTimeout (function () {
                $('.page-loader').fadeOut();
            }, 500);

        }
    // }
});


$(".button-collapse").sideNav();
  // Initialize collapsible (uncomment the line below if you use the dropdown variation)
  $('.collapsible').collapsible();

$(document).ready(function(){

  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
});
  $(document).ready(function(){
    $('.timepicker').pickatime({
    default: 'now',
    twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
    donetext: 'OK',
  autoclose: false,
  vibrate: true // vibrate the device when dragging clock hand
});

  });