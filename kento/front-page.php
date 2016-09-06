<?php get_header(); ?>





<?php // 記事一覧 ?>
<div class="container">
	<h2 class="text-center text-primary">インフォメーション</h2>
	<?php
		$num = 6;
		query_posts('posts_per_page='.$num);
		if ( have_posts() ) :
			echo '<div class="row">';
			while ( have_posts() ) : the_post();
				$pLink = get_the_permalink();
				$time = get_the_time('Y.n.j');
				$title = get_the_title();
				$cat_info = apt_category_info();
				$cat_slug = esc_attr($cat_info->slug);
				$cat_name = esc_html($cat_info->name);
				$theme_url = get_template_directory_uri();
				if(has_post_thumbnail()) {
					$thumbnail_id = get_post_thumbnail_id($post->ID);
					$src_info = wp_get_attachment_image_src($thumbnail_id, 'full');
					$src = $src_info[0];
				} else {
					$src = $theme_url . '/img/dammy.png';
				}
				echo '<div class="col-sm-4"><div class="card"><a href="' . $pLink . '"><div class="wrap-card-img"><img src="' . $src . '" alt=""></div><div class="card-inner"><p class="card-ribon card-' . $cat_slug . '">' . $cat_name . '</p><h4 class="title">' . $title . '</h4><p class="date">' . $time . '</p></div></a></div></div>';
			endwhile;
			echo '</div>';
		else :
			echo '<p>現在、記事はありません。</p>';
		endif;
		wp_reset_query();
	?>
	<div class="text-center"><a href="<?php echo get_permalink(get_page_by_path('news')); ?>" class="btn btn-ghost btn-primary btn-lg btn-block round">最新情報一覧</a></div>
</div>



<?php get_footer(); ?>