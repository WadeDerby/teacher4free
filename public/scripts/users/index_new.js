Actions.search = function(e) {

    e.preventDefault();
    console.log('Teachers')
    var me = $('#search-term').val();
    var value = $('#search-type').val();
    var user = $('#user').val();
    Dashboard.getView('/search?text=' + me + '&specified='+ value + '&user='+ user);


};

Actions.home = function(e) {
	e.preventDefault();
	var url = 'http://localhost:8088/';
	window.location.replace(url);
};

Actions.editSchool = function(e){
	var currentUser = $('.profile input[name=currentUser]').val();
	var userdata = {
		name: $('.profile input[name=name]').val(),
		username: $('.profile input[name=username]').val(),
		location: $('.profile input[name=location]').val(),
		age: $('.profile input[name=age]').val(),
		_token: $('.profile input[name=_token]').val()
		};

		// console.log(userdata);
	$.ajax({
                data: userdata,
                url: '' + currentUser + '/view/profile',
                type: 'post',
                success: function (response){
                    console.log(response);
                },
                error: function () { }

            });
};

Actions.editQualification = function(e){
	var currentUser = $('.qualification input[name=currentUser]').val();
	var userdata = {
		experience: $('.qualification input[name=experience]').val(),
		degree: $('.qualification input[name=degree]').val(),
		course: $('.qualification input[name=course]').val(),
		institution: $('.qualification input[name=institution]').val(),
		_token: $('.qualification input[name=_token]').val()
		};

		// console.log(userdata);
	$.ajax({
                data: userdata,
                url: '' + currentUser + '/view/qualification',
                type: 'post',
                success: function (response){
                    console.log(response);
                },
                error: function () { }

            });
};

Actions.editCourse = function(){
	var currentUser = $('#school-course-form input[name=currentUser]').val();
	var inputs = document.querySelector('#school-course-form').querySelectorAll('input[type=text], .field input[type=hidden] ')
	var coursesObj = [];
	inputs.forEach(function(input) {
            coursesObj.push({ name : input.getAttribute('name') , value : input.value });
        });
	var userdata = {
		courses: coursesObj,
		_token: $('#school-course-form input[name=_token]').val(),

	};

	$.ajax({
                data: userdata,
                url: '' + currentUser + '/view/courses',
                type: 'post',
                success: function (response){
                    // console.log(response);
                },
                error: function () { }

            });
};

Actions.editSkill = function(e){
	var currentUser = $('#school-skill input[name=currentUser]').val();
	var inputs = document.querySelector('#school-skill').querySelectorAll('input[type=text], .field input[type=hidden] ')
	var skillsObj = [];
	inputs.forEach(function(input) {
            skillsObj.push({ name : input.getAttribute('name') , value : input.value });
        });
	var userdata = {
		skills: skillsObj,
		_token: $('#school-skill input[name=_token]').val(),

	};

	$.ajax({
                data: userdata,
                url: '' + currentUser + '/view/skills',
                type: 'post',
                success: function (response){
                    // console.log(response);
                },
                error: function () { }

            });
};

Actions.addSkill = function(e){
	var input = $("<input>", {
            type: 'text',
            placeholder: 'New skill',
            name: 'skill',
            });
	console.log(e.currentTarget);
	$('#school-skill').append(input);

            // input.insertBefore($(e.currentTarget).parent('#school-skill'));
};
Actions.addCourse = function(e){
	var input = $("<input>", {
            type: 'text',
            placeholder: 'New Course',
            name: 'course',
            });
	console.log(e.currentTarget);
	$('#school-course-form').append(input);

            // input.insertBefore($(e.currentTarget).parent('#school-skill'));
};