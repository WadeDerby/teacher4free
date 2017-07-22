@extends('layouts.form-template')

@section('body')

	<h3>NGO Registration Form</h3>
	<form class="form-design" action="{{URL::to('register/ngo')}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="input-field">

			<label for="name">Name of Organization</label>
			<input  name="name" type="text"  required>
		</div>

		<div class="input-field">
			<label for="address">Address</label>
			<input  name="address" type="text"  required>
			
		</div>

		<div class="input-field">
			<label for="contact">Contact</label>
			<input  name="contact" type="text"  required>
		</div>

		<div class="input-field">
			<label for="email">Email</label>
			<input type="email" name="email" value="" placeholder="">
			
		</div>

		<div class="input-field">
			<label for="user">Username</label>
			<input  name="user" type="text"  required>
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