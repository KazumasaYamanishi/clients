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

		// *** クーポン 値を取得
		$couponName 		= array();
		$couponIntroduction = array();
		$couponAttention 	= array();
		$couponDay 			= array();
		foreach( $cf as $row ){
			if( $row['meta_key'] == "coupon-name" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponName, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-introduction" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponIntroduction, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-attention" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponAttention, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-day" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponDay, $row['meta_value'] );
				}
			}
		}
		$lengthCoupon = count ( $couponName );

		$memberStatus 	= post_custom('member-status'); 	// 会員ステータス
		$tel 			= post_custom('tel'); 				// 電話番号
		$introduction 	= post_custom('introduction'); 		// 店舗紹介
		$areaKagoshima 	= post_custom('area-kagoshima'); 	// 鹿児島市エリア
		$areaAira 		= post_custom('area-aira'); 		// 姶良市・霧島市エリア
		$areaHokusatsu 	= post_custom('area-hokusatsu'); 	// 北薩エリア
		$areaNakasatsu 	= post_custom('area-nakasatsu'); 	// 中薩エリア
		$areaNansatsu 	= post_custom('area-nansatsu'); 	// 南薩エリア
		$areaOsumi 		= post_custom('area-osumi'); 		// 大隅エリア
		$genre 			= post_custom('genre'); 			// ジャンル
		$service 		= post_custom('service'); 			// サービス
		$facility 		= post_custom('facility'); 			// 設備
		$scene 			= post_custom('scene'); 			// シーン

	?>

	<?php
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
					// *** クーポン判定
					if ( $lengthCoupon > 0 ) {
						echo '<img src="' . get_template_directory_uri() . '/img/icon-q.png" alt="" class="icon-coupon">';
					}
					// *** 有料会員判定
					if ( $memberStatus ) {
						echo '<img src="' . get_template_directory_uri() . '/img/icon-good.png" alt="" class="icon-status">';
					}
					// *** .wrap-thumbnail end
					echo '</div>';
					// 店名＆店舗紹介
					echo '<div class="wrap-name bg-base">';
						// 店名
						echo '<h1><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h1>';
						// 店舗紹介
						echo '<div class="wrap-intro">';
						echo esc_html($introduction);
						echo '</div>';
					echo '</div>';
					// 電話番号＆住所
					echo '<div class="wrap-tel-adrs">';
					echo '<div class="row bg-base-light">';
						// 電話番号
						echo '<div class="col-xs-6"><p class="text-center"><i class="fa fa-mobile fa-fw" aria-hidden="true"></i>';
						if( $tel ) { echo $tel; }
						echo '</p></div>';
						// 住所
						echo '<div class="col-xs-6">';
							$areaAll = array();
							if( $areaKagoshima ) 	echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>鹿児島市エリア</p>';
							if( $areaAira ) 		echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>姶良市・霧島市エリア</p>';
							if( $areaHokusatsu ) 	echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>北薩エリア</p>';
							if( $areaNakasatsu ) 	echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>中薩エリア</p>';
							if( $areaNansatsu ) 	echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>南薩エリア</p>';
							if( $areaOsumi ) 		echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>大隅エリア</p>';
						echo '</div>';
					echo '</div>';
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
					// サービス、設備、シーン
					$shopMeta = array();
					// *** サービス
					if ( is_array ( $service ) ) {
						foreach ( $service as $value ) {
							array_push ( $shopMeta, $value );
						}
					} else {
						array_push ( $shopMeta, $service );
					}
					// *** 設備
					if ( is_array ( $facility ) ) {
						foreach ( $facility as $value ) {
							array_push ( $shopMeta, $value );
						}
					} else {
						array_push ( $shopMeta, $facility );
					}
					// *** シーン
					if ( is_array ( $scene ) ) {
						foreach ( $scene as $value ) {
							array_push ( $shopMeta, $value );
						}
					} else {
						array_push ( $shopMeta, $scene );
					}
					echo '<div class="wrap-service bg-base-light"><ul class="list-inline">';
					foreach ( $shopMeta as $value ) {
						echo '<li>' . $value . '</li>';
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
		// 最終行のカードが4未満なら .row を閉じないといけないための処理
		if($endDiv === 'on') {
			echo '</div>';
		}
	?>

</div>

<?php get_footer(); ?>