<?php get_header(); ?>



<?php
//	==================================================
//
//	タイトル表示
//
//	==================================================
?>
<?php get_template_part( 'title' ); ?>



<?php
//	==================================================
//
//	コンテンツ
//
//	==================================================
?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>



<?php
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
$page_type = 'post-page';
if( is_singular( array( 'flooring', 'paneling', 'other', 'decking' ) ) ) {$page_type = 'item-page';} 
?>

<?php if($page_type === 'post-page'): ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<p class="date"><i class="fa fa-calendar fa-fw"></i><?php the_time('Y年n月j日'); ?></p>
		<div class="inner">
			<?php the_content(); ?>
		</div>
	</article>


<?php else: //if($page_type === 'item-page') ?>
<div class="archive">
	<article  id="<?php echo $iNumber; ?>" class="mix<?php if(isset($iStock) and $iStock=='あり') echo ' zaiko'; ?><?php if(isset($iStock) and $iStock!='あり') echo ' no-zaiko'; ?><?php if(strpos($ttl,'床暖用') !== false) echo ' yukadan'; ?> clearfix" data-itemno="<?php echo $iNumber; ?>" data-tanka="<?php echo $iCase; ?>">


		<h1 class="item-title"><?php echo $ttl;?></h1>
		<div class="row">
			<div class="col-sm-4 col-xsxs-12">
			<?php if($image[0]): ?>
					<img src="<?php echo $image[0]; ?>" alt="<?php echo $ttl; ?>" class="lr-center">
			<?php else: ?>
					<img src="<?php echo get_template_directory_uri(); ?>/img/items/default.jpg" alt="<?php echo $ttl; ?>" class="lr-center">
			<?php endif; ?>

<?php if(!is_mobile()): ?>
				<div class="wrap-btn">
					<form action="" method="post" style="display:none;">
						<input type="hidden" name="item_id" value="<?php echo $iNumber; ?>" />
						<input type="hidden" name="item_name" value="<?php echo $ttl;?>" />
						<input type="hidden" name="item_image" value="<?php echo $image[0]; ?>">
						<input type="hidden" name="ticket" value="<?php echo $_SESSION['ticket']; ?>">
						<button  class="btn btn-primary btn-block btn-lg" type='submit' name='sample' val='1'>サンプル請求</button>
					</form>
					<a  class="btn btn-primary btn-block btn-lg" 
					href="<?php echo home_url(); ?>/sample/?item_id=<?php echo $iNumber; ?>
					&item_name=<?php echo $ttl; ?>
					&item_image=<?php echo $image[0]; ?>
					">サンプル請求</a>
					<a  class="btn btn-default btn-block btn-lg" 
					href="<?php echo home_url(); ?>/contact-item/?s1i=<?php echo $iNumber; ?>
					&s1n=<?php echo $ttl; ?>
					"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>この商品についてお問い合わせ</a>
				</div>
<?php endif; ?>

			</div>
			<div class="col-sm-8 col-xsxs-12">
				<table class="table catitem-list">
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
							<th><?php if(is_mobile()): echo "C/Sあたりの<br>入数･重量･平米"; else: echo "1ケースあたりの<br>入数・重量・平米"; endif;?></th>
							<td><?php if(!empty($iCaseU)) echo number_format($iCaseU); ?>枚 <?php if(!empty($iCaseW)) echo number_format($iCaseW); ?>kg <?php if(!empty($iCaseM)) echo number_format($iCaseM); ?>m<sup>2</sup></td>
						</tr>
						<tr>
							<th>在庫</th>
							<td><?php echo $iStock; ?><?php if(!empty($iNote)): ?> <span class="text-danger">※<?php echo $iNote; ?></span><?php endif; ?></td>
						</tr>
						<tr>
							<th>
								<?php 
								if(is_mobile()){ 
									echo "C/S単価"; 
									if(!empty($iMeter)) echo '<br>(&#13217;単価)';
								} else { 
									echo "ケース単価"; 
									if(!empty($iMeter)) echo '(平米単価)';
								}
								?>
							</th>

							<td class="text-danger"><strong><?php if(!empty($iCase)) echo number_format($iCase); ?>円<br class="visible-xs-block" /><?php if(!empty($iMeter)) echo '('.number_format($iMeter).'円)'; ?></strong></td>
						</tr>
					</tbody>
				</table>

			<?php if(is_mobile()): ?>
				<div class="wrap-btn">
					<form action="" method="post" style="display:none;">
						<input type="hidden" name="item_id" value="<?php echo $iNumber; ?>" />
						<input type="hidden" name="item_name" value="<?php echo $ttl;?>" />
						<input type="hidden" name="item_image" value="<?php echo $image[0]; ?>">
						<input type="hidden" name="ticket" value="<?php echo $_SESSION['ticket']; ?>">
						<button  class="btn btn-primary btn-block btn-lg" type='submit' name='sample' val='1'>サンプル請求</button>
					</form>
					<a  class="btn btn-primary btn-block btn-lg" 
					href="<?php echo home_url(); ?>/sample/?item_id=<?php echo $iNumber; ?>
					&item_name=<?php echo $ttl; ?>
					&item_image=<?php echo $image[0]; ?>
					"><i class="fa fa-truck fa-fw" aria-hidden="true"></i>サンプル請求</a>
					<a  class="btn btn-default btn-block btn-lg" 
					href="<?php echo home_url(); ?>/contact-item/?s1i=<?php echo $iNumber; ?>
					&s1n=<?php echo $ttl; ?>
					"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>商品お問い合わせ</a>
				</div>
			<?php endif; ?>

			</div>
		</div>
	</article>
</div><!-- .archive -->
<?php endif; //if($page_type === 'item-page') ?>



<?php endwhile; endif; ?>

<?php if($page_type === 'post-page'): ?>
<div class="single-pager clearfix">
<?php if($_GET['i']): ?>
	<div class="text-center" style="margin-top:20px;">
	<a class="btn btn-default" href="<?php echo $_SERVER['HTTP_REFERER']; ?>#p<?php echo $_GET['i'];?>"><i class="fa fa-arrow-circle-left fa-fw" aria-hidden="true"></i>検索結果に戻る</a>
	</div>
<?php else: ?>
	<div class="pull-left">
		<table><tr><td style="width:20px;"><i class="fa fa-chevron-left" aria-hidden="true"></i></td><td>
	<?php if (get_previous_post()):?>
			<?php previous_post_link('%link', '%title', true); ?>
	<?php else: ?>
	<a href="<?php echo home_url();?>"><i class="fa fa-home" aria-hidden="true"></i></a>
	<?php endif; ?>
		</td></tr></table>
	</div>
	<div class="pull-right">
		<table><tr><td>
	<?php if (get_next_post()):?>
		<?php next_post_link('%link', '%title', true); ?>
	<?php else: ?>
	<a href="<?php echo home_url();?>"><i class="fa fa-home" aria-hidden="true"></i></a>
	<?php endif; ?>
		</td><td style="width:20px;"><i class="fa fa-chevron-right" aria-hidden="true"></i></td></tr></table>
	</div>
<?php endif;?>
</div>

<?php else: ?>
<div class="text-center" style="margin-top:20px;">
<?php 
$burl=$_SERVER['HTTP_REFERER'];
$murl = explode("&", $burl);
?> 
<a class="btn btn-default" href="<?php echo $murl[0]; ?>&i=<?php echo $_GET['i'];?>"><i class="fa fa-arrow-circle-left fa-fw" aria-hidden="true"></i>検索結果に戻る</a>
</div>
<!--
<a href="javascript:history.back();">前のページに戻る</a>
-->
<?php endif; ?>

<?php
//	==================================================
//
//	サンプル請求 & 注文書 & お問い合わせ
//
//	==================================================
?>
<?php get_template_part( 'to-sample' ); //サンプル請求バナー等表示 to-sample.php ?>


</div><!-- end of main -->
<div class="side height-some"><?php get_sidebar(); ?></div>
</div>



<?php get_footer(); ?>