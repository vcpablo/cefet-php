
function printAll(users) {
	console.log("users", users)
	var html = '';

	if(users.length > 0) {
		html += '<table class="table table-responsive table-striped">' +
			'<tr><th>Name</th><th>Email</th></tr>';

		for(var i in users) {
			html += '<tr>' + 
					'<td>' + users[i].name + '</td>' + 
					'<td>' + users[i].email + '</td>' + 
				'</tr>';
		}

		'</table>';
	} else {
		html += '<h3 class="text-center">No users found</h3>';
	}

	return html;
}

function get() {
	var jqXhr = $.get( 'server/users.php' );

	var success = function(data) {
		$("#users").html(printAll(data));
	};

	var error = function(jqXhr, textStatus, errorThrown) {
		$("#errors").html(parseErrors(errorThrown)).removeClass("hidden");
	};

	jqXhr.success( success );
	jqXhr.fail( error );
}

$(document).ready(function(){
	get();
});