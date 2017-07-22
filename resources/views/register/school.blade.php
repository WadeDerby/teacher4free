@extends('layouts.form-template')

@section('body')

	<h3>School Registration Form</h3>
	<form class="form-design" action="{{URL::to('register/school')}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
		<div class="input-field">
			<label for="name">School Name</label>
			<input  name="name" type="text"  required>
		</div>

		<div class="input-field">
			<label for="location">Location</label>
			<input  name="location" type="text"  required>
		</div>

		<div class="input-field">
			<label for="age">Age of School</label>
			<input  name="age" type="text"  required>
			
		</div>

		<div class="input-field">
			<label for="user">Username</label>
			<input  name="username" type="text"  required>
		</div>

		<div class="input-field">
			<label for="pass">Password</label>
			<input  name="pass" type="password"  required>
		</div>

		<div class="input-button">
			<input class="button" type="submit" value="Submit">
		</div>

	</form>
@endsection