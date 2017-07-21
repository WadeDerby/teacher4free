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

