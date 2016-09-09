<?php get_header(); ?>



<?php // タイトル表示 ?>
<?php get_template_part( 'title' ); ?>



<?php // コンテンツ ?>

<div class="container">
<div class="row">



<div class="main col-sm-9">
	<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<div class="inner"><?php the_content(); ?></div>
		</article>
	<?php endwhile; endif; ?>
</div>



<?php get_sidebar(); ?>



</div>
</div>



<?php get_footer(); ?>