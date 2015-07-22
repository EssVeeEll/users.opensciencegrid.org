<?php
/**
 * Template Name: Bioinformatics
 *
 * Description:   makes bioinformatics category page full screen
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * 
 * 
 */
?>

<?php get_header(); ?>

<header class="main-header">
    <div class="container">
        <h1 class="page-title">Bioinformatics</h1>

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
    query_posts(array('paged' => get_query_var('paged'), 'cat' => '68'));

    add_filter('the_content', 'strip_images',2);

    function strip_images($content) {
       return preg_replace('/<img[^>]+./','',$content);
    }
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article class="post">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3 class="post-title"><a href="<?php the_permalink() ?>" class="transicion"><?php the_title(); ?></a></h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                       <a href = "<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('blog_image', array('class' => "link imageborder img-responsive")); ?>
                                        <?php else: $url = get_stock_feature_url(); ?>
					<img src = "<?php echo $url; ?>" class="link img-responsive imageborder" alt="No image">
                                        <?php endif; ?>
					</a>
                                    </div>
                                    <div class="excerpt col-lg-6">
					<?php the_excerpt() ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-lg-10 col-md-9 col-sm-8">
                                        <i class="fa fa-clock-o"></i> <?php the_time(get_option('date_format')); ?> 
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
                <?php endwhile; ?>
            <?php else : ?>
                <p><?php _e('No Entries', 'artificial_reason'); ?>.</p>
            <?php endif; ?>
		<?php wp_reset_query(); ?>

           <?php
                if ( function_exists('wp_bootstrap_pagination') )
                    wp_bootstrap_pagination();
            ?>
        </div> <!-- col-md-12 -->
    </div> <!-- row -->
</div> <!-- container -->

<?php get_footer(); ?>