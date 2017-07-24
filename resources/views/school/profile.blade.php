<div class="page-title">
	<i class="fa fa-user font-icon" aria-hidden="true"></i> PROFILE 
</div>

<div id="profile" class="page-content">
	<form class="profile form" action="">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="currentUser" value="{{$school['username']}}">
	<div class="photo-form">
		<span class="photo"><img src="{{URL::to('img/profile-photo.jpg')}}" class="profile-photo"/></span>
		<span class="photo-text">Edit Profile Photo</span>
	</div>

	<div class="text-form">
		
		<span class="field"> 
			<input type="text" name="name" value="{{$school['name']}}" placeholder=""> <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="username" value="{{$school['username']}}" placeholder=""> <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="location" value="{{$school['location']}}" placeholder="">  <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="age" value="{{$school['age']}}" placeholder=""> <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		
		
	</div>
		
	</form>
	<div class="buttons">
		<button data-action='editSchool'>DONE</button>
		<button>CANCEL</button>
	</div>
</div>