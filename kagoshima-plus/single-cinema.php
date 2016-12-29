<?php get_header(); ?>

<?php
	// シネマ情報
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );
?>

<div class="container">
	<div class="row row-40">
		<div class="col-sm-8">



			<?php
				if(have_posts()): while(have_posts()):the_post();

				// カスタムフィールドの値を取得
				// ==================================================
					$iCinema 	= post_custom('introduction-cinema'); 	// 本文
					$tCinema 	= post_custom('theater-cinema'); 		// 上映している映画館
					$note 		= post_custom('note-cinema'); 			// 備考
			?>



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
				// 本文
				// --------------------------------------------------
					echo '<div class="wrap-intro">';
					echo $iCinema;
					echo '</div>';
				// 上映している映画館
				// --------------------------------------------------
					// echo '<pre>';
					// echo var_dump($tCinema);
					// echo '</pre>';
					echo '<div class="wrap-table m-lr-20-30">';
					echo '<h2>上映している映画館</h2>';
								foreach ( $tCinema as $value ) {
									switch ($value) {
										case '鹿児島ミッテ10':
											$fields = get_post_custom(966);
											break;

										case 'TOHOシネマズ与次郎':
											$fields = get_post_custom(968);
											break;

										case 'TENPARA':
											$fields = get_post_custom(971);
											break;

										case 'gardens cinema':
											$fields = get_post_custom(973);
											break;

										case 'リナシアター':
											$fields = get_post_custom(975);
											break;
									}
									echo '<h3>' . $fields['theater-name'][0] . '</h3>';
									echo '<table class="table"><tbody>';
									echo '<tr><th>住所</th><td>' . $fields['theater-address'][0] . '</td></tr>';
									echo '<tr><th>TEL</th><td>' . $fields['theater-tel'][0] . '</td></tr>';
									echo '<tr><th>スケジュール</th><td><a href="' . $fields['site-theater'][0] . '" target="_blank">' . $fields['site-theater'][0] . '</a></td></tr>';
									echo '</tbody></table>';
								}
					echo '</div>';
				// 備考
				// --------------------------------------------------
					if( $note != '' ) {
						echo '<div class="wrap-note m-lr-20-30"><h3 class="title">備考</h3><div class="inner-note">';
							echo post_custom('note-separate');
						echo '</div></div>';
					}
			?>
		</div>
	</div>
</article>



			<?php endwhile; endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>



<?php get_footer(); ?>