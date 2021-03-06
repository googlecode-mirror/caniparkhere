$(document).ready(function() {
	// Tabs
	$("#tabs").tabs({
		fx: { opacity: "toggle",
				duration: "fast" }
	});

	// Accordions
	$("#accordion").accordion({
		header: "h1",
		autoHeight: false,
		collapsible: true,
		active: false,
	});
	$("#nested_accordion").accordion({
		header: "h2",
		autoHeight: false,
		collapsible: true,
		active: false,
	});

	// Buttons
	$("input:submit, input:button, input:checkbox, button").button();

	// Help Dialogs
	$("#create_help_dialog, #delete_help_dialog, #modify_help_dialog").dialog({
		autoOpen: false,
		closeOnEscape: true,
		width: 700,
		show: "drop",
		hide: "drop",
	});
	$("#create_help_opener, #delete_help_opener, #modify_help_opener").hover(function() {
		$(this).toggleClass("ui-state-hover");
		return true;
	});
	$("#create_help_opener").click(function() {
		$("#create_help_dialog").dialog("open");
	});
	$("#delete_help_opener").click(function() {
		$("#delete_help_dialog").dialog("open");
	});
	$("#modify_help_opener").click(function() {
		$("#modify_help_dialog").dialog("open");
	});
});
