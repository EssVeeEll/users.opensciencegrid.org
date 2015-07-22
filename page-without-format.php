<?php
/*
 * Template Name: Page without Format
 * Description: Page without Format.
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

        <?php the_content('Read More...'); ?>
        <?php edit_post_link('edit', '<p>', '</p>'); ?>
    <?php endwhile;?>
<?php else : ?>
    <div class="container">
        <p><?php _e('No Entries', 'artificial_reason'); ?>.</p>
    </div>
<?php endif; ?>

<?php get_footer(); ?>