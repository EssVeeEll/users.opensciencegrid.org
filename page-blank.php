<?php
/*
 * Template Name: Page Blank
 * Description: Page Blank.
 */
?>

<?php require_once ('header/head.php'); ?>

<?php remove_filter( 'the_content', 'wpautop' ); ?>

<?php if (have_posts()) : ?>
     <?php while (have_posts()) : the_post(); ?>
        <?php the_content('Read More...'); ?>
    <?php endwhile;?>
<?php endif; ?>

<?php require_once ('footer/scripts.php'); ?>



<?php wp_footer(); ?>

</body>

</html>