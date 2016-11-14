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
		$selectKey 		= '';
		$selectValue 	= '';
	} elseif ( $extra === 'keyword-c' ) {
		$selectKey 		= 'keywords';
		$selectValue 	= 'クーポン付き';
	} elseif ( $extra === 'keyword-l' ) {
		$selectKey 		= 'keywords';
		$selectValue 	= 'ランチあり';
	} elseif ( $extra === 'area-kagoshima' ) {
		$selectKey 		= 'area-kagoshima';
		$selectValue 	= '';
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

	// **************************************************
	// 抽出用の配列作成（有料会員）
	// **************************************************
	$argsAjax = array(
		'post_type' 		=> 'gourmet',
		'post_status' 		=> 'publish',
		'posts_per_page' 	=> -1,
		'meta_query' => array(
			'relation' => 'AND',
				array(
					'key' 		=> 'member-status',
					'value' 	=> '有料',
					'compare' 	=> '=',
				),
				array(
					'key' 		=> $selectKey,
					'value' 	=> $selectValue,
					'compare' 	=> '=',
				)
		),
	);
	$ajax_query = new WP_Query( $argsAjax );
	if ( $ajax_query->have_posts() ) :
	while ( $ajax_query->have_posts() ) : $ajax_query->the_post();



					// ソート時に使用する乱数（ ランダムの数値を作成 1～5,000 ）・記事ID
					// --------------------------------------------------
					$randNum = 'Y-' . mt_rand( 1, 5000 ) . '-' . get_the_ID();

					// 店名（タイトル）
					// --------------------------------------------------
					$returnObj[$randNum]['name'] = get_the_title();

					// パーマリンク
					// --------------------------------------------------
					$returnObj[$randNum]['link'] = get_the_permalink();

					// アイキャッチ画像
					// --------------------------------------------------
					if ( has_post_thumbnail() ) {
						$image_id 	= get_post_thumbnail_id ();
						$image_url 	= wp_get_attachment_image_src ($image_id, true);
						$returnObj[$randNum]['eyecatch'] = $image_url[0];
					} else {
						$returnObj[$randNum]['eyecatch'] = get_template_directory_uri() . '/img/thumbnail.png';
					}

					// ジャンル
					// --------------------------------------------------
					if ( post_custom( 'genre' ) ) {
						if ( is_array( post_custom( 'genre' ) ) ) {
							$returnObj[$randNum]['genre'] 		= post_custom( 'genre' );
						} else {
							$returnObj[$randNum]['genre'][0] 	= post_custom( 'genre' );
						}
					} else {
						$returnObj[$randNum]['genre'] 			= '';
					}

					// エリア
					// --------------------------------------------------
					$areaKagoshima 	= post_custom('area-kagoshima'); 	// 鹿児島市エリア
					$areaAira 		= post_custom('area-aira'); 		// 姶良エリア
					$areaKirishima 	= post_custom('area-kirishima'); 	// 霧島エリア
					$areaHokusatsu 	= post_custom('area-hokusatsu'); 	// 北薩エリア
					$areaNakasatsu 	= post_custom('area-nakasatsu'); 	// 中薩エリア
					$areaNansatsu 	= post_custom('area-nansatsu'); 	// 南薩エリア
					$areaOsumi 		= post_custom('area-osumi'); 		// 大隅エリア
					$areaRito 		= post_custom('area-rito'); 		// 離島エリア
					if ( $areaKagoshima ) {
						if ( is_array ( $areaKagoshima ) ) {
							$returnObj[$randNum]['area']['kagoshima'] 		= $areaKagoshima;
						} else {
							$returnObj[$randNum]['area']['kagoshima'][0] 	= $areaKagoshima;
						}
					} else {
						$returnObj[$randNum]['area']['kagoshima'] 			= '';
					}
					if ( $areaAira ) {
						if ( is_array ( $areaAira ) ) {
							$returnObj[$randNum]['area']['aira'] 			= $areaAira;
						} else {
							$returnObj[$randNum]['area']['aira'][0] 		= $areaAira;
						}
					} else {
						$returnObj[$randNum]['area']['aira'] 				= '';
					}
					if ( $areaKirishima ) {
						if ( is_array ( $areaKirishima ) ) {
							$returnObj[$randNum]['area']['kirishima'] 		= $areaKirishima;
						} else {
							$returnObj[$randNum]['area']['kirishima'][0] 	= $areaKirishima;
						}
					} else {
						$returnObj[$randNum]['area']['kirishima'] 			= '';
					}
					if ( $areaHokusatsu ) {
						if ( is_array ( $areaHokusatsu ) ) {
							$returnObj[$randNum]['area']['hokusatsu'] 		= $areaHokusatsu;
						} else {
							$returnObj[$randNum]['area']['hokusatsu'][0] 	= $areaHokusatsu;
						}
					} else {
						$returnObj[$randNum]['area']['hokusatsu'] 			= '';
					}
					if ( $areaNakasatsu ) {
						if ( is_array ( $areaNakasatsu ) ) {
							$returnObj[$randNum]['area']['nakasatsu'] 		= $areaNakasatsu;
						} else {
							$returnObj[$randNum]['area']['nakasatsu'][0] 	= $areaNakasatsu;
						}
					} else {
						$returnObj[$randNum]['area']['nakasatsu'] 			= '';
					}
					if ( $areaNansatsu ) {
						if ( is_array ( $areaNansatsu ) ) {
							$returnObj[$randNum]['area']['nansatsu'] 		= $areaNansatsu;
						} else {
							$returnObj[$randNum]['area']['nansatsu'][0] 	= $areaNansatsu;
						}
					} else {
						$returnObj[$randNum]['area']['nansatsu'] 			= '';
					}
					if ( $areaOsumi ) {
						if ( is_array ( $areaOsumi ) ) {
							$returnObj[$randNum]['area']['osumi'] 			= $areaOsumi;
						} else {
							$returnObj[$randNum]['area']['osumi'][0] 		= $areaOsumi;
						}
					} else {
						$returnObj[$randNum]['area']['osumi'] 				= '';
					}
					if ( $areaRito ) {
						if ( is_array ( $areaRito ) ) {
							$returnObj[$randNum]['area']['rito'] 			= $areaRito;
						} else {
							$returnObj[$randNum]['area']['rito'][0] 		= $areaRito;
						}
					} else {
						$returnObj[$randNum]['area']['rito'] 				= '';
					}

					// キーワード
					// --------------------------------------------------
					if ( post_custom( 'keywords' ) ) {
						if ( is_array( post_custom( 'keywords' ) ) ) {
							$returnObj[$randNum]['keywords'] 	= post_custom( 'keywords' );
						} else {
							$returnObj[$randNum]['keywords'][0] = post_custom( 'keywords' );
						}
					} else {
						$returnObj[$randNum]['keywords'] 		= '';
					}

					// ふりがな
					// --------------------------------------------------
					$returnObj[$randNum]['kana']			= post_custom( 'kana' );

					// 電話番号
					// --------------------------------------------------
					$returnObj[$randNum]['tel'] 			= post_custom( 'tel' );

					// 市町村
					// --------------------------------------------------
					$returnObj[$randNum]['city'] 			= post_custom( 'city' );

					// 市町村以降の住所
					// --------------------------------------------------
					$returnObj[$randNum]['address'] 		= post_custom( 'address' );

					// 駐車場
					// --------------------------------------------------
					$returnObj[$randNum]['car'] 			= post_custom( 'car' );

					// 営業時間
					// --------------------------------------------------
					$returnObj[$randNum]['open-last'] 		= post_custom( 'open-last' );

					// 定休日
					// --------------------------------------------------
					$returnObj[$randNum]['holiday'] 		= post_custom( 'holiday' );

					// 紹介文
					// --------------------------------------------------
					$returnObj[$randNum]['introduction'] 	= post_custom( 'introduction' );

					// クレジットカード
					// --------------------------------------------------
					if ( post_custom( 'credit' ) ) {
						if ( is_array( post_custom( 'credit' ) ) ) {
							$returnObj[$randNum]['credit'] 		= post_custom( 'credit' );
						} else {
							$returnObj[$randNum]['credit'][0] 	= post_custom( 'credit' );
						}
					} else {
						$returnObj[$randNum]['credit'] 			= '';
					}

					// 席数
					// --------------------------------------------------
					$returnObj[$randNum]['seat'] 		= post_custom( 'seat' );

					// 個室
					// --------------------------------------------------
					$returnObj[$randNum]['private'] 	= post_custom( 'private' );

					// 貸切
					// --------------------------------------------------
					$returnObj[$randNum]['reserve'] 	= post_custom( 'reserve' );

					// サービス・チャージ料
					// --------------------------------------------------
					$returnObj[$randNum]['charge'] 		= post_custom( 'charge' );

					// 煙草
					// --------------------------------------------------
					$returnObj[$randNum]['tabaco'] 		= post_custom( 'tabaco' );

					// ホームページ
					// --------------------------------------------------
					$returnObj[$randNum]['site'] 		= post_custom( 'site' );

					// 備考
					// --------------------------------------------------
					$returnObj[$randNum]['note'] 		= post_custom( 'note' );

					// 料理以外の画像
					// --------------------------------------------------

					// それぞれの変数を格納
					$photo 		= post_custom( 'gallery-photo' );
					$caption 	= post_custom( 'gallery-caption' );
					$gallery 	= post_custom( 'gallery' );
					// グループごとに呼び出す
					if ( !empty ( $gallery ) ) {
						if ( $gallery == 1 ) {
							// 1つだけの処理
							$returnObj[$randNum]['gallery'][0]['photo'] 		= wp_get_attachment_image_src( $photo, 'full' );
							$returnObj[$randNum]['gallery'][0]['caption'] 		= $caption;
						} else {
							// 複数時の処理
							for ( $i = 0; $i < $gallery; $i++ ) {
								$returnObj[$randNum]['gallery'][$i]['photo'] 	= wp_get_attachment_image_src( $photo[$i], 'full' );
								$returnObj[$randNum]['gallery'][$i]['caption'] 	= $caption[$i];
							}
						}
					} else {
						$returnObj[$randNum]['gallery'][0]['photo'] 			= '';
						$returnObj[$randNum]['gallery'][0]['caption'] 			= '';
					}

					// メニュー（画像あり）
					// --------------------------------------------------

					// それぞれの変数を格納
					$mName 		= post_custom( 'menu-name' );
					$mPhoto 	= post_custom( 'menu-photo' );
					$mIntro 	= post_custom( 'menu-introduction' );
					$mPrice 	= post_custom( 'menu-price' );
					$mMenu 		= post_custom( 'popular-menu' );
					// グループごとに呼び出す
					if ( !empty ( $mMenu ) ) {
						if ( $mMenu == 1 ) {
							// 1つだけの処理
							$returnObj[$randNum]['popular-menu'][0]['name'] 		= $mName;
							$returnObj[$randNum]['popular-menu'][0]['photo'] 		= wp_get_attachment_image_src( $mPhoto, 'full' );
							$returnObj[$randNum]['popular-menu'][0]['intro'] 		= $mIntro;
							$returnObj[$randNum]['popular-menu'][0]['price'] 		= $mPrice;
						} else {
							// 複数時の処理
							for ( $i = 0; $i < $mMenu; $i++ ) {
								$returnObj[$randNum]['popular-menu'][$i]['name'] 	= $mName[$i];
								$returnObj[$randNum]['popular-menu'][$i]['photo'] 	= wp_get_attachment_image_src( $mPhoto[$i], 'full' );
								$returnObj[$randNum]['popular-menu'][$i]['intro'] 	= $mIntro[$i];
								$returnObj[$randNum]['popular-menu'][$i]['price'] 	= $mPrice[$i];
							}
						}
					} else {
						$returnObj[$randNum]['popular-menu'][0]['name'] 			= '';
						$returnObj[$randNum]['popular-menu'][0]['photo'] 			= '';
						$returnObj[$randNum]['popular-menu'][0]['intro'] 			= '';
						$returnObj[$randNum]['popular-menu'][0]['price'] 			= '';
					}

					// メニュー（画像なし）
					// --------------------------------------------------

					// それぞれの変数を格納
					$oName 		= post_custom( 'other-menu-name' );
					$oPrice 	= post_custom( 'other-menu-price' );
					$oMenu 		= post_custom( 'other-menu' );
					// グループごとに呼び出す
					if ( !empty ( $oMenu ) ) {
						if ( $oMenu == 1 ) {
							// 1つだけの処理
							$returnObj[$randNum]['other-menu'][0]['name'] 		= $oName;
							$returnObj[$randNum]['other-menu'][0]['price'] 		= $oPrice;
						} else {
							// 複数時の処理
							for ( $i = 0; $i < $oMenu; $i++ ) {
								$returnObj[$randNum]['other-menu'][$i]['name'] 	= $oName[$i];
								$returnObj[$randNum]['other-menu'][$i]['price'] = $oPrice[$i];
							}
						}
					} else {
						$returnObj[$randNum]['other-menu'][0]['name'] 			= '';
						$returnObj[$randNum]['other-menu'][0]['price'] 			= '';
					}

					// 緯度・経度
					// --------------------------------------------------
					$returnObj[$randNum]['lat'] = post_custom( 'lat' );
					$returnObj[$randNum]['lng'] = post_custom( 'lng' );

					// クーポン
					// --------------------------------------------------
					$couponName 	= post_custom( 'coupon-name' );
					$couponIntro 	= post_custom( 'coupon-introduction' );
					$couponCon 		= post_custom( 'coupon-condition' );
					$couponAtt 		= post_custom( 'coupon-attention' );
					$couponDay 		= post_custom( 'coupon-day' );
					$coupon 		= post_custom( 'coupon' );
					// グループごとに呼び出す
					if ( !empty ( $coupon ) ) {
						if ( $coupon == 1 ) {
							// 1つだけの処理
							$returnObj[$randNum]['coupon'][0]['name'] 		= $couponName;
							$returnObj[$randNum]['coupon'][0]['intro'] 		= $couponIntro;
							$returnObj[$randNum]['coupon'][0]['con'] 		= $couponCon;
							$returnObj[$randNum]['coupon'][0]['att'] 		= $couponAtt;
							$returnObj[$randNum]['coupon'][0]['day'] 		= $couponDay;
						} else {
							// 複数時の処理
							for ( $i = 0; $i < $coupon; $i++ ) {
								$returnObj[$randNum]['coupon'][$i]['name'] 	= $couponName[$i];
								$returnObj[$randNum]['coupon'][$i]['intro'] = $couponIntro[$i];
								$returnObj[$randNum]['coupon'][$i]['con'] 	= $couponCon[$i];
								$returnObj[$randNum]['coupon'][$i]['att'] 	= $couponAtt[$i];
								$returnObj[$randNum]['coupon'][$i]['day'] 	= $couponDay[$i];
							}
						}
					} else {
						$returnObj[$randNum]['coupon'][0]['name'] 			= '';
						$returnObj[$randNum]['coupon'][0]['intro'] 			= '';
						$returnObj[$randNum]['coupon'][0]['con'] 			= '';
						$returnObj[$randNum]['coupon'][0]['att'] 			= '';
						$returnObj[$randNum]['coupon'][0]['day'] 			= '';
					}

					// Facebook・Instagram
					// --------------------------------------------------
					$returnObj[$randNum]['link-fb'] 						= post_custom( 'link-fb' );
					$returnObj[$randNum]['link-ig'] 						= post_custom( 'link-ig' );



	endwhile;
	endif;
	// **************************************************
	// 抽出用の配列作成（無料会員）
	// **************************************************
	$argsAjax2 = array(
		'post_type' 		=> 'gourmet',
		'post_status' 		=> 'publish',
		'posts_per_page' 	=> -1,
		'meta_query' => array(
			'relation' => 'AND',
				array(
					'key' 		=> 'member-status',
					'value' 	=> '有料',
					'compare' 	=> '!=',
				),
				array(
					'key' 		=> $selectKey,
					'value' 	=> $selectValue,
					'compare' 	=> '=',
				)
		),
	);
	$ajax_query2 = new WP_Query( $argsAjax2 );
	$i = 0;
	if ( $ajax_query2->have_posts() ) :
	while ( $ajax_query2->have_posts() ) : $ajax_query2->the_post();
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
		$selectKey 		= '';
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
		'orderby' 		=> 'member-status-beauty',
		'order' 		=> 'DESC',
		'meta_key' 		=> $selectKey,
		'meta_value' 	=> $selectValue,
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
		if ( post_custom('member-status-beauty') == '有料' ) {
			$returnObj[$i]['post_member_src'] = get_template_directory_uri() . '/img/icon-good.png';
		}
		// *** エリア
		if ( post_custom('area-kagoshima-beauty') ) $returnObj[$i]['post_area'] = '鹿児島市エリア';
		if ( post_custom('area-aira-beauty') ) 		$returnObj[$i]['post_area'] = '姶良市エリア';
		if ( post_custom('area-kirishima-beauty') ) $returnObj[$i]['post_area'] = '霧島エリア';
		if ( post_custom('area-hokusatsu-beauty') ) $returnObj[$i]['post_area'] = '北薩エリア';
		if ( post_custom('area-nakasatsu-beauty') ) $returnObj[$i]['post_area'] = '中薩エリア';
		if ( post_custom('area-nansatsu-beauty') ) 	$returnObj[$i]['post_area'] = '南薩エリア';
		if ( post_custom('area-osumi-beauty') ) 	$returnObj[$i]['post_area'] = '大隅エリア';
		if ( post_custom('area-rito-beauty') ) 		$returnObj[$i]['post_area'] = '離島エリア';
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







?>