<?php
/*
 * Template Name: Blog Alternative
 * Description: Show last entries.
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

<?php
    $portfolio_cat_exlude = '';
    if(!of_get_option('show_portfolio_cat_blog'))
        $portfolio_cat_exlude = '-' . get_cat_ID(of_get_option('portfolio_category'));
    query_posts(array('paged' => get_query_var('paged'), 'cat' => $portfolio_cat_exlude));

    add_filter('the_content', 'strip_images',2);

    function strip_images($content) {
       return preg_replace('/<img[^>]+./','',$content);
    }
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article class="post">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><a href="<?php the_permalink() ?>" class="transicion"><?php the_title(); ?></a></div>
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('blog_image', array('class' => "img-responsive")); ?>
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/img/no_image.png" class="img-responsive" alt="No image">
                            <?php endif; ?>
                            <div class="panel-body">
                                <?php echo  content(100); ?>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-lg-10 col-md-9 col-sm-8">
                                        <i class="fa fa-clock-o"></i> <?php the_date(); ?> <i class="fa fa-user"> </i><?php the_author(); ?> <i class="fa fa-folder-open"></i> <a href="#">Portfolio</a>, <a href="#">Design</a>.
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <a href="<?php the_permalink() ?>" class="pull-right"><?php _e('Read More', 'artificial_reason') ?> &raquo;</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article> <!-- post -->
                <?php endwhile;?>
            <?php else : ?>
                <p><?php _e('No Entries', 'artificial_reason'); ?>.</p>
            <?php endif; ?>

           <?php
                if ( function_exists('wp_bootstrap_pagination') )
                    wp_bootstrap_pagination();
            ?>

            <?php wp_reset_query() ?>
        </div> <!-- col-md-8 -->

        <div class="col-md-4">
            <?php get_sidebar('blog'); ?>
        </div>
    </div> <!-- row -->
</div> <!-- container -->

<?php get_footer(); ?>