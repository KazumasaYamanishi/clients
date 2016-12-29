<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css">
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/base.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
	<!--[if lt IE 9]>
		<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<?php wp_head(); ?>

	<?php // Infinite Scroll ?>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-infinitescroll/2.1.0/jquery.infinitescroll.min.js"></script>

</head>
<body <?php body_class(); ?> id="<?php echo esc_attr( $post->post_name ); ?>">
<div id="wrapper">
<?php // カスタムメニューを表示 ?>
<header>
	<div class="site-meta">
		<div class="container">
			<p class="site-description text-center">TJカゴシマの生活応援サイト</p>
			<div class="wrap-sns">
				<ul class="list-inline">
					<li><span class="fa-stack fa-lg"><a href="//twitter.com/tj_kagoshima" target="blank"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></a></span></li>
					<li><span class="fa-stack fa-lg"><a href="//www.facebook.com/TJKagoshima" target="blank"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></a></span></li>
					<li><span class="fa-stack fa-lg"><a href="//instagram.com/explore/tags/tjカゴシマ/" target="blank"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-instagram fa-stack-1x fa-inverse"></i></a></span></li>
				</ul>
			</div>
		</div>
	</div>
	<nav class="navbar">
		<div class="container">
			<div class="navbar-header">
				<!-- <a class="navbar-brand" href="<?php echo home_url(); ?>/"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-sp.png" width="50%" height="50%"></a> -->
				<a class="navbar-brand" href="<?php echo home_url(); ?>/">カゴシマプラス</a>
				<?php
					if(is_mobile()){
						echo '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#wrap-gnav" aria-expanded="false">';
					} else {
						echo '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#gnav-pc" aria-expanded="false">';
					}
				?>
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div id="wrap-gnav" class="collapse navbar-collapse">
				<?php
					if(is_mobile()){
						wp_nav_menu(array(
							'theme_location' => 'グローバルナビ1',
							'container_id'    => 'gnav',
							'container_class' => '',
							'menu' => 'g_menu1',
							'menu_class'=> 'nav navbar-nav',
							'walker' => new wp_bootstrap_navwalker()
						));
						wp_nav_menu(array(
							'theme_location' => 'g_menu_info',
							'container_id'    => 'g_menu_info',
							'container_class' => '',
							'menu' => 'g_menu_info',
							'menu_class'=> 'nav navbar-nav',
							'walker' => new wp_bootstrap_navwalker()
						));
						wp_nav_menu(array(
							'theme_location' => 'g_menu_company',
							'container_id'    => 'g_menu_company',
							'container_class' => '',
							'menu' => 'g_menu_company',
							'menu_class'=> 'nav navbar-nav',
							'walker' => new wp_bootstrap_navwalker()
						));
					} else {
		    			wp_nav_menu(array(
		                    'theme_location' => 'gnav-pc',
		                    'container_id'    => 'gnav-pc',
		                    'container_class' => 'collapse navbar-collapse',
		                    'menu' => 'g_menu_pc',
		                    'menu_class'=> 'nav navbar-nav',
		                    'walker' => new wp_bootstrap_navwalker()
		                ));
		            }
				?>
			</div>
		</div>
	</nav>
</header>