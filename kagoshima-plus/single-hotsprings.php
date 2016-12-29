<?php get_header(); ?>

<?php
	// 温泉
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
				$mStatus 		= post_custom('member-status-hotsprings'); 		// 会員ステータス
				$aKirishima 	= post_custom('area-kirishima-hotsprings'); 	// エリア - 霧島市
				$aNakasatsu 	= post_custom('area-nakasatsu-hotsprings'); 	// エリア - 中薩方面（姶良市・湧水町）エリア
				$aKagoshima 	= post_custom('area-kagoshima-hotsprings'); 	// エリア - 鹿児島市（鹿児島・桜島）エリア
				$aOsumi 		= post_custom('area-osumi-hotsprings'); 		// エリア - 大隅方面（垂水市・志布志市・鹿屋市・内之浦町・大崎町・南大隅町・肝付町）エリア
				$aIbusuki 		= post_custom('area-ibusuki-hotsprings'); 		// エリア - 指宿市エリア
				$aNansatsu 		= post_custom('area-nansatsu-hotsprings'); 		// エリア - 南薩方面（日置市・南さつま市・南九州市）エリア
				$aSatsuma 		= post_custom('area-satsuma-hotsprings'); 		// エリア - 薩摩川内市エリア
				$aHokusatsu 	= post_custom('area-hokusatsu-hotsprings'); 	// エリア - 北薩方面（阿久根市・出水市・伊佐市・さつま町・長島町）エリア
				$keyWord 		= post_custom('keywords-hotsprings'); 			// キーワード
				$kana 			= post_custom('kana-hotsprings'); 				// よみがな
				$tel 			= post_custom('tel-hotsprings'); 				// 電話番号
				$city 			= post_custom('city-hotsprings'); 				// 市町村
				$address 		= post_custom('address-hotsprings'); 			// 市町村以降の住所
				$car 			= post_custom('car-hotsprings-radio'); 			// 駐車場
				$cNote 			= post_custom('car-hotsprings'); 				// 駐車場 - 備考
				$openLast 		= post_custom('open-last-hotsprings'); 			// 営業時間
				$holiday 		= post_custom('holiday-hotsprings-radio'); 		// 定休日
				$holiday 		= post_custom('holiday-hotsprings'); 			// 定休日 - 備考
				$tTime 			= post_custom('tachiyori-time-hotsprings'); 	// 立寄入浴営業時間
				$tPrice 		= post_custom('tachiyori-price-hotsprings'); 	// 立寄入浴料金
				$kTime 			= post_custom('kashikiri-time-hotsprings'); 	// 貸切湯営業時間
				$kPrice 		= post_custom('kashikiri-price-hotsprings'); 	// 貸切湯料金
				$senshitsu 		= post_custom('senshitsu-hotsprings'); 			// 泉質
				$kounou 		= post_custom('kounou-hotsprings'); 			// 効能
				$bNum 			= post_custom('bath-num-hotsprings'); 			// 浴場数
				$bKashikiri 	= post_custom('bath-kashikiri-hotsprings'); 	// 貸切湯数
				$shampoo 		= post_custom('shampoo-hotsprings'); 			// アメニティー／シャンプー
				$rinse 			= post_custom('rinse-hotsprings'); 				// アメニティー／リンス
				$rinseIn 		= post_custom('rinse-in-hotsprings'); 			// アメニティー／リンスinシャンプー
				$soap 			= post_custom('soap-hotsprings'); 				// アメニティー／石鹸 or ソープ
				$towel 			= post_custom('towel-hotsprings'); 				// アメニティー／タオル
				$bathTowel 		= post_custom('bath-towel-hotsprings'); 		// アメニティー／バスタオル or タオル
				$dryer 			= post_custom('dryer-hotsprings'); 				// アメニティー／ドライヤー
				$site 			= post_custom('site-hotsprings'); 				// ホームページ
				$note 			= post_custom('note-hotsprings'); 				// 備考
				// 繰り返し - gallery-hotsprings - イメージ画像、キャプション
				$introduction 	= post_custom('introduction-hotsprings'); 		// 紹介文
				$lat 			= post_custom('lat-hotsprings'); 				// 緯度
				$lng 			= post_custom('lng-hotsprings'); 				// 経度
				// 繰り返し - coupon-hotsprings - クーポン名、クーポン内容、利用条件、注意事項、クーポン有効期限
				$fb 			= post_custom('link-fb-hotsprings'); 				// Facebookページリンク
				$insta 			= post_custom('link-ig-hotsprings'); 				// Instagramリンク
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
				<!-- <li role="presentation"><a href="#Section3" aria-controls="tachiyori" role="tab" data-toggle="tab">写真</a></li> -->
				<li role="presentation"><a href="#Section4" aria-controls="map" role="tab" data-toggle="tab">地図</a></li>
				<li role="presentation"><a href="#Section5" aria-controls="coupon" role="tab" data-toggle="tab">クーポン</a></li>
			</ul>
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
							if( $row['meta_key'] == "coupon-name-hotsprings" ) {		 // クーポン名
								if ( !empty ( $row['meta_value'] ) ) {
									array_push( $cName, $row['meta_value'] );
								}
							}
							if( $row['meta_key'] == "coupon-introduction-hotsprings" ) { // クーポン内容
								if ( !empty ( $row['meta_value'] ) ) {
									array_push( $cIntroduction, $row['meta_value'] );
								}
							}
							if( $row['meta_key'] == "coupon-condition-hotsprings" ) {	 // 利用条件
								if ( !empty ( $row['meta_value'] ) ) {
									array_push( $cCondition, $row['meta_value'] );
								}
							}
							if( $row['meta_key'] == "coupon-attention-hotsprings" ) {	 // 注意事項
								if ( !empty ( $row['meta_value'] ) ) {
									array_push( $cAttention, $row['meta_value'] );
								}
							}
							if( $row['meta_key'] == "coupon-day-hotsprings" ) {			 // 有効期限
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
											if( $aKirishima ) 	echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>霧島市エリア';
											if( $aNakasatsu ) 		echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>中薩方面エリア';
											if( $aKagoshima ) 	echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>鹿児島市エリア';
											if( $aOsumi ) 	echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>大隅方面エリア';
											if( $aIbusuki ) 	echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>指宿市エリア';
											if( $aNansatsu ) 	echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>南薩方面エリア';
											if( $aSatsuma ) 		echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>薩摩川内市エリア';
											if( $aHokusatsu ) 		echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>北薩方面エリア';
										?>
									</td>
								</tr>
								<tr>
									<th>キーワード</th><td>
										<?php
											if ( is_array ( $keyWord ) ) {
												echo '<ul class="list-inline">';
												foreach ( $keyWord as $value ) {
													echo '<li>' . $value . '</li>';
												}
												echo '</ul>';
											} else {
												echo $keyWord;
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
							if( $row['meta_key'] == "gallery-photo-hotsprings" ){
								array_push( $galleryPhoto, $row['meta_value'] );
							}
							if( $row['meta_key'] == "gallery-caption-hotsprings" ){
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



				<div role="tabpanel" class="tab-pane fade" id="Section3">
					<div class="wrap-tachiyori">
						<?php
							// 立ち寄り、貸し切り、泉質など
							// ==================================================
						?>
						<table class="table">
							<tbody>
								<?php
									if($tTime) {
										echo '<tr><th>立寄入浴営業時間</th><td>' . $tTime . '</td></tr>';
									}
									if($tPrice) {
										echo '<tr><th>立寄入浴料金</th><td>' . $tPrice . '</td></tr>';
									}
									if($kTime) {
										echo '<tr><th>貸切湯営業時間</th><td>' . $kTime . '</td></tr>';
									}
									if($kPrice) {
										echo '<tr><th>貸切湯料金</th><td>' . $kPrice . '</td></tr>';
									}
									if($senshitsu) {
										echo '<tr><th>泉質</th><td>' . $senshitsu . '</td></tr>';
									}
									if($kounou) {
										echo '<tr><th>効能</th><td>' . $kounou . '</td></tr>';
									}
									if($bNum) {
										echo '<tr><th>浴場数</th><td>' . $bNum . '</td></tr>';
									}
									if($bKashikiri) {
										echo '<tr><th>貸切湯数</th><td>' . $bKashikiri . '</td></tr>';
									}
								?>
							</tbody>
						</table>
					</div>
					<div class="wrap-amenity">
						<?php
							// アメニティー
							// ==================================================
						?>
						<table class="table">
							<tbody>
								<?php
									if($shampoo) {
										echo '<tr><th>アメニティー／シャンプー</th><td>' . $shampoo . '</td></tr>';
									}
									if($rinse) {
										echo '<tr><th>アメニティー／リンス</th><td>' . $rinse . '</td></tr>';
									}
									if($rinseIn) {
										echo '<tr><th>アメニティー／リンスinシャンプー</th><td>' . $rinseIn . '</td></tr>';
									}
									if($soap) {
										echo '<tr><th>アメニティー／石鹸 or ソープ</th><td>' . $soap . '</td></tr>';
									}
									if($towel) {
										echo '<tr><th>アメニティー／タオル</th><td>' . $towel . '</td></tr>';
									}
									if($bathTowel) {
										echo '<tr><th>アメニティー／バスタオル or タオル</th><td>' . $bathTowel . '</td></tr>';
									}
									if($dryer) {
										echo '<tr><th>アメニティー／ドライヤー</th><td>' . $dryer . '</td></tr>';
									}
								?>
							</tbody>
						</table>
					</div>
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