<?php
// ==================================================
//
//	セッション
//
// ==================================================
function init_sessions(){if(!session_id()){session_start();}}
add_action('init', 'init_sessions');

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
//	add_filter('manage_posts_columns', 'posts_columns_id', 5);
//	add_action('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
//	add_filter('manage_pages_columns', 'posts_columns_id', 5);
//	add_action('manage_pages_custom_column', 'posts_custom_id_columns', 5, 2);
//	function posts_columns_id($defaults){
//		$defaults['wps_post_id'] = __('ID');
//		return $defaults;
//	}
//	function posts_custom_id_columns($column_name, $id){
//		if($column_name === 'wps_post_id'){
//			echo $id;
//		}
//	}
// ==================================================
//
//	投稿一覧にアイキャッチを表示
//
// ==================================================
//	function add_thumbnail_column( $columns ) {
//		$post_type = isset( $_REQUEST['post_type'] ) ? $_REQUEST['post_type'] : 'post';
//			if ( post_type_supports( $post_type, 'thumbnail' ) ) {
//				$columns['thumbnail'] = __( 'Featured Images' );
//			}
//			return $columns;
//	}
//	function display_thumbnail_column( $column_name, $post_id ) {
//		if ( $column_name == 'thumbnail' ) {
//			if ( has_post_thumbnail( $post_id ) ) {
//				echo get_the_post_thumbnail( $post_id, array( 50, 50 ) );
//			} else {
//				_e( 'none' );
//			}
//		}
//	}
//	add_filter( 'manage_posts_columns', 'add_thumbnail_column' );
//	add_action( 'manage_posts_custom_column', 'display_thumbnail_column', 10, 2 );
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
// ==================================================
//
//	管理画面のメニューを非表示にする
//
// ==================================================
function remove_menus () {
	if (!current_user_can('level_10')) { //level10以下のユーザーの場合メニューをunsetする
		remove_menu_page('wpcf7'); //Contact Form 7
		global $menu;
		// unset($menu[2]); // ダッシュボード
		unset($menu[4]); // メニューの線1
		// unset($menu[5]); // 投稿
		// unset($menu[10]); // メディア
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
	}
}
add_action('admin_menu', 'remove_menus');
// ==================================================
//
//	カスタム投稿タイプの記事一覧に投稿者の項目を追加する
//
// ==================================================
function manage_books_columns ($columns) {
    $columns['author'] = '作成者';
    return $columns;
}
function add_books_column ($column, $post_id) {
    if ('author' == $column) {
        $value = get_the_term_list($post_id, 'author');
        echo attribute_escape($value);
    }
}
add_filter('manage_posts_columns', 'manage_books_columns');
add_action('manage_posts_custom_column', 'add_books_column', 10, 2);
// カスタム投稿タイプの記事編集画面にメタボックス（作成者変更）を表示する
/* admin_menu アクションフックでカスタムボックスを定義 */
add_action('admin_menu', 'myplugin_add_custom_box');
/* 投稿ページの "advanced" 画面にカスタムセクションを追加 */
function myplugin_add_custom_box() {
  if( function_exists( 'add_meta_box' )) {
    add_meta_box( 'myplugin_sectionid', __( '作成者', 'myplugin_textdomain' ), 'post_author_meta_box', 'flooring', 'advanced' );
   }
}








function add_my_ajaxurl() {
?>
    <script>
        var ajaxurl = '<?php echo admin_url( 'admin-ajax.php'); ?>';
    </script>
<?php
}
add_action( 'wp_footer', 'add_my_ajaxurl', 1 );

function view_sitename(){
    echo get_bloginfo( 'name' );
    die();
}
add_action( 'wp_ajax_view_sitename', 'view_sitename' );
add_action( 'wp_ajax_nopriv_view_sitename', 'view_sitename' );

function my_ajax_get_posts(){

    $itemName = $_POST['itemName'];

    foreach ($_SESSION['items'] as $key => $item) {
		if ($_SESSION['items'][$key]['id'] === $itemName) {
		    unset($_SESSION['items'][$key]);
		    break;
		}
	}
    die();
}
add_action( 'wp_ajax_my_ajax_get_posts', 'my_ajax_get_posts' );
add_action( 'wp_ajax_nopriv_my_ajax_get_posts', 'my_ajax_get_posts' );





// カスタム投稿一覧にカスタムフィールドの値を表示させる
function manage_posts_columns($columns) {
	$columns['i-case'] 	= "ケース単価";
	$columns['i-meter'] 	= "平米単価";
	$columns['i-stock'] 	= "在庫";
	return $columns;
}
function add_column($column_name, $post_id) {
	if( $column_name == 'i-case' ) {
		$stitle = get_post_meta($post_id, 'i-case', true);
	}
	if( $column_name == 'i-meter' ) {
		$stitle = get_post_meta($post_id, 'i-meter', true);
	}
	if( $column_name == 'i-stock' ) {
		$stitle = get_post_meta($post_id, 'i-stock', true);
	}
	if ( isset($stitle) && $stitle ) {
		echo attribute_escape($stitle);
	} else {
		echo __('None');
	}
}
add_filter( 'manage_posts_columns', 'manage_posts_columns' );
add_action( 'manage_posts_custom_column', 'add_column', 10, 2 );


function display_my_custom_quickedit( $column_name, $post_type ) {
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
                    case 'i-case':
                        ?><span class="title">ケース単価</span><input name="i-case"><?php
                        break;
                    case 'i-meter':
                        //チェックボックスの場合
                        ?><span class="title">平米単価</span><input name="i-meter"><?php
                        break;
                }
                ?>
            </label>
        </div>
    </fieldset>
<?php
}
add_action( 'quick_edit_custom_box', 'display_my_custom_quickedit', 10, 2 );


function my_admin_edit_foot() {
    global $post_type;
    $slug = 'flooring'; //他の一覧ページで動作しないように投稿タイプの指定をする

    if ( $post_type == $slug ) {
        echo '<script type="text/javascript" src="', get_stylesheet_directory_uri() .'/js/admin_edit.js', '"></script>';
    }
}
add_action('admin_footer-edit.php', 'my_admin_edit_foot');


function save_custom_meta( $post_id ) {
    $slug = 'flooring'; //カスタムフィールドの保存処理をしたい投稿タイプを指定

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

    if ( isset( $_REQUEST['i-case'] ) ) {
        update_post_meta( $post_id, 'i-case', $_REQUEST['i-case'] );
    }

    if ( isset( $_REQUEST['i-meter'] ) ) {
        update_post_meta( $post_id, 'i-meter', $_REQUEST['i-meter'] );
    }

}
add_action( 'save_post', 'save_custom_meta' );

function my_mwform_value( $value, $name ) {
    // $_GET['hoge']があったら、name属性がhogeの項目の初期値に設定
    if ( $name === 's1i' && !empty( $_GET['s1i'] ) && !is_array( $_GET['s1i'] ) ) {
        return $_GET['s1i'];
    }
    if ( $name === 's1n' && !empty( $_GET['s1n'] ) && !is_array( $_GET['s1n'] ) ) {
        return $_GET['s1n'];
    }
    if ( $name === 's2i' && !empty( $_GET['s2i'] ) && !is_array( $_GET['s2i'] ) ) {
        return $_GET['s2i'];
    }
    if ( $name === 's2n' && !empty( $_GET['s2n'] ) && !is_array( $_GET['s2n'] ) ) {
        return $_GET['s2n'];
    }
    if ( $name === 's3i' && !empty( $_GET['s3i'] ) && !is_array( $_GET['s3i'] ) ) {
        return $_GET['s3i'];
    }
    if ( $name === 's3n' && !empty( $_GET['s3n'] ) && !is_array( $_GET['s3n'] ) ) {
        return $_GET['s3n'];
    }

    return $value;
}
 
// 管理画面で作成したフォームの場合、フック名の後のフォーム識別子は「mw-wp-form-xxx」
add_filter( 'mwform_value_mw-wp-form-41', 'my_mwform_value', 10, 2 );

function my_mwform_value_c( $value, $name ) {
    // $_GET['hoge']があったら、name属性がhogeの項目の初期値に設定
    if ( $name === 's1i' && !empty( $_GET['s1i'] ) && !is_array( $_GET['s1i'] ) ) {
        return $_GET['s1i'];
    }
    if ( $name === 's1n' && !empty( $_GET['s1n'] ) && !is_array( $_GET['s1n'] ) ) {
        return $_GET['s1n'];
    }

    return $value;
}
 
// 管理画面で作成したフォームの場合、フック名の後のフォーム識別子は「mw-wp-form-xxx」
add_filter( 'mwform_value_mw-wp-form-152', 'my_mwform_value_c', 10, 2 );

function my_mwform_value_i( $value, $name ) {
    // $_GET['hoge']があったら、name属性がhogeの項目の初期値に設定
    if ( $name === 's1i' && !empty( $_GET['s1i'] ) && !is_array( $_GET['s1i'] ) ) {
        return $_GET['s1i'];
    }
    if ( $name === 's1n' && !empty( $_GET['s1n'] ) && !is_array( $_GET['s1n'] ) ) {
        return $_GET['s1n'];
    }

    return $value;
}
 
// 管理画面で作成したフォームの場合、フック名の後のフォーム識別子は「mw-wp-form-xxx」
add_filter( 'mwform_value_mw-wp-form-168', 'my_mwform_value_i', 10, 2 );







function unSession() {
	unset($_SESSION['sample']);
	return "削除";
}
add_shortcode('sampledel', 'unSession');



//郵便番号→住所
function ajaxzip3_scripts() {
    wp_enqueue_script( 'ajaxzip3-script', get_template_directory_uri().'/js/ajaxzip3.js', array( 'jquery' ), '20160508', true );
}
add_action( 'wp_enqueue_scripts', 'ajaxzip3_scripts' );

//最後に必ず入れてね
require_once locate_template('lib/data-taxonomy.php'); 
//ここまで


/**
 * pagination
 * http://design.sparklette.net/teaches/how-to-add-wordpress-pagination-without-a-plugin/
 */
function pagination($pages, $range) {
  $showitems = ($range * 2)+1;
  global $paged;
  if(empty($paged)) $paged = 1;
 
  if($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages) {
      $pages = 1;
    }
  }

  if(1 != $pages) {
    echo "<ul class=\"pagination\">\n<li class=\"disabled\"><a href=\"#\">".$paged." of ".$pages."</a></li>\n";
    if($paged > 2 && $paged > $range+1 && $showitems < $pages) {
      echo "<li><a href='".get_pagenum_link(1)."'>« First</a></li>\n";
    }
    if($paged > 1 && $showitems < $pages) {
      echo "<li><a href='".get_pagenum_link($paged - 1)."'>‹ Previous</a></li>\n";
    }

    for ($i=1; $i <= $pages; $i++) {
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
        if ($paged == $i) {
          echo "<li class=\"disabled\"><a href=\"#\">".$i."</a></li>\n";
        } else {
          echo "<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>\n";
        }
      }
    }

    if ($paged < $pages && $showitems < $pages) {
      echo "<li><a href=\"".get_pagenum_link($paged + 1)."\">Next ›</a></li>\n";
    }
    if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
      echo "<li><a href='".get_pagenum_link($pages)."'>Last »</a></li>\n";
    }
    echo "</ul>\n";
  }
}


function bootstrap_pagination($range){
  global $wp_query;
  $paged = $wp_query->get( 'paged' );
  $posts_per_page = get_option('posts_per_page');
  if ( ( ! $paged || $paged < 2 ) && $wp_query->found_posts < $posts_per_page )
      return; 
   
  //$range = 2;//表示件数の指定
  $showitems = ($range * 2)+1;
   
  global $paged;
  if(empty($paged)) $paged = 1;
   
  if($pages == ''){
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages){
      $pages = 1;
    }
  }
   
  if(1 != $pages){
    echo '<ul class="pagination">';
if(!is_mobile())  echo '<li class="disabled"><a href="#">'.$paged.' / '.$pages.'</a></li>';

    if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
    if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";
 
    for ($i=1; $i <= $pages; $i++){
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
        echo ($paged == $i)? "<li class='active'><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
      }
    }
 
    if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
    if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
    echo "</ul>\n";

  }
}

/*
function change_posts_per_page($query) {
 if( is_admin() || ! $query->is_main_query() ){
     return;
 }
 
 if ( $query->is_search() ) {
     $query->set( 'posts_per_page', '5' );
     return;
 }
 
}
add_action( 'pre_get_posts', 'change_posts_per_page' );
*/

/* 投稿内で [home_url] と記述する */
function shortcode_homeurl() {
    return home_url();
}
add_shortcode('home_url', 'shortcode_homeurl');


/* 投稿内で [wp_url] と記述する */
function shortcode_wpurl() {
    return site_url();
}
add_shortcode('wp_url', 'shortcode_wpurl');

