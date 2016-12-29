<?php get_header(); ?>

<?php
//	==================================================
//
//	タイトル表示
//
//	==================================================
?>
<div id="ptitle" class="page-title">
	<h2 class="title">「<?php the_search_query(); ?>」の検索結果</h2>
</div>

<?php
//	==================================================
//
//	コンテンツ
//
//	==================================================
unset($_SESSION["search_item"]);
?>

<?php if(have_posts()) : ?>
<p class="hit-count text-center"><strong><?php echo $wp_query->found_posts; ?></strong> 件がヒットしました</p>
<?php while(have_posts()):the_post() ?> 
<?php
// ポスト情報の取得
$ID = $post->ID; // 投稿ID
$title = $post->post_title; // タイトル
$content = $post->post_content; // 投稿内容
$slug = $post->post_name; // スラッグ
$parent = $post->post_parent; // 親投稿の有無
$uri = get_page_uri($ID);
?>
<?php
if(get_post_type() === "post" or get_post_type() === "page" ): //投稿
?>
<div class="row post row-10 search-item"> 
	<h3><i class="fa fa-sticky-note fa-fw" aria-hidden="true"></i><a href="<?php echo get_permalink(); ?>?i=<?php echo $ID;?>"><?php the_title(); ?></a></h3>
	<p class="page-breadcrumb">/<?php echo urldecode($slug); ?>/</p> 
</div><!-- /post -->

<?php else: //カスタム投稿 ?>

<?php
	$iImg 		= SCF::get( 'i-image' );
	$size 		= "full"; // (thumbnail, medium, large, full or custom size)
	$image 		= wp_get_attachment_image_src( $iImg, $size );

	$ttl 		= get_the_title();
	$iNumber 	= SCF::get( 'i-number' );
	$iColor 	= SCF::get( 'i-color' );
	$iDetail 	= SCF::get( 'i-detail' );
	$iGrade 	= SCF::get( 'i-grade' );
	$iPaint 	= SCF::get( 'i-paint' );
	$iSizeD 	= SCF::get( 'i-size-d' );
	$iSizeW 	= SCF::get( 'i-size-w' );
	$iSizeH 	= SCF::get( 'i-size-h' );
	$iCaseU 	= SCF::get( 'i-case-u' );
	$iCaseW 	= SCF::get( 'i-case-w' );
	$iCaseM 	= SCF::get( 'i-case-m' );
	$iCase 		= SCF::get( 'i-case' );
	$iMeter 	= SCF::get( 'i-meter' );
	$iStock 	= SCF::get( 'i-stock' );
	$iNote 		= SCF::get( 'i-note' );
?>
<div class="row row-10 search-item">
	<h3 id="p<?php echo $ID;?>"><i class="fa fa-th-large fa-fw" aria-hidden="true"></i><a href="<?php echo get_permalink(); ?>?i=<?php echo $ID;?>"><?php the_title(); ?></a></h3>
	<?php
	$postname=get_post_type_object(get_post_type())->label; 
	$tax = get_post_type_object(get_post_type())->taxonomies;
	$tname = get_the_terms( $post -> ID, $tax[0] );
	$page_breadcrumb = $postname;
	if($tname[0] -> name) $page_breadcrumb .= ' > ' . $tname[0] -> name;
	echo '<p class="page-breadcrumb">'.$page_breadcrumb. '</p>'; 
	?>
	<div class="col-sm-2 col-xsxs-3">
<?php if($image[0]): ?>
		<img src="<?php echo $image[0]; ?>" alt="<?php echo $ttl; ?>" class="lr-center">
<?php else: ?>
		<img src="<?php echo get_template_directory_uri(); ?>/img/items/default.jpg" alt="<?php echo $ttl; ?>" class="lr-center">
<?php endif; ?>
	</div>
	<div class="col-sm-10 col-xsxs-9">
		<?php
		$terms = get_the_terms($post -> ID, 'cat_'.get_post_type());
		foreach($terms as $term){
		$term_slug = $term -> slug;
		}
		?>
		<ul>
			<li>商品番号:<?php echo $iNumber; ?></li>
			<li>グレード:	<?php echo $iGrade; ?></li>
			<li>塗装状態:<?php echo $iPaint; ?></li>
		</ul>
		<!-- <p class="post-link"><a href="<?php echo 'cat_'.get_post_type().'/'.$term_slug.'/?jid='.$iNumber; ?>">詳しくはこちら</a></p> -->
	</div>
</div>

<?php endif; ?>

    <?php endwhile; ?>

<?php else: ?>
        <p>申し訳ございません。<br />該当する記事がございません。</p>
<?php endif; ?>

<div class="container text-center">
<?php bootstrap_pagination(1); ?>
</div>

<?php
//	==================================================
//
//	サンプル請求 & 注文書 & お問い合わせ
//
//	==================================================
?>
<?php get_template_part( 'to-sample' ); //サンプル請求バナー等表示 to-sample.php ?>

</div><!-- end of main -->
<div class="side height-some"><?php get_sidebar(); ?></div>
</div><!-- .container main-container -->
<?php if($_GET['i']):?>
<script>$("html,body").animate({scrollTop:$("#p<?php echo $_GET['i']; ?>").offset().top-20});</script>
<?php endif; ?>
<?php get_footer(); ?>
