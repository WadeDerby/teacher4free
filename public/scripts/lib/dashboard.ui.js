var Modal = {
    closeBtn: $('.overlay .close'),
    modals: function() {
        return $('.modal');
    },
    show: function(target) {
        if (this.targetParent) {
            var modal = $('.overlay .modal');
            modal.appendTo(Modal.targetParent);
        }

        var overlay = $('.overlay'),
            targetModal = $('#' + target);
        this.targetParent = targetModal.parent();

        overlay.find('.modal-wrapper').empty().append(targetModal);

        if (!overlay.hasClass('show')) {
            overlay.velocity('transition.fadeIn', {
                duration: 200
            }).addClass('show');
        }
        this.modals().hide().removeClass('active');
        targetModal.velocity('transition.expandIn', {
            duration: 300
        }).addClass('active');

        this.SidePanel.init();
    },
    close: function(argument) {
        var modal = $('.overlay .modal');

        modal.velocity('transition.expandOut', {
            duration: 300
        }).removeClass('active');

        $('.overlay').velocity('transition.fadeOut', {
            duration: 200,
            complete: function() {
                $('.overlay').removeClass('show');
                modal.appendTo(Modal.targetParent)
            }
        });
    },
    navigate: function(e) {
        var section = $(e.currentTarget).parents('.body').data('section');
        this.SidePanel.navItem()
            .filter('[data-section=' + section + ']')
            .next('li')
            .trigger('click');
    },
    init: function() {
        parent = this;
        this.closeBtn.click(function(event) {
            parent.close();
        });

        $('.modal-close').click(function(event) {
            parent.close();
        });

        var parent = this;
        $('.modal button.next').click(function(e) {
            // Check for require fields within modal sections
            var inputs = $(e.currentTarget).parent('.body').find('input:not([type=hidden]), textarea, [data-name]');
            var error;

            inputs.each(function(index) {
                if ($(this).attr('name')) {
                    if ($(this).attr('required') && $(this).val().trim() == '') {
                        error = true;
                    }
                } else {
                    if ($(this).data('required') && typeof $(this).data('selected') == 'undefined') {
                        error = true;
                    }
                }
                if (error) {
                    $(this).velocity('callout.shake');
                    return false;
                }
            });

            if (!error) {
                parent.navigate(e);
            }
        });

        $('[data-target]').click(function(e) {
            Modal.show($(e.currentTarget).data('target'));
        });
    },
    SidePanel: {
        navItem: function() {
            return $('.modal.active .side-bar ul li')
        },
        navigateTo: function(e) {
            target = $(e.currentTarget);
            target.addClass('active').siblings().removeClass('active');

            $('.modal.active .modal-body .title').text(target.text());

            $('.modal-body .body.active')
                .velocity({
                    marginLeft: -50,
                    opacity: 0
                }, {
                    duration: 300,
                    complete: function() {
                        hiding = $(this);
                        hiding.hide().removeClass('active').css({
                            opacity: 1,
                            marginLeft: 0
                        });

                        var section = target.data('section'),
                            next = $('.modal-body').find('[data-section=' + section + ']');

                        next.insertAfter(hiding).velocity('transition.fadeIn', {
                            duration: 200
                        }).addClass('active');

                        if (next.hasClass('large')) {
                            $('.modal.active .modal-body').addClass('large');
                        } else {
                            $('.modal.active .modal-body').removeClass('large');
                        }
                    }
                });
        },
        init: function() {
            sideBar = this;
            this.navItem().click(function(e) {
                sideBar.navigateTo(e);
            });
        }
    }
};

var SelectBox = {
    node: $('div.select'),
    init: function(selects) {
        var coll = selects || $('div.select');

        coll.each(function(index, el) {
            var phtext = $(this).data('placeholder');

            if ($(this).find('.placeholder').length == 0) {
                var span = $("<span>", {
                    class: 'placeholder',
                    text: phtext
                });
                $(this).append(span).append("<i class='fa fa-angle-down'></i>");
            } else {
                $(this).find('.placeholder').text(phtext);
            }
            $(this).find('input').val('');
        });

        if (typeof selects == 'undefined') {
            $('div.select').click(function() {
                select = $(this);

                var height = (select.find('.option').length) * 37,
                    placeholder = select.find('.placeholder'),
                    options = select.find('.options');

                if (select.find('input').length == 0) {
                    var input = $("<input>", {
                        name: select.data('name'),
                        type: 'hidden'
                    });
                    select.append(input);
                }

                options.velocity('transition.fadeIn', {
                    duration: 100,
                    complete: function() {
                        options.css({
                            height: height
                        }).addClass('active');
                    }
                });

                select.find('.option').click(function(e) {
                    e.stopImmediatePropagation();
                    select.find('input').val($(this).data('value'));
                    select.data('selected', 'true');

                    var innerText = $(this).text();
                    placeholder.text(innerText);

                    options.velocity({
                        height: 37
                    }, {
                        duration: 200,
                        complete: function() {
                            options.velocity('transition.fadeOut', {
                                duration: 200
                            }).removeClass('active');
                        }
                    });
                });
            });
        }
    }
};
var Toggle = {
    node: function() {
        return $('.switch.input');
    },
    options: $('.toggle-switch label'),
    init: function() {
        this.node().each(function(index, el) {
            $(this).prepend("<span class='medium-text'>" + $(this).data('label') + "</span>")
        });

        this.options.click(function(e) {
            var parentTS = $(e.target).parents('.toggle-switch'),
                text = !parentTS.hasClass('on') ? 'ON' : 'OFF';

            parentTS.toggleClass('on').find('.stt').text(text);

            if (text == 'ON' && parentTS.parent().data('on')) {
                Actions[parentTS.parent().data('on')].call(Actions, e);
            }
        });
    }
}

var Notification = {
    node: $('.notification'),
    init: function() {
        this.node.html("<span class='msg'></span><i class='close fa fa-times'></i>");

        var parent = this;
        this.node.find('.close').click(function(event) {
            parent.hide();
        });
    },
    Spinner: {
        node: $('.notification'),
        init: function() {
            this.node.addClass('spinner');
        },
        stop: function() {
            this.node.removeClass('spinner');
        }
    },
    show: function(message, time) {
        var node = this.node;

        node.velocity('transition.fadeIn', {
            duration: 200
        });

        Dashboard.wait(function() {
            node.addClass('show');
        }, 200);

        Dashboard.wait(function() {
            node.find('.msg').text(message);
        }, 400);

        Dashboard.wait(function() {
            Notification.hide();
        }, time + 400);
    },
    hide: function() {
        var node = this.node;
        this.node.find('.msg').text('');
        node.removeClass('show');

        Dashboard.wait(function() {
            node.velocity('transition.fadeOut');
        }, 400);
    }
};

var ProgressBar = {
    node: $('.progress-bar'),
    move: function(percent) {
        var bar = $('.progress-bar .bar');
        $('.progress-bar .bar').width(percent + '%');

        /* Hide when done*/
        if (percent == 100) {
            window.setTimeout(function(argument) {
                bar.css('opacity', 0);
                Dashboard.wait(function() {
                    bar.css('width', 0);
                }, 300);

                Dashboard.wait(function() {
                    bar.css('opacity', 1);
                }, 500);
            }, 200);
        }
    },
    init: function() {
        $("<div>", {
            class: 'progress-bar'
        }).html("<span class='bar'></>").appendTo('body');
    },
    error: function() {
        $('.progress-bar').addClass('error');
        var parent = this;

        window.setTimeout(function(argument) {
            parent.move(0);
        }, 100);

        window.setTimeout(function(argument) {
            $('.progress-bar').removeClass('error');
        }, 300);
    }
};

var Checkbox = {
    init: function() {
        $('.input-checkbox').each(function(index, el) {
            var checkbox = $(this);

            $("<input>", {
                type: 'checkbox',
                id: checkbox.data('id'),
                name: checkbox.data('name'),
                value: checkbox.data('value')
            }).appendTo(checkbox);

            $("<label>", {
                for: checkbox.data('id'),
            }).appendTo(checkbox);

            $("<span>", {
                class: 'text-label',
            }).appendTo(checkbox).text(checkbox.data('label'));
        });
    }
}

jQuery(document).ready(function($) {
    Toggle.init();
    Modal.init();
    SelectBox.init();
    Notification.init();
    ProgressBar.init();
    Checkbox.init();

    $('.squeeze-icon').click(function(event) {
        $('.side-nav').toggleClass('squeeze');
        $(this).toggleClass('pressed');
        $('#content').toggleClass('adjust');
    });

    var infos = $('.card.info b');

    infos.each(function(index, el) {
        var numAnim = new CountUp(el, 0, el.innerText);
        numAnim.start();
    });
});