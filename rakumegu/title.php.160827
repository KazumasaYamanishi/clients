<div class="page-title"><div class="container"><h2 class="title">
<?php

	if (is_page()) {

		single_post_title();

	} elseif (is_home()) {

		single_post_title();

	} elseif (is_single()) {

		$cat_info = apt_category_info();
		echo esc_html($cat_info->name);

	} elseif (is_month()) {

		echo get_query_var('year') . '年' . get_query_var('monthnum') . '月';

	} elseif (is_category()) {

		$cat_info = apt_category_info();
		echo esc_html($cat_info->name);

	} elseif (is_year()) {

		echo get_query_var('year').'年';

	} elseif (is_404()) {

		echo 'ページが見つかりません。';

	}
?>
</h2></div></div>
