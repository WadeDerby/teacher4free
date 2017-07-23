<div class="page-title">
	<i class="fa fa-link font-icon" aria-hidden="true"></i> COURSES
</div>

<div class="page-content">
	<form id="course-form" class="form" action="">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="currentUser" value="{{$teacher['username']}}">
		@if($courses->count() > 0)
		@foreach($courses as $course)
		<span class="field"> 
			<input type="text" name="{{$course['id']}}" value="{{$course['course']}}" placeholder=""> <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		@endforeach
		

		@else
			<input type="text" name="course" value="" placeholder="">  
			<input type="text" name="course" value="" placeholder="">  
		@endif

		
	</form>
	<button data-action='addCourse' id="add"><i class="fa fa-plus" aria-hidden="true"></i>Add Course</button>
	<div class="buttons">
		<button data-action='editCourse'>DONE</button>
		<button>CANCEL</button>
	</div>
	
</div>