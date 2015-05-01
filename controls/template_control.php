<?php namespace cahnrswp\publications\impact_reports;

class template_control {
	
	public function __construct() {
		\add_filter( 'template_include', array( $this, 'templates' ), 1 );
	}
	
	public function templates( $template ) {

		if ( \get_post_type() == 'impact' ) {

			if ( isset( $_GET['pdf'] ) ) { 
				$template = DIR . 'dompdf/render-pdf.php'; 
			}
			else if ( \is_single() ) {
				$template = DIR . 'views/legacy-single.php';
			}

		}
		
		if ( \is_post_type_archive( 'impact' ) )
			$template = DIR . 'views/legacy-archive.php';

		if ( is_front_page() && isset( $_GET['resized'] ) )
			$template = DIR . 'views/image-resized.php';

		if ( \is_search() && $_GET['post_type'] == 'impact' )
			$template = DIR . 'views/search.php';

		return $template;

	}

}