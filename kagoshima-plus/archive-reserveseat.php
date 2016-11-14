<?php
	/*
		Template Name: アーカイブ リザーブシート
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
		<div class="row row-10">
			<?php
				$args = array(
					'post_type' 		=> 'reserveseat',
					'post_status' 		=> 'publish',
					'posts_per_page' 	=> 1,
				);
				$the_query = new WP_Query( $args );
				if ( $the_query->have_posts() ) :
				while ( $the_query->have_posts() ) : $the_query->the_post();
			?>



			<div class="col-xs-12 col-sm-3">
				<article>
					<div class="inner height-some">
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
							// タイトル＆アーティスト名
							// --------------------------------------------------
								echo '<div class="wrap-name bg-base">';
								echo '<h1>' . get_the_title() . '</h1>';
								echo '<div class="wrap-intro">';
								echo post_custom('feature-name');
								echo '</div>';
								echo '</div>';

							// 開催日など
							// --------------------------------------------------
								echo '<table class="table"><tbody>';
										echo '<tr><th>開催日</th><td>' . post_custom('reserve-day') . '</td></tr>';
										echo '<tr><th>開催時間</th><td>' . post_custom('reserve-time') . '</td></tr>';
										echo '<tr><th>会場名</th><td>' . post_custom('reserve-name') . '</td></tr>';
										echo '<tr><th>入場料金</th><td>' . post_custom('reserve-price') . '</td></tr>';
										echo '<tr><th>読者先行予約日</th><td>' . post_custom('reserve-phone') . '</td></tr>';
								echo '</tbody></table>';
						?>
					</div>
				</article>
			</div>



			<?php
				endwhile;
				endif;
			?>
		</div>
	</div>
</div>

<?php get_footer(); ?>