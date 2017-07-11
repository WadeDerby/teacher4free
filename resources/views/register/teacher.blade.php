@extends('layouts.form-template')

@section('body')
	<form class="form-design" action="{{URL::to('register/teacher')}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="input-field">
		<input  name="name" type="text"  required>
		<label for="name">Full Name</label>
		</div>

		<div class="input-field">
		<input  name="inst" type="text"  required>
		<label for="inst">Institution</label>
		</div>

		<div class="input-field">
			<input type="date" name="dob" value="" placeholder="">
			<label for="dob">Date Of Birth</label>
		</div>

		<div class="input-field">
			<input type="email" name="email" value="" placeholder="">
			<label for="email">Email</label>
		</div>

		<div class="input-field">
			<input type="text" name="phoneNo" value="" placeholder="">
			<label for="phoneNo">Phone Number</label>
		</div>

		
		<textarea name="skills" id="" cols="30" rows="10"></textarea>
		<label for="skills">Skills</label>
		

		<div class="input-field">
			<input type="text" name="username" value="" placeholder="">
			<label for="username">Username</label>
		</div>

		<div class="input-field">
			<input type="password" name="pass" value="" placeholder="">
			<label for="pass">Password</label>
		</div>

		<input class="button" type="submit" value="Submit">
	</form>
@endsection