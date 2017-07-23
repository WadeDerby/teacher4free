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

Actions.editTeacher = function(e){
	var currentUser = $('.teacher input[name=currentUser]').val();
	var userdata = {
		name: $('.teacher input[name=full_name]').val(),
		username: $('.teacher input[name=user]').val(),
		phone: $('.teacher input[name=phone]').val(),
		school: $('.teacher input[name=institution]').val(),
		date: $('.teacher input[name=dob]').val(),
		email: $('.teacher input[name=email]').val(),
		_token: $('.teacher input[name=_token]').val()
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
	var currentUser = $('#course-form input[name=currentUser]').val();
	var inputs = document.querySelector('#course-form').querySelectorAll('input[type=text], .field input[type=hidden] ')
	var coursesObj = [];
	inputs.forEach(function(input) {
            coursesObj.push({ name : input.getAttribute('name') , value : input.value });
        });
	var userdata = {
		courses: coursesObj,
		_token: $('#course-form input[name=_token]').val(),

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
	var currentUser = $('#skill-form input[name=currentUser]').val();
	var inputs = document.querySelector('#skill-form').querySelectorAll('input[type=text], .field input[type=hidden] ')
	var skillsObj = [];
	inputs.forEach(function(input) {
            skillsObj.push({ name : input.getAttribute('name') , value : input.value });
        });
	var userdata = {
		skills: skillsObj,
		_token: $('#skill-form input[name=_token]').val(),

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
	$('#skill-form').append(input);

            // input.insertBefore($(e.currentTarget).parent('#skill-form'));
};
Actions.addCourse = function(e){
	var input = $("<input>", {
            type: 'text',
            placeholder: 'New Course',
            name: 'course[]',
            });
	console.log(e.currentTarget);
	$('#course-form').append(input);

            // input.insertBefore($(e.currentTarget).parent('#skill-form'));
};