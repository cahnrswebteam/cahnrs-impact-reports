/**
 * Impact Report tinyMCE Plugin
 *
 * Counts and limits the number of characters for the sections of an impact report
 * 
 * References:
 *	http://stackoverflow.com/questions/11342921/limit-the-number-of-character-in-tinymce?rq=1
 *	http://stackoverflow.com/questions/12531113/is-there-a-way-to-apply-characters-limit-inside-wp-editor-function
 */
jQuery(function($) {

	var main_limit = 4500;

	tinymce.create( 'tinymce.plugins.ircounter', {
		init : function(ed) {
			ed.on('KeyDown', function(ed, e) {
				var KeyID = ed.keyCode;
				if( 8 == KeyID || 32 == KeyID || 190 == KeyID ) { return true;} //alert('backspace');
 
				// Main body sections
				if( tinyMCE.activeEditor.id == 'ir_issue' || tinyMCE.activeEditor.id == 'ir_response' || tinyMCE.activeEditor.id == 'ir_impacts' ) {
					issue_count    = $.trim(tinymce.editors.ir_issue.getContent().replace(/(<([^>]+)>)/ig,'')).length;
					response_count = $.trim(tinymce.editors.ir_response.getContent().replace(/(<([^>]+)>)/ig,'')).length;
					impacts_count  = $.trim(tinymce.editors.ir_impacts.getContent().replace(/(<([^>]+)>)/ig,'')).length;
					total          = issue_count + response_count + impacts_count;
					remainder      = main_limit - total;
					$('.ir-main-counter span').html( remainder );
					if( total > main_limit ) {
						alert( 'You have exceeded the maximum amount of content for the main body of an impact report.' );
						ed.stopPropagation();
						ed.preventDefault();
					}
				}

				// Front page sidebar
				if( tinyMCE.activeEditor.id == 'ir_numbers' ) {
					count = $.trim(tinymce.editors.ir_numbers.getContent().replace(/(<([^>]+)>)/ig,'')).length;
					$('.ir-front-sidebar-counter span').html( 900 - count );
					if( count > 900 ) {
						alert( 'You have exceeded the maximum amount of content for the front page sidebar.' );
						ed.stopPropagation();
						ed.preventDefault();
					}
				}

				// Back page sidebar
				if( tinyMCE.activeEditor.id == 'ir_quotes' || tinyMCE.activeEditor.id == 'ir_additional' ) {
					quotes_count     = $.trim(tinymce.editors.ir_quotes.getContent().replace(/(<([^>]+)>)/ig,'')).length;
					additional_count = $.trim(tinymce.editors.ir_additional.getContent().replace(/(<([^>]+)>)/ig,'')).length;
					total            = quotes_count + additional_count;
					$('.ir-back-sidebar-counter span').html( 900 - total );
					if( total > 900 ) {
						alert( 'You have exceeded the maximum amount of content for the back page sidebar.' );
						ed.stopPropagation();
						ed.preventDefault();
					}
				}
/*
				// Front page footer
				if( tinyMCE.activeEditor.id == 'ir_footer_front' ) {
					count = $.trim(tinymce.editors.ir_footer_front.getContent().replace(/(<([^>]+)>)/ig,'')).length;
					if( count > 190 ) {
						ed.stopPropagation();
						ed.preventDefault();
					}
				}

				// Back page footer
				if( tinyMCE.activeEditor.id == 'ir_footer_back' ) {
					count = $.trim(tinymce.editors.ir_footer_back.getContent().replace(/(<([^>]+)>)/ig,'')).length;
					if( count > 145 ) {
						ed.stopPropagation();
						ed.preventDefault();
					}
				}
*/
			});
		},
	});
	tinymce.PluginManager.add( 'ir_counter', tinymce.plugins.ircounter );

	// Main body sections
	issue_count    = $.trim($('#ir_issue').text().replace(/(<([^>]+)>)/ig,'')).length;
	response_count = $.trim($('#ir_response').text().replace(/(<([^>]+)>)/ig,'')).length;
	impacts_count  = $.trim($('#ir_impacts').text().replace(/(<([^>]+)>)/ig,'')).length;
	main_total     = issue_count + response_count + impacts_count;
	main_remainder = main_limit - main_total;
	$('.ir-main-counter span').html( main_remainder );

	// Front page sidebar
	front_sb_count = $.trim($('#ir_numbers').text().replace(/(<([^>]+)>)/ig,'')).length;
	$('.ir-front-sidebar-counter span').html( 900 - front_sb_count );

	// Back page sidebar
	quotes_count     = $.trim($('#ir_quotes').text().replace(/(<([^>]+)>)/ig,'')).length;
	additional_count = $.trim($('#ir_additional').text().replace(/(<([^>]+)>)/ig,'')).length;
	back_sb_count    = quotes_count + additional_count;
	$('.ir-back-sidebar-counter span').html( 900 - back_sb_count );

//})();
});