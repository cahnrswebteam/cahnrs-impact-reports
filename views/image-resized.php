<?php
/**
 * Image resize stream test
 */

$image = wp_get_attachment_image_src( $post->ID, 'full' );
$image_path = $image[0];


// See if the server supports what we want to do
$image_editor_args = array(
	//'mime_type' => get_post_mime_type( $post_id ),
	'methods' => array(
		'resize'
	)
);


// If the server supports it, do it
if( wp_image_editor_supports( $image_editor_args ) ) {

	$img = wp_get_image_editor( $image_path );

	if ( ! is_wp_error( $img ) ) {

			$img->resize( $_GET['width'], $_GET['height'], $_GET['crop'] );
			$img->set_quality( 100 );
			$img->stream();

	}

}
?>