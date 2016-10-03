<?php get_header(); ?>

<?php // タイトル表示 ?>
<?php get_template_part( 'title' ); ?>

<?php // ページ内容 ?>
<div class="container">
<div class="main">
<?php if(have_posts()): while(have_posts()): the_post(); ?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<div class="inner">
			<h1 class="title"><?php the_title(); ?></h1>
			<p class="wrap-blog-meta"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i><?php the_time('Y年n月j日'); ?></p>


			<?php
				// ギャラリー
				if(in_category('3')) {
					$s_images = get_field( 'gallery' );
					$s_images_count = count($s_images);
					echo '<div class="avatar"><img src="' . get_template_directory_uri() . '/img/hoikushi.png" alt="" class="img-circle"></div><div class="box-fukidashi">';
					the_content();
					echo '</div><p class="small">枚数：' . $s_images_count . '枚</p>';
					if( $s_images ):
						$i = 0;
			?>
<div class="superbox">
			<?php
				foreach( $s_images as $image ):
					$i++;
			?>
			<?php if( $i > 1 ) echo '-->'; ?><div class="superbox-list"><img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" data-img="<?php echo $image['sizes']['large']; ?>" class="superbox-img"></div><?php if( $s_images_count != $i ) echo '<!--'; ?>
			<?php
				endforeach;
			?>
</div>
			<?php
					endif;
				} elseif (in_category('6')) {
					// ==================================================
					//	情報公開
					// ==================================================
								$file 	= get_field('pdf');
								$title 	= get_the_title();
								echo '<div class="wrap-public-inner">';
								echo '<div class="row">';
								echo '<div class="col-sm-7"><p>' . $title . '</p></div>';
								echo '<div class="col-sm-5"><a href="' . $file . '" target="_blank" class="btn btn-primary btn-block"><i class="fa fa-file-pdf-o fa-fw" aria-hidden="true"></i>PDFで開く</a></div>';
								echo '</div>';
								echo '</div>';

				} elseif (in_category('7')) {
					// ==================================================
					//	苦情相談
					// ==================================================
								the_content();
				} else {
					the_content();
				}
			?>


		</div>
	</article>
<?php endwhile; endif; ?>
<ul class="pager">
	<li class="previous"><?php previous_post_link('%link', '<i class="fa fa-chevron-left fa-fw"></i>',true); ?></li>
	<li class="next"><?php next_post_link('%link', '<i class="fa fa-chevron-right fa-fw"></i>',true); ?></li>
</ul>
</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>