<?php
/**
 * Impact Report web template
 */
get_header();

while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header class="entry-header">

		<?php
			if( has_post_thumbnail() ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
				echo '<img src="' . $image[0] . '" alt="" height="164" width="489" />';
			}
		?>

    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

    <?php 
      $subtitle = get_post_meta( get_the_ID(), '_ir_subtitle', true );
      if( $subtitle )
        echo '<h3>' . esc_html( $subtitle ) . '</h3>';
    ?>

    <div class="entry-meta">

      <span class="entry-date">
        <time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
      </span><br />

    </div><!-- .entry-meta -->

		<p class="quicklinks">Jump to: <a href="#issue">Issue</a> | <a href="#response">Response</a> | <a href="#impacts">Impacts</a></p>

    <!--
    <div class="notice">  
      <p>This information was last updated on mm/dd/yy, and may be out of date</p>
      (http://codex.wordpress.org/Function_Reference/the_modified_date)
    </div>
    -->

  </header><!-- .entry-header -->
  
  <div class="sidebar">
  
    <div class="column-one">

      <?php 
        $headline = get_post_meta( get_the_ID(), '_ir_headline', true );
        if( $headline ) {
          if( strlen($headline) > 111 )
            echo '<h2 class="long">';
          else
            echo '<h2>';
          echo esc_html( $headline ) . '</h2>';
        }
      ?>

      <h4 id="issue">Issue</h4>
      <?php
        $issue = get_post_meta( get_the_ID(), '_ir_issue', true );
        if( $issue )
          echo wpautop( wp_kses_post( $issue ) );
      ?>

      <h4 id="response">Response</h4>
      <?php
        $response = get_post_meta( get_the_ID(), '_ir_response', true );
        if( $response )
          echo wpautop( wp_kses_post( str_replace( '<!--more-->', '', $response ) ) );
      ?>

      <h4 id="impacts">Impacts</h4>
      <?php
        $impacts = get_post_meta( get_the_ID(), '_ir_impacts', true );
        if( ! empty( $impacts ) )
          echo wpautop( wp_kses_post( str_replace( '<!--more-->', '', $impacts ) ) );
      ?>

    </div>

    <div class="column-two">

      <h4 id="numbers">By the numbers</h4>
      <?php
        $numbers = get_post_meta( get_the_ID(), '_ir_numbers', true );
        if( $numbers )
          echo wpautop( wp_kses_post( $numbers ) );
      ?>

			<?php
				$back_page_left = get_post_meta( $post->ID, '_ir_image_2', true );
				if( $back_page_left ) {
					$img_array = explode( '$S$', $back_page_left );
					$image = wp_get_attachment_image_src( $img_array[0], 'medium' );
					echo '<img src="' . $image[0] . '" alt="" height="182" width="219" />';
				}
				
				$back_page_right_one = get_post_meta( $post->ID, '_ir_image_3', true );
				if( $back_page_right_one ) {
					$img_array = explode( '$S$', $back_page_right_one );
					$image = wp_get_attachment_image_src( $img_array[0], 'medium' );
					echo '<img src="' . $image[0] . '" alt="" height="147" width="219" />';
				}

				$back_page_right_two = get_post_meta( $post->ID, '_ir_image_4', true );
				if( $back_page_right_two ) {
					$img_array = explode( '$S$', $back_page_right_two );
					$image = wp_get_attachment_image_src( $img_array[0], 'medium' );
					echo '<img src="' . $image[0] . '" alt="" height="147" width="219" />';
				}
			?>

      <h4 id="quotes">Quotes</h4>
      <?php
        $quotes = get_post_meta( get_the_ID(), '_ir_quotes', true );

        if( ! empty( $quotes ) )
          echo wpautop( wp_kses_post( $quotes ) );
      ?>

      <?php
        $additional_title = get_post_meta( get_the_ID(), '_ir_additional_title', true );
        $additional = get_post_meta( get_the_ID(), '_ir_additional', true );
        if( ! empty( $additional_title ) && ! empty( $additional ) ) {
          echo '<h4>' . esc_html( $additional_title ) . '</h4>';
          echo wpautop( wp_kses_post( $additional ) );
        }
      ?>

    </div>

		<br class="clear" />

  </div>

	<div>

    <div class="column-one ir-footer">

			<?php
				$footer_front = get_post_meta( get_the_ID(), '_ir_footer_front', true );
				if( ! empty( $footer_front ) )
					echo wpautop( wp_kses_post ( $footer_front ) );
			?>
	
			<?php
				$footer_back = get_post_meta( get_the_ID(), '_ir_footer_back', true );
				if( ! empty( $footer_back ) )
					echo wpautop( wp_kses_post( $footer_back ) );
			?>

		</div>

	</div>

</article>

<ul class="impact-report-tabs">
	<?php 
		$pdf_meta = get_post_meta( get_the_ID(), '_pdf_url',true );
		if( $pdf_meta ){
			echo '<li><a href="'.$pdf_meta.'">Print version (PDF) &raquo;</a></li>';
		};?>
  <li class="browse"><a href="#">Browse by Program</a>
		<ul>
			<?php
				$programs = get_terms( 'programs' );
				
				foreach ( $programs as $program ) {

					$program = sanitize_term( $program, 'programs' );
    			$program_link = get_term_link( $program, 'programs' );

					echo '<li><a href="' . esc_url( $program_link ) . '">' . $program->name . '</a></li>';

				}
			?>
		</ul>
  </li>
  <li class="browse"><a href="#">Browse by Location</a>
		<ul>
			<?php
				$locations = get_terms( 'locations' );
				
				foreach ( $locations as $location ) {

					$location = sanitize_term( $location, 'locations' );
    			$location_link = get_term_link( $location, 'locations' );

					echo '<li><a href="' . esc_url( $location_link ) . '">' . $location->name . '</a></li>';

				}
			?>
		</ul>
  </li>
</ul>

<?php

endwhile;

get_footer();
?>