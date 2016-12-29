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
				if(is_page('complete')) {
					get_template_part( 'sample-complete' );
				}

			?>
			<?php the_content(); ?>
		</div>
	</article>

<?php if($_GET['i']): ?>
	<div class="text-center" style="margin-top:20px;">
	<a class="btn btn-default" href="<?php echo $_SERVER['HTTP_REFERER']; ?>#p<?php echo $_GET['i'];?>"><i class="fa fa-arrow-circle-left fa-fw" aria-hidden="true"></i>検索結果に戻る</a>
	</div>
<?php endif; ?>

<?php endwhile; endif; ?>



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