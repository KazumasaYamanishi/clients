<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Architects+Daughter">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css">
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/base.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
	<!--[if lt IE 9]>
		<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="' . get_template_directory_uri() . '/js/IE9.js"></script><script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<?php
		if(is_mobile()){
		    echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/base-sp.css">';
		} else {
		    echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/base-pc.css">';
		}
	?>
	<?php wp_head(); ?>
	<script type="text/javascript" src="//webfont.fontplus.jp/accessor/script/fontplus.js?sShks6dWSsw%3D&box=9ldotkciUM0%3D&aa=1" charset="utf-8"></script>
</head>
<body <?php body_class(); ?> id="<?php echo esc_attr( $post->post_name ); ?>"<?php if(is_page('access')): ?> onload="initialize()"<?php endif; ?>>
<div id="wrapper" class="clearfix">

<?php
	// ==================================================
	//
	//	ロゴ、グローバルナビ
	//
	// ==================================================
?>
<?php

	if (is_mobile()) {

?>

<nav class="navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#snav" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="navbar-brand visible-xs" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
            <a class="nav-phone" href="tel:0992107834"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span></a>
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

<?php

	} else {

?>

<div class="wrap-logo">
	<div class="container">
		<p class="logo"><?php echo bloginfo('name'); ?></p>
	</div>
</div>
<div class="wrap-gnav">
	<div class="container">
		<ul class="nav nav-justified">
			<li><a href="#service">サービス内容</a></li>
			<li><a href="#coaching">健康運動指導士とは</a></li>
			<li><a href="#media">掲載記事</a></li>
			<li><a href="#lecture-activity">活動内容</a></li>
			<li><a href="#greeting">代表のご挨拶</a></li>
			<li><a href="#company">会社概要</a></li>
			<li><a href="#contact">お問い合わせ</a></li>
		</ul>
	</div>
</div>

<?php

	}

?>