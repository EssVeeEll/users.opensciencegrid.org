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
            <?php the_content('Read more' ); ?>
    <?php endwhile; ?>

    <?php
        $term_list = wp_get_post_terms($post->ID, 'filter', array("fields" => "slugs"));
        $current_id = $post->ID;
        // WP_Query arguments
        $args = array (
            'post_type'              => 'portfolio_items',
            'pagination'             => false,
            'orderby'                => 'rand',
            'posts_per_page'             => 3,
            'post__not_in'           => array($current_id),
            'tax_query' => array(
                array(
                    'taxonomy' => 'filter',
                    'field'    => 'slug',
                    'terms'    => $term_list,
                ),
            ),
        );

        // The Query
        $related = new WP_Query( $args );

        ?>

        <?php if ($related->have_posts()) :  ?>
            <h2 class="right-line"><?php esc_html_e('Related Works', 'artificial_reason'); ?></h2>
            <div class="row">
                <?php while ( $related->have_posts()) : $related->the_post();  ?>
                    <div class="col-md-4">
                        <a href="<?php the_permalink(); ?>" class="thumbnail">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('portfolio', array('class' => "img-responsive")); ?>
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/img/no_image.png" class="img-responsive" alt="No image">
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endwhile;  ?>
            </div>
        <?php endif;  ?>

        <?php wp_reset_postdata();  ?>
<?php else : ?>
    <div class="container">
        <p><?php _e('No Entries', 'artificial_reason'); ?>.</p>
<?php endif; ?>
    </div> <!-- container  -->


<?php get_footer(); ?>