var printAll = function(contacts) {
	var contact, html = '';

	if(contacts.length > 0) {
		html += '<table class="table table-responsive table-striped">' + 
			'<tr><th>Name</th><th>Phone</th><th>Options</th></tr>';

		for(var i in contacts) {
			contact = new Contact(contacts[i].name, contacts[i].phone);

			html += '<tr>' + 
				'<td>' + contact.getName() + '</td>' +
				'<td>' + contact.getPhone() + '</td>' +
				'<td>'+ 
						'<button type="button" onclick="remove(\'' + contact.getName() + '\')" class="btn btn-danger  btn-sm">Remove</button> ' +
						'<button type="button" onclick="get(\'' + contact.getName() + '\')" class="btn btn-primary  btn-sm">Edit</button>' +
				'</td>' +
			'</tr>';
		}

		html += '</table>';
	} else {
		html += '<p>No contacts found</p>';
	}

	return html;
}

var print = function(contact) {
	for(var i in contact) {
		$("#" + i).val(contact[i]);
	}

	if($("#contact_form").hasClass("hidden")) {
		$("#contact_form").removeClass("hidden");
	}
};


var validate = function() {
	var fields = [ 'name', 'phone' ];
	var element, ok = true;

	for( var i in fields ) {
		element = $("#" + fields[i]);
		if( element.is(":required") && element.val().length == 0 ) {
			$("#" + fields[i] + "_error").html( fields[i] + ' is required' ).removeClass("hidden");
			ok = false;
		} 

		else {
			if( element.attr( "minlength" ) && ( element.val().length < element.attr( "minlength" ) ) ) {
				$("#" + fields[i] + "_error").html( fields[i] + ' must not have less than ' + element.attr( "minlength" ) + ' characters.' ).removeClass("hidden");
				ok = false;
			} 

			if( element.attr( "maxlength" ) && ( element.val().length > element.attr( "maxlength" ) ) ) {
				$("#" + fields[i] + "_error").html( fields[i]  + ' must not have more than ' + element.attr( "maxlength" ) + ' characters.' ).removeClass("hidden");
				ok = false;
			}
		}
	}

	return ok;

}

var success = function(data, textStatus, jqXhr) {
	console.log("data", data)
	if(data.length) {
		$("#contacts").html(printAll(data));
	} else {
		print(data);
	}
};

var error = function(jqXhr, textStatus, errorThrown) {
	console.error(errorThrown);
};

function get(name) {
	var jqXhr, update;
	if(name === undefined) {
		jqXhr =$.get( 'server/crud.php' )
		$("#update").val(0);
	} else {
		jqXhr = $.get( 'server/crud.php?name=' + name )
		$("#update").val(1);
	}

	jqXhr.done( success );
	jqXhr.fail( error );
}

function clean() {
	$("#name").val('');
	$("#phone").val('');
}

function showForm() {
	$("#contact_form").removeClass("hidden");
	$("#update").val(0);
}

function save(e, update) {
	// para prevenir que o botão ('submit') submeta os dados
	e.preventDefault();

	if(!validate()) return;

	var contact = {
		name: $('#name').val(),
		phone: $('#phone').val()
	};

	var jqXhr = $.ajax({
		url: 'server/crud.php',
		method: (update) ? 'PUT' : 'POST',
		data: contact
	});

	var success = function(data){
		alert(contact.name + ' was  added');
		get();
	};

	var error = function(jqXhr, textStatus, errorThrown){
		console.log(textStatus);
		console.log(jqXhr);
		alert(jqXhr.responseText);
	};

	jqXhr.done(success);
	jqXhr.fail(error);
}
function remove(name) {
	if(confirm("Remove " + name + "?")) {
		var jqXhr = $.ajax({
			url: 'server/crud.php?name=' + name,
			method: 'DELETE',
		});

		jqXhr.done( function(data) {
			alert(name + " was removed");
			success(data);
		} );
		jqXhr.fail( function(jqXhr, textStatus, errorThrown) {
			alert("Error removing " + name);
			error(jqXhr, textStatus, errorThrown)
		} );
	}
};

$(document).ready(function() {
	get();
	alert("OK");
	$("#send").click( function(e) {
		console.log($("#update").val())
		save(e, $("#update").val() == 1)
	} );

	

	$("input").on('keypress', function() {
		$("#" + $(this).attr("id") + "_error").html('').addClass("hidden");
	});
});