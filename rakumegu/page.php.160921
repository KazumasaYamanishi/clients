<?php get_header(); ?>



<?php
	//
	//	タイトル表示
	//	==================================================
	get_template_part( 'title' );



	//
	//	コンテンツ
	//	==================================================
?>
<div class="container">
	<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<div class="inner"><?php the_content(); ?></div>
		</article>
	<?php endwhile; endif; ?>
</div>



<?php get_footer(); ?>