<div class="page-title">
	<i class="fa fa-link font-icon" aria-hidden="true"></i> SKILLS
</div>

<div class="page-content">
	<form id="skill-form" class="form" action="">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="currentUser" value="{{$teacher['username']}}">
		@foreach($skills as $skill)
		<span class="field"> 
			<input type="text" name="{{$skill['id']}}" value="{{$skill['skill']}}" placeholder=""> <i class="fa fa-pencil" aria-hidden="true"></i>	
		</span>
		@endforeach

		
	</form>
	<button data-action='addSkill' id="add"><i class="fa fa-plus" aria-hidden="true"></i>Add Skill</button>
	<div class="buttons">
		<button data-action="editSkill">DONE</button>
		<button>CANCEL</button>
	</div>
	
</div>