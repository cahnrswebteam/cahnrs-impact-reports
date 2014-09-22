/**
 * Impact Report display scripts
 */
jQuery(document).ready(function($){

	var browseTabs = $('li.browse > ul').hide();
	
	$('li.browse > a').click(function() {
		//browseTabs.slideUp();
		$(this).next().slideToggle('fast');
		return false;
	});

	$("a[href^=#]").on("click", function(e) {
    e.preventDefault();
    //history.pushState({}, "", this.href);
    if ($(this.hash).length) {
			$('html, body').animate(
				{ scrollTop: $(this.hash).offset().top },
				200,
				'swing'
			);
		}
	});

});