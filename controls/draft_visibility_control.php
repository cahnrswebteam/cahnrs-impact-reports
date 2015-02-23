<?php namespace cahnrswp\publications\impact_reports;

class draft_visibility_control {

	public function __construct() {
		\add_filter( 'the_posts', array( $this, 'show_drafts'), 10, 2 );
	}
	
	public function show_drafts( $posts, $wp_query ) {
    if ( count( $posts ) ) {
			return $posts;
		}
    if ( 'impact' == $_GET['post_type'] && !empty( $wp_query->query['p'] ) ) {
			return array( get_post( $wp_query->query['p'] ) );
    }
	}
	
}