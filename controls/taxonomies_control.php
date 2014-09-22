<?php namespace cahnrswp\publications\impact_reports;

class taxonomies_control {


	public function __construct() {
		\add_action( 'init', array( $this, 'taxonomies' ), 0 );
		\add_filter( 'generate_rewrite_rules', array( $this, 'rewrite' ) );
	}


	public function taxonomies() {
		$this->locations();
		$this->programs();
		$this->categories();
		
		$this->set_default_terms();
		//$this->set_program_terms();
	}


	public function rewrite( $wp_rewrite ) {

    $rules = array();

		//$taxonomies = get_object_taxonomies( 'impact-report' );
		
		$taxonomies = array( 'programs', 'locations', 'categories' );

		foreach( $taxonomies as $taxonomy ) {

			$terms = get_categories( array(
				'type'       => 'impact',
				'taxonomy'   => $taxonomy,
				'hide_empty' => 0,
			) );

			// make rules
			foreach( $terms as $term ) {
				$rules[ 'impact/' . $taxonomy . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
			}

		}

    // merge with global rules
    $wp_rewrite->rules = $rules + $wp_rewrite->rules;

	}


	private function locations() {

		$labels = array(
			'name'                       => 'Locations',
			'singular_name'              => 'Location',
			'menu_name'                  => 'Locations',
			'all_items'                  => 'All Locations',
			'parent_item'                => 'Parent Location',
			'parent_item_colon'          => 'Parent Location:',
			'new_item_name'              => 'New Location Name',
			'add_new_item'               => 'Add New Location',
			'edit_item'                  => 'Edit Location',
			'update_item'                => 'Update Location',
			'separate_items_with_commas' => 'Separate locations with commas',
			'search_items'               => 'Search Locations',
			'add_or_remove_items'        => 'Add or remove locations',
			'choose_from_most_used'      => 'Choose from the most used locations',
			'not_found'                  => 'Not Found',
		);
	
		$rewrite = array(
			'slug'                       => 'impact/locations',
			'with_front'                 => true,
			'hierarchical'               => false,
		);
	
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'rewrite'                    => $rewrite,
			// Legacy, uncomment upon upgrading to WP 3.9
			'archive_layout'             => 'sidebar',
		);
	
		\register_taxonomy( 'locations', 'impact', $args );

	}
	
	private function set_default_terms(){
		
		$locations = array( 
			'adams-county' => 'Adams County', 
			'asotin-county' => 'Asotin County', 
			'benton-county' => 'Benton County', 
			'benton-franklin-county' => 'Benton/Franklin County' , 
			'chelan-county' => 'Chelan County', 
			'chelan-douglas-okanogan-county' => 'Chelan/Douglas/Okanogan County', 
			'clallam-county' => 'Clallam County', 
			'clark-county' => 'Clark County' , 
			'columbia-county' => 'Columbia County' , 
			'colville-reservation-ferry-county' => 'Colville Reservation-Ferry County' , 
			'cowlitz-county' => 'Cowlitz County' , 
			'douglas-county' => 'Douglas County,Ferry County', 
			'franklin-county' => 'Franklin County', 
			'garfield-county' => 'Garfield County', 
			'grant-adams-county' =>'Grant/Adams County' , 
			'grays-harbor-county' => 'Grays Harbor County' , 
			'island-county' => 'Island County' , 
			'jefferson-county' =>'Jefferson County', 
			'king-county' => 'King County' , 
			'kitsap-county' => 'Kitsap County' , 
			'kittitas-county' => 'Kittitas County', 
			'klickitat-county' => 'Klickitat County', 
			'lewis-county' => 'Lewis County', 
			'lincon-adams-county' => 'Lincoln/Adams County', 
			'mason-county' => 'Mason County',
			'okanogan-county' => 'Okanogan County', 
			'othello-research-unit' => 'Othello Research Unit', 
			'pacific-county' => 'Pacific County',
			'pend-oreille-county' => 'Pend Oreille County', 
			'pierce-county' => 'Pierce County' , 
			'san-juan-county' => 'San Juan County',
			'skagit-county' => 'Skagit County', 
			'skamania-county' => 'Skamania County', 
			'snohomish-county' => 'Snohomish County',
			'spokane-county' => 'Spokane County', 
			'statewide' => 'Statewide', 
			'stevens-county' => 'Stevens County' , 
			'thurston-county' => 'Thurston County',
			'wahkiakum-county' => 'Wahkiakum County', 
			'walla-walla-county' => 'Walla Walla County', 
			'watcom-county' => 'Whatcom County', 
			'whitman-county' => 'Whitman County',
			'lind' => 'WSU Lind Dryland Research Station', 
			'long-beach' => 'WSU Long Beach Research and Extension Center',
			'nwrec' => 'WSU Mount Vernon Northwestern Washington Research and Extension Center',
			'iarec' => 'WSU Prosser Irrigated Agriculture Research and Extension Center',
			'puyallup' => 'WSU Puyallup Research and Extension Center',
			'wsu-spokane' => 'WSU Spokane',
			'wsu-tri-cities' => 'WSU Tri-Cities',
			'wsu-vancouver' => 'WSU Vancouver',
			'tfrec' => 'WSU Wenatchee Tree Fruit Research and Extension Center',
			'yakima-county' => 'Yakima County',
			);
		
		$programs = array( 
			'4-h' => '4-H',
			'beach-watchers' => 'Beach Watchers',
			'extension' => 'County Extension',
			'food-sense' => 'Food $ense',
			'master-gardeners' => 'Master Gardeners', 
			);
		
		$cats = array(
			'agriculture' => 'Agriculture',
			'food-and-nutrition' => 'Food and Nutrition',
			'youth-and-families' => 'Youth and Families'
		);
	
		$taxes = array(
		'locations' => $locations,
		'programs' => $programs,
		'categories' => $cats
		);
		
		foreach( $taxes as $t_name => $t_items ){
			$c_terms = get_terms( $t_name , array( 'hide_empty' => false ) );
			if ( empty( $c_terms ) || is_wp_error( $c_terms ) ) {
				foreach( $t_items as $i_slug => $i_name ){
					\wp_insert_term( $i_name , $t_name , array('slug' => $i_slug ) );
				}
			} else {
				foreach( $c_terms as $term ){
					if( array_key_exists( $term->slug , $t_items ) ){
						unset( $t_items[ $term->slug ] );
					}
				}
				foreach( $t_items as $i_slug => $i_name ){
					\wp_insert_term( $i_name , $t_name , array('slug' => $i_slug ) );
				}
				
			}
		}
		
	}

	private function programs() {

		$labels = array(
			'name'                       => 'Programs',
			'singular_name'              => 'Program',
			'menu_name'                  => 'Programs',
			'all_items'                  => 'All Programs',
			'parent_item'                => 'Parent Program',
			'parent_item_colon'          => 'Parent Program:',
			'new_item_name'              => 'New Program Name',
			'add_new_item'               => 'Add New Program',
			'edit_item'                  => 'Edit Program',
			'update_item'                => 'Update Program',
			'separate_items_with_commas' => 'Separate programs with commas',
			'search_items'               => 'Search Programs',
			'add_or_remove_items'        => 'Add or remove programs',
			'choose_from_most_used'      => 'Choose from the most used programs',
			'not_found'                  => 'Not Found',
		);
	
		$rewrite = array(
			'slug'                       => 'impact/programs',
			'with_front'                 => true,
			'hierarchical'               => false,
		);
	
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'rewrite'                    => $rewrite,
			// Legacy, uncomment upon upgrading to WP 3.9
			'archive_layout'             => 'sidebar',
		);
	
		\register_taxonomy( 'programs', 'impact', $args );

	}


	private function categories() {

		$labels = array(
			'name'                       => 'Categories',
			'singular_name'              => 'Category',
			'menu_name'                  => 'Categories',
			'all_items'                  => 'All Categories',
			'parent_item'                => 'Parent Category',
			'parent_item_colon'          => 'Parent Category:',
			'new_item_name'              => 'New Category Name',
			'add_new_item'               => 'Add New Category',
			'edit_item'                  => 'Edit Category',
			'update_item'                => 'Update Category',
			'separate_items_with_commas' => 'Separate categories with commas',
			'search_items'               => 'Search Categories',
			'add_or_remove_items'        => 'Add or remove categories',
			'choose_from_most_used'      => 'Choose from the most used categories',
			'not_found'                  => 'Not Found',
		);

		$rewrite = array(
			'slug'                       => 'impact/categories',
			'with_front'                 => true,
			'hierarchical'               => false,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'rewrite'                    => $rewrite,
			// Legacy, uncomment upon upgrading to WP 3.9
			'archive_layout'             => 'sidebar',
		);

		\register_taxonomy( 'categories', 'impact', $args );

	}


}