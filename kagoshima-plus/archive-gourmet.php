<?php get_header(); ?>



<div class="container">

	<?php

		if(have_posts()): while(have_posts()):the_post();

		$memberStatus 	= post_custom('member-status'); 	// 会員ステータス
		$city 			= post_custom('city'); 				// 市町村
		$address 		= post_custom('address'); 			// 市町村以降の住所
		$tel 			= post_custom('tel'); 				// 電話番号
		$openLast 		= post_custom('open-last'); 		// 営業時間
		$holiday 		= post_custom('holiday'); 			// 定休日
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
		$outphoto 		= wp_get_attachment_image_src(post_custom('outphoto'),'full' ); 	// 外観写真
		$inphoto 		= wp_get_attachment_image_src(post_custom('inphoto'),'full' ); 		// 内観写真
		$gallery 		= post_custom('gallery'); 			// ギャラリー
		$car 			= post_custom('car'); 				// 駐車場
		$credit 		= post_custom('credit'); 			// クレジットカード
		$charge 		= post_custom('charge'); 			// サービス・チャージ料
		$seat 			= post_custom('seat'); 				// 席数
		$private 		= post_custom('private'); 			// 個室
		$site 			= post_custom('site'); 				// ホームページ
		$note 			= post_custom('note'); 				// 備考

	?>

	<article<?php if( $memberStatus == '有料' ) echo ' class="pay-mbr"'; ?>>
		<div class="inner">
			<?php
				// アイキャッチ画像
				echo '<div class="wrap-thumbnail"><img src="';
				if ( has_post_thumbnail() ) {
					$image_id = get_post_thumbnail_id ();
					$image_url = wp_get_attachment_image_src ($image_id, true);
					echo $image_url[0];
				} else {
					echo get_bloginfo( 'template_directory' ) . '/img/thumbnail.png';
				}
				echo '" alt="' . get_the_title() . '"></div>';
				// 店名＆店舗紹介
				echo '<div class="wrap-name bg-base">';
					// 店名
					echo '<h1>' . get_the_title() . '</h1>';
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
				echo '<div class="wrap-genre bg-base-light">';
				if ( is_array ( $genre ) ) {
					echo '<ul class="list-inline">';
					foreach ( $genre as $value ) {
						echo '<li>' . $value . '</li>';
					}
					echo '</ul>';
				}
				echo '</div>';
				// サービス
				echo '<div class="wrap-service bg-base-light">';
				if ( is_array ( $service ) ) {
					echo '<ul class="list-inline">';
					foreach ( $service as $value ) {
						echo '<li>' . $value . '</li>';
					}
					echo '</ul>';
				}
				echo '</div>';
			?>
		</div>
	</article>

	<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>