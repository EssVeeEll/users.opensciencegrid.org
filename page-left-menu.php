<?php
/*
 * Template Name: Page Left Menu
 * Description: Page with left mnu.
 */
?>

<?php get_header(); ?>

<?php remove_filter( 'the_content', 'wpautop' ); ?>

<?php if (have_posts()) : ?>
     <?php while (have_posts()) : the_post(); ?>
        <header class="main-header">
            <div class="container">
                <h1 class="page-title"><?php the_title(); ?></h1>

                <ol class="breadcrumb pull-right">
                    <?php if(function_exists('bcn_display_list')) {
                        bcn_display_list();
                    } ?>
                </ol>
            </div>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?php

                        $nav_args = array(
                            'menu'              => 'leftMenu',
                            'theme_location'    => 'leftMenu',
                            'depth'             => 2,
                            'container'         => '',
                            'container_class'   => '',
                            'menu_class'        => 'sidebar-nav animated fadeIn',
                            'fallback_cb'       => 'wp_leftmenu_navwalker::fallback',
                            'walker'            => new wp_leftmenu_navwalker()
                        );

                        wp_nav_menu($nav_args);
                    ?>
                </div>
                <div class="col-md-9">
                    <?php the_content('Read More...'); ?>
                    <?php edit_post_link('edit', '<p>', '</p>'); ?>
                </div>
            </div>   
        </div> <!-- container -->
    <?php endwhile;?>
<?php else : ?>
    <div class="container">
        <p><?php _e('No Entries', 'artificial_reason'); ?>.</p>
    </div>
<?php endif; ?>

<?php get_footer(); ?>

