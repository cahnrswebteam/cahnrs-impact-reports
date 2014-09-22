/**
 * Change Program taxonomy checkboxes into radio buttons
 *
 * Seems to be the simplest way to do it, from http://wordpress.mfields.org/plugins/category-radio-buttons/#comment-795
 */
 
jQuery("#programschecklist input, #programschecklist-pop input, .programs-checklist input").each( function() {
	this.type="radio"
});