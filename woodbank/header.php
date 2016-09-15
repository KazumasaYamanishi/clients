<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Architects+Daughter">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<?php
		// if(is_mobile()){
		//     echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
		//     echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">';
		//     echo '<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">';
		//     echo '<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">';
		//     echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/bootstrap.min.css">';
		//     echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/base-sp.css">';
		//     echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/style-sp.css">';
		//     echo '<!--[if lt IE 9]><script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="' . get_template_directory_uri() . '/js/IE9.js"></script><script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->';
		// } else {
		//     echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/base-pc.css">';
		//     echo '<link rel="stylesheet" href="' . get_stylesheet_uri() . '">';
		// }
	?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/base.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/base-pc.css">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="<?php echo esc_attr( $post->post_name ); ?>"<?php if(is_page('access')): ?> onload="initialize()"<?php endif; ?>>
<div id="wrapper" class="clearfix">
<header>
	<div class="container">
		<p><span class="lead">ご遠慮なくお問い合わせください！</span><span class="lead">TEL 0120-022-730 受付 9：00～17：00（土日祝除く）</span>FAX 0993-53-8308 24時間受付</p>
	</div>
</header>



<div class="container">
<div class="main height-some">



<?php
//	==================================================
//
//	ロゴ
//
//	==================================================
?>
<h1>WOOD BANK ウッドバンクは海外生産40年。こだわりの無垢材フローリングや羽目板などを全国販売｜無垢木材専門メーカー　フローリング 常時 3,000～5,000坪在庫</h1>
<div class="logo text-center"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="WOOD BANK ウッドバンク"></div>
<nav class="navbar wrap-gnav">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#snav" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
	</div>
	<?php
		wp_nav_menu(array(
			'theme_location' 	=> 'g_menu1',
			'container_id'    	=> 'gnav',
			'container_class' 	=> 'collapse navbar-collapse',
			'menu' 				=> 'g_menu_1',
			'menu_class' 		=> 'nav navbar-nav list-inline text-center',
			'walker' 			=> new wp_bootstrap_navwalker()
		));
	?>
</nav>