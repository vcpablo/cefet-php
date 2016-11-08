function parseErrors(errors) {
	return errors.join("<br>");
}

function save(user) {

	var jqXhr = $.ajax({
		url: 'server/login.php',
		method: 'POST',
		data: user
	});

	var success = function(data){
		alert(data);
	};

	var error = function(jqXhr, textStatus, errorThrown){
		$("#errors").html(parseErrors(jqXhr.responseJSON));
		$(".errors").removeClass("hidden");
	};

	jqXhr.done( success );
	jqXhr.fail( error );
}



$(document).ready(function(){
	$("#send").click(function(e){
		e.preventDefault();

		var user = {
			name: $("#name").val(),
			email: $("#email").val(),
			password: $("#password").val()
		};

		save(user);

	});

	$("input").keypress(function(){
		$("#errors").empty();
		if(!$(".errors").hasClass("hidden")) {
			$(".errors").addClass("hidden");
		}
	});
});