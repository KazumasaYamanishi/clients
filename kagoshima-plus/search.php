<?php get_header(); ?>

<?php
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );
?>

<div class="container">

<?php
	$arySH = $_GET;
	// echo '<pre>';
	// echo var_dump($arySH);
	// echo '</pre>';
	// post_type を取得
	$postType = $arySH['post_type'];
	// カスタム投稿タイプ別に処理する
	if ( $postType === 'gourmet' ) {
		// ジャンル、エリア、キーワードの配列に値が入っているか
		$existGenre 	= count($arySH['cftsearch']['genre']);
		$existKagoshima = count($arySH['cftsearch']['area-kagoshima']);
		$existAira 		= count($arySH['cftsearch']['area-aira']);
		$existKirishima = count($arySH['cftsearch']['area-kirishima']);
		$existHokusatsu = count($arySH['cftsearch']['area-hokusatsu']);
		$existNakasatsu = count($arySH['cftsearch']['area-nakasatsu']);
		$existNansatsu 	= count($arySH['cftsearch']['area-nansatsu']);
		$existOsumi 	= count($arySH['cftsearch']['area-osumi']);
		$existRito 		= count($arySH['cftsearch']['area-rito']);
		$existKeywords 	= count($arySH['cftsearch']['keywords']);
		// エリアを1つの配列にまとめる
		$areaSearchArea = array();
		if ( $existKagoshima > 0 ) {
			foreach ( $arySH['cftsearch']['area-kagoshima'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existAira > 0 ) {
			foreach ( $arySH['cftsearch']['area-aira'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existKirishima > 0 ) {
			foreach ( $arySH['cftsearch']['area-kirishima'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existHokusatsu > 0 ) {
			foreach ( $arySH['cftsearch']['area-hokusatsu'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existNakasatsu > 0 ) {
			foreach ( $arySH['cftsearch']['area-nakasatsu'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existNansatsu > 0 ) {
			foreach ( $arySH['cftsearch']['area-nansatsu'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existOsumi > 0 ) {
			foreach ( $arySH['cftsearch']['area-osumi'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existRito > 0 ) {
			foreach ( $arySH['cftsearch']['area-rito'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		$existSearchArea 	= count($areaSearchArea);
?>
	<div class="search-meta">
		<dl>
			<dt>ジャンル</dt>
			<dd>
				<?php
					if ( $existGenre > 0 ) {
						echo '<ul class="list-inline">';
						foreach ( $arySH['cftsearch']['genre'] as $value1 ) {
							foreach ( $value1 as $value2 ) {
								echo '<li>' . $value2 . '</li>';
								$args_value[0] = array(
									'key'	 	=> 'genre',
									'value'	  	=> $value2,
									'compare' 	=> '='
								);
							}
						}
						echo '</ul>';
					} else {
						echo 'なし';
					}
				?>
			</dd>
		</dl>
		<dl>
			<dt>エリア</dt>
			<dd>
				<?php
					if ( $existSearchArea > 0 ) {
						echo '<ul class="list-inline">';
						foreach ( $areaSearchArea as $key => $value ) {
							echo '<li>' . $value . '</li>';
							$args_value[1][] = array(
								'key'	 	=> $key,
								'value'	  	=> $value,
								'compare' 	=> '='
							);
						}
						echo '</ul>';
					} else {
						echo 'なし';
					}
				?>
			</dd>
		</dl>
		<dl>
			<dt>キーワード</dt>
			<dd>
				<?php
					if ( $existKeywords > 0 ) {
						echo '<ul class="list-inline">';
						foreach ( $arySH['cftsearch']['keywords'] as $value1 ) {
							foreach ( $value1 as $key => $value2 ) {
								echo '<li>' . $value2 . '</li>';
								$args_value[2][] = array(
									'key'	 	=> $key,
									'value'	  	=> $value2,
									'compare' 	=> '='
								);
							}
						}
						echo '</ul>';
					} else {
						echo 'なし';
					}
				?>
			</dd>
		</dl>
	</div>
	<div id="extra-area">
	<div class="row row-10">
<?php
	$args = array(
		'post_type' => 'gourmet',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
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
		// *** 会員ステータス
		$memberStatus 	= post_custom('member-status');
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
					$areaKagoshima 	= post_custom('area-kagoshima'); 	// 鹿児島市エリア
					$areaAira 		= post_custom('area-aira'); 		// 姶良市エリア
					$areaKirishima 	= post_custom('area-kirishima'); 	// 霧島エリア
					$areaHokusatsu 	= post_custom('area-hokusatsu'); 	// 北薩エリア
					$areaNakasatsu 	= post_custom('area-nakasatsu'); 	// 中薩エリア
					$areaNansatsu 	= post_custom('area-nansatsu'); 	// 南薩エリア
					$areaOsumi 		= post_custom('area-osumi'); 		// 大隅エリア
					$areaRito 		= post_custom('area-rito'); 		// 離島エリア
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
					$genre = post_custom('genre');
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

					// キーワード
					// --------------------------------------------------
					$keywords = post_custom('keywords');
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


<!-- <h4>■<?php the_title(); ?></h4>
<div class="alert alert-info">
	<small>
		<?php
			$custom_fields = get_post_custom($post_id);
			echo 'ジャンル=[ / ';
			foreach($custom_fields['genre'] as $value){
				echo $value  ." / " ;
			}
			echo ']<br>';
			echo 'エリア=[ / ';
			foreach($custom_fields['area-kagoshima'] as $value){echo $value  ." / " ;}
			foreach($custom_fields['area-aira'] as $value){echo $value  ." / " ;}
			foreach($custom_fields['area-kirishima'] as $value){echo $value  ." / " ;}
			foreach($custom_fields['area-hokusatsu'] as $value){echo $value  ." / " ;}
			foreach($custom_fields['area-nakasatsu'] as $value){echo $value  ." / " ;}
			foreach($custom_fields['area-nansatsu'] as $value){echo $value  ." / " ;}
			foreach($custom_fields['area-osumi'] as $value){echo $value  ." / " ;}
			foreach($custom_fields['area-rito'] as $value){echo $value  ." / " ;}
			echo ']<br>';
			echo 'キーワード=[ / ';
			foreach($custom_fields['keywords'] as $value){
				echo $value  ." / " ;
			}
			echo ']<br>';
		?>
	</small>
</div> -->

<?php
	endwhile;
	else:
		echo '<div class="extra-error alert alert-danger">お探しの記事が見つかりませんでした。</div>';
	endif;
?>
	</div><!-- end of .row.row-10 -->
	</div><!-- end of #extra-area -->


		<div class="pagenavi">
			<?php
				// ページナビ
				posts_nav_link();
			?>
		</div>


<?php
		wp_reset_query();
	// if ( $postType === 'gourmet' ) の締めカッコ
	} elseif( $postType === 'beauty' ) {
		// ジャンル、エリア、キーワードの配列に値が入っているか
		$existGenre 	= count($arySH['cftsearch']['genre-beauty']);
		$existKagoshima = count($arySH['cftsearch']['area-kagoshima-beauty']);
		$existAira 		= count($arySH['cftsearch']['area-aira-beauty']);
		$existKirishima = count($arySH['cftsearch']['area-kirishima-beauty']);
		$existHokusatsu = count($arySH['cftsearch']['area-hokusatsu-beauty']);
		$existNakasatsu = count($arySH['cftsearch']['area-nakasatsu-beauty']);
		$existNansatsu 	= count($arySH['cftsearch']['area-nansatsu-beauty']);
		$existOsumi 	= count($arySH['cftsearch']['area-osumi-beauty']);
		$existRito 		= count($arySH['cftsearch']['area-rito-beauty']);
		$existKeywords 	= count($arySH['cftsearch']['keywords-beauty']);
		// エリアを1つの配列にまとめる
		$areaSearchArea = array();
		if ( $existKagoshima > 0 ) {
			foreach ( $arySH['cftsearch']['area-kagoshima-beauty'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existAira > 0 ) {
			foreach ( $arySH['cftsearch']['area-aira-beauty'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existKirishima > 0 ) {
			foreach ( $arySH['cftsearch']['area-kirishima-beauty'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existHokusatsu > 0 ) {
			foreach ( $arySH['cftsearch']['area-hokusatsu-beauty'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existNakasatsu > 0 ) {
			foreach ( $arySH['cftsearch']['area-nakasatsu-beauty'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existNansatsu > 0 ) {
			foreach ( $arySH['cftsearch']['area-nansatsu-beauty'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existOsumi > 0 ) {
			foreach ( $arySH['cftsearch']['area-osumi-beauty'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existRito > 0 ) {
			foreach ( $arySH['cftsearch']['area-rito-beauty'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		$existSearchArea 	= count($areaSearchArea);
?>
	<div class="search-meta">
		<dl>
			<dt>ジャンル</dt>
			<dd>
				<?php
					if ( $existGenre > 0 ) {
						echo '<ul class="list-inline">';
						foreach ( $arySH['cftsearch']['genre-beauty'] as $value1 ) {
							foreach ( $value1 as $value2 ) {
								echo '<li>' . $value2 . '</li>';
								$args_value[0] = array(
									'key'	 	=> 'genre',
									'value'	  	=> $value2,
									'compare' 	=> '='
								);
							}
						}
						echo '</ul>';
					} else {
						echo 'なし';
					}
				?>
			</dd>
		</dl>
		<dl>
			<dt>エリア</dt>
			<dd>
				<?php
					if ( $existSearchArea > 0 ) {
						echo '<ul class="list-inline">';
						foreach ( $areaSearchArea as $key => $value ) {
							echo '<li>' . $value . '</li>';
							$args_value[1][] = array(
								'key'	 	=> $key,
								'value'	  	=> $value,
								'compare' 	=> '='
							);
						}
						echo '</ul>';
					} else {
						echo 'なし';
					}
				?>
			</dd>
		</dl>
	</div>
	<div id="extra-area">
	<div class="row row-10">
<?php
	$args = array(
		'post_type' => 'beauty',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
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
	else:
		echo '<div class="extra-error alert alert-danger">お探しの記事が見つかりませんでした。</div>';
	endif;
?>
	</div><!-- end of .row.row-10 -->
	</div><!-- end of #extra-area -->
<?php
		wp_reset_query();
	// elseif ( $postType === 'beauty' ) の締めカッコ
	} elseif( $postType === 'hotsprings' ) {
		// ジャンル、エリア、キーワードの配列に値が入っているか
		$existKirishima = count($arySH['cftsearch']['area-kirishima-hotsprings']);
		$existNakasatsu = count($arySH['cftsearch']['area-nakasatsu-hotsprings']);
		$existKagoshima = count($arySH['cftsearch']['area-kagoshima-hotsprings']);
		$existOsumi 	= count($arySH['cftsearch']['area-osumi-hotsprings']);
		$existIbusuki 	= count($arySH['cftsearch']['area-ibusuki-hotsprings']);
		$existNansatsu 	= count($arySH['cftsearch']['area-nansatsu-hotsprings']);
		$existSatsuma 	= count($arySH['cftsearch']['area-satsuma-hotsprings']);
		$existRito 		= count($arySH['cftsearch']['area-rito-hotsprings']);
		$existKeywords 	= count($arySH['cftsearch']['keywords-hotsprings']);
		// エリアを1つの配列にまとめる
		$areaSearchArea = array();
		if ( $existKirishima > 0 ) {
			foreach ( $arySH['cftsearch']['area-kirishima-hotsprings'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existNakasatsu > 0 ) {
			foreach ( $arySH['cftsearch']['area-nakasatsu-hotsprings'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existKagoshima > 0 ) {
			foreach ( $arySH['cftsearch']['area-kagoshima-hotsprings'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existOsumi > 0 ) {
			foreach ( $arySH['cftsearch']['area-osumi-hotsprings'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existIbusuki > 0 ) {
			foreach ( $arySH['cftsearch']['area-ibusuki-hotsprings'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existNansatsu > 0 ) {
			foreach ( $arySH['cftsearch']['area-nansatsu-hotsprings'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existSatsuma > 0 ) {
			foreach ( $arySH['cftsearch']['area-satsuma-hotsprings'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		if ( $existRito > 0 ) {
			foreach ( $arySH['cftsearch']['area-rito-hotsprings'] as $value1 ) {
				foreach ( $value1 as $value2 ) {
					array_push( $areaSearchArea, $value2 );
				}
			}
		}
		$existSearchArea 	= count($areaSearchArea);
?>
	<div class="search-meta">
		<dl>
			<dt>エリア</dt>
			<dd>
				<?php
					if ( $existSearchArea > 0 ) {
						echo '<ul class="list-inline">';
						foreach ( $areaSearchArea as $key => $value ) {
							echo '<li>' . $value . '</li>';
							$args_value[1][] = array(
								'key'	 	=> $key,
								'value'	  	=> $value,
								'compare' 	=> '='
							);
						}
						echo '</ul>';
					} else {
						echo 'なし';
					}
				?>
			</dd>
		</dl>
		<dl>
			<dt>キーワード</dt>
			<dd>
				<?php
					if ( $existKeywords > 0 ) {
						echo '<ul class="list-inline">';
						foreach ( $arySH['cftsearch']['keywords-hotsprings'] as $value1 ) {
							foreach ( $value1 as $value2 ) {
								echo '<li>' . $value2 . '</li>';
								$args_value[0] = array(
									'key'	 	=> 'keywords-hotsprings',
									'value'	  	=> $value2,
									'compare' 	=> '='
								);
							}
						}
						echo '</ul>';
					} else {
						echo 'なし';
					}
				?>
			</dd>
		</dl>
	</div>
	<div id="extra-area">
	<div class="row row-10">
<?php
	$args = array(
		'post_type' => 'hotsprings',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
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
	else:
		echo '<div class="extra-error alert alert-danger">お探しの記事が見つかりませんでした。</div>';
	endif;
?>
	</div><!-- end of .row.row-10 -->
	</div><!-- end of #extra-area -->
<?php
		wp_reset_query();
	// elseif ( $postType === 'hotsprings' ) の締めカッコ
	}
?>

</div>

<?php get_footer(); ?>