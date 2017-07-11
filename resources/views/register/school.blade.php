@extends('layouts.form-template')

@section('body')
	<form class="form-design" action="{{URL::to('register/school')}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
		<div class="input-field">
		<input  name="name" type="text"  required>
		<label for="name">School Name</label>
		</div>

		<div class="input-field">
		<input  name="location" type="text"  required>
		<label for="location">Location</label>
		</div>

		<div class="input-field">
		<input  name="age" type="text"  required>
		<label for="age">Age of School</label>
		</div>

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