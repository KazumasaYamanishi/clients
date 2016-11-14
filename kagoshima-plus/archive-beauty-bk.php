<?php
	/*
		Template Name: アーカイブ ビューティー＆ヘルス
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
	?>
		<div class="wrap-search-detail">
			<div class="row row-0">
				<div class="col-xs-8">
					<select name="select-beauty" id="select-beauty" class="form-control">
						<option value="default" selected>おすすめ順</option>
						<option value="area-kagoshima-beauty">鹿児島市エリア</option>
						<option value="area-aira-beauty">姶良エリア</option>
						<option value="area-kirishima-beauty">霧島エリア</option>
						<option value="area-hokusatsu-beauty">北薩エリア</option>
						<option value="area-nakasatsu-beauty">中薩エリア</option>
						<option value="area-nansatsu-beauty">南薩エリア</option>
						<option value="area-osumi-beauty">大隅エリア</option>
						<option value="area-rito-beauty">離島エリア</option>
					</select>
				</div>
				<div class="col-xs-4">
					<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">詳細検索</button>
				</div>
			</div>
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
							<?php echo do_shortcode('[cftsearch format=2 search_label="上記内容で検索する"]'); ?>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="extra-error alert alert-danger">お探しの記事が見つかりませんでした。</div>






	<div id="extra-area">
	<?php
		$rowNum = 0;
		$args = array(
			'post_type' 	=> 'beauty',
			'post_status' 	=> 'publish',
			'orderby' 		=> 'meta_value',
			'order' 		=> 'DESC',
			'meta_key' 		=> 'member-status-beauty',
			'posts_per_page' => -1,
		);
		$the_query = new WP_Query( $args );
		if($the_query->have_posts()): while($the_query->have_posts()):$the_query->the_post();
		global $wpdb;
		$query 	= "SELECT meta_id,post_id,meta_key,meta_value FROM $wpdb->postmeta WHERE post_id = $post->ID ORDER BY meta_id ASC";
		$cf 	= $wpdb->get_results($query, ARRAY_A);
		// *** クーポン 値を取得
		$couponName 		= array();
		$couponIntroduction = array();
		$couponAttention 	= array();
		$couponDay 			= array();
		foreach( $cf as $row ){
			if( $row['meta_key'] == "coupon-name-beauty" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponName, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-introduction-beauty" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponIntroduction, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-attention-beauty" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponAttention, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-day-beauty" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponDay, $row['meta_value'] );
				}
			}
		}
		$lengthCoupon = count ( $couponName );
		$memberStatus 	= post_custom('member-status-beauty'); 	// 会員ステータス
		$areaKagoshima 	= post_custom('area-kagoshima-beauty'); 	// 鹿児島市エリア
		$areaAira 		= post_custom('area-aira-beauty'); 		// 姶良市エリア
		$areaKirishima 	= post_custom('area-kirishima-beauty'); 	// 霧島エリア
		$areaHokusatsu 	= post_custom('area-hokusatsu-beauty'); 	// 北薩エリア
		$areaNakasatsu 	= post_custom('area-nakasatsu-beauty'); 	// 中薩エリア
		$areaNansatsu 	= post_custom('area-nansatsu-beauty'); 	// 南薩エリア
		$areaOsumi 		= post_custom('area-osumi-beauty'); 		// 大隅エリア
		$areaRito 		= post_custom('area-rito-beauty'); 		// 離島エリア
		$genre 			= post_custom('genre-beauty'); 			// ジャンル
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
					// 店名
					echo '<div class="wrap-name bg-base">';
						echo '<h1><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h1>';
					echo '</div>';
					// エリア
					echo '<div class="wrap-tel-adrs bg-base-light">';
							$areaAll = array();
							if( $areaKagoshima ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>鹿児島市エリア</li>';
							if( $areaAira ) 		echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>姶良市エリア</li>';
							if( $areaKirishima ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>霧島エリア</li>';
							if( $areaHokusatsu ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>北薩エリア</li>';
							if( $areaNakasatsu ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>中薩エリア</li>';
							if( $areaNansatsu ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>南薩エリア</li>';
							if( $areaOsumi ) 		echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>大隅エリア</li>';
							if( $areaRito ) 		echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>離島エリア</li>';
					echo '</div>';
					// ジャンル
					// --------------------------------------------------
					if ( !empty($genre) ) {
						echo '<div class="wrap-genre bg-base-light"><ul class="list-inline">';
						if ( is_array ( $genre ) ) {
							foreach ( $genre as $value ) {
								echo '<li>' . $value . '</li>';
							}
						} else {
							echo '<li>' . $genre . '</li>';
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
	</div>
	<?php wp_reset_query(); ?>
	<div class="pagenavi">
		<?php
			// ページナビ
			posts_nav_link();
		?>
	</div>

</div>

<?php get_footer(); ?>