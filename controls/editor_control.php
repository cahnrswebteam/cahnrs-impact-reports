<?php namespace cahnrswp\publications\impact_reports;
/*
 * TinyMCE plugin handling
 */

class editor_control {


	public function __construct() {

		//\add_action( 'admin_init', array( $this, 'tinymce_plugin_handler' ) ); // Uncomment upon upgrading to WP 3.9
		\add_action( 'admin_init', array( $this, 'add_tinymce_plugin' ) ); // Remove upon upgrading to WP 3.9

	}

/* Uncomment upon upgrading to WP 3.9
	public function tinymce_plugin_handler() {

		\add_filter( 'mce_external_plugins', array( $this, 'tinymce_plugin' ) );

	}


	public function tinymce_plugin( $plugin_array ) {

		$screen = \get_current_screen();

		if ( $screen->post_type == 'impact' ) $plugin_array['ir_counter'] = URL . 'js/ir-charcount.js';

	 	return $plugin_array;

	}
*/
	/* Legacy theme - remove upon upgrading to WP 3.9 */
	public function add_tinymce_plugin() {
		\add_filter( 'mce_external_plugins', array( $this, 'tinymce_plugin' ) );
	}
	public function tinymce_plugin( $plugin_array ) {
		$screen = \get_current_screen();
		if ( $screen->post_type == 'impact' ) $plugin_array['ir_counter'] = URL . 'js/legacy-ir-charcount.js';
		return $plugin_array;
	}


}