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
<div class="wrap-recommend">
	<h2 class="text-center"><img src="<?php echo get_template_directory_uri(); ?>/img/title-rec.png" alt="recommend"></h2>
</div>



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
			<div class="col-sm-3">
				<a href="<?php echo home_url() . '/cat_flooring/' . $value->slug; ?>" class="box-items">
					<div class="header"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center"></div>
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
			<div class="col-sm-3">
				<a href="<?php echo home_url() . '/cat_paneling/' . $value->slug; ?>" class="box-items">
					<div class="header"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center"></div>
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
			<div class="col-sm-3">
				<a href="<?php echo home_url() . '/cat_decking/' . $value->slug; ?>" class="box-items">
					<div class="header"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center"></div>
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
			<div class="col-sm-3">
				<a href="<?php echo home_url() . '/cat_other/' . $value->slug; ?>" class="box-items">
					<div class="header"><img src="<?php echo get_template_directory_uri(); ?>/img/items/<?php echo $value->slug; ?>.jpg" alt="<?php echo $value->name; ?>" class="lr-center"></div>
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
<div class="wrap-info-cts">
<h3><span class="first">最新情報</span><span class="second">一覧▶︎</span></h3>
	<?php
	// Information
	?>
	<?php
	// Contents
	?>
<h3><span class="first">コンテンツ</span><span class="second">contents</span></h3>
</div>



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