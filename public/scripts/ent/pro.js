Global.afterView = function() {
    SelectBox.init();
};

var Survey = {
    currentQuestion: -1,
    qSnips: $('.q-snips'),
    modal: $('#survey-modal'),
    questions: {
        initEdit: function(target) {
            // Handlers.handleQTextareaKeypress(e);

            $('.add-q').removeClass('shows');
            $('.q-menu').addClass('shows');

            var id = $(target).data('question'),
                qText = $('.q-inputs').find('[data-question=' + id + ']').val(),
                desc = $('.q-desc-inputs').find('[data-question=' + id + ']').val(),
                type = $('.q-type-inputs').find('[data-question=' + id + ']').val();

            $('.question-textarea').val(qText);
            $('.question-desc').val(desc);
            $('.qt-btn').filter('[data-value=' + type + ']').trigger('click');

            if (Survey.assertOptionable(type)) {
                var setOpts = $('.q-opts-inputs').find('[data-question=' + id + ']');

                switch (Number.parseInt(type)) {
                    case 2:
                    case 4:
                        var qOptions = $(".q-opt-wrap");

                        // foreach hidden option create or fill existing qoption with values
                        for (var i = 0; i < setOpts.length; i++) {
                            if (qOptions[i]) {
                                qOptions[i].querySelector('.q-option').value = setOpts[i].value;
                            } else {
                                qOptions
                                    .first()
                                    .clone()
                                    .insertAfter(qOptions.last())
                                    .find('.q-option')
                                    .val(setOpts[i].value);
                            }
                        }
                        break;

                    case 3:
                        var option = $('[data-name=smart_list]').find('.option[data-value=' + setOpts.val() + ']')
                        option.trigger('click');
                        break;

                    case 7:
                        $('.sc-f-s').find('.option[data-value=' + setOpts[0].value + ']').trigger('click');
                        $('.sc-t-s').find('.option[data-value=' + setOpts[1].value + ']').trigger('click');
                        $('.sc-tp-s').find('.option[data-value=' + setOpts[2].value + ']').trigger('click');
                        break;
                }
            }

        },
        update: function() {
            var qsnip = $('.q-snips li.active');

            var id = qsnip.data('question'),
                qText = $('.question-textarea').val().trim(),
                desc = $('.question-desc').val().trim(),
                tv = $('.qt-btn.active').data('value');

            // Replace values of question textarea, description, type
            $('.q-inputs').find('[data-question=' + id + ']').val(qText);
            $('.q-type-inputs').find('[data-question=' + id + ']').val(tv);

            // Update the snippet text
            qsnip.text((qText.length > 39) ? qText.substring(0, 38) + ' ..' : qText);

            var hdesc = $('.q-desc-inputs').find('[data-question=' + id + ']');

            // If there is no hidden description input, create one
            if (hdesc.length == 0) {
                var descInp = $("<input>", {
                    name: 'question[' + id.substring(1, id.length) + '][desc]',
                    type: 'hidden',
                    class: 'qt-ds',
                    'data-question': id
                });

                $('.q-desc-inputs').append(descInp);
                descInp.val(desc);
            } else hdesc.val(desc)

            // If there are options in updates
            if (Survey.assertOptionable(tv)) {
                $('.q-opts-inputs').find('[data-question=' + id + ']').remove();
                Survey.addOptionsToQuestion(tv, id);
            }

            Survey.cleanUpForm();
        },
        delete: function() {
            var node = $('.q-snips li.active'),
                id = node.data('question');

            $('.q-inputs').find('[data-question=' + id + ']').remove();
            $('.q-desc-inputs').find('[data-question=' + id + ']').remove();
            $('.q-opts-inputs').find('[data-question=' + id + ']').remove();
            $('.q-type-inputs').find('[data-question=' + id + ']').remove();
            node.remove();

            Survey.cleanUpForm();

            // Update total question count
            Survey.updateTotalQCount();
        },
        move: function(li, dir) {
            var input = $('.q-inputs').find('[data-question=' + li.data('question') + ']');

            if (dir == 'up' && !li.is(':first-child')) {
                input.insertBefore(input.prev());
                li.insertBefore(li.prev());

            } else if (dir == 'down' && !li.is(':last-child')) {
                li.insertAfter(li.next());
                input.insertAfter(input.next());
            }
        }
    },
    assertOptionable: function(tv) {
        return (tv == 2 || tv == 3 || tv == 4 || tv == 7 || tv == 8);
    },
    updateTotalQCount: function() {
        var total = $('.q-snips li').length;
        $('#qcounts').text(total);
    },
    addQuestion: function(form) {
        var cq = ++this.currentQuestion,
            type = $('.qt-btn.active'),
            qText = $('.question-textarea').val().trim(),
            qDesc = $('#survey-questions-form .question-desc').val().trim();

        var input = $("<input>", {
                name: 'question[' + cq + '][text]',
                type: 'hidden',
                class: 'qt-in',
                'data-question': 'q' + cq
            }),
            typeInp = $("<input>", {
                name: 'question[' + cq + '][type]',
                type: 'hidden',
                'data-question': 'q' + cq
            }),
            qsnip = $("<li>", {
                text: (qText.length > 39) ? qText.substring(0, 38) + ' ..' : qText,
                'data-question': 'q' + cq
            });

        $('.q-type-inputs').append(typeInp);
        typeInp.val(type.data('value'));

        // If question has description
        if (qDesc.length != 0) {
            var descInp = $("<input>", {
                name: 'question[' + cq + '][desc]',
                type: 'hidden',
                class: 'qt-ds',
                'data-question': 'q' + cq
            });
            $('.q-desc-inputs').append(descInp);
            descInp.val(qDesc);
        }

        var tv = Number.parseInt(typeInp.val());
        if (this.assertOptionable(tv)) {
            this.addOptionsToQuestion(tv);
        }

        if ($('.create-survey-sec-btn').length == 0) {
            var button = $("<button>", {
                class: 'create-survey-sec-btn',
            });

            /** Insert new section button if not present in DOM*/
            button.insertAfter(this.qSnips.last()).html("<i class='fa fa-plus'></i>new section");

            button.click(function(event) {
                event.preventDefault();
                Survey.cleanUpForm();

                var last = $('ol.q-snips').last();

                /** Create a new list ordered list and insert after last snips*/
                var hInput = $("<input>", {
                        type: 'hidden',
                    }),
                    length = $('ol.q-snips').length,
                    ol = $("<ol>", {
                        class: 'q-snips active'
                    });

                if (length == 1) {
                    hInput.attr({
                        'data-group': 1,
                        name: 'group[1][count]',
                        value: last.find('li').length
                    }).insertAfter('.q-inputs');

                    last.attr('data-group', 1);
                    $('.sec-title').first().show();
                }

                // Clone and insert a placeholder section title
                $('.q-snips').removeClass('active');
                $('.sec-title')
                    .last()
                    .clone()
                    .insertAfter(last)
                    .find('input')
                    .attr({
                        name: 'group[' + (length + 1) + '][title]'
                    })
                    .val('Untitled Section');

                ol.insertAfter($('.sec-title').last()).attr({
                    'data-group': length + 1,
                });

                hInput.clone().attr({
                    'data-group': length + 1,
                    name: 'group[' + (length + 1) + '][count]',
                    value: 0
                }).insertAfter('.q-inputs');

                $(this).addClass('hide');
            });

        } else if ($('.create-survey-sec-btn').hasClass('hide')) {
            $('.create-survey-sec-btn').removeClass('hide');
        }

        // Insert snippet and Handle groupings
        var active = $('.q-snips.active');
        var node = active.length ? active : $('.q-snips').last();

        node.velocity({
            height: '+=24'
        }, {
            duration: 200,
            complete: function() {
                if (active.length) {
                    active.append(qsnip);

                    var group = qsnip.parent().data('group'),
                        length = qsnip.siblings('li').length + 1;

                    /*Set the group length*/
                    $('input[data-group=' + group + ']').val(length);

                } else {
                    node.append(qsnip);
                }

                $('.q-snips .move-tools').first().clone().appendTo(qsnip);

                // Update total question count
                Survey.updateTotalQCount();
            }
        });

        // Inserting the question text hidden input
        if (qsnip.prev('li').length) {
            var id = qsnip.prev().data('question');
            input.insertAfter($('.q-inputs input[data-question=' + id + ']')).val(qText);

        } else {
            $('.q-inputs').append(input);
            input.val(qText);
        }

        $('.q-snips li').removeClass('active');
        /** Do some clean up */
        Survey.cleanUpForm();
    },
    addOptionsToQuestion: function(type, id) {
        switch (type) {
            case 3:
                var setOpts = $('input[name=smart_list]');
                break;
            case 7:
                var setOpts = $('input[name=scale]');
                break;
            case 2:
            case 4:
                var setOpts = $('input.q-option');
                break;
            case 8:
                var setOpts = $('input[name=allow_ftype]:checked,input[name=max_file_size]');
                break;
        }

        var cq = id ? id.substring(1, id.length) : this.currentQuestion,
            container = $("<div>", {
                class: 'q-opts-inputs',
            });

        $('#survey-questions-form').append(container);

        setOpts.each(function(index, opt) {
            var input = $("<input>", {
                name: 'question[' + cq + '][option][]',
                type: 'hidden',
                class: 'qopt-in',
                'data-question': 'q' + cq,
                value: opt.value
            });

            container.append(input);
        });
    },
    deleteQuestionOption: function(node) {
        // Delete the selected option, this removes the wrapper from the DOM 
        var wrapper = node.parents('.q-opt-wrap');

        if (!wrapper.is(':first-child,:nth-child(2)')) {
            wrapper.remove();
        }
    },
    prepareSummary: function() {
        var placeholders = ['.s-title', '.s-description', '.s-questions', '.s-scope', '.s-closes', '.s-tags'];

        function replace(placeholder, text) {
            $(placeholder).text(text);
        }

        replace('.s-title', this.modal.find('[name=title]').val());
        replace('.s-description', this.modal.find('[name=description]').val());
        replace('.s-questions strong', this.modal.find('.qt-in').length);
        replace('.s-scope', this.modal.find('[name=scope]').val());
        replace('.s-closes', 'Closes in ' + this.modal.find('[name=closes]').val() + ' week');
    },
    cleanUpForm: function() {
        $('.question-textarea').val('');
        $('#survey-questions-form .question-desc').val('');
        $('.q-opt-wrap')
            .find('.q-option')
            .val('')
            .end()
            .filter(':gt(1)')
            .remove();

        SelectBox.init($('.answer-wrapper div.select'));

        if ($('.toggle-switch').hasClass('on')) {
            $('label[for=nr]').trigger('click');
        }
        $('.qt-btn').first().trigger('click');
        $('.add-q').addClass('shows');
        $('.q-menu').removeClass('shows');
    },
    save: function() {
        Notification.Spinner.init();
        Actions.create(function() {
            Notification.Spinner.stop();
        });
    }
};

Dashboard.getView.extend = function(xhr) {
    xhr.onprogress = function(e) {
        if (e.lengthComputable) {
            var percentComplete = 50 + (e.loaded / e.total) * 50;

            ProgressBar.move(percentComplete);
        } else {
            console.log('Unable to compute progress information');
            ProgressBar.move(100);
        }
    }
    xhr.onerror = function(e) {
        ProgressBar.error();
    }
    xhr.onloadstart = function() {
        ProgressBar.move(50);
    }
    xhr.onreadystatechange = function(e) {
        Dashboard.viewReadyStateChange(xhr);
        Modal.init();
        var message;
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status != 200) {
            ProgressBar.error();
            switch (xhr.status) {
                case 401:
                    message = 'Sorry, this feature is not enabled for your account.';
                    break;
                case 404:
                    message = "Sorry, we couldn't find the page your're trying to access.";
                    break;
                default:
                    message = 'Sorry, the service is currently unavailable.';
            }
            Notification.show(message, 4000);
        }
    }
}

// Actions

Actions.openSmartTemplates = function(e) {
    $('#create-new-panel > h1').hide();
    $('#ccn')
        .find('.type')
        .text($(e.currentTarget).find('.action-text').text())
        .end()
        .show();
    jQuery('#create-new-panel .group').hide();

    jQuery('.group.smart-templates')
        .show()
        .find('.card')
        .velocity('transition.expandIn', {
            stagger: 100,
            display: null
        });
};

Actions.switchQuestionType = function(target) {
    var type = $(target);
    var typeValue = type.data('value');

    type.addClass('active').siblings().removeClass('active');
    $('.answer-wrapper>div').hide().removeClass('show');

    if ($.inArray(typeValue, [2, 4, 3, 7, 8]) != -1) {

        if (typeValue == 2 || typeValue == 4) {
            $('.opts-wrapper').velocity('transition.fadeIn').addClass('show');
        } else if (typeValue == 3) {
            $('.dropdown-wrapper').velocity('transition.fadeIn').addClass('show');
        } else if (typeValue == 7) {
            $('.scale-wrapper').velocity('transition.fadeIn').addClass('show');
        } else if (typeValue == 8) {
            $('.file-wrapper').velocity('transition.fadeIn').addClass('show');
        }
    }
}

Actions.addOptionField = function(e) {
    e.preventDefault();
    var last = $('.q-opt-wrap').last();
    last.clone().insertAfter(last).find('.q-option').val('');
}

Actions.addOption = function(e) {
    e.preventDefault();

    var input = $("<input>", {
        type: 'text',
        placeholder: 'New option',
        class: 'left-border',
        name: 'opinion[]',
    });
    input.insertBefore($(e.currentTarget).parent('.buttonset'));
}

Actions.addQuestionToSurvey = function(e) {
    e.preventDefault();
    var textarea = $('.question-textarea');

    if (textarea.val().trim() != '') {
        Survey.addQuestion();
    } else {
        textarea.velocity('callout.shake');
    }
}

Actions.updateQuestion = function(e) {
    Survey.questions.update();
}

Actions.deleteQuestion = function(e) {
    Survey.questions.delete();
}

Actions.saveSurvey = function() {
    Survey.save();
}

Actions.traverseGuideUp = function() {
    var article = $('article.active');

    article.velocity({
        marginTop: '+=' + (article.height() + 48)
    });
}

Actions.traverseGuideDown = function() {
    var article = $('article.active');

    article.velocity({
        marginTop: '-=' + (article.height() + 48)
    });
}

Actions.showFileTypes = function() {
    $('.allow-f-types').velocity('transition.expandIn', {
        duration: 250
    });
}

//Handlers

Handlers.handleQTextareaKeypress = function(e) {
    var l = $(e.target).val().length;
    if (l > 53) {
        if (!$(e.target).hasClass('auto-height')) {
            $(e.target).addClass('auto-height');
        }
    } else if ($(e.target).hasClass('auto-height')) {
        $(e.target).removeClass('auto-height');
    }
}

//Bindings
jQuery(document).ready(function() {

    Events.bind('click', '.modal-wrapper', '.smart-templates .card', function(e) {
        Modal.show('survey-modal');
    });

    Events.bind('click', '.modal', '.next.to-final', function(e) {
        Survey.prepareSummary();
    });

    //Mouse over and mouseout event on question type buttons.
    Events.bind('mouseover', '.body[data-section=questions]', '.qt-btn', function(e) {
        type = $(this);
        $('.qt-tt').text(type.attr('title'));
    });

    Events.bind('mouseout', '.body[data-section=questions]', '.qt-btn', function(e) {
        $('.qt-tt').text($('.qt-btn.active').attr('title'));
    });

    Events.bind('click', '.modal-wrapper', '.move-tools .tool', function(e) {
        Survey.questions.move($(this).parents('li'), $(this).data('dir'));
        e.stopImmediatePropagation();

    });

    Events.bind('focusout', '.body[data-section=description]', '[name=title]', function(e) {
        document.querySelector('[name=title]').setSelectionRange(0, 0);
    });

    Events.bind('click', '.body[data-section=questions]', '.qt-btn', function(e) {
        e.preventDefault();
        Actions.switchQuestionType(this);
    });

    Events.bind('click', '.modal-wrapper', '.q-snips li', function(e) {
        $('.q-snips li').removeClass('active');
        $(this).addClass('active');

        Survey.questions.initEdit(this);
    });

    Events.bind('click', '.side-nav', '.nav-item.view-btn', function(e) {
        $(this).addClass('active').siblings().removeClass('active');
    });

    Events.bind('keypress', '#survey-modal', '.question-textarea', function(e) {
        Handlers.handleQTextareaKeypress(e);
    });

    Events.bind('change', '#survey-modal', '.question-textarea', function(e) {
        Handlers.handleQTextareaKeypress(e);
    });

    Events.bind('click', '.overlay', '.q-opt-wrap .del', function(e) {
        Survey.deleteQuestionOption($(this).siblings('.q-option'));
    });

    $('.side-panel').on('click', 'ol.q-snips', function(e) {
        $(e.currentTarget).addClass('active').siblings().removeClass('active');
    });

    // $('[data-target=create-new-panel]').trigger('click');

    $('.opts-wrapper').sortable({
        axis: 'y',
        handle: '.hand',
        containment: 'parent',
        cancel: ".link-btn",
        cursor: 'move'
    });
});