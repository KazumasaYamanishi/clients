<?php
	/*
		Template Name: アーカイブ 温泉
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
					$postID[$i]['status'] = post_custom('member-status-hotsprings');
					$i++;
				endwhile;
			endif;
			// 今日の日付を取得
			$today = date("Y-m-d H:i:s");
			$i = 0;
			foreach ($postID as $value) {
				$date = query( "SELECT * FROM wpf0uwxjbk_postmeta WHERE post_id = $value AND `meta_key` = 'hotsprings-rand'" );
				// ステータス取得
				$setRandom = mt_rand( 1, 5000 );
				if( $date && mysql_num_rows( $date ) ) {
					while( $ary = mysql_fetch_array( $date ) ) {
						// randomdate（ランダムの数値を入れた日付）を取得
						$randomdate = $ary['hotsprings-date'];
						if( $randomdate != $today ) {
							$setDate 		= $today;
							$sql 			= "UPDATE wpf0uwxjbk_postmeta SET `meta_value` = $setRandom WHERE post_id = $value AND `meta_key` = 'hotsprings-rand'";
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
		// 1．詳細検索ボタンをクリック
		// 2．Bootstrapのモーダル画面
		// 3．入力後、検索ボタンをクリック
		// 4．検索結果ページ（search.php）を表示
	?>
	<div class="wrap-search-detail">
		<div class="row row-0">
			<div class="col-xs-8">
				<select name="select-hotsprings" id="select-hotsprings" class="form-control">
					<option value="default" selected>おすすめ順</option>
					<option value="area-kirishima-hotsprings">霧島市エリア</option>
					<option value="area-nakasatsu-hotsprings">中薩エリア</option>
					<option value="area-kagoshima-hotsprings">鹿児島市エリア</option>
					<option value="area-osumi-hotsprings">大隅エリア</option>
					<option value="area-ibusuki-hotsprings">指宿市エリア</option>
					<option value="area-nansatsu-hotsprings">南薩エリア</option>
					<option value="area-satsuma-hotsprings">薩摩川内市エリア</option>
					<option value="area-rito-hotsprings">北薩エリア</option>
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
						<?php echo do_shortcode('[cftsearch format=3 search_label="上記内容で検索する"]'); ?>
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
					if( $row['meta_key'] == "coupon-name-hotsprings" ){
						if ( !empty ( $row['meta_value'] ) ) {
							array_push( $couponName, $row['meta_value'] );
						}
					}
					if( $row['meta_key'] == "coupon-introduction-hotsprings" ){
						if ( !empty ( $row['meta_value'] ) ) {
							array_push( $couponIntroduction, $row['meta_value'] );
						}
					}
					if( $row['meta_key'] == "coupon-condition-hotsprings" ){
						if ( !empty ( $row['meta_value'] ) ) {
							array_push( $couponCondition, $row['meta_value'] );
						}
					}
					if( $row['meta_key'] == "coupon-attention-hotsprings" ){
						if ( !empty ( $row['meta_value'] ) ) {
							array_push( $couponAttention, $row['meta_value'] );
						}
					}
					if( $row['meta_key'] == "coupon-day-hotsprings" ){
						if ( !empty ( $row['meta_value'] ) ) {
							array_push( $couponDay, $row['meta_value'] );
						}
					}
				}
				$lengthCoupon = count ( $couponName );
				// *** 会員ステータス
				$memberStatus 	= post_custom('member-status-hotsprings');
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
										$areaKirishima 	= post_custom('area-kirishima-hotsprings'); // 霧島市エリア
										$areaNakasatsu 	= post_custom('area-nakasatsu-hotsprings'); // 中薩方面（姶良市・湧水町）エリア
										$areaKagoshima 	= post_custom('area-kagoshima-hotsprings'); // 鹿児島市（鹿児島・桜島）エリア
										$areaOsumi 		= post_custom('area-osumi-hotsprings'); 	// 大隅方面（垂水市・志布志市・鹿屋市・内之浦町・大崎町・南大隅町・肝付町）エリア
										$areaIbusuki 	= post_custom('area-ibusuki-hotsprings'); 	// 指宿市エリア
										$areaNansatsu 	= post_custom('area-nansatsu-hotsprings'); 	// 南薩方面（日置市・南さつま市・南九州市）エリア
										$areaSatsuma 	= post_custom('area-satsuma-hotsprings'); 	// 薩摩川内市エリア
										$areaHokusatsu 	= post_custom('area-rito-hotsprings'); 		// 北薩方面（阿久根市・出水市・伊佐市・さつま町・長島町）エリア
										echo '<div class="wrap-tel-adrs bg-base-light"><ul class="list-inline">';
												$areaAll = array();
												if( $areaKirishima ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>霧島市エリア</li>';
												if( $areaNakasatsu ) 		echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>中薩エリア</li>';
												if( $areaKagoshima ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>鹿児島市エリア</li>';
												if( $areaOsumi ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>大隅エリア</li>';
												if( $areaIbusuki ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>指宿市エリア</li>';
												if( $areaNansatsu ) 	echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>南薩エリア</li>';
												if( $areaSatsuma ) 		echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>薩摩川内市エリア</li>';
												if( $areaHokusatsu ) 		echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>北薩エリア</li>';
										echo '</ul></div>';
										// キーワード
										// --------------------------------------------------
										$keywords = post_custom('keywords-hotsprings');
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
			endwhile;
		endif;
	?>
		</div>
	</div>

</div>

<?php get_footer(); ?>