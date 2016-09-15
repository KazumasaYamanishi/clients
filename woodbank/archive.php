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
		<h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<p class="date"><i class="fa fa-calendar fa-fw"></i><?php the_time('Y年n月j日'); ?></p>
		<div class="inner">
			<?php the_content(); ?>
			bbbb
		</div>
	</article>
<?php endwhile; endif; ?>
<div class="text-center"><?php nofx_wp_pagenavi(); ?></div>



<?php
//	==================================================
//
//	サンプル請求 & 注文書 & お問い合わせ
//
//	==================================================
?>
<div class="to-sample"><a href="<?php echo home_url(); ?>/sample"><img src="<?php echo get_template_directory_uri(); ?>/img/sample.png" alt="サンプル・送料すべて無料！"></a></div>
<div class="wrap-info-cts">
	<div><img src="<?php echo get_template_directory_uri(); ?>/img/bnr-dl-footer.png" alt="注文書ダウンロード"></div>
<div><img src="<?php echo get_template_directory_uri(); ?>/img/bnr-dl-footer.png" alt="メールお問い合わせ"></div>
	

	
</div>



</div><!-- end of main -->
<div class="side height-some"><?php get_sidebar(); ?></div>
</div>



<?php get_footer(); ?>