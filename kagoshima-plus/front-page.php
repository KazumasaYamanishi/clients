<?php get_header(); ?>



<?php
	// ==================================================
	//	▼ スライダー
	// ==================================================
?>
	<div class="wideslider">
		<ul>
			<?php
				$i = 0;
				$args = array(
					'pagename' => 'home',
				);
				$the_query = new WP_Query( $args );
				if ( $the_query->have_posts() ) :
				while ( $the_query->have_posts() ) : $the_query->the_post();
					global $wpdb;
					$query 	= "SELECT meta_id,post_id,meta_key,meta_value FROM $wpdb->postmeta WHERE post_id = $post->ID ORDER BY meta_id ASC";
					$cf 	= $wpdb->get_results($query, ARRAY_A);
					$sliderImg 	= array();
					$sliderLink = array();
					$length 	= 0;
					foreach( $cf as $row ){
						if( $row['meta_key'] == "slider-img" ){
							array_push( $sliderImg, $row['meta_value'] );
						}
						if( $row['meta_key'] == "slider-link" ){
							array_push( $sliderLink, $row['meta_value'] );
						}
					}
					$length = count ( $sliderImg );
					if ( $length > 0 ) {
						for ( $i = 0; $i < $length; $i++ ) {
							$postImg = wp_get_attachment_image ( $sliderImg[$i], 'full' );
							$postLink = $sliderLink[$i];
							echo '<li>';
							if ( !empty ( $postLink ) ) {
								echo '<a href="' . $postLink . '">' . $postImg . '</a>';
							} else {
								echo $postImg;
							}
							echo '</li>';
						}
					}
				endwhile;
				endif;
				wp_reset_postdata();
			?>
		</ul>
	</div>



<?php
	// ==================================================
	// TJ最新号
	// ==================================================

		$args = array(
			'post_type' 		=> 'magazine',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> 1,
		);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			echo '<div class="wrap-magazine"><div class="container container-margin-off"><h2 class="title-bg-img">TJ最新号</h2>';
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$bnr = post_custom('banner');
				$src =  wp_get_attachment_image_src($bnr, 'full');
				if ( $src ) {
					echo '<p><a href="' . home_url() . '/magazine/"><img src="' . $src[0] . '" alt="' . get_the_title() . '"></a></p>';
				} else {
					echo '<p><a href="' . home_url() . '/magazine/"><img src="' . get_template_directory_uri() . '/img/dammy-magazine.png" alt="' . get_the_title() . '"></a></p>';
				}
			endwhile;
			echo '</div></div>';
		endif;
		wp_reset_postdata();




	// ==================================================
	// イベント
	// 今月等のアイコンが入るようにプログラミングする
	// リンク先の固定ページもその月のイベントが表示されるようにプログラミングする
	// ==================================================
		?>


			<div class="wrap-events">
				<div class="container">
					<h2 class="title-bg-img">Event イベント</h2>
				</div>
				<div class="bg-base-light">
					<div class="container">
						<div class="row">
							<div class="col-xs-6 col-sm-3">
								<a href="<?= home_url(); ?>/events-thismonth/">
									<img src="<?= get_template_directory_uri(); ?>/img/btn-10.png" alt="今月のイベント" class="">
								</a>
							</div>
							<div class="col-xs-6 col-sm-3">
								<a href="<?= home_url(); ?>/events-nextmonth/">
									<img src="<?= get_template_directory_uri(); ?>/img/bnr-11.png" alt="翌月のイベント" class="">
								</a>
							</div>
							<div class="col-xs-6 col-sm-3 mt22-sp">
								<a href="<?= home_url(); ?>/events-next2month/">
									<img src="<?= get_template_directory_uri(); ?>/img/bnr-12.png" alt="翌々月のイベント" class="">
								</a>
							</div>
							<div class="col-xs-6 col-sm-3 mt22-sp">
								<a href="<?= home_url(); ?>/events-next3month/">
									<img src="<?= get_template_directory_uri(); ?>/img/bne-01.png" alt="以降のイベント" class="">
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>



		<?php
	// ==================================================
	// 特集記事
	// ==================================================
		$args = array(
			'post_type' 		=> 'feature',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> 4,
		);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			echo '<div class="wrap-feature">';
			echo '<div class="container"><h2 class="title-bg-img">FEATURE 特集記事</h2></div>';
			echo '<div class="container container-margin-off"><div class="row">';
			while ( $the_query->have_posts() ) : $the_query->the_post();
				if ( has_post_thumbnail() ) {
					$thumbnail_id 	= get_post_thumbnail_id();
					$eye_img 		= wp_get_attachment_image_src( $thumbnail_id , 'full' );
					$src 			= $eye_img[0];
				} else {
					$src = get_template_directory_uri() . '/img/dammy-feature.png';
				}
		?>



				<div class="col-sm-3">
					<div class="thumbnail">
						<img src="<?php echo $src; ?>" alt="<?php echo the_title(); ?>" class="main-img">
						<div class="caption">
							<h4><?php echo the_title(); ?></h4>
							<div class="wrap-intro">
								<?= post_custom('midashi'); ?>
							</div>
							<p class="post-meta-top"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo the_time('Y.m.d'); ?></p>
						</div>
						<a href="<?php echo the_permalink(); ?>" class="link-cover"><?php echo the_title(); ?></a>
					</div>
				</div>
		<?php
			endwhile;
			echo '</div></div></div>';
		endif;
		wp_reset_postdata();



	// ==================================================
	// 街ネタ
	// ==================================================
		$args = array(
			'post_type' 		=> 'townnews',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> 4,
		);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			echo '<div class="wrap-machineta">';
			echo '<div class="container"><h2 class="title-bg-img">MACHINETA 今月のまちねた</h2></div>';
			echo '<div class="container container-margin-off"><div class="row">';
			while ( $the_query->have_posts() ) : $the_query->the_post();
				if ( has_post_thumbnail() ) {
					$thumbnail_id 	= get_post_thumbnail_id();
					$eye_img 		= wp_get_attachment_image_src( $thumbnail_id , 'full' );
					$src 			= $eye_img[0];
				} else {
					$src = get_template_directory_uri() . '/img/dammy-machineta.png';
				}
		?>



				<div class="col-sm-3">
					<div class="thumbnail">
						<img src="<?php echo $src; ?>" alt="<?php echo the_title(); ?>" class="main-img">
						<div class="caption">
							<h4><?php echo the_title(); ?></h4>
							<div class="wrap-intro">
								<?= post_custom('introduction'); ?>
							</div>
							<p class="post-meta-top"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo the_time('Y.m.d'); ?></p>
						</div>
						<a href="<?php echo the_permalink(); ?>" class="link-cover"><?php echo the_title(); ?></a>
					</div>
				</div>
		<?php
			endwhile;
			echo '</div></div></div>';
		endif;
		wp_reset_postdata();



	// ==================================================
	// TJかごしま イベント情報
	// ==================================================
		$args = array(
			'post_type' 		=> 'events',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> 2,
			'meta_key' 			=> 'tj-events',
			'meta_value' 		=> 'on',
		);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			echo '<div class="wrap-events-tj">';
			echo '<div class="container"><h2 class="title-bg-img">TJ KAGOSHIMA EVENT TJかごしま イベント情報</h2></div>';
			echo '<div class="container"><div class="row">';
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$bnr = post_custom('banner');
				$src =  wp_get_attachment_image_src($bnr, 'full');
				if ( $src ) {
					echo '<div class="col-sm-6"><p><a href="' . get_the_permalink() . '"><img src="' . $src[0] . '" alt="' . get_the_title() . '" class="lr-center"></a></p></div>';
				} else {
					echo '<div class="col-sm-6"><p><a href="' . get_the_permalink() . '"><img src="' . get_template_directory_uri() . '/img/bnr-11.jpg" alt="' . get_the_title() . '" class="lr-center"></a></p></div>';
				}
			endwhile;
			echo '</div></div></div>';
		endif;
		wp_reset_postdata();



	// ==================================================
	// リザーブシート
	// ==================================================
		$args = array(
			'post_type' 		=> 'reserveseat',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> 4,
		);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			echo '<div class="wrap-reserveseat">';
			echo '<div class="container"><h2 class="title-bg-img">RESERVE SEAT 読者先行リザーブシート</h2></div>';
			echo '<div class="container container-margin-off"><div class="row">';
			while ( $the_query->have_posts() ) : $the_query->the_post();
				if ( has_post_thumbnail() ) {
					$thumbnail_id 	= get_post_thumbnail_id();
					$eye_img 		= wp_get_attachment_image_src( $thumbnail_id , 'full' );
					$src 			= $eye_img[0];
				} else {
					$src = get_template_directory_uri() . '/img/dammy-reserveseat.png';
				}
		?>



				<div class="col-sm-3">
					<div class="thumbnail">
						<img src="<?php echo $src; ?>" alt="<?php echo the_title(); ?>" class="main-img">
						<div class="caption">
							<h4><?php echo the_title(); ?></h4>
							<div class="post-meta">
								<dl class="clearfix">
									<dt>公演日</dt><dd><?php echo post_custom('reserve-day'); ?></dd>
									<dt>会場</dt><dd><?php echo post_custom('reserve-name'); ?></dd>
								</dl>
							</div>
						</div>
						<a href="<?php echo the_permalink(); ?>" class="link-cover"><?php echo the_title(); ?></a>
					</div>
				</div>
		<?php
			endwhile;
			echo '</div></div></div>';
		endif;
		wp_reset_postdata();



	// ==================================================
	// 新作映画案内
	// ==================================================
		echo '<div class="wrap-machineta mt40"><div class="container container-margin-off">';
		echo '<a href="' . home_url() . '/cinema/"><img src="' . get_template_directory_uri() . '/img/bnr-eigakari.jpg" alt="新作映画案内"></a>';
		echo '</div></div>';



	// ==================================================
	// インフォ、プレゼント、お詫びと訂正
	// ==================================================
?>



	<div class="container container-margin-off">
		<div class="row">
			<div class="col-sm-4">
				<div class="wrap-info">
					<h2 class="title-bg-img">インフォメーション</h2>
					<div class="inner">
						<?php
							$args = array(
								'post_type' 		=> 'post',
								'post_status' 		=> 'publish',
								'posts_per_page' 	=> 4,
								'cat' 				=> 1,
							);
							$the_query = new WP_Query( $args );
							if ( $the_query->have_posts() ) :
								echo '<ul class="news-list list-unstyled">';
								while ( $the_query->have_posts() ) : $the_query->the_post();
							?>
									<li>
										<span class="news-date"><?php the_time('Y.m.d'); ?></span>
										<span class="news-title"><?php the_title(); ?></span>
									</li>
							<?php
								endwhile;
								echo '</ul>';
							endif;
							wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="wrap-presents">
					<h2 class="title-bg-img">プレゼント</h2>
					<div class="inner">
						<?php
							$args = array(
								'post_type' 		=> 'post',
								'post_status' 		=> 'publish',
								'posts_per_page' 	=> 4,
								'cat' 				=> 4,
							);
							$the_query = new WP_Query( $args );
							if ( $the_query->have_posts() ) :
								echo '<ul class="news-list list-unstyled">';
								while ( $the_query->have_posts() ) : $the_query->the_post();
							?>
									<li>
										<span class="news-date"><?php the_time('Y.m.d'); ?></span>
										<span class="news-title"><?php the_title(); ?></span>
									</li>
							<?php
								endwhile;
								echo '</ul>';
							endif;
							wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="wrap-correction">
					<h2 class="title-bg-img">お詫びと訂正</h2>
					<div class="inner">
						<?php
							$args = array(
								'post_type' 		=> 'post',
								'post_status' 		=> 'publish',
								'posts_per_page' 	=> 4,
								'cat' 				=> 5,
							);
							$the_query = new WP_Query( $args );
							if ( $the_query->have_posts() ) :
								echo '<ul class="news-list list-unstyled">';
								while ( $the_query->have_posts() ) : $the_query->the_post();
							?>
									<li>
										<span class="news-date"><?php the_time('Y.m.d'); ?></span>
										<span class="news-title"><?php the_title(); ?></span>
									</li>
							<?php
								endwhile;
								echo '</ul>';
							endif;
							wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>



<?php
	// ==================================================
	// 別冊案内 マガジン
	// ==================================================
		$args = array(
			'post_type' 		=> 'separate',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> 5,
		);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			echo '<div class="wrap-separate">';
			echo '<div class="container"><h2 class="title-bg-img">MAGAZINE 別冊案内</h2></div>';
			echo '<div class="bg-base-super-light">';
			echo '<div class="container"><div class="row row-10">';
			while ( $the_query->have_posts() ) : $the_query->the_post();
				if ( has_post_thumbnail() ) {
					$thumbnail_id 	= get_post_thumbnail_id();
					$eye_img 		= wp_get_attachment_image_src( $thumbnail_id , 'full' );
					$src 			= $eye_img[0];
				} else {
					$src = get_template_directory_uri() . '/img/dammy-separate.png';
				}
		?>
				<div class="col-xs-6 col-sm-15">
					<div class="thumbnail">
						<img src="<?php echo $src; ?>" alt="<?php echo the_title(); ?>" class="main-img">
						<div class="caption">
							<p class="text-center"><?php echo post_custom('issue-day'); ?></p>
							<p class="box-round"><?php echo post_custom('genre'); ?></p>
						</div>
						<a href="<?php echo the_permalink(); ?>" class="link-cover"><?php echo the_title(); ?></a>
					</div>
				</div>
		<?php
			endwhile;
			echo '</div></div></div></div>';
		endif;
		wp_reset_postdata();
?>



<?php get_footer(); ?>