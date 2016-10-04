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
//	アイキャッチ画像を使えるようにする
//
// ==================================================
	add_theme_support( 'post-thumbnails' );
// ==================================================
//
//	管理画面の記事/固定ページ一覧のテーブルにIDの列を加える
//
// ==================================================
	add_filter('manage_posts_columns', 'posts_columns_id', 5);
	add_action('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
	add_filter('manage_pages_columns', 'posts_columns_id', 5);
	add_action('manage_pages_custom_column', 'posts_custom_id_columns', 5, 2);
	function posts_columns_id($defaults){
		$defaults['wps_post_id'] = __('ID');
		return $defaults;
	}
	function posts_custom_id_columns($column_name, $id){
		if($column_name === 'wps_post_id'){
			echo $id;
		}
	}
// ==================================================
//
//	投稿一覧にアイキャッチを表示
//
// ==================================================
	function add_thumbnail_column( $columns ) {
		$post_type = isset( $_REQUEST['post_type'] ) ? $_REQUEST['post_type'] : 'post';
			if ( post_type_supports( $post_type, 'thumbnail' ) ) {
				$columns['thumbnail'] = __( 'Featured Images' );
			}
			return $columns;
	}
	function display_thumbnail_column( $column_name, $post_id ) {
		if ( $column_name == 'thumbnail' ) {
			if ( has_post_thumbnail( $post_id ) ) {
				echo get_the_post_thumbnail( $post_id, array( 50, 50 ) );
			} else {
				_e( 'none' );
			}
		}
	}
	add_filter( 'manage_posts_columns', 'add_thumbnail_column' );
	add_action( 'manage_posts_custom_column', 'display_thumbnail_column', 10, 2 );
// ==================================================
//
//	ウィジェット
//
// ==================================================
	if (function_exists('register_sidebar')) {
		register_sidebar( array(
			'name' => __( '広告エリア' ),
			'id' => 'ad_widget',
			'before_widget' => '<li class="widget-container ad_widget">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="ad_widget">',
			'after_title' => '</h3>',
		));
		register_sidebar( array(
			'name' => __( '人気の記事' ),
			'id' => 'ppost_widget',
			'before_widget' => '<li class="widget-container ppost_widget">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="ppost_widget">',
			'after_title' => '</h3>',
		));
		register_sidebar( array(
			'name' => __( '新着記事' ),
			'id' => 'rentry_widget',
			'before_widget' => '<li class="widget-container rentry_widget">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="rentry_widget">',
			'after_title' => '</h3>',
		));
		register_sidebar( array(
			'name' => __( 'カテゴリー' ),
			'id' => 'category_widget',
			'before_widget' => '<li class="widget-container category_widget">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="category_widget">',
			'after_title' => '</h3>',
		));
		register_sidebar( array(
			'name' => __( 'キーワード検索' ),
			'id' => 'search_widget',
			'before_widget' => '<li class="widget-container search_widget">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="search_widget">',
			'after_title' => '</h3>',
		));
		register_sidebar( array(
			'name' => __( 'エディタについて' ),
			'id' => 'about_widget',
			'before_widget' => '<li class="widget-container about_widget">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="about_widget">',
			'after_title' => '</h3>',
		));
		register_sidebar( array(
			'name' => __( 'Side Widget' ),
			'id' => 'side-widget',
			'before_widget' => '<li class="widget-container">',
			'after_widget' => '</li>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		// フッターエリアのウィジェット
		register_sidebar( array(
			'name' => __( 'Footer Widget' ),
			'id' => 'footer-widget',
			'before_widget' => '<div class="widget-area"><ul><li class="widget-container">',
			'after_widget' => '</li></ul></div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
	}
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
if (!current_user_can('level_10')) {
	function exclude_other_posts( $wp_query ) {
	    if ( isset( $_REQUEST['post_type'] ) && post_type_exists( $_REQUEST['post_type'] ) ) {
	        $post_type = get_post_type_object( $_REQUEST['post_type'] );
	        $cap_type = $post_type->cap->edit_other_posts;
	    } else {
	        $cap_type = 'edit_others_posts';
	    }
	    if ( is_admin() && $wp_query->is_main_query() && ! $wp_query->get( 'author' ) && ! current_user_can( $cap_type ) ) {
	        $user = wp_get_current_user();
	        $wp_query->set( 'author', $user->ID );
	    }
	}
	add_action( 'pre_get_posts', 'exclude_other_posts' );
}

// ==================================================
//
//	管理画面のメニューを非表示にする
//
// ==================================================
function remove_menus () {
	if (!current_user_can('level_10')) { //level10以下のユーザーの場合メニューをunsetする
		remove_menu_page('wpcf7'); //Contact Form 7
		global $menu;
		//unset($menu[2]); // ダッシュボード
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
	}
}
add_action('admin_menu', 'remove_menus');
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
//	集計ページを追加（管理者のみ実行）
//
// ==================================================
function original_menu() {
	include 'original_menu.php';
}
function original_page() {
	// if (current_user_can('level_10')) { //level10以下のユーザーの場合メニューをunsetする
		add_menu_page('集計', '集計', 1, 'original_page', 'original_menu');
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
function add_new_item_in_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu(array(
		'id' 	=> 'new_item_in_admin_bar',
		'title' => __('ログアウト'),
		'href' 	=> wp_logout_url()
	));
}
add_action('wp_before_admin_bar_render', 'add_new_item_in_admin_bar');
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
//	Custom Field Templateの読込ボタンを自動で押す
//
// ==================================================
	function _register_custom_js( ) {
	    $_current_theme_dir 	= get_template_directory_uri();
	    $_custom_js 			= '<script src="' . get_template_directory_uri() . '/js/autoread.js"></script>';
	    echo $_custom_js . "n";
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






?>