@extends('admin.include')



@section('title', 'course-register')

@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">



<script>
    //croll to top
    $(document).ready(function () {

        //Check to see if the window is top if not then display button
        var scroll = document.getElementById("top")
        // window.addEventListener("scroll",function(){
        //     scroll.style.transform = "rotate("+window.pageYOffset+"deg)";
        // });
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollToTop').fadeIn();
            } else {
                $('.scrollToTop').fadeOut();
            }
        });

        //Click event to scroll to top
        $('.scrollToTop').click(function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

    });

</script>
@endsection

@section('content')

@foreach($courses as $course)

@if($course->department->id != Auth::user()->department_id)
<script>
    window.location = '/register';
</script>
@else

@endif


{{-- total time for the the current course, as per each accepted lesson --}}
<a href="#" class="w3-btn right blue white-text shadow w3-margin" style="position: fixed; right: 10px; z-index: 10; width: 11%; top:250px;"><i class="mdi-av-timer w3-medium"></i> <b class="w3-xlarge">{{  number_format((float)$totaltime, 1, '.', '') }} hours</b></a>
{{-- total percentage covered, as per each accepted lesson --}}
<a href="#" class="w3-btn right green white-text shadow w3-margin" style="position: fixed; right: 10px; top:300px; z-index: 10; width: 11%"><i class="mdi-action-bookmark-outline w3-medium"></i> <b class="w3-xlarge">{{ number_format((float)$totalpercentage, 2, '.', '') }}%</b></a>

<div class="row">
    <div class="container w3-box w3-white w3-animate-opacity w3-padding shadow">

        @foreach($taughtlessons as $taughtlesson)
        @if($taughtlesson->course->department_id != Auth::user()->department_id)
        <p class="red-text w3-xxlarge"> You don't have access to this course</p>
        <script type="text/javascript">
            window.location = "/register";
        </script> 

        @else 
        @endif



        @endforeach



        <div class="row">
            <p class="w3-medium left w3-margin col s4"><b>UNIVERSITY OF BUEA<br> {{ Auth::user()->department->faculty->name }}<br> {{ Auth::user()->department->name }} <br> Year: 2018-2019</b></p>


            <p class="w3-medium right w3-margin col s4">course title:<b> {{ $course->title }}</b><br>Course Code: <b> {{ $course->code }}</b><br>Course Master: <b> {{ $course->user->fname }} {{ $course->user->lname }}</b><br>
                <b>{{ $course->semester->name }}</b></p>


            <div align="center" class="row">

                <img src="/images/images.jpg" class="w3-circle w3-center w3-margin" width="70" height="70"><br>
                <h5 class="w3-center col s12 l12 m12 w3-large orange-text w3-margin-top">Course Register 
                    <br><br><b class="w3-medium blue-text">{{ $course->code }}</b>
                </h5>

            </div>
            <hr id="divide-black">
        </div>

        <div class="w3-border w3-box w3-center w3-large w3-container w3-margin">
            @foreach($taughtlessons as $taughtlesson)
            @foreach($totalsubsection = App\Outline::where('course_id', '=', $course->id)->get() as $total)

            <div class="row">
                {{-- lesson one --}}
                <div class="col s12 m6 l6 w3-padding w3-border w3-padding w3-margin-opacity" >
                    <b id="font" class="w3-xlarge">Lesson Number: </b><b class="w3-xlarge blue-text" id="font">{{ $taughtlesson->lesson_number }}</b><br> 
                    {!! $taughtlesson->what_taught !!} 

                    @foreach($years = App\Year::where('active', 1)->get() as $year)
                    @if($taughtlesson->lesson_number == 1)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4 class="blue-text">Student Status</h4> 
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L1 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L1 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 1)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 2)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4> 
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L2 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L2 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 2)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 3)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L3 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L3 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 3)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 4)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L4 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L4 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 4)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 5)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L5 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L5 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id',$register->student->id)->where('year', $year->year)->where('lesson_number', 5)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 6)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L6 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L6 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 6)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 7)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L7 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L7 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 7)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 8)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L8 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L8 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 8)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 9)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L9 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L9 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 9)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 10)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L10 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L10 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 10)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 11)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L11 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L11 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 11)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 12)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L12 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L12 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 12)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 13)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L13 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L13 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 13)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 14)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L14 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L14 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 14)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 15)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L15 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L15 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 15)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 16)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L16 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L16 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 16)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 17)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L17 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L17 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 17)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 18)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L18 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L18 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 18)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 19)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L19 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L19 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 19)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 20)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L20 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L20 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 20)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 21)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L21 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L21 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 21)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 22)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L22 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L22 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 22)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 23)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L23 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L23 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 23)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 24)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L24 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L24 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 24)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 25)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L25 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L25 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 25)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 26)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L26 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L26 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 26)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 27)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L27 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L27 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 27)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 28)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L28 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L28 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 28)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 28)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L28 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L28 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 28)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 29)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L29 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L29 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 29)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif

                    @if($taughtlesson->lesson_number == 30)
                    <div class="col s12 m6 l12 w3-margin"><hr class="divide w3-margin-right">
                        <h4  class="blue-text">Student Status</h4>
                        @foreach($registers = App\Register::where('course_id', '=', $course->id)->get() as $register)

                        <b class="w3-medium"> {{ $register->student->name }}</b>

                        @if($register->L30 == 'A') 
                        <i class="mdi-action-done blue-text w3-xlarge"></i>

                        @elseif($register->L30 == 'D')

                        <i class=" red-text w3-medium w3-hover w3-tooltip">X
                            <span style="position: absolute; left: 0; bottom: 18px" class="w3-text w3-tag w3-round-xlarge w3-blue">
                                @foreach($reasons = App\Rejectedlesson::where('course_id', $course->id)->where('student_id', $register->student->id)->where('year', $year->year)->where('lesson_number', 30)->get() as $reason) {{ $reason->reason }} 
                                @endforeach 
                            </span>
                        </i>

                        @else
                        <i class="mdi-communication-live-help red-text w3-xlarge"></i> 
                        @endif &nbsp;&nbsp;

                        @endforeach
                        <hr class="divide w3-margin-right">
                    </div>
                    @endif
                    @endforeach
                </div>

                <div class="col s12 l5 m6 w3-padding w3-margin-left w3-border w3-margin-top right">
                    Start time: <b class="blue-text">{{ date('h:i a', strtotime($taughtlesson->start_time)) }}</b><br><br>
                    Stop Time: <b class="blue-text"> {{ date('h:i a', strtotime($taughtlesson->stop_time)) }}</b><br><br>
                    Venue: <b class="blue-text">{{ $taughtlesson->venue }}</b><br>
                    date: <b class="blue-text">{{ $taughtlesson->date }}</b><br><hr class="divide">

                    <?php $time = strtotime($taughtlesson->stop_time) - strtotime($taughtlesson->start_time); 
                    $hour = $time/3600;
                    ?>
                    <div class="col s12">
                        @if($taughtlesson->lesson_number == 1)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L1', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b><br>

                        <div class="w3-border w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif



                        @elseif($taughtlesson->lesson_number == 2)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L2', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 3)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L3', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif





                        @elseif($taughtlesson->lesson_number == 4)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L4', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 5)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L5', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif



                        @elseif($taughtlesson->lesson_number == 6)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L6', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif



                        @elseif($taughtlesson->lesson_number == 7)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L7', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 8)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L8', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 9)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L9', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif



                        @elseif($taughtlesson->lesson_number == 10)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L10', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif



                        @elseif($taughtlesson->lesson_number == 11)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L11', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 12)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L12', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 13)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L13', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif





                        @elseif($taughtlesson->lesson_number == 14)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L14', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 15)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L15', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 16)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L16', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif



                        @elseif($taughtlesson->lesson_number == 17)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L17', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 18)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L18', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif





                        @elseif($taughtlesson->lesson_number == 19)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L19', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 20)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L20', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 21)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L21', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif



                        @elseif($taughtlesson->lesson_number == 22)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L22', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif





                        @elseif($taughtlesson->lesson_number == 23)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L23', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 24)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L24', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 25)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L25', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif



                        @elseif($taughtlesson->lesson_number == 26)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L26', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif



                        @elseif($taughtlesson->lesson_number == 27)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L27', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 28)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L28', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif



                        @elseif($taughtlesson->lesson_number == 29)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L29', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @elseif($taughtlesson->lesson_number == 30)

                        @if(App\Register::where('course_id', $taughtlesson->course_id)->where('L30', '=', 'A')->count() > 2)
                        total time: <b class="blue-text">{{ number_format((float)$hour, 1, '.', '') }} hrs</b>

                        <div class="w3-border green-text w3-xlarge green-text"><b>Lesson Taught</b></div>

                        <?php $done = ($taughtlesson->number_subsection/$total->number_subsection) * 100  ?>
                        <i class="w3-right w3-border w3-padding w3-large green-text">Covered: <em class="w3-xlarge red-text"> {{ number_format((float)$done, 2, '.', '') }}%</em></i>

                        @else
                        <p class="red-text">Student refused this lesson</p>
                        @endif




                        @endif  {{-- end general if --}}
                    </div>
                </div>




            </div><hr class="divide">
            @endforeach
            @endforeach

        </div>  

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $('html, body').animate({scrollTop: $(document).height()}, 5000);
        return false;


    });
</script>

@endforeach
<a href="#" class="scrollToTop w3-btn orange white-text shadow w3-opacity"><i class="mdi-navigation-arrow-drop-up w3-xlarge"></i></a>
@endsection