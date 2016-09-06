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
			wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '');
			wp_deregister_script('matchheight');
			wp_enqueue_script('matchheight', get_template_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '');
		}
	}
	add_action('init', 'load_cdn');
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
	$retHtml = '<ul class="news-list">';

	foreach($myposts as $post) :

		$cat 		= get_the_category();
		$catname 	= $cat[0]->cat_name;
		$catslug 	= $cat[0]->slug;

		setup_postdata($post);

		$retHtml .= '<li>';
		$retHtml .= '<span class="news-date">' . get_post_time( get_option( 'date_format' )) . '</span>';
		$retHtml .= '<span class="cat ' . $catslug . '">' . $catname . '</span>';
		$retHtml .= '<span class="news-title"><a href="' . get_permalink() . '">' . the_title("", "", false) . '</a></span>';
		$retHtml .= '</li>';

	endforeach;

	$retHtml .= '</ul>';
	$post = $oldpost;
	wp_reset_postdata();
	return $retHtml;
}
add_shortcode("news", "getNewItems");



?>