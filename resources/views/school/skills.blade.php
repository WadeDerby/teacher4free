<div class="page-title">
	<i class="fa fa-link font-icon" aria-hidden="true"></i> SKILLS
</div>

<div class="page-content">
	<form id="school-skill" class="form" action="">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="currentUser" value="{{$school['username']}}">
		@if($skills->count() > 0)
		@foreach($skills as $skill)
		<span class="field"> 
			<input type="text" name="{{$skill['id']}}" value="{{$skill['skill']}}" placeholder=""> <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		@endforeach
		

		@else
			<input type="text" name="skill" value="" placeholder="">  
			<input type="text" name="skill" value="" placeholder="">  
		@endif


		
	</form>
	</form>
	<button data-action='addSkill' id="add"><i class="fa fa-plus" aria-hidden="true"></i>Add Skill</button>
	<div class="buttons">
		<button data-action='editSkill'>DONE</button>
		<button>CANCEL</button>
	</div>
	
</div>