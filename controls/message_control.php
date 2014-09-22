<?php namespace cahnrswp\publications\impact_reports;

class message_control {


	public function __construct() {

		\add_filter( 'post_updated_messages', array( $this, 'messages' ) );

	}


	function messages( $messages ) {

		$post             = \get_post();
		$post_type        = \get_post_type( $post );
		$post_type_object = \get_post_type_object( $post_type );

		$messages['impact'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => sprintf( __('Impact report updated. <a href="%s">View impact report</a>'), \esc_url( \get_permalink($post_ID) ) ),
			2  => __( 'Custom field updated.' ),
			3  => __( 'Custom field deleted.' ),
			/* This works, but I highly doubt it's the best way */
			4  => __( 'Your draft has been successfully sent to the Impact Reports Editor, who will respond shortly. If you have any questions, please email the editor at: <a href="mailto:alycia.rock@wsu.edu">alycia.rock@wsu.edu</a>.' ),
			/* translators: %s: date and time of the revision */
			5  => isset($_GET['revision']) ? sprintf( __('Impact report restored to revision from %s'), \wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => sprintf( __('Impact report published. <a href="%s">View impact report</a>'), \esc_url( \get_permalink($post_ID) ) ),
			7  => __( 'Impact report saved.' ),
			8  => sprintf( __('Impact report submitted. <a target="_blank" href="%s">Preview Impact report</a>'), \esc_url( \add_query_arg( 'preview', 'true', \get_permalink($post_ID) ) ) ),
			9  => sprintf( __('Impact report scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Impact report</a>'),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), \esc_url( \get_permalink($post_ID) ) ),
			10 => sprintf( __('Impact report draft updated. <a target="_blank" href="%s">Preview Impact report</a>'), \esc_url( \add_query_arg( 'preview', 'true', \get_permalink($post_ID) ) ) ),
		);

		return $messages;

	}


}
?>