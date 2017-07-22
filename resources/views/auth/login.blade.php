@extends('layouts.form-template')

@section('head')
	<link rel="stylesheet" href="{{url('css/auth.css')}}"/>
@endsection

@section('body')

	<h3>Are you a registered user? Sign in.</h3>
	<form class="form-design" action="{{URL::to('/login')}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="input-field">
		<label for="user">Username</label>
		<input  name="user" type="text"  required>
		</div>

		<div class="input-field">
		<label for="pass">Password</label>
		<input  name="pass" type="password"  required>
		</div>

		<input class="button" type="submit" value="Submit">

	</form>

@endsection