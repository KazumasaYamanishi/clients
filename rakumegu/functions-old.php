<?php

// ==================================================
//
//	外部のjQueryを読み込む
//
// ==================================================
	function load_cdn() {
		if ( !is_admin() ) {
			wp_deregister_script('jquery');
			wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '1.11.1');
			wp_deregister_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-core','//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', array(), '1.11.1');
			wp_deregister_script('bootstrap');
			wp_enqueue_script('bootstrap', '//kg-rakumegu.com/wp-content/themes/addas/js/bootstrap.min.js', array(), '');
			wp_deregister_script('matchheight');
			wp_enqueue_script('matchheight', '//kg-rakumegu.com/wp-content/themes/addas/js/jquery.matchHeight-min.js', array(), '');
		}
	}
	add_action('init', 'load_cdn');
// ==================================================
//
//	WordPress4.4以降からhead内に挿入されるようになった不要なタグ「Embed」を削除
//
// ==================================================
	remove_action('wp_head','wp_oembed_add_host_js');
// ==================================================
//
//	カスタムメニュー
//
// ==================================================
	register_nav_menu( 'g_menu1', 'グローバルナビ1' );
	register_nav_menu( 'g_menu2', 'グローバルナビ2' );
	register_nav_menu( 'g_menu3', 'グローバルナビ3' );
	register_nav_menu( 'f_menu', 'フッターメニュー' );
	register_nav_menu( 'f_sub_menu', 'フッターサブメニュー' );
	register_nav_menu( 'g_menu_sp', 'スマホメニュー' );
	register_nav_menu( 'list_menu_sp', 'スマホリスト' );
	add_theme_support( 'menus' );
// ==================================================
//
//	bodyとpost classにカテゴリー名ポストクラス名をclass名として追加する
//
// ==================================================
	function category_id_class($classes) {
		global $post;
		foreach((get_the_category($post->ID)) as $category)
			$classes[] = $category->category_nicename;
		return $classes;
	}
	add_filter('post_class', 'category_id_class');
	add_filter('body_class', 'category_id_class');
// ==================================================
//
//	投稿数をaタグ内に表記
//
// ==================================================
	add_filter( 'wp_list_categories', 'my_list_categories', 10, 2 );
	function my_list_categories( $output, $args ) {
		$output = preg_replace('/<\/a>\s*\((\d+)\)/',' ($1)</a>',$output);
		return $output;
	}
	add_filter( 'get_archives_link', 'my_archives_link' );
	function my_archives_link( $output ) {
		$output = preg_replace('/<\/a>\s*(&nbsp;)\((\d+)\)/',' ($2)</a>',$output);
		return $output;
	}
// ==================================================
//
//	PCとスマフォ向けの出し分け
//
// ==================================================
	function is_mobile(){
		$useragents = array(
			'iPhone',          // iPhone
			'iPod',            // iPod touch
			'Android',         // 1.5+ Android
			'dream',           // Pre 1.5 Android
			'CUPCAKE',         // 1.5+ Android
			'blackberry9500',  // Storm
			'blackberry9530',  // Storm
			'blackberry9520',  // Storm v2
			'blackberry9550',  // Storm v2
			'blackberry9800',  // Torch
			'webOS',           // Palm Pre Experimental
			'incognito',       // Other iPhone browser
			'webmate'          // Other iPhone browser
		);
		$pattern = '/'.implode('|', $useragents).'/i';
		return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
	}
// ==================================================
//
//	wp-bootstrap-navwalker を読み込む
//
// ==================================================
	require_once('wp_bootstrap_navwalker.php');
// ==================================================
//
//	wp_list_pagesで取得したリストのクラスにスラッグを追加
//
// ==================================================
	function my_page_css_class( $css_class, $page ) {
		$css_class[] = 'list-group-item';
		return $css_class;
	}
	add_filter( 'page_css_class', 'my_page_css_class', 10, 2 );
// ==================================================
//
//	wp-pagenavi
//
// ==================================================
	function nofx_wp_pagenavi($size = null, $position = null, $post = false, $queryArgs = null) {
		if (!function_exists('wp_pagenavi')) {
			return null;
		}
		$class[] = "pagination"; // Set Main Class
		// Pagination Size Class
		if (!$size) {
			$size = '';
		}
		$class[] = (!$size) ? '' : "pagination-" . $size;
		// Pagination Position, default LEFT
		if (!$position) {
			$position = 'left';
		}
		$class[] = "pagination-" . $position;
		// Set Before & After Output
		$before = "<div class=\"" . implode(" ", $class) . "\"><ul class='pagination'>";
		$after = "</ul></div>";
		// Build Args
		$args = array(
			'before' => $before,
			'after' => $after
		);
		// Cloning untuk wp_link_pages()
		if ($post) {
			$args['type'] = 'multipart';
		}
		if ($queryArgs) {
			$args['query'] = $queryArgs;
		}
		return wp_pagenavi($args);
	}
	/**
	 * This is filter that help above template tags
	 */
	function nofx_pagenavi_filter($html) {
		$out = str_replace('<div class=\'wp-pagenavi\'>', '', $html);
		$out = str_replace('</div></ul></div>', '</ul></div>', $out);
		$out = str_replace('<a ', '<li><a ', $out);
		$out = str_replace('</a>', '</a></li>', $out);
		$out = str_replace('<span', '<li><a href="#"><span', $out);
		$out = str_replace('</span>', '</span></a></li>', $out);
		$out = preg_replace('/<li><a href="#"><span class=[\'|"]pages[\'|"]>([0-9]+) of ([0-9]+)<\/span><\/a><\/li>/', '', $out);
		$out = preg_replace('/<li><a href="#"><span class=[\'|"]extend[\'|"]>([^\n\r<]+)<\/span><\/a><\/li>/', '<li class="disabled"><a href="#">&hellip;</a></li>', $out);
		$out = str_replace('<li><a href="#"><span class=\'current\'', '<li class="active disabled"><a href="#"><span class="current"', $out);
		return $out;
	}
	add_filter('wp_pagenavi', 'nofx_pagenavi_filter', 10, 2);
// ==================================================
//
//	アーカイブページで現在のカテゴリー・タグ・タームを取得する
//
// ==================================================
	function get_current_term(){
		$id;
		$tax_slug;
		if(is_category()){
			$tax_slug = "category";
			$id = get_query_var('cat');
		}else if(is_tag()){
			$tax_slug = "post_tag";
			$id = get_query_var('tag_id');
		}else if(is_tax()){
			$tax_slug = get_query_var('taxonomy');
			$term_slug = get_query_var('term');
			$term = get_term_by("slug",$term_slug,$tax_slug);
			$id = $term->term_id;
		}
		return get_term($id,$tax_slug);
	}
	/*
		<?php $cat_info = get_current_term(); ?>
		<span class="news_category <?php echo esc_attr($cat_info->slug); ?>"><?php echo esc_html($cat_info->name); ?></span>
	*/
// ==================================================
//
//	最上位の固定ページ情報を取得する
//
// ==================================================
	function apt_page_ancestor() {
		global $post;
		$anc = array_pop(get_post_ancestors($post));
		$obj = new stdClass;
		if ($anc) {
			$obj->ID = $anc;
			$obj->post_title = get_post($anc)->post_title;
		} else {
			$obj->ID = $post->ID;
			$obj->post_title = $post->post_title;
		}
		return $obj;
	}
// ==================================================
//
//	カテゴリIDを取得する
//
// ==================================================
	function apt_category_id($tax='category') {
		global $post;
		$cat_id = 0;
		if (is_single()) {
			$cat_info = get_the_terms($post->ID, $tax);
			if ($cat_info) {
				$cat_id = array_shift($cat_info)->term_id;
			}
		}
		return $cat_id;
	}
// ==================================================
//
//	カテゴリ情報を取得する
//
// ==================================================
	function apt_category_info($tax='category') {
		global $post;
		$cat = get_the_terms($post->ID, $tax);
		$obj = new stdClass;
		if ($cat) {
			$cat = array_shift($cat);
			$obj->name = $cat->name;
			$obj->slug = $cat->slug;
		} else {
			$obj->name = '';
			$obj->slug = '';
		}
		return $obj;
	}
// ==================================================
//
//	editor style
//
// ==================================================
	add_editor_style();
// ==================================================
//
//	ビジュアルとテキストエディタの往復でもソースが変わらないようにする
//
// ==================================================
	add_filter('tiny_mce_before_init', 'tinymce_init');
	function tinymce_init( $init ) {
		$init['verify_html'] = false;
		return $init;
	}
// ==================================================
//
//	固定ページのみ自動整形機能を無効化します。
//
// ==================================================
	function disable_page_wpautop() {
		if ( is_page() ) remove_filter( 'the_content', 'wpautop' );
	}
	add_action( 'wp', 'disable_page_wpautop' );
// ==================================================
//
//	最新記事リスト [news cat="2,3,5" num="5"]などで出力
//
// ==================================================
	function getNewItems($atts) {
		extract(shortcode_atts(array(
			"num" => '',	// 最新記事リストの取得数
			"cat" => ''	    // 表示する記事のカテゴリー指定
		), $atts));

		global $post;

		$oldpost = $post;
		$myposts = get_posts('numberposts=' . $num . '&order=DESC&orderby=post_date&category=' . $cat);
		$retHtml = '<ul class="news-list list-unstyled">';

		foreach($myposts as $post) :

			$cat 		= get_the_category();
			$catname 	= $cat[0]->cat_name;
			$catslug 	= $cat[0]->slug;

			setup_postdata($post);

			$retHtml .= '<li>';
			$retHtml .= '<span class="news-date">' . get_post_time( get_option( 'date_format' )) . '</span>';
			// $retHtml .= '<span class="cat ' . $catslug . '">' . $catname . '</span>';
			$retHtml .= '<span class="news-title"><a href="' . get_permalink() . '">' . the_title("", "", false) . '</a></span>';
			$retHtml .= '</li>';

		endforeach;

		$retHtml .= '</ul>';
		$post = $oldpost;
		wp_reset_postdata();
		return $retHtml;
	}
	add_shortcode("news", "getNewItems");










// ==================================================
//
//	管理画面の投稿一覧の投稿をログイン中のユーザーの投稿のみにする
//
// ==================================================
// if (!current_user_can('level_10')) {
// 	function exclude_other_posts( $wp_query ) {
// 		if ( isset( $_REQUEST['post_type'] ) && post_type_exists( $_REQUEST['post_type'] ) ) {
// 			$post_type = get_post_type_object( $_REQUEST['post_type'] );
// 			$cap_type = $post_type->cap->edit_other_posts;
// 		} else {
// 			$cap_type = 'edit_others_posts';
// 		}
// 		if ( is_admin() && $wp_query->is_main_query() && ! $wp_query->get( 'author' ) && ! current_user_can( $cap_type ) ) {
// 			$user = wp_get_current_user();
// 			$wp_query->set( 'author', $user->ID );
// 		}
// 	}
// 	add_action( 'pre_get_posts', 'exclude_other_posts' );
// }

// ==================================================
//
//	管理画面のメニューを非表示にする
//
// ==================================================
	function remove_menus () {
		if (current_user_can('author')) { //level10以下のユーザーの場合メニューをunsetする
			// remove_menu_page('wpcf7'); //Contact Form 7
			global $menu;
			unset($menu[2]); // ダッシュボード
			unset($menu[4]); // メニューの線1
			unset($menu[5]); // 投稿
			unset($menu[10]); // メディア
			unset($menu[15]); // リンク
			unset($menu[20]); // ページ
			unset($menu[25]); // コメント
			unset($menu[59]); // メニューの線2
			unset($menu[60]); // テーマ
			unset($menu[65]); // プラグイン
			// unset($menu[70]); // プロフィール
			unset($menu[75]); // ツール
			unset($menu[80]); // 設定
			unset($menu[90]); // メニューの線3
			unset($menu[26]); // 宿泊施設
			unset($menu[27]); // 観光施設
			// unset($menu[28]); // 証明書
		} elseif (current_user_can('editor')) {
			global $menu;
			unset($menu[2]); // ダッシュボード
			unset($menu[4]); // メニューの線1
			unset($menu[10]); // メディア
			unset($menu[15]); // リンク
			unset($menu[20]); // ページ
			unset($menu[25]); // コメント
			unset($menu[59]); // メニューの線2
			unset($menu[60]); // テーマ
			unset($menu[65]); // プラグイン
			unset($menu[75]); // ツール
			unset($menu[80]); // 設定
			unset($menu[90]); // メニューの線3'edit.php?post_type=mw-wp-form'
		}
	}
	add_action('admin_menu', 'remove_menus');
// ==================================================
//
//	管理画面にPDF形式のマニュアルを埋め込む
//
// ==================================================
	function manual_menu() {
		include 'manual_menu.php';
	}
	function manual_page() {
		add_menu_page('マニュアルダウンロード', 'マニュアルダウンロード', 1, 'manual_page', 'manual_menu', 'dashicons-admin-page', 99);
	}
	add_action ( 'admin_menu', 'manual_page' );
// ==================================================
//
//	WP-Members ログイン後にリダイレクト
//
// ==================================================
	add_filter( 'wpmem_login_redirect', 'my_login_redirect', 10, 2 );
	function my_login_redirect( $redirect_to, $user_id ) {
		return 'https://kg-rakumegu.com/wp-login.php';
	}
// ==================================================
//
//	集計ページを追加
//
// ==================================================
	function original_menu() {
		include 'original_menu.php';
	}
	function original_page() {
		// if (current_user_can('level_10')) { //level10以下のユーザーの場合メニューをunsetする
			add_menu_page('集計', '集計', 1, 'original_page', 'original_menu', 'dashicons-chart-line', 1);
		// }
	}
	add_action('admin_menu', 'original_page');
// ==================================================
//
//	「WordPressへようこそ！」を非表示にする
//
// ==================================================
	remove_action( 'welcome_panel', 'wp_welcome_panel' );
// ==================================================
//
//	ダッシュボードトップ画面のウィジェットを非表示にする
//
// ==================================================
	function example_remove_dashboard_widgets() {
		global $wp_meta_boxes;
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); 		// 現在の状況（概要）
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); 	// 最近のコメント
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); 	// 被リンク
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); 			// プラグイン
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); 		// クイック投稿
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); 		// 最近の下書き
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); 			// WordPressブログ
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); 			// WordPressフォーラム
	}
	add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets');
// ==================================================
//
//	管理画面上部のメニューを非表示にする
//
// ==================================================
	add_action( 'wp_before_admin_bar_render', 'my_wp_before_admin_bar_render' );
	function my_wp_before_admin_bar_render() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');		// wordpressロゴ
		$wp_admin_bar->remove_menu('updates');		// 更新
		$wp_admin_bar->remove_menu('comments');		// コメント
		$wp_admin_bar->remove_menu('new-content');	// 新規
		$wp_admin_bar->remove_menu('user-info');	// マイアカウント内「プロフィール」
		$wp_admin_bar->remove_menu('edit-profile');	// マイアカウント内「プロフィールを編集」
	}
// ==================================================
//
//	ログアウトを左側に表示
//
// ==================================================
	// function add_new_item_in_admin_bar() {
	// 	global $wp_admin_bar;
	// 	$wp_admin_bar->add_menu(array(
	// 		'id' 	=> 'new_item_in_admin_bar',
	// 		'title' => __('ログアウト'),
	// 		'href' 	=> wp_logout_url()
	// 	));
	// }
	// add_action('wp_before_admin_bar_render', 'add_new_item_in_admin_bar');
// ==================================================
//
//	表示オプションとヘルプを非表示
//
// ==================================================
	function my_admin_head(){
		echo '<style type="text/css">#contextual-help-link-wrap{display:none;}</style>';
		echo '<style type="text/css">#screen-options-link-wrap{display:none;}</style>';
	}
	add_action('admin_head', 'my_admin_head');
// ==================================================
//
//	「WordPress のご利用ありがとうございます」を消す
//
// ==================================================
	function custom_admin_footer() {
		echo '&nbsp;';
	}
	add_filter('admin_footer_text', 'custom_admin_footer');
// ==================================================
//
//	WP-MembersにPlaceholderを追加する
//
// ==================================================
	function my_register_form_rows_filter( $rows, $toggle ) {
		$rows['username'][field] 			= '<input type="text" name="user_login" value="" id="user_login" placeholder="半角英数字　例）rakurakumeguri">';
		$rows['password'][field] 			= '<input type="password" name="password" id="password" class="textbox" placeholder="半角英数字（8文字以上）">';
		$rows['confirm_password'][field] 	= '<input type="password" name="confirm_password" id="confirm_password" class="textbox" placeholder="半角英数字（8文字以上）">';
		$rows['company_name'][field] 		= '<input type="text" name="company_name" id="company_name" class="textbox" placeholder="例）楽々巡りレンタカー中央駅前店"><p><span class="small">※営業所ごとに登録する場合は、会社名のあとに営業所名を入力してください。</span></p>';
		$rows['company_kana'][field] 		= '<input type="text" name="company_kana" id="company_kana" class="textbox" placeholder="例）らくらくめぐりれんたかーちゅうおうえきまえてん"><p><span class="small">※※株式会社、有限会社などを省いた読み仮名を<strong>ひらがな</strong>で入力してください。</span></p>';
		$rows['zip'][field] 				= '<input type="text" name="zip" id="zip" class="textbox" placeholder="例）892-0862">';
		$rows['city'][field] 				= '<input type="text" name="city" id="city" class="textbox" placeholder="例）鹿児島市山下町">';
		$rows['addr1'][field] 				= '<input type="text" name="addr1" id="addr1" class="textbox" placeholder="例）17-4 照国ビル302号">';
		$rows['phone1'][field] 				= '<input type="text" name="phone1" id="phone1" class="textbox" placeholder="例）099-123-4567"><p><span class="small">※広報サイトに表示されます。</span></p>';
		$rows['user_email'][field] 			= '<input type="email" name="user_email" id="user_email" class="textbox" placeholder="例）info@rakumegu.jp"><p><span class="small">※登録完了メールが届きますので、必ず<strong>使用できるメールアドレス</strong>を登録してください。</span></p>';
		// $rows['user_url'][field] 			= '<input type="url" name="url" id="user_url" class="textbox" placeholder="※広報サイトに表示されます。">';
		$rows['user_url'][field] 			= '<input type="url" name="user_url" id="user_url" class="textbox" value="" placeholder="例）http://ktscr.co.jp"><p><span class="small">※広報サイトに表示されます。</span></p>';
		$rows['attention'][field] 			= '<div class="wrap-attention"><p class="kome">※らくらくかごしま巡りシステムのログインする際は、御社が入力された<span class="strong">ユーザー名</span>と<span class="strong">パスワード</span>を使用して、下記リンクURLよりログインすることができます。</p><p class="link-login"><a href="https://kg-rakumegu.com/wp-login.php" target="_blank">https://kg-rakumegu.com/wp-login.php</a></p></div>';
		return $rows;
	}
	add_filter( 'wpmem_register_form_rows', 'my_register_form_rows_filter', 10, 2 );
// ==================================================
//
//	プロフィールページの修正（管理者以外）
//
// ==================================================
	function userprofile_script() {
		if (!current_user_can('administrator')) {
			global $hook_suffix;
			if('profile.php' == $hook_suffix) {
				wp_enqueue_script('userprofile_js', get_stylesheet_directory_uri().'/js/userprofile.js', array('jquery'));
			}
		}
	}
	add_action('admin_enqueue_scripts', 'userprofile_script');
// ==================================================
//
//	管理画面のbody_classにrole-権限名でクラスを付与する
//
// ==================================================
	function add_user_role_class( $admin_body_class ) {
		global $current_user;
		if ( ! $admin_body_class ) {
			$admin_body_class .= ' ';
		}
		$admin_body_class .= 'role-' . urlencode( $current_user->roles[0] );
		return $admin_body_class;
	}
	add_filter( 'admin_body_class', 'add_user_role_class' );
// ==================================================
//
//	証明書一覧にカスタムフィールドの列を追加
//
// ==================================================
	// 一覧に項目の追加
	function manage_posts_columns($columns) {

		global $current_user;
		get_currentuserinfo();
		$agrLevel = $current_user->user_level;

		if ( $agrLevel != 2 ) $columns['CheckKCR'] = "確認ステータス";

		// $columns['kaishu'] 			= "回収日";
		$columns['UseBefore'] 		= "開始日";
		$columns['UseAfter'] 		= "終了日";
		$columns['Sightseeing01'] 	= "施設名1";
		$columns['Date01'] 			= "証明日1";
		$columns['Sightseeing02'] 	= "施設名2";
		$columns['Date02'] 			= "証明日2";
		$columns['HotelArea'] 		= "宿泊エリア";
		$columns['PriceBefore'] 	= "割引前";
		$columns['PriceAfter'] 		= "割引後";
		unset($columns['date']);
		return $columns;
	}
	add_filter( 'manage_posts_columns', 'manage_posts_columns' );

	// 一覧に追加された項目に対する値の表示
	function my_posts_custom_column( $column, $post_id ) {

		switch ( $column ) {

			case 'CheckKCR':
				if ( get_post_meta ( $post_id , 'CheckKCR' , true ) ) {
					$checked = get_post_meta( $post_id , 'CheckKCR' , true );
				} else {
					$checked = '';
				}
				if ( !empty ( $checked ) ) echo $checked;
				break;

			// case 'kaishu':
			// 	$checked = get_post_meta( $post_id , 'kaishu' , true );
			// 	if ( !empty ( $checked ) ) echo $checked;
			// 	break;

			case 'UseBefore':
				$checked = get_post_meta( $post_id , 'UseBefore' , true );
				if ( !empty ( $checked ) ) echo $checked;
				break;

			case 'UseAfter':
				$checked = get_post_meta( $post_id , 'UseAfter' , true );
				if ( !empty ( $checked ) ) echo $checked;
				break;

			case 'Sightseeing01':
				$checked = get_post_meta( $post_id , 'Sightseeing01' , true );
				if ( !empty ( $checked ) ) echo $checked;
				break;

			case 'Date01':
				$checked = get_post_meta( $post_id , 'Date01' , true );
				if ( !empty ( $checked ) ) echo $checked;
				break;

			case 'Sightseeing02':
				$checked = get_post_meta( $post_id , 'Sightseeing02' , true );
				if ( !empty ( $checked ) ) echo $checked;
				break;

			case 'Date02':
				$checked = get_post_meta( $post_id , 'Date02' , true );
				if ( !empty ( $checked ) ) echo $checked;
				break;

			case 'HotelArea':
				$checked = get_post_meta( $post_id , 'HotelArea' , true );
				if ( !empty ( $checked ) ) echo $checked;
				break;

			case 'PriceBefore':
				$checked = get_post_meta( $post_id , 'PriceBefore' , true );
				if ( !empty ( $checked ) ) echo number_format ( $checked ) . '円';
				break;

			case 'PriceAfter':
				$checked = get_post_meta( $post_id , 'PriceAfter' , true );
				if ( !empty ( $checked ) ) {
					echo number_format ( $checked ) . '円';
				} else {
					echo number_format ( 0 ) . '円';
				}
				break;
		}
	}
	add_action( 'manage_posts_custom_column' , 'my_posts_custom_column', 10, 2 );
	// ソート処理
	function make_order_column_sortable( $columns ) {
		// $columns['kaishu'] 		= 'kaishu';
		$columns['UseBefore'] 	= "UseBefore";
		$columns['UseAfter'] 	= "UseAfter";
		$columns['Date01'] 		= "Date01";
		$columns['Date02'] 		= "Date02";
		$columns['PriceBefore'] = "PriceBefore";
		$columns['PriceAfter'] 	= "PriceAfter";
		return $columns;
	}
	add_filter( 'manage_edit-stamp_sortable_columns', 'make_order_column_sortable' );
// ==================================================
//
//	クイック編集でカスタムフィールドの値を表示し、編集できるようにする
//
// ==================================================
	function display_my_quickmenu( $column_name, $post_type ) {
		static $print_nonce = TRUE;
		if ( $print_nonce ) {
	        $print_nonce = FALSE;
	        wp_nonce_field( 'quick_edit_action', $post_type . '_edit_nonce' ); //CSRF対策
	    }
	?>
	<fieldset class="inline-edit-col-right inline-custom-meta">
        <div class="inline-edit-col column-<?php echo $column_name ?>">
            <label class="inline-edit-group">
                <?php
                switch ( $column_name ) {
                    case 'CheckKCR':
                ?>
                	<input name="checkkcr[0][0]" value="" type="hidden">
                	<label for="checkkcr_e69caae7a2bae8aa8d_0_0" class="selectit"><input id="checkkcr_e69caae7a2bae8aa8d_0_0" name="checkkcr[0][0]" value="未確認" type="radio" class="checkkcr0"> 未確認</label> <label for="checkkcr_e7a2bae8aa8de4b8ad_0_0" class="selectit"><input id="checkkcr_e7a2bae8aa8de4b8ad_0_0" name="checkkcr[0][0]" value="確認中" type="radio" class="checkkcr0"> 確認中</label> <label for="checkkcr_e7a2bae5ae9a_0_0" class="selectit"><input id="checkkcr_e7a2bae5ae9a_0_0" name="checkkcr[0][0]" value="確定" type="radio" class="checkkcr0"> 確定</label>
                <?php
                        break;
                }
                ?>
            </label>
        </div>
    </fieldset>
	<?php
	}
	add_action( 'quick_edit_custom_box', 'display_my_quickmenu', 10, 2 );
	//jQueryの読み込み
	function my_admin_quickedit() {
	    global $post_type;
	    $slug = 'stamp'; //投稿タイプの指定、カスタム投稿で仕様する場合はここを置換
	    if ( $post_type == $slug ) {
	        //任意のディレクトリへjsをアップロードし、読み込ませる テーマ内への記述も可
	        echo '<script type="text/javascript" src="', get_stylesheet_directory_uri() .'/js/admin_quickedit.js', '"></script>';
	    }
	}
	add_action('admin_footer-edit.php', 'my_admin_quickedit');
	function save_custom_meta( $post_id ) {
	    $slug = 'stamp'; //カスタムフィールドの保存処理をしたい投稿タイプを指定

	    if ( $slug !== get_post_type( $post_id ) ) {
	        return;
	    }
	    if ( !current_user_can( 'edit_post', $post_id ) ) {
	        return;
	    }

	    $_POST += array("{$slug}_edit_nonce" => '');
	    if ( !wp_verify_nonce( $_POST["{$slug}_edit_nonce"], 'quick_edit_action' ) ) {
	        return;
	    }

	    //チェックボックスの場合
	    if ( isset( $_REQUEST['CheckKCR'] ) ) {
	        update_post_meta($post_id, 'CheckKCR', TRUE);
	    } else {
	        update_post_meta($post_id, 'CheckKCR', FALSE);
	    }
	}
	add_action( 'save_post', 'save_custom_meta' );
// ==================================================
//
//	デフォルトで表示されている投稿日付で絞り込み検索を非表示にする　ここは要検討。不必要なら削除。
//
// ==================================================
	// function custom_load_edit() {
	// 	add_filter( 'disable_months_dropdown' , 'custom_disable_months_dropdown' , 10 , 2 );
	// 	function custom_disable_months_dropdown( $false , $post_type ) {
	// 		$disable_months_dropdown = $false;
	// 		$disable_post_types = array( '{stamp}' );
	// 		if( in_array( $post_type , $disable_post_types ) ) {
	// 			$disable_months_dropdown = true;
	// 		}
	// 		return $disable_months_dropdown;
	// 	}
	// }
	// add_action( 'load-edit.php' , 'custom_load_edit' );
// ==================================================
//
//	カスタムフィールドで絞り込み検索する場合の例
//
// ==================================================
	function add_author_filter() {
		global $post_type;
		if ( $post_type == 'stamp' ) { ?>
			<select name="kaishu">
            	<option value="0">回収月を選択してください</option>
            	<option value="201611">2016年11月</option>
            	<option value="201612">2016年12月</option>
            	<option value="201701">2017年1月</option>
            </select>
	<?php	}
	}
	add_action( 'restrict_manage_posts', 'add_author_filter' );

	function kaishu_query ( $query ) {
		global $pagenow;
		global $post_type;
		if ( $post_type == 'stamp' && $_GET['kaishu'] ) {
			$kaishuMonth = $_GET['kaishu'];
			if ( $kaishuMonth == '201611' ) {
// http://d.hatena.ne.jp/deeeki/20100408/wordpress_search_hook 参照
$args = array(
	// 'post_type'  => 'stamp',
	// 'meta_query' => array(
	// 	'relation' => 'AND',
	// 	array(
	// 		'key'     => 'kaishu',
	// 		'value'   => '2016-11-01',
	// 		'compare' => '>=',
	// 	),
	// 	array(
	// 		'key'     => 'kaishu',
	// 		'value'   => '2016-11-30',
	// 		'compare' => '<=',
	// 	),
	// ),
);
$query = new WP_Query( $args );
			} elseif ( $kaishuMonth == '201612' ) {
				
			} elseif ( $kaishuMonth == '201701' ) {
				
			}
			// $query->query_vars[ 'meta_value' ] = $_GET['kaishu'];
		}
		return $query;
	}
	add_filter('parse_query', 'kaishu_query');
// add_filter('parse_query', 'gender_query');
// function gender_query($query) {
//  global $pagenow;
//  global $post_type;
//  if ($pagenow == 'edit.php?post_type=stamp' && $post_type == '{stamp}' && $_GET['kaishu']) {
//   // $query->query_vars[ 'meta_key' ] = '{kaishu}';
//   // $query->query_vars[ 'meta_value' ] = $_GET['kaishu'];
//  	echo 'aaaa';
//  } else {
//  	echo var_dump($query);
//  }
//  return $query;
// }












// ==================================================
//
//	投稿画面から不要な機能を削除する
//
// ==================================================
	function remove_post_supports() {
		// remove_post_type_support( 'post', 'title' ); // タイトル
		remove_post_type_support( 'post', 'editor' ); // 本文欄
		remove_post_type_support( 'stamp', 'editor' ); // 本文欄
		// remove_post_type_support( 'post', 'author' ); // 作成者
		// remove_post_type_support( 'post', 'thumbnail' ); // アイキャッチ
		// remove_post_type_support( 'post', 'excerpt' ); // 抜粋
		// remove_post_type_support( 'post', 'trackbacks' ); // トラックバック
		// remove_post_type_support( 'post', 'custom-fields' ); // カスタムフィールド
		// remove_post_type_support( 'post', 'comments' ); // コメント
		// remove_post_type_support( 'post', 'revisions' ); // リビジョン
		// remove_post_type_support( 'post', 'page-attributes' ); // ページ属性
		// remove_post_type_support( 'post', 'post-formats' ); // 投稿フォーマット

		unregister_taxonomy_for_object_type( 'category', 'post' ); // カテゴリ
		unregister_taxonomy_for_object_type( 'post_tag', 'post' ); // タグ
	}
	add_action( 'init', 'remove_post_supports' );
// ==================================================
//
//	1カラム
//
// ==================================================
	function one_columns_screen_layout() {
		return 1;
	}
	add_filter( 'get_user_option_screen_layout_stamp', 'one_columns_screen_layout', 10, 3 );
// ==================================================
//
//	ユーザー、プロフィールを登録情報に変更
//
// ==================================================
	function edit_admin_menus() {
	    global $menu;
	    global $submenu;
	    $menu[70][0] = '登録情報';
	    $submenu['users.php'][15][0] = '登録情報';
	}
	add_action('admin_menu', 'edit_admin_menus');
// ==================================================
//
//	公開ボタン名を登録に
//
// ==================================================
	function publish_admin_script() {
		echo '<script>jQuery("#publish[name=publish]").val("登録");</script>'.PHP_EOL;
		echo '<script>jQuery("#profile-page input[name=submit]").val("更新");</script>'.PHP_EOL;
	}
	add_action('admin_print_footer_scripts','publish_admin_script');
// ==================================================
//
//	公開ボックスを最下部に再配置
//
// ==================================================
	function my_footer() {
		echo '<script type="text/javascript">
			//<![CDATA[
			jQuery(function(){
			jQuery("#normal-sortables").prepend(jQuery("#side-sortables").children("#categorydiv"));
			jQuery("#normal-sortables").append(jQuery("#side-sortables").children("#submitdiv"));
			jQuery("#categorydiv").prependTo(jQuery("#normal-sortables"));
			jQuery("#submitdiv").appendTo(jQuery("#normal-sortables"));
			});
			//]]>
			</script>';
	}
	add_action('admin_footer', 'my_footer');
// ==================================================
//
//	CSSファイルを読み込む
//
// ==================================================
	function my_admin_style(){
	    wp_enqueue_style( 'my_admin_style', '//fonts.googleapis.com/earlyaccess/notosansjp.css' );
	}
	add_action( 'admin_enqueue_scripts', 'my_admin_style' );
// ==================================================
//
//	ログイン後、集計ページを表示させる
//
// ==================================================
	function redirect_dashiboard() {
		if ( '/wp-admin/index.php' == $_SERVER['SCRIPT_NAME'] ) {
			wp_redirect( admin_url( 'admin.php?page=original_page' ) );
		}
	}
	add_action( 'admin_init', 'redirect_dashiboard' );






















// ==================================================
//
//	Custom Field Templateの読込ボタンを自動で押す
//
// ==================================================
	function _register_custom_js( ) {
		$_current_theme_dir 	= get_template_directory_uri();
		$_custom_js 			= '<script src="' . get_template_directory_uri() . '/js/autoread.js"></script>';
		echo $_custom_js . "\n";
	}
	add_action('admin_head', '_register_custom_js');
// ==================================================
//
//	カスタム投稿タイプ「証明書」の宿泊施設の入力補助
//
// ==================================================
	function my_admin_footer_script() {
		echo '<script src="' . get_template_directory_uri() . '/js/autocomplete.js"></script>';
		echo '<script src="' . get_template_directory_uri() . '/js/autocomplete-k.js"></script>';
	}
	add_action('admin_print_footer_scripts', 'my_admin_footer_script');
// ==================================================
//
//	Ajaxで宿泊施設名を取得 ※autocomplete.jsから呼び出される関数
//
// ==================================================
	function ajax_get_stay_list() {
		$returnObj = array();
		// get_posts オプション
		$args = array(
			'post_type' => 'stay',
			'numberposts' => -1,
		);
		$posts = get_posts( $args );
		foreach( $posts as $key => $post ) {
			$returnObj[$key] = array(
				// 出力するデータを格納
				'post_title' => $post->post_title,
			);
		}
		// json形式に出力
		echo json_encode( $returnObj );
		die();
	}
	add_action( 'wp_ajax_ajax_get_stay_list', 'ajax_get_stay_list' );
	add_action( 'wp_ajax_nopriv_ajax_get_stay_list', 'ajax_get_stay_list' );
// ==================================================
//
//	Ajaxで観光施設名を取得 ※autocomplete-k.jsから呼び出される関数
//
// ==================================================
	function ajax_get_spot_list() {
		$returnObj = array();
		$args = array(
			'post_type' => 'spot',
			'numberposts' => -1,
		);
		$posts = get_posts( $args );
		foreach( $posts as $key => $post ) {
			$returnObj[$key] = array(
				'post_title' => $post->post_title,
			);
		}
		// json形式に出力
		echo json_encode( $returnObj );
		die();
	}
	add_action( 'wp_ajax_ajax_get_spot_list', 'ajax_get_spot_list' );
	add_action( 'wp_ajax_nopriv_ajax_get_spot_list', 'ajax_get_spot_list' );





// ==================================================
//
// 管理画面用のjsファイル読み込み
//
// ==================================================
function my_admin_script(){
	wp_enqueue_script( 'canvas_script', '//cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js', '', '', true);
	wp_enqueue_script( 'my_admin_script', get_template_directory_uri().'/js/my_admin_script.js', array('jquery'), '', true);
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css' );
}
add_action( 'admin_enqueue_scripts', 'my_admin_script' );