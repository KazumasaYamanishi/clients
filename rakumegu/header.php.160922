<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notosansjp.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
	<!--[if lt IE 9]><script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="<?php echo get_template_directory_uri(); ?>/js/IE9.js"></script><script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/base.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="<?php echo esc_attr( $post->post_name ); ?>"<?php if(is_page('access')): ?> onload="initialize()"<?php endif; ?>>
<div id="wrapper">
<header>
	<?php if(is_mobile()) : ?>



			<nav class="navbar">
                <div class="container">
                    <div class="navbar-header">
                    	<h1 class="navbar-brand">らくらくかごしま巡り</h1>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#snav" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                        </button>
                        <!-- <a class="navbar-brand" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a> -->
                    </div>
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'g_menu_sp',
                            'container_id'    => 'snav',
                            'container_class' => 'collapse navbar-collapse',
                            'menu' => 'g_menu_sp',
                            'menu_class'=> 'nav navbar-nav',
                            'walker' => new wp_bootstrap_navwalker()
                        ));
                    ?>
                </div>
            </nav>



	<?php else : ?>



			<div class="wrap-logo container">
				<!-- <div class="logo"><a href="<?php echo home_url(); ?>"><?php echo bloginfo('name'); ?></a></div> -->
				<div class="logo">らくらくかごしま巡り</div>
			</div>



	<?php endif; ?>



</header>