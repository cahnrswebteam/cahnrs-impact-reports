<?php namespace cahnrswp\publications\impact_reports;

class widget_control {

	public function __construct() {
		\add_action( 'widgets_init', array( $this, 'widget' ) );
	}
	
	public function widget() {
		\register_sidebar( array(
			'name'          =>	'Impact Report Archive',
			'id'            => 'impact-report-archive',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		) );
	}
	
}