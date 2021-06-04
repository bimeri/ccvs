@extends('content.include')


@section('title', 'check_register')
@section('imag')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">

<script>
  //croll to top
$(document).ready(function(){

    //Check to see if the window is top if not then display button
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });

});

</script>
@endsection

@section('content')
@foreach($current_years = App\Year::where('active', 1)->get() as $current_year)
@if(isset(Auth::user()->id))
@include('file.message')

@foreach($courses as $course)
 @foreach($totalsubsection = App\Outline::where('course_id', '=', $course->id)->get() as $total)
  @if($course->user->id != Auth::user()->id)
    <script>
      window.location = 'check_register';
    </script>
    {{ Session(['error' => 'Can\'t access this record, the course is not assign for you']) }}
  @else
<div><br><br></div>
<div class="w3-card w3-margin-top w3-border w3-white">
	
<p class="center w3-medium w3-margin black-text" style="text-transform: uppercase;">register for {{ $course->code }}<br> {{ $course->title }}<br>{{ $course->semester->name }}</p>

{{-- lesson one existence--}}
    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L1', '!=', null)->count() > 0)

     <div class="w3-margin-right w3-padding-xlarge">


      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $taughtlesson)


                <div class="center-align w3-padding center w3-margin-bottom card-panel hoverable m-r-s" id="#">
                  <p class="heading w3-xlarge"><b>Lesson one</b> Statistics</p>
                    <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                        <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                        <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4>
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                          {{ $key+1 }} 

                                           @if($register->L1 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                       <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L1', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                          
                                          @foreach($taughtsection = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $taught)

                                            <?php $done = ($taught->number_subsection/$total->number_subsection) * 100  ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <?php $checker = number_format((float)$done, 2, '.', '') ?>
                                          
                                          @endforeach
                                          @else               
                                          <div class="w3-border red-text w3-large">lesson One suspended</div>
                                          @endif
                                        </div>
                                      
                                  </div>
                                  
                            </div>
                </div>

                            
                            <hr class="divide">

          

                  
                @endforeach

    </div>

    

</div>
    @else

    @endif





    {{-- lesson two existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L2', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-border">

      <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $taughtlesson)

                  <div class="center-align w3-padding center w3-border w3-margin-bottom w3-margin card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Two</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L2 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L2', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $taughtone)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $taughttwo)

                                            <?php $done = ($taughttwo->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($taughtone->number_subsection + $taughttwo->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                              <?php $checker = number_format((float)$totals, 2, '.', '') ?>

                                            
                                              @endforeach
                                             @endforeach
                                            @else               
                                          <div class="w3-border red-text w3-large">Lesson Two suspended</div>
                                          @endif
                                        </div>
                                       
                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

                  
                @endforeach

    </div>

    

</div>

    @else

    @endif





    {{-- lesson three existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L3', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Three</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L3 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                          <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">  
                                          
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L3', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)

                                            <?php $done = ($three->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i> <br><br>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                              <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                           
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Three suspended</div>
                                          @endif
                                        
                                        </div>
                                       
                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif








{{-- lesson four existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L4', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Four</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L4 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                     <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L4', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)

                                            <?php $done = ($four->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                              <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                           
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Four suspended</div>
                                          @endif
                                        </div>
                                  </div>@include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif










    {{-- lesson five existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L5', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Five</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L5 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L5', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)

                                            <?php $done = ($five->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                              <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                           
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Five suspended</div>
                                          @endif
                                        </div>

                                  </div>@include('file.conditions')
                           </div>

                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif








    {{-- lesson six existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L6', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Six</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L6 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                     <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L6', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)

                                            <?php $done = ($six->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Six suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif











    {{-- lesson seven existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L7', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Seven</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L7 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L7', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                               @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                               @foreach($taughtsectionfiveseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)

                                            <?php $done = ($seven->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Seven suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif











    {{-- lesson eight existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L8', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Eight</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L8 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L8', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)

                                            <?php $done = ($eight->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Eight suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif











    {{-- lesson nine existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L9', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Nine</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L9 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                     <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L9', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                               @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                               @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)

                                            <?php $done = ($nine->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Nine suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>
</div>

    @else
    @endif











    {{-- lesson ten existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L10', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Ten</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L10 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L10', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)

                                            <?php $done = ($ten->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Ten suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif












    {{-- lesson eleven existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L11', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Eleven</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L11 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                     <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L11', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)

                                            <?php $done = ($eleven->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection + $eleven->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Eleven suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif







    {{-- lesson twelve existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L12', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Twelve</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L12 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                     <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L12', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)

                                            <?php $done = ($twelve->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection + $eleven->number_subsection + $twelve->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Twelve suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif












     {{-- lesson thirteen existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L13', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Thirteen</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L13 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L13', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)

                                            <?php $done = ($thirteen->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Thirteen suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif





{{-- lesson foureen existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L14', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Fourteen</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L14 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                     <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L14', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)

                                            <?php $done = ($fourteen->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Fourteen suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif








    {{-- lesson fiveteen existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L15', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Fiveteen</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L15 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L15', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)

                                            <?php $done = ($fiveteen->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Fiveteen suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif







    {{-- lesson sixteen existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L16', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Sixteen</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L16 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                     <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L16', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)

                                            <?php $done = ($sixteen->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Sixteen suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif







     {{-- lesson seventeen existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L17', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Seventeen</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L17 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L17', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)
                                                 @foreach($taughtsectionseventeen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $seventeen)

                                            <?php $done = ($seventeen->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection + $seventeen->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Seventeen suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif







    {{-- lesson eightteen existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L18', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 18)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Eightteen</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L18 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L18', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)
                                                 @foreach($taughtsectionseventeen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $seventeen)
                                                 @foreach($taughtsectioneighteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 18)->get() as $eighteen)

                                            <?php $done = ($eighteen->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection + $seventeen->number_subsection + $eighteen->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Eighteen suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif







    {{-- lesson nineteen existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L19', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 19)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Nineteen</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L19 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                         
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L19', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)
                                                 @foreach($taughtsectionseventeen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $seventeen)
                                                 @foreach($taughtsectioneighteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 18)->get() as $eighteen)
                                                 @foreach($taughtsectionnineteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 19)->get() as $nineteen)

                                            <?php $done = ($nineteen->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection + $seventeen->number_subsection + $eighteen->number_subsection + $nineteen->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Nineteen suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif








    {{-- lesson twenty existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L20', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 20)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Twenty</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L20 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L20', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)
                                                 @foreach($taughtsectionseventeen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $seventeen)
                                                 @foreach($taughtsectioneighteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 18)->get() as $eighteen)
                                                 @foreach($taughtsectionnineteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 19)->get() as $nineteen)
                                                 @foreach($taughtsectiontwenty = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 20)->get() as $twenty)

                                            <?php $done = ($twenty->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection  + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection + $seventeen->number_subsection + $eighteen->number_subsection + $nineteen->number_subsection + $twenty->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Twenty suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif









    {{-- lesson twentyone existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L21', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 21)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Twenty-One</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L21 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                     <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L21', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)
                                                 @foreach($taughtsectionseventeen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $seventeen)
                                                 @foreach($taughtsectioneighteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 18)->get() as $eighteen)
                                                 @foreach($taughtsectionnineteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 19)->get() as $nineteen)
                                                 @foreach($taughtsectiontwenty = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 20)->get() as $twenty)@foreach($taughtsectiontwentyone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 21)->get() as $twentyone)

                                            <?php $done = ($twentyone->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection  + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection + $seventeen->number_subsection + $eighteen->number_subsection + $nineteen->number_subsection + $twenty->number_subsection + $twentyone->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Twenty-One suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif








    {{-- lesson twentytwo existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L22', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 22)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Twenty-Two</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L22 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                     <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L22', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)
                                                 @foreach($taughtsectionseventeen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $seventeen)
                                                 @foreach($taughtsectioneighteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 18)->get() as $eighteen)
                                                 @foreach($taughtsectionnineteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 19)->get() as $nineteen)
                                                 @foreach($taughtsectiontwenty = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 20)->get() as $twenty)@foreach($taughtsectiontwentyone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 21)->get() as $twentyone)
                                                 @foreach($taughtsectiontwentytwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 22)->get() as $twentytwo)

                                            <?php $done = ($twentytwo->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection  + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection + $seventeen->number_subsection + $eighteen->number_subsection + $nineteen->number_subsection + $twenty->number_subsection + $twentyone->number_subsection +$twentytwo->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Twenty-Two suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif








    {{-- lesson twentythree existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L23', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 23)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Twenty-Three</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L23 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                     <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L23', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)
                                                 @foreach($taughtsectionseventeen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $seventeen)
                                                 @foreach($taughtsectioneighteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 18)->get() as $eighteen)
                                                 @foreach($taughtsectionnineteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 19)->get() as $nineteen)
                                                 @foreach($taughtsectiontwenty = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 20)->get() as $twenty)@foreach($taughtsectiontwentyone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 21)->get() as $twentyone)
                                                 @foreach($taughtsectiontwentytwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 22)->get() as $twentytwo)
                                                 @foreach($taughtsectiontwentythree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 23)->get() as $twentythree)

                                            <?php $done = ($twentythree->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection  + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection + $seventeen->number_subsection + $eighteen->number_subsection + $nineteen->number_subsection + $twenty->number_subsection + $twentyone->number_subsection +$twentytwo->number_subsection + $twentythree)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Twenty-Three suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif










    {{-- lesson twentyfour existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L24', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 24)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Twenty-Four</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L24 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                     <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L24', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)
                                                 @foreach($taughtsectionseventeen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $seventeen)
                                                 @foreach($taughtsectioneighteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 18)->get() as $eighteen)
                                                 @foreach($taughtsectionnineteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 19)->get() as $nineteen)
                                                 @foreach($taughtsectiontwenty = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 20)->get() as $twenty)@foreach($taughtsectiontwentyone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 21)->get() as $twentyone)
                                                 @foreach($taughtsectiontwentytwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 22)->get() as $twentytwo)
                                                 @foreach($taughtsectiontwentythree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 23)->get() as $twentythree)
                                                 @foreach($taughtsectiontwentyfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 24)->get() as $twentyfour)

                                            <?php $done = ($twentyfour->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection  + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection + $seventeen->number_subsection + $eighteen->number_subsection + $nineteen->number_subsection + $twenty->number_subsection + $twentyone->number_subsection +$twentytwo->number_subsection + $twentythree + $twentyfour->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Twenty-Four suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif







    {{-- lesson twentyfive existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L25', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 25)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Twenty-Five</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L25 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L25', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)
                                                 @foreach($taughtsectionseventeen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $seventeen)
                                                 @foreach($taughtsectioneighteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 18)->get() as $eighteen)
                                                 @foreach($taughtsectionnineteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 19)->get() as $nineteen)
                                                 @foreach($taughtsectiontwenty = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 20)->get() as $twenty)@foreach($taughtsectiontwentyone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 21)->get() as $twentyone)
                                                 @foreach($taughtsectiontwentytwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 22)->get() as $twentytwo)
                                                 @foreach($taughtsectiontwentythree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 23)->get() as $twentythree)
                                                 @foreach($taughtsectiontwentyfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 24)->get() as $twentyfour)
                                                 @foreach($taughtsectiontwentyfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 25)->get() as $twentyfive)

                                            <?php $done = ($twentyfive->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection  + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection + $seventeen->number_subsection + $eighteen->number_subsection + $nineteen->number_subsection + $twenty->number_subsection + $twentyone->number_subsection +$twentytwo->number_subsection + $twentythree + $twentyfour->number_subsection + $twentyfive->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Twenty-Five suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif













    {{-- lesson twentysix existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L26', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 26)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Twenty-Six</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L26 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                     <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L26', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)
                                                 @foreach($taughtsectionseventeen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $seventeen)
                                                 @foreach($taughtsectioneighteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 18)->get() as $eighteen)
                                                 @foreach($taughtsectionnineteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 19)->get() as $nineteen)
                                                 @foreach($taughtsectiontwenty = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 20)->get() as $twenty)@foreach($taughtsectiontwentyone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 21)->get() as $twentyone)
                                                 @foreach($taughtsectiontwentytwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 22)->get() as $twentytwo)
                                                 @foreach($taughtsectiontwentythree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 23)->get() as $twentythree)
                                                 @foreach($taughtsectiontwentyfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 24)->get() as $twentyfour)
                                                 @foreach($taughtsectiontwentyfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 25)->get() as $twentyfive)
                                                 @foreach($taughtsectiontwentysix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 26)->get() as $twentysix)

                                            <?php $done = ($twentysix->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection  + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection + $seventeen->number_subsection + $eighteen->number_subsection + $nineteen->number_subsection + $twenty->number_subsection + $twentyone->number_subsection +$twentytwo->number_subsection + $twentythree + $twentyfour->number_subsection + $twentyfive->number_subsection + $twentysix->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Twenty-Six suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif









    {{-- lesson twentyseven existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L27', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 27)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Twenty-Seven</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L27 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L27', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)
                                                 @foreach($taughtsectionseventeen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $seventeen)
                                                 @foreach($taughtsectioneighteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 18)->get() as $eighteen)
                                                 @foreach($taughtsectionnineteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 19)->get() as $nineteen)
                                                 @foreach($taughtsectiontwenty = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 20)->get() as $twenty)@foreach($taughtsectiontwentyone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 21)->get() as $twentyone)
                                                 @foreach($taughtsectiontwentytwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 22)->get() as $twentytwo)
                                                 @foreach($taughtsectiontwentythree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 23)->get() as $twentythree)
                                                 @foreach($taughtsectiontwentyfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 24)->get() as $twentyfour)
                                                 @foreach($taughtsectiontwentyfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 25)->get() as $twentyfive)
                                                 @foreach($taughtsectiontwentysix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 26)->get() as $twentysix)
                                                 @foreach($taughtsectiontwentyseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 27)->get() as $twentyseven)

                                            <?php $done = ($twentyseven->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection  + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection + $seventeen->number_subsection + $eighteen->number_subsection + $nineteen->number_subsection + $twenty->number_subsection + $twentyone->number_subsection +$twentytwo->number_subsection + $twentythree + $twentyfour->number_subsection + $twentyfive->number_subsection + $twentysix->number_subsection + $twentyseven->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Twenty-Seven suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif










    {{-- lesson twentyeight existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L28', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 28)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Twenty-Eight</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L28 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L28', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)
                                                 @foreach($taughtsectionseventeen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $seventeen)
                                                 @foreach($taughtsectioneighteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 18)->get() as $eighteen)
                                                 @foreach($taughtsectionnineteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 19)->get() as $nineteen)
                                                 @foreach($taughtsectiontwenty = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 20)->get() as $twenty)@foreach($taughtsectiontwentyone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 21)->get() as $twentyone)
                                                 @foreach($taughtsectiontwentytwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 22)->get() as $twentytwo)
                                                 @foreach($taughtsectiontwentythree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 23)->get() as $twentythree)
                                                 @foreach($taughtsectiontwentyfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 24)->get() as $twentyfour)
                                                 @foreach($taughtsectiontwentyfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 25)->get() as $twentyfive)
                                                 @foreach($taughtsectiontwentysix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 26)->get() as $twentysix)
                                                 @foreach($taughtsectiontwentyseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 27)->get() as $twentyseven)
                                                 @foreach($taughtsectiontwentyeight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 28)->get() as $twentyeight)

                                            <?php $done = ($twentyeight->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection  + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection + $seventeen->number_subsection + $eighteen->number_subsection + $nineteen->number_subsection + $twenty->number_subsection + $twentyone->number_subsection +$twentytwo->number_subsection + $twentythree + $twentyfour->number_subsection + $twentyfive->number_subsection + $twentysix->number_subsection + $twentyseven->number_subsection + $twentyeight->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Twenty-Eight suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif







    {{-- lesson twentynine existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L29', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 29)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Twenty-Nine</b> Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L29 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                      <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L29', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)@foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)@foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)
                                                 @foreach($taughtsectionseventeen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $seventeen)
                                                 @foreach($taughtsectioneighteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 18)->get() as $eighteen)
                                                 @foreach($taughtsectionnineteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 19)->get() as $nineteen)
                                                 @foreach($taughtsectiontwenty = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 20)->get() as $twenty)@foreach($taughtsectiontwentyone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 21)->get() as $twentyone)
                                                 @foreach($taughtsectiontwentytwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 22)->get() as $twentytwo)
                                                 @foreach($taughtsectiontwentythree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 23)->get() as $twentythree)
                                                 @foreach($taughtsectiontwentyfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 24)->get() as $twentyfour)
                                                 @foreach($taughtsectiontwentyfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 25)->get() as $twentyfive)
                                                 @foreach($taughtsectiontwentysix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 26)->get() as $twentysix)
                                                 @foreach($taughtsectiontwentyseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 27)->get() as $twentyseven)
                                                 @foreach($taughtsectiontwentyeight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 28)->get() as $twentyeight)
                                                 @foreach($taughtsectiontwentynine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 29)->get() as $twentynine)

                                            <?php $done = ($twentynine->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection  + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection + $seventeen->number_subsection + $eighteen->number_subsection + $nineteen->number_subsection + $twenty->number_subsection + $twentyone->number_subsection +$twentytwo->number_subsection + $twentythree + $twentyfour->number_subsection + $twentyfive->number_subsection + $twentysix->number_subsection + $twentyseven->number_subsection + $twentyeight->number_subsection + $twentynine->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Twenty-Nine suspended</div>
                                          @endif
                                        </div>

                                  </div> @include('file.conditions')
                           </div>

                            
                            <hr class="divide">

                  </div>

      @endforeach

    </div>

    

</div>

    @else
    @endif










 {{-- lesson thirty existence--}}

    @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L30', '!=', null)->count() > 0)

     <div class="w3-card w3-margin-top w3-margin-bottom">

          <h5></h5>
    

    <div class="w3-container white">

      @foreach($taughtlessons = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 30)->get() as $taughtlesson)


                  <div class="center-align w3-padding center w3-border  w3-margin-bottom card-panel hoverable m-r-s" id="#">
                      <p class="heading w3-xlarge"><b>Lesson Thirty</b> Final Statistics</p>
                      <hr><br>
                      
                            <div class="row">
                                  <div class="col s12 l4 m12">
                                      <p class="w3-large">The following was taught<p><br>
                                        <div class="w3-border w3-center w3-large" id="label">
                                          <div class="w3-margin"> {!! $taughtlesson->what_taught !!}</div>
                                        </div>
                                  </div>

                                    <div class="row">
                                             <p class="w3-large"></p><br><br>
                                      <div class=" col s6 m6 l6  w3-margin w3-margin-top w3-border">
                                       <p class="w3-large">Date: <b class="w3-medium w3-margin" id="label">{{ date('l, j-M Y', strtotime($taughtlesson->date))}}</b></p>

                                       <p class="w3-large">Venue: <b class="w3-medium w3-margin" id="label">{{ $taughtlesson->venue }}</b></p>

                                      </div>
                                       
                                      <div class="col s6 m6 l6 w3-margin w3-border">
                                        <p class="w3-large">Lesson start time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->start_time))}}</b></p>
                                    
                                        <p class="w3-large">Lesson stop time: <b class="w3-margin w3-medium" id="label">{{ date('h:i a', strtotime($taughtlesson->stop_time))}}</b></p>
                                      </div>

                                      <div class="col s12 m6 l7 w3-margin"> 
                                        <h4>Student Status</h4> 
                                          <hr class="divide w3-margin-right">
                                          @foreach($registers = App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->get() as $key => $register)

                                           {{ $key+1 }}

                                           @if($register->L30 != null) 
                                          <i class="mdi-action-done blue-text w3-xxlarge"></i>

                                            @else
                                             <i class="mdi-communication-live-help red-text w3-xlarge"></i> @endif &nbsp;&nbsp;
                                         
                                          @endforeach
                                     <hr class="divide w3-margin-right">
                                      </div>

                                       <div class="col s12 m6 l7 w3-margin w3-border right">
                                          @if(App\Register::where('course_id', '=', $course->id)->where('year', $current_year->year)->where('L30', '=', 'A')->count() > 2)
                                          <i class="w3-margin w3-left w3-border w3-padding w3-xlarge green-text">lesson Taught</i>
                                           @foreach($taughtsectionone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 1)->get() as $one)
                                            @foreach($taughtsectiontwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 2)->get() as $two)
                                             @foreach($taughtsectionthree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 3)->get() as $three)
                                              @foreach($taughtsectionfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 4)->get() as $four)
                                              @foreach($taughtsectionfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 5)->get() as $five)
                                               @foreach($taughtsectionsix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 6)->get() as $six)
                                                @foreach($taughtsectionseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 7)->get() as $seven)
                                                @foreach($taughtsectioneight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 8)->get() as $eight)
                                                @foreach($taughtsectionnine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 9)->get() as $nine)
                                                @foreach($taughtsectionten = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 10)->get() as $ten)
                                                 @foreach($taughtsectioneleven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 11)->get() as $eleven)
                                                 @foreach($taughtsectiontwelve = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 12)->get() as $twelve)
                                                 @foreach($taughtsectionthirteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 13)->get() as $thirteen)
                                                 @foreach($taughtsectionfourteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 14)->get() as $fourteen)
                                                 @foreach($taughtsectionfiveteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 15)->get() as $fiveteen)
                                                 @foreach($taughtsectionsixteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 16)->get() as $sixteen)
                                                 @foreach($taughtsectionseventeen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 17)->get() as $seventeen)
                                                 @foreach($taughtsectioneighteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 18)->get() as $eighteen)
                                                 @foreach($taughtsectionnineteen = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 19)->get() as $nineteen)
                                                 @foreach($taughtsectiontwenty = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 20)->get() as $twenty)
                                                 @foreach($taughtsectiontwentyone = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 21)->get() as $twentyone)
                                                 @foreach($taughtsectiontwentytwo = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 22)->get() as $twentytwo)
                                                 @foreach($taughtsectiontwentythree = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 23)->get() as $twentythree)
                                                 @foreach($taughtsectiontwentyfour = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 24)->get() as $twentyfour)
                                                 @foreach($taughtsectiontwentyfive = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 25)->get() as $twentyfive)
                                                 @foreach($taughtsectiontwentysix = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 26)->get() as $twentysix)
                                                 @foreach($taughtsectiontwentyseven = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 27)->get() as $twentyseven)
                                                 @foreach($taughtsectiontwentyeight = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 28)->get() as $twentyeight)
                                                 @foreach($taughtsectiontwentynine = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 29)->get() as $twentynine)
                                                 @foreach($taughtsectiontwenthirty = App\Taughtlesson::where('course_id', '=', $course->id)->where('year_id', $current_year->id)->where('lesson_number', '=', 30)->get() as $thirty)

                                            <?php $done = ($thirty->number_subsection/$total->number_subsection) * 100;
                                              $totals = (($one->number_subsection + $two->number_subsection + $three->number_subsection + $four->number_subsection + $five->number_subsection + $six->number_subsection + $seven->number_subsection + $eight->number_subsection + $nine->number_subsection + $ten->number_subsection  + $eleven->number_subsection + $twelve->number_subsection + $thirteen->number_subsection + $fourteen->number_subsection + $fiveteen->number_subsection + $sixteen->number_subsection + $seventeen->number_subsection + $eighteen->number_subsection + $nineteen->number_subsection + $twenty->number_subsection + $twentyone->number_subsection +$twentytwo->number_subsection + $twentythree + $twentyfour->number_subsection + $twentyfive->number_subsection + $twentysix->number_subsection + $twentyseven->number_subsection + $twentyeight->number_subsection + $twentynine->number_subsection + $thirty->number_subsection)/$total->number_subsection) * 100; ?>

                                              <i class="w3-margin w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>
                                              <i class="w3-margin w3-right w3-large green-text">total of: <u><em class="w3-xxlarge black-text">{{ number_format((float)$totals, 2, '.', '') }}%</em></u></i>
                                           <?php $checker = number_format((float)$totals, 2, '.', '') ?>
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach
                                          @endforeach

                                          @else               
                                          <div class="w3-border red-text w3-large">lesson Thirty suspended</div>
                                          @endif
                                        </div>
 
                                  </div>@include('file.conditions')
                           </div>
                            <hr class="divide">
                  </div>
      @endforeach
    </div>
</div>

    @else

    @endif




	
</div>

@endif
 @endforeach
 <script type="text/javascript">
  $(document).ready(function() {
   
        $('html, body').animate({scrollTop:$(document).height() - 900}, 5000);
        return false;
    

});
</script>
@endforeach

@else
<script>
  window.location = '/';
</script>
@endif
<a href="#" class="scrollToTop w3-btn blue white-text shadow w3-opacity"><i class="mdi-navigation-arrow-drop-up w3-xlarge"></i></a>
@endforeach
@endsection