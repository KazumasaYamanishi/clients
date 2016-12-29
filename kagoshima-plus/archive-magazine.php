<?php
	/*
		Template Name: アーカイブ TJ最新号
	*/
?>

<?php get_header(); ?>

<?php
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );
?>

<div class="container">
	<div id="extra-area">
		<div class="row row-40">
			<?php
				$args = array(
					'post_type' 		=> 'magazine',
					'post_status' 		=> 'publish',
					'posts_per_page' 	=> 1,
				);
				$the_query = new WP_Query( $args );
				if ( $the_query->have_posts() ) :
				while ( $the_query->have_posts() ) : $the_query->the_post();
			?>



			<div class="col-sm-8">
				<article>
					<div class="inner height-some">

<h1 class="single-title-top"><?php echo the_title(); ?></h1>
<div class="time-tj-saisin">Posted<?php the_time('Y.m.d'); ?></div>
						<?php
							// アイキャッチ画像
							// --------------------------------------------------
								echo '<div class="wrap-thumbnail"><img src="';
								if ( has_post_thumbnail() ) {
									$image_id = get_post_thumbnail_id ();
									$image_url = wp_get_attachment_image_src ($image_id, true);
									echo $image_url[0];
								} else {
									echo get_bloginfo( 'template_directory' ) . '/img/thumbnail.png';
								}
								echo '" alt="' . get_the_title() . '" class="main-img lr-center"></div>';
							// 紹介文
							// --------------------------------------------------
								if( post_custom('introduction-magazine') ) {
									echo '<div class="wrap-name">';
											echo post_custom('introduction-magazine');
									echo '</div>';
								}
							// 特集1
							// --------------------------------------------------
								if( post_custom('title-01-magazine') || post_custom('intro-01-magazine') || post_custom('photo-01-magazine') ) {
									echo '<div class="wrap-tel-adrs">';
										$bnr = post_custom('photo-01-magazine');
										$src =  wp_get_attachment_image_src($bnr, 'full');
										if ( $src ) {
											echo '<p><img src="' . $src[0] . '" alt="' . get_the_title() . '"></p>';
										}
										if ( post_custom('title-01-magazine') ) {
											echo '<p class="title-arc">' . post_custom('title-01-magazine') . '</p>';
										}
										if ( post_custom('intro-01-magazine') ) {
											echo '<div class="wrap-intro">' . post_custom('intro-01-magazine') . '</div>';
										}
									echo '</div>';
								}
							// 特集2
							// --------------------------------------------------
								if( post_custom('title-02-magazine') || post_custom('intro-02-magazine') || post_custom('photo-02-magazine') ) {
									echo '<div class="wrap-tel-adrs">';
										$bnr = post_custom('photo-02-magazine');
										$src =  wp_get_attachment_image_src($bnr, 'full');
										if ( $src ) {
											echo '<p><img src="' . $src[0] . '" alt="' . get_the_title() . '"></p>';
										}
										if ( post_custom('title-02-magazine') ) {
											echo '<p class="title-arc">' . post_custom('title-02-magazine') . '</p>';
										}
										if ( post_custom('intro-02-magazine') ) {
											echo '<div class="wrap-intro">' . post_custom('intro-02-magazine') . '</div>';
										}
									echo '</div>';
								}
							// 特集3
							// --------------------------------------------------
								if( post_custom('title-03-magazine') || post_custom('intro-03-magazine') || post_custom('photo-03-magazine') ) {
									echo '<div class="wrap-tel-adrs">';
										$bnr = post_custom('photo-03-magazine');
										$src =  wp_get_attachment_image_src($bnr, 'full');
										if ( $src ) {
											echo '<p><img src="' . $src[0] . '" alt="' . get_the_title() . '"></p>';
										}
										if ( post_custom('title-03-magazine') ) {
											echo '<p class="title-arc">' . post_custom('title-03-magazine') . '</p>';
										}
										if ( post_custom('intro-03-magazine') ) {
											echo '<div class="wrap-intro">' . post_custom('intro-03-magazine') . '</div>';
										}
									echo '</div>';
								}

						?>
					</div>
				</article>
			</div>



			<?php
				endwhile;
				endif;
				get_sidebar();
			?>
		</div>
	</div>
</div>

<?php get_footer(); ?>