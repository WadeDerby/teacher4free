<!doctype html>
<html>
	<head>
	<title>{{$school['username']}} | LTMN </title>	
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	    <meta charset="UTF-8"/>
	    <link rel="stylesheet" href="{{url('css/pub/norm.css')}}"/>
	    <link rel="stylesheet" href="{{url('css/dashboard/dashboard.css')}}"/>
	    <link rel="stylesheet" href="{{url('css/dashboard/index.css')}}"/>
	    <link rel="stylesheet" href="{{url('css/dashboard/profile.css')}}"/>
        <link rel="stylesheet" href="{{url('fonts/line-awesome/css/line-awesome-font-awesome.min.css')}}"/>
        <meta name="csrf-token" content="{{csrf_token()}}">	
	</head>
	<body>
		<section class="main-wrapper">
			<nav class="side-bar">
				<div class="profile">
					<img src="{{URL::to('img/profile-photo.jpg')}}" class="profile-photo"/>
					<span class="user-names">
						<h3>{{$school['name']}}</h3>
						<h4><span>@</span>{{$school['username']}}</h4>
					</span>
				</div>
				<ul class="collection">
					<li class="collection-items view-btn" data-href="/view/profile">
					<i class="fa fa-user font-icon" aria-hidden="true"></i>
					<span>Profile</span>
					</li>
					<li class="collection-items view-btn" data-href="/view/skills">
					<i class="fa fa-link font-icon" aria-hidden="true"></i>
					<span>Skills Needed</span>
					</li>
					<li class="collection-items view-btn" data-href="/view/courses">
					<i class="fa fa-graduation-cap font-icon" aria-hidden="true"></i>
					<span>Courses Needed</span>
					</li>
					<li class="collection-items view-btn" data-href="/view/timeline">
					<i class="fa fa-hourglass font-icon" aria-hidden="true"></i>
					<span>Timeline</span>
					</li>
					<li class="collection-items view-btn" data-href="/view/messages">
					<i class="fa fa-inbox font-icon" aria-hidden="true"></i>
					<span>Messages</span>
					</li>
					<li class="collection-items view-btn" data-href="/view/settings">
					<i class="fa fa-gears font-icon" aria-hidden="true"></i>
					<span>Settings</span>
					</li>

				</ul>
			</nav><!--  
			--><section class="content-wrap">
				<header>
					<form action="">
						<input id="search-term" type="text" name="" value="" placeholder="Search">
						<select id="search-type" name="">
							<option value="location">Skill</option>
							<option value="school">Courses</option>
						</select>
						<button data-action="search">
							<i class="fa fa-search font-icon" aria-hidden="true"></i>
						</button>
						<button data-action="home">
							<i class="fa fa-home font-icon" aria-hidden="true"></i>
						</button>
						<button class="refresh view-btn" data-href="/home" >
							<i class="fa fa-refresh font-icon" aria-hidden="true"></i>
						</button>
						
						<input type="hidden" id="user" value="2" placeholder="">
					</form>

				</header>
				<div id="content">
					@include('school.home')
				</div>
			</section>
		</section>
		<!-- <div class="notification"></div> -->
		<script src="{{url('scripts/lib/jquery.js')}}"></script>
    @include('sources.ui-extensions')
    @include('sources.animation')
    <script src="{{url('scripts/lib/dashboard.js')}}"></script>
    <script src="{{url('scripts/lib/dashboard.ui.js')}}"></script>
     <script src="{{url('scripts/users/index_new.js')}}"></script>
	</body>
	
</html>