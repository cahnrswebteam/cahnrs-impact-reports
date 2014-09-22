<?php
/**
 * Main template file
 *
 * Based on Twentyfourteen
 *
 */

get_header();

if ( have_posts() ) : ?>

	<header class="page-header">

		<h1 class="page-title"><?php if( is_tax() ) echo get_queried_object()->name . ' '; ?>Impact Reports</h1>

	</header>

	<div class="sidebar">

		<div class="column-one">

			<?php
				// Widget area
				if( is_active_sidebar( 'impact-report-archive' ) )
					dynamic_sidebar( 'impact-report-archive' );
			?>

			<?php
				// The loop
				while ( have_posts() ) : the_post();
			?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">

						<?php the_title( '<h1 class="entry-title" style="padding:0;"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>

						<?php
							//the_title( '<h1 class="entry-title" style="padding:0;"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a> | <a href="' . esc_url( get_permalink() ) . '?pdf">PDF</a></h1>' );
						?>

						<?php // Make this conditional based on theme options? ?>
						<div class="entry-meta" style="padding-bottom:12px;">

							<span class="entry-date">
								<time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
							</span>
<!--
							<span class="byline">
								<a class="url fn n" href="<?php /* echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); */ ?>" rel="author"><?php /* echo get_the_author(); */ ?></a>
							</span>
-->
						</div>

					</header>

				</article>

			<?php

			endwhile;

			cahnrs_paging_nav();

			?>

		</div>

		<div class="column-two">

			<h4>Browse by Program</h4>

      <?php
				$programs = get_terms( 'programs' );
				$program_count = count( $programs );

				echo '<ul>';
				foreach ( $programs as $program ) {

					$program = sanitize_term( $program, 'programs' );
    			$program_link = get_term_link( $program, 'programs' );

					//echo '<li><a href="' . esc_url( $program_link ) . '">' . $program->name . '</a> (' . $program->count . ')</li>';
					echo '<li><a href="' . esc_url( $program_link ) . '">' . $program->name . '</a></li>';

				}
				echo '</ul>';
			?>
	
			<h4>Browse by Location</h4>

      <?php
				$locations = get_terms( 'locations' );
				$location_count = count( $locations );

				echo '<ul>';
				foreach ( $locations as $location ) {

					$location = sanitize_term( $location, 'locations' );
    			$location_link = get_term_link( $location, 'locations' );

					//echo '<li><a href="' . esc_url( $location_link ) . '">' . $location->name . '</a> (' . $location->count . ')</li>';
					echo '<li><a href="' . esc_url( $location_link ) . '">' . $location->name . '</a></li>';

				}
				echo '</ul>';
			?>

		</div>

	</div>

<?php
else :

	get_template_part( 'content', 'none' );

endif;

get_footer();
?>