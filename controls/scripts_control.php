<?php namespace cahnrswp\publications\impact_reports;

class scripts_control {


	public function __construct() {

		\add_action( 'wp_enqueue_scripts', array( $this, 'public_queues' ), 9999 );

		if ( \is_admin() ) {
			\add_action( 'admin_print_scripts-post-new.php', array( $this, 'admin_post_queues' ) );
			\add_action( 'admin_print_scripts-post.php',     array( $this, 'admin_post_queues' ) );
			\add_action( 'admin_print_scripts-edit.php',     array( $this, 'admin_edit_queues' ) );
		}

	}


	public function public_queues() {

		if ( \get_post_type() == 'impact' && \is_single() ) {
			\wp_enqueue_style( 'impact-report-style', URL . 'css/style.css', array() );
			\wp_dequeue_script( 'comment-reply' );
			\wp_dequeue_script( 'modernizr' );
			\wp_enqueue_script( 'impact-report-script', URL . 'js/scripts.js', array( 'jquery' ), '0.1', true );
		}

	}


	public function admin_post_queues() {

		global $post;

		if ( $post->post_type == 'impact' ) {
			\wp_enqueue_style(  'impact-report-style',            URL . 'css/editor.css',    array()                );
			\wp_enqueue_script( 'impact-report-scripts',          URL . 'js/ir-scripts.js',  array()                );
			\wp_enqueue_script( 'impact-report-taxonomy-scripts', URL . 'js/ir-taxonomy.js', array(), '1.0.0', true );
		}

	}


	public function admin_edit_queues() {

		global $post;

		if ( $post->post_type == 'impact' )
			\wp_enqueue_script( 'impact-report-taxonomy-scripts', URL . 'js/ir-taxonomy.js', array(), '1.0.0', true );

	}


}