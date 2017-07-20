/**
 * Krecent Dashboard.js
 * Dashboard.js v1.5 (C) Krecent Technologies | MIT @license: en.wikipedia.org/wiki/MIT_License.
 */

// Polyfill -> IE -> querySelector().forEach()
(function() {
    if (typeof NodeList.prototype.forEach === "function") return false;
    NodeList.prototype.forEach = Array.prototype.forEach;
})();

// Polyfill -> All -> .matches()
if (!Element.prototype.matches) {
    Element.prototype.matches = Element.prototype.matchesSelector || Element.prototype.mozMatchesSelector || Element.prototype.msMatchesSelector || Element.prototype.oMatchesSelector || Element.prototype.webkitMatchesSelector ||
        function(s) {
            var matches = (this.document || this.ownerDocument).querySelectorAll(s),
                i = matches.length;
            while (--i >= 0 && matches.item(i) !== this) {}
            return i > -1;
        };
}

var Handlers = {},
    Global = {
        content: '#content',
        lastClickedViewBtn: null,
        activeModal: '.modal.active',
        lastVisitedURL: null,
        viewBtn: '.view-btn',
        afterView: null,
    },
    DashboardHandlers = {
        handleClickEvents: function(e) {
            e.preventDefault;
            var action = e.currentTarget.getAttribute('data-action');

            Global.lastClickedActionBtn = $(e.currentTarget);
            Global.lastVisitedURL = $(e.currentTarget).data('href') || Global.lastVisitedURL;

            Actions[action].call(Actions, e);
        },
        handleViewBtnClick: function(e) {
            e.preventDefault();

            Global.lastClickedViewBtn = $(e.currentTarget);
            Dashboard.getView(Global.lastClickedViewBtn.data('href'));
        },
        handleRefreshClick: function(e) {
            Dashboard.reload();
        }
    },
    Events = {
        bind: function(event, parentSelector, selector, func) {

            // Get the parent node we need as 'this' if target is a child of 'parent node'
            function getParentNode(target, selector) {
                var node = target.parentNode;
                return node.matches(selector) ? node : getParentNode(node, selector);
            }
            var element = document.querySelector(parentSelector);

            element.addEventListener(event, function(e) {
                var target = e.target;
                match = target.matches(selector);

                if (match || target.matches(selector.trim() + ' *')) {
                    var node = match ? target : getParentNode(target, selector);
                    func.call(node, e);
                }
            });
        },
        init: function() {
            this.bindActionEvents();
        },
        bindActionEvents: function() {
            var clickableElements = document.querySelectorAll('[data-action]');
            clickableElements.forEach(function(element, index) {
                element.addEventListener('click', DashboardHandlers.handleClickEvents, false);
            });
        },
    };

var Actions = {
    create: function(uri, fn) {
        if (typeof arguments[0] === 'function') {
            var func = arguments[0],
                uri = null;
        } else {
            var func = null;
        }

        var url = uri || document.querySelector(Global.activeModal).getAttribute('data-action-url');
        Dashboard.actionRequest(url, null, func);
    },
    update: function(e, route) {
        Dashboard.bindToMany(false, e, 'input');

        $('.done-btn').unbind('click').click(function(evt) {
            var data = Dashboard.serializeFormData(),
                id = $(e.target).parents('li').data('id');

            for (prop in data) {
                if (data[prop] == '') delete data[prop];
            }
            data.id = id;

            Dashboard.actionRequest(route, data, false, 'PUT');
        });
    },
    delete: function(e, route) {
        var node = $(e.target).parents('li').find('.name');

        $('#delete-modal')
            .find('b.text-holder')
            .text(node.text())
            .end()
            .find('.del')
            .click(function() {
                Dashboard.actionRequest(route, {
                    id: node.parents('li').data('id')
                }, function() {
                    $('#delete-modal').closeModal();
                }, 'DELETE');
            });
    }
};

var Dashboard = {
    viewBtn: document.querySelectorAll(Global.viewBtn),
    wait: function(func, time) {
        window.setTimeout(function() {
            func.call();
        }, time);
    },
    getView: function(url) {
        Global.lastVisitedURL = window.location.href + url;

        Dashboard.viewAjax(Global.lastVisitedURL, {}, function(response) {
            Dashboard.renderResponse(response);
        });
    },
    sanitizeForm: function() {
        var inputs = document.querySelector('.modal.active').querySelectorAll('input[type=text], input[type=email], input[type=telephone]')
        inputs.forEach(function(input) {
            input.value = '';
        });
    },
    serializeFormData: function(form, ALLOW_EMPTY) {
        var node = form || document.querySelectorAll('.modal.active form'),
            serverData = new FormData();

        node.forEach(function(form) {
            var inputs = form.querySelectorAll('input[name], select[name], textarea[name]');

            inputs.forEach(function(input) {
                if (input.getAttribute('type') == 'file') {
                    var name = input.getAttribute('name');

                    input[0].files.forEach(function(i, file) {
                        serverData.append(name, file);
                    });
                } else if (input.value != '' || ALLOW_EMPTY) {

                    if (input.getAttribute('type') == 'checkbox' && !input.checked) {} else {
                        serverData.append(input.getAttribute('name'), input.value);
                    }
                }
            });
        });
        return serverData;
    },
    init: function() {
        document.querySelector('.refresh').addEventListener('click', DashboardHandlers.handleRefreshClick, false);
        this.viewBtn.forEach(function(element, index) {
            element.addEventListener('click', DashboardHandlers.handleViewBtnClick, false);
        });
    },
    bindToMany: function(bindTo, e, node) {
        var bindingTo = !bindTo ? $('#edit-modal') : bindTo,
            selector = 0,
            bindingFrom = $(e.target).parents('li').find('.item-props');

        SelectorObj = Dashboard.serializeFormData(false, false, true);
        SelectorArray = [];

        for (name in SelectorObj) {
            SelectorArray.push(name);
        }
        while (selector < SelectorArray.length) {
            if (node == 'input') {
                bindingTo.find('[name=' + SelectorArray[selector] + ']')
                    .val(bindingFrom.find('.' + SelectorArray[selector]).text())
                    .siblings('label')
                    .addClass('active');

            } else {
                bindingTo.find(SelectorArray[selector]).text(bindingFrom.find(SelectorArray[selector]).text());
            }
            selector++;
        }
    },
    viewAjax: function(url, serverData, success) {
        var xhr = new XMLHttpRequest();

        this.viewReadyStateChange = function(ajax) {
            if (ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200) {
                success.call({}, ajax.responseText);
            }
        };
        xhr.onreadystatechange = function() {
            Dashboard.viewReadyStateChange(xhr);
        }
        if (typeof this.getView.extend === 'function') {
            this.getView.extend(xhr);
        }
        xhr.open('GET', url + Utility.encodeURL(serverData));

        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xhr.send();
    },
    actionRequest: function request(url, data, successfn, type) {
        var xhr = new XMLHttpRequest();
        xhr.open(type || 'post', type == 'GET' ? url + Utility.encodeURL(data) : url);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                var response = xhr.status === 200 ? JSON.parse(xhr.responseText) : null;

                if (response.message) {
                    Dashboard.notify(response.message, 1000);

                    if (!response.error) {
                        Dashboard.sanitizeForm();
                        Dashboard.reload();
                    }
                }
                if (successfn) successfn.call({}, response);
            }
        }
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xhr.send((type == 'GET') ? null : data || Dashboard.serializeFormData());
    },
    renderResponse: function(response) {
        $(Global.content).html(response);
        /*	window.history.pushState({}, '', Global.lastVisitedURL);*/

        Events.bindActionEvents();
        if (typeof Global.afterView === 'function') Global.afterView();
    },

    reload: function() {
        Global.lastClickedViewBtn.trigger('click');
        $('button.refresh').velocity('callout.flash');
    },
    notify: function(message, time, fn) {
        var nObj = document.querySelector('.notification');

        nObj.querySelector('.msg').innerText = message;
        nObj.classList.add('show');

        Dashboard.wait(function() {
            nObj.classList.remove('show');
            fn.call({}, message);
        }, time);
    },
    options: function(optionsObject) {
        for (option in optionsObject) {
            Global[option] = optionsObject[option];
        }
    }
};

var Utility = {
    search: function(e, selector, textSelector) {
        var q = $(e.target).val();

        if (!this.search.results) this.search.results = {};
        if (this.search.results[q] != null) {
            this.search.results[q].show()
        } else {
            var elements = $(selector);

            elements.hide();
            elements.each(function() {
                var link = $(selector).find(textSelector),
                    Regex = new RegExp(q, 'i');

                if (link.text().match(Regex)) {
                    link.parent(selector).addClass('SEARCH_MATCH');
                } else {
                    link.parent(selector).removeClass('SEARCH_MATCH');
                }
            });

            this.search.results[q] = $('.SEARCH_MATCH');

            if (this.search.results[q].length === 0) {
                $('.void-content-message').show();
            } else {
                this.search.results[q].show();
                $('.void-content-message').hide();
            }
        }
    },
    upperCaseFirst: function(string) {
        var firstChar = string.charAt(0),
            newString = firstChar.toUpperCase() + string.slice(1);
        return newString;
    },
    encodeURL: function(data) {
        var query = [];
        for (var key in data) {
            query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
        }
        return (query.length ? '?' + query.join('&') : '');
    },
    showPhoto: function(input, target, bytes) {
        var Reader = new FileReader();
        if (input.files && input.files[0]) Reader.readAsDataURL(input.files[0]);
        else console.log('Files is empty!');

        Reader.onloadend = function() {
            target.attr('src', Reader.result);
            bytes.attr('value', Reader.result);
        }
    }
};

document.addEventListener('DOMContentLoaded', function() {
    Events.init();
    Dashboard.init();
}, false);