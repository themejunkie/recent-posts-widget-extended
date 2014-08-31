jQuery(function() {
	jQuery('.rpwe-widget-content .rpwetabs').tabs();
});

// Add the tabs functionality AJAX returns
jQuery(document).ajaxComplete(function() {
	jQuery('.rpwe-widget-content .rpwetabs').tabs();
});