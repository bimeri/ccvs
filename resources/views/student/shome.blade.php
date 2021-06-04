@extends('student.sinclude')

@section('title', 'Student-home')

@section('style')
<link rel="icon" href="{{URL::asset('/images/index.png')}}" type="image/x-icon">
<style type="text/css">
	body{
		overflow-y: hidden !important;
	}
</style>
@endsection


@section('content')
@if(isset(Auth::user()->id))
@include('file.message')




@else
<script type="text/javascript">
	window.location = '/slogin';
</script>
@endif
@endsection
