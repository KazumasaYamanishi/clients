<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="keywords" content="九州ふっこう割,鹿児島,ふっこう割鹿児島,ふっこう割り,鹿児島県,ツアー,旅行,宿泊,交通,周遊,日帰り,観光">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
    <?php
        if(is_mobile()){
            echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
            echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">';
            echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/bootstrap.min.css">';
            echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/base-sp.css">';
            echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/style-sp.css">';
            echo '<!--[if lt IE 9]><script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="' . get_template_directory_uri() . '/js/IE9.js"></script><script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->';
        } else {
            echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/base-pc.css">';
            echo '<link rel="stylesheet" href="' . get_stylesheet_uri() . '">';
        }
    ?>
	<?php wp_head(); ?>
<script type="text/javascript" src="//webfont.fontplus.jp/accessor/script/fontplus.js?sShks6dWSsw%3D&aa=1&ab=2" charset="utf-8"></script>
</head>
<body <?php body_class(); ?> id="<?php echo esc_attr( $post->post_name ); ?>">
<div id="wrapper">

<div class="wrap-main-img">
	<?php
		if( is_mobile() ) {
			echo '<img src="' . get_template_directory_uri() . '/img/mainh262px.jpg" alt="らくらくめぐりかごしま">';
		} elseif( is_front_page() ) {
			echo '<img src="' . get_template_directory_uri() . '/img/mainh262px.jpg" alt="らくらくめぐりかごしま">';
		} else {
			echo '<img src="' . get_template_directory_uri() . '/img/mainh262px.jpg" alt="らくらくめぐりかごしま">';
		}
	?>
</div>

<div class="gnav-bg gnav-auto">
	<div class="gnav">
		<ul id="" class="clearfix">
			<li><a href="https://kg-rakumegu.com"><img src="<?php echo get_template_directory_uri(); ?>/img/gnav-home.svg" alt="home"></a></li>
			<li><a href="<?php echo home_url(); ?>/carrental"><img src="<?php echo get_template_directory_uri(); ?>/img/gnav-rentacar.svg" alt="レンタカー"></a></li>
			<li><a href="<?php echo home_url(); ?>/taxi"><img src="<?php echo get_template_directory_uri(); ?>/img/gnav-taxi.svg" alt="タクシー"></a></li>
			<li><a href="<?php echo home_url(); ?>/facility"><img src="<?php echo get_template_directory_uri(); ?>/img/gnav-sisetsu.svg" alt="主ならくめぐり施設"></a></li>
			<li><a href="<?php echo home_url(); ?>/participate"><img src="<?php echo get_template_directory_uri(); ?>/img/gnav-hotel.svg" alt="主な宿泊施設"></a></li>
			<li><a href="<?php echo home_url(); ?>/faq"><img src="<?php echo get_template_directory_uri(); ?>/img/gnav-faq.svg" alt="よくある質問"></a></li>
		</ul>
	</div>
</div>