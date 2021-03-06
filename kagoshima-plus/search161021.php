<?php get_header(); ?>

<?php
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );
?>

<div class="container">



<?php
	$arySH = $_GET;
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

		// echo '<pre>';
		// echo var_dump($arySH);
		// echo '</pre>';

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



<?php
	// ジャンル、エリア、キーワードはAND
	// $args_value['relation'] 	= 'AND';
	// $args_value[0]['relation'] 	= 'OR'; // ジャンル
	// $args_value[1]['relation'] 	= 'OR'; // エリア
	// $args_value[2]['relation'] 	= 'OR'; // キーワード
	// それぞれの中身はOR
	// if ( $postType === 'gourmet' ) の締めカッコ
	}
?>



<?php

	// $test =array(
	// 	'p' => 187,
	// );
	// $test_query = new WP_Query( $test );
	// if ( $test_query->have_posts() ) :
	// while ( $test_query->have_posts() ) : $test_query->the_post();
	// 	echo the_title();
	// 	echo '<pre>';
	// 	echo var_dump($test_query);
	// 	echo '</pre>';
	// endwhile;
	// else:
	// 	echo '<h4>お探しのテスト記事はありませんでした。</h4>';
	// endif;
	// echo '<pre>';
	// echo var_dump($args_value);
	// echo '</pre>';
	$args = array(
		'post_type' => 'gourmet',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'meta_query' 	=> array(
			// 'relation' => 'AND',
			// array(
				// 'relation' => 'OR',
				// array(
				// 	'key' => 'genre',
				// 	'value' => '洋食',
				// ),
				// array(
					'key' => 'genre',
					'value' => '洋食',
				// ),
			// ),
			// array(
			// 	// 'relation' => 'OR',
			// 	array(
			// 		'key' => 'area-hokusatsu',
			// 		'value' => '出水市',
			// 	),
			// ),
			// array(
			// 	// 'relation' => 'OR',
			// 	array(
			// 		'key' => 'keywords',
			// 		'value' => 'クーポン付き',
			// 	),
			// ),
		),
	);
	// echo '<pre>';
	// echo var_dump($args);
	// echo '</pre>';
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>


		<h4><?php the_title(); ?></h4>


<?php
	endwhile;
	else:
		echo '<h4>お探しの記事はありませんでした。</h4>';
	endif;
?>


		<div class="pagenavi">
			<?php
				// ページナビ
				posts_nav_link();
			?>
		</div>


<?php wp_reset_query(); ?>

</div>

<?php get_footer(); ?>