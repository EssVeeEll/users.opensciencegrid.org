<?php
/*
 * Template Name: Portfolio Topbar
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
    <div class="portfolio-topbar hidden-sm hidden-xs">
        <div class="row">
            <div class="col-md-8">
                <h4><?php _e('Categories', 'artificial_reason') ?></h4>
                <ul class="portfolio-topbar-cats">
                    <li><span class="filter" data-filter="all"><?php _e('All', 'artificial_reason') ?></span></li>
                    <?php 
                        $terms = get_terms( 'filter' );
                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                            foreach ( $terms as $term ) {
                                echo '<li><span class="filter" data-filter=".' . esc_attr($term->slug) . '">' . $term->name . '</span></li>';
                            }
                        }
                    ?>
                </ul>
                <span class="topbar-border">&nbsp;</span>
            </div>
            <div class="col-md-2 port-fix">
                <h4><?php _e('Columns', 'artificial_reason') ?></h4>
                <ul class="portfolio-topbar-cols">
                    <li><a href="javascript:void(0);" id="Cols1">1</a></li>
                    <li><a href="javascript:void(0);" id="Cols2">2</a></li>
                    <li><a href="javascript:void(0);" id="Cols3" class="active">3</a></li>
                    <li><a href="javascript:void(0);" id="Cols4">4</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h4><?php _e('Description', 'artificial_reason') ?></h4>
                <ul class="portfolio-topbar-desc">
                    <li><a href="javascript:void(0);" id="port-show"><?php _e('Show', 'artificial_reason') ?></a></li>
                    <li><a href="javascript:void(0);" id="port-hide" class="active"><?php _e('Hide', 'artificial_reason') ?></a></li>
                </ul>
            </div>
        </div>
    </div>
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
                        <?php 
                            $term_list = wp_get_post_terms($post->ID, 'filter', array("fields" => "slugs"));
                            $filters_class = '';
                            foreach ($term_list as $filter) {
                                $filters_class .= $filter  . ' ';
                            }
                        ?>

                        <div class="mix <?php echo esc_attr($filters_class); ?> col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php the_permalink(); ?>" class="thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('portfolio', array('class' => "img-responsive")); ?>
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/no_image.png" class="img-responsive" alt="No image">
                                <?php endif; ?>
                            </a>
                            <div class="portfolio-item-caption hide">
                                <h4><?php the_title(); ?></h4>
                                <p><?php the_excerpt(); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p><?php _e('No Entries', 'artificial_reason'); ?>.</p>
                <?php endif; ?> 

                <?php wp_reset_postdata(); ?>
            </div>
        </div> <!-- col-md-9 -->
    </div>
</div> <!-- container -->


<?php include_scripts(array('portfolio')) ?>


<?php get_footer(); ?>
