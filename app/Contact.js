let map = new WeakMap();

let internal = function (object) {
    if (!map.has(object))
        map.set(object, {});
    return map.get(object);
}

var Contact = function(name, phone) {
	internal(this).name = name;
	internal(this).phone = phone;
}

Contact.prototype.getName = function() {
	return internal(this).name;
};

Contact.prototype.getPhone = function() {
	return internal(this).phone;
};

Contact.prototype.setName = function(name) {
	internal(this).name = name;
};

Contact.prototype.setPhone = function(phone) {
	internal(this).phone = phone;
};

