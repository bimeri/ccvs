
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


  <div class="container w3-white syllabus view-box" style="width: 80%; margin-top: 0px;">
                    <img src="./images/images.jpg" class="w3-circle w3-right w3-margin" width="80" height="80">
                    <img src="./images/images.jpg" class="w3-circle w3-left w3-margin" width="80" height="80">
                    <p class="w3-large center w3-margin w3-padding" id="c-p"><br>
                        <b>university of buea<br>faculty of {{ Auth::user()->department->faculty->name }}<br>department of {{ Auth::user()->department->name }}</b>
                        <br><br>
                        <em>Final Departmental Statistics for 
                            @foreach($semester as $sem)<b class="blue-text">{{ $sem->name }}r</b>, @endforeach
                            @foreach($year as $yea)<b class="blue-text"> {{ $yea->year }}</b>. @endforeach<br>
                            <b>printed date:</b> <small> {{ date('M j, Y h:i a', strtotime( Carbon\Carbon::now())) }}</small><br>
                        </em><hr class="divides"><br>
                    </p>
                    <br><hr>

                    <div class="center w3-border w3-white w3-margin" style="overflow-x: scroll;">

                        <table class="w3-table w3-striped w3-bordered w3-padding center">

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
                         </table><br><hr class="divide">

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
                         </table><br><hr class="divide">

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
                         </table><br><hr class="divide">

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
                    </div>
    </div><br>
               
                    
               
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

