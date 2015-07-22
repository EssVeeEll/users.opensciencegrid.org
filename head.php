<!DOCTYPE html>
<html  <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.png">

    <title><?php bloginfo('name'); ?></title>

    <!-- CSS -->
    <link href="<?php echo get_template_directory_uri(); ?>/css/preload.css" rel="stylesheet" media="screen">
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo get_template_directory_uri(); ?>/css/yamm.css" rel="stylesheet" media="screen">
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-switch.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo get_template_directory_uri(); ?>/css/animate.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo get_template_directory_uri(); ?>/css/slidebars.css" rel="stylesheet" media="screen">
    <link href="<?php echo get_template_directory_uri(); ?>/css/lightbox.css" rel="stylesheet" media="screen">
    <link href="<?php echo get_template_directory_uri(); ?>/css/jquery.bxslider.css" rel="stylesheet">

    <link href="<?php echo get_template_directory_uri(); ?>/css/style-<?php echo of_get_option('primary_color'); ?>.css" rel="stylesheet" media="screen" title="default">
    <link href="<?php echo get_template_directory_uri(); ?>/css/<?php echo of_get_option('wide_style'); ?>.css" rel="stylesheet" media="screen" title="default">

    <link href="<?php echo get_template_directory_uri(); ?>/css/buttons.css" rel="stylesheet" media="screen">

    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" media="screen">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
    <![endif]-->
    
    <?php
        if ( is_singular() && get_option( 'thread_comments' ) )
            wp_enqueue_script( 'comment-reply' );
    ?>

    <?php wp_head(); ?>
</head>

<?php if (of_get_option("enable_preload")) : ?>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
<?php endif; ?>

<body>