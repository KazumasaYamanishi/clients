<?php

// ==================================================
//
//	特定ユーザーごとに管理メニューを隠す
//
// ==================================================
function remove_menus(){
	if( !current_user_can('level_10') ) {
		remove_menu_page( 'edit-comments.php' );			// コメント
		remove_menu_page( 'tools.php' );					// ツール
		remove_menu_page( 'edit.php?post_type=hospital' );	// 病院
		remove_menu_page( 'edit.php?post_type=care' );		// 介護
		remove_menu_page( 'edit.php?post_type=housing' );	// 家づくり
		remove_menu_page( 'edit.php?post_type=bridal' );	// ブライダル
	}
}
add_action( 'admin_menu', 'remove_menus' );

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
//	CSSファイルを読み込む
//
// ==================================================
	function my_admin_style(){
		wp_enqueue_style( 'my_admin_style', '//fonts.googleapis.com/earlyaccess/notosansjp.css' );
	}
	add_action( 'admin_enqueue_scripts', 'my_admin_style' );
// ==================================================
//
//	カスタムメニュー
//
// ==================================================
	register_nav_menu( 'g_menu1', 'グローバルナビ1' );
	register_nav_menu( 'g_menu_info', 'インフォメーションなど' );
	register_nav_menu( 'g_menu_company', '主に固定ページメニュー' );
	register_nav_menu( 'gnav-pc', 'グローバルナビPC' );
	register_nav_menu( 'f_menu', 'フッターメニュー' );
	register_nav_menu( 'g_menu_sp', 'スマホメニュー' );
	add_theme_support( 'menus' );
// ==================================================
//
//	アイキャッチ画像を使えるようにする
//
// ==================================================
	add_theme_support( 'post-thumbnails' );
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
			'name' 			=> __( '広告エリア' ),
			'id' 			=> 'kokoku_widget',
			'before_widget' => '<li class="widget-container kokoku_widget">',
			'after_widget' 	=> '</li>',
			'before_title' 	=> '<h3 class="kokoku_widget">',
			'after_title' 	=> '</h3>',
		));
		register_sidebar( array(
			'name' 			=> __( '人気の記事' ),
			'id' 			=> 'ppost_widget',
			'before_widget' => '<li class="widget-container ppost_widget">',
			'after_widget' 	=> '</li>',
			'before_title' 	=> '<h3 class="ppost_widget">',
			'after_title' 	=> '</h3>',
		));
		register_sidebar( array(
			'name' 			=> __( '新着記事' ),
			'id' 			=> 'rentry_widget',
			'before_widget' => '<li class="widget-container rentry_widget">',
			'after_widget' 	=> '</li>',
			'before_title' 	=> '<h3 class="rentry_widget">',
			'after_title' 	=> '</h3>',
		));
		register_sidebar( array(
			'name' 			=> __( 'カテゴリー' ),
			'id' 			=> 'category_widget',
			'before_widget' => '<li class="widget-container category_widget">',
			'after_widget' 	=> '</li>',
			'before_title' 	=> '<h3 class="category_widget">',
			'after_title' 	=> '</h3>',
		));
		register_sidebar( array(
			'name' 			=> __( 'キーワード検索' ),
			'id' 			=> 'search_widget',
			'before_widget' => '<li class="widget-container search_widget">',
			'after_widget' 	=> '</li>',
			'before_title' 	=> '<h3 class="search_widget">',
			'after_title' 	=> '</h3>',
		));
		register_sidebar( array(
			'name' 			=> __( 'エディタについて' ),
			'id' 			=> 'about_widget',
			'before_widget' => '<li class="widget-container about_widget">',
			'after_widget' 	=> '</li>',
			'before_title' 	=> '<h3 class="about_widget">',
			'after_title' 	=> '</h3>',
		));
		register_sidebar( array(
			'name' 			=> __( 'Side Widget' ),
			'id' 			=> 'side-widget',
			'before_widget' => '<li class="widget-container">',
			'after_widget' 	=> '</li>',
			'before_title' 	=> '<h3>',
			'after_title' 	=> '</h3>',
		));
		// フッターエリアのウィジェット
		register_sidebar( array(
			'name' 			=> __( 'Footer Widget' ),
			'id' 			=> 'footer-widget',
			'before_widget' => '<div class="widget-area"><ul><li class="widget-container">',
			'after_widget' 	=> '</li></ul></div>',
			'before_title' 	=> '<h3>',
			'after_title' 	=> '</h3>',
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
//	検索キーワードに何も入れなくてもsearch.phpを表示させる
//
// ==================================================
function search_no_keywords() {
if (isset($_GET['s']) && empty($_GET['s'])) {
include(TEMPLATEPATH . '/search.php');
exit;
}
}
add_action('template_redirect', 'search_no_keywords');
// ==================================================
//
//	オリジナルのページャー
//
// ==================================================
function paging( $limit, $page, $disp ) {

	// $dispはページ番号の表示数
	$next = $page + 1;
	$prev = $page - 1;

	// ページ番号リンク用
	$start 	= ( $page - floor( $disp / 2 ) > 0 ) ? ( $page - floor( $disp / 2 ) ) : 1;	// 始点
	$end 	= ( $start > 1 ) ? ( $page + floor( $disp / 2 ) ) : $disp;					// 終点
	$start 	= ( $limit < $end ) ? $start - ( $end - $limit ) : $start;					//始点再計算

	if($page != 1 ) {
		print '<li><a href="?page=' . $prev . '"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>';
	}

	// 最初のページへのリンク
	if( $start >= floor( $disp / 2 ) ) {
		// print '<a href="?page=1">1</a>';
		if( $start > floor( $disp / 2 ) ) print "...";									//ドットの表示
	}

	// ページリンク表示ループ
	for( $i = $start; $i <= $end; $i++ ) {

		$class = ( $page == $i ) ? ' class="active"' : "";//現在地を表すCSSクラス

		// 1以上最大ページ数以下の場合
		if( $i <= $limit && $i > 0 ) {
			print '<li' . $class . '><a href="?page=' . $i . '">' . $i . '</a></li>';
		}

	}

	// 最後のページへのリンク
	if( $limit > $end ) {
		if( $limit - 1 > $end ) print "...";
		print '<li><a href="?page=' . $limit . '">' . $limit . '</a></li>';
	}

	if( $page < $limit ) {
		print '<li><a href="?page=' . $next . '"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>';
	}

	/*確認用
	print "<p>current:".$page."<br>";
	print "next:".$next."<br>";
	print "prev:".$prev."<br>";
	print "limit:".$limit."<br>";
	print "start:".$start."<br>";
	print "end:".$end."</p>";*/

}

























// ==================================================
//
//	変数 ajaxurl に WordPress の Ajax のリンクを代入
//
// ==================================================
function add_my_ajaxurl() { ?>
	<script>
		var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
	</script>
<?php }
add_action( 'wp_head', 'add_my_ajaxurl', 1 );
// ==================================================
//
//	並べ替え - グルメ
//
// ==================================================
function extraGourmetAjax(){

	// JSから受け渡しするデータ
	$extra = $_POST['selectKey'];

	if ( $extra === 'default' ) {
		$selectKey 		= 'member-status';
		$selectValue 	= '';
	} elseif ( $extra === 'keyword-c' ) {
		$selectKey 		= 'keywords';
		$selectValue 	= 'クーポン付き';
	} elseif ( $extra === 'keyword-l' ) {
		$selectKey 		= 'keywords';
		$selectValue 	= 'ランチあり';
	} elseif ( $extra === 'area-kagoshima' ) {
		$selectKey 		= 'area-kagoshima';
		$selectValue 	= array('鹿児島市全域','天文館周辺','鹿児島中央駅周辺','鹿児島市役所周辺','城南町〜泉町周辺','鹿児島駅周辺','吉野町周辺','草牟田・伊敷周辺','荒田周辺','鴨池・与次郎周辺','紫原・桜ヶ丘周辺','新栄町・宇宿周辺','中山周辺','谷山・平川町周辺','鹿児島市郊外全般');
	} elseif ( $extra === 'area-aira' ) {
		$selectKey 		= 'area-aira';
		$selectValue 	= '';
	} elseif ( $extra === 'area-kirishima' ) {
		$selectKey 		= 'area-kirishima';
		$selectValue 	= '';
	} elseif ( $extra === 'area-hokusatsu' ) {
		$selectKey 		= 'area-hokusatsu';
		$selectValue 	= '';
	} elseif ( $extra === 'area-nakasatsu' ) {
		$selectKey 		= 'area-nakasatsu';
		$selectValue 	= '';
	} elseif ( $extra === 'area-nansatsu' ) {
		$selectKey 		= 'area-nansatsu';
		$selectValue 	= '';
	} elseif ( $extra === 'area-osumi' ) {
		$selectKey 		= 'area-osumi';
		$selectValue 	= '';
	} elseif ( $extra === 'area-rito' ) {
		$selectKey 		= 'area-rito';
		$selectValue 	= '';
	}

	// JSON配列の初期化
	$returnObj = array();

	// 抽出用の配列作成
	$args = array(
		'post_type' 	=> 'gourmet',
		'post_status' 	=> 'publish',
		'orderby' 		=> 'meta_value',
		'order' 		=> 'DESC',
		'meta_key' 		=> 'member-status',
		'meta_query' => array(
			array(
					'key' => $selectKey,
				),
		),
	);
	$the_query = new WP_Query( $args );

	$i = 0;

	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$returnObj[$i]['post_title'] = get_the_title();
		// *** 会員ステータスのチェック
		$returnObj[$i]['post_member'] = post_custom('member-status');
		// *** アイキャッチ画像のチェック
		if ( has_post_thumbnail() ) {
			$image_id = get_post_thumbnail_id ();
			$image_url = wp_get_attachment_image_src ($image_id, true);
			$returnObj[$i]['post_eyecatch'] = $image_url[0];
		} else {
			$returnObj[$i]['post_eyecatch'] = get_bloginfo( 'template_directory' ) . '/img/thumbnail.png';
		}
		// *** クーポン判定
		global $wpdb;
		$query 	= "SELECT meta_id,post_id,meta_key,meta_value FROM $wpdb->postmeta WHERE post_id = $post->ID ORDER BY meta_id ASC";
		$cf 	= $wpdb->get_results($query, ARRAY_A);
		foreach( $cf as $row ){
			if( $row['meta_key'] == "coupon-name" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponName, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-introduction" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponIntroduction, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-attention" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponAttention, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-day" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponDay, $row['meta_value'] );
				}
			}
		}
		$lengthCoupon = count ( $couponName );
		if ( $lengthCoupon > 0 ) {
			$returnObj[$i]['post_coupon_src'] = get_template_directory_uri() . '/img/icon-q.png';
		}
		// *** 有料会員判定
		if ( post_custom('member-status') == '有料' ) {
			$returnObj[$i]['post_member_src'] = get_template_directory_uri() . '/img/icon-good.png';
		}
		// *** エリア
		if ( post_custom('area-kagoshima') ) 	$returnObj[$i]['post_area'] = '鹿児島市エリア';
		if ( post_custom('area-aira') ) 		$returnObj[$i]['post_area'] = '姶良市エリア';
		if ( post_custom('area-kirishima') ) 	$returnObj[$i]['post_area'] = '霧島エリア';
		if ( post_custom('area-hokusatsu') ) 	$returnObj[$i]['post_area'] = '北薩エリア';
		if ( post_custom('area-nakasatsu') ) 	$returnObj[$i]['post_area'] = '中薩エリア';
		if ( post_custom('area-nansatsu') ) 	$returnObj[$i]['post_area'] = '南薩エリア';
		if ( post_custom('area-osumi') ) 		$returnObj[$i]['post_area'] = '大隅エリア';
		if ( post_custom('area-rito') ) 		$returnObj[$i]['post_area'] = '離島エリア';
		// *** ジャンル
		$returnObj[$i]['post_genre'] = post_custom('genre');
		// *** キーワード
		$returnObj[$i]['post_keywords'] = post_custom('keywords');
		// *** リンク
		$returnObj[$i]['post_link'] = get_the_permalink();
		$i++;
	endwhile;
	endif;

	// JSON形式に出力
	echo json_encode( $returnObj );
	die();
}
add_action( "wp_ajax_extraGourmetAjax" , "extraGourmetAjax" );
add_action( "wp_ajax_nopriv_extraGourmetAjax" , "extraGourmetAjax" );
// ==================================================
//
//	並べ替え - ビューティー＆ヘルス
//
// ==================================================
function extraBeautyAjax(){

	// JSから受け渡しするデータ
	$extra = $_POST['selectKey'];

	if ( $extra === 'default' ) {
		$selectKey 		= 'member-status-beauty';
		$selectValue 	= '';
	} elseif ( $extra === 'area-kagoshima-beauty' ) {
		$selectKey 		= 'area-kagoshima-beauty';
		$selectValue 	= '';
	} elseif ( $extra === 'area-aira-beauty' ) {
		$selectKey 		= 'area-aira-beauty';
		$selectValue 	= '';
	} elseif ( $extra === 'area-kirishima-beauty' ) {
		$selectKey 		= 'area-kirishima-beauty';
		$selectValue 	= '';
	} elseif ( $extra === 'area-hokusatsu-beauty' ) {
		$selectKey 		= 'area-hokusatsu-beauty';
		$selectValue 	= '';
	} elseif ( $extra === 'area-nakasatsu-beauty' ) {
		$selectKey 		= 'area-nakasatsu-beauty';
		$selectValue 	= '';
	} elseif ( $extra === 'area-nansatsu-beauty' ) {
		$selectKey 		= 'area-nansatsu-beauty';
		$selectValue 	= '';
	} elseif ( $extra === 'area-osumi-beauty' ) {
		$selectKey 		= 'area-osumi-beauty';
		$selectValue 	= '';
	} elseif ( $extra === 'area-rito-beauty' ) {
		$selectKey 		= 'area-rito-beauty';
		$selectValue 	= '';
	}

	// JSON配列の初期化
	$returnObj = array();

	// 抽出用の配列作成
	$args = array(
		'post_type' 	=> 'beauty',
		'post_status' 	=> 'publish',
		'orderby' 		=> 'meta_value',
		'order' 		=> 'DESC',
		'meta_key' 		=> 'member-status-beauty',
		'meta_query' => array(
			array(
					'key' => $selectKey,
				),
		),
	);
	$the_query = new WP_Query( $args );

	$i = 0;

	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$returnObj[$i]['post_title'] = get_the_title();
		// *** 会員ステータスのチェック
		$returnObj[$i]['post_member'] = post_custom('member-status-beauty');
		// *** アイキャッチ画像のチェック
		if ( has_post_thumbnail() ) {
			$image_id = get_post_thumbnail_id ();
			$image_url = wp_get_attachment_image_src ($image_id, true);
			$returnObj[$i]['post_eyecatch'] = $image_url[0];
		} else {
			$returnObj[$i]['post_eyecatch'] = get_bloginfo( 'template_directory' ) . '/img/thumbnail.png';
		}
		// *** クーポン判定
		global $wpdb;
		$query 	= "SELECT meta_id,post_id,meta_key,meta_value FROM $wpdb->postmeta WHERE post_id = $post->ID ORDER BY meta_id ASC";
		$cf 	= $wpdb->get_results($query, ARRAY_A);
		foreach( $cf as $row ){
			if( $row['meta_key'] == "coupon-name-beauty" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponName, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-introduction-beauty" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponIntroduction, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-condition-beauty" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponCondition, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-attention-beauty" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponAttention, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-day-beauty" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponDay, $row['meta_value'] );
				}
			}
		}
		$lengthCoupon = count ( $couponName );
		if ( $lengthCoupon > 0 ) {
			$returnObj[$i]['post_coupon_src'] = get_template_directory_uri() . '/img/icon-q.png';
		}
		// *** 有料会員判定
		if ( post_custom('member-status') == '有料' ) {
			$returnObj[$i]['post_member_src'] = get_template_directory_uri() . '/img/icon-good.png';
		}
		// *** エリア
		if ( post_custom('area-kagoshima-beauty') ) 	$returnObj[$i]['post_area'] = '鹿児島市エリア';
		if ( post_custom('area-aira-beauty') ) 			$returnObj[$i]['post_area'] = '姶良市エリア';
		if ( post_custom('area-kirishima-beauty') ) 	$returnObj[$i]['post_area'] = '霧島エリア';
		if ( post_custom('area-hokusatsu-beauty') ) 	$returnObj[$i]['post_area'] = '北薩エリア';
		if ( post_custom('area-nakasatsu-beauty') ) 	$returnObj[$i]['post_area'] = '中薩エリア';
		if ( post_custom('area-nansatsu-beauty') ) 		$returnObj[$i]['post_area'] = '南薩エリア';
		if ( post_custom('area-osumi-beauty') ) 		$returnObj[$i]['post_area'] = '大隅エリア';
		if ( post_custom('area-rito-beauty') ) 			$returnObj[$i]['post_area'] = '離島エリア';
		// *** ジャンル
		$returnObj[$i]['post_genre'] = post_custom('genre-beauty');
		// *** リンク
		$returnObj[$i]['post_link'] = get_the_permalink();
		$i++;
	endwhile;
	endif;

	// JSON形式に出力
	echo json_encode( $returnObj );
	die();
}
add_action( "wp_ajax_extraBeautyAjax" , "extraBeautyAjax" );
add_action( "wp_ajax_nopriv_extraBeautyAjax" , "extraBeautyAjax" );
// ==================================================
//
//	並べ替え - 温泉
//
// ==================================================
function extraHotspringsAjax(){

	// JSから受け渡しするデータ
	$extra = $_POST['selectKey'];

	if ( $extra === 'default' ) {
		$selectKey 		= 'member-status-hotsprings';
		$selectValue 	= '';
	} elseif ( $extra === 'area-kirishima-hotsprings' ) {
		$selectKey 		= 'area-kirishima-hotsprings';
		$selectValue 	= '';
	} elseif ( $extra === 'area-nakasatsu-hotsprings' ) {
		$selectKey 		= 'area-nakasatsu-hotsprings';
		$selectValue 	= '';
	} elseif ( $extra === 'area-kagoshima-hotsprings' ) {
		$selectKey 		= 'area-kagoshima-hotsprings';
		$selectValue 	= '';
	} elseif ( $extra === 'area-osumi-hotsprings' ) {
		$selectKey 		= 'area-osumi-hotsprings';
		$selectValue 	= '';
	} elseif ( $extra === 'area-ibusuki-hotsprings' ) {
		$selectKey 		= 'area-ibusuki-hotsprings';
		$selectValue 	= '';
	} elseif ( $extra === 'area-nansatsu-hotsprings' ) {
		$selectKey 		= 'area-nansatsu-hotsprings';
		$selectValue 	= '';
	} elseif ( $extra === 'area-satsuma-hotsprings' ) {
		$selectKey 		= 'area-satsuma-hotsprings';
		$selectValue 	= '';
	} elseif ( $extra === 'area-rito-hotsprings' ) {
		$selectKey 		= 'area-rito-hotsprings';
		$selectValue 	= '';
	}

	// JSON配列の初期化
	$returnObj = array();

	// 抽出用の配列作成
	$args = array(
		'post_type' 	=> 'hotsprings',
		'post_status' 	=> 'publish',
		'orderby' 		=> 'meta_value',
		'order' 		=> 'DESC',
		'meta_key' 		=> 'member-status-hotsprings',
		'meta_query' => array(
			array(
					'key' => $selectKey,
				),
		),
	);
	$the_query = new WP_Query( $args );

	$i = 0;

	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$returnObj[$i]['post_title'] = get_the_title();
		// *** 会員ステータスのチェック
		$returnObj[$i]['post_member'] = post_custom('member-status-hotsprings');
		// *** アイキャッチ画像のチェック
		if ( has_post_thumbnail() ) {
			$image_id = get_post_thumbnail_id ();
			$image_url = wp_get_attachment_image_src ($image_id, true);
			$returnObj[$i]['post_eyecatch'] = $image_url[0];
		} else {
			$returnObj[$i]['post_eyecatch'] = get_bloginfo( 'template_directory' ) . '/img/thumbnail.png';
		}
		// *** クーポン判定
		global $wpdb;
		$query 	= "SELECT meta_id,post_id,meta_key,meta_value FROM $wpdb->postmeta WHERE post_id = $post->ID ORDER BY meta_id ASC";
		$cf 	= $wpdb->get_results($query, ARRAY_A);
		foreach( $cf as $row ){
			if( $row['meta_key'] == "coupon-name-hotsprings" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponName, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-introduction-hotsprings" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponIntroduction, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-condition-hotsprings" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponCondition, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-attention-hotsprings" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponAttention, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-day-hotsprings" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponDay, $row['meta_value'] );
				}
			}
		}
		$lengthCoupon = count ( $couponName );
		if ( $lengthCoupon > 0 ) {
			$returnObj[$i]['post_coupon_src'] = get_template_directory_uri() . '/img/icon-q.png';
		}
		// *** 有料会員判定
		if ( post_custom('member-status') == '有料' ) {
			$returnObj[$i]['post_member_src'] = get_template_directory_uri() . '/img/icon-good.png';
		}
		// *** エリア
		if ( post_custom('area-kirishima-hotsprings') ) 	$returnObj[$i]['post_area'] = '霧島市エリア';
		if ( post_custom('area-nakasatsu-hotsprings') ) 			$returnObj[$i]['post_area'] = '中薩エリア';
		if ( post_custom('area-kagoshima-hotsprings') ) 	$returnObj[$i]['post_area'] = '鹿児島市エリア';
		if ( post_custom('area-osumi-hotsprings') ) 	$returnObj[$i]['post_area'] = '大隅エリア';
		if ( post_custom('area-ibusuki-hotsprings') ) 	$returnObj[$i]['post_area'] = '指宿市エリア';
		if ( post_custom('area-nansatsu-hotsprings') ) 		$returnObj[$i]['post_area'] = '南薩エリア';
		if ( post_custom('area-satsuma-hotsprings') ) 		$returnObj[$i]['post_area'] = '薩摩川内市エリア';
		if ( post_custom('area-rito-hotsprings') ) 			$returnObj[$i]['post_area'] = '北薩エリア';
		// *** ジャンル
		$returnObj[$i]['post_genre'] = post_custom('keywords-hotsprings');
		// *** リンク
		$returnObj[$i]['post_link'] = get_the_permalink();
		$i++;
	endwhile;
	endif;

	// JSON形式に出力
	echo json_encode( $returnObj );
	die();
}
add_action( "wp_ajax_extraHotspringsAjax" , "extraHotspringsAjax" );
add_action( "wp_ajax_nopriv_extraHotspringsAjax" , "extraHotspringsAjax" );




























// ==================================================
//
//	並べ替え - アーカイブ - グルメ
//
// ==================================================
	function change_posts_query( $query ) {
		/* 管理画面,メインクエリに干渉しないために必須 */
		if( is_admin() || ! $query->is_main_query() ){
			return;
		}
		if( $query->is_post_type_archive( 'gourmet' ) ) {
			// $query->set('meta_key', 'gourmet-rand');
			// $query->set('meta_key', 'member-status');
			// $query->set('orderby', array('member-status' => 'DESC', 'gourmet-rand' => 'ASC') );
			// $query->set('orderby', array('member-status' => 'DESC') );
			// orderby に orderby => order 形式の配列で条件と並び順を渡してあげればOK
			// $query->set('orderby', array('meta_value_num' => 'ASC', 'date' => 'DESC') );
			// order は不要
			// $query->set('order', 'DESC');
			$meta_query = array(
				'status_id' => array(
						'key' => 'member-status',
						'type' => 'CHAR',
					),
				'gourmet_id' => array(
						'key' => 'gourmet-rand',
						'type' => 'NUMERIC',
					),
			);
			$orderby = array(
				'status_id' => 'DESC',
				'gourmet_id' => 'ASC',
			);
			$query->set('meta_query', $meta_query);
			$query->set('orderby', $orderby);
		}
		if( $query->is_post_type_archive( 'beauty' ) ) {
			// $query->set('meta_key', 'beauty-rand');
			// $query->set('meta_key', 'member-status');
			// $query->set('orderby', array('member-status' => 'DESC', 'beauty-rand' => 'ASC') );
			// $query->set('orderby', array('member-status' => 'DESC') );
			// orderby に orderby => order 形式の配列で条件と並び順を渡してあげればOK
			// $query->set('orderby', array('meta_value_num' => 'ASC', 'date' => 'DESC') );
			// order は不要
			// $query->set('order', 'DESC');
			$meta_query = array(
				'status_id' => array(
						'key' => 'member-status-beauty',
						'type' => 'CHAR',
					),
				'beauty_id' => array(
						'key' => 'beauty-rand',
						'type' => 'NUMERIC',
					),
			);
			$orderby = array(
				'status_id' => 'DESC',
				'beauty_id' => 'ASC',
			);
			$query->set('meta_query', $meta_query);
			$query->set('orderby', $orderby);
		}
		if( $query->is_post_type_archive( 'hotsprings' ) ) {
			// $query->set('meta_key', 'hotsprings-rand');
			// $query->set('meta_key', 'member-status');
			// $query->set('orderby', array('member-status' => 'DESC', 'hotsprings-rand' => 'ASC') );
			// $query->set('orderby', array('member-status' => 'DESC') );
			// orderby に orderby => order 形式の配列で条件と並び順を渡してあげればOK
			// $query->set('orderby', array('meta_value_num' => 'ASC', 'date' => 'DESC') );
			// order は不要
			// $query->set('order', 'DESC');
			$meta_query = array(
				'status_id' => array(
						'key' => 'member-status-hotsprings',
						'type' => 'CHAR',
					),
				'hotsprings_id' => array(
						'key' => 'hotsprings-rand',
						'type' => 'NUMERIC',
					),
			);
			$orderby = array(
				'status_id' => 'DESC',
				'hotsprings_id' => 'ASC',
			);
			$query->set('meta_query', $meta_query);
			$query->set('orderby', $orderby);
		}
	}
	add_action('pre_get_posts', 'change_posts_query');



	// img srcset 無効化
	add_filter( 'wp_calculate_image_srcset', '__return_false' );






?>