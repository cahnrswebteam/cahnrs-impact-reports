<?php namespace cahnrswp\publications\impact_reports;
/**
 * Custom meta data inputs
 */

class metabox_control {


	public $ir_field_array, $ir_editor_array;


	public function __construct(){

		\add_action( 'load-post.php',     array( $this, 'metabox_handler' ) );
		\add_action( 'load-post-new.php', array( $this, 'metabox_handler' ) );

	}


	public function metabox_handler(){

		$this->ir_field_array  = $this->ir_define_fields();
		$this->ir_editor_array = $this->ir_define_editors();

		\add_action( 'add_meta_boxes',         array( $this, 'ir_add_meta_box'                ) );
		\add_action( 'save_post',              array( $this, 'ir_save'                        ) );
		\add_action( 'edit_form_after_editor', array( $this, 'ir_full_editors'                ) );
		\add_action( 'edit_form_after_title',  array( $this, 'ir_advanced_meta_box_placement' ) );

		// Legacy, either remove or update upon upgrading to WP 3.9
		$screen = \get_current_screen();
		if ( $screen->post_type == 'impact' ) \remove_filter( 'tiny_mce_before_init', 'wipFormatTinyMCE' );

	}


	// Add the meta box containers
	public function ir_add_meta_box( $post_type ) {

		add_meta_box(
			'impact_report_fields',
			'Header and Contact Information',
			array( $this, 'ir_fields_meta_content' ),
			'impact',
			'advanced',
			'high'
		);

		add_meta_box(
			'send_to_edit',
			'Ready For Edit',
			array( $this, 'ir_send_to_edit' ),
			'impact',
			'side',
			'high'
		);

		add_meta_box(
			'impact_report_images',
			'Additional Images',
			array( $this, 'ir_images_meta_content' ),
			'impact',
			'side',
			'low'
		);

	}


	// Define metabox fields
	public function ir_define_fields() {

		$ir_fields = array(
			'ir_image_1'          => array(
				'title' => 'front page: left column bottom image',
				'desc'  => '(optional; at least <strong>550</strong> pixels wide)',
				'type'  => 'img',
			),
			'ir_image_2'          => array(
				'title' => 'back page: first banner image',
				'desc'  => '(at least <strong>550 × 450</strong> pixels [wide × tall])',
				'type'  => 'img',
			),
			'ir_image_3'          => array(
				'title' => 'back page: second banner image',
				'desc'  => '(at least <strong>677 × 450</strong> pixels [wide × tall])',
				'type'  => 'img',
			),
			'ir_image_4'          => array(
				'title' => 'back page: third banner image',
				'desc'  => '(at least <strong>677 × 450 pixels</strong> [wide × tall])',
				'type'  => 'img',
			),
			'ir_image_5'          => array(
				'title' => 'back page: left column bottom image',
				'desc'  => '(optional; at least <strong>550</strong> pixels wide)',
				'type'  => 'img',
			),
			'ir_subtitle'         => array(
				'title' => 'Subtitle',
				'desc'  => '<em>Optional</em>',
				'type'  => 'text',
			),
			'ir_headline'         => array(
				'title' => 'Headline',
				'desc'  => '<em>Optional</em>',
				'type'  => 'text',
			),
			'ir_impacts_position' => array(
				'title' => 'Start "Impacts" section on front page',
				'desc'  => '',
				'type'  => 'checkbox',
			),
			'ir_additional_title' => array(
				'title' => 'Enter title for additional area here',
				'desc'  => '',
				'type'  => '',
			),
			'ir_author'           => array(
				'title' => 'Report Author Email Address',
				'desc'  => '(not displayed)',
				'type'  => 'text',
			),
		);

		return $ir_fields;

	}


	// Define wp_editors
	public function ir_define_editors() {

		$ir_editors = array(
			'ir_summary'      => array(
				'title' => 'Summary',
				'desc'  => 'Summarize the project in 60 words or fewer',
				'type'  => '',
			),
			'ir_issue'        => array(
				'title' => 'Issue',
				'desc'  => 'Describe why the project was initiated',
				'type'  => 'main',
			),
			'ir_response'     => array(
				'title' => 'Response',
				'desc'  => 'Summarize the work that transpired in response to the issue',
				'type'  => 'main',
			),
			'ir_impacts'      => array(
				'title' => 'Impacts',
				'desc'  => 'Outline the actual or likely result of the project',
				'type'  => 'main',
			),
			'ir_numbers'      => array(
				'title' => 'By the Numbers',
				'desc'  => 'List quantitative results of the project',
				'type'  => 'front-sidebar',
			),
			'ir_quotes'       => array(
				'id'    => 'reportquotes',
				'title' => 'Quotes',
				'desc'  => 'Highlight supporting testimony of the project',
				'type'  => 'back-sidebar',
			),
			'ir_additional'   => array(
				'title' => 'Additional',
				'desc'  => 'Optional area for any further information (e.g. Partners, Grants & Donors, etc.)',
				'type'  => 'back-sidebar',
			),
			'ir_footer_front' => array(
				'title' => 'Front page footer',
				'desc'  => 'Contact information for the project lead',
				'type'  => '',
			),
			'ir_footer_back'  => array(
				'title' => 'Back page footer',
				'desc'  => 'For more information about the project',
				'type'  => '',
			),
		);

		return $ir_editors;

	}


	// Add the fields
	public function ir_fields_meta_content( $post ) {
		
		echo '<p>Click the "Help" tab at the top right of the screen for more information on creating an Impact Report</p>';

		foreach ( $this->ir_field_array as $i_k => $i_d ) {

			if ( $i_d['type'] == 'text' ) {

				wp_nonce_field( 'impact_report_custom_box', 'impact_report_custom_box_nonce' );

				$value = get_post_meta( $post->ID, '_' . $i_k, true );

				echo '<strong><label for="' . $i_k . '">' . $i_d['title'] . '</label></strong><br />';
				
				if ( $i_d['desc'] != '' )
					echo '<span>' . $i_d['desc'] . '</span><br />';

				echo '<input type="text" id="' . $i_k . '" name="' . $i_k . '" value="'. esc_attr( $value ) .'" />';

			}
			
		}

	}


	// Add the "Ready for Edit" button
	public function ir_send_to_edit() {

		echo '<label for="send-to-edit">Click the "Submit for Review" button below <em>after</em> a draft of the report has been saved and it is ready for an editorial review.</label><br />';
		echo '<div id="ir-send-button"><input class="button button-primary button-large" name="send-to-edit" type="submit" value="Submit for Review" /></div>';
		echo '<div class="clear"></div>';

	}


	// Add the image fields
	public function ir_images_meta_content( $post ) {
		
		foreach ( $this->ir_field_array as $i_k => $i_d ) {

			if ( $i_d['type'] == 'img' ) {

				$i_meta      = get_post_meta( $post->ID, '_' . $i_k,           true );
				$i_meta_path = get_post_meta( $post->ID, '_' . $i_k . '-path', true );
	
				echo '<div class="upload-set-wrapper" style="padding: 0 0 20px;">';
				echo '<input id="' . $i_k . '" class="upload-image-id" type="text" name="' . $i_k . '" value="'. $i_meta .'" />';
				echo '<p class="hide-if-no-js"><a href="#" title=" ' . $i_d['title'] . '" id="upload-image-button-' . $i_k . '" class="upload-image-button">';
				if ( $i_meta ) {

					$img_array = explode( '$S$', $i_meta );
					$image     = wp_get_attachment_image_src( $img_array[0], 'medium' );
	
					echo '<img src="' . $image[0] . '" /></a></p>';
					echo '<p class="hide-if-no-js"><a href="#" class="remove-ir-image">Remove ' . $i_d['title'] . '</a></p>';
	
				} else {
	
					echo 'Set ' . $i_d['title'] . '</a></p>';
	
				}
				echo '<p class="ir-image-size">' . $i_d['desc'] . '</p>';
				echo '</div>';

			}

		}

	}


	// Add the editors
	public function ir_full_editors( $post ) {

		if ( $post->post_type != 'impact' )
			return;
/* Uncomment upon updgrading to WP 3.9
		$editor_settings = array(
			'media_buttons' => false,
			'quicktags'     => false,
			'textarea_rows' => '6',
			'tinymce'       => array(
				'toolbar1' => 'bold italic bullist numlist outdent indent link unlink undo redo wp_more',
				'toolbar2' => '',
        'toolbar3' => '',
        'toolbar4' => '',
			),
		);
*/

		/* Legacy, remove upon upgrading to WP 3.9 */
		$editor_settings = array(
			'media_buttons' => false,
			'quicktags'     => false,
			'textarea_rows' => '6',
			'tinymce'       => array(
				'theme_advanced_buttons1' => 'bold,italic,underline,|,bullist,numlist,blockquote,|,outdent,indent,|,link,unlink,|,undo,redo,wp_more',
				'theme_advanced_buttons2' => '',
        'theme_advanced_buttons3' => '',
        'theme_advanced_buttons4' => '',
			),
		);

		foreach ( $this->ir_editor_array as $i_k => $i_d ) {

			echo '<h3 class="irtitle">' . $i_d['title'] . '</h3>';
			echo '<p class="irdescription">' . $i_d['desc'] . '</p>';

			// Checkbox for Impacts Position
			if ( $i_k == 'ir_impacts' ) {

				$value = get_post_meta( $post->ID, '_ir_impacts_position', true );

				echo '<label for="ir_impacts_position">';
				echo '<input type="checkbox" name="ir_impacts_position" id="ir_impacts_position" value="front"';
				checked( $value, 'front' );
				echo '/>';
				echo 'Start "Impacts" section on front page';
				echo '</label>';

			}

			// Title field for Additional area
			if ( $i_k == 'ir_additional' ) {

				$value = get_post_meta( $post->ID, '_ir_additional_title', true );

				echo '<div id="ir-add-title-wrap">';
				echo '<label';
				if ( $value )
					echo ' class="screen-reader-text"';
				echo ' id="ir-additional-title-prompt-text" for="ir_additional_title">Enter title for additional area here</label>';
				echo '<input type="text" id="ir_additional_title" name="ir_additional_title" value="' . esc_attr( $value ) . '" />';
				echo '</div>';

			}

			$value = get_post_meta( $post->ID, '_' . $i_k, true );

			wp_editor( html_entity_decode( $value ), $i_k, $editor_settings );

			// Counter for main body components
			if ( $i_d['type'] == 'main' )
				echo '<div class="ir-main-counter widget-top find-box-buttons">Main body characters remaining: <span></span></div>';

			// Counter for front page sidebar
			if ( $i_d['type'] == 'front-sidebar' )
				echo '<div class="ir-front-sidebar-counter widget-top find-box-buttons">Front page sidebar characters remaining: <span></span></div>';

			// Counter for back page sidebar components
			if ( $i_d['type'] == 'back-sidebar' )
				echo '<div class="ir-back-sidebar-counter widget-top find-box-buttons">Back page sidebar characters remaining: <span></span></div>';

		}

	}


	// Move all "Advanced" context meta boxes under the Title field
	public function ir_advanced_meta_box_placement() {

    global $post, $wp_meta_boxes;

		if ( $post->post_type == 'impact' ) {

    	do_meta_boxes( get_current_screen(), 'advanced', $post );

    	unset( $wp_meta_boxes['impact']['advanced'] );

		}

	}


	// Save the meta when the post is saved
	public function ir_save( $post_id ) {

		// Verify this came from our screen with proper authorization:

		// Check if our nonce is set
		if ( ! isset( $_POST['impact_report_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['impact_report_custom_box_nonce'];

		// Verify that the nonce is valid
		if ( ! wp_verify_nonce( $nonce, 'impact_report_custom_box' ) )
			return $post_id;

		// If this is an autosave, the form has not been submitted, so don't do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

/* Straight from the codex, modify if keeping */

		// Check the user's permissions
		//if ( $_POST['post_type'] == 'page' ) {

			//if ( ! current_user_can( 'edit_page', $post_id ) )
				//return $post_id;

		//} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;

		//}

		// Sanitize and save the data:

		// The wp_editors
		foreach ( $this->ir_editor_array as $i_k => $i_d ) {

			if ( $i_d['type'] == 'checkbox' ) {

				if ( isset( $_POST[$i_k] ) )
					update_post_meta( $post_id, '_' . $i_k, 'front' );
				else
    			delete_post_meta( $post_id, '_' . $i_k );

			} else {

				if ( isset( $_POST[$i_k] ) && $_POST[$i_k] != '' )
					update_post_meta( $post_id, '_' . $i_k, wp_kses_post( $_POST[$i_k] ) );
				else
					delete_post_meta( $post_id, '_' . $i_k );

			}

		}


		// The metaboxes
		foreach ( $this->ir_field_array as $i_k => $i_d ) {

			if ( isset( $_POST[$i_k] ) && $_POST[$i_k] != '' )
				update_post_meta( $post_id, '_' . $i_k, sanitize_text_field( $_POST[$i_k] ) );
			else
				delete_post_meta( $post_id, '_' . $i_k );
			
		}


		// Send to editor
		// http://wpthemetutorial.com/wp_function/wp_mail/ - ?
		// http://codex.wordpress.org/Plugin_API/Action_Reference/publish_post
		// http://codex.wordpress.org/Post_Status_Transitions
		if ( isset( $_POST['send-to-edit'] ) ) {

			if ( wp_is_post_revision( $post_id ) )
				return;
				
			$post         = get_post($post_id);
			$author       = get_userdata($post->post_author);
			$author_email = $author->user_email;
			$author_name  = $author->display_name;
			$ir_title     = get_the_title( $post->ID );
			$ir_link      =  get_edit_post_link( $post->ID, '&'  );

			$to = 'alycia.rock@wsu.edu';
			$subject = 'Impact Report ready for editing';
			$headers = 'From: ' . $author_name . ' <' . $author_email . '>';
			$message = 'My impact report titled "' . $ir_title . '" is ready to be edited.';
			$message = $author->display_name . 'has saved a draft of an impact report to the system. Please review the document and take any necessary action. Thank you. View/Edit Report: ' .$ir_link;
			
			wp_mail( $to, $subject, $message, $headers );

		}


	}
}
?>