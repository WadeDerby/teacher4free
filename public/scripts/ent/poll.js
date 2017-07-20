var quizObj = [],
    pollsObj = [],
    lipollID = 0,
    liquizID = 0,
    editPollID,
    pollCount = 2,
    quizCount = 2,
    pollId = 3,
    POLL_MAX_COUNT = 3,
    QUIZ_MAX_COUNT = 3,
    quizId = 3;

$(document).on('click', 'li.question-item', function(){
    editPollID = $(this).attr('id');
    Poll.showEditButtons();
    Poll.editMultiplePoll($(this).attr('id'));
});

var Quiz = {
    addQuestion: function(form){
        var inputs = document.querySelector('.quiz-form').querySelectorAll('fieldset > input[type=text] , .fieldset input[type=hidden] , .fieldset input[type=text]')
        var quiz = [];
        inputs.forEach(function(input) {
            quiz.push({ name : input.getAttribute('name') , value : input.value });
        });
        var index = $("input[name=answer]:checked").val();
        quiz.push({name : 'answer' , value : quiz[index].value  });
        var snip = $('.quiz-question')[0].value + "<i class=\"fa fa-clock-o\"></i>" + "<i class=\"fa fa-clock-o\"></i>";
        $('.question-snippet').append('<li>' + snip  + '</li>');
        Dashboard.sanitizeForm();
        return quiz;
      
    },

    addQuestionToQuiz: function () {
        var textarea = $('.quiz-question');
        var form  = document.getElementsByClassName('quiz-form');

        if (textarea.val().trim() != '') {
           val = Quiz.addQuestion(form);
           quizObj.push(val);
        } else {
            textarea.velocity('callout.shake');
        }
    },
    
    addOptionToQuiz: function (e) {
        if (quizCount < QUIZ_MAX_COUNT) {
            var inputText = $("<input>", {
                type: 'text',
                placeholder: 'Option',
                class: 'left-border quiz-option',
                name: 'opinion',
                id: 'quiz-opinion' +quizId ,
                required: 'true' ,
            }),
            inputRadio = $("<input>", {
                type: 'radio',
                class: 'radio-button',
                name: 'answer',
                value: quizId,
            });
           $('#rad' + quizId + '').append(inputRadio);
           $('#opt' + quizId + '').append(inputText);
           ++quizId;
           if(quizCount == (QUIZ_MAX_COUNT - 1)){
                Poll.disableOptionsButton();
            }
        }else{
            Quiz.disableOptionsButton();
        }
        ++quizCount;
    },
    disableOptionsButton: function(){
        $('#add-Quiz-Option-btn').addClass('disabled');
    },
    showEditButtons :function (){
        console.log('Edit buttons enabled');
    },
    removeEditButtons: function(){
        console.log('Remove edit buttons');
    }
};

var Poll = {
    addMultiplePoll: function(form){

        var inputs = document.querySelector('.multiple-poll-form').querySelectorAll('fieldset > input[type=text] , .fieldset input[type=hidden] , .fieldset input[type=text]')
        var poll = [];
        inputs.forEach(function(input) {
            poll.push({ id : input.getAttribute('id') ,name : input.getAttribute('name') , value : input.value });
        });
        // var snip =  "<span class=\"text\">"+  + "</span>" + buttons;
        var list = "<li class=\"question-item\" id=\"" + lipollID+  "\">"+ $('.poll-question')[0].value + "</li>";
        $('.question-snippet').append(list);
        ++lipollID;
        Dashboard.sanitizeForm();
        return poll;   
    },
    editMultiplePoll: function(id){

        var editable = pollsObj[id];
        var scope,
            duration;
        console.log(editable);
        editable.forEach(function(input) {
            if(input.name == 'days'){
                duration = input.value;
            }else if(input.name == 'privacy'){
                scope = input.value;
            }else{
                $("#" +input.id).val(input.value);
            }
        });
        console.log($('.multiple-poll-form input[name=days]').val(duration));
        console.log($('.multiple-poll-form input[name=privacy]').val(scope));
        var sth = $('.multiple-poll-form .placeholder');
        sth[0].innerHTML = $('.multiple-poll-form .option[data-value=' + duration + ']')[0].innerText; 
        sth[1].innerHTML = $('.multiple-poll-form .option[data-value=' + scope  + ']')[0].innerText; 
    
        return true;
    },
    saveEditedPoll: function(pollID){

        var inputs = document.querySelector('.multiple-poll-form').querySelectorAll('fieldset > input[type=text] , .fieldset input[type=hidden] , .fieldset input[type=text]')
        var poll = [];
        inputs.forEach(function(input) {
            poll.push({ id : input.getAttribute('id') ,name : input.getAttribute('name') , value : input.value });
        });
        pollsObj[pollID] = poll;
        $("#"+pollID+".question-item")[0].innerText = 'Lorem';
        $("#"+pollID+".question-item")[1].innerHTML = $('.poll-question')[0].value;
        Poll.normalizeForm();
        Poll.removeEditButtons();
    },
    deletePoll: function(pollID){
        delete pollsObj[pollID];
        $("#"+pollID+".question-item").remove();
        Poll.normalizeForm();
        Poll.removeEditButtons();
        
    }, 
    addQuestion : function() {

        var textarea = $('.poll-question');
        var form  = document.getElementsByClassName('.multiple-poll-form');

        if (textarea.val().trim() != '') {
           val = Poll.addMultiplePoll(form);
           pollsObj.push(val);
           Poll.normalizeForm();
        } else {
            textarea.velocity('callout.shake');
        }

    },
    addOptiontoPoll : function (e) {
        if (pollCount < POLL_MAX_COUNT) {
            var input = $("<input>", {
            type: 'text',
            placeholder: 'New option',
            class: 'left-border',
            name: 'opinion',
            id: 'poll-opinion' + pollId ,
            });
            input.insertBefore($(e.currentTarget).parent('.buttonset'));
            ++pollId;
            if(pollCount == (POLL_MAX_COUNT - 1)){
                Poll.disableOptionsButton();
            }
        }else{
            Poll.disableOptionsButton();
        }
        ++pollCount;
    },
    disableOptionsButton: function(){
        $('#add-Poll-Option-btn').addClass('disabled');
    },
    showEditButtons :function (){
        $("#add-Poll-btn ").addClass('hidden');
        $("#edit-Poll-btn ").removeClass('hidden');
        $("#delete-Poll-btn ").removeClass('hidden');
        // console.log('Remove edit buttons');
    },
    removeEditButtons: function(){
        $("#add-Poll-btn ").removeClass('hidden'); 
        $("#edit-Poll-btn ").addClass('hidden');
        $("#delete-Poll-btn ").addClass('hidden');
    },
    normalizeForm : function(){
        Dashboard.sanitizeForm();
        $('.multiple-poll-form span.placeholder')[0].innerText = 'Quiz Ends';
        $('.multiple-poll-form span.placeholder')[1].innerText = 'Scope';
        // console.log('Does normalizing as well');
    }

};

Actions.openOptionPanel = function(e) {
    Modal.show('create-option-panel');
};

Actions.openNewPoll = function(e) {
    Modal.show('create-poll-panel');
};
Actions.openMultiplePolls = function(e) {
    Modal.show('create-multiple-poll-panel');
};

Actions.openNewQuiz = function(e) {
    Modal.show('create-quiz-panel');
};
Actions.savePoll = function() {
    Actions.create('dashboard/action/submit/poll');
};

Actions.saveQuiz = function() {
    postUrl = 'dashboard/action/submit/quiz';
    var userdata = {
        quizzes: quizObj,
        _token: $('#kqr').val(),
        };
    $.ajax({
                data: userdata,
                url: postUrl,    
                type: 'post',
                success: function (response){
                    console.log(response);                    
                },
                error: function (response) {
                    console.log(response); 
                }
            });
};

Actions.saveMultiplePoll = function() {
    postMulitplePoll();
};

Actions.addQuestionToPoll = function(e) {
    e.preventDefault();
    Poll.addQuestion();

    // console.log('Check the length of the input fied and jey some');

    
}
Actions.editPoll= function(e){
    e.preventDefault();
    Poll.saveEditedPoll(editPollID);
};

Actions.deletePoll = function(e){
    e.preventDefault();
    Poll.deletePoll(editPollID);
}

Actions.addQuestionToQuiz = function(e) {
    e.preventDefault();

    console.log('Check the length of the input fied and jey some');
    Quiz.addQuestionToQuiz();

    
};
Actions.addQuizOption = function(e) {

    e.preventDefault();
    Quiz.addOptionToQuiz(e);
};
Actions.addPollOption = function(e) {
    e.preventDefault();

    Poll.addOptiontoPoll(e);


}
function postMulitplePoll () {
    postUrl = 'dashboard/action/submit/polls';
    var userdata = {
        polls: pollsObj,
        _token: $('#kqr').val(),
        };
    $.ajax({
                data: userdata,
                url: postUrl,    
                type: 'post',
                success: function (response){
                    console.log(response);                    
                },
                error: function (response) {
                    console.log(response); 
                }
            }); 
}