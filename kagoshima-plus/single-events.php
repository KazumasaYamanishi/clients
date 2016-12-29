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
				$tjEvents 			= post_custom('tj-events'); 			// TJかごしま自主イベント
				// $bnrEvents 			= post_custom('banner-events'); 		// TOP表示用バナー
				$midashiEvents 		= post_custom('midashi-events'); 		// 見出し 30文字以内
				$introEvents 		= post_custom('introduction-events'); 	// 本文 150文字以内
				$addPhoto 			= post_custom('add-photo-events'); 		// 追加イメージ画像 繰り返し
				$eDayEvents 		= post_custom('event-day-events'); 		// 開催日
				$eTimeEvents 		= post_custom('event-time-events'); 	// 開催時間
				$eAttentionEvents 	= post_custom('event-attention-events');// 注意事項など
				$ePlaceEvents 		= post_custom('event-place-events'); 	// 会場名
				$eAddressEvents 	= post_custom('event-address-events'); 	// 会場住所
				$eOrgEvents 		= post_custom('event-org-events'); 		// 主催者
				$contactEvents 		= post_custom('contact-events'); 		// お問い合わせ
				$car 				= post_custom('car-events-radio'); 		// 駐車場
				$cNote 				= post_custom('car-events'); 			// 駐車場 - 備考
				$pEvents 			= post_custom('price-events'); 			// 入場料金
				$site 				= post_custom('site-events'); 			// イベント専用URL
				$lat 				= post_custom('lat-beauty'); 			// 緯度
				$lng 				= post_custom('lng-beauty'); 			// 経度
			?>



<article>
	<div class="inner">
		<div class="" id="Section1">
			<?php
				// TOP表示用バナー、タイトル、本文 150文字以内
				// ==================================================
					$bnrEvents = wp_get_attachment_image_src( get_post_meta($post->ID, 'banner-events', true),'full' );
					echo '<div class="wrap-thumbnail"><img src="';
					if ( $bnrEvents[0] ) {
						echo $bnrEvents[0];
					} else {
						echo get_bloginfo( 'template_directory' ) . '/img/thumbnail.png';
					}
					echo '" alt="' . get_the_title() . '" class="main-img lr-center"></div>';
					// *** イベント名
					echo '<h1>' . get_the_title() . '</h1>';
					// *** 本文 150文字以内
					echo '<div class="wrap-intro">';
					echo $introEvents;
					echo '</div>';



				// 写真
				// ==================================================
					if( $addPhoto ) {
						echo '<div class="wrap-add-photo">';
						foreach ( (array)$addPhoto as $var ) {
							$postImg = wp_get_attachment_image($var, 'full');
							echo $postImg;
						}
						echo '</div>';
					}



				// イベントの基本情報
				// ==================================================
			?>
			<div class="m-lr-20-30">
				<h2><object type="image/svg+xml" data="<?= get_template_directory_uri(); ?>/img/icon-comment.svg"></object>基本情報</h2>
				<table class="table">
					<tbody>
						<tr><th>イベント名</th><td><?= the_title(); ?></td></tr>
						<?php if ( !empty($eDayEvents) ) echo '<tr><th>開催日</th><td>' . $eDayEvents .'</td></tr>'; ?>
						<?php if ( !empty($eTimeEvents) ) echo '<tr><th>開催時間</th><td>' . $eTimeEvents .'</td></tr>'; ?>
						<?php if ( !empty($eAttentionEvents) ) echo '<tr><th>注意事項など</th><td>' . $eAttentionEvents .'</td></tr>'; ?>
						<?php if ( !empty($ePlaceEvents) ) echo '<tr><th>会場名</th><td>' . $ePlaceEvents .'</td></tr>'; ?>
						<?php if ( !empty($eAddressEvents) ) echo '<tr><th>会場住所</th><td>' . $eAddressEvents .'</td></tr>'; ?>
						<?php if ( !empty($eOrgEvents) ) echo '<tr><th>主催者</th><td>' . $eOrgEvents .'</td></tr>'; ?>
						<?php if ( !empty($contactEvents) ) echo '<tr><th>お問い合わせ</th><td>' . $contactEvents .'</td></tr>'; ?>
						<?php echo '<tr><th>駐車場</th><td>' . $car . ' ' . $cNote . '</td></tr>'; ?>
						<?php if ( !empty($pEvents) ) echo '<tr><th>入場料金</th><td>' . $pEvents .'</td></tr>'; ?>
						<?php if ( !empty($site) ) echo '<tr><th>イベント専用URL</th><td><a href="' . $site . '" target="_blank">' . $site . '</a></td></tr>'; ?>
					</tbody>
				</table>
			</div>
		</div>



		<div class="" id="Section4">
			<div class="wrap-googlemap">
				<?php
					// 地図
					// ==================================================
					if( $lat && $lng ) {
						echo do_shortcode('[map lat="' . $lat . '" lng="' . $lng . '" height="600px" zoom="17"]');
					} else {
						echo do_shortcode('[map addr="' . $eAddressEvents . '" height="600px" zoom="17"]');
					}
				?>
			</div>
		</div>
	</div>
</article>



			<?php endwhile; endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>



<?php get_footer(); ?>