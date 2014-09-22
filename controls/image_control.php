<?php namespace cahnrswp\publications\impact_reports;

class image_control {


	public function __construct() {

		\add_filter( 'admin_post_thumbnail_html', array( $this, 'image' ) );

	}


	function image( $content ) {

		$screen = \get_current_screen();
	
		if ( $screen->post_type == 'impact' )
			return $content .= '<p class="ir-image-size">(at least <strong>1370 × 450 pixels (wide × tall)</strong>)</p>';
		else
			return $content;

	}


}
?>