<?php get_header(); ?>



<?php
//	==================================================
//
//	タイトル表示
//
//	==================================================
?>
<div class="page-title">
	<h2 class="title"><?php the_search_query(); ?> の検索結果</h2>
</div>

<?php
//	==================================================
//
//	コンテンツ
//
//	==================================================
?>

<?php if(have_posts()) : ?>

<p class="hit-count text-center"><?php echo $wp_query->found_posts; ?>件がヒットしました</p>
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
<div class="row post search-item"> 
<h3><a href="<?php echo get_permalink(); ?>">■<?php the_title(); ?></a></h3>
<p class="page-breadcrumb">/<?php echo $slug; ?>/</p> 
	<?php if (has_post_thumbnail()) : ?>
	<p class="postThumbnail"><?php the_post_thumbnail(); ?></p>
	<?php endif; ?>
	<!-- <p><?php the_content(); ?></p> -->
	<!-- <p><?php the_excerpt(); ?></p> -->
	<!-- <p class="post-link"><a href="<?php echo get_permalink(); ?>">詳しくはこちら</a></p> -->
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
		<div class="row search-item">
<h3><a href="<?php echo get_permalink(); ?>">■<?php the_title(); ?></a></h3>
<?php
$postname=get_post_type_object(get_post_type())->label; 
$tax = get_post_type_object(get_post_type())->taxonomies;;
$tname = get_the_terms( $post -> ID, $tax[0] );
echo '<p class="page-breadcrumb">'.$postname.'>'.$tname[0] -> name . '</p>'; 
?>
			<div class="col-sm-2">
				<img src="<?php echo $image[0]; ?>" alt="<?php echo $ttl; ?>" class="lr-center">
			</div>
			<div class="col-sm-10">
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
<?php bootstrap_pagination(2); ?>
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
</div>



<?php get_footer(); ?>