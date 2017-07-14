function login_out() {
	$.post("/index.php/hxadmin/login/login_out", {}, function(data, datatype) {
		if (data.status == 200) {
			// parent.location.reload();
		}

	}, "json");
}
$(".layer_date").click(function() {
	laydate({
		elem : '#' + $(this).attr("id"),
	});
});
function getFormJson(form) {
	var o = {};
	var a = $(form).serializeArray();
	$.each(a, function() {
		if (o[this.name] !== undefined) {
			if (!o[this.name].push) {
				o[this.name] = [ o[this.name] ];
			}
			o[this.name].push(this.value || '');
		} else {
			o[this.name] = this.value || '';
		}
	});
	return o;
}