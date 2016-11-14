<?php get_header(); ?>

<?php
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );

	if(have_posts()): while(have_posts()):the_post();

?>
<div class="container">
	<article>
		<div class="inner">

			<h1 class="title"><?php the_title(); ?></h1>
			<div class="wrap-contents">
				<?php the_content(); ?>
			</div>

		</div>
	</article>
</div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>