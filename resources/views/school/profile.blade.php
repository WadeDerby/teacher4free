<div class="page-title">
	<i class="fa fa-user font-icon" aria-hidden="true"></i> PROFILE 
</div>

<div id="profile" class="page-content">
	<form class="form" action="">
	<div class="photo-form">
		<span class="photo"><img src="{{URL::to('img/profile-photo.jpg')}}" class="profile-photo"/></span>
		<span class="photo-text">Edit Profile Photo</span>
	</div>

	<div class="text-form">
		
		<span class="field"> 
			<input type="text" name="name" value="" placeholder=""> <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="institution" value="" placeholder="">  <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="phone" value="" placeholder=""> <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="text" name="user" value="" placeholder=""> <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
		<span class="field">
			<input type="date" name="" value="" placeholder=""> <i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
	</div>
		
	</form>
	<div class="buttons">
		<button>DONE</button>
		<button>CANCEL</button>
	</div>
</div>