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
					"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, veritatis magni obcaecati dignissimos pariatur eius ullam assumenda."
				</span>
				<span class="quote-person">
					- John Doe(Teacher) 
				</span>
			</div>
			<div class="quotes-item">
				<span class="quote-body">
					"Nisi sit dolore labore provident, voluptatem odio officia praesentium ea optio ducimus."
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