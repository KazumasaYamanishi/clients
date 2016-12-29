<?php get_header(); ?>
<?php
	// =======================================================
	//
	//	3ブロック
	//
	// =======================================================
?>
<div class="wrap-pickup">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<a href="<?php echo home_url(); ?>/support"><img src="<?php echo home_url(); ?>/wp-content/uploads/2016/09/bnr-itiji.png" alt="一時預かり・延長保育" class="lr-center"></a>
			</div>
			<div class="col-sm-4">
				<a href="<?php echo home_url(); ?>/mama"><img src="<?php echo home_url(); ?>/wp-content/uploads/2016/09/bnr-misyu.png" alt="未就園児教室" class="lr-center"></a>
			</div>
			<div class="col-sm-4">
				<a href="<?php echo home_url(); ?>/gallery"><img src="<?php echo home_url(); ?>/wp-content/uploads/2016/09/bnr-gall.png" alt="ギャラリー" class="lr-center"></a>
			</div>
		</div>
	</div>
</div>
<?php
	// =======================================================
	//
	//	おしらせ
	//
	// =======================================================
?>
<?php
	$num = 3;
	query_posts('cat=2&posts_per_page='.$num);
	if(have_posts()):
?>
<div class="wrap-info">
	<div class="container">
		<div class="box-80per">
			<div class="row row-0">
				<div class="col-xs-3">
					<p class="title-ticker">おしらせ</p>
				</div>
				<div class="col-xs-9">
					<div id="newsticker" class="ticker">
						<ul>
							<?php while (have_posts()):the_post(); ?>
								<li><a href="<?php the_permalink(); ?>"><span class="news-date"><?php the_time('Y.m.d'); ?></span><span class="news-title"><?php the_title(); ?></span></a></li>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php
	// =======================================================
	//
	//	ブログ記事一覧
	//
	// =======================================================
?>
<div class="wrap-news">
	<div class="container">
		<div class="box-80per">
			<?php
				$num = 4;
				query_posts('cat=1&posts_per_page='.$num);
				if ( have_posts() ) :
					echo '<ul>';
					while ( have_posts() ) : the_post();
						$pLink = get_the_permalink();
						$time = get_the_time('Y.m.d');
						$title = get_the_title();
						echo '<li><a href="' . $pLink . '"><span class="news-date">' . $time . '</span><span class="news-title">' . $title . '</span></a></li>';
					endwhile;
					echo '</ul>';
				endif;
				wp_reset_query();
			?>
		</div>
	</div>
</div>
<?php
	// =======================================================
	//
	//	今月のギャラリー
	//
	// =======================================================
?>
<div class="wrap-gallery">
	<div class="container">
		<h2>今月のギャラリー</h2>
	</div>
	<?php
		query_posts('posts_per_page=1&cat=3');
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();

				echo '<div class="wrap-gallery-meta">';
				echo '<div class="container">';
				echo '<h3>' . get_the_title() . '</h3>';
				echo '<div class="box-80per clearfix">';
				// echo '<div class="wrap-comment">';
				//		the_content();
				// echo '</div>';
				echo '<div class="avatar"><img src="http://youhoyahata.com/wp/wp-content/themes/addas/img/hoikushi.png" alt=""></div>';
				echo '<div class="box-fukidashi"><p>';
						the_content();
				echo '</p></div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';

				$images = get_field('gallery');
				if( $images ):
					$i 		= 0;
					$result = count($images);
?>
<div class="superbox">
	<?php
		foreach( $images as $image ):
			$i++;
	?>
<?php if( $i > 1 ) echo '-->'; ?><div class="superbox-list"><img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" data-img="<?php echo $image['sizes']['large']; ?>" class="superbox-img"></div><?php if( $result != $i ) echo '<!--'; ?>
	<?php
		endforeach;
	?>
</div>
<?php
				endif;
			endwhile;
		endif;
		wp_reset_query();
	?>
</div>



<?php get_footer(); ?>