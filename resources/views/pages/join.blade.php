@extends('layouts.master')


@section('head')

@endsection


@section('body')
	

	<div id="join" class="pages-content">
		<div class="title">
			JOIN US
		</div>
		<div class="description">
			Are you a volunteer? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores soluta nostrum sint dolore.
		</div>

		<div class="register">
			<div class="text">Register now! </div>

			<span class="users">
				<a href="{{url('/register/teacher')}}">Teacher</a>
			</span> 
			<span class="users">
				<a href="{{url('/register/school')}}">School</a>
			</span> 
			<span class="users">
				<a href="{{url('/register/ngo')}}">NGO</a>
			</span>

		</div>
	</div>
	
	
@endsection

@section('footer')
	@include('layouts.footer')
@endsection
