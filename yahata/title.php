<div class="page-title"><div class="container"><h2 class="title">
<?php

	if (is_page() || is_home()) {

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
</h2>





<?php
	//	学園について - ごあいさつ - 学園の概要 - 教育方針 - よくあるご質問
	//	園での生活 - 園での1日 - 年間行事
	// ==================================================
	if(!is_mobile()) {
	if(is_subpage()) {
		$parentID = is_subpage();
		if($parentID == 7) {
		// 学園について - ごあいさつ - 学園の概要 - 教育方針 - よくあるご質問
?>
<div class="wrap-window window-4">
	<div class="row">
		<div class="col-sm-6 col-sm-push-3">
			<div class="row">
				<div class="col-sm-3">
					<a href="<?php echo home_url(); ?>/about/greeting" class="<?php if ( is_page('greeting') ) { echo 'current'; } ?>">ごあいさつ</a>
				</div>
				<div class="col-sm-3">
					<a href="<?php echo home_url(); ?>/about/outline" class="<?php if ( is_page('outline') ) { echo 'current'; } ?>">学園の概要</a>
				</div>
				<div class="col-sm-3">
					<a href="<?php echo home_url(); ?>/about/education" class="<?php if ( is_page('education') ) { echo 'current'; } ?>">教育方針</a>
				</div>
				<div class="col-sm-3">
					<a href="<?php echo home_url(); ?>/about/faq" class="<?php if ( is_page('faq') ) { echo 'current'; } ?>">よくあるご質問</a>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
		} elseif($parentID == 16) {
		//	園での生活 - 園での1日 - 年間行事
?>
<div class="wrap-window window-2">
	<div class="box-80per">
		<div class="row">
			<div class="col-sm-4 col-sm-push-4">
				<div class="row">
					<div class="col-sm-6">
						<a href="<?php echo home_url(); ?>/life/oneday" class="<?php if ( is_page('oneday') ) { echo 'current'; } ?>">園での1日</a>
					</div>
					<div class="col-sm-6">
						<a href="<?php echo home_url(); ?>/life/events" class="<?php if ( is_page('events') ) { echo 'current'; } ?>">年間行事</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
		}
	}
	} // is_mobile() の終了
?>





</div></div>