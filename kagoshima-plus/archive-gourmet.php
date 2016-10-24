<?php
	/*
		Template Name: アーカイブ グルメ
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
		// 検索フォーム
		// ==================================================
		// 1．詳細検索ボタンをクリック
		// 2．Bootstrapのモーダル画面
		// 3．入力後、検索ボタンをクリック
		// 4．検索結果ページ（search.php）を表示
	?>

	<div class="wrap-search-detail clearfix">
		<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">詳細検索</button>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">詳細検索</h4>
				</div>
				<div class="modal-body">
					<form method="get" action="<?php echo home_url('/'); ?>">
						<?php echo do_shortcode('[cftsearch format=1 search_label="上記内容で検索する"]'); ?>
					</form>
				</div>
			</div>
		</div>
	</div>


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
		$keywords 		= post_custom('keywords'); 			// キーワード

	?>

	<?php
		$rowNum++;
		$reNum = $rowNum % 4;
		if($reNum === 1) echo '<div class="row row-10">';
	?>

	<div class="col-xs-6 col-sm-3">
		<article<?php if( $memberStatus == '有料' ) echo ' class="pay-mbr"'; ?>>
			<div class="inner height-some">
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
					echo '" alt="' . get_the_title() . '" class="main-img lr-center">';
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
						echo '<h1>' . get_the_title() . '</h1>';
						// 店舗紹介
						// echo '<div class="wrap-intro">';
						// echo esc_html($introduction);
						// echo '</div>';
					echo '</div>';
					// エリア
					echo '<div class="wrap-tel-adrs bg-base-light"><ul class="list-inline">';
							$areaAll = array();
							if( $areaKagoshima ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>鹿児島市エリア</li>';
							if( $areaAira ) 		echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>姶良市・霧島市エリア</li>';
							if( $areaHokusatsu ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>北薩エリア</li>';
							if( $areaNakasatsu ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>中薩エリア</li>';
							if( $areaNansatsu ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>南薩エリア</li>';
							if( $areaOsumi ) 		echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>大隅エリア</li>';
					echo '</ul></div>';
					// ジャンル
					// --------------------------------------------------
					if ( !empty($genre) ) {
						echo '<div class="wrap-genre bg-base-light"><ul class="list-inline">';
						if ( is_array ( $genre ) ) {
							foreach ( $genre as $value ) {
								echo '<li>' . $value . '</li>';
							}
						} else {
							echo $genre;
						}
						echo '</ul></div>';
					}

					// キーワード
					// --------------------------------------------------
					if ( !empty($keywords) ) {
						echo '<div class="wrap-service bg-base-light"><ul class="list-inline">';
						if ( is_array ( $keywords ) ) {
							$i = 0;
							foreach ( $keywords as $value ) {
								$i++;
								if ( $i < 4 ) {
									echo '<li>' . $value . '</li>';
								} else {
									echo '<li>etc・・・</li>';
									break;
								}
							}
						} else {
							echo '<li>' . $keywords . '</li>';
						}
						echo '</ul></div>';
					}
					echo '<a href="' . get_the_permalink() . '" class="link-cover">' . get_the_title() . '</a>';
				?>
			</div>
		</article>
	</div>

	<?php
		// 1行に4つカードが埋まっていれば .row を閉じる
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

	<div class="pagenavi">
		<?php
			// ページナビ
			posts_nav_link();
		?>
	</div>

</div>

<?php get_footer(); ?>