<?php namespace cahnrswp\publications\impact_reports;

class posttype_control {
	
	public function __construct() {

		\add_action( 'init', array( $this, 'post_type' ), 0 );

	}
	
	public function post_type() {

		$labels = array(
			'name'                => 'Impact Reports',
			'singular_name'       => 'Impact Report',
			'menu_name'           => 'Impact Reports',
			'parent_item_colon'   => 'Parent Item:',
			'all_items'           => 'All Impact Reports',
			'view_item'           => 'View Impact Report',
			'add_new_item'        => 'Add New Impact Report',
			'add_new'             => 'Add New',
			'edit_item'           => 'Edit Impact Report',
			'update_item'         => 'Update Impact Report',
			'search_items'        => 'Search Impact Reports',
			'not_found'           => 'Not found',
			'not_found_in_trash'  => 'Not found in Trash',
		);
	
		$args = array(
			'label'               => 'impact-report',
			'description'         => 'Reports on research, teaching and engagement from the CAHNRS and WSU Extension.',
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', /*'author',*/ ),
			'taxonomies'          => array( 'programs', 'locations' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			//'menu_icon'           => 'dashicons-portfolio', // Uncomment upon upgrading to WP 3.9
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			// Legacy, Uncomment upon upgrading to WP 3.9
			'single_layout'       => 'sidebar', // For a standard layout. Recognized values: full, sidebar, two, three, four (will be overriden if wip_layout_options is true)
			'archive_layout'      => 'sidebar', // Layout of content type archive. Recognized values same as above (will be overriden if archive_widget is true)
		);
	
		\register_post_type( 'impact', $args );

	}
	
}