<?php get_header(); ?>

<?php
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );

	if(have_posts()): while(have_posts()):the_post();

	// カスタムフィールドの値を取得
	// ==================================================
	$memberStatus 	= post_custom('member-status'); 	// 会員ステータス
	$city 			= post_custom('city'); 				// 市町村
	$address 		= post_custom('address'); 			// 市町村以降の住所
	$lat 			= post_custom('lat'); 				// 緯度
	$lng 			= post_custom('lng'); 				// 経度
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
	// $gallery 		= post_custom('gallery'); 			// ギャラリー
	$car 			= post_custom('car'); 				// 駐車場
	$credit 		= post_custom('credit'); 			// クレジットカード
	$charge 		= post_custom('charge'); 			// サービス・チャージ料
	$seat 			= post_custom('seat'); 				// 席数
	$private 		= post_custom('private'); 			// 個室
	$reserve 		= post_custom('reserve'); 			// 貸切
	$tabaco 		= post_custom('tabaco'); 			// 煙草
	$site 			= post_custom('site'); 				// ホームページ
	$note 			= post_custom('note'); 				// 備考
?>
<div class="container">
	<article<?php if( $memberStatus == '有料' ) echo ' class="pay-mbr"'; ?>>
		<div class="inner">
			<?php
				// ナビゲーション
			?>
			<div class="tab" role="tabpanel">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#Section1" aria-controls="basic" role="tab" data-toggle="tab">基本情報</a></li>
					<li role="presentation"><a href="#Section2" aria-controls="photo" role="tab" data-toggle="tab">写真</a></li>
					<li role="presentation"><a href="#Section3" aria-controls="menu" role="tab" data-toggle="tab">メニュー</a></li>
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
							// *** クーポン 値を取得 ここまで

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
							// *** 外観写真
							echo '<img src="' . $outphoto[0] . '" alt="' . get_the_title() . '" class="lr-center">';
							// *** 内観写真
							echo '<img src="' . $inphoto[0] . '" alt="' . get_the_title() . '" class="lr-center">';
							// *** 店名
							echo '<h1>' . get_the_title() . '</h1>';
							// *** 店舗紹介
							echo '<div class="wrap-intro">';
							echo esc_html($introduction);
							echo '</div>';
						?>
						<?php
							// お店の基本情報
							// ==================================================
						?>
						<h2><object type="image/svg+xml" data="<?= get_template_directory_uri(); ?>/img/icon-comment.svg"></object>お店の基本情報</h2>
						<table class="table">
							<tbody>
								<tr>
									<th>店名</th><td><?= the_title(); ?></td>
								</tr>
								<tr>
									<th>エリア</th><td>
										<?php
											if( $areaKagoshima ) 	echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>鹿児島市エリア';
											if( $areaAira ) 		echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>姶良市・霧島市エリア';
											if( $areaHokusatsu ) 	echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>北薩エリア';
											if( $areaNakasatsu ) 	echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>中薩エリア';
											if( $areaNansatsu ) 	echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>南薩エリア';
											if( $areaOsumi ) 		echo '<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>大隅エリア';
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
								<tr>
									<th>電話番号</th><td>
										<?= $tel; ?>
									</td>
								</tr>
								<tr>
									<th>住所</th><td>
										<?= $city . $address; ?>
									</td>
								</tr>
								<tr>
									<th>駐車場</th><td>
										<?= $car; ?>
									</td>
								</tr>
								<tr>
									<th>営業時間</th><td>
										<?= $openLast; ?>
									</td>
								</tr>
								<tr>
									<th>定休日</th><td>
										<?= $holiday; ?>
									</td>
								</tr>
								<tr>
									<th>カード</th><td>
										<?php
											if ( is_array ( $credit ) ) {
												echo '<ul class="list-inline">';
												foreach ( $credit as $value ) {
													echo '<li>' . $value . '</li>';
												}
												echo '</ul>';
											} else {
												echo $credit;
											}
										?>
									</td>
								</tr>
								<tr>
									<th>席数</th><td>
										<?= $seat; ?>
									</td>
								</tr>
								<tr>
									<th>個室</th><td>
										<?= $private; ?>
									</td>
								</tr>
								<tr>
									<th>サービス</th><td>
										<?php
											if ( is_array ( $service ) ) {
												echo '<ul class="list-inline">';
												foreach ( $service as $value ) {
													echo '<li>' . $value . '</li>';
												}
												echo '</ul>';
											} else {
												echo $service;
											}
										?>
									</td>
								</tr>
								<tr>
									<th>設備</th><td>
										<?php
											if ( is_array ( $facility ) ) {
												echo '<ul class="list-inline">';
												foreach ( $facility as $value ) {
													echo '<li>' . $value . '</li>';
												}
												echo '</ul>';
											} else {
												echo $facility;
											}
										?>
									</td>
								</tr>
								<tr>
									<th>シーン</th><td>
										<?php
											if ( is_array ( $scene ) ) {
												echo '<ul class="list-inline">';
												foreach ( $scene as $value ) {
													echo '<li>' . $value . '</li>';
												}
												echo '</ul>';
											} else {
												echo $scene;
											}
										?>
									</td>
								</tr>
								<tr>
									<th>貸切</th><td>
										<?= $reserve; ?>
									</td>
								</tr>
								<tr>
									<th>サービス料チャージ料</th><td>
										<?= $charge; ?>
									</td>
								</tr>
								<tr>
									<th>タバコ</th><td>
										<?= $tabaco; ?>
									</td>
								</tr>
								<tr>
									<th>Web</th><td>
										<a href="<?= $site; ?>" target="_blank"><?= $site; ?></a>
									</td>
								</tr>
								<tr>
									<th>備考</th><td>
										<?= $note; ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>



					<div role="tabpanel" class="tab-pane fade" id="Section2">
						<?php
							// 写真
							// ==================================================
							$galleryPhoto 				= array();
							$galleryCaption 			= array();

							foreach( $cf as $row ){
								if( $row['meta_key'] == "gallery-photo" ){
									array_push( $galleryPhoto, $row['meta_value'] );
								}
								if( $row['meta_key'] == "gallery-caption" ){
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
						<?php
							// メニュー
							// ==================================================
							$menuName 				= array();
							$menuIntroduction 		= array();
							$menuPhoto 				= array();
							$menuPrice 				= array();
							$otherMenuName 			= array();
							$otherMenuPrice 		= array();

							// *** 人気メニュー
							echo '<h2 class="ttl-popular"><object type="image/svg+xml" data="' . get_template_directory_uri() . '/img/icon-ninkimenu.svg"></object>人気メニュー</h2>';
							foreach( $cf as $row ){
								if( $row['meta_key'] == "menu-name" ){
									array_push( $menuName, $row['meta_value'] );
								}
								if( $row['meta_key'] == "menu-introduction" ){
									array_push( $menuIntroduction, $row['meta_value'] );
								}
								if( $row['meta_key'] == "menu-photo" ){
									array_push( $menuPhoto, $row['meta_value'] );
								}
								if( $row['meta_key'] == "menu-price" ){
									array_push( $menuPrice, $row['meta_value'] );
								}
							}

							$length = count ( $menuName );

							for ( $i = 0; $i < $length; $i++ ) {
								echo '<div class="wrap-menu">';
								$postImg = wp_get_attachment_image ( $menuPhoto[$i], 'full' );
								echo '<figure class="postImg">' . $postImg . '</figure>';
								echo '<h4 class="ttl">' . $menuName[$i] . '</h4>';
								echo '<div class="wrap-intro">' . $menuIntroduction[$i] . '</div>';
								echo '<p class="price">' . $menuPrice[$i] . '円</p>';
								echo '</div>';
							}

							// *** その他主なメニュー
							foreach( $cf as $row ){
								if( $row['meta_key'] == "other-menu-name" ){
									array_push( $otherMenuName, $row['meta_value'] );
								}
								if( $row['meta_key'] == "other-menu-price" ){
									array_push( $otherMenuPrice, $row['meta_value'] );
								}
							}

							$length = count ( $otherMenuName );

							echo '<div class="wrap-other-menu"><h2><object type="image/svg+xml" data="' . get_template_directory_uri() . '/img/icon-tamenu.svg"></object>その他主なメニュー</h2><table class="table"><tbody>';
							for ( $i = 0; $i < $length; $i++ ) {
								echo '<tr>';
								echo '<th>' . $otherMenuName[$i] . '</th>';
								echo '<td>' . $otherMenuPrice[$i] . '円</td>';
								echo '</tr>';
							}
							echo '</tbody></table></div>';
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
								echo '<div class="box-default wrap-coupon">';
								echo '<h4 class="ttl">' . $couponName[$i] . '</h4>';
								echo '<div class="wrap-intro">' . $couponIntroduction[$i] . '</div>';
								echo '<div class="wrap-attention"><h5><i class="fa fa-exclamation-circle fa-fw" aria-hidden="true"></i>注意事項</h5>' . $couponAttention[$i] . '</div>';
								echo '<p class="limit">有効期限<span class="contents">' . $couponDay[$i] . '</span></p>';
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
</div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>