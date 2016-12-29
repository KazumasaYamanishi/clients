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

	<article<?php if( $memberStatus == '有料' ) echo 'class="pay-mbr"'; ?>>
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
				// 店名
				echo '<h1>' . get_the_title() . '</h1>';
				// 店舗紹介
				echo '<div class="wrap-intro">';
				echo esc_html($introduction);
				echo '</div>';
				// 電話番号
				echo '<p>';
				if( $tel ) { echo $tel; }
				echo '</p>';
				// 住所
				$areaAll = array();
				if( $areaKagoshima ) 	echo '<p>鹿児島市エリア</p>';
				if( $areaAira ) 		echo '<p>姶良市・霧島市エリア</p>';
				if( $areaHokusatsu ) 	echo '<p>北薩エリア</p>';
				if( $areaNakasatsu ) 	echo '<p>中薩エリア</p>';
				if( $areaNansatsu ) 	echo '<p>南薩エリア</p>';
				if( $areaOsumi ) 		echo '<p>大隅エリア</p>';
				// ジャンル
				echo '<div class="wrap-genre">';
					if( $genre ) echo $genre;
				echo '</div>';
				// サービス
				echo '<div class="wrap-service">';
					if( $service ) echo $service;
				echo '</div>';
			?>
		</div>
	</article>













	<?php
		// 会員ステータス
		// ==================================================
	?>
	<h3>会員ステータス</h3>
	<?php
		// 市町村
		// ==================================================
	?>
	<h3>市町村</h3>
	<?php
		// 市町村以降の住所
		// ==================================================
	?>
	<h3>市町村以降の住所</h3>
	<?php
		// 電話番号
		// ==================================================
	?>
	<h3>電話番号</h3>
	<?php
		// 営業時間
		// ==================================================
	?>
	<h3>営業時間</h3>
	<?php
		// 定休日
		// ==================================================
	?>
	<h3>定休日</h3>
	<?php
		// 店舗紹介
		// ==================================================
	?>
	<h3>店舗紹介</h3>
	<?php
		// 店舗エリア
		// ==================================================
	?>
	<h3>店舗エリア</h3>
	<?php
		// ジャンル
		// ==================================================
	?>
	<h3>ジャンル</h3>
	<?php
		// サービス
		// ==================================================
	?>
	<h3>サービス・チャージ料</h3>
	<?php
		// 設備
		// ==================================================
	?>
	<h3>設備</h3>
	<?php
		// シーン
		// ==================================================
	?>
	<h3>シーン</h3>
	<?php
		// 外観写真
		// ==================================================
	?>
	<h3>外観写真</h3>
	<?php
		// 内観写真
		// ==================================================
	?>
	<h3>内観写真</h3>
	<?php
		// ギャラリー
		// ==================================================
		echo '<h3>ギャラリー</h3>';
		// アタッチメントIDの配列から画像を取得する
		if ( $gallery ) {
			if ( is_array ( $gallery ) ) {
				foreach ( $gallery as $var ) {
					$postImg = wp_get_attachment_image ( $var, 'full' );
					echo '<figure class="postImg">' . $postImg . '</figure>';
				}
			} else {
				$postImg = wp_get_attachment_image ( $gallery, 'full' );
				echo '<figure class="postImg">' . $postImg . '</figure>';
			}
		}
	?>
	<?php
		// 人気メニュー
		// ==================================================
		echo '<h3>人気メニュー</h3>';
		global $wpdb;
		$query 	= "SELECT meta_id,post_id,meta_key,meta_value FROM $wpdb->postmeta WHERE post_id = $post->ID ORDER BY meta_id ASC";
		$cf 	= $wpdb->get_results ( $query, ARRAY_A );

		$menuName 			= array();
		$menuPhoto 			= array();
		$menuIntroduction 	= array();

		foreach( $cf as $row ){
			if( $row['meta_key'] == "menu-name" ){
				array_push( $menuName, $row['meta_value'] );
			}
			if( $row['meta_key'] == "menu-photo" ){
				array_push( $menuPhoto, $row['meta_value'] );
			}
			if( $row['meta_key'] == "menu-introduction" ){
				array_push( $menuIntroduction, $row['meta_value'] );
			}
		}

		$length = count ( $menuName );

		for ( $i = 0; $i < $length; $i++ ) {
			// echo '<p><img src="' . wp_get_attachment_image_src ( intval ( $menuPhoto[$i] ), 'full' ) . '" alt="' . $menuName[$i] . '"></p>'; これは使えない！
			$postImg = wp_get_attachment_image ( $menuPhoto[$i], 'full' );
			echo '<figure class="postImg">' . $postImg . '</figure>';
			echo '<p>' . $menuName[$i] . '</p>';
			echo '<div>' . $menuIntroduction[$i] . '</div>';
		}
	?>
	<?php
		// クーポン
		// ==================================================
		echo '<h3>クーポン</h3>';

		$couponName 		= array();
		$couponIntroduction = array();
		$couponAttention 	= array();
		$couponDay 			= array();

		foreach( $cf as $row ){
			if( $row['meta_key'] == "coupon-name" ){
				array_push( $couponName, $row['meta_value'] );
			}
			if( $row['meta_key'] == "coupon-introduction" ){
				array_push( $couponIntroduction, $row['meta_value'] );
			}
			if( $row['meta_key'] == "coupon-attention" ){
				array_push( $couponAttention, $row['meta_value'] );
			}
			if( $row['meta_key'] == "coupon-day" ){
				array_push( $couponDay, $row['meta_value'] );
			}
		}

		$length = count ( $couponName );

		for ( $i = 0; $i < $length; $i++ ) {
			echo '<p>' . $couponName[$i] . '</p>';
			echo '<div>' . $couponIntroduction[$i] . '</div>';
			echo '<div>' . $couponAttention[$i] . '</div>';
			echo '<p>' . $couponDay[$i] . '</p>';
		}
	?>
	<?php
		// 駐車場
		// ==================================================
		echo '<h3>駐車場</h3>';
	?>
	<?php
		// クレジットカード
		// ==================================================
		echo '<h3>クレジットカード</h3>';
	?>
	<?php
		// サービス・チャージ料
		// ==================================================
		echo '<h3>サービス・チャージ料</h3>';
	?>
	<?php
		// 席数
		// ==================================================
		echo '<h3>席数</h3>';
	?>
	<?php
		// 個室
		// ==================================================
		echo '<h3>個室</h3>';
	?>
	<?php
		// ホームページ
		// ==================================================
		echo '<h3>ホームページ</h3>';
	?>
	<?php
		// マップ
		// ==================================================
		echo '<h3>マップ</h3>';
		echo do_shortcode('[map addr="' . $city . $address . '"]');
	?>



	<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>