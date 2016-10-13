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
<div class="container">
	<article<?php if( $memberStatus == '有料' ) echo ' class="pay-mbr"'; ?>>
		<div class="inner">
			<?php
				// ナビゲーション
			?>
			<?php
				// 基本情報
				// ==================================================
				// *** アイキャッチ画像
				echo '<div class="wrap-thumbnail"><a href="' . get_the_permalink() . '"><img src="';
				if ( has_post_thumbnail() ) {
					$image_id = get_post_thumbnail_id ();
					$image_url = wp_get_attachment_image_src ($image_id, true);
					echo $image_url[0];
				} else {
					echo get_bloginfo( 'template_directory' ) . '/img/thumbnail.png';
				}
				echo '" alt="' . get_the_title() . '"></a></div>';
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
			<h2>お店の基本情報</h2>
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
						<th>貸切</th><td>
							<?php?>
						</td>
					</tr>
					<tr>
						<th>煙草</th><td>
							<?php?>
						</td>
					</tr>
					<tr>
						<th>Web</th><td>
							<?= $site; ?>
						</td>
					</tr>
				</tbody>
			</table>
			<?php
				// 写真
			?>
			<?php
				// メニュー
			?>
			<?php
				// 地図
			?>
			<?php
				// クーポン
			?>
		</div>
	</article>
</div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>