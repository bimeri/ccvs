@extends('admin.include')


@section('title', 'statistics')
@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
@endsection
@section('content')
	
		<div class="row">
		<div class="container w3-box w3-white">
			<h4> Level-Courses Statistics</h4><hr>

			<a href="departmentstatisticsview" class="right w3-btn waves-effect waves-blue w3-medium Statistics"><br>DEPARTMENTAL STATISTIC</a><br><br>

			
				<hr class="divide">


			<div class="w3-border w3-box w3-center w3-large w3-container w3-margin">

				
				<div class="row w3-padding">
		
					<form action="{{ route('admin.levelstatistics') }}" method="get" class="validate">
						{{ csrf_field() }}

						<div class="input-field offset-l3 col s6 m6 l3">
						    <select class="validate" name="Select_Level">
						      <option value="" disabled selected>Select Level</option>
						      @foreach($levels as $level)
						      <option value="{{ $level->id }}">{{ $level->name }}</option>
						      @endforeach
						    </select>
					  	</div>
					  	<br>
					  		<div class="col offset-m3 offset-s2 l3 m3 s4">
					  			<a onclick="load"><input type="submit" value="continue" class="w3-right w3-blue w3-large w3-btn waves-effect waves-blue w3-medium w3-round"></a>
					  		</div>
				  	</form>
				 </div>
			</div>	
		</div>
	</div>


@endsection
