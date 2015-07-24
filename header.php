<header id="header-full-top" class="hidden-xs <?php echo of_get_option('header_style', ''); ?>">
    <div class="container">
        <div class="header-full-title">
            <h1 class="animated fadeInRight"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php echo of_get_option('title_header', 'open<span>science</span>grid'); ?></a></h1>
            <p class="animated fadeInRight"><?php bloginfo('description'); ?></p>
        </div>
        <nav class="top-nav">
	<ul class = "top-nav-social hidden-sm">
		<li class = "topbutton"><a href = "http://support.opensciencegrid.org/" class = "topbutton" target = "_blank">User Helpdesk</a></li>
		<li class = "topbutton"><a href = "https://ticket.grid.iu.edu/submit" target = "_blank" class = "topbutton">Site Support</a></li>
	</ul>
            <ul class="top-nav-social hidden-sm">
                <?php $valores = of_get_option('header_social_icons', array());
                $delay = 5;
                foreach ($valores as $key => $value) :
                    if ($valores[$key]) : ?>
                        <?php if ($key == "rss") : ?>
                            <li><a href="<?php echo (of_get_option($key . '_link') == '') ? get_bloginfo('rss2_url') : of_get_option($key . '_link'); ?>" class="animated fadeIn animation-delay-<?php echo $delay++ ?> <?php echo $key ?>"><i class="fa fa-<?php echo $key ?>"></i></a></li>
                        <?php else : ?>
                            <li><a href="<?php echo (of_get_option($key . '_link') == '') ? '#' : of_get_option($key . '_link'); ?>" class="animated fadeIn animation-delay-<?php echo $delay++ ?> <?php echo $key ?>"><i class="fa fa-<?php echo $key ?>"></i></a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

            <div class="dropdown animated fadeInDown animation-delay-11">
                <?php if ( is_user_logged_in() ) : ?>
                    <?php global $current_user;
                        get_currentuserinfo();
                    ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $current_user->user_login; ?></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-profile animated fadeInUp">
                        <?php echo get_avatar( $current_user->user_email, 100); ?> 
                        <h4><?php echo $current_user->user_login; ?></h4>
                        <span><?php echo $current_user->user_email; ?></span><br>
                        <?php
                            $profile_page = get_page_by_title('Profile');
                            $profile_link = "";
                            if ($profile_page)
                                $profile_link = get_page_link(get_page_by_title('Profile')->ID);
                            else
                                $profile_link = get_edit_user_link();
                        ?>
                        <a href="<?php echo $profile_link ?>"><?php _e('Profile', 'artificial_reason') ?></a> | <a href="<?php echo wp_logout_url(home_url()); ?>"><?php _e('Logout', 'artificial_reason') ?></a>
                    </div>
                 <?php else : ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php _e('Login', 'artificial_reason') ?></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-login-box animated fadeInUp">
                            <form role="form" name="loginform" id="loginform" action="<?php echo wp_login_url(); ?>" method="post">
                                <h4><?php _e('Login Form', 'artificial_reason') ?></h4>

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
                                    <div class="checkbox pull-left">
                                        <label>
                                            <input type="checkbox" name="rememberme" id="rememberme" value="forever"> <?php _e('Remember me', 'artificial_reason') ?>
                                        </label>
                                    </div>
                                    <input type="hidden" name="redirect_to" value="<?php bloginfo('url'); ?>" />
                                    <input type="hidden" name="testcookie" value="1" />
                                    <button type="submit" class="btn btn-ar btn-primary pull-right" name="wp-submit" id="wp-submit"><?php _e('Login', 'artificial_reason') ?></button>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                 <?php endif; ?>
            </div> <!-- dropdown -->

            <div class="dropdown animated fadeInDown animation-delay-13">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-search-box animated fadeInUp">
                    <form role="form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="<?php esc_attr_e('Search...', 'artificial_reason'); ?>" name="s" id="s">
                            <span class="input-group-btn">
                                <button class="btn btn-ar btn-primary" type="submit"><?php _e('Go!', 'artificial_reason') ?></button>
                            </span>
                        </div><!-- /input-group -->
                    </form>
                </div>
            </div> <!-- dropdown -->
        </nav>
    </div> <!-- container -->
</header> <!-- header-full -->