<div class="sb-slidebar sb-right">

<?php if(of_get_option('enable_slidebar_search', 'true')) : ?>
    <form method="get" class="" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="input-group">
            <input type="text" placeholder="<?php esc_attr_e('Search...', 'artificial_reason'); ?>" class="field form-control" name="s" id="s">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
            </span>
        </div><!-- /input-group -->
    </form>
<?php endif; ?>

<?php if(of_get_option('enable_slidebar_nav', 'true')) : ?>
    <h2 class="slidebar-header no-margin-bottom"><?php _e("Navigation", "artificial_reason"); ?></h2>
    <?php
        $slidebar_nav_args = array(
            'menu'              => 'slidebar',
            'theme_location'    => 'slidebar',
            'container'         => false,
            'menu_class'        => 'slidebar-menu'
        );
        wp_nav_menu($slidebar_nav_args);
    ?>
<?php endif; ?>

<?php if(of_get_option('enable_slidebar_social', 'true')) : ?>
    <h2 class="slidebar-header"><?php _e("Social Media", "artificial_reason"); ?></h2>
    <div class="slidebar-social-icons">
        <?php $valores = of_get_option('header_social_icons');
        foreach ($valores as $key => $value) :
            if ($valores[$key]) : ?>
                <?php if ($key == "rss") : ?>
                    <a href="<?php echo (of_get_option($key . '_link') == '') ? get_bloginfo('rss2_url') : of_get_option($key . '_link'); ?>" class="social-icon-ar <?php echo $key ?>"><i class="fa fa-<?php echo $key ?>"></i></a>
                <?php else : ?>
                    <a href="<?php echo (of_get_option($key . '_link') == '') ? '#' : of_get_option($key . '_link'); ?>" class="social-icon-ar <?php echo $key ?>"><i class="fa fa-<?php echo $key ?>"></i></a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
</div> <!-- sb-slidebar sb-right -->