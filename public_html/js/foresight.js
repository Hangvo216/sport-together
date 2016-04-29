
String.prototype.mysqlToDate = String.prototype.mysqlToDate || function() {
	var t = this.split(/[- :]/);
	return new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);
};


