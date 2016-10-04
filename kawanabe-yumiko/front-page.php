<?php get_header(); ?>


<div class="text-center">
	<img src="<?= do_shortcode('[template_url]'); ?>/img/main.png">
</div>
<div class="top-hello text-center mbs30">
	<img src="<?= do_shortcode('[template_url]'); ?>/img/sensei.png">
</div>
<div class="wrap-gray">
	<div class="container">
		<div class="row row-10 text-center row-flex">
			<div class="col-xs-6 col-sm-6">
				<h3 class="font-f01">不妊ではなく未妊です</h3>
				<p>かわなべ薬品では、食事や睡眠などの生活習慣の改善や、心のケアを重視しています。「妊活」に取り組んでいる・これから取り組もうとするご夫婦の時間を一緒に寄り添って応援したいと思います。</p>
				<div class="wrap-btn">
					<div class="row">
						<div class="col-sm-10 col-sm-push-1">
								<a href="<?= do_shortcode('[url]'); ?>/cause/" class="btn btn-block btn-straip">MORE</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-sm-6">
				<div class="imgkage"><img src="<?= do_shortcode('[template_url]'); ?>/img/top01.jpg"></div>
			</div>
		</div>
	</div>
	<div class="container mts60">
		<div class="row text-center">
			<div class="col-xs-6 col-sm-6">
				<img src="<?= do_shortcode('[wpurl]'); ?>/wp-content/uploads/2016/09/babyimg.jpg">
			</div>
			<div class="col-xs-6 col-sm-6">
				<h3 class="font-f01">西洋医学（病院）と東洋医学の連携</h3>
				<p>病院の診断によってカラダがどのような状態か？きちんと把握することは大切です。東洋医学で妊娠しやすい身体づくりを行うことで、病院での不妊治療がより効果的になることをめざします。</p>
				<div class="wrap-btn">
					<div class="row">
						<div class="col-sm-10 col-sm-push-1">
								<a href="<?= do_shortcode('[url]'); ?>/about/" class="btn btn-block btn-straip">MORE</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="wrap-kanpo">
	<div class="container">
		<h2 class="font-f01 text-center">漢方・自然薬</h2>
			<div class="row mbs30">
			<div class="col-xs-12 col-sm-10 col-sm-push-1">
				<div class="col-xs-6 col-sm-3">
					<img src="<?= do_shortcode('[wpurl]'); ?>/wp-content/uploads/2016/09/top-onkyu.jpg">
				</div>
				<div class="col-xs-6 col-sm-3">
					<img src="<?= do_shortcode('[wpurl]'); ?>/wp-content/uploads/2016/09/top-kumasasa.jpg">
				</div>
				<div class="col-xs-6 col-sm-3">
					<img src="<?= do_shortcode('[wpurl]'); ?>/wp-content/uploads/2016/09/top-ekijyo.jpg">
				</div>
				<div class="col-xs-6 col-sm-3">
					<img src="<?= do_shortcode('[wpurl]'); ?>/wp-content/uploads/2016/09/top-shouki.jpg">
				</div>
			</div>
			</div>
		<p class="text-center"><small>東洋医学では身体のコンディションを整えることを目的に取り組みます。<br class="pc-break">病院での治療と併用することで、より妊娠率を高めます。</small></p>
		<div class="wrap-btn">
			<div class="row">
				<div class="col-sm-4 col-sm-push-4">
					<a href="<?= do_shortcode('[url]'); ?>/feature/" class="btn btn-block btn-straip">MORE</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="wrap-stripe">
	<div class="container">
		<h2 class="font-f01 text-center">お客様の声</h2>
		<div class="row">
			<div class="col-xs-4 col-sm-4">
				<img src="<?= do_shortcode('[wpurl]'); ?>/wp-content/uploads/2016/09/koe.jpg">
				<h4>IN VIEW：ただいま準備中です！</h4>
				<p>ただいま準備中です！</p>
			</div>
			<div class="col-xs-4 col-sm-4">
				<img src="<?= do_shortcode('[wpurl]'); ?>/wp-content/uploads/2016/09/koe.jpg">
				<h4>IN VIEW：ただいま準備中です！</h4>
				<p>ただいま準備中です！</p>
			</div>
			<div class="col-xs-4 col-sm-4">
				<img src="<?= do_shortcode('[wpurl]'); ?>/wp-content/uploads/2016/09/koe.jpg">
				<h4>IN VIEW：ただいま準備中です！</h4>
				<p>ただいま準備中です！</p>
			</div>
		</div>
		<div class="wrap-btn-st">
			<div class="row">
				<div class="col-sm-4 col-sm-push-4">
					<a href="<?= do_shortcode('[url]'); ?>/voice/" class="btn btn-block btn-straip-st">MORE</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="news-area">
<div class="container">
	<div class="row">
		<div class="col-sm-6 wrap-news">
			<h2 class="text-center">Information</h2>
			<?php
				$num = 3;
				query_posts('posts_per_page='.$num);
				if ( have_posts() ) :
					echo '<ul>';
					while ( have_posts() ) : the_post();
						$pLink = get_the_permalink();
						$time = get_the_time('Y.m.d');
						$title = get_the_title();
						$cat_info = apt_category_info();
						$cat_slug = esc_attr($cat_info->slug);
						$cat_name = esc_html($cat_info->name);
						$theme_url = get_template_directory_uri();
						if(has_post_thumbnail()) {
							$thumbnail_id = get_post_thumbnail_id($post->ID);
							$src_info = wp_get_attachment_image_src($thumbnail_id, 'full');
							$src = $src_info[0];
						} else {
							$src = $theme_url . '/img/dammy.png';
						}
						// echo '<li><a href="' . $pLink . '"><span class="news-date">' . $time . '</span><span class="wrap-news-contents"><span class="news-title">' . $title . '</span><span class="news-contents">' . get_the_content() . '</span></span></a></li>';
						echo '<li><a href="' . $pLink . '"><span class="news-date">' . $time . '</span><span class="wrap-news-contents"><span class="news-title">' . $title . '</span></span></a></li>';
					endwhile;
					echo '</ul>';
				else :
					echo '<p>現在、記事はありません。</p>';
				endif;
				wp_reset_query();
			?>
			<div class="text-center btn-straip"><a href="<?php echo get_permalink(get_page_by_path('news')); ?>">最新情報一覧</a></div>
		</div>
		<div class="col-sm-6">
			<div class="embed-responsive embed-responsive-4by3">
				<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fyumikodakara%2F&tabs=timeline&width=500px&height=410px&small_header=false&adapt_container_width=false&hide_cover=true&show_facepile=false&appId" width="500px" height="410px" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
			</div>
		</div>
	</div>
</div>
</div>


<?php // 記事一覧 ?>
<div class="container">
	<div><a href="<?= do_shortcode('[url]'); ?>/seminar/"><img src="<?= do_shortcode('[wpurl]'); ?>/wp-content/uploads/2016/09/semina.png"></a></div>
</div>


<?php get_footer(); ?>