<?php
/**
 * Impact Report web template for legacy theme
 */
get_header();
if(have_posts() ) :
?>
<div id="main">
	<h1><?php if( is_tax() ) echo get_queried_object()->name . ' '; ?>Impact Reports</h1>
<?php

	if ( is_tax() ) {
		
		$description = term_description();
		if( ! empty( $description ) )
			echo wpautop( wp_kses_post( $description ) );

		while( have_posts() ) : the_post();

			the_title( '<h4 class="entry-title" style="padding:0;"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
			echo '<h6>' . esc_html( get_the_date() ) . '</h6>';

			/* New
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
*/

		endwhile;

		wipPaginationNav();

	} else {

		// Widget area
		if( is_active_sidebar( 'impact-report-archive' ) )
			dynamic_sidebar( 'impact-report-archive' );

		while( have_posts() ) : the_post();

			the_title( '<h4 class="entry-title" style="padding:0;"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
			echo '<h6>' . esc_html( get_the_date() ) . '</h6>';

		endwhile;

		// Comment this guy out when ready to launch the new stuff
		wipPaginationNav();

		/* New
		$categories = get_terms( 'categories' );

		foreach ( $categories as $category ) {
      $category = sanitize_term( $category, 'categories' );
			$category_link = get_term_link( $category, 'categories' );
			$args = array(
				'post_type'      => 'impact',
				'categories'     => $category->name,
				'posts_per_page' => 1
			);
			$category_query = new WP_Query( $args );
			if ( $category_query->have_posts() ) :
				while ( $category_query->have_posts() ) : $category_query->the_post();
					if( has_post_thumbnail() ) {
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
						echo '<a href="' . esc_url( $category_link ) . '" style="position:relative;">';
						echo '<img src="' . $image[0] . '" alt="" />';
						echo '<span style="background: rgba( 152, 30, 50, 0.90 ); bottom: 0; color: #fff; font-size: 1.5em; left: 0; margin-bottom: 15px; padding: 0.3em 1em; position: absolute;">' . $category->name . '</span>';
						echo '</a>';
					}
				endwhile;
			endif;
			wp_reset_postdata();
		}
 */

	}

?>
</div><!-- #main -->
<div id="secondary">
<!--
	<form id="searchform" action="<?php bloginfo('home'); ?>/" method="get" style="margin-bottom: 15px;">
		<input type="text" name="s" id="s" maxlength="150" value="" placeholder="Search Impact Reports" style="width: 87%;" />
		<input type="hidden" name="post_type" value="impact" />
		<input type="submit" id="searchsubmit" value="Search" style="background: url( <?php echo plugins_url( 'cahnrs-impact-reports' ) . '/images/search-arrow.png'; ?> ) no-repeat; border: none; margin: 0; max-width: 13px; overflow: hidden; padding: 0; text-indent: 100%; white-space: nowrap; width: 10%;" />
	</form>
-->
  <?php
/*
		$categories = get_terms( 'categories' );
		echo '<p><select onChange="window.location.href=this.value" style="width:100%;">';
		echo '<option value="">Browse by Category</option>';
		foreach ( $categories as $category ) {

      $category = sanitize_term( $category, 'categories' );
      $category_link = get_term_link( $category, 'categories' );

      echo '<option value="' . esc_url( $category_link ) . '">' . $category->name . '</option>';

    }
		echo '</select></p>';
*/
  ?>
  <?php
    $locations = get_terms( 'locations' );
		
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
endif;
get_footer();
?>