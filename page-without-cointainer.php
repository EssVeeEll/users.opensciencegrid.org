<?php
/*
 * Template Name: Page without container
 * Description: Page without container.
 */
?>

<?php get_header(); ?>

<?php remove_filter( 'the_content', 'wpautop' ); ?>

<?php if (have_posts()) : ?>
     <?php while (have_posts()) : the_post(); ?>
        <?php the_content('Read More...'); ?>
    <?php endwhile;?>
<?php else : ?>
    <div class="container">
        <p><?php _e('No Entries', 'artificial_reason'); ?>.</p>
    </div>
<?php endif; ?>

<?php get_footer(); ?>