<?php 

function optionsframework_option_name()
{
    // This gets the theme name from the stylesheet
    $themename = 'artificial_reason';

    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = $themename;
    update_option('optionsframework', $optionsframework_settings);
}


function optionsframework_options()
{
    /* Auxiliar Variables */

    // If using image radio buttons, define a directory path
    $imagepath =  get_template_directory_uri() . '/img/admin/';


    /* -------------------------------------------------------------------------- */
    /* Main Section */
    /* -------------------------------------------------------------------------- */

    $options[] = array(
        'name' => __('General settings', 'artificial_reason'),
        'type' => 'heading'
    );

    $options['title_header'] = array(
        'name' => __('Title page header', 'artificial_reason'),
        'desc' => __('Title page header. Using span tag for the secondary color. Example: artificial &lt;span&gt; reason &lt;/span&gt;.', 'artificial_reason'),
        'id' => 'title_header',
        'std' => 'open<span>science</span>grid',
        'type' => 'textarea'
    );

    $options['footer_text'] = array(
        'name' => __('Footer Text', 'artificial_reason'),
        'desc' => __('Text that will appear in the footer. You can use HTML.', 'artificial_reason'),
        'id' => 'footer_text',
        'std' => '',
        'type' => 'textarea'
    );


    /* -------------------------------------------------------------------------- */
    /* Style Section */
    /* -------------------------------------------------------------------------- */

    $options[] = array(
        'name' => __('Style settings', 'artificial_reason'),
        'type' => 'heading'
    );

    /* Active / Desactive Admin Bar */
    $options[] = array(
        'name' => __( 'Enable Admin Bar', 'artificial_reason' ),
        'desc' => __( 'Enable / Disable Admin Bar.', 'artificial_reason' ),
        'id' => 'enable_admin_bar',
        'std' => false,
        'type' => 'checkbox'
    );

    /* Active / Desactive Preload */
    $options[] = array(
        'name' => __( 'Enable Preload', 'artificial_reason' ),
        'desc' => __( 'Enable / Disable Preload animation page.', 'artificial_reason' ),
        'id' => 'enable_preload',
        'std' => true,
        'type' => 'checkbox'
    );


    /* Primary Color Selector */

    $options[] = array(
        'name' => __('Primary Color Selector', 'artificial_reason' ),
        'desc' => __('Select your primary color.', 'artificial_reason' ),
        'id' => "primary_color",
        'std' => "blue",
        'type' => "images",
        'options' => array(
            'blue' => $imagepath . 'blue.png',
            'blue2' => $imagepath . 'blue2.png',
            'blue3' => $imagepath . 'blue3.png',
            'blue4' => $imagepath . 'blue4.png',
            'blue5' => $imagepath . 'blue5.png',
            'green' => $imagepath . 'green.png',
            'green2' => $imagepath . 'green2.png',
            'green3' => $imagepath . 'green3.png',
            'green4' => $imagepath . 'green4.png',
            'green5' => $imagepath . 'green5.png',
            'red' => $imagepath . 'red.png',
            'red2' => $imagepath . 'red2.png',
            'red3' => $imagepath . 'red3.png',
            'fuchsia' => $imagepath . 'fuchsia.png',
            'pink' => $imagepath . 'pink.png',
            'yellow' => $imagepath . 'yellow.png',
            'yellow2' => $imagepath . 'yellow2.png',
            'orange' => $imagepath . 'orange.png',
            'orange2' => $imagepath . 'orange2.png',
            'orange3' => $imagepath . 'orange3.png',
            'violet' => $imagepath . 'violet.png',
            'violet2' => $imagepath . 'violet2.png',
            'violet3' => $imagepath . 'violet3.png',
            'gray' => $imagepath . 'gray.png',
            'aqua' => $imagepath . 'aqua.png'
        )
    );

    /* Header Style */

    $headers_array = array(
        'header-full' => __( 'Light Header', 'artificial_reason' ),
        'header-full-dark' => __( 'Dark Header', 'artificial_reason' ),
        '' => __( 'No Header (Navbar mode)', 'artificial_reason' ),
    );

    $options[] = array(
        'name' => __( 'Header Style', 'artificial_reason' ),
        'desc' => __( 'Select "No Header" to put the "Navbar" mode.', 'artificial_reason' ),
        'id' => 'header_style',
        'std' => 'header-full',
        'type' => 'radio',
        'options' => $headers_array
    );

    /** Navbar Style **/

    $navbars_array = array(
        'navbar-light' => __( 'Light Color', 'artificial_reason' ),
        'navbar-dark' => __( 'Dark Color', 'artificial_reason' ),
        'navbar-inverse' => __( 'Primary Color', 'artificial_reason' ),
    );

    $options[] = array(
        'name' => __( 'Navbar Style', 'artificial_reason' ),
        'desc' => __( 'Primary Color represents the main color of your website.', 'artificial_reason' ),
        'id' => 'navbar_style',
        'std' => 'navbar-dark',
        'type' => 'radio',
        'options' => $navbars_array
    );

    /** Wide Style **/

    $navbars_array = array(
        'width-full' => __( 'wide', 'artificial_reason' ),
        'width-boxed' => __( 'boxed', 'artificial_reason' ),
    );

    $options[] = array(
        'name' => __( 'Wide Style', 'artificial_reason' ),
        'desc' => __( 'Selecting the overall style of the site (both are responsives).', 'artificial_reason' ),
        'id' => 'wide_style',
        'std' => 'width-full',
        'type' => 'radio',
        'options' => $navbars_array
    );


     /* Enable / Disable Footer Aside */

    $options[] = array(
        'name' => __( 'Enable Aside Footer', 'artificial_reason' ),
        'desc' => __( 'Enable / Disable Footer Aside.', 'artificial_reason' ),
        'id' => 'enable_aside_footer',
        'std' => true,
        'type' => 'checkbox'
    );


    /* -------------------------------------------------------------------------- */
    /* Social Links Section */
    /* -------------------------------------------------------------------------- */

    $options[] = array(
        'name' => __('Social Links', 'artificial_reason'),
        'type' => 'heading'
    );

    /* Header Social Icons */

    // Multicheck Array
    $multicheck_social_array = array(
        'rss' => __( 'rss', 'artificial_reason' ),
        'twitter' => __( 'twitter', 'artificial_reason' ),
        'facebook' => __( 'facebook', 'artificial_reason' ),
        'google-plus' => __( 'google-plus', 'artificial_reason' ),
        'instagram' => __( 'instagram', 'artificial_reason' ),
        'vine' => __( 'vine', 'artificial_reason' ),
        'linkedin' => __( 'linkedin', 'artificial_reason' ),
        'flickr' => __( 'flickr', 'artificial_reason' )
    );

    // Multicheck Defaults
    $multicheck_social_defaults = array(
        'rss' => '1',
        'twitter' => '1',
        'facebook' => '1',
        'googleplus' => '1',
        'instagram' => '1',
        'vine' => '1',
        'linkedin' => '1',
        'flickr' => '1'
    );

    $options[] = array(
        'name' => __( 'Enable Social Icons', 'artificial_reason' ),
        'desc' => __( 'Select the social icons you want to use on your website. Fill in only the url of the options enabled.', 'artificial_reason' ),
        'id' => 'header_social_icons',
        'std' => $multicheck_social_defaults, // These items get checked by default
        'type' => 'multicheck',
        'options' => $multicheck_social_array
    );

    $options[] = array(
        'name' => __('RSS Link', 'artificial_reason'),
        'desc' => __('RSS account for social icons template. Leave blank to use the RSS Wordpress', 'artificial_reason'),
        'id' => 'rss_link',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('Twitter Link', 'artificial_reason'),
        'desc' => __('Twitter account for social icons template.', 'artificial_reason'),
        'id' => 'twitter_link',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('Facebook Link', 'artificial_reason'),
        'desc' => __('Facebook account for social icons template.', 'artificial_reason'),
        'id' => 'facebook_link',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('Google Plus Link', 'artificial_reason'),
        'desc' => __('Google Plus account for social icons template.', 'artificial_reason'),
        'id' => 'google-plus_link',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('Instagram Link', 'artificial_reason'),
        'desc' => __('Instagram account for social icons template.', 'artificial_reason'),
        'id' => 'instagram_link',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('Vine Link', 'artificial_reason'),
        'desc' => __('Vine account for social icons template.', 'artificial_reason'),
        'id' => 'vine_link',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('Linkedin Link', 'artificial_reason'),
        'desc' => __('Linkedin account for social icons template.', 'artificial_reason'),
        'id' => 'linkedin_link',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('Flickr Link', 'artificial_reason'),
        'desc' => __('Flickr account for social icons template.', 'artificial_reason'),
        'id' => 'flickr_link',
        'std' => '',
        'type' => 'text'
    );

    /* -------------------------------------------------------------------------- */
    /* Slidebar */
    /* -------------------------------------------------------------------------- */

    $options[] = array(
        'name' => __('Slidebar', 'artificial_reason'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __( 'Enable Slidebar', 'artificial_reason' ),
        'desc' => __( 'Enable / Disable Slidebar.', 'artificial_reason' ),
        'id' => 'enable_slidebar',
        'std' => true,
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __( 'Enable Search Widget', 'artificial_reason' ),
        'desc' => __( 'Enable / Disable Search Widget on Slidebar.', 'artificial_reason' ),
        'id' => 'enable_slidebar_search',
        'std' => true,
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __( 'Enable Navigation Widget', 'artificial_reason' ),
        'desc' => __( 'Enable / Disable Navigation Widget on Slidebar. You must associate a menu in the menu options', 'artificial_reason' ),
        'id' => 'enable_slidebar_nav',
        'std' => true,
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __( 'Enable Social icons Widget', 'artificial_reason' ),
        'desc' => __( 'Enable / Disable Social icons Widget on Slidebar.', 'artificial_reason' ),
        'id' => 'enable_slidebar_social',
        'std' => true,
        'type' => 'checkbox'
    );

    /* -------------------------------------------------------------------------- */
    /* Login and Register */
    /* -------------------------------------------------------------------------- */

    $options[] = array(
        'name' => __('Login & Register ', 'artificial_reason'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __('Login Page', 'artificial_reason'),
        'desc' => __('Default login page (write title)', 'artificial_reason'),
        'id' => 'login_page',
        'std' => 'Login',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('Register Page', 'artificial_reason'),
        'desc' => __('Default register page (write title)', 'artificial_reason'),
        'id' => 'register_page',
        'std' => 'Register & Login',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('Profile Page', 'artificial_reason'),
        'desc' => __('Default profile page (write title)', 'artificial_reason'),
        'id' => 'profile_page',
        'std' => 'Profile',
        'type' => 'text'
    );


    /* -------------------------------------------------------------------------- */
    /* Captcha */
    /* -------------------------------------------------------------------------- */

    $options[] = array(
        'name' => __('reCAPTCHA ', 'artificial_reason'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __( 'Enable reCAPTCHA ', 'artificial_reason' ),
        'desc' => __( 'Enable / Disable reCAPTCHA .', 'artificial_reason' ),
        'id' => 'enable_recaptcha',
        'std' => false,
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('Public Key', 'artificial_reason'),
        'desc' => __('Your Google reCAPTCHA public key', 'artificial_reason'),
        'id' => 'captcha_public',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('Private Key', 'artificial_reason'),
        'desc' => __('Your Google reCAPTCHA private key', 'artificial_reason'),
        'id' => 'captcha_private',
        'std' => '',
        'type' => 'text'
    );
    return $options;
}


require_once dirname( __FILE__ ) . '/options.php';

?>