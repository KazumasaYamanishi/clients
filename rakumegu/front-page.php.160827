<?php get_header(); ?>



<?php
//	==================================================
//
//	スライドショー
//
//	==================================================
?>
<div class="wideslider">
	<ul>
		<li><a href="#1"><img src="<?php echo get_template_directory_uri(); ?>/img/980x500.png" alt=""></a></li>
		<li><a href="#2"><img src="<?php echo get_template_directory_uri(); ?>/img/980x500.png" alt=""></a></li>
		<li><a href="#3"><img src="<?php echo get_template_directory_uri(); ?>/img/980x500.png" alt=""></a></li>
	</ul>
</div>



<?php
//	==================================================
//
//	メインコピー
//
//	==================================================
?>



<?php
//	==================================================
//
//	おしらせ
//
//	==================================================
?>
<div class="wrap-news">
	<div class="container">
		<h2>お知らせ<span class="sub-title">information</span></h2>
		<?php
			$num = 4;
			query_posts('posts_per_page='.$num);
			if ( have_posts() ) :
				echo '<div class="row row-10">';
				while ( have_posts() ) : the_post();
					$pLink = get_the_permalink();
					$time = get_the_time('Y.m.d');
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
					echo '<div class="col-sm-3"><div class="card"><a href="' . $pLink . '"><div class="wrap-card-img"><img src="' . $src . '" alt="" class="lr-center"></div><div class="card-inner"><p class="date">' . $time . '</p><h4 class="title text-nowrap">' . $title . '</h4><p class="cat card-' . $cat_slug . '">' . $cat_name . '</p></div></a></div></div>';
				endwhile;
				echo '</div>';
			else :
				echo '<p>現在、記事はありません。</p>';
			endif;
			wp_reset_query();
		?>
	</div>
</div>



<?php
//	==================================================
//
//	
//
//	==================================================
?>



<?php get_footer(); ?>