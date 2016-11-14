<?php
	/*
		Template Name: アーカイブ グルメ
	*/
?>

<?php get_header(); ?>

<?php
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );
?>

<div class="container">

	<div id="debug-area"></div>

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
				<select name="select-gourmet" id="select-gourmet" class="form-control">
					<option value="default" selected>おすすめ順</option>
					<option value="keyword-c">クーポンあり</option>
					<option value="keyword-l">ランチ</option>
					<option value="area-kagoshima">鹿児島市エリア</option>
					<option value="area-aira">姶良エリア</option>
					<option value="area-kirishima">霧島エリア</option>
					<option value="area-hokusatsu">北薩エリア</option>
					<option value="area-nakasatsu">中薩エリア</option>
					<option value="area-nansatsu">南薩エリア</option>
					<option value="area-osumi">大隅エリア</option>
					<option value="area-rito">離島エリア</option>
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
						<?php echo do_shortcode('[cftsearch format=1 search_label="上記内容で検索する"]'); ?>
					</form>
				</div>
			</div>
		</div>
	</div>


	<div class="extra-error alert alert-danger">お探しの記事が見つかりませんでした。</div>
	<div id="extra-area">
	<?php

		// 配列の初期化
		$args 			= array();
		$postsGourmet 	= array();

		// ==================================================
		// 有料の記事だけを抽出し、ランダムに配列に代入
		// ==================================================
			$args = array(
				'post_type' 		=> 'gourmet',
				'post_status' 		=> 'publish',
				'posts_per_page' 	=> -1,
				'meta_key' 			=> 'member-status',
				'meta_value' 		=> '有料',
			);
			$query_customer = new WP_Query( $args );
			if( $query_customer->have_posts() ):
				while( $query_customer->have_posts() ) : $query_customer->the_post();

					// ソート時に使用する乱数（ ランダムの数値を作成 1～5,000 ）・記事ID
					// --------------------------------------------------
					$randNum = 'Y-' . mt_rand( 1, 5000 ) . '-' . get_the_ID();

					// 店名（タイトル）
					// --------------------------------------------------
					$postsGourmet[$randNum]['name'] = get_the_title();

					// パーマリンク
					// --------------------------------------------------
					$postsGourmet[$randNum]['link'] = get_the_permalink();

					// アイキャッチ画像
					// --------------------------------------------------
					if ( has_post_thumbnail() ) {
						$image_id 	= get_post_thumbnail_id ();
						$image_url 	= wp_get_attachment_image_src ($image_id, true);
						$postsGourmet[$randNum]['eyecatch'] = $image_url[0];
					} else {
						$postsGourmet[$randNum]['eyecatch'] = get_template_directory_uri() . '/img/thumbnail.png';
					}

					// ジャンル
					// --------------------------------------------------
					if ( post_custom( 'genre' ) ) {
						if ( is_array( post_custom( 'genre' ) ) ) {
							$postsGourmet[$randNum]['genre'] = post_custom( 'genre' );
						} else {
							$postsGourmet[$randNum]['genre'][0] = post_custom( 'genre' );
						}
					} else {
						$postsGourmet[$randNum]['genre'] = '';
					}

					// エリア
					// --------------------------------------------------
					$areaKagoshima 	= post_custom('area-kagoshima'); 	// 鹿児島市エリア
					$areaAira 		= post_custom('area-aira'); 		// 姶良エリア
					$areaKirishima 	= post_custom('area-kirishima'); 	// 霧島エリア
					$areaHokusatsu 	= post_custom('area-hokusatsu'); 	// 北薩エリア
					$areaNakasatsu 	= post_custom('area-nakasatsu'); 	// 中薩エリア
					$areaNansatsu 	= post_custom('area-nansatsu'); 	// 南薩エリア
					$areaOsumi 		= post_custom('area-osumi'); 		// 大隅エリア
					$areaRito 		= post_custom('area-rito'); 		// 離島エリア
					if ( $areaKagoshima ) {
						if ( is_array ( $areaKagoshima ) ) {
							$postsGourmet[$randNum]['area']['kagoshima'] 	= $areaKagoshima;
						} else {
							$postsGourmet[$randNum]['area']['kagoshima'][0] = $areaKagoshima;
						}
					} else {
						$postsGourmet[$randNum]['area']['kagoshima'] 	= '';
					}
					if ( $areaAira ) {
						if ( is_array ( $areaAira ) ) {
							$postsGourmet[$randNum]['area']['aira'] 		= $areaAira;
						} else {
							$postsGourmet[$randNum]['area']['aira'][0] 		= $areaAira;
						}
					} else {
						$postsGourmet[$randNum]['area']['aira'] 		= '';
					}
					if ( $areaKirishima ) {
						if ( is_array ( $areaKirishima ) ) {
							$postsGourmet[$randNum]['area']['kirishima'] 	= $areaKirishima;
						} else {
							$postsGourmet[$randNum]['area']['kirishima'][0] = $areaKirishima;
						}
					} else {
						$postsGourmet[$randNum]['area']['kirishima'] 	= '';
					}
					if ( $areaHokusatsu ) {
						if ( is_array ( $areaHokusatsu ) ) {
							$postsGourmet[$randNum]['area']['hokusatsu'] 	= $areaHokusatsu;
						} else {
							$postsGourmet[$randNum]['area']['hokusatsu'][0] = $areaHokusatsu;
						}
					} else {
						$postsGourmet[$randNum]['area']['hokusatsu'] 	= '';
					}
					if ( $areaNakasatsu ) {
						if ( is_array ( $areaNakasatsu ) ) {
							$postsGourmet[$randNum]['area']['nakasatsu'] 	= $areaNakasatsu;
						} else {
							$postsGourmet[$randNum]['area']['nakasatsu'][0] = $areaNakasatsu;
						}
					} else {
						$postsGourmet[$randNum]['area']['nakasatsu'] 	= '';
					}
					if ( $areaNansatsu ) {
						if ( is_array ( $areaNansatsu ) ) {
							$postsGourmet[$randNum]['area']['nansatsu'] 	= $areaNansatsu;
						} else {
							$postsGourmet[$randNum]['area']['nansatsu'][0] 	= $areaNansatsu;
						}
					} else {
						$postsGourmet[$randNum]['area']['nansatsu'] 	= '';
					}
					if ( $areaOsumi ) {
						if ( is_array ( $areaOsumi ) ) {
							$postsGourmet[$randNum]['area']['osumi'] 		= $areaOsumi;
						} else {
							$postsGourmet[$randNum]['area']['osumi'][0] 	= $areaOsumi;
						}
					} else {
						$postsGourmet[$randNum]['area']['osumi'] 		= '';
					}
					if ( $areaRito ) {
						if ( is_array ( $areaRito ) ) {
							$postsGourmet[$randNum]['area']['rito'] 		= $areaRito;
						} else {
							$postsGourmet[$randNum]['area']['rito'][0] 		= $areaRito;
						}
					} else {
						$postsGourmet[$randNum]['area']['rito'] 		= '';
					}

					// キーワード
					// --------------------------------------------------
					if ( post_custom( 'keywords' ) ) {
						if ( is_array( post_custom( 'keywords' ) ) ) {
							$postsGourmet[$randNum]['keywords'] = post_custom( 'keywords' );
						} else {
							$postsGourmet[$randNum]['keywords'][0] = post_custom( 'keywords' );
						}
					} else {
						$postsGourmet[$randNum]['keywords'] = '';
					}

					// ふりがな
					// --------------------------------------------------
					$postsGourmet[$randNum]['kana'] = post_custom( 'kana' );

					// 電話番号
					// --------------------------------------------------
					$postsGourmet[$randNum]['tel'] = post_custom( 'tel' );

					// 市町村
					// --------------------------------------------------
					$postsGourmet[$randNum]['city'] = post_custom( 'city' );

					// 市町村以降の住所
					// --------------------------------------------------
					$postsGourmet[$randNum]['address'] = post_custom( 'address' );

					// 駐車場
					// --------------------------------------------------
					$postsGourmet[$randNum]['car'] = post_custom( 'car' );

					// 営業時間
					// --------------------------------------------------
					$postsGourmet[$randNum]['open-last'] = post_custom( 'open-last' );

					// 定休日
					// --------------------------------------------------
					$postsGourmet[$randNum]['holiday'] = post_custom( 'holiday' );

					// 紹介文
					// --------------------------------------------------
					$postsGourmet[$randNum]['introduction'] = post_custom( 'introduction' );

					// クレジットカード
					// --------------------------------------------------
					if ( post_custom( 'credit' ) ) {
						if ( is_array( post_custom( 'credit' ) ) ) {
							$postsGourmet[$randNum]['credit'] = post_custom( 'credit' );
						} else {
							$postsGourmet[$randNum]['credit'][0] = post_custom( 'credit' );
						}
					} else {
						$postsGourmet[$randNum]['credit'] = '';
					}

					// 席数
					// --------------------------------------------------
					$postsGourmet[$randNum]['seat'] = post_custom( 'seat' );

					// 個室
					// --------------------------------------------------
					$postsGourmet[$randNum]['private'] = post_custom( 'private' );

					// 貸切
					// --------------------------------------------------
					$postsGourmet[$randNum]['reserve'] = post_custom( 'reserve' );

					// サービス・チャージ料
					// --------------------------------------------------
					$postsGourmet[$randNum]['charge'] = post_custom( 'charge' );

					// 煙草
					// --------------------------------------------------
					$postsGourmet[$randNum]['tabaco'] = post_custom( 'tabaco' );

					// ホームページ
					// --------------------------------------------------
					$postsGourmet[$randNum]['site'] = post_custom( 'site' );

					// 備考
					// --------------------------------------------------
					$postsGourmet[$randNum]['note'] = post_custom( 'note' );

					// 料理以外の画像
					// --------------------------------------------------

					// それぞれの変数を格納
					$photo 		= post_custom( 'gallery-photo' );
					$caption 	= post_custom( 'gallery-caption' );
					$gallery 	= post_custom( 'gallery' );
					// グループごとに呼び出す
					if ( !empty ( $gallery ) ) {
						if ( $gallery == 1 ) {
							// 1つだけの処理
							$postsGourmet[$randNum]['gallery'][0]['photo'] 		= wp_get_attachment_image_src( $photo, 'full' );
							$postsGourmet[$randNum]['gallery'][0]['caption'] 	= $caption;
						} else {
							// 複数時の処理
							for ( $i = 0; $i < $gallery; $i++ ) {
								$postsGourmet[$randNum]['gallery'][$i]['photo'] 	= wp_get_attachment_image_src( $photo[$i], 'full' );
								$postsGourmet[$randNum]['gallery'][$i]['caption'] 	= $caption[$i];
							}
						}
					} else {
						$postsGourmet[$randNum]['gallery'][0]['photo'] 		= '';
						$postsGourmet[$randNum]['gallery'][0]['caption'] 	= '';
					}

					// メニュー（画像あり）
					// --------------------------------------------------

					// それぞれの変数を格納
					$mName 		= post_custom( 'menu-name' );
					$mPhoto 	= post_custom( 'menu-photo' );
					$mIntro 	= post_custom( 'menu-introduction' );
					$mPrice 	= post_custom( 'menu-price' );
					$mMenu 		= post_custom( 'popular-menu' );
					// グループごとに呼び出す
					if ( !empty ( $mMenu ) ) {
						if ( $mMenu == 1 ) {
							// 1つだけの処理
							$postsGourmet[$randNum]['popular-menu'][0]['name'] 		= $mName;
							$postsGourmet[$randNum]['popular-menu'][0]['photo'] 	= wp_get_attachment_image_src( $mPhoto, 'full' );
							$postsGourmet[$randNum]['popular-menu'][0]['intro'] 	= $mIntro;
							$postsGourmet[$randNum]['popular-menu'][0]['price'] 	= $mPrice;
						} else {
							// 複数時の処理
							for ( $i = 0; $i < $mMenu; $i++ ) {
								$postsGourmet[$randNum]['popular-menu'][$i]['name'] 	= $mName[$i];
								$postsGourmet[$randNum]['popular-menu'][$i]['photo'] 	= wp_get_attachment_image_src( $mPhoto[$i], 'full' );
								$postsGourmet[$randNum]['popular-menu'][$i]['intro'] 	= $mIntro[$i];
								$postsGourmet[$randNum]['popular-menu'][$i]['price'] 	= $mPrice[$i];
							}
						}
					} else {
						$postsGourmet[$randNum]['popular-menu'][0]['name'] 		= '';
						$postsGourmet[$randNum]['popular-menu'][0]['photo'] 	= '';
						$postsGourmet[$randNum]['popular-menu'][0]['intro'] 	= '';
						$postsGourmet[$randNum]['popular-menu'][0]['price'] 	= '';
					}

					// メニュー（画像なし）
					// --------------------------------------------------

					// それぞれの変数を格納
					$oName 		= post_custom( 'other-menu-name' );
					$oPrice 	= post_custom( 'other-menu-price' );
					$oMenu 		= post_custom( 'other-menu' );
					// グループごとに呼び出す
					if ( !empty ( $oMenu ) ) {
						if ( $oMenu == 1 ) {
							// 1つだけの処理
							$postsGourmet[$randNum]['other-menu'][0]['name'] 	= $oName;
							$postsGourmet[$randNum]['other-menu'][0]['price'] 	= $oPrice;
						} else {
							// 複数時の処理
							for ( $i = 0; $i < $oMenu; $i++ ) {
								$postsGourmet[$randNum]['other-menu'][$i]['name'] 	= $oName[$i];
								$postsGourmet[$randNum]['other-menu'][$i]['price'] 	= $oPrice[$i];
							}
						}
					} else {
						$postsGourmet[$randNum]['other-menu'][0]['name'] 	= '';
						$postsGourmet[$randNum]['other-menu'][0]['price'] 	= '';
					}

					// 緯度・経度
					// --------------------------------------------------
					$postsGourmet[$randNum]['lat'] = post_custom( 'lat' );
					$postsGourmet[$randNum]['lng'] = post_custom( 'lng' );

					// クーポン
					// --------------------------------------------------
					$couponName 	= post_custom( 'coupon-name' );
					$couponIntro 	= post_custom( 'coupon-introduction' );
					$couponCon 		= post_custom( 'coupon-condition' );
					$couponAtt 		= post_custom( 'coupon-attention' );
					$couponDay 		= post_custom( 'coupon-day' );
					$coupon 		= post_custom( 'coupon' );
					// グループごとに呼び出す
					if ( !empty ( $coupon ) ) {
						if ( $coupon == 1 ) {
							// 1つだけの処理
							$postsGourmet[$randNum]['coupon'][0]['name'] 	= $couponName;
							$postsGourmet[$randNum]['coupon'][0]['intro'] 	= $couponIntro;
							$postsGourmet[$randNum]['coupon'][0]['con'] 	= $couponCon;
							$postsGourmet[$randNum]['coupon'][0]['att'] 	= $couponAtt;
							$postsGourmet[$randNum]['coupon'][0]['day'] 	= $couponDay;
						} else {
							// 複数時の処理
							for ( $i = 0; $i < $coupon; $i++ ) {
								$postsGourmet[$randNum]['coupon'][$i]['name'] 	= $couponName[$i];
								$postsGourmet[$randNum]['coupon'][$i]['intro'] 	= $couponIntro[$i];
								$postsGourmet[$randNum]['coupon'][$i]['con'] 	= $couponCon[$i];
								$postsGourmet[$randNum]['coupon'][$i]['att'] 	= $couponAtt[$i];
								$postsGourmet[$randNum]['coupon'][$i]['day'] 	= $couponDay[$i];
							}
						}
					} else {
						$postsGourmet[$randNum]['coupon'][0]['name'] 	= '';
						$postsGourmet[$randNum]['coupon'][0]['intro'] 	= '';
						$postsGourmet[$randNum]['coupon'][0]['con'] 	= '';
						$postsGourmet[$randNum]['coupon'][0]['att'] 	= '';
						$postsGourmet[$randNum]['coupon'][0]['day'] 	= '';
					}

					// Facebook・Instagram
					// --------------------------------------------------
					$postsGourmet[$randNum]['link-fb'] = post_custom( 'link-fb' );
					$postsGourmet[$randNum]['link-ig'] = post_custom( 'link-ig' );

				endwhile;
			endif;



		// ==================================================
		// 無料の記事だけを抽出
		// ==================================================
			$args2 = array(
				'post_type' 		=> 'gourmet',
				'post_status' 		=> 'publish',
				'posts_per_page' 	=> -1,
				'meta_key' 			=> 'member-status',
				'meta_value' 		=> '有料',
				'meta_compare' 		=> '!=',
			);
			$query_customer2 = new WP_Query( $args2 );
			if( $query_customer2->have_posts() ):
				while( $query_customer2->have_posts() ) : $query_customer2->the_post();

					// ソート時に使用する乱数（ ランダムの数値を作成 1～5,000 ）・記事ID
					// --------------------------------------------------
					$randNum = 'Z-' . mt_rand( 1, 5000 ) . '-' . get_the_ID();

					// 店名（タイトル）
					// --------------------------------------------------
					$postsGourmet[$randNum]['name'] = get_the_title();

					// パーマリンク
					// --------------------------------------------------
					$postsGourmet[$randNum]['link'] = get_the_permalink();

					// アイキャッチ画像
					// --------------------------------------------------
					if ( has_post_thumbnail() ) {
						$image_id 	= get_post_thumbnail_id ();
						$image_url 	= wp_get_attachment_image_src ($image_id, true);
						$postsGourmet[$randNum]['eyecatch'] = $image_url[0];
					} else {
						$postsGourmet[$randNum]['eyecatch'] = get_template_directory_uri() . '/img/thumbnail.png';
					}

					// ジャンル
					// --------------------------------------------------
					if ( post_custom( 'genre' ) ) {
						if ( is_array( post_custom( 'genre' ) ) ) {
							$postsGourmet[$randNum]['genre'] = post_custom( 'genre' );
						} else {
							$postsGourmet[$randNum]['genre'][0] = post_custom( 'genre' );
						}
					} else {
						$postsGourmet[$randNum]['genre'] = '';
					}

					// エリア
					// --------------------------------------------------
					$areaKagoshima 	= post_custom('area-kagoshima'); 	// 鹿児島市エリア
					$areaAira 		= post_custom('area-aira'); 		// 姶良エリア
					$areaKirishima 	= post_custom('area-kirishima'); 	// 霧島エリア
					$areaHokusatsu 	= post_custom('area-hokusatsu'); 	// 北薩エリア
					$areaNakasatsu 	= post_custom('area-nakasatsu'); 	// 中薩エリア
					$areaNansatsu 	= post_custom('area-nansatsu'); 	// 南薩エリア
					$areaOsumi 		= post_custom('area-osumi'); 		// 大隅エリア
					$areaRito 		= post_custom('area-rito'); 		// 離島エリア
					if ( $areaKagoshima ) {
						if ( is_array ( $areaKagoshima ) ) {
							$postsGourmet[$randNum]['area']['kagoshima'] 	= $areaKagoshima;
						} else {
							$postsGourmet[$randNum]['area']['kagoshima'][0] = $areaKagoshima;
						}
					} else {
						$postsGourmet[$randNum]['area']['kagoshima'] 	= '';
					}
					if ( $areaAira ) {
						if ( is_array ( $areaAira ) ) {
							$postsGourmet[$randNum]['area']['aira'] 		= $areaAira;
						} else {
							$postsGourmet[$randNum]['area']['aira'][0] 		= $areaAira;
						}
					} else {
						$postsGourmet[$randNum]['area']['aira'] 		= '';
					}
					if ( $areaKirishima ) {
						if ( is_array ( $areaKirishima ) ) {
							$postsGourmet[$randNum]['area']['kirishima'] 	= $areaKirishima;
						} else {
							$postsGourmet[$randNum]['area']['kirishima'][0] = $areaKirishima;
						}
					} else {
						$postsGourmet[$randNum]['area']['kirishima'] 	= '';
					}
					if ( $areaHokusatsu ) {
						if ( is_array ( $areaHokusatsu ) ) {
							$postsGourmet[$randNum]['area']['hokusatsu'] 	= $areaHokusatsu;
						} else {
							$postsGourmet[$randNum]['area']['hokusatsu'][0] = $areaHokusatsu;
						}
					} else {
						$postsGourmet[$randNum]['area']['hokusatsu'] 	= '';
					}
					if ( $areaNakasatsu ) {
						if ( is_array ( $areaNakasatsu ) ) {
							$postsGourmet[$randNum]['area']['nakasatsu'] 	= $areaNakasatsu;
						} else {
							$postsGourmet[$randNum]['area']['nakasatsu'][0] = $areaNakasatsu;
						}
					} else {
						$postsGourmet[$randNum]['area']['nakasatsu'] 	= '';
					}
					if ( $areaNansatsu ) {
						if ( is_array ( $areaNansatsu ) ) {
							$postsGourmet[$randNum]['area']['nansatsu'] 	= $areaNansatsu;
						} else {
							$postsGourmet[$randNum]['area']['nansatsu'][0] 	= $areaNansatsu;
						}
					} else {
						$postsGourmet[$randNum]['area']['nansatsu'] 	= '';
					}
					if ( $areaOsumi ) {
						if ( is_array ( $areaOsumi ) ) {
							$postsGourmet[$randNum]['area']['osumi'] 		= $areaOsumi;
						} else {
							$postsGourmet[$randNum]['area']['osumi'][0] 	= $areaOsumi;
						}
					} else {
						$postsGourmet[$randNum]['area']['osumi'] 		= '';
					}
					if ( $areaRito ) {
						if ( is_array ( $areaRito ) ) {
							$postsGourmet[$randNum]['area']['rito'] 		= $areaRito;
						} else {
							$postsGourmet[$randNum]['area']['rito'][0] 		= $areaRito;
						}
					} else {
						$postsGourmet[$randNum]['area']['rito'] 		= '';
					}

					// キーワード
					// --------------------------------------------------
					if ( post_custom( 'keywords' ) ) {
						if ( is_array( post_custom( 'keywords' ) ) ) {
							$postsGourmet[$randNum]['keywords'] = post_custom( 'keywords' );
						} else {
							$postsGourmet[$randNum]['keywords'][0] = post_custom( 'keywords' );
						}
					} else {
						$postsGourmet[$randNum]['keywords'] = '';
					}

					// ふりがな
					// --------------------------------------------------
					$postsGourmet[$randNum]['kana'] = post_custom( 'kana' );

					// 電話番号
					// --------------------------------------------------
					$postsGourmet[$randNum]['tel'] = post_custom( 'tel' );

					// 市町村
					// --------------------------------------------------
					$postsGourmet[$randNum]['city'] = post_custom( 'city' );

					// 市町村以降の住所
					// --------------------------------------------------
					$postsGourmet[$randNum]['address'] = post_custom( 'address' );

					// 駐車場
					// --------------------------------------------------
					$postsGourmet[$randNum]['car'] = post_custom( 'car' );

					// 営業時間
					// --------------------------------------------------
					$postsGourmet[$randNum]['open-last'] = post_custom( 'open-last' );

					// 定休日
					// --------------------------------------------------
					$postsGourmet[$randNum]['holiday'] = post_custom( 'holiday' );

					// 紹介文
					// --------------------------------------------------
					$postsGourmet[$randNum]['introduction'] = post_custom( 'introduction' );

					// クレジットカード
					// --------------------------------------------------
					if ( post_custom( 'credit' ) ) {
						if ( is_array( post_custom( 'credit' ) ) ) {
							$postsGourmet[$randNum]['credit'] = post_custom( 'credit' );
						} else {
							$postsGourmet[$randNum]['credit'][0] = post_custom( 'credit' );
						}
					} else {
						$postsGourmet[$randNum]['credit'] = '';
					}

					// 席数
					// --------------------------------------------------
					$postsGourmet[$randNum]['seat'] = post_custom( 'seat' );

					// 個室
					// --------------------------------------------------
					$postsGourmet[$randNum]['private'] = post_custom( 'private' );

					// 貸切
					// --------------------------------------------------
					$postsGourmet[$randNum]['reserve'] = post_custom( 'reserve' );

					// サービス・チャージ料
					// --------------------------------------------------
					$postsGourmet[$randNum]['charge'] = post_custom( 'charge' );

					// 煙草
					// --------------------------------------------------
					$postsGourmet[$randNum]['tabaco'] = post_custom( 'tabaco' );

					// ホームページ
					// --------------------------------------------------
					$postsGourmet[$randNum]['site'] = post_custom( 'site' );

					// 備考
					// --------------------------------------------------
					$postsGourmet[$randNum]['note'] = post_custom( 'note' );

				endwhile;
			endif;



		// ==================================================
		// 記事の並べ替え
		// ==================================================
		ksort($postsGourmet);



		// ==================================================
		// 記事表示
		// ==================================================

			echo '<div class="row row-10">';

			// ページ送り
			// --------------------------------------------------
			$max	= 3;           									// 1ページに表示する最大数・・・1ページに20件
			$total	= count( $postsGourmet );  						// データの総数を格納する変数
			$limit	= ceil( $total / $max );						// 最大ページ数
			$page	= empty( $_GET["page"] ) ? 1 : $_GET["page"]; 	// ページ番号

			$stNum = ( $page - 1 ) * $max;
			$postsNow = array_slice( $postsGourmet, $stNum, $max ); // 記事を抽出している

			foreach ( $postsNow as $key => $value ) {

				$cntCoupon = 0;

				// 有料会員・無料会員のチェック
				$status = substr( $key, 0, 1 );
				if( $status == 'Z' ) {
					$statusSwitch = 'off';
				} else {
					$statusSwitch = 'on';
				}

				// クーポンの数をカウント
				$cntCoupon = count( $value['coupon'] );

?>


<div class="col-xs-6 col-sm-3">
	<article<?php if( $statusSwitch == 'on' ) echo ' class="pay-mbr"'; ?>>
		<div class="inner height-some">

			<div class="wrap-thumbnail">
				<img src="<?= $value['eyecatch']; ?>" alt="<?= $value['name']; ?>" class="main-img lr-center">
				<?php
					if( $cntCoupon > 0 ) {
						echo '<img src="' . get_template_directory_uri() . '/img/icon-q.png" alt="" class="icon-coupon">';
					}
					if( $statusSwitch == 'on' ) {
						echo '<img src="' . get_template_directory_uri() . '/img/icon-good.png" alt="" class="icon-status">';
					}
				?>
			</div>
			<div class="wrap-name bg-base">
				<h1><?= $value['name']; ?></h1>
			</div>
			<?php if( !empty($value['genre']) ): ?>
				<div class="wrap-tel-adrs bg-base-light">
					<ul class="list-inline">
						<?php
							if( $value['area']['kagoshima'] || is_array($value['area']['kagoshima']) ) {
								echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>鹿児島市エリア</li>';
							}
							if( $value['area']['aira'] || is_array($value['area']['aira']) ) {
								echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>姶良市エリア</li>';
							}
							if( $value['area']['kirishima'] || is_array($value['area']['kirishima']) ) {
								echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>霧島エリア</li>';
							}
							if( $value['area']['hokusatsu'] || is_array($value['area']['hokusatsu']) ) {
								echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>北薩エリア</li>';
							}
							if( $value['area']['nakasatsu'] || is_array($value['area']['nakasatsu']) ) {
								echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>中薩エリア</li>';
							}
							if( $value['area']['nansatsu'] || is_array($value['area']['nansatsu']) ) {
								echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>南薩エリア</li>';
							}
							if( $value['area']['osumi'] || is_array($value['area']['osumi']) ) {
								echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>大隅エリア</li>';
							}
							if( $value['area']['rito'] || is_array($value['area']['rito']) ) {
								echo '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>離島エリア</li>';
							}
						?>
					</ul>
				</div>
			<?php endif ?>
			<?php if( !empty($value['genre']) ): ?>
				<div class="wrap-genre bg-base-light">
					<ul class="list-inline">
						<?php
							foreach ($value['genre'] as $keyGenre => $valueGenre) {
								echo '<li>' . $valueGenre . '</li>';
							}
						?>
					</ul>
				</div>
			<?php endif ?>
			<?php if( !empty($value['keywords']) ): ?>
				<div class="wrap-service bg-base-light">
					<ul class="list-inline">
						<?php
							$i = 0;
							foreach ($value['keywords'] as $keyKeyword => $valueKeyword) {
								$i++;
								if ( $i < 4 ) {
									echo '<li>' . $valueKeyword . '</li>';
								} else {
									echo '<li>etc・・・</li>';
									break;
								}
							}
						?>
					</ul>
				</div>
			<?php endif ?>
			<a href="<?= $value['link']; ?>" class="link-cover"><?= $value['name']; ?></a>
		</div>
	</article>
</div>



<?php
			} // end of foreach

			echo '</div>'; // end of .row .row-10

			// echo '<pre>';
			// echo var_dump( $postsNow );
			// echo '</pre>';

			// ページ送り（functions.php 呼び出し）
			// --------------------------------------------------
			echo '<div class="wrap-pagination text-center"><ul class="pagination">';
			paging( $limit, $page, $max );
			echo '</ul></div>';


		// echo '<pre>';
		// echo var_dump($postsGourmet);
		// echo '</pre>';

	?>
	</div>
	<?php
		// ページナビ
		// --------------------------------------------------
		echo '<div class="pagenavi">';
			posts_nav_link();
		echo '</div>';
		// wp_reset_query();
	?>

</div>

<?php get_footer(); ?>