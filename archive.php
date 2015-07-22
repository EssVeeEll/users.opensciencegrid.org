<?php get_header(); ?>

<header class="main-header">
    <div class="container">
        <h1 class="page-title">
            <?php if (have_posts()) : ?>
                <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
                <?php /* If this is a category archive */ if (is_category()) { ?>
                <?php echo single_cat_title(); ?>
                <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                <?php _e('Tag', 'artificial_reason') ?>: <?php single_tag_title(); ?> 
                <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                <?php _e('Archive for', 'artificial_reason') ?>: <?php the_time('j F Y'); ?>
                <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                <?php _e('Archive for', 'artificial_reason') ?>: <?php the_time('F Y'); ?>
                <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                <?php _e('Archive for', 'artificial_reason') ?>: <?php the_time('Y'); ?>
                <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                <?php _e('Author Archive', 'artificial_reason') ?>
                <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                <?php _e('Blog Archive', 'artificial_reason') ?>
            <?php } endif; ?>
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
<?php if(is_category(array(3, 88, 60, 62, 90, 61, 89, 63, ))): ?>
        <div class="col-md-8">
<?php else: ?>
	<div class = "col-xs-12">
<?php endif; ?>
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
                                            <img src="<?php echo $url; ?>" class="link img-responsive imageborder" alt="No image">
                                        <?php endif; ?>
					</a>
                                    </div>
                                    <div class="col-lg-6 excerpt">
                                        <?php the_excerpt(); ?>
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
	<?php if(is_category(array(3, 88, 60, 62, 90, 61, 89, 63, ))): ?>
        	<div class="col-md-4">
        	    <?php get_sidebar('blog'); ?>
      		</div>
	<?php endif; ?>
	
    </div> <!-- row -->
</div> <!-- container -->



<?php get_footer(); ?>