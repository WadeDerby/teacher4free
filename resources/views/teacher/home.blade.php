<div class="page-title">
	<i class="fa fa-home font-icon" aria-hidden="true"></i> HOME 
</div>

<div class="page-content">
	<div class="group">
		<div class="square-2 card">
			<div class="card-title">
				Suggestions
			</div>
			<ul class="list-collection">
			@if(isset($schools[0]))
				@foreach($schools as $school)
				<li class="list-item">
				<span>{{$school['name']}}</span>
				<span>{{$school['contact_info']}}</span>
				</li>
				@endforeach

				@else

				<li>No suggestion yet</li>
				@endif
			</ul>
		</div>
		<div class="square-2 card">
			<div class="card-title">
				Requested
			</div>
			
		</div>
	</div>

	<div class="group">
		<div class="square-3 card">
			<div class="card-title">
				News
			</div>
			<div class="card-content">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur debitis tempore reprehenderit assumenda sed quod enim maxime hic, nisi, aut nobis, neque repudiandae totam natus, sunt odio commodi sint. Vero.
			</div>
		</div>
		<div class="square-3 card">
			<div class="card-title">
				News
			</div>
			<div class="card-content">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur debitis tempore reprehenderit assumenda sed quod enim maxime hic, nisi, aut nobis, neque repudiandae totam natus, sunt odio commodi sint. Vero.
			</div>
		</div>
		<div class="square-3 card">
			<div class="card-title">
				News
			</div>
			<div class="card-content">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur debitis tempore reprehenderit assumenda sed quod enim maxime hic, nisi, aut nobis, neque repudiandae totam natus, sunt odio commodi sint. Vero.
			</div>
		</div>
	</div>	
</div>