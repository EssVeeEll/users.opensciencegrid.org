<?php require_once ('header/head.php'); ?>

<div class="paper-back">
    <div class="absolute-center">
        <div class="text-center">
            <div class="title-logo animated fadeInDown animation-delay-5"><?php echo of_get_option('title_header', 'open<span>science</span>grid'); ?></div>
            <div class="transparent-div animated fadeInUp animation-delay-8">
                <h1><?php esc_html_e('Error 500', 'artificial_reason'); ?></h1>
                <h2><?php esc_html_e('Internal Server Error', 'artificial_reason'); ?></h2>
                <p><?php esc_html_e('Something has gone wrong we are trying to fix it.', 'artificial_reason'); ?><br><?php esc_html_e('Meanwhile you can go back to the homepage', 'artificial_reason'); ?></p>
                <a href="<?php bloginfo('url'); ?>" class="btn btn-ar btn-primary btn-lg"><?php esc_html_e('Go Home', 'artificial_reason'); ?></a>
            </div>
        </div>
    </div>
</div>

<?php

require_once ('footer/scripts.php');

?>

<?php wp_footer(); ?>

</body>

</html>