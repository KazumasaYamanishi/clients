<div class="side">
	<div class="side-box">
		<h4>最近の記事</h4>
		<ul class="unit-news">
			<?php
				$cat_id = apt_category_id();
				query_posts(array('post_type' => 'post', 'posts_per_page' => 5));
				while (have_posts()) : the_post();

						$cat_info = apt_category_info();
			?>
			<li><a href="<?php the_permalink(); ?>"><span class="news-date"><?php the_time('Y年n月j日'); ?></span><span class="news-title"><?php the_title(); ?></span></a></li>
			<?php endwhile;	wp_reset_query(); ?>
		</ul>
	</div>
	<div class="side-box">
		<h4>カテゴリー</h4>
		<ul class="side-list">
			<?php // wp_list_categories(array('title_li' => false, 'hide_empty' => true, 'current_category' => $cat_id, 'show_count' => 1, 'include' => 1)); ?>
			<?php wp_list_categories(array('title_li' => false, 'hide_empty' => true, 'current_category' => $cat_id, 'show_count' => 1)); ?>
		</ul>
	</div>
	<div class="side-box">
		<h4>過去の記事</h4>
		<ul class="side-list">
			<?php wp_get_archives('type=monthly&limit=12&show_post_count=true'); ?>
		</ul>
	</div>
</div>