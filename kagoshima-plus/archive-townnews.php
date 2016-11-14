<?php
	/*
		Template Name: アーカイブ 街ネタ
	*/
?>

<?php get_header(); ?>

<?php
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );
?>

<div class="container">
	<div id="extra-area">
		<div class="row row-10">
			<?php
				if ( have_posts() ) :
				while ( have_posts() ) : the_post();

					// *** 紹介文
					$introduction = post_custom('introduction-townnews');
					// *** エリア
					$areaKagoshima 	= post_custom('area-kagoshima-townnews'); 	// 鹿児島市エリア
					$areaAira 		= post_custom('area-aira-townnews'); 		// 姶良市エリア
					$areaKirishima 	= post_custom('area-kirishima-townnews'); 	// 霧島エリア
					$areaHokusatsu 	= post_custom('area-hokusatsu-townnews'); 	// 北薩エリア
					$areaNakasatsu 	= post_custom('area-nakasatsu-townnews'); 	// 中薩エリア
					$areaNansatsu 	= post_custom('area-nansatsu-townnews'); 	// 南薩エリア
					$areaOsumi 		= post_custom('area-osumi-townnews'); 		// 大隅エリア
					$areaRito 		= post_custom('area-rito-townnews'); 		// 離島エリア

			?>



			<div class="col-xs-6 col-sm-3">
				<article>
					<div class="inner height-some">
						<?php
							// アイキャッチ画像
							// --------------------------------------------------
								echo '<div class="wrap-thumbnail"><img src="';
								if ( has_post_thumbnail() ) {
									$image_id = get_post_thumbnail_id ();
									$image_url = wp_get_attachment_image_src ($image_id, true);
									echo $image_url[0];
								} else {
									echo get_bloginfo( 'template_directory' ) . '/img/thumbnail.png';
								}
								echo '" alt="' . get_the_title() . '" class="main-img lr-center"></div>';
							// 店名＆店舗紹介
							// --------------------------------------------------
								echo '<div class="wrap-name bg-base">';
								echo '<h1>' . get_the_title() . '</h1>';
								echo '<div class="wrap-intro">';
								echo $introduction;
								echo '</div>';
								echo '</div>';

							// エリア
							// --------------------------------------------------
								echo '<div class="wrap-tel-adrs bg-base-light"><ul class="list-inline">';
								if( $areaKagoshima ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>鹿児島市エリア</li>';
								if( $areaAira ) 		echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>姶良市エリア</li>';
								if( $areaKirishima ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>霧島エリア</li>';
								if( $areaHokusatsu ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>北薩エリア</li>';
								if( $areaNakasatsu ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>中薩エリア</li>';
								if( $areaNansatsu ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>南薩エリア</li>';
								if( $areaOsumi ) 		echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>大隅エリア</li>';
								if( $areaRito ) 		echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>離島エリア</li>';
								echo '</ul></div>';
							// カテゴリ
							// --------------------------------------------------
								if( post_custom('category-townnews') ) {
									echo '<div class="wrap-service bg-base-light"><ul class="list-inline">';
									foreach (post_custom('category-townnews') as $value) {
										echo '<li>' . $value . '</li>';
									}
									echo '</ul></div>';
								}
							// リンク
							// --------------------------------------------------
								echo '<a href="' . get_the_permalink() . '" class="link-cover">' . get_the_title() . '</a>';
						?>
					</div>
				</article>
			</div>



			<?php
				endwhile;
				endif;
			?>
		</div>
	</div>
</div>

<?php get_footer(); ?>