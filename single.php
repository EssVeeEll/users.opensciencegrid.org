<?php get_header(); ?>

<?php if (have_posts()) : ?>
     <?php while (have_posts()) : the_post(); ?>
        <header class="main-header">
            <div class="container">
                <h1 class="page-title"><?php esc_html_e('Article', 'artificial_reason'); ?></h1>

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
                    <section>
                        <h2 class="page-header no-margin-top"><?php the_title(); ?><br>
			<small class = "absolute"><?php the_date(); ?></small>
			</h2>
                        <?php the_content('Read more' ); ?>
                    </section>
                    <section>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <a href="<?php echo (of_get_option('rss_link' . '_link') == '') ? get_bloginfo('rss2_url') : of_get_option('rss_link' . '_link'); ?>" class="social-icon-ar sm no-margin-bottom rss"><i class="fa fa-rss"></i></a>
                                <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="popup" class="social-icon-ar sm no-margin-bottom facebook"><i class="fa fa-facebook"></i></a>
                                <a href="http://twitter.com/share" target="popup" class="social-icon-ar sm no-margin-bottom twitter"><i class="fa fa-twitter"></i></a>
                                <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="popup" class="social-icon-ar sm no-margin-bottom google-plus"><i class="fa fa-google-plus"></i></a>
                                <a href="https://www.linkedin.com/cws/share?url=<?php the_permalink(); ?>" target="popup" class="social-icon-ar sm no-margin-bottom linkedin"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </section>

                </div>

                <div class="col-md-4">
                    <?php get_sidebar('blog'); ?>
                </div>
            </div>
        </div> <!-- container  -->
    <?php endwhile;?>
<?php else : ?>
    <div class="container">
        <p><?php _e('No Entries', 'artificial_reason'); ?>.</p>
    </div>
<?php endif; ?>


<?php get_footer(); ?>