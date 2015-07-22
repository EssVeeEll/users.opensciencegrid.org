<?php
/*
 * Template Name: Portfolio Hover Descriptions
 * Description: Portfolio with sidebar filters.
 */
?>

<?php get_header(); ?>

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
        <div class="col-md-12">
            <div class="row" id="Container">
                <?php
                    $args = array (
                        'post_type'              => 'portfolio_items',
                        'pagination'             => false,
                        'posts_per_page'         => '-1',
                    );

                    $port_item = new WP_Query( $args );
                ?>

                <?php if ($port_item->have_posts()) : ?>
                    <?php while ($port_item->have_posts()) : $port_item->the_post(); ?>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="img-caption-ar">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('portfolio', array('class' => "img-responsive")); ?>
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/no_image.png" class="img-responsive" alt="No image">
                                <?php endif; ?>
                                <div class="caption-ar">
                                    <div class="caption-content">
                                        <a href="<?php the_permalink() ?>" class="animated fadeInDown"><i class="fa fa-search"></i>More info</a>
                                        <h4 class="caption-title"><?php the_title(); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;?>
                <?php else : ?>
                    <p><?php _e('No Entries', 'artificial_reason'); ?>.</p>
                <?php endif; ?>

                <?php wp_reset_postdata(); ?>
            </div>
        </div> <!-- col-md-9 -->
    </div>
</div> <!-- container -->

<?php get_footer(); ?>
