
<!DOCTYPE html>
<html>
<head>
	<title>download_course_content</title>

	
<style>
.row {
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 20px;
}

.row:after {
  content: "";
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
.w3-left{float:left !important}.w3-right{float:right !important}


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
  border-left: 3px solid #000; border-top: 3px solid #000; border-bottom: 3px solid #000; border-right: 3px solid #000;
}
.divide{
  border-bottom: 0.1px solid  #000 !important;
}
.circle {
  border-radius: 50%;
}
.center, .center-align {
  text-align: center;
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


	</style>
</head>
<body>
	

	@foreach($scontents as $content)
				

		<div class="row">
			<div class="container w3-white download view-box" style="width: 100%">
				<br>

				<div class="w3-margin border">
					
					<p class="w3-medium left w3-margin"><b>UNIVERSITY OF BUEA<br> {{ Auth::user()->department->faculty->name }}<br><b> {{ Auth::user()->department->name }}<br>  @if(Auth::guard('student')->check()) Name: {{ Auth::user()->name }}<br>Matricule: {{ Auth::user()->matricule }} @else  @endif<br> Year:
          @foreach($years = App\Year::where('active', 1)->get() as $year) {{ $year->year }} @endforeach</b></p>


					<p class="w3-medium right w3-margin"><b>Course title:</b> {{ $content->course->title }}<br><b>Course Code:</b> {{ $content->course->code }}<br><b>Course Master: </b>{{ $content->course->user->fname }} {{ $content->course->user->lname }}<br>
						<b>{{ $content->course->semester->name }} </b><br><br><b>printed date:</b> <small> {{ date('M j, Y h:i a', strtotime( Carbon\Carbon::now())) }}</small><br>
					</p> 


						<div align="center" class="w3-margin">

							<img src="./images/images.jpg" class="w3-circle w3-margin" width="70" height="70"><br>
								<h5 class="w3-center blue-text w3-margin w3-padding col" style="position: fixed; top: 160px;"><b style="font-family: Comic Sans MS !important;">Course Syllabus for {{ $content->course->code }}</b> </h5>
						</div>

					
				 @endforeach
				 <div><br></div>
					
				</div><hr class="w3-margin divide">
			
	@foreach($scontents as $content) 

						

						<div class="w3-margin" id="bord"> 	
							<div class="w3-margin">
				 
				 {!! $content->description !!}<hr>
         {!! $content->main_content !!}<hr>

							</div>

							
				 </div><div><br></div>


	@endforeach

	

</div>

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

  {{-- strip_tags() --}}
</body>
</html>

