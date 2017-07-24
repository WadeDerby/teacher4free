<div class="page-title">
	<i class="fa fa-user font-icon" aria-hidden="true"></i> 
	QUALIFICATION 
</div>

<div id="qualification" class="page-content">
	<form class="form qualification" action="">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="currentUser" value="{{$teacher['username']}}">
		@if(isset($qualification))
		<span class="field"> 
			<input type="text" name="experience" value="{{$qualification['experience']}}" placeholder="Years of experience" > <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="degree" value="{{$qualification['degree']}}" placeholder="Degree" >  <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="course" value="{{$qualification['course']}}" placeholder="Course Studied" > <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="institution" value="{{$qualification['institution']}}" placeholder="Name of institution" > <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>

		@else
			<span class="field"> 
			<input type="text" name="experience" value="" placeholder="Years of experience" > <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="degree" value="" placeholder="Degree" >  <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="course" value="" placeholder="Course Studied" > <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="institution" value="" placeholder="Name of institution" > <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		@endif
		
	</form>
	<div class="buttons">
		<button data-action='editQualification'>DONE</button>
		<button>CANCEL</button>
	</div>
</div>