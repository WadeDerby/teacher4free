@extends('layouts.master')


@section('head')
	<link rel="stylesheet" href="{{url('css/projects.css')}}"/>
@endsection


@section('body')
	<div class="pages-content">

		<div class="content">
			<div class="left one">
				
			</div><div class="right one">
				<div class="text-wrapper">
					<span class="client">NGO</span>
					<span class="client-name">Name here</span>
					<span class="description">Project Description here. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
					</span>

					<span class="link"><a href="#">View Project</a></span>	
				</div>
			</div>
		</div>

		<div class="content">
			<div class="left two">
				
			</div><div class="right two">
				<div class="text-wrapper">
					<span class="client">NGO</span>
					<span class="client-name">Name here</span>
					<span class="description">Project Description here. Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
					</span>

					<span class="link"><a href="#">View Project</a></span>
				</div>	
			</div>
		</div>

		<div class="content">
		
			<div class="left three">
				
			</div><div class="right three">
				<div class="text-wrapper">
					<span class="client">NGO</span>
					<span class="client-name">Name here</span>
					<span class="description">Project Description here. Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
					</span>

					<span class="link"><a href="#">View Project</a></span>
				</div>	
			</div>
		</div>


		<div class="content last">

			<div class="left four">
				
			</div><div class="right four">
				<div class="text-wrapper">
					<span class="client">NGO</span>
					<span class="client-name">Name here</span>
					<span class="description">Project Description here. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>

					<span class="link"><a href="#">View Project</a></span>
				</div>
			</div>
		</div>
		
	</div>
	
@endsection

@section('footer')
	@include('layouts.footer')
@endsection