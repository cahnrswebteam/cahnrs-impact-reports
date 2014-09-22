<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			$program = wp_get_post_terms( $post->ID, 'programs', array( 'fields' => 'slugs' ) );
?>
<!DOCTYPE html>
<html>

  <head>
		<style type="text/css">
			@page { 
				margin: 5px; 
				font-size: 14px;
				}
			body { 
				margin: 5px; 
				background-image: url(<?php echo CURRENTURL; ?>/dompdf/images/border-black.gif);
				background-repeat: repeat-y;
				background-position: 230px 0;
				font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
				font-size: 14px;
				color: #333;
				}
			.page-break	{ display: block; page-break-before: always; }
			/*.primary-color { color: #329a4b; }
			.secondary-color { color: #b6bf00; }
			.tertiary-color { color: #6d7377; }
			*/
			a { text-decoration: none; }
			h1 { font-size: 31px; font-weight: normal; line-height: 35px; margin: 0; padding: 15px 0 0 0; text-align: right; text-transform: uppercase; }
			h2 { font-weight: normal; font-size: 22px; font-style: italic; line-height: 1em; margin: 0; padding: 15px 0 0 0; }
			h2.long { font-size: 18px; line-height: 1.3em; }
			h3 { font-size: 20px; font-weight: normal; margin: 0; padding: 15px 0 0 0; }
			h4 { color: #6d7377; font-size: 16px; margin: 0; padding: 15px 0 0 0; text-transform: uppercase; }

			.logo-area,
			.site-address,
			.left-column { width: 230px; display: inline-block; word-wrap: break-word; position: relative; }
			.logo-area img { width: 220px; height: 188px; margin: 0; }
			.banner-area,
			.footer-copy.double-column,
			.content-column { width: 560px; display: inline-block; padding: 0 0 10px 0; }
			.banner-area.single-banner img { width: 555px; height: 188px; margin-left: 10px; }
			.banner-area.double-banner img { width: 272px; height: 188px; margin-left: 10px; }
			.header { border-bottom: 1px solid #000000; }
			.footer { position: absolute; bottom: 0; left: 0; border-top: 1px solid #000000; }
			.footer.inner-page { page-break-after: always; }
			.footer.full-width { background-color: #ffffff; }
			
			.site-address-inner { height: 30px; margin: 10px 10px 0 0; padding: 8px; text-align: center; }
			.site-address-inner a { color: #ffffff; text-decoration: none; font-weight: bold; line-height: 25px; }
			.footer-copy-inner { color: #555; font-size: 11px; margin: 20px 0 0 10px; text-align: center; }
			.single-column .footer-copy-inner { margin: 15px 0 5px 15px; text-align: center; }
			.footer-copy p { margin: 0; padding: 0; }
			.footer-copy-inner img { max-width: 285px; }
			.site-address-inner a,
			.footer-copy-inner a { font-weight: bold; }
			
			.left-column .inner-copy { margin: 0 10px; }
			.left-column .inner-copy ul { margin: 0; padding: 0 0 0 20px; }
			.left-column .inner-copy li { padding: 6px 0 6px 0; }
			
			.content-column .inner-copy { margin: 0 15px 0 15px; }
			.content-column .inner-copy li { padding-bottom: 6px; padding-top: 6px; }
			.content-column .inner-copy p, content-column .inner-copy li { text-align: justify; }
			.content-column .inner-copy li ul li { text-align: left; }
/*
			#front-bottom-image { bottom: 67px; left: 0; position: absolute; }
			#back-bottom-image { bottom: 123px; left: 0; position: absolute; }
*/
			.bottom-left-image { left: 0; position: absolute; }

			<?php if ( $program[0] == '4h' ) : ?>
      h1, h2, .footer-copy-inner strong, .footer-copy-inner a { color: #329a4b; }
      .site-address-inner { background-color: #329a4b; }
      h3 { color: #b6bf00; }
      <?php endif; ?>

      <?php if ( $program[0] == 'beach-watchers' ) : ?>
      h1, h2, .footer-copy-inner strong, .footer-copy-inner a { color: #8ea1b4; }
      .site-address-inner { background-color: #8ea1b4; }
      h3 { color: #72a494; }
      <?php endif; ?>

      <?php if ( $program[0] == 'extension' ) : ?>
      h1, h2, .footer-copy-inner strong, .footer-copy-inner a { color: #951734; }
      .site-address-inner { background-color: #951734; }
      h3 { color: #951734; }
      <?php endif; ?>

      <?php if ( $program[0] == 'food-sense' ) : ?>
      h1, h2, .footer-copy-inner strong, .footer-copy-inner a { color: #e09a31; }
      .site-address-inner { background-color: #e09a31; }
      h3 { color: #3cb6ce; }
      <?php endif; ?>

      <?php if ( $program[0] == 'master-gardeners' ) : ?>
      h1, h2, .footer-copy-inner strong, .footer-copy-inner a { color: #4b3000; }
      .site-address-inner { background-color:#4b3000; }
      h3 { color: #b6bf00; }
      <?php endif; ?>

		</style>
	</head>

	<body>

		<!-- ***** START HEADER **** -->
		<div class="header">
			<div class="logo-area">
				<?php
					if ( ! empty( $program ) )
						echo '<img src="' . plugins_url( 'cahnrs-impact-reports' ) . '/images/' . $program[0] . '-mark.jpg" alt="" height="190" width="230" />';
				?>
			</div><div class="banner-area single-banner">
				<?php
					if ( has_post_thumbnail() ) {
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
						if ( $image[1] >= '1370' && $image[2] >= '450' ) {
							$resize_src = get_attachment_link( get_post_thumbnail_id( $post->ID ) );
							echo '<div><img src="' . $resize_src . '?resized&width=1370&height=450&crop=true" alt=""/></div>';
						}
					}
				?>
			</div>
		</div>
		<!-- ***** START LEFT COLUMN **** -->
		<div class="left-column">
			<div class="inner-copy">
			<h1 class="primary-color"><?php the_title(); ?>&nbsp;</h1>
			<?php 
				$subtitle = get_post_meta( get_the_ID(), '_ir_subtitle', true );
				if ( ! empty( $subtitle ) )
					echo '<h3 class="secondary-color">' . esc_html( $subtitle ) . '</h3>';
			?>
			<h4><span class="indicator secondary-color-bg"></span>BY THE NUMBERS</h4>
			<?php
      	$numbers = get_post_meta( get_the_ID(), '_ir_numbers', true );
				if ( ! empty( $numbers ) )
					echo wpautop( wp_kses_post( $numbers ) );
			?>
			</div>
<!--
			<div id="front-bottom-image">
			<?php /*
				$page_one_left = get_post_meta( $post->ID, '_ir_image_1', true );
				if ( $page_one_left ) {
					$img_array = explode( '$S$', $page_one_left );
					$image = wp_get_attachment_image_src( $img_array[0], 'full' );
					if ( $image[1] >= '550' ) {
						$resize_src = get_attachment_link( $img_array[0] );
						echo '<img src="' . $resize_src . '?resized&width=550&crop=true" width="220" />';
					}
				} */
			?>
			</div>
-->
		</div>
		<!-- ***** START CENTER COLUMN **** -->
		<div class="content-column">
			<div class="inner-copy">
				<?php
					$headline = get_post_meta( get_the_ID(), '_ir_headline', true );
					if ( ! empty( $headline ) ) {
						if ( strlen($headline) > 111 )
							echo '<h2 class="long">';
						else
							echo '<h2>';
						echo esc_html( $headline ) . '</h2>';
					}
				?>	
				<h4>Issue</h4>
				<?php
        	$issue = get_post_meta( get_the_ID(), '_ir_issue', true );
					if ( ! empty( $issue ) )
						echo wpautop( wp_kses_post( $issue ) );
				?>
				<h4>Response</h4>
				<?php
					$response = get_post_meta( get_the_ID(), '_ir_response', true );
					$response_split = ( $response ) ? preg_split( '/<!--more-->/', $response ): false;
					if ( $response_split ) echo wpautop( wp_kses_post( $response_split[0] ) );
				?>
				<?php
					$impacts_position = get_post_meta( get_the_ID(), '_ir_impacts_position', true );
					$impacts = get_post_meta( get_the_ID(), '_ir_impacts', true );
					if ( $impacts_position == 'front' ) { // should add a check against $response_split
						if ( ! empty( $impacts ) ) {
							echo '<h4>Impacts</h4>';
							$impacts_split = ( $impacts ) ? preg_split( '/<!--more-->/', $impacts ): false;
							if ( $impacts_split ) echo wpautop( wp_kses_post( $impacts_split[0] ) );
						}
					}
				?>
			</div>
		</div>
		<!-- ***** START FOOTER **** -->
		<div class="footer inner-page">
			<?php
				$page_one_bottom_left = get_post_meta( $post->ID, '_ir_image_1', true );
				if ( $page_one_bottom_left ) {
					$img_array = explode( '$S$', $page_one_bottom_left );
					$image = wp_get_attachment_image_src( $img_array[0], 'full' );
					if ( $image[1] >= '550' ) {
						$proportion = 222 / $image[1];
						$margin = round( ( $proportion * $image[2] ) + 7 );
						$resize_src = get_attachment_link( $img_array[0] );
						echo '<img class="bottom-left-image" src="' . $resize_src . '?resized&width=550&crop=true" width="220" style="top: -' . $margin . 'px;" />';
					}
				}
			?>
			<div class="site-address">
				<div class="site-address-inner">
					<a href="<?php echo get_post_type_archive_link( 'impact-report' ); ?>">http://ext100.wsu.edu/impact/</a>
				</div>
			</div><div class="footer-copy double-column">
				<div class="footer-copy-inner">
					<?php
          	$footer_one = get_post_meta( get_the_ID(), '_ir_footer_front', true );
						if( ! empty( $footer_one ) )
							echo wpautop( wp_kses_post ( $footer_one ) );
					?>
				</div>
			</div>
		</div>
		<!-- ***** START HEADER **** -->
		<div class="header">
			<div class="logo-area">
				<?php 
					$ir_banner_2_1 = get_post_meta( $post->ID, '_ir_image_2', true );
					if( $ir_banner_2_1 ) {
						$img_array = explode( '$S$', $ir_banner_2_1 );
						$image = wp_get_attachment_image_src( $img_array[0], 'full' );
						if( $image[1] >= '550' && $image[2] >= '450' ) {
							$resize_src = get_attachment_link( $img_array[0] );
							echo '<img src="' . $resize_src . '?resized&width=550&height=450&crop=true" alt="" />';
						}
					}
				?>
			</div><div class="banner-area double-banner">
				<?php
					$ir_banner_2_2 = get_post_meta( $post->ID, '_ir_image_3', true );
					if( $ir_banner_2_2 ) {
						$img_array = explode( '$S$', $ir_banner_2_2 );
						$image = wp_get_attachment_image_src( $img_array[0], 'full' );
						if( $image[1] >= '677' && $image[2] >= '450' ) {
							$resize_src = get_attachment_link( $img_array[0] );
							echo '<img src="' . $resize_src . '?resized&width=677&height=450&crop=true" alt="" />';
						}
					}

					$ir_banner_2_3 = get_post_meta( $post->ID, '_ir_image_4', true );
					if( $ir_banner_2_3 ) {
						$img_array = explode( '$S$', $ir_banner_2_3 );
						$image = wp_get_attachment_image_src( $img_array[0], 'full' );
						if( $image[1] >= '677' && $image[2] >= '450' ) {
							$resize_src = get_attachment_link( $img_array[0] );
							echo '<img src="' . $resize_src . '?resized&width=677&height=450&crop=true" alt="" />';
						}
					}
				?>
			</div>
		</div>
		<!-- ***** START LEFT COLUMN **** -->
		<div class="left-column">
			<div class="inner-copy">
				<h4>Quotes</h4>
				<?php
					$quotes = get_post_meta( get_the_ID(), '_ir_quotes', true );
					if( ! empty( $quotes ) )
						echo wpautop( wp_kses_post( $quotes ) );
	
					$additional_title = get_post_meta( get_the_ID(), '_ir_additional_title', true );
					$additional = get_post_meta( get_the_ID(), '_ir_additional', true );
					if( ! empty( $additional_title ) && ! empty( $additional ) ) {
						echo '<h4>' . esc_html( $additional_title ) . '</h4>';
						echo wpautop( wp_kses_post( $additional ) );
					}
				?>
			</div>
<!--
      <div id="back-bottom-image">
			<?php /*
				$page_two_left = get_post_meta( $post->ID, '_ir_image_5', true );
				if( $page_two_left ) {
					$img_array = explode( '$S$', $page_two_left );
					$image = wp_get_attachment_image_src( $img_array[0], 'full' );
					if( $image[1] >= '550' ) {
						$resize_src = get_attachment_link( $img_array[0] );
						echo '<img src="' . $resize_src . '?resized&width=550&crop=true" width="220" />';
					}
				} */
			?>
			</div>
-->
		</div>
		<!-- ***** START CENTER COLUMN **** -->
		<div class="content-column">
			<div class="inner-copy">
				<?php
					if ( $response_split && $response_split[1] )
						echo wpautop( wp_kses_post( $response_split[1] ) );
				?>
        <?php
					if ( $impacts_position == 'front' ) {
						if ( $impacts_split && $impacts_split[1] )
							echo wpautop( wp_kses_post( $impacts_split[1] ) );
					} else {
						echo '<h4>Impacts</h4>';
						if( ! empty( $impacts ) )
							echo wpautop( wp_kses_post( $impacts ) );
					}
				?>
			</div>
		</div>
		<!-- ***** START FOOTER **** -->
		<div class="footer full-width">
			<?php
				$page_two_bottom_left = get_post_meta( $post->ID, '_ir_image_5', true );
				if ( $page_two_bottom_left ) {
					$img_array = explode( '$S$', $page_two_bottom_left );
					$image = wp_get_attachment_image_src( $img_array[0], 'full' );
					if ( $image[1] >= '550' ) {
						$proportion = 222 / $image[1];
						$margin = round( ( $proportion * $image[2] ) + 7 );
						$resize_src = get_attachment_link( $img_array[0] );
						echo '<img class="bottom-left-image" src="' . $resize_src . '?resized&width=550&crop=true" width="220" style="top: -' . $margin . 'px;" />';
					}
				}
			?>
			<div class="footer-copy single-column">
				<div class="footer-copy-inner">
					<?php
						if ( ! empty( $program ) )
							echo '<img src="' . plugins_url( 'cahnrs-impact-reports' ) . '/images/' . $program[0] . '-wsu-logo.jpg" alt="Washington State University Extension logo" width="300" />';
					
          	$footer_two = get_post_meta( get_the_ID(), '_ir_footer_back', true );
						if ( ! empty( $footer_two ) )
							echo wpautop( wp_kses_post( $footer_two ) );
					?>
        </div>
      </div>
		</div>

	</body>
</html>
<?php
		endwhile;
	endif;
?>
test