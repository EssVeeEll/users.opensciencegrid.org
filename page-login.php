<?php
/*
 * Template Name: Login
 * Description: Show Login Form.
 */
?>

<?php ob_start(); ?>
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

<div class="container">
    <div class="row">
        <?php if (!is_user_logged_in()) : ?>

            <div class="center-block logig-form">
                <div class="panel panel-default">
                    <div class="panel-heading">Login Form</div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo wp_login_url(); ?>" method="post">
                            <div class="form-group">
                                <div class="input-group login-input">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" placeholder="Username" name="log" id="user_login">
                                </div>
                                <br>
                                <div class="input-group login-input">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control" placeholder="Password" name="pwd" id="user_pass">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="rememberme" id="rememberme" value="forever"> Remember me
                                    </label>
                                </div>
                                <input type="hidden" name="redirect_to" value="<?php bloginfo('url'); ?>" />
                                <input type="hidden" name="testcookie" value="1" />
                                <button type="submit" class="btn btn-ar btn-primary pull-right" name="wp-submit" id="wp-submit">Login</button>
                                <a href="#" class="social-icon-ar sm twitter animated fadeInDown animation-delay-2"><i class="fa fa-twitter"></i></a>
                                <a href="#" class="social-icon-ar sm google-plus animated fadeInDown animation-delay-3"><i class="fa fa-google-plus"></i></a>
                                <a href="#" class="social-icon-ar sm facebook animated fadeInDown animation-delay-4"><i class="fa fa-facebook"></i></a>
                                <hr class="dotted margin-10">
                                <a href="#" class="btn btn-ar btn-success pull-right">Create Account</a>
                                <a href="#" class="btn btn-ar btn-warning">Password Recovery</a>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php
                $page_redirect = get_page_by_title(of_get_option('profile_page'));
                if ($page_redirect)
                    wp_redirect(get_permalink($page_redirect->ID));
                else
                    wp_redirect(home_url());
            ?>
        <?php endif; ?>
    </div>
</div> <!-- container  -->


<?php get_footer(); ?>