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
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<div class="inner">
			<?php
			//
			// サンプル請求ページの場合
			//
			?>
			<?php
				if(is_page('sample')) {
					get_template_part( 'sample' );
				}
			?>
			<?php the_content(); ?>
		</div>
	</article>
<?php endwhile; endif; ?>



<?php
//	==================================================
//
//	サンプル請求 & 注文書 & お問い合わせ
//
//	==================================================
?>
<div class="to-sample"><a href="<?php echo home_url(); ?>/sample"><img src="<?php echo get_template_directory_uri(); ?>/img/sample.png" alt="サンプル・送料すべて無料！"></a></div>
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