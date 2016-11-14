<?php get_header(); ?>

<?php
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );

	if(have_posts()): while(have_posts()):the_post();

		// *** 紹介文
		$introduction 	= post_custom('introduction-townnews');
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
<div class="container">
	<article>
		<div class="inner">
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
				// タイトル
				// --------------------------------------------------
					echo '<h1 class="title">' . get_the_title() . '</h1>';
			?>
			<div class="wrap-contents">
				<?php
					// 紹介文
					// --------------------------------------------------
						echo '<div class="wrap-intro">';
						echo $introduction;
						echo '</div>';
					// エリア
					// --------------------------------------------------
						echo '<div class="wrap-table"><table class="table"><tbody>';
							// *** 鹿児島市エリア
							if( $areaKagoshima ) {
								echo '<tr><th>鹿児島市エリア</th><td><ul>';
								if( is_array( $areaKagoshima ) ) {
									foreach ($areaKagoshima as $value) {
										echo '<li>' . $value . '</li>';
									}
								} else {
									echo '<li>' . $areaKagoshima . '</li>';
								}
								echo '</ul></td></tr>';
							}
							// *** 姶良市エリア
							if( $areaAira ) {
								echo '<tr><th>姶良市エリア</th><td><ul>';
								if( is_array( $areaAira ) ) {
									foreach ($areaAira as $value) {
										echo '<li>' . $value . '</li>';
									}
								} else {
									echo '<li>' . $areaAira . '</li>';
								}
								echo '</ul></td></tr>';
							}
							// *** 霧島エリア
							if( $areaKirishima ) {
								echo '<tr><th>霧島エリア</th><td><ul>';
								if( is_array( $areaKirishima ) ) {
									foreach ($areaKirishima as $value) {
										echo '<li>' . $value . '</li>';
									}
								} else {
									echo '<li>' . $areaKirishima . '</li>';
								}
								echo '</ul></td></tr>';
							}
							// *** 北薩エリア
							if( $areaHokusatsu ) {
								echo '<tr><th>北薩エリア</th><td><ul>';
								if( is_array( $areaHokusatsu ) ) {
									foreach ($areaHokusatsu as $value) {
										echo '<li>' . $value . '</li>';
									}
								} else {
									echo '<li>' . $areaHokusatsu . '</li>';
								}
								echo '</ul></td></tr>';
							}
							// *** 中薩エリア
							if( $areaHokusatsu ) {
								echo '<tr><th>中薩エリア</th><td><ul>';
								if( is_array( $areaHokusatsu ) ) {
									foreach ($areaHokusatsu as $value) {
										echo '<li>' . $value . '</li>';
									}
								} else {
									echo '<li>' . $areaHokusatsu . '</li>';
								}
								echo '</ul></td></tr>';
							}
							// *** 南薩エリア
							if( $areaNansatsu ) {
								echo '<tr><th>南薩エリア</th><td><ul>';
								if( is_array( $areaNansatsu ) ) {
									foreach ($areaNansatsu as $value) {
										echo '<li>' . $value . '</li>';
									}
								} else {
									echo '<li>' . $areaNansatsu . '</li>';
								}
								echo '</ul></td></tr>';
							}
							// *** 大隅エリア
							if( $areaOsumi ) {
								echo '<tr><th>大隅エリア</th><td><ul>';
								if( is_array( $areaOsumi ) ) {
									foreach ($areaOsumi as $value) {
										echo '<li>' . $value . '</li>';
									}
								} else {
									echo '<li>' . $areaOsumi . '</li>';
								}
								echo '</ul></td></tr>';
							}
							// *** 離島エリア
							if( $areaRito ) {
								echo '<tr><th>離島エリア</th><td><ul>';
								echo '<li>' . $areaRito . '</li>';
								echo '</ul></td></tr>';
							}
						echo '</tbody></table></div>';
					// カテゴリ
					// --------------------------------------------------
						if( post_custom('category-townnews') ) {
							echo '<div><h2 class="title">カテゴリー</h2><ul>';
							if( is_array( post_custom('category-townnews') ) ) {
								foreach (post_custom('category-townnews') as $value) {
									echo '<li>' . $value . '</li>';
								}
							} else {
								echo '<li>' . post_custom('category-townnews') . '</li>';
							}
							echo '</ul></div>';
						}
				?>
				<?php
					// グーグルマップ
					// --------------------------------------------------
				?>
					<div class="wrap-map">
						<?php echo do_shortcode( "[map width='100%' height='350px' lat=" . post_custom('lat-townnews') . " lng=" . post_custom('lng-townnews') . "]" ); ?>
					</div>
			</div>
		</div>
	</article>
</div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>