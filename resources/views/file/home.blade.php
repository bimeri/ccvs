@extends('content.include')

@section('title')
  teacher_home
@endsection

@section('imag')
<link rel="icon" href="{{URL::asset('/images/images.jpg')}}" type="image/x-icon">

<style>
table{
  border:3px solid #009999 !important;
}
tr{
  background-color: #e6e6e6;
}
td{
  border: 0.5px dotted black !important;
}
#upper{
  text-transform: uppercase;
}
</style>
@endsection




@section('content')
@if(Auth::check())

<center>
  <div class="w3-margin-top" style="margin-top: 50px !important;"> 
    <?php $courses = App\Course::where('user_id', Auth::user()->id)->get(); ?>

   
    @foreach($courses as $course)

    @if($course->semester->active == 1)

    @if(App\Outline::where('course_id', $course->id)->where('status', 1)->exists())

  
            <?php $totalsections = App\Outline::where('course_id', $course->id)->get(); ?>

        @foreach($totalsections as $totalsection)
            <?php $averageCA = $totalsection->number_subsection; ?>

            <?php $totalsum = App\Taughtlesson::where('course_id', $course->id)->sum('number_subsection'); ?>


          @if($totalsum >= ($averageCA/($totalsection->number_of_continuous_accessment)*4)-1)
               <label id="notify"> Notification </label> <br>

                <div class="container white-text w3-large" style="width: 70%;background-color:  #1B5E20 !important;">
                  <i class="w3-rounded"><b><u>{{ $course->code }} {{ $course->title }}</u></b><br><br>you have done <b class="black-text"> 4/{{ $totalsection->number_of_continuous_accessment }}</b> of your work, and you planned to give a total of {{ $totalsection->number_of_continuous_accessment }} Continuous Assessment.<br><b class="black-text"> Give the Fourth CA(4)</b>
                  </i>
                </div>

                <div class="row">
                  <div class="col offset-l7 offset-s1 offset-m5 s10 l3 m6">
                    <a href="{{ route('clearnotifocation', $course->id) }}" class="w3-right  w3-margin-top w3-rounded w3-large">clear Notification</a>
                  </div>
                </div>

              @elseif($totalsum >=( $averageCA/($totalsection->number_of_continuous_accessment)*3)-1)
               <label id="notify"> Notification </label> <br>

                <div class="container white-text w3-large" style="width: 70%;background-color:  #bf360c !important;">
                  <i class="w3-rounded"><b><u>{{ $course->code }} {{ $course->title }}</u></b><br> <br>you have done <b class="black-text"> 3/{{ $totalsection->number_of_continuous_accessment }}</b> of your work, and you planned to give a total of {{ $totalsection->number_of_continuous_accessment }} Continuous Assessment.<br><b class="black-text"> Give the Third CA(3)</b>
                  </i>
                </div>

                <div class="row">
                  <div class="col offset-l7 offset-s1 offset-m5 s10 l3 m6">
                    <a href="{{ route('clearnotifocation', $course->id) }}" class="w3-right  w3-margin-top w3-rounded w3-large">clear Notification</a>
                  </div>
                </div>

              @elseif($totalsum >= ($averageCA/($totalsection->number_of_continuous_accessment)*2)-1)
               <label id="notify"> Notification </label> <br>

                <div class="container white-text w3-large" style="width: 70%;background-color:   #00E676 !important;">
                  <i class="w3-rounded"><b><u>{{ $course->code }} {{ $course->title }}</u></b><br><br>you have done <b class="black-text"> 2/{{ $totalsection->number_of_continuous_accessment }}</b> of your work, and you planned to give a total of {{ $totalsection->number_of_continuous_accessment }} Continuous Assessment.<br><b class="black-text"> Give the Second CA(2)</b>
                  </i>
                </div>

                <div class="row">
                  <div class="col offset-l7 offset-s1 offset-m5 s10 l3 m6">
                    <a href="{{ route('clearnotifocation', $course->id) }}" class="w3-right  w3-margin-top w3-rounded w3-large">clear Notification</a>
                  </div>
                </div>

            @elseif($totalsum >= $averageCA/$totalsection->number_of_continuous_accessment)
              <label id="notify"> Notification </label> <br>

                <div class="container white-text orange w3-large" style="width: 70%;">
                  <i class="w3-rounded"><b class="w3-margin"> <u>{{ $course->code }} {{ $course->title }}</u></b><br><br>you have done <b class="black-text"> 1/{{ $totalsection->number_of_continuous_accessment }}</b> of your work, and you planned to give a total of {{ $totalsection->number_of_continuous_accessment }} Continuous Assessment.<br> <b class="black-text">Give the first CA(1)</b>
                  </i>
                </div>

                <div class="row">
                  <div class="col offset-l7 offset-s1 offset-m5 s10 l3 m6">
                    <a href="{{ route('clearnotifocation', $course->id) }}" class="w3-right  w3-margin-top w3-rounded w3-large">clear Notification</a>
                  </div>
                </div>


          @endif
           
        @endforeach
         <hr>
      @endif
    
@endif
    @endforeach
  </div>


<div class="row">
  @foreach($courses as $course)
   @if($course->semester->active == 1)
    @if(App\Outline::where('course_id', $course->id)->exists())
  <div class="w3-margin-top w3-white w3-padding w3-border col offset-l2 s12 m12 l8">

      @foreach($outlines = App\Outline::select('number_subsection', 'number_of_weeks', 'number_of_assignment')->where('course_id', $course->id)->get() as $outline )
      

      
       <p class="w3-xlarge">Course Coverage Review</p>

       <table cellpadding="5">

        <tr>
          <td class=" w3-padding" rowspan="2"><b id="upper">course</b></td>
          <td class="w3-padding">Code: {{ $course->code }}</td>
        </tr>
        <tr>
          <td class="w3-padding">Title: {{ $course->title }}</td>
        </tr>
        <tr>
          <td class="w3-padding"><b id="upper">number of weeks</b></td>
          <td class="w3-padding"><label class="w3-large blue-text">{{ $outline->number_of_weeks }}</label> weeks</td>
        </tr>
        <tr>
          <td class="w3-padding"><b id="upper">number of sub-section</b></td>
          <td class="w3-padding"><label class="w3-large blue-text">{{ $outline->number_subsection }}</label> subsections for this semester</td>
        </tr>
        <tr>
          <td class="w3-padding"><b id="upper">number of sub-section per week</b></td>
          <td class="w3-padding"><label class="w3-large blue-text">{{ ceil($outline->number_subsection/$outline->number_of_weeks) }}</label> (to be covered each week)</td>
        </tr>
        <tr>
          <td class="w3-padding"><b id="upper">number of sub-section per day</b></td>
          <td class="w3-padding"> approaximately <label class="w3-large blue-text">{{ ceil(($outline->number_subsection/$outline->number_of_weeks)/2) }}</label> per lesson</td>
        </tr>
        <tr>
          <td class="w3-padding"><b id="upper">number of sub-section covered</b></td>
          <td class="w3-padding">
            <?php $numberoflectures = App\Taughtlesson::where('course_id', $course->id)->count(); ?>
            <?php $taughtlesson = App\Taughtlesson::where('course_id', $course->id)->sum('number_subsection'); ?>
            
             @if($taughtlesson == '')
              0 ( zero ), 
            @else
             <label class="w3-large blue-text">{{ ceil($taughtlesson) }},</label>
            @endif left with <label class="w3-large red-text">{{$outline->number_subsection - $taughtlesson }}</label> unfinished subsection(s)</td>
        </tr>
        <tr>
          <td class="w3-padding"><b id="upper">number of lectures</b></td>
          <td class="w3-padding"><label class="w3-large blue-text">
            @if($numberoflectures == '')
              0 ( zero ),
            @else
          {{ ceil($numberoflectures) }}@endif</label> for now</td>
        </tr>
        <tr>
          <td class="w3-padding"><b id="upper">number of Assignment</b></td>
          <td class="w3-padding"><label class="w3-large blue-text">
            <?php $assignment = App\Taughtlesson::where('course_id', $course->id)->where('assignment', '!=', null)->count(); ?>
            @if($outline->number_of_assignment == '')
            0 ( zero ),
            @else
            {{ $outline->number_of_assignment }}, @endif</label> given <b class="blue-text">{{ $assignment }},</b> remaining <b class="blue-text"> @if($outline->number_of_assignment - $assignment < 0) 0 @else {{ $outline->number_of_assignment - $assignment }}@endif </b> </td>
        </tr>

       </table>

      @endforeach

  </div>
   @endif
   @endif
   @endforeach
</div>

</center>


<center>
  <div  class="white-text progress w3-margin w3-xlarge w3-hide-small" id="change" onclick="this.style.left='5px'">

    Course Coverage <b class="orange-text">%tage</b>

  </div>
</center>

@else
<script>
  window.location = '/admin';
</script>
@endif
@endsection

