@extends('layouts.form-template')

@section('body')
	<form class="form-design" action="{{URL::to('/login')}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="input-field">
		<input  name="user" type="text"  required>
		<label for="user">Username</label>
		</div>

		<div class="input-field">
		<input  name="pass" type="password"  required>
		<label for="pass">Password</label>
		</div>

		<input class="button" type="submit" value="Submit">

	</form>

@endsection