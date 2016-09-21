<?php get_header(); ?>

<?php // タイトル表示 ?>
<?php get_template_part( 'title' ); ?>

<?php // ページ内容 ?>
<div class="container">
<div class="main">
<?php if(have_posts()): while(have_posts()): the_post(); ?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<div class="inner">
			<h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<p class="wrap-blog-meta"><i class="fa fa-calendar fa-fw"></i><?php the_time('Y年n月j日'); ?></p>
			<?php the_content(); ?>
		</div>
	</article>
<?php endwhile; endif; ?>
<div class="text-center"><?php nofx_wp_pagenavi(); ?></div>
</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>