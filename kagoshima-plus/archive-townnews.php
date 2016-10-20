<?php
	/*
		Template Name: アーカイブ 街ネタ
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

		$introduction 	= post_custom('introduction'); 		// 紹介文50文字以内
		$areaKagoshima 	= post_custom('area-kagoshima'); 	// 鹿児島市エリア
		$areaAira 		= post_custom('area-aira'); 		// 姶良市・霧島市エリア
		$areaHokusatsu 	= post_custom('area-hokusatsu'); 	// 北薩エリア
		$areaNakasatsu 	= post_custom('area-nakasatsu'); 	// 中薩エリア
		$areaNansatsu 	= post_custom('area-nansatsu'); 	// 南薩エリア
		$areaOsumi 		= post_custom('area-osumi'); 		// 大隅エリア
		$catTownnews 	= post_custom('category-townnews'); // カテゴリ選択

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
					// 紹介文50文字以内
					echo '<div class="wrap-intro">';
					echo esc_html($introduction);
					echo '</div>';
					// タイトル
					echo '<div class="wrap-name bg-base">';
						echo '<h1><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h1>';
					echo '</div>';
					// エリア
					echo '<div class="wrap-tel-adrs bg-base-light">';
							$areaAll = array();
							if( $areaKagoshima ) 	echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>鹿児島市エリア</p>';
							if( $areaAira ) 		echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>姶良市・霧島市エリア</p>';
							if( $areaHokusatsu ) 	echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>北薩エリア</p>';
							if( $areaNakasatsu ) 	echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>中薩エリア</p>';
							if( $areaNansatsu ) 	echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>南薩エリア</p>';
							if( $areaOsumi ) 		echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>大隅エリア</p>';
					echo '</div>';
					// カテゴリー選択
					echo '<div class="wrap-category-townnews bg-base-light"><ul class="list-inline">';
					if ( is_array ( $catTownnews ) ) {
						foreach ( $catTownnews as $value ) {
							echo '<li>' . $value . '</li>';
						}
					} else {
						echo $catTownnews;
					}
					echo '</ul></div>';
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