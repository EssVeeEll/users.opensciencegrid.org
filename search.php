<?php get_header(); ?>

<header class="main-header">
    <div class="container">
        <h1 class="page-title">
            <?php _e('Search results for', 'artificial_reason') ?>: <?php the_search_query(); ?>
        </h1>

        <ol class="breadcrumb pull-right">
            <?php if(function_exists('bcn_display_list')) {
                bcn_display_list();
            } ?>
        </ol>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article class="post">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3 class="post-title"><a href="<?php the_permalink() ?>" class="transicion"><?php the_title(); ?></a></h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('blog_image', array('class' => "imageborder img-responsive")); ?>
                                        <?php else: ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/no_image.png" class="img-responsive imageborder" alt="No image">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php echo  excerpt(50); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-lg-10 col-md-9 col-sm-8">
                                        <i class="fa fa-clock-o"></i> <?php the_date(); ?> 
                                        <i class="fa fa-user"></i> <a href="#"><?php the_author(); ?></a> 
                                        <i class="fa fa-folder-open"></i> <?php the_category(', '); ?>.
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
                <h2 class="post-title"><?php _e( 'No entries found', 'artificial_reason' ) ?></h2>
                <p><?php _e( 'Not found anything that criteria. Try searching again or use the menu to navigate the site', 'artificial_reason' ) ?>.</p>
                <?php get_search_form(); ?>
            <?php endif; ?>

           <?php
                if ( function_exists('wp_bootstrap_pagination') )
                    wp_bootstrap_pagination();
            ?>

        </div> <!-- col-md-8 -->

        <div class="col-md-4">
            <?php get_sidebar('blog'); ?>
        </div>
    </div> <!-- row -->
</div> <!-- container -->

<?php get_footer(); ?>