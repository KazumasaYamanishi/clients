<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>

	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Architects+Daughter">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/base.css">

	<?php
		 if(is_mobile()){
		     echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
		     echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">';
		//     echo '<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">';
			echo '<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">';
			echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/bootstrap.min.css">';
			echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/bootstrap.offcanvas.min.css"/>';
			echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/base-sp.css">';
			echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/style-sp.css">';
			echo '<!--[if lt IE 9]><script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="' . get_template_directory_uri() . '/js/IE9.js"></script><script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->';
		 } else {
			echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/base-pc.css">';
			echo '<link rel="stylesheet" href="' . get_stylesheet_uri() . '">';
		 }
	?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sample-cart.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">

	<script src="<?php echo get_template_directory_uri(); ?>/js/wow.min.js"></script>
	<script>new WOW().init();</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class('body-offcanvas'); ?> id="<?php echo esc_attr( $post->post_name ); ?>"<?php if(is_page('access')): ?> onload="initialize()"<?php endif; ?>>
<div id="wrapper" class="clearfix">
<div class="container-field">
<header>
<?php if(is_mobile()): ?>
<table class="sp-header">
<tr>
	<td><a href="<?php echo home_url(); ?>"><img style="max-width:100%;" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="WOOD BANK ウッドバンク"></a></td>
	<td class="text-center toggle-btn">
		<button type="button" id="navbar-toggle" class="navbar-toggle offcanvas-toggle" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
menu
		</button>
	</td>
</tr>
</table>
<a href="tel:0120-022-730" class="btn btn-tel btn-block"><small>ご遠慮なくお問い合わせください！</small><br>TEL 0120-022-730<br><small>受付 9:00～17:00(土日祝除く)</small></a>
<?php else: ?>
	<div class="container">
		<p><span class="lead">ご遠慮なくお問い合わせください！</span><br class="visible-xs-block" /><span class="lead">TEL 0120-022-730<br class="visible-xs-block" /> 受付 9：00～17：00（土日祝除く）</span><br class="visible-xs-block" />FAX 0993-53-8308 24時間受付</p>
	</div>
<?php endif; ?>
</header>
</div><!-- .container -->


<div class="container main-container">
<div class="main height-some">



<?php
//	==================================================
//
//	ロゴ
//
//	==================================================
?>
<?php if(is_mobile()): ?>
<p class="alert alert-info">WOOD BANK ウッドバンクは海外生産40年。<br>こだわりの無垢材フローリングや羽目板などを全国販売している無垢木材専門メーカー<br>フローリング 常時 3,000～5,000坪在庫</p>
<?php else: ?>
<h1>WOOD BANK ウッドバンクは海外生産40年。こだわりの無垢材フローリングや羽目板などを全国販売｜無垢木材専門メーカー　フローリング 常時 3,000～5,000坪在庫</h1>
<div class="logo text-center"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="WOOD BANK ウッドバンク"></div>
<?php endif; ?>


<?php if(is_mobile()): ?>
<nav class="navbar navbar-default navbar-offcanvas" role="navigation" id="js-bootstrap-offcanvas">
<?php wp_nav_menu( array('menu' => 'g_menu_1' )); ?>
<?php get_sidebar(); ?>
</nav>

<?php else: ?>

<nav class="navbar wrap-gnav">
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
<?php endif; ?>




