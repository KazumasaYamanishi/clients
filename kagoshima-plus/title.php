<div class="page-title"><div class="container"><h2 class="title">
<?php

	if ( is_post_type_archive( 'gourmet' ) || is_singular( 'gourmet' ) ) {

		echo '<span class="ttl-gourmet">gourmet</span>';

	} elseif (is_page() || is_home()) {

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

	// } elseif(is_singular()) {

	// 	echo 'カスタム投稿タイプ';

	// } else {
	// 	echo 'aaaa';
	}
?>
</h2></div></div>
<div class="wrap-breadcrumbs">
	<div class="container">
		<div class="breadcrumb">
			<?php
				if(function_exists('bcn_display')) {
					bcn_display();
				}
			?>
		</div>
	</div>
</div>