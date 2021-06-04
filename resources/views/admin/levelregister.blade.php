@extends('admin.include')


@section('title', 'level-register')
@section('style')

<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">

<style>
	#chart-container {
				width: 640px;
				height: auto;
			}
</style>
@endsection

@section('content')
	<div class="row">

		<script>
			$(function(){

    //get the bar chart canvas
    var ctx = $("#mypiechart");

    //bar chart data
    var data = {
        labels:[ @foreach($levelcourses as $course) "{{ $course->code }}", @endforeach],
        datasets: [
            {
                label: "Percentage",
                data: [@foreach($levelcourses as $course)  @foreach($totalsubsection = App\Outline::select('number_subsection')->where('course_id', $course->id)->get() as $total)

               

                <?php 
 
	// lesson1
        $l1 = App\register::where('course_id', $course->id)->where('L1', 'A')->count();


        if ($l1 > 2) {
            
            $lesson1 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 1)->get();


            foreach ($lesson1 as $one) {

                $taught1 = $one->number_subsection;
            }


        } else{ $taught1 = null; }
// lesson2
        $l2 = App\register::where('course_id', $course->id)->where('L2', 'A')->count();


        if ($l2 > 2) {
            
            $lesson2 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 2)->get();


            foreach ($lesson2 as $two) {

                $taught2 = $two->number_subsection;
            }


        } else{ $taught2 = null; }

// lesson3
        $l3 = App\register::where('course_id', $course->id)->where('L3', 'A')->count();
        if ($l3 > 2) {
            
            $lesson3 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 3)->get();


            foreach ($lesson3 as $three) {

                $taught3 = $three->number_subsection;
            }


        } else{ $taught3 = null; }

// lesson4
        $l4 = App\register::where('course_id', $course->id)->where('L4', 'A')->count();
        if ($l4 > 2) {
            
            $lesson4 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 4)->get();


            foreach ($lesson4 as $four) {

                $taught4 = $four->number_subsection;
            }


        } else{ $taught4 = null; }

// lesson5
        $l5 = App\register::where('course_id', $course->id)->where('L5', 'A')->count();
        if ($l5 > 2) {
            
            $lesson5 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 5)->get();


            foreach ($lesson5 as $five) {

                $taught5 = $five->number_subsection;
            }


        } else{ $taught5 = null; }

// lesson6
        $l6 = App\register::where('course_id', $course->id)->where('L6', 'A')->count();
        if ($l6 > 2) {
            
            $lesson6 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 6)->get();


            foreach ($lesson6 as $six) {

                $taught6 = $six->number_subsection;
            }


        } else{ $taught6 = null; }
// lesson7
        $l7 = App\register::where('course_id', $course->id)->where('L7', 'A')->count();
        if ($l7 > 2) {
            
            $lesson7 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 7)->get();


            foreach ($lesson7 as $seven) {

                $taught7 = $seven->number_subsection;
            }


        } else{ $taught7 = null; }

    // lesson8
        $l8 = App\register::where('course_id', $course->id)->where('L8', 'A')->count();
        if ($l8 > 2) {
            
            $lesson8 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 8)->get();


            foreach ($lesson8 as $eight) {

                $taught8 = $eight->number_subsection;
            }


        } else{ $taught8 = null; }
// lesson9
        $l9 = App\register::where('course_id', $course->id)->where('L9', 'A')->count();
        if ($l9 > 2) {
            
            $lesson9 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 9)->get();


            foreach ($lesson9 as $nine) {

                $taught9 = $nine->number_subsection;
            }


        } else{ $taught9 = null; }
// lesson10
        $l10 = App\register::where('course_id', $course->id)->where('L10', 'A')->count();
        if ($l10 > 2) {
            
            $lesson10 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 10)->get();


            foreach ($lesson10 as $ten) {

                $taught10 = $ten->number_subsection;
            }


        } else{ $taught10 = null; }

        // lesson11
        $l11 = App\register::where('course_id', $course->id)->where('L11', 'A')->count();
        if ($l11 > 2) {
            
            $lesson11 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 11)->get();


            foreach ($lesson11 as $eleven) {

                $taught11 = $eleven->number_subsection;
            }


        } else{ $taught11 = null; }

        // lesson12
        $l12 = App\register::where('course_id', $course->id)->where('L12', 'A')->count();
        if ($l12 > 2) {
            
            $lesson12 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 12)->get();


            foreach ($lesson12 as $twelve) {

                $taught12 = $twelve->number_subsection;
            }


        } else{ $taught12 = null; }

        // lesson13
        $l13 = App\register::where('course_id', $course->id)->where('L13', 'A')->count();
        if ($l13 > 2) {
            
            $lesson13 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 13)->get();


            foreach ($lesson13 as $thirteen) {

                $taught13 = $thirteen->number_subsection;
            }


        } else{ $taught13 = null; }


        // lesson14
        $l14 = App\register::where('course_id', $course->id)->where('L14', 'A')->count();
        if ($l14 > 2) {
            
            $lesson14 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 14)->get();


            foreach ($lesson14 as $fourteen) {

                $taught14 = $fourteen->number_subsection;
            }


        } else{ $taught14 = null; }

 // lesson15
        $l15 = App\register::where('course_id', $course->id)->where('L15', 'A')->count();
        if ($l15 > 2) {
            
            $lesson15 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 15)->get();


            foreach ($lesson15 as $fiveteen) {

                $taught15 = $fiveteen->number_subsection;
            }


        } else{ $taught15 = null; }

        // lesson16
        $l16 = App\register::where('course_id', $course->id)->where('L16', 'A')->count();
        if ($l16 > 2) {
            
            $lesson16 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 16)->get();


            foreach ($lesson16 as $sixteen) {

                $taught16 = $sixteen->number_subsection;
            }


        } else{ $taught16 = null; }

        // lesson17
        $l17 = App\register::where('course_id', $course->id)->where('L17', 'A')->count();
        if ($l17 > 2) {
            
            $lesson17 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 17)->get();


            foreach ($lesson17 as $seventeen) {

                $taught17 = $seventeen->number_subsection;
            }


        } else{ $taught17 = null; }

        // lesson18
        $l18 = App\register::where('course_id', $course->id)->where('L18', 'A')->count();
        if ($l18 > 2) {
            
            $lesson18 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 18)->get();


            foreach ($lesson18 as $eighteen) {

                $taught18 = $eighteen->number_subsection;
            }


        } else{ $taught18 = null; }

        // lesson19
        $l19 = App\register::where('course_id', $course->id)->where('L19', 'A')->count();
        if ($l19 > 2) {
            
            $lesson19 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 19)->get();


            foreach ($lesson19 as $nineteen) {

                $taught19 = $nineteen->number_subsection;
            }


        } else{ $taught19 = null; }

        // lesson20
        $l20 = App\register::where('course_id', $course->id)->where('L20', 'A')->count();
        if ($l20 > 2) {
            
            $lesson20 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 20)->get();


            foreach ($lesson20 as $twenty) {

                $taught20 = $twenty->number_subsection;
            }


        } else{ $taught20 = null; }

         // lesson21
        $l21 = App\register::where('course_id', $course->id)->where('L21', 'A')->count();
        if ($l21 > 2) {
            
            $lesson21 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 21)->get();


            foreach ($lesson21 as $twentyone) {

                $taught21 = $twentyone->number_subsection;
            }


        } else{ $taught21 = null; }

        // lesson22
        $l22 = App\register::where('course_id', $course->id)->where('L22', 'A')->count();
        if ($l22 > 2) {
            
            $lesson22 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 22)->get();


            foreach ($lesson22 as $twentytwo) {

                $taught22 = $twentytwo->number_subsection;
            }


        } else{ $taught22 = null; }

        // lesson23
        $l23 = App\register::where('course_id', $course->id)->where('L23', 'A')->count();
        if ($l23 > 2) {
            
            $lesson23 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 23)->get();


            foreach ($lesson23 as $twentythree) {

                $taught23 = $twentythree->number_subsection;
            }


        } else{ $taught23 = null; }

        // lesson24
        $l24 = App\register::where('course_id', $course->id)->where('L24', 'A')->count();
        if ($l24 > 2) {
            
            $lesson24 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 24)->get();


            foreach ($lesson24 as $twentyfour) {

                $taught24 = $twentyfour->number_subsection;
            }


        } else{ $taught24 = null; }

         // lesson25
        $l25 = App\register::where('course_id', $course->id)->where('L25', 'A')->count();
        if ($l25 > 2) {
            
            $lesson25 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 25)->get();


            foreach ($lesson25 as $twentyfive) {

                $taught25 = $twentyfive->number_subsection;
            }


        } else{ $taught25 = null; }


// lesson26
        $l26 = App\register::where('course_id', $course->id)->where('L26', 'A')->count();
        if ($l26 > 2) {
            
            $lesson26 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 26)->get();


            foreach ($lesson26 as $twentysix) {

                $taught26 = $twentysix->number_subsection;
            }


        } else{ $taught26 = null; }

        // lesson27
        $l27 = App\register::where('course_id', $course->id)->where('L27', 'A')->count();
        if ($l27 > 2) {
            
            $lesson27 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 27)->get();


            foreach ($lesson27 as $twentyseven) {

                $taught27 = $twentyseven->number_subsection;
            }


        } else{ $taught27 = null; }

         // lesson28
        $l28 = App\register::where('course_id', $course->id)->where('L28', 'A')->count();
        if ($l28 > 2) {
            
            $lesson28 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 28)->get();


            foreach ($lesson28 as $twentyeight) {

                $taught28 = $twentyeight->number_subsection;
            }


        } else{ $taught28 = null; }


        // lesson29
        $l29 = App\register::where('course_id', $course->id)->where('L29', 'A')->count();
        if ($l29 > 2) {
            
            $lesson29 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 29)->get();


            foreach ($lesson29 as $twentynine) {

                $taught29 = $twentynine->number_subsection;
            }


        } else{ $taught29 = null; }

        // lesson30
        $l30 = App\register::where('course_id', $course->id)->where('L30', 'A')->count();
        if ($l30 > 2) {
            
            $lesson30 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 30)->get();


            foreach ($lesson30 as $thirty) {

                $taught30 = $thirty->number_subsection;
            }


        } else{ $taught30 = null; }





        $taught = $taught1 + $taught2 + $taught3 + $taught4 + $taught5 + $taught6 + $taught7 + $taught8 + $taught9 + $taught10 + $taught11  + $taught12  + $taught13  + $taught14  + $taught15  + $taught16  + $taught17  + $taught18  + $taught19  + $taught20  + $taught21  + $taught22  + $taught23  + $taught24  + $taught25  + $taught26 + $taught27 + $taught28 + $taught29 + $taught30 ;

 ?>
  
                 {{ number_format((float) $taught*100/$total->number_subsection, 2, '.', '') }}@endforeach, @endforeach],
                backgroundColor: [
                    "#d6f5d6",
                    "#aad088",
                    "#adebad",
                    "#85e085",
                    "#5cd65c",
                    "#33cc33",
                    "#99ebff",
                    "#66e0ff",
                    "#1ad1ff",
                    "#1ad1ff",
                    "#00ccff"
                ],
                borderColor: [
                    "#00ccff",
                    "#00ccff",
                    "#00ccff",
                    "#00ccff",
                    "#00ccff",
                    "#00ccff",
                    "#660033",
                    "#660033",
                    "#660033",
                    "#660033",
                    "#660033"
                ],
                borderWidth: .5
            },
            
        ]
    };

    //options
    var options = {
        responsive: true,
        title: {
            display: true,
            position: "top",
            text: "Bar Chart for @foreach($levels as $level){{ $level->name }}@endforeach  showing percentage covered / Course",
            fontSize: 18,
            fontColor: "#2196F3"
        },
        legend: {
            display: true,
            position: "bottom",
            labels: {
                fontColor: "#000",
                fontSize: 20
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 100
                }
            }]
        }
    };

    //create Chart class object
    var chart = new Chart(ctx, {
        type: "bar",
        data: data,
        options: options
    });
});
		</script>

		<div class="container w3-border w3-box w3-white w3-animate-opacity">
			<h4 class="w3-large"><b> Register for @foreach($levels as $level) {{ $level->name }}, @endforeach @foreach($semesters as $semester) {{ $semester->name }} @endforeach </b></h4><hr>
			<p class="w3-medium">Register according to the amount of work done</p>

				{{--<img src="/images/images.jpg" class="w3-circle" width="70" height="70"><br> --}}

				<hr class="divide">

			<div class="w3-border w3-box w3-center w3-large w3-container w3-margin">
				
				<div class="row">
			
						@foreach($levelcourses as $level) {{ $level->code }}, @endforeach

						


					<div class="row">
						<canvas id="mypiechart" class="col s12 l6 m11 w3-margin w3-padding w3-margin-top w3-margin-bottom w3-margin-right" style="width: 90%; height: 550px;"></canvas>
					</div>					
				</div>

				<div class="row">
					@foreach($levelcourses as $course)  @foreach($totalsubsection = App\Outline::select('number_subsection')->where('course_id', $course->id)->get() as $total)

               

                <?php 
 
	// lesson1
        $l1 = App\register::where('course_id', $course->id)->where('L1', 'A')->count();


        if ($l1 > 2) {
            
            $lesson1 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 1)->get();


            foreach ($lesson1 as $one) {

                $taught1 = $one->number_subsection;
            }


        } else{ $taught1 = null; }
// lesson2
        $l2 = App\register::where('course_id', $course->id)->where('L2', 'A')->count();


        if ($l2 > 2) {
            
            $lesson2 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 2)->get();


            foreach ($lesson2 as $two) {

                $taught2 = $two->number_subsection;
            }


        } else{ $taught2 = null; }

// lesson3
        $l3 = App\register::where('course_id', $course->id)->where('L3', 'A')->count();
        if ($l3 > 2) {
            
            $lesson3 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 3)->get();


            foreach ($lesson3 as $three) {

                $taught3 = $three->number_subsection;
            }


        } else{ $taught3 = null; }

// lesson4
        $l4 = App\register::where('course_id', $course->id)->where('L4', 'A')->count();
        if ($l4 > 2) {
            
            $lesson4 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 4)->get();


            foreach ($lesson4 as $four) {

                $taught4 = $four->number_subsection;
            }


        } else{ $taught4 = null; }

// lesson5
        $l5 = App\register::where('course_id', $course->id)->where('L5', 'A')->count();
        if ($l5 > 2) {
            
            $lesson5 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 5)->get();


            foreach ($lesson5 as $five) {

                $taught5 = $five->number_subsection;
            }


        } else{ $taught5 = null; }

// lesson6
        $l6 = App\register::where('course_id', $course->id)->where('L6', 'A')->count();
        if ($l6 > 2) {
            
            $lesson6 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 6)->get();


            foreach ($lesson6 as $six) {

                $taught6 = $six->number_subsection;
            }


        } else{ $taught6 = null; }
// lesson7
        $l7 = App\register::where('course_id', $course->id)->where('L7', 'A')->count();
        if ($l7 > 2) {
            
            $lesson7 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 7)->get();


            foreach ($lesson7 as $seven) {

                $taught7 = $seven->number_subsection;
            }


        } else{ $taught7 = null; }

    // lesson8
        $l8 = App\register::where('course_id', $course->id)->where('L8', 'A')->count();
        if ($l8 > 2) {
            
            $lesson8 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 8)->get();


            foreach ($lesson8 as $eight) {

                $taught8 = $eight->number_subsection;
            }


        } else{ $taught8 = null; }
// lesson9
        $l9 = App\register::where('course_id', $course->id)->where('L9', 'A')->count();
        if ($l9 > 2) {
            
            $lesson9 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 9)->get();


            foreach ($lesson9 as $nine) {

                $taught9 = $nine->number_subsection;
            }


        } else{ $taught9 = null; }
// lesson10
        $l10 = App\register::where('course_id', $course->id)->where('L10', 'A')->count();
        if ($l10 > 2) {
            
            $lesson10 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 10)->get();


            foreach ($lesson10 as $ten) {

                $taught10 = $ten->number_subsection;
            }


        } else{ $taught10 = null; }

        // lesson11
        $l11 = App\register::where('course_id', $course->id)->where('L11', 'A')->count();
        if ($l11 > 2) {
            
            $lesson11 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 11)->get();


            foreach ($lesson11 as $eleven) {

                $taught11 = $eleven->number_subsection;
            }


        } else{ $taught11 = null; }

        // lesson12
        $l12 = App\register::where('course_id', $course->id)->where('L12', 'A')->count();
        if ($l12 > 2) {
            
            $lesson12 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 12)->get();


            foreach ($lesson12 as $twelve) {

                $taught12 = $twelve->number_subsection;
            }


        } else{ $taught12 = null; }

        // lesson13
        $l13 = App\register::where('course_id', $course->id)->where('L13', 'A')->count();
        if ($l13 > 2) {
            
            $lesson13 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 13)->get();


            foreach ($lesson13 as $thirteen) {

                $taught13 = $thirteen->number_subsection;
            }


        } else{ $taught13 = null; }


        // lesson14
        $l14 = App\register::where('course_id', $course->id)->where('L14', 'A')->count();
        if ($l14 > 2) {
            
            $lesson14 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 14)->get();


            foreach ($lesson14 as $fourteen) {

                $taught14 = $fourteen->number_subsection;
            }


        } else{ $taught14 = null; }

 // lesson15
        $l15 = App\register::where('course_id', $course->id)->where('L15', 'A')->count();
        if ($l15 > 2) {
            
            $lesson15 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 15)->get();


            foreach ($lesson15 as $fiveteen) {

                $taught15 = $fiveteen->number_subsection;
            }


        } else{ $taught15 = null; }

        // lesson16
        $l16 = App\register::where('course_id', $course->id)->where('L16', 'A')->count();
        if ($l16 > 2) {
            
            $lesson16 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 16)->get();


            foreach ($lesson16 as $sixteen) {

                $taught16 = $sixteen->number_subsection;
            }


        } else{ $taught16 = null; }

        // lesson17
        $l17 = App\register::where('course_id', $course->id)->where('L17', 'A')->count();
        if ($l17 > 2) {
            
            $lesson17 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 17)->get();


            foreach ($lesson17 as $seventeen) {

                $taught17 = $seventeen->number_subsection;
            }


        } else{ $taught17 = null; }

        // lesson18
        $l18 = App\register::where('course_id', $course->id)->where('L18', 'A')->count();
        if ($l18 > 2) {
            
            $lesson18 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 18)->get();


            foreach ($lesson18 as $eighteen) {

                $taught18 = $eighteen->number_subsection;
            }


        } else{ $taught18 = null; }

        // lesson19
        $l19 = App\register::where('course_id', $course->id)->where('L19', 'A')->count();
        if ($l19 > 2) {
            
            $lesson19 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 19)->get();


            foreach ($lesson19 as $nineteen) {

                $taught19 = $nineteen->number_subsection;
            }


        } else{ $taught19 = null; }

        // lesson20
        $l20 = App\register::where('course_id', $course->id)->where('L20', 'A')->count();
        if ($l20 > 2) {
            
            $lesson20 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 20)->get();


            foreach ($lesson20 as $twenty) {

                $taught20 = $twenty->number_subsection;
            }


        } else{ $taught20 = null; }

         // lesson21
        $l21 = App\register::where('course_id', $course->id)->where('L21', 'A')->count();
        if ($l21 > 2) {
            
            $lesson21 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 21)->get();


            foreach ($lesson21 as $twentyone) {

                $taught21 = $twentyone->number_subsection;
            }


        } else{ $taught21 = null; }

        // lesson22
        $l22 = App\register::where('course_id', $course->id)->where('L22', 'A')->count();
        if ($l22 > 2) {
            
            $lesson22 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 22)->get();


            foreach ($lesson22 as $twentytwo) {

                $taught22 = $twentytwo->number_subsection;
            }


        } else{ $taught22 = null; }

        // lesson23
        $l23 = App\register::where('course_id', $course->id)->where('L23', 'A')->count();
        if ($l23 > 2) {
            
            $lesson23 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 23)->get();


            foreach ($lesson23 as $twentythree) {

                $taught23 = $twentythree->number_subsection;
            }


        } else{ $taught23 = null; }

        // lesson24
        $l24 = App\register::where('course_id', $course->id)->where('L24', 'A')->count();
        if ($l24 > 2) {
            
            $lesson24 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 24)->get();


            foreach ($lesson24 as $twentyfour) {

                $taught24 = $twentyfour->number_subsection;
            }


        } else{ $taught24 = null; }

         // lesson25
        $l25 = App\register::where('course_id', $course->id)->where('L25', 'A')->count();
        if ($l25 > 2) {
            
            $lesson25 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 25)->get();


            foreach ($lesson25 as $twentyfive) {

                $taught25 = $twentyfive->number_subsection;
            }


        } else{ $taught25 = null; }


// lesson26
        $l26 = App\register::where('course_id', $course->id)->where('L26', 'A')->count();
        if ($l26 > 2) {
            
            $lesson26 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 26)->get();


            foreach ($lesson26 as $twentysix) {

                $taught26 = $twentysix->number_subsection;
            }


        } else{ $taught26 = null; }

        // lesson27
        $l27 = App\register::where('course_id', $course->id)->where('L27', 'A')->count();
        if ($l27 > 2) {
            
            $lesson27 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 27)->get();


            foreach ($lesson27 as $twentyseven) {

                $taught27 = $twentyseven->number_subsection;
            }


        } else{ $taught27 = null; }

         // lesson28
        $l28 = App\register::where('course_id', $course->id)->where('L28', 'A')->count();
        if ($l28 > 2) {
            
            $lesson28 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 28)->get();


            foreach ($lesson28 as $twentyeight) {

                $taught28 = $twentyeight->number_subsection;
            }


        } else{ $taught28 = null; }


        // lesson29
        $l29 = App\register::where('course_id', $course->id)->where('L29', 'A')->count();
        if ($l29 > 2) {
            
            $lesson29 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 29)->get();


            foreach ($lesson29 as $twentynine) {

                $taught29 = $twentynine->number_subsection;
            }


        } else{ $taught29 = null; }

        // lesson30
        $l30 = App\register::where('course_id', $course->id)->where('L30', 'A')->count();
        if ($l30 > 2) {
            
            $lesson30 = App\taughtlesson::select('number_subsection')->where('course_id', $course->id)->where('lesson_number', 30)->get();


            foreach ($lesson30 as $thirty) {

                $taught30 = $thirty->number_subsection;
            }


        } else{ $taught30 = null; }





        $taught = $taught1 + $taught2 + $taught3 + $taught4 + $taught5 + $taught6 + $taught7 + $taught8 + $taught9 + $taught10 + $taught11  + $taught12  + $taught13  + $taught14  + $taught15  + $taught16  + $taught17  + $taught18  + $taught19  + $taught20  + $taught21  + $taught22  + $taught23  + $taught24  + $taught25  + $taught26 + $taught27 + $taught28 + $taught29 + $taught30 ;

$totall = number_format((float) $taught*100/$total->number_subsection, 2, '.', '');
       

 ?>
  
                

                 @endforeach
                 @endforeach

				</div>

			</div>	
		
		</div>
	</div>


@endsection

