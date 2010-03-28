$(document).ready(function() {
	$("#accordion").accordion({
		header: "h1",
		autoHeight: false,
		collapsible: true,
	});

	$("#nested_accordion").accordion({
		header: "h2",
		autoHeight: false,
		collapsible: true,
		active: false,
	});

	$("input:submit, input:button, input:checkbox").button();
});

function clear_text(field) {
	if(field.defaultValue == field.value) field.value = '';
	else if(field.value == '') field.value = field.defaultValue;
}