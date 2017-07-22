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
					<span class="client">Project</span>
					<span class="client-name">Project- save the homeless</span>
					<span class="description">Send your donations to Help save homeless children on the street
					</span>

					<span class="link"><a href="#">View Project</a></span>	
				</div>
			</div>
		</div>

		<div class="content">
			<div class="left two">
				
			</div><div class="right two">
				<div class="text-wrapper">
					<span class="client">Project</span>
					<span class="client-name">Daily meal project</span>
					<span class="description"> 
					Please send your donations to help feed Hungry children. This will greatly impact on their lives and help them concentrate in school.
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
					<span class="client-name">Orphanage</span>
					<span class="description">Share anything you have from toys to books to cloths to benefit the children of the future. 
					</span>

					<span class="link"><a href="#">View Project</a></span>
				</div>	
			</div>
		</div>


		<div class="content last">

			<div class="left four">
				
			</div><div class="right four">
				<div class="text-wrapper">
					<span class="client">School</span>
					<span class="client-name">Brahabebom Junior High school</span>
					<span class="description">This Project seeks to provide Stationary for the pupils of Brahabebom junior High school.</span>

					<span class="link"><a href="#">View Project</a></span>
				</div>
			</div>
		</div>
		
	</div>
	
@endsection

@section('footer')
	@include('layouts.footer')
@endsection