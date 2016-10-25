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
		</div>
	</article>
<?php endwhile; endif; ?>
<div class="single-pager clearfix">
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
</div>



<?php get_footer(); ?>