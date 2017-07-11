@extends('layouts.master')


@section('head')
@endsection


@section('body')
	
	<h2>Join us!</h2>
	<p> Register 
	<span><a href="{{url('/register/teacher')}}">Teacher</a></span> 
	<span><a href="{{url('/register/school')}}">School</a></span> 
	<span><a href="{{url('/register/ngo')}}">NGO</a></span> 
	</p>
	
@endsection