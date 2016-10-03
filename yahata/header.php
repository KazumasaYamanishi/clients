<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="format-detection" content="telephone=no">
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
<body <?php body_class(); ?> id="<?php echo esc_attr( $post->post_name ); ?>"<?php if(is_page('access')): ?> onload="initialize()"<?php endif; ?>>
<div id="wrapper">



<?php
    //
    // スライドショー
    //
    if(is_front_page()) {
        echo '<div id="wrap-slider">';
    } else {
        echo '<div id="wrap-no-slider">';
    }
?>



<header>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
                <?php
                    if(is_mobile()){
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
                <?php
                    if(is_mobile()){
                        echo '<a class="nav-phone" href="tel:0992540784"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span></a>';
                    }
                ?>
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
                        'menu_class'=> '',
                        'walker' => new wp_bootstrap_navwalker()
                    ));
                    wp_nav_menu(array(
                        'theme_location' => 'グローバルナビ2',
                        'container_id'    => 'gnav2',
                        'container_class' => 'collapse navbar-collapse',
                        'menu' => 'g_menu2',
                        'menu_class'=> '',
                        'walker' => new wp_bootstrap_navwalker()
                    ));
                }
            ?>
        </div>
    </nav>
</header>



<?php
    // スライダーエリア
    // ==================================================
    if(is_front_page()) {
        echo '<div id="inner-slider">';
        echo '<div class="container">';
        echo '<h1>のびのびとした環境で<br class="pc-break">すなおでやさしい元気な子どもに</h1>';
        // echo '<p class="lead">この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています</p>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div id="inner-no-slider">';
        // echo '<div class="container">';
        // echo '<h2>H2タイトル</h2>';
        // echo '<p>文章文章文章文章文章</p>';
        // echo '</div>';
        echo '</div>';
    }
?>



<?php
    // 情報公開・苦情相談、ダウンロード
    // ==================================================
?>
<div class="wrap-mimiTab">
    <ul>
        <li><a href="<?php echo home_url(); ?>/open">情報公開・苦情相談</a></li>
        <li><a href="<?php echo home_url(); ?>/download">ダウンロード</a></li>
    </ul>
</div>


<?php
    // end of #wrap-slider or #wrap-no-slider
    echo '</div>';
?>