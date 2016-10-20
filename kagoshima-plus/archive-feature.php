<?php
	/*
		Template Name: アーカイブ feature
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

		$rowNum = 0;

		if(have_posts()): while(have_posts()):the_post();

		global $wpdb;
		$query 	= "SELECT meta_id,post_id,meta_key,meta_value FROM $wpdb->postmeta WHERE post_id = $post->ID ORDER BY meta_id ASC";
		$cf 	= $wpdb->get_results($query, ARRAY_A);

		$featureName 	= post_custom('feature-name'); 	// 店名
		$midashi 		= post_custom('midashi'); 		// 本文30文字以内

		$rowNum++;
		$reNum = $rowNum % 3;
		if($reNum === 1) echo '<div class="row">';

	?>

	<div class="col-sm-4">
		<article>
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
					// タイトル
					echo '<div class="wrap-name bg-base">';
						echo '<h1><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h1>';
					echo '</div>';
					// 店名
					echo '<div class="wrap-feature-name bg-base-light">';
						echo '<p>' . $featureName . '</p>';
					echo '</div>';
					// 本文 30文字以内
					echo '<div class="wrap-introduction bg-base-light">';
							echo $midashi;
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
		// 最終行のカードが4未満なら .row を閉じないといけないための処理
		if($endDiv === 'on') {
			echo '</div>';
		}
	?>

</div>

<?php get_footer(); ?>