<?php get_header(); ?>


<?php
//	==================================================
//
//	Line Up
// front-pageと同じ 画像が termsスラッグ.jpg
//	==================================================
//カラム数 col-sm-$cols
$cols = 3;

?>
<div class="wrap-lineup">
	<h1 class="text-center">商品一覧</h1>
	<h2 class="text-center">Line Up</h2>
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
			<div class="col-sm-<?php echo $cols;?> col-xsxs-6">
				<a href="<?php echo home_url() . '/cat_flooring/' . $value->slug; ?>" class="box-items">
					<div class="header embed-responsive embed-responsive-50by50"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center embed-responsive-item"></div>
					<h4 class="text-center"><?php echo $value->name; ?></h4>
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
			<div class="col-sm-<?php echo $cols;?> col-xsxs-6">
				<a href="<?php echo home_url() . '/cat_paneling/' . $value->slug; ?>" class="box-items">
					<div class="header  embed-responsive embed-responsive-50by50"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center embed-responsive-item"></div>
					<h4 class="text-center"><?php echo $value->name; ?></h4>
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
			<div class="col-sm-<?php echo $cols;?> col-xsxs-6">
				<a href="<?php echo home_url() . '/cat_decking/' . $value->slug; ?>" class="box-items">
					<div class="header  embed-responsive embed-responsive-50by50"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center embed-responsive-item"></div>
					<h4 class="text-center"><?php echo $value->name; ?></h4>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
	<h3><span class="first">フリー板</span><span class="second">Free</span></h3>
	<div class="row">
		<?php
			// ==============================
			// フリー板
			// ==============================
			$taxonomies = array(
				'cat_free'
			);
			$args = array(
				'get' => 'all'
			);
			$terms = get_terms($taxonomies, $args);
			foreach($terms as $key => $value):
		?>
			<div class="col-sm-<?php echo $cols;?> col-xsxs-6">
				<a href="<?php echo home_url() . '/cat_free/' . $value->slug; ?>" class="box-items">
					<div class="header  embed-responsive embed-responsive-50by50"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center embed-responsive-item"></div>
					<h4 class="text-center"><?php echo $value->name; ?></h4>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
	<h3><span class="first">框・踏板・巾木</span><span class="second">Free</span></h3>
	<div class="row">
		<?php
			// ==============================
			// 框・踏板・巾木
			// ==============================
			$taxonomies = array(
				'cat_frame'
			);
			$args = array(
				'get' => 'all'
			);
			$terms = get_terms($taxonomies, $args);
			foreach($terms as $key => $value):
		?>
			<div class="col-sm-<?php echo $cols;?> col-xsxs-6">
				<a href="<?php echo home_url() . '/cat_frame/' . $value->slug; ?>" class="box-items">
					<div class="header  embed-responsive embed-responsive-50by50"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center embed-responsive-item"></div>
					<h4 class="text-center"><?php echo $value->name; ?></h4>
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
			<div class="col-sm-<?php echo $cols;?> col-xsxs-6">
				<a href="<?php echo home_url() . '/cat_other/' . $value->slug; ?>" class="box-items">
					<div class="header  embed-responsive embed-responsive-50by50"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center embed-responsive-item"></div>
					<h4 class="text-center"><?php echo $value->name; ?></h4>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
	<h3><span class="first">ファニチャー</span><span class="second">Other</span></h3>
	<div class="row">
		<?php
			// ==============================
			// ファニチャー
			// ==============================
			$taxonomies = array(
				'cat_furniture'
			);
			$args = array(
				'get' => 'all'
			);
			$terms = get_terms($taxonomies, $args);
			foreach($terms as $key => $value):
		?>
			<div class="col-sm-<?php echo $cols;?> col-xsxs-6">
				<a href="<?php echo home_url() . '/cat_furniture/' . $value->slug; ?>" class="box-items">
					<div class="header  embed-responsive embed-responsive-50by50"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center embed-responsive-item"></div>
					<h4 class="text-center"><?php echo $value->name; ?></h4>
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

<?php
//	==================================================
//
//	サンプル請求 & 注文書 & お問い合わせ
//
//	==================================================
?>
<div class="to-sample"><a href="<?php echo home_url(); ?>/sample"><img src="<?php echo get_template_directory_uri(); ?>/img/sample.png" alt="サンプル・送料すべて無料！"></a></div>
<div class="wrap-info-cts">

<div class="row">
<div class="col-sm-6"><img src="<?php echo get_template_directory_uri(); ?>/img/bnr-dl-footer.png" alt="注文書ダウンロード"></div>
<div class="col-sm-6"><img src="<?php echo get_template_directory_uri(); ?>/img/bnr-mail-footer.png" alt="メールお問い合わせ"></div>
</div>

<div class="row mt16">
<div class="col-sm-6"><img src="<?php echo get_template_directory_uri(); ?>/img/btn-fax-footer.png" alt="FAX注文"></div>
<div class="col-sm-6"><img src="<?php echo get_template_directory_uri(); ?>/img/bnr-tel-footer.png" alt="電話受付"></div>
</div>

</div>



</div><!-- end of main -->
<div class="side height-some"><?php get_sidebar(); ?></div>
</div>



<?php get_footer(); ?>