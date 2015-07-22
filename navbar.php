<?php

$navbar_class = "";
$brand_class = "";
$ul_class = "navbar-right";

if (of_get_option('header_style', '') != '')
{
    $navbar_class = "navbar-header-full";
    $brand_class = "hidden-lg hidden-md hidden-sm";
    $ul_class = "";
}


?>

<nav class="navbar navbar-static-top navbar-default <?php echo $navbar_class . " " . of_get_option('navbar_style', ''); ?>" role="navigation" id="header">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars"></i>
            </button>
<!--
            <a id="ar-brand" class="navbar-brand <?php echo $brand_class; ?>" href="index.html">open<span>science</span>grid</a>
-->
            <a id="ar-brand" class="navbar-brand <?php echo $brand_class; ?>" href="http://opensciencegrid.net/">open<span>science</span>grid</a>

        </div> <!-- navbar-header -->

        <?php if(of_get_option('enable_slidebar', 'true')) : ?>       
            <div class="pull-right">
                <a href="javascript:void(0);" class="sb-icon-navbar sb-toggle-right"><i class="fa fa-bars"></i></a>
            </div>
        <?php endif; ?>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php

            $nav_args = array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 3,
                'container'         => '',
                'container_class'   => '',
                'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav ' . $ul_class,
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker()
            );

            wp_nav_menu($nav_args);
            ?>
        </div><!-- navbar-collapse -->
    </div><!-- container -->
</nav>