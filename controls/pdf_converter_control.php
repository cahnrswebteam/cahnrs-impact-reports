<?php namespace cahnrswp\publications\impact_reports;

class pdf_converter_control {
	public $upload_dir;
	
	public function __construct(){
		$this->upload_dir = \wp_upload_dir(); // GET UPLOAD DIRECTORY ARRAY
		$this->upload_path = $this->upload_dir['basedir'].'/temp_generated_pdfs'; // SET UPLOAD PATH
		$this->upload_url = \get_site_url().'/wp-content/uploads/temp_generated_pdfs';
		\add_action( 'save_post', array( $this ,'save_pdf' ), 20 , 1 ); // SAVE HOOK
	}
	
	public function save_pdf( $post_id ){
		if( $this->check_directory() ){
			$file = $this->create_pdf( $post_id );
		}
	}
	
	public function check_directory(){
		if (!file_exists( $this->upload_path )) { // CHECK IF DIRECTORY EXISTS
   			\mkdir( $this->upload_path, 0777, true ); // IF NOT CREATE DIRECTORY
		}
		return true;
	}
	
	private function create_pdf( $post_id ){
		global $post;
		$file = array();
		$file['name'] = $post->post_name.'-'.$post_id;
		$file['path'] = $this->upload_path.'/'.$file['name'].'.pdf';
		$file['url'] = $this->upload_url.'/'.$file['name'].'.pdf';
		require_once(DIR.'dompdf/dompdf_config.inc.php');
		define('CURRENTURL', 'http://m1.wpdev.cahnrs.wsu.edu/wp-content/plugins/impact-reports');
		ob_start();
		include DIR.'/dompdf/layouts/impact-report-2.php';
		$html = ob_get_clean();
		if( $html ){
			$dompdf = new \DOMPDF();
			$dompdf->load_html($html);
			$dompdf->render();
			$is_existing = $this->get_attachment_by_post_name( $file['name'] );
			if( $is_existing ) {
				$url = $is_existing->guid;
				$base = explode('/wp-content/' , $url );
				$path = \ABSPATH.'wp-content/'.$base[1];
				\file_put_contents( $path, $dompdf->output() );
				$this->add_url_meta( $post_id , $url );
			} else {
				\file_put_contents( $file['path'], $dompdf->output() );
				$this->upload_to_library( $file , $post_id );
			}
			return $file;
		} else {
			return false;
		}
	}
	
	private function upload_to_library( $file , $post_id ){		
		$file_array = array(
        	'name' => $file['name'].'.pdf',
        	'tmp_name' => $file['path']
    	);
		$id = media_handle_sideload( $file_array, $post_id );
		if( $id ){
			$attach_url = \wp_get_attachment_url( $id );
			$this->add_url_meta( $post_id , $attach_url );
		}
		return true;
	}
	
	private function get_attachment_by_post_name( $post_name ) {
        $args = array(
            'post_per_page' => 1,
            'post_type'     => 'attachment',
            'name'          => trim ( $post_name ),
        );
        $get_posts = new \Wp_Query( $args );

        if ( $get_posts->posts[0] )
            return $get_posts->posts[0];
        else
          return false;
    }
	private function add_url_meta( $post_id , $pdf_url ){
		if( $pdf_url ){
			\update_post_meta( $post_id , 'pdf_link' , $pdf_url );
		}
	}
}
?>