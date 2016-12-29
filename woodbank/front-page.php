<?php get_header(); ?>




<?php
//	==================================================
//
//	メインコピー
//
//	==================================================
?>
<div class="main-img"><img src="<?php echo get_template_directory_uri(); ?>/img/home-main.png" alt="WOOD BANK ウッドバンク"></div>
<div class="to-sample"><a href="<?php echo home_url(); ?>/sample"><img src="<?php echo get_template_directory_uri(); ?>/img/sample.png" alt="サンプル・送料すべて無料！"></a></div>



<?php
//	==================================================
//
//	Recommend
//
//	==================================================
?>
<!--
<div class="wrap-recommend">
	<h2 class="text-center"><img src="<?php //echo get_template_directory_uri(); ?>/img/title-rec.png" alt="recommend"></h2>
</div>
-->
<?php
//	==================================================
//
//	Line Up
//
//	==================================================
?>
<div class="wrap-lineup">
	<h2 class="text-center"><img src="<?php echo get_template_directory_uri(); ?>/img/title-lineup.png" alt="recommend"></h2>
	<h3><span class="first">フローリング</span><span class="second">Flooring</span></h3>
	<div class="row">
		<?php
			// ==============================
			// フローリング
			// ==============================
			$taxonomies = array(
				'cat_flooring'
			);
			$args = array(
				'get' => 'all'
			);
			$terms = get_terms($taxonomies, $args);
			foreach($terms as $key => $value):
		?>
			<div class="col-md-3 col-sm-3 col-xsxs-6">
				<a href="<?php echo home_url() . '/cat_flooring/' . $value->slug; ?>" class="box-items">
					<div class="header  embed-responsive embed-responsive-50by50"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center embed-responsive-item"></div>
<?php 
$item_name = $value->name;
$item_name= str_replace("(", "<small>(", $item_name);
$item_name= str_replace(")", ")</small>", $item_name);
$item_name= str_replace("（", "<small>（", $item_name);
$item_name= str_replace("）", "）</small>", $item_name);
?>
					<h4 class="text-center"><?php echo $item_name; ?></h4>
				</a>
				<?php // echo var_dump($value); ?>
			</div>
		<?php endforeach; ?>
	</div>
	<h3><span class="first">羽目板</span><span class="second">Paneling</span></h3>
	<div class="row">
		<?php
			// ==============================
			// 羽目板
			// ==============================
			$taxonomies = array(
				'cat_paneling'
			);
			$args = array(
				'get' => 'all'
			);
			$terms = get_terms($taxonomies, $args);
			foreach($terms as $key => $value):
		?>
			<div class="col-md-3 col-sm-3 col-xsxs-6">
				<a href="<?php echo home_url() . '/cat_paneling/' . $value->slug; ?>" class="box-items">
					<div class="header  embed-responsive embed-responsive-50by50"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center embed-responsive-item"></div>
<?php 
$item_name = $value->name;
$item_name= str_replace("(", "<small>(", $item_name);
$item_name= str_replace(")", ")</small>", $item_name);
$item_name= str_replace("（", "<small>（", $item_name);
$item_name= str_replace("）", "）</small>", $item_name);
?>
					<h4 class="text-center"><?php echo $item_name; ?></h4>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
	<h3><span class="first">デッキ材</span><span class="second">Decking</span></h3>
	<div class="row">
		<?php
			// ==============================
			// デッキ材
			// ==============================
			$taxonomies = array(
				'cat_decking'
			);
			$args = array(
				'get' => 'all'
			);
			$terms = get_terms($taxonomies, $args);
			foreach($terms as $key => $value):
		?>
			<div class="col-md-3 col-sm-3 col-xsxs-6">
				<a href="<?php echo home_url() . '/cat_decking/' . $value->slug; ?>" class="box-items">
					<div class="header  embed-responsive embed-responsive-50by50"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center embed-responsive-item"></div>
<?php 
$item_name = $value->name;
$item_name= str_replace("(", "<small>(", $item_name);
$item_name= str_replace(")", ")</small>", $item_name);
$item_name= str_replace("（", "<small>（", $item_name);
$item_name= str_replace("）", "）</small>", $item_name);
?>
					<h4 class="text-center"><?php echo $item_name; ?></h4>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
	<h3><span class="first">その他</span><span class="second">Other</span></h3>
	<div class="row">
		<?php
			// ==============================
			// その他
			// ==============================
			$taxonomies = array(
				'cat_other'
			);
			$args = array(
				'get' => 'all'
			);
			$terms = get_terms($taxonomies, $args);
			foreach($terms as $key => $value):
		?>
			<div class="col-md-3 col-sm-3 col-xsxs-6">
				<a href="<?php echo home_url() . '/cat_other/' . $value->slug; ?>" class="box-items">
					<div class="header  embed-responsive embed-responsive-50by50"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center embed-responsive-item"></div>
<?php 
$item_name = $value->name;
$item_name= str_replace("(", "<small>(", $item_name);
$item_name= str_replace(")", ")</small>", $item_name);
$item_name= str_replace("（", "<small>（", $item_name);
$item_name= str_replace("）", "）</small>", $item_name);
?>
					<h4 class="text-center"><?php echo $item_name; ?></h4>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>



<?php
//	==================================================
//
//	Information & Contents
//
//	==================================================
?>
<div class="row">
	<div class="col-sm-8 col-sm-push-2">
<div class="wrap-info-cts">
<h2 class="text-center"><img src="<?php echo get_template_directory_uri(); ?>/img/top-info-title.png" alt="information"></h2>
	<?php
	// Information
	?>
	<?php
	// Contents
	?>

<dl class="dl-horizontal">
<?php
   $newslist = get_posts( array(
    'category_name' => 'new , info', //特定のカテゴリースラッグを指定
    'posts_per_page' => 10 //取得記事件数
  ));
    foreach( $newslist as $post ):
    setup_postdata( $post );

	$category = get_the_category();
	$cat_id   = $category[0]->cat_ID;
	$cat_name = $category[0]->cat_name;
?>
<dt><?php the_time('Y.m.d'); ?><span><?php echo $cat_name; ?></span></dt>
<dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </dd>
<?php
  endforeach;
  wp_reset_postdata();
?>
</dl> 

</div>
</div>
</div>

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
</div><!-- .container main-container -->




<?php get_footer(); ?>