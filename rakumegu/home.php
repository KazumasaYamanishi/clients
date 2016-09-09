<?php get_header(); ?>

<?php // タイトル表示 ?>
<?php get_template_part( 'title' ); ?>

<div class="container">
	<div class="row">
		<div class="main col-sm-9">
			<?php // 記事内容 ?>
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<p class="date"><i class="fa fa-calendar fa-fw"></i><?php the_time('Y年n月j日'); ?></p>
					<div class="inner">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; endif; ?>
			<div class="text-center"><?php nofx_wp_pagenavi(); ?></div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>