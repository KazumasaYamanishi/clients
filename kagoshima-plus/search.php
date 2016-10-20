<?php get_header(); ?>

<?php
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );
?>

<div class="container">
	<?php if(have_posts()): while(have_posts()):the_post(); ?>

		<?php the_content(); ?>

	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>