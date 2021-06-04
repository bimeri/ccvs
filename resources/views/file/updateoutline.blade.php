@extends('content.include')


@section('title', 'Course_Outline')
@section('imag')
<link rel="icon" href="{{URL::asset('/images/images.jpg')}}" type="image/x-icon">
<script src="{{URL::asset('js/sweetalert.js')}}"></script>
@endsection
@section('style')
<script src='https://devpreview.tiny.cloud/demo/tinymce.min.js'></script>
  <script>
  tinymce.init({
    selector: '#question',
    height: '300px',  // change this value according to your HTML
  plugins : 'advlist autolink link image lists charmap print preview',
   toolbar: 'undo redo | styleselect | bold italic | link image | underline fontsizeselect| strikethrough | alignleft | aligncenter | alignright | alignjustify',
  });
  </script>

@endsection


@section('content')
  @include('file.message')
  @if(isset(Auth::user()->id))

  <a href="/course_content" class="w3-btn w3-grey w3-border w3-round" style="left: 10px; bottom: 250px; position: fixed; z-index: 10"><i class="mdi-hardware-keyboard-arrow-left red-text"></i> go back</a>

@foreach($courses as $course) 
        @if($course->department_id != Auth::user()->department_id)

        <script>
          window.location ="/course_content";
        </script>
        {{ Session(['error' => 'department_id wrong']) }}

        @else 

        @if($course->user->id != Auth::user()->id)
        <script>
          window.location = "/course_content";
        </script>
        {{ Session(['error' => 'not the user']) }}
        @else

        @if (\App\Workcontent::where('course_id', '=', $course->id)->count() < 1)
        <script>
          window.location = "/course_content";
        </script>
        {{ Session(['error' => 'no work content']) }}

        @else

        @if (!(\App\Outline::where('course_id', '=', $course->id)->exists()))



        <script type="text/javascript">
          window.location= '/course_content';
        </script>
        {{ Session(['error' => 'There is no outline']) }}

        @else

    <div class="row">

      <div class="container w3-border w3-box w3-white">
        <br>
        <div class="w3-medium w3-margin w3-padding w3-color white-text center">
                <span onclick="this.parentElement.style.display='none'" class="w3-close right w3-padding-xlarge white-text w3-hover">x</span>
                <p class="w3-large w3-padding">You can update this content from now till when you start marking the register.</p>
              </div>
        <div class="w3-border">
          <p class="w3-medium left w3-margin"><b>UNIVERSITY OF BUEA<br> {{ Auth::user()->department->faculty->name }}<br> {{ Auth::user()->department->name }} <br> Year: 2018-2019</b></p>


          <p class="w3-medium right w3-margin"><b>course title:</b> {{ $course->title }}<br><b>Course code:</b> {{ $course->code }}<br><b>Course Master:</b>{{ $course->user->fname }} {{ $course->user->lname }}<br>
            <b>{{ $course->semester->name }} </b>
          </p>


            <div align="center" class="row">
              
              <center><label class="w3-margin blue-text w3-xlarge text-shadow"><b>Knowledge with wisdom</b></label></center>
              <img src="./images/images.jpg" class="w3-circle w3-center w3-margin" width="70" height="70"><br>
                <h5 class="w3-center col s12 l12 m12 black-text w3-medium w3-padding">Update the Course Ouline<br><br><b class="w3-large blue-text"><i> {{ $course->course }} {{ $course->title }}</i></b> </h5>

                {{-- {{ date('M j, Y h:ia', strtotime( Carbon\Carbon::now())) }}  --}}

          </div>
        </div><hr class="d-s">


        <div class="w3-border">
          

          @foreach($outlines as $outline)

          <form action="{{ route('outline.updatefuction') }}" method="post" class="validate" id="form">
            {{ csrf_field() }}

            <div class="row">

              <div class="col s12 m12 l8 offset-l2">
                <label for="question" style="font-size: 17px;" id="label" class="w3-margin w3-padding">Update the course Outline objectives (Including material summary), It should contain all the contents of the original scheme in a detail</label>
                <textarea id="question" name="description" placeholder="enter outline">
                  {{ $outline->description }}
                </textarea>
                
              </div>
            </div>

            <p class="w3-center w3-large w3-margin-top">Update Additional options</p><br><br>


              <div class="row w3-margin">
               
                <div class="input-field col s12 l6 m6 offset-l2">
                  <input type="number" name="number_subsection" class="validate" id="num_weeks" value="{{ $outline->number_subsection }}">
                    <label for="num_weeks" class="w3-medium">Total number of subsection (count from your course outline above)</label>
                </div>
             </div>

              <div class="row w3-margin">
                <div class="input-field col s6 l3 m3 offset-l2">
                  <input type="number" name="number_of_weeks" class="validate" id="num_weeks" value="{{ $outline->number_of_weeks }}">
                    <label for="num_weeks" class="w3-medium">Number of week(s)</label>
                </div>

                <div class="input-field col s6 l3 m3">
                  <input type="number" name="number_of_assignment" class="validate" id="num_ass" value="{{ $outline->number_of_assignment }}">
                    <label for="num_ass" class="w3-medium">Number of assignment(s)</label>
                </div>

                <div class="input-field col s6 l3 m3">
                  <input type="number" name="number_of_continuous_accessment" class="validate" id="num_ca" value="{{ $outline->number_of_continuous_accessment }}">
                    <label for="num_ca" class="w3-medium">Number of Ca(s)</label>
                </div>
              </div>
                
              
              
          
            <div><br><br></div>

                <div class="container w3-border" style="width: 50%">
                <div class="row w3-margin w3-center w3-large">

                <a href="syllabus" class="w3-margin w3-round w3-btn w3-red waves-red left waves-effect">cancel</a>

               <input type="submit" value="Update" class="w3-btn right orange waves-effect waves-white w3-round w3-margin" onclick="save()" id="btn-submit">

                </div>
          </form>
          @endforeach
        </div>


          
        </div>  
        <div><br><br><br></div>
        
      </div>
    </div>

    
    @endif

    @endif
    @endif
    @endif
    @endforeach

@else
<script>
  window.location = '/admin';
</script>
@endif
<script>

  function save(){
$(document).on('click', '#btn-submit', function(e) {
    e.preventDefault();
   swal({
  title: "Are you sure you want to update?",
  text: "Once updated, teacher and students will be informed of the new update!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
}).then(function (willUpdate) {
  if (willUpdate) {
    swal("Poof! Your Outline has been updated", {
      icon: "success",
    });
    $('#form').submit();
  } else {
    swal("Your outline is unchange!");
  }
        
    });
});

}
</script>
@endsection
