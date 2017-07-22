@extends('layouts.form-template')

@section('body')
	
	<h3>Teacher Registration Form</h3>
	<form class="form-design" action="{{URL::to('register/teacher')}}" method="post">

		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="input-field">
			<label for="name">Full Name</label>
			<input  name="name" type="text" placeholder="e.g Waheed Derby"  required>
		</div>

		<div class="input-field">
			<label for="username">Username</label>
			<input type="text" name="username" value="" placeholder="use lowercase" required>
			
		</div>

		<div class="input-field">
			<label for="inst">Institution</label>
			<input  name="inst" type="text" placeholder="where you schooled" required>
		</div>

		<div class="input-field">
			<label for="dob">Date Of Birth</label>
			<input type="date" name="dob" value="" placeholder="dd/mm/yy " required>	
		</div>

		<div class="input-field">
			<label for="email">Email</label>
			<input type="email" name="email" value="" placeholder="e.g email@example.com" required>
		</div>

		<div class="input-field">
			<label for="phoneNo">Phone Number</label>
			<input type="text" name="phoneNo" value="" placeholder="(xxx) - xxx -xxx - xxxx" required>
			
		</div>

		<div class="input-field">
			<label for="skills">Skills</label>
			<textarea name="skills" id="" cols="30" rows="5"></textarea>
		</div>		


		<div class="input-field">
			<label for="pass">Password</label>
			<input type="password" name="pass" value="" placeholder="" required>
			
		</div>

		<div class="input-field">
			<label for="pass">Confirm password</label>
			<input type="password" name="pass" value="" placeholder="" required>	
		</div>

		<div class="input-button">
			<input class="button" type="submit" value="Submit">
		</div>
	</form>
@endsection