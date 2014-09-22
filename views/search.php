<?php
/**
 * Impact Report search results template
 *
 * http://wordpress.org/support/topic/search-custom-post-types-and-the-meta-boxes
 */
get_header();

// Results count, doesn't seem to be accurate
global $wp_query;
$search_results = $wp_query->found_posts;
?>
<div id="main">
	<h1>Impact Reports</h1>
  <p><?php echo $search_results; ?> result<?php if ( $search_results != 1 ) echo 's'; ?> for "<?php echo get_search_query(); ?>"</p>
	<?php

		while( have_posts() ) : the_post();
	
			echo '<div style="clear:both;float:left;margin-bottom:20px;width:100%;">';
			the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
			if( has_post_thumbnail() ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
				echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><img src="' . $image[0] . '" alt="" class="alignleft" height="150" width="150" /></a>';
			}
			echo '<h6>' . esc_html( get_the_date() ) . '</h6>';
			$summary = get_post_meta( get_the_ID(), '_ir_summary', true );
			if( $summary )
				echo wpautop( wp_kses_post( $summary ) );
			echo '</div>';
	
		endwhile;
		
		wipPaginationNav();

	?>
</div><!-- #main -->
<div id="secondary">

	<form id="searchform" action="<?php bloginfo('home'); ?>/" method="get" style="margin-bottom: 15px;">
		<input type="text" name="s" id="s" maxlength="150" value="" placeholder="Search Impact Reports" style="width: 87%;" />
		<input type="hidden" name="post_type" value="impact" />
		<input type="submit" id="searchsubmit" value="Search" style="background: url( <?php echo plugins_url( 'cahnrs-impact-reports' ) . '/images/search-arrow.png'; ?> ) no-repeat; border: none; margin: 0; max-width: 13px; overflow: hidden; padding: 0; text-indent: 100%; white-space: nowrap; width: 10%;" />
	</form>

  <!--<h4>Browse by Program</h4>-->
  <?php /*
    $programs = get_terms( 'programs' );
    $program_count = count( $programs );

    echo '<ul>';
    foreach ( $programs as $program ) {

      $program = sanitize_term( $program, 'programs' );
      $program_link = get_term_link( $program, 'programs' );

      echo '<li><a href="' . esc_url( $program_link ) . '">' . $program->name . '</a></li>';

    }
    echo '</ul>'; */
  ?>
  <?php
    $locations = get_terms( 'locations' );
    $location_count = count( $locations );
		
		echo '<p><select onChange="window.location.href=this.value" style="width:100%;">';
		echo '<option value="">Browse by Location</option>';
		foreach ( $locations as $location ) {

      $location = sanitize_term( $location, 'locations' );
      $location_link = get_term_link( $location, 'locations' );

      echo '<option value="' . esc_url( $location_link ) . '">' . $location->name . '</option>';

    }
		echo '</select></p>';
		
		
/*
    echo '<ul>';
    foreach ( $locations as $location ) {

      $location = sanitize_term( $location, 'locations' );
      $location_link = get_term_link( $location, 'locations' );

      echo '<li><a href="' . esc_url( $location_link ) . '">' . $location->name . '</a></li>';

    }
    echo '</ul>';
*/
  ?>
</div><!-- #secondary -->
<?php

get_footer();
?>