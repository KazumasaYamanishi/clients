<?php
	/*
		Template Name: アーカイブ 自社別冊紹介
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
				if ( have_posts() ) :
				while ( have_posts() ) : the_post();
			?>



			<div class="col-xs-6 col-sm-3">
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
							// タイトル
							// --------------------------------------------------
								echo '<div class="wrap-name bg-base">';
								echo '<h1>' . get_the_title() . '</h1>';
								echo '</div>';

							// ジャンル
							// --------------------------------------------------
								if( post_custom('genre-separate') ) {
									echo '<div class="wrap-service bg-base-light"><ul class="list-inline">';
									echo '<li>' . post_custom('genre-separate') . '</li>';
									echo '</ul></div>';
								}
							// 発売日
							// --------------------------------------------------
								if( post_custom('issue-day-separate') ) {
									echo '<div class="wrap-tel-adrs bg-base-light">';
									echo '<p>発売日：' . post_custom('issue-day-separate') . '</p>';
									echo '</div>';
								}
							// リンク
							// --------------------------------------------------
								echo '<a href="' . get_the_permalink() . '" class="link-cover">' . get_the_title() . '</a>';
						?>
					</div>
				</article>
			</div>



			<?php
				endwhile;
				endif;
			?>
		</div>
	    <div class="text-center">
	        <?php nofx_wp_pagenavi(); ?>
	    </div>
	</div>
</div>

<?php get_footer(); ?>