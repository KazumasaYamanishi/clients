<?php get_header(); ?>

<?php
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );

	if(have_posts()): while(have_posts()):the_post();

		// *** 紹介文
		$introduction 	= post_custom('introduction-separate');

		global $wpdb;
		$query 	= "SELECT meta_id,post_id,meta_key,meta_value FROM $wpdb->postmeta WHERE post_id = $post->ID ORDER BY meta_id ASC";
		$cf 	= $wpdb->get_results($query, ARRAY_A);

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
				// 別冊名
				// --------------------------------------------------
					echo '<h1>' . get_the_title() . '</h1>';
			?>
			<div class="wrap-contents">
				<?php
					// 紹介文
					// --------------------------------------------------
						echo '<div class="wrap-intro">';
						echo $introduction;
						echo '</div>';
					// ジャンルなど
					// --------------------------------------------------
						echo '<div class="wrap-table m-lr-20-30"><table class="table"><tbody>';
							// *** ジャンル
							if( post_custom('genre-separate') ) {
								echo '<tr><th>ジャンル</th><td>';
									echo post_custom('genre-separate');
								echo '</td></tr>';
							}
							// *** 発行日
							if( post_custom('issue-day-separate') ) {
								echo '<tr><th>発行日</th><td>';
									echo post_custom('issue-day-separate');
								echo '</td></tr>';
							}
							// *** サイズ
							if( post_custom('size-separate') ) {
								echo '<tr><th>サイズ</th><td>';
									echo post_custom('size-separate');
								echo '</td></tr>';
							}
							// *** 価格
							if( post_custom('price-separate') ) {
								echo '<tr><th>価格</th><td>';
									echo post_custom('price-separate');
								echo '</td></tr>';
							}
						echo '</tbody></table></div>';
					// 備考
					// --------------------------------------------------
						if( post_custom('note-separate') ) {
							echo '<div class="wrap-note m-lr-20-30"><h3 class="title">備考</h3><div class="inner-note">';
								echo post_custom('note-separate');
							echo '</div></div>';
						}
					// 販売終了
					// --------------------------------------------------
						if( post_custom('end-separate') ) {
							echo '<div class="alert alert-danger">販売期間終了しました</div>';
						} else {
							// 外部販売サイトアイコン, 外部販売サイトリンク
							// --------------------------------------------------
								$outsideIcon = array();
								$outsideSite = array();
								foreach( $cf as $row ){
									if( $row['meta_key'] == "outside-icon-separate" ){
										array_push( $outsideIcon, $row['meta_value'] );
									}
									if( $row['meta_key'] == "outside-site-separate" ){
										array_push( $outsideSite, $row['meta_value'] );
									}
								}
								$length = count( $outsideIcon );
								echo '<div class="wrap-outside"><ul class="list-unstyled">';
								for ( $i = 0; $i < $length; $i++ ) {
									$postImg = wp_get_attachment_image ( $outsideIcon[$i], 'full' );
									echo '<li><a href="' . $outsideSite[$i] . '" target="_blank">' . $postImg . '</a></li>';
								}
								echo '</ul></div>';
							// 購読申し込み
							// --------------------------------------------------
								if( post_custom('subscription-separate') ) {
									echo '<p><a href="#" class="">購読のお申し込みはこちらから</a></p>';
								}
						}
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