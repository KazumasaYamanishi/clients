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
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/superbox.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/base.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
        // 背景スライドショー
        if(is_front_page()):
    ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/vegas.min.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.simpleTicker.css">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="<?php echo esc_attr( $post->post_name ); ?>">
<div id="wrapper">



<?php
    //
    // スライドショー
    //
    if(is_front_page()):
?>
<div id="wrap-slider">
<?php endif; ?>



<header>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
                <?php
                    if(is_mobile()){
                        echo '<a class="nav-phone" href="tel:"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span></a>';
                        echo '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#snav" aria-expanded="false">';
                    } else {
                        echo '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#gnav" aria-expanded="false">';
                    }
                ?>
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <?php
                if(is_mobile()){
                    wp_nav_menu(array(
                        'theme_location' => 'g_menu_sp',
                        'container_id'    => 'snav',
                        'container_class' => 'collapse navbar-collapse',
                        'menu' => 'g_menu_sp',
                        'menu_class'=> 'nav navbar-nav',
                        'walker' => new wp_bootstrap_navwalker()
                    ));
                } else {
                    wp_nav_menu(array(
                        'theme_location' => 'グローバルナビ1',
                        'container_id'    => 'gnav',
                        'container_class' => 'collapse navbar-collapse',
                        'menu' => 'g_menu1',
                        'menu_class'=> 'nav navbar-nav',
                        'walker' => new wp_bootstrap_navwalker()
                    ));
                }
            ?>
        </div>
    </nav>
</header>



<?php
    if(is_front_page()):
?>


    <?php
        // スライダーエリア
    ?>
    <div id="inner-slider">
        <div class="container">
            <h1>のびのびとした環境で<br class="pc-break">すなおでやさしい元気な子どもに</h1>
            <p class="lead">この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています</p>
        </div>
    </div>



<?php
    // end of #wrap-slider
?>
</div>
<?php endif; ?>