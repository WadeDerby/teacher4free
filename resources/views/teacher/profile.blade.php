<div class="page-title">
	<i class="fa fa-user font-icon" aria-hidden="true"></i> PROFILE 
</div>

<div id="profile" class="page-content">
	<form class="form teacher" action="">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="currentUser" value="{{$teacher['username']}}">
	<div class="photo-form">
		<span class="photo"><img src="{{URL::to('img/profile-photo.jpg')}}" class="profile-photo"/></span>
		<span class="photo-text">Edit Profile Photo</span>
	</div>

	<div class="text-form">
		
		<span class="field"> 
			<input type="text" name="full_name" value="{{$teacher['name']}}" placeholder="" > <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="user" value="{{$teacher['username']}}" placeholder="" >  <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="phone" value="{{$teacher['phone']}}" placeholder="" > <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="institution" value="{{$teacher['institution']}}" placeholder="" > <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="email" name="email" value="{{$teacher['email']}}" placeholder="" > <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="date" name="dob" value="{{$date}}" placeholder=""> <i class="fa fa-pencil" aria-hidden="true"></i>
			<!-- {{$teacher['date_of_birth']}} -->
		</span>
	</div>
		
	</form>
	<div class="buttons">
		<button data-action='editTeacher'>DONE</button>
		<button>CANCEL</button>
	</div>
</div>