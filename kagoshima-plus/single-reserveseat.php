<?php get_header(); ?>

<?php
	// リザーブシート
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );

	if(have_posts()): while(have_posts()):the_post();

		$rName  = post_custom('reserve-name');  // アーティスト名
        $rDay   = post_custom('reserve-day');   // 開催日
        $rTime  = post_custom('reserve-time');  // 開催時間
        $rPlace = post_custom('reserve-place'); // 会場名
        $rPrice = post_custom('reserve-price'); // 入場料金
        $rPhone = post_custom('reserve-phone'); // 読者先行予約日

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
					// 情報
					// --------------------------------------------------
						echo '<div class="wrap-table"><table class="table"><tbody>';
							// *** アーティスト名
							if( $rName ) {
								echo '<tr><th>アーティスト名</th><td>';
								echo '</td></tr>';
							}
							// *** 開催日
							if( $rDay ) {
								echo '<tr><th>開催日</th><td>';
								echo '</td></tr>';
							}
							// *** 開催時間
							if( $rTime ) {
								echo '<tr><th>開催時間</th><td>';
								echo '</td></tr>';
							}
							// *** 会場名
							if( $rPlace ) {
								echo '<tr><th>会場名</th><td>';
								echo '</td></tr>';
							}
							// *** 入場料金
							if( $rPrice ) {
								echo '<tr><th>入場料金</th><td>';
								echo '</td></tr>';
							}
							// *** 読者先行予約日
							if( $rPhone ) {
								echo '<tr><th>読者先行予約日</th><td>';
								echo '</td></tr>';
							}
						echo '</tbody></table></div>';
				?>
			</div>
		</div>
	</article>

				</div>
					<?php get_sidebar(); ?>
			</div>

</div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>