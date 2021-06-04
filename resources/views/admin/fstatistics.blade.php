@extends('admin.include')


@section('title', 'final statistics')
@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
@endsection
@section('content')


    <div class="row">
        <div class="container w3-box w3-white">
    

            <p class="w3-medium">Select the Year and the Course</p>

                {{--<img src="/images/images.jpg" class="w3-circle" width="70" height="70"><br> --}}

            <div class="w3-border w3-box w3-center w3-large w3-container w3-margin">
                
                  <div class="row">
                    <?php
                    $years = App\Year::all();
                    $semesters = App\Semester::all();
                     ?>
        
                      <form action="{{ route('admin.allcourseStatistics') }}" method="get" class="validate">
                        {{ csrf_field() }}
                        <div class="input-field col s6 m6 offset-l2 l4">
                            <select class="validate" name="year">
                                @foreach($years as $year)
                                    
                                        <option value="{{ $year->id }}">{{ $year->year }}</option> 
                                    
                                @endforeach
                            </select>
                        </div>

                        <div class="input-field col s6 m6  l4">
                            <select class="validate" name="semester">
                                @foreach($semesters as $semester)
                                        
                                            <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                                        
                                @endforeach
                            </select>
                        </div>
                        <br><br><br>

                        <div class="row">
                            <div class="col offset-l4 offset-m3 offset-s3 l3 m3 s4">
                                <a onclick="load()"><input type="submit" value="See Statistics" class="w3-right w3-color w3-large w3-btn waves-effect waves-blue w3-medium w3-round"></a>
                            </div>
                        </div>
                      </form>
                  </div>
            </div> 
        </div>

        <div style="margin-top: -10px;">
            <br>
                 @if(Session::has('adminmessage'))
                   <center> 
                        <div class="row  w3-container materialize-red lighten-4 w3-round w3-padding w3-margin-top w3-xlarge" style="display: block; width:50%;color:#F44336">
                        <strong id="error" class="font"> {{ Session::get('adminmessage') }} {{ Session::forget('adminmessage') }} </strong>
                        </div>
                    </center>
                @else

                <script type="text/javascript">
                    $(document).ready(function() 
                    {
                        var h = window.innerHeight;
                   
                        $('html, body').animate({scrollTop:$(document).height() - (h + 50)}, 3000);
                        return false;
                    });
                </script>


                <div class="container w3-white syllabus view-box" style="width: 80%; margin-top: 0px;">
                    <img src="/images/images.jpg" class="w3-circle w3-right w3-margin" width="80" height="80">
                    <img src="/images/images.jpg" class="w3-circle w3-left w3-margin" width="80" height="80">
                    <p class="w3-large w3-padding w3-margin-top" id="c-p">
                        <b>university of buea<br>faculty of {{ Auth::user()->department->faculty->name }}<br>department of {{ Auth::user()->department->name }}</b>
                        <br><br>
                        <em>Final Departmental Statistics for 
                            @foreach($semestercurrent as $sem)<b class="blue-text"> {{ $sem->name }}</b>, @endforeach
                            @foreach($yearcurrent as $yea)<b class="blue-text"> {{ $yea->year }}</b>. @endforeach
                        </em><hr class="divides"><br>
                    </p>

                    <div class="w3-border w3-white w3-margin" style="overflow-x: scroll;">

                        <table class="w3-table w3-striped w3-bordered w3-padding">

                            <tr class="w3-teal">
                                 <b class="center w3-margin w3-xlarge teal-text">level 200</b>
                                <th class="cent">S/N</th>
                                <th class="cent">course Code</th>
                                <th class="cent">Course Title</th>
                                <th class="cent">Name of Lecturer</th>
                                <th class="cent">Number of lectures</th>
                                <th class="cent">Time of Lectures</th>
                                <th class="cent">Percentage Covered</th>
                                <th class="cent">Remark</th>
                            </tr>
                        <?php $count = 1 ?>
                             @foreach($statistics as $statistic)
                            @if($statistic->level_id == 2)
                            <tr>
                                <td class="cent">{{ $count++ }}</td>
                                <td class="cent">{{ $statistic->course->code }}</td>
                                <td class="cent">{{ $statistic->course->title }}</td>
                                <td class="cent">{{ $statistic->course->user->fname }} {{ $statistic->course->user->lname }}</td>
                                <td class="cent">{{ $statistic->total_lecture }}</td>
                                <td class="cent">{{ $statistic->time }}</td>
                                <td class="cent">{{ $statistic->percent }}</td>
                                <td class="cent teal-text">
                                    <b>@if($statistic->percent > 90) Excellent @elseif($statistic->percent > 80) Very Great Job @elseif($statistic->percent > 70) Good Job @elseif($statistic->percent > 59) Average Work @elseif($statistic->percent < 60) Poor work @endif
                                    </b>
                                </td>
                            </tr>
                            @endif
                             @endforeach
                         </table>
                         {{-- this line ofcode is to check if the record exist before printing it to the table --}}
                         @foreach($statistics as $statistic)
                         <?php $counter = App\Statistic::where('level_id', 2)->where('year_id', $statistic->year_id)->where('department_id', Auth::user()->id)->where('semester_id', $statistic->semester_id)->count(); ?>
                          @endforeach
                          @if($counter > 0)
                            
                            @else 
                            <p class="w3-margin w3-xlarge red-text">No statistics Recorded for this level</p>
                            @endif
                         <br><hr class="divide">

                         <table class="w3-table w3-striped w3-bordered w3-padding">

                            <tr class="w3-blue">
                                 <b class="center w3-margin w3-xlarge blue-text">level 300</b>
                                <th class="cent">S/N</th>
                                <th class="cent">course Code</th>
                                <th class="cent">Course Title</th>
                                <th class="cent">Name of Lecturer</th>
                                <th class="cent">Number of lectures</th>
                                <th class="cent">Time of Lectures</th>
                                <th class="cent">Percentage Covered</th>
                                <th class="cent">Remark</th>
                            </tr>
                        <?php $count2 = 1 ?>
                             @foreach($statistics as $statistic)
                            @if($statistic->level_id == 3)
                            <tr>
                                <td class="cent">{{ $count2++ }}</td>
                                <td class="cent">{{ $statistic->course->code }}</td>
                                <td class="cent">{{ $statistic->course->title }}</td>
                                <td class="cent">{{ $statistic->course->user->fname }} {{ $statistic->course->user->lname }}</td>
                                <td class="cent">{{ $statistic->total_lecture }}</td>
                                <td class="cent">{{ $statistic->time }}</td>
                                <td class="cent">{{ $statistic->percent }}</td>
                                <td class="cent blue-text">
                                    <b>@if($statistic->percent > 90) Excellent @elseif($statistic->percent > 80) Very Great Job @elseif($statistic->percent > 70) Good Job @elseif($statistic->percent > 59) Average Work @elseif($statistic->percent < 60) Poor work @endif
                                    </b>
                                </td>
                            </tr>
                            @endif
                             @endforeach
                         </table>
                          {{-- this line ofcode is to check if the record exist before printing it to the table --}}
                         @foreach($statistics as $statistic)
                         <?php $counter = App\Statistic::where('level_id', 3)->where('year_id', $statistic->year_id)->where('department_id', Auth::user()->id)->where('semester_id', $statistic->semester_id)->count(); ?>
                          @endforeach
                          @if($counter > 0)
                            
                            @else 
                            <p class="w3-margin w3-xlarge red-text">No statistics Recorded for this level</p>
                            @endif
                         <br><hr class="divide">

                         <table class="w3-table w3-striped w3-bordered w3-padding">

                            <tr class="w3-pink">
                                 <b class="center w3-margin w3-xlarge pink-text">level 400</b>
                                <th class="cent">S/N</th>
                                <th class="cent">course Code</th>
                                <th class="cent">Course Title</th>
                                <th class="cent">Name of Lecturer</th>
                                <th class="cent">Number of lectures</th>
                                <th class="cent">Time of Lectures</th>
                                <th class="cent">Percentage Covered</th>
                                <th class="cent">Remark</th>
                            </tr>
                        <?php $count3 = 1 ?>
                             @foreach($statistics as $statistic)
                            @if($statistic->level_id == 4)
                            <tr>
                                <td class="cent">{{ $count3++ }}</td>
                                <td class="cent">{{ $statistic->course->code }}</td>
                                <td class="cent">{{ $statistic->course->title }}</td>
                                <td class="cent">{{ $statistic->course->user->fname }} {{ $statistic->course->user->lname }}</td>
                                <td class="cent">{{ $statistic->total_lecture }}</td>
                                <td class="cent">{{ $statistic->time }}</td>
                                <td class="cent">{{ $statistic->percent }}</td>
                                <td class="cent pink-text">
                                    <b>@if($statistic->percent > 90) Excellent @elseif($statistic->percent > 80) Very Great Job @elseif($statistic->percent > 70) Good Job @elseif($statistic->percent > 59) Average Work @elseif($statistic->percent < 60) Poor work @endif
                                    </b>
                                </td>
                            </tr>
                            @endif
                             @endforeach
                         </table>

                         {{-- this line ofcode is to check if the record exist before printing it to the table --}}
                         @foreach($statistics as $statistic)
                         <?php $counter = App\Statistic::where('level_id', 4)->where('year_id', $statistic->year_id)->where('department_id', Auth::user()->id)->where('semester_id', $statistic->semester_id)->count(); ?>
                          @endforeach
                          @if($counter > 0)
                            
                            @else 
                            <p class="w3-margin w3-xlarge red-text">No statistics Recorded for this level</p>
                            @endif
                         <br><hr class="divide">

                         <table class="w3-table w3-striped w3-bordered w3-padding">

                            <tr class="w3-orange">
                                 <b class="center w3-margin w3-xlarge orange-text">level 500</b>
                                <th class="cent">S/N</th>
                                <th class="cent">course Code</th>
                                <th class="cent">Course Title</th>
                                <th class="cent">Name of Lecturer</th>
                                <th class="cent">Number of lectures</th>
                                <th class="cent">Time of Lectures</th>
                                <th class="cent">Percentage Covered</th>
                                <th class="cent">Remark</th>
                            </tr>
                        <?php $count3 = 1 ?>
                             @foreach($statistics as $statistic)
                            @if($statistic->level_id == 5)
                            <tr>
                                <td class="cent">{{ $count3++ }}</td>
                                <td class="cent">{{ $statistic->course->code }}</td>
                                <td class="cent">{{ $statistic->course->title }}</td>
                                <td class="cent">{{ $statistic->course->user->fname }} {{ $statistic->course->user->lname }}</td>
                                <td class="cent">{{ $statistic->total_lecture }}</td>
                                <td class="cent">{{ $statistic->time }}</td>
                                <td class="cent">{{ $statistic->percent }}</td>
                                <td class="cent orange-text">
                                    <b>@if($statistic->percent > 90) Excellent @elseif($statistic->percent > 80) Very Great Job @elseif($statistic->percent > 70) Good Job @elseif($statistic->percent > 59) Average Work @elseif($statistic->percent < 60) Poor work @endif
                                    </b>
                                </td>
                            </tr>
                            @endif
                             @endforeach
                         </table>
                         {{-- this line ofcode is to check if the record exist before printing it to the table --}}
                         @foreach($statistics as $statistic)
                         <?php $counter = App\Statistic::where('level_id', 5)->where('year_id', $statistic->year_id)->where('department_id', Auth::user()->id)->where('semester_id', $statistic->semester_id)->count(); ?>
                          @endforeach
                          @if($counter > 0)

                           {{-- download the general statistics--}}
           
                            
                            @else 
                            <p class="w3-margin w3-xlarge red-text">No statistics Recorded for this level</p>
                            @endif
                         
                          <div class="w3-right w3-padding w3-margin">
                <form action="{{ route('final.download', ['download'=>'pdf']) }}" method="get">
                    {{ csrf_field() }} 

                    @foreach($yearcurrent as $ryear)
                    <input type="hidden" name="yearresult" value="{{ $ryear->id }}">
                    @endforeach
                    @foreach($semestercurrent as $rsemester)
                    <input type="hidden" name="semesterresult" value="{{ $rsemester->id }}">
                    @endforeach

                    <a href="#" class="w3-btn w3-blue w3-large w3-round waves-effect wave-green"><i class="mdi-file-file-download"></i><input type="submit" value="Download general course statistics"></a>


                    
                </form>         
            </div>
                    </div>

                @endif
    </div><br><br><br>
</div>
@endsection
