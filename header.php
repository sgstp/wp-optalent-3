<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"  <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')); ?>" />

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
<nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBarTop" aria-controls="navBarTop" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <img class="logo-mobile d-block d-lg-none" src="<?= get_template_directory_uri() ?>/images/logo-optalent-navbar-blanc.png">
    <div class="collapse navbar-collapse" id="navBarTop">
        <a class="navbar-brand" href="/">
            <?php
            $logoLangue = '';
            if(pll_current_language() == 'en') {
                $logoLangue = '-anglais';
            }
            ?>
            <!-- <img src="<?= get_template_directory_uri() ?>/images/logo-optalent-navbar<?= $logoLangue ?>.png"> -->
            <img src="<?= get_template_directory_uri() ?>/images/logo-optalent-navbar-blanc.png">
            <!-- 					<div class="text-warning">
                                    <div class="d-block d-sm-none">xs</div>
                                    <div class="d-none d-sm-block d-md-none">sm</div>
                                    <div class="d-none d-md-block d-lg-none">md</div>
                                    <div class="d-none d-lg-block d-xl-none">lg</div>
                                    <div class="d-none d-xl-block">xl</div>
                                </div> -->
        </a>

        <?= wp_nav_menu([
            'theme_location' => 'principal',
            'container' => false,
            'menu_class' => 'navbar-nav ml-auto mr-5',
            'walker' => new BootstrapNavBarWalker(),
            'dropdownToggleCSS' => 'dropdown-toggle-cfs'
        ]); ?>
    </div>
</nav>