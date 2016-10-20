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

	<?php
		// 詳細検索
		// ==================================================
		echo '<div class="wrap-search">';
		echo '<img src="' . get_template_directory_uri() . '/img/kensaku.png" alt="" class="lr-center">';
		echo '</div>';
	?>

	<?php

		$rowNum = 0;

		if(have_posts()): while(have_posts()):the_post();

		global $wpdb;
		$query 	= "SELECT meta_id,post_id,meta_key,meta_value FROM $wpdb->postmeta WHERE post_id = $post->ID ORDER BY meta_id ASC";
		$cf 	= $wpdb->get_results($query, ARRAY_A);

		$genre 			= post_custom('genre'); 		// ジャンル
		$issueDay 		= post_custom('issue-day'); 	// 発行日

		$rowNum++;
		$reNum = $rowNum % 3;
		if($reNum === 1) echo '<div class="row">';
	?>

	<div class="col-sm-4">
		<article<?php if( $memberStatus == '有料' ) echo ' class="pay-mbr"'; ?>>
			<div class="inner">
				<?php
					// アイキャッチ画像
					echo '<div class="wrap-thumbnail"><a href="' . get_the_permalink() . '"><img src="';
					if ( has_post_thumbnail() ) {
						$image_id = get_post_thumbnail_id ();
						$image_url = wp_get_attachment_image_src ($image_id, true);
						echo $image_url[0];
					} else {
						echo get_bloginfo( 'template_directory' ) . '/img/thumbnail.png';
					}
					echo '" alt="' . get_the_title() . '" class="main-img lr-center"></a>';

					// *** .wrap-thumbnail end
					echo '</div>';
					// 店名
					echo '<div class="wrap-name bg-base">';
						echo '<h1><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h1>';
					echo '</div>';
					// ジャンル
					echo '<div class="wrap-genre bg-base-light"><ul class="list-inline">';
					if ( is_array ( $genre ) ) {
						foreach ( $genre as $value ) {
							echo '<li>' . $value . '</li>';
						}
					} else {
						echo $genre;
					}
					echo '</ul></div>';
					// 発行日
					echo '<div class="wrap-issue-day bg-base-light">';
						echo '<p>' . $issueDay . '</p>';
					echo '</div>';
				?>
			</div>
		</article>
	</div>


	<?php

		// 1行に3つカードが埋まっていれば .row を閉じる
		if($reNum === 0) {
			echo '</div>';
			$endDiv = 'off';
		} else {
			$endDiv = 'on';
		}
		// ループ処理終了
		endwhile; endif;
		// 最終行のカードが3未満なら .row を閉じないといけないための処理
		if($endDiv === 'on') {
			echo '</div>';
		}

	?>

</div>

<?php get_footer(); ?>