<?php get_header(); ?>

<?php
	// ビューティー＆ヘルス
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
				$mStatus 		= post_custom('member-status-beauty'); 		// 会員ステータス
				$genre 			= post_custom('genre-beauty'); 				// ジャンル
				$aKagoshima 	= post_custom('area-kagoshima-beauty'); 	// エリア - 鹿児島市
				$aAira 			= post_custom('area-aira-beauty'); 			// エリア - 姶良
				$aKirishima 	= post_custom('area-kirishima-beauty'); 	// エリア - 霧島
				$aHokusatsu 	= post_custom('area-hokusatsu-beauty'); 	// エリア - 北薩
				$aNakasatsu 	= post_custom('area-nakasatsu-beauty'); 	// エリア - 中薩
				$aNansatsu 		= post_custom('area-nansatsu-beauty'); 		// エリア - 南薩
				$aOsumi 		= post_custom('area-osumi-beauty'); 		// エリア - 大隅
				$aRito 			= post_custom('area-rito-beauty'); 			// エリア - 離島
				$kana 			= post_custom('kana-beauty'); 				// よみがな
				$tel 			= post_custom('tel-beauty'); 				// 電話番号
				$city 			= post_custom('city-beauty'); 				// 市町村
				$address 		= post_custom('address-beauty'); 			// 市町村以降の住所
				$car 			= post_custom('car-beauty-radio'); 			// 駐車場
				$cNote 			= post_custom('car-beauty'); 				// 駐車場 - 備考
				$openLast 		= post_custom('open-last-beauty'); 			// 営業時間
				$holiday 		= post_custom('holiday-beauty-radio'); 		// 定休日
				$holiday 		= post_custom('holiday-beauty'); 			// 定休日 - 備考
				$introduction 	= post_custom('introduction-beauty'); 		// 紹介文
				$site 			= post_custom('site-beauty'); 				// ホームページ
				$note 			= post_custom('note-beauty'); 				// 備考
				// 繰り返し - gallery-beauty - イメージ画像、キャプション
				$lat 			= post_custom('lat-beauty'); 				// 緯度
				$lng 			= post_custom('lng-beauty'); 				// 経度
				// 繰り返し - coupon-beauty - クーポン名、クーポン内容、利用条件、注意事項、クーポン有効期限
				$fb 			= post_custom('link-fb-beauty'); 				// Facebookページリンク
				$insta 			= post_custom('link-ig-beauty'); 				// Instagramリンク
			?>



<article<?php if( $mStatus == '有料' ) echo ' class="pay-mbr"'; ?>>
	<div class="inner">
		<?php
			// ナビゲーション
		?>
		<div class="tab" role="tabpanel">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#Section1" aria-controls="basic" role="tab" data-toggle="tab">基本情報</a></li>
				<li role="presentation"><a href="#Section2" aria-controls="photo" role="tab" data-toggle="tab">写真</a></li>
				<li role="presentation"><a href="#Section4" aria-controls="map" role="tab" data-toggle="tab">地図</a></li>
				<li role="presentation"><a href="#Section5" aria-controls="coupon" role="tab" data-toggle="tab">クーポン</a></li>
			</ul>
		</div>
		<div class="tab-content tabs">



			<div role="tabpanel" class="tab-pane fade in active" id="Section1">
				<?php
					// 基本情報
					// ==================================================
					// *** アイキャッチ画像、外観写真、内観写真

					global $wpdb;
					$query 	= "SELECT meta_id,post_id,meta_key,meta_value FROM $wpdb->postmeta WHERE post_id = $post->ID ORDER BY meta_id ASC";
					$cf 	= $wpdb->get_results($query, ARRAY_A);

					// *** クーポン名を取得
					$cName = array();
					foreach( $cf as $row ){
						if( $row['meta_key'] == "coupon-name-beauty" ) {		 // クーポン名
							if ( !empty ( $row['meta_value'] ) ) {
								array_push( $cName, $row['meta_value'] );
							}
						}
						if( $row['meta_key'] == "coupon-introduction-beauty" ) { // クーポン内容
							if ( !empty ( $row['meta_value'] ) ) {
								array_push( $cIntroduction, $row['meta_value'] );
							}
						}
						if( $row['meta_key'] == "coupon-condition-beauty" ) {	 // 利用条件
							if ( !empty ( $row['meta_value'] ) ) {
								array_push( $cCondition, $row['meta_value'] );
							}
						}
						if( $row['meta_key'] == "coupon-attention-beauty" ) {	 // 注意事項
							if ( !empty ( $row['meta_value'] ) ) {
								array_push( $cAttention, $row['meta_value'] );
							}
						}
						if( $row['meta_key'] == "coupon-day-beauty" ) {			 // 有効期限
							if ( !empty ( $row['meta_value'] ) ) {
								array_push( $cDay, $row['meta_value'] );
							}
						}
					}
					$lengthCoupon = count ( $cName );
					// *** クーポン名を取得 ここまで

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
					if ( $mStatus ) {
						echo '<img src="' . get_template_directory_uri() . '/img/icon-good.png" alt="" class="icon-status">';
					}
					// *** .wrap-thumbnail end
					echo '</div>';
					// *** 店名
					echo '<h1>' . get_the_title() . '</h1>';
					// *** 店舗紹介
					echo '<div class="wrap-intro">';
					echo $introduction;
					echo '</div>';
				?>
				<?php
					// お店の基本情報
					// ==================================================
				?>
				<div class="m-lr-20-30">
					<h2><object type="image/svg+xml" data="<?= get_template_directory_uri(); ?>/img/icon-comment.svg"></object>お店の基本情報</h2>
					<table class="table">
						<tbody>
							<tr>
								<th>店名</th><td><?= the_title(); ?></td>
							</tr>
							<?php if ( !empty($kana) ) echo '<tr><th>ふりがな</th><td>' . $kana .'</td></tr>'; ?>
							<tr>
								<th>エリア</th><td>
									<?php
										if( $aKagoshima ) 	echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>鹿児島市エリア';
										if( $aAira ) 		echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>姶良エリア';
										if( $aKirishima ) 	echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>霧島エリア';
										if( $aHokusatsu ) 	echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>北薩エリア';
										if( $aNakasatsu ) 	echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>中薩エリア';
										if( $aNansatsu ) 	echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>南薩エリア';
										if( $aOsumi ) 		echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>大隅エリア';
										if( $aRito ) 		echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>離島エリア';
									?>
								</td>
							</tr>
							<tr>
								<th>ジャンル</th><td>
									<?php
										if ( is_array ( $genre ) ) {
											echo '<ul class="list-inline">';
											foreach ( $genre as $value ) {
												echo '<li>' . $value . '</li>';
											}
											echo '</ul>';
										} else {
											echo $genre;
										}
									?>
								</td>
							</tr>
							<?php if ( !empty($tel) ) echo '<tr><th>電話番号</th><td>' . $tel .'</td></tr>'; ?>
							<?php if ( !empty($city) || !empty($address) ) echo '<tr><th>住所</th><td>' . $city . $address .'</td></tr>'; ?>
							<?php echo '<tr><th>駐車場</th><td>' . $car . ' ' . $cNote . '</td></tr>'; ?>
							<?php if ( !empty($openLast) ) echo '<tr><th>営業時間</th><td>' . $openLast .'</td></tr>'; ?>
							<?php if ( !empty($holiday) ) echo '<tr><th>定休日</th><td>' . $holiday .'</td></tr>'; ?>
							<?php if ( !empty($site) ) echo '<tr><th>Web</th><td><a href="' . $site . '" target="_blank">' . $site . '</a></td></tr>'; ?>
							<?php if ( !empty($note) ) echo '<tr><th>備考</th><td>' . $note .'</td></tr>'; ?>
						</tbody>
					</table>
				</div>
			</div>



			<div role="tabpanel" class="tab-pane fade" id="Section2">
				<?php
					// 写真
					// ==================================================
					$galleryPhoto 				= array();
					$galleryCaption 			= array();

					foreach( $cf as $row ){
						if( $row['meta_key'] == "gallery-photo-beauty" ){
							array_push( $galleryPhoto, $row['meta_value'] );
						}
						if( $row['meta_key'] == "gallery-caption-beauty" ){
							array_push( $galleryCaption, $row['meta_value'] );
						}
					}
					$length = count ( $galleryPhoto );
					for ( $i = 0; $i < $length; $i++ ) {
						$postImg = wp_get_attachment_image ( $galleryPhoto[$i], 'full' );
						echo '<div class="box-card">';
						echo '<figure class="postImg">' . $postImg . '</figure>';
						echo '<p class="figure-caption kome"><i class="fa fa-camera" aria-hidden="true"></i> ' . $galleryCaption[$i] . '</p>';
						echo '</div>';
					}
				?>
			</div>



			<div role="tabpanel" class="tab-pane fade" id="Section4">
				<div class="wrap-googlemap">
					<?php
						// 地図
						// ==================================================
						if( $lat && $lng ) {
							echo do_shortcode('[map lat="' . $lat . '" lng="' . $lng . '" height="600px" zoom="17"]');
						} else {
							echo do_shortcode('[map addr="' . $city . $address . '" height="600px" zoom="17"]');
						}
					?>
				</div>
			</div>



			<div role="tabpanel" class="tab-pane fade" id="Section5">
				<?php
					// クーポン
					// ==================================================
					for ( $i = 0; $i < $lengthCoupon; $i++ ) {
						echo '<div class="box-default wrap-coupon m-lr-20-30">';
						echo '<h4 class="ttl">' . $cName[$i] . '</h4>';
						echo '<div class="wrap-intro">' . $cIntroduction[$i] . '</div>';
						echo '<div class="wrap-condition"><h5><i class="fa fa-file fa-fw" aria-hidden="true"></i>利用条件</h5>' . $cCondition[$i] . '</div>';
						echo '<div class="wrap-attention"><h5><i class="fa fa-exclamation-circle fa-fw" aria-hidden="true"></i>注意事項</h5>' . $cAttention[$i] . '</div>';
						echo '<p class="limit">有効期限<span class="contents">' . $cDay[$i] . '</span></p>';
						echo '</div>';
					}
				?>
			</div>



		</div>
		<?php
			// 電話をする
			// ==================================================
			if(is_mobile()) {
		?>
			<div class="box-default box-container wrap-call">
				<a href="tel:<?= $tel; ?>" class="text-center"><i class="fa fa-volume-control-phone fa-fw" aria-hidden="true"></i>電話をする</a>
			</div>
		<?php
			}
		?>
	</div>
</article>



			<?php endwhile; endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>



<?php get_footer(); ?>