<?php
	/*
		Template Name: アーカイブ ビューティー＆ヘルス
	*/
			function DB_account() {
				$value['url'] 	= 'localhost';
				$value['user'] 	= '0068-5252';
				$value['pass'] 	= 'emulator709';
				$value['db'] 	= 'database';
				return $value;
			}
			function DB_connect() {
				$account 	= DB_account();
				$link 		= mysql_connect( $account['url'], $account['user'], $account['pass'] ) or die( "MySQLへの接続に失敗しました。" );
				$selectdb 	= mysql_select_db( $account['db'], $link ) or die( "データベースの選択に失敗しました。" );
				return $link;
			}
			function query( $query ) {
				$db 	= DB_connect();
				$query 	= mb_convert_kana( $query, "asKV" );
				$retun 	= mysql_query( $query, $db );
				if( mysql_errno( $db ) ) return False;
				return $retun;
			}
			$postID = array();
			$i = 0;
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					$postID[$i] = get_the_ID();
					$postID[$i]['status'] = post_custom('member-status');
					$i++;
				endwhile;
			endif;
			// 今日の日付を取得
			$today = date("Y-m-d H:i:s");
			$i = 0;
			foreach ($postID as $value) {
				$date = query( "SELECT * FROM wpf0uwxjbk_postmeta WHERE post_id = $value AND `meta_key` = 'beauty-rand'" );
				// ステータス取得
				$setRandom = mt_rand( 1, 5000 );
				if( $date && mysql_num_rows( $date ) ) {
					while( $ary = mysql_fetch_array( $date ) ) {
						// randomdate（ランダムの数値を入れた日付）を取得
						$randomdate = $ary['beauty-date'];
						if( $randomdate != $today ) {
							$setDate 		= $today;
							$sql 			= "UPDATE wpf0uwxjbk_postmeta SET `meta_value` = $setRandom WHERE post_id = $value AND `meta_key` = 'beauty-rand'";
							$result_flag 	= mysql_query( $sql );
							if( !$result_flag ) {
								die( 'INSERTクエリーに失敗しました。' . mysql_error() );
							}
						}
					}
				}
			}
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
			<div class="row row-10">
		<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
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
						if( $row['meta_key'] == "coupon-condition-beauty" ){
							if ( !empty ( $row['meta_value'] ) ) {
								array_push( $couponCondition, $row['meta_value'] );
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
					// *** 会員ステータス
					$memberStatus 	= post_custom('member-status-beauty');
		?>

						<div class="col-xs-6 col-sm-3">
							<article>
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
										$areaKagoshima 	= post_custom('area-kagoshima-beauty'); // 鹿児島市エリア
										$areaAira 		= post_custom('area-aira-beauty'); 		// 姶良市エリア
										$areaKirishima 	= post_custom('area-kirishima-beauty'); // 霧島エリア
										$areaHokusatsu 	= post_custom('area-hokusatsu-beauty'); // 北薩エリア
										$areaNakasatsu 	= post_custom('area-nakasatsu-beauty'); // 中薩エリア
										$areaNansatsu 	= post_custom('area-nansatsu-beauty'); 	// 南薩エリア
										$areaOsumi 		= post_custom('area-osumi-beauty'); 	// 大隅エリア
										$areaRito 		= post_custom('area-rito-beauty'); 		// 離島エリア
										echo '<div class="wrap-tel-adrs bg-base-light"><ul class="list-inline">';
												$areaAll = array();
												if( $areaKagoshima ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>鹿児島市エリア</li>';
												if( $areaAira ) 		echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>姶良市エリア</li>';
												if( $areaKirishima ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>霧島エリア</li>';
												if( $areaHokusatsu ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>北薩エリア</li>';
												if( $areaNakasatsu ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>中薩エリア</li>';
												if( $areaNansatsu ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>南薩エリア</li>';
												if( $areaOsumi ) 		echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>大隅エリア</li>';
												if( $areaRito ) 		echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>離島エリア</li>';
										echo '</ul></div>';
										// ジャンル
										// --------------------------------------------------
										$genre = post_custom('genre-beauty');
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