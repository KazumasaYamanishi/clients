<?php get_header(); ?>



<?php
//	==================================================
//
//	各タームの商品一覧
//
//	==================================================
?>
<?php

	$taxonomyName 	= get_query_var( 'taxonomy' ); 									// タクソノミー名を取得
	$termName 		= get_query_var( 'term' ); 										// ターム名を取得
	$termNum 		= get_term_by( 'slug', $termName, $taxonomyName )->term_id; 	// ターム名からタームIDを取得

	$args 	= array(
		'tax_query' => array(
				array(
					'taxonomy' 	=> $taxonomyName,
					'terms' 	=> array( $termNum ),
				),
		),
		'orderby' => 'meta_value',
		'meta_key' => 'i-number',
		'order' => 'ASC',
	);
	$query 	= new WP_Query( $args );
	if ( $query->have_posts() ) :
	while ( $query->have_posts() ) : $query->the_post();

		$iImg 		= SCF::get( 'i-image' );
		$size 		= "full"; // (thumbnail, medium, large, full or custom size)
		$image 		= wp_get_attachment_image_src( $iImg, $size );

		$ttl 		= get_the_title();
		$iNumber 	= SCF::get( 'i-number' );
		$iColor 	= SCF::get( 'i-color' );
		$iDetail 	= SCF::get( 'i-detail' );
		$iGrade 	= SCF::get( 'i-grade' );
		$iPaint 	= SCF::get( 'i-paint' );
		$iSizeD 	= SCF::get( 'i-size-d' );
		$iSizeW 	= SCF::get( 'i-size-w' );
		$iSizeH 	= SCF::get( 'i-size-h' );
		$iCaseU 	= SCF::get( 'i-case-u' );
		$iCaseW 	= SCF::get( 'i-case-w' );
		$iCaseM 	= SCF::get( 'i-case-m' );
		$iCase 		= SCF::get( 'i-case' );
		$iMeter 	= SCF::get( 'i-meter' );
		$iStock 	= SCF::get( 'i-stock' );
		$iNote 		= SCF::get( 'i-note' );
?>



<?php
//	==================================================
//
//	商品の出力
//
//	==================================================
?>
<article>
	<div class="row">
		<div class="col-sm-4">
			<img src="<?php echo $image[0]; ?>" alt="<?php echo $ttl; ?>" class="lr-center">
			<div class="wrap-btn">
				<a href="#" class="btn btn-primary btn-block btn-lg">サンプル請求する</a>
			</div>
		</div>
		<div class="col-sm-8">
			<table class="table">
				<tbody>
					<tr>
						<th>商品番号</th>
						<td><?php echo $iNumber; ?></td>
					</tr>
					<tr>
						<th>グレード</th>
						<td><?php echo $iGrade; ?></td>
					</tr>
					<tr>
						<th>塗装状態</th>
						<td><?php echo $iPaint; ?></td>
					</tr>
					<tr>
						<th>サイズ</th>
						<td>長さ<?php if(!empty($iSizeD)) echo number_format($iSizeD); ?>mm × 巾<?php if(!empty($iSizeW)) echo number_format($iSizeW); ?>mm × 厚さ<?php if(!empty($iSizeH)) echo number_format($iSizeH); ?>mm</td>
					</tr>
					<tr>
						<th>1ケースあたりの入数・重量・平米</th>
						<td><?php if(!empty($iCaseU)) echo number_format($iCaseU); ?>枚 <?php if(!empty($iCaseW)) echo number_format($iCaseW); ?>kg <?php if(!empty($iCaseM)) echo number_format($iCaseM); ?>m<sup>2</sup></td>
					</tr>
					<tr>
						<th>在庫</th>
						<td><?php echo $iStock; ?><?php if(!empty($iNote)): ?> <span class="text-danger">※<?php echo $iNote; ?></span><?php endif; ?></td>
					</tr>
					<tr>
						<th>ケース単価（平米単価）</th>
						<td class="text-danger"><strong><?php if(!empty($iCase)) echo number_format($iCase); ?>円（<?php if(!empty($iMeter)) echo number_format($iMeter); ?>円）</strong></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</article>



<?php
	endwhile;
	endif;
	wp_reset_query();
?>



<?php
//	==================================================
//
//	注文書 & お問い合わせ
//
//	==================================================
?>
<div class="to-sample"><img src="<?php echo get_template_directory_uri(); ?>/img/sample.png" alt="サンプル・送料すべて無料！"></div>
<div class="wrap-info-cts">
	<?php
	// 注文書ダウンロード・FAXでのお申し込み
	?>
	<?php
	// メールお問い合わせ・電話番号
	?>
</div>



</div><!-- end of main -->
<div class="side height-some"><?php get_sidebar(); ?></div>
</div>



<?php get_footer(); ?>