
<!DOCTYPE html>
<html>
<head>
	<title>download_course_outline</title>

	
	<style>
.row {
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 20px;
}

.row:after {
  outline: "";
  display: table;
  clear: both;
}

.container {
  margin: 0 auto;
  max-width: 1280px;
  width: 90%;
}

@media only screen and (min-width: 601px) {
  .container {
    width: 85%;
  }
}

@media only screen and (min-width: 993px) {
  .container {
    width: 70%;
  }
}
.w3-white, .w3-hover-white:hover{color:#000 !important;background-color:#fff !important}

.w3-margin{margin:16px !important}
.w3-border{border:1px solid #ccc !important}
.w3-circle{border-radius:50% !important}
.w3-center{text-align:center !important}
.w3-medium{font-size:15px !important}
.w3-left{float:left !important}
.w3-right{float:right !important}
.w3-padding{padding:8px 16px !important}


.row .col {
  float: left;
  box-sizing: border-box;
  padding: 0 0.75rem;
}


.row .col.s12 {
  width: 100%;
  margin-left: auto;
  left: auto;
  right: auto;
}


@media only screen and (min-width: 601px) {
  .row .col.m1 {
    width: 8.3333333333%;
    margin-left: auto;
    left: auto;
    right: auto;
  }
  
  .row .col.m12 {
    width: 100%;
    margin-left: auto;
    left: auto;
    right: auto;
  }

}

@media only screen and (min-width: 993px) {
  .row .col.l1 {
    width: 8.3333333333%;
    margin-left: auto;
    left: auto;
    right: auto;
  }
 
  .row .col.l12 {
    width: 100%;
    margin-left: auto;
    left: auto;
    right: auto;
  }
  


}

.download{
    min-height: 400px;
    width: 70%;     
    position: relative;
    margin-top: 10px;


}
.view-box{
  box-shadow: 0px 0px 4px 4px rgba(0,0,0,0.2);
}

.border{
  border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000;
}
.divide{
  border-bottom: 0.1px solid  #000 !important;
}
.circle {
  border-radius: 50%;
}
.center, .center-align {
  text-align: center !important;
}

.left {
  float: left !important;
}

.right {
  float: right !important;
}
.white {
  background-color: #FFFFFF !important;
}

.white-text {
  color: #FFFFFF !important;
}
.blue-text {
  color: #2196F3 !important;
}
#bord{
	border-left: 1px solid #ccc;border-top: 1px solid #ccc; border-right: 1px solid #ccc;border-bottom: 1px solid #ccc;
}
.green-text {
  color: #4CAF50 !important;
}
.w3-left{float:left !important}.w3-right{float:right !important}
.w3-tiny{font-size:10px !important}.w3-small{font-size:12px !important}
.w3-medium{font-size:15px !important}
.w3-large{font-size:18px !important}
.w3-xlarge{font-size:24px !important}
.w3-xxlarge{font-size:36px !important}
.w3-xxxlarge{font-size:48px !important}
.w3-jumbo{font-size:64px !important}


	</style>
</head>
<body>

	@foreach($outlines as $outline)
				

		<div class="row">
			<div class="container w3-white download view-box" style="width: 90%">
				<br>

				<div class="w3-margin border">
					
					<p class="w3-medium left w3-margin"><b>UNIVERSITY OF BUEA<br> {{ Auth::user()->department->faculty->name }}<br>{{ Auth::user()->department->name }} <br>

            @if(Auth::guard('student')->check()) Name: {{ Auth::user()->name }}<br>Matricule: {{ Auth::user()->matricule }}@elseif(Auth::guard('admin')->check()) HOD: {{ Auth::user()->name }} @else @endif<br> Year: @foreach($years = App\Year::where('active', 1)->get() as $year) {{ $year->year }} @endforeach</b></p>


					<p class="w3-medium right w3-margin"><b>Course title:</b> {{ $outline->course->title }}<br><b>Course Code:</b> {{ $outline->course->code }}<br><b>Course Master: </b>{{ $outline->course->user->fname }} {{ $outline->course->user->lname }}<br>
						<b>{{ $outline->course->semester->name }} </b><br><br><b>printed date:</b> <small> {{ date('M j, Y h:i a', strtotime( Carbon\Carbon::now())) }}</small><br>
					</p> 


						<div align="center" class="w3-margin">

							<img src="./images/images.jpg" class="w3-circle w3-margin" width="70" height="70"><br>
								<br><h5 class="w3-center green-text w3-margin w3-padding" style="margin-left: 370px"><b>Course outline for <small>{{ $outline->course->code }}</small></b> </h5>
						</div>

					
				 @endforeach
				 <div><br></div>
					
				</div><hr class="w3-margin divide">
			
	@foreach($outlines as $outline) 

						

						<div class="w3-margin" id="bord"> 	
							<div class="w3-margin">
				
				          @foreach($topics = App\Topic::where('course_id', $outline->course->id)->get() as $key => $topic)
                    
                      Topic: {{ $key+1 }}. <u>{{ $topic->topic }}</u><br><br>
                    

                    {{-- form for the subtopic --}}
                    
                      @foreach($sections = App\Section::where('topic_id', $topic->id)->get() as $keyy => $section)
                        <b class="w3-padding-xlarge green-text">
                          {{ $key+1 }}.{{ $keyy+1 }}- {{ $section->subtopic }}<br>
                        </b>
                        @foreach($subsections = App\Subsection::where('section_id', $section->id)->get() as $keyyy => $subsection)
                          <div class=" w3-padding blue-text" style="margin-left: 80px !important;">
                            {{ $key+1 }}.{{ $keyy+1 }}.{{ $keyyy+1 }}- {{ $subsection->sub_section }}
                          </div>
                        @endforeach
                      @endforeach<br><hr>
                  @endforeach<hr>

          <p class="w3-margin-top w3-margin w3-padding">
        Program finnishing within: <b class="blue-text">{{ $outline->number_of_weeks }}</b> weeks time.<br>
         Total number of assignment to give: <b class="blue-text">{{ $outline->number_of_assignment }}</b><br>
          You also wish to evaluate your Students with the overall number of<b class="blue-text"> {{ $outline->number_of_continuous_accessment }}</b> Continuous Assessment.<br><br>@if(Auth::guard('admin')->check()) @else
          <b class="green-text w3-margin center w3-xlarge"> Wishing you the best !! </b><br><br>@endif
          <p class="center"><b class="w3-large">THE END</b></p>
       </p> 

							</div>

							
				 </div><div><br></div>


	@endforeach

  <script type="text/php">

    if(isset($pdf)){
    $text = "page {PAGE_NUM} / {PAGE_COUNT}";
    $size = 10;
    $font = $fontMetrics->getFont("Verdana");
    $width = $fontMetrics->get_text_width($text, $font, $size)/2;
    $x = ($pdf->get_width() - $width) / 2;
    $y = $pdf->get_height() - 35;
    $pdf->page_text($x, $y, $text, $font, $size);
  }
  </script>

</body>
</html>

