@extends('layouts.master')


@section('head')
@endsection


@section('body')
	
	<div id='index' class="pages-content">
		<div class="banner">
		<h1 class="title">WELCOME TO LTMN SOMETHING WEBSITE </h1>
		<p class="description">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate saepe ut quo nulla a nesciunt provident fugit animi. Expedita ipsa accusantium veniam ex quia aspernatur quod atque placeat nulla iusto.

		<p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex repellendus eveniet totam velit quidem reiciendis, recusandae delectus voluptates quod vero sunt repudiandae, blanditiis tempore nobis ratione praesentium! Temporibus, distinctio, est.</p>

		</p>
		</div>
		<div class="quotes-collection">

			<span class="collection-title">Reviews from users</span>
			<div class="quotes-item">
				<span class="quote-body">
					"The thrill of reaching out to so many people is exciting. I'm glad HelpLink gives me this oppotunity"
				</span>
				<span class="quote-person">
					- John Doe(Teacher) 
				</span>
			</div>
			<div class="quotes-item">
				<span class="quote-body">
					"We have benefit greatly from the support from many volunteer teacher from HelpLink."
				</span>
				<span class="quote-person">
					- Jane Doe, Headmistress(School) 
				</span>
			</div>
		</div>
	</div>

@endsection


@section('footer')
	@include('layouts.footer')
@endsection