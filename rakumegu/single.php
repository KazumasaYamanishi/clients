<?php get_header(); ?>

<?php // タイトル表示 ?>
<?php get_template_part( 'title' ); ?>

<div class="container">
	<div class="row">
		<div class="main col-sm-9">
			<?php // 記事内容 ?>
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
				<div class="box bg-red">
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<h1 class="title"><?php the_title(); ?></h1>
					<p class="date"><i class="fa fa-calendar fa-fw"></i><?php the_time('Y年n月j日'); ?></p>
					<div class="inner">
						<?php the_content(); ?>
					</div>
				</article>
				</div>
			<?php endwhile; endif; ?>
			<ul class="pager">
				<li class="previous"><?php previous_post_link('%link', '<i class="fa fa-chevron-left fa-fw"></i>',true); ?></li>
				<li class="next"><?php next_post_link('%link', '<i class="fa fa-chevron-right fa-fw"></i>',true); ?></li>
			</ul>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>