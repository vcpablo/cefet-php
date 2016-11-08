var Contact = function(name, phone) {
	var _name = name;
	var _phone = phone;

	this.getName = function() {
		return name;
	}

	this.setName = function(name) {
		_name = name;
	}

	this.getPhone = function() {
		return _phone;
	}

	this.setPhone = function(phone) {
		_phone = phone;
	}
}

