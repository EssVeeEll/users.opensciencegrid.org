<?php
/*
 * Template Name: Register & Login
 * Description: Show Register & Login Forms.
 */
?>

<?php ob_start(); ?>

<?php 

// add the header script to login/registration page header
add_action( 'login_enqueue_scripts', 'header_script' );
 
// add CAPTCHA header script to WordPress header
add_action( 'wp_head', 'header_script' );

?>

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


            <?php

            if(isset($_POST['registro'])) {

                $usuario = $_POST['InputUserName'];
                $email = $_POST['InputEmail'];
                $password = $_POST['InputPassword'];
                $repassword = $_POST['InputConfirmPassword'];
                $first_name = $_POST['InputFirstName'];
                $last_name = $_POST['InputLastName'];
                
                if(strlen( $usuario ) < 4) {
                    // Comprobamos que el nombre de usuario más de 4 caracteres
                    $error = true;
                    $empty_user = '<div class="alert alert-warning">You must enter a user name</div>';
                }
                if(!is_email( $email ))
                {
                    // is_email() es una función de WP que chequea si el string tiene el formato de un email
                    $error = true;
                    $invalid_mail = '<div class="alert alert-warning">Email is invalid</div>';
                }
                if(email_exists( $email ))
                {
                    // email_exists() verifica en la BD si el email ingresado se encuentra registrado
                    $error = true;
                    $exist_mail = '<div class="alert alert-warning">The email is already registered</div>';
                }
                if(username_exists( $usuario ))
                {
                    // username_exists() verifica en la BD si el nombre de usuario ingresado se encuentra ocupado
                    $error = true;
                    $exist_user = '<div class="alert alert-warning">There is already a user with that username</div>';
                }
                if(!validate_username( $usuario ))
                {
                    // validate_username() verifica que el nombre de usuario no tenga ningún caracter extraño
                    $error = true;
                    $invalid_user = '<div class="alert alert-warning">The user name is invalid</div>';
                }
                if(strlen( $password ) < 8 || strlen( $password ) > 16)
                {
                    // Con strlen verificamos que la cantidad de caracteres de la contraseña debe ser entre 8 y 16 caracteres
                    $error = true;
                    $password_error = '<div class="alert alert-warning">The password must be 8 to 16 characters</div>';
                }
                if ($password != $repassword)
                {
                    $error = true;
                    $password_error_different = '<div class="alert alert-warning">The password does not match</div>';
                }
                if (isset( $_POST['g-recaptcha-response'] ) && !captcha_verification())
                {
                    $error = true;
                    $captcha_no_valid = '<div class="alert alert-warning">reCAPTCHA no valid!</div>';
                }
                // Si la variable (string) $error se encuentra vacia quiere decir que no hubo ningún error, entonces ejecuta el código para registrar al usuario.
                if(empty( $error ))
                {
                    // Con sanitize_email() nos encargamos de limpiar el correo solamente por las dudas
                    $email = sanitize_email($email);
                    // Lo mismo hacemos con el nombre de usuario usando la función sanitize_user() de WP
                    $usuario = sanitize_user($usuario);
                    // Creamos un array pasando los datos que necesitaremos para crear el nuevo usuario
                    $userdata = array(
                    'user_pass' => $password,
                    'user_email' => $email,
                    'user_login' => $usuario,
                    'first_name' => $first_name,
                    'last_name' => $last_name
                    );

                    // wp_insert_user() agrega el nuevo usuario a WP
                    wp_insert_user($userdata);
                    // get_user_by() lo utilizamos para obtener el ID del usuario recién creado que lo necesitaremos para wp_new_user_notification()
                    $get_userdata = get_user_by('email', $email);
                    // Con wp_new_user_notification() enviamos un correo al usuario que recién se registro, pasandole su nombre de usuario y contraseña. Además nos avisará cada vez que un usuario se registre
                    wp_new_user_notification($get_userdata->id, $password);

                    $creds = array();
                    $creds['user_login'] = $usuario;
                    $creds['user_password'] = $password;
                    $creds['remember'] = true;
                    wp_signon( $creds, false );

                    $page_redirect = get_page_by_title(of_get_option('profile_page'));
                    if ($page_redirect)
                        wp_redirect(get_permalink($page_redirect->ID));
                    else
                        wp_redirect(home_url());
                }

            }
            ?>

            <div class="col-md-7">
                <h2 class="section-title no-margin-top">Create Account</h2>
                <div class="panel panel-success-dark animated fadeInDown">
                    <div class="panel-heading">Register Form</div>
                    <div class="panel-body">
                        <form role="form" method="post"  action="<?php $_SERVER['PHP_SELF'];?>">
                            <div class="form-group">
                                <?php echo $empty_user; echo $exist_user; echo $invalid_user;?>
                                <label for="InputUserName">User Name<sup>*</sup></label>
                                <input type="text" class="form-control" id="InputUserName" name="InputUserName">
                            </div>
                            <div class="form-group">
                                <label for="InputFirstName">First Name</label>
                                <input type="text" class="form-control" id="InputFirstName" name="InputFirstName">
                            </div>
                            <div class="form-group">
                                <label for="InputLastName">Last Name</label>
                                <input type="text" class="form-control" id="InputLastName" name="InputLastName">
                            </div>
                            <div class="form-group">
                                <?php echo $invalid_mail; echo $exist_mail;?>
                                <label for="InputEmail">Email<sup>*</sup></label>
                                <input type="email" class="form-control" id="InputEmail" name="InputEmail">
                            </div>
                            <?php echo $password_error; echo $password_error_different;?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="InputPassword">Password<sup>*</sup></label>
                                        <input type="password" class="form-control" id="InputPassword" name="InputPassword">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="InputConfirmPassword">Confirm Password<sup>*</sup></label>
                                        <input type="password" class="form-control" id="InputConfirmPassword" name="InputConfirmPassword">
                                    </div>
                                </div>
                            </div>
                            <?php echo $captcha_no_valid; ?>
                            <div class="form-group">
                                <?php display_captcha(); ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox1" value="option1"> I read <a href="#">Terms and Conditions</a>.
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-ar btn-primary pull-right" name="registro">Register</button>
                                </div>
                            </div>
                            <input type="hidden" name="redirect_to" value="<?php bloginfo('home'); ?>" />
                            <input type="hidden" name="testcookie" value="1" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-lg-offset-1 col-md-5">
                <h2 class="section-title no-margin-top">Are you registered?</h2>
                <div class="panel panel-primary animated fadeInDown animation-delay-2">
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
                                <a href="#" class="social-icon-ar sm twitter animated fadeInDown animation-delay-3"><i class="fa fa-twitter"></i></a>
                                <a href="#" class="social-icon-ar sm google-plus animated fadeInDown animation-delay-4"><i class="fa fa-google-plus"></i></a>
                                <a href="#" class="social-icon-ar sm facebook animated fadeInDown animation-delay-5"><i class="fa fa-facebook"></i></a>
                                <hr>
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