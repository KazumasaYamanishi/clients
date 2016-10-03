<?php get_header(); ?>

<?php // タイトル表示 ?>
<?php get_template_part( 'title' ); ?>

<?php // ページ内容 ?>
<div class="container">
<?php if(have_posts()): while(have_posts()): the_post(); ?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<div class="inner">
			<h1>情報公開・苦情相談</h1>
			<p class="lead">下記PDFをダウンロードいただきご覧ください。</p>
			<div class="box-80per">
				<div class="wrap-public">
					<div class="ttl-square">
						<h2 class="heading"><span class="">情報公開</span></h2>
					</div>
					<?php
						$num = 5;
						query_posts('cat=6&posts_per_page='.$num);
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();
								$file 	= get_field('pdf');
								$title 	= get_the_title();
								echo '<div class="wrap-public-inner">';
								echo '<div class="row">';
								echo '<div class="col-sm-7"><p>' . $title . '</p></div>';
								echo '<div class="col-sm-5"><a href="' . $file . '" target="_blank" class="btn btn-primary btn-block"><i class="fa fa-file-pdf-o fa-fw" aria-hidden="true"></i>PDFで開く</a></div>';
								echo '</div>';
								echo '</div>';
							endwhile;
						endif;
						wp_reset_query();
					?>
				</div>
				<div class="wrap-claim">
					<div class="ttl-square">
						<h2 class="heading"><span class="">苦情相談</span></h2>
					</div>
					<?php
						$num = 5;
						query_posts('cat=7&posts_per_page='.$num);
						if ( have_posts() ) :
							echo '<ul>';
							while ( have_posts() ) : the_post();
								$pLink 	= get_the_permalink();
								$time 	= get_the_time('Y.m.d');
								$title 	= get_the_title();
								echo '<li><a href="' . $pLink . '"><span class="news-date">' . $time . '</span><span class="news-title">' . $title . '</span></a></li>';
							endwhile;
							echo '</ul>';
						endif;
						wp_reset_query();
					?>
				</div>
			</div>
		</div>
	</article>
<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>