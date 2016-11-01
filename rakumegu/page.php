<?php get_header(); ?>

<?php // タイトル表示 ?>
<?php get_template_part( 'title' ); ?>
<?php // ページ内容 ?>
<?php // <div class="container"> ?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<div class="inner">
<section class="container">
			<?php the_content(); ?>
</section>
		</div>
	</article>
<?php endwhile; endif; ?>
<?php // </div> ?>

<?php // サンプルタイトルスタイル  ?>
<style>
#test-page .page-title .title {
	margin: 44px auto;
	text-indent: -9999em;
	background: url(<?php echo get_template_directory_uri(); ?>/img/ttl-sample.png) center no-repeat;
	width: 320px;
	height: 126px;
}
</style>
<?php get_footer(); ?>