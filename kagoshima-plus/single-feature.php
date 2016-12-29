<?php get_header(); ?>

<?php
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );

	if(have_posts()): while(have_posts()):the_post();

		// *** 店名
		$shopName 		= post_custom('feature-name');
		// *** 紹介文
		$introduction 	= post_custom('introduction-feature');

?>
<div class="container">

			<div class="row row-40">
				<div class="col-sm-8">

	<article>
		<div class="inner">
			

			
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
					echo '<h1 class="title">' . get_the_title() . '</h1>';
			?>
			<div class="wrap-contents">
				<?php
					// 店名＆紹介文
					// --------------------------------------------------
						echo '<div class="wrap-intro">';
						echo '<h2 class="title">' . $shopName . '</h2>';
						echo $introduction;
						echo '</div>';
					// 店舗情報
					// --------------------------------------------------
						echo '<div class="wrap-table"><table class="table"><tbody>';
							// *** 住所
							echo '<tr><th>住所</th><td>';
								echo post_custom('city-feature') . post_custom('address-feature');
							echo '</td></tr>';
							// *** 電話番号
							if( post_custom('tel-feature') ) {
								echo '<tr><th>電話番号</th><td>';
									echo post_custom('tel-feature');
								echo '</td></tr>';
							}
							// *** 営業時間
							if( post_custom('open-last-feature') ) {
								echo '<tr><th>営業時間</th><td>';
									echo post_custom('open-last-feature');
								echo '</td></tr>';
							}
							// *** 定休日
							if( post_custom('holiday-feature') ) {
								echo '<tr><th>定休日</th><td>';
									echo post_custom('holiday-feature');
								echo '</td></tr>';
							}
						echo '</tbody></table></div>';
				?>
				<?php
					// グーグルマップ
					// --------------------------------------------------
				?>
					<div class="wrap-map">
						<?php echo do_shortcode( "[map width='100%' height='350px' lat=" . post_custom('lat-feature') . " lng=" . post_custom('lng-feature') . "]" ); ?>
					</div>
			</div>

		</div>
	</article>

				</div>
					<?php get_sidebar(); ?>
			</div>

</div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>