<?php
/* -------------------------------------------------------------------------- */
/* Options Panel */
/* -------------------------------------------------------------------------- */
if (!function_exists('optionsframework_init'))
{
    define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
    require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

//Gets post cat slug and looks for single-[cat slug].php and applies it
add_filter('single_template', create_function(
	'$the_template',
	'foreach( (array) get_the_category() as $cat ) {
		if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
		return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
	return $the_template;' )
);

/* -------------------------------------------------------------------------- */
/* Hidden/Show Admin Bar */
/* -------------------------------------------------------------------------- */
if(!of_get_option('enable_admin_bar', false))
    add_filter('show_admin_bar', '__return_false');


/* -------------------------------------------------------------------------- */
/* Register Menus */
/* -------------------------------------------------------------------------- */
//Register Customs Navigation Walker
require_once('wp_bootstrap_navwalker.php');
require_once('wp_leftmenu_navwalker.php');

// Navbar Primary Menu
register_nav_menus( array(
    'primary' => __( 'Navbar Menu', 'artificial_reason' ),
));

// Slidebar Menu
register_nav_menus( array(
    'slidebar' => __( 'Slidebar Menu', 'artificial_reason' ),
));

// Widgets footer menu
register_nav_menus( array(
    'sitemap' => __( 'Sitemap Menu', 'artificial_reason' ),
));

// UI Elements Menu
register_nav_menus( array(
    'leftMenu' => __( 'Left Page Menu', 'artificial_reason' ),
));

/* -------------------------------------------------------------------------- */
/* Translation Support */
/* -------------------------------------------------------------------------- */
load_theme_textdomain('artificial_reason', get_template_directory() . '/languages');

add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('artificial_reason', get_template_directory() . '/languages');
}

$lastimg = 0;

/* 
* Returns the following array:
* (url, width, height, boolean telling whether image is resized or not).
* Note that if you add more images, they must be hard-coded in.
* you can put in 'thumbnail', 'medium', 'large', or 'full' in as
* a parameter.  Default is full.
*/

function get_stock_feature_info($size){
	global $lastimg;
	$id = 0;
	while($id == 0){
		$num = wp_rand(1, 8);
		if($num == 1 && num != lastimg):
			$id = 2220;
		elseif($num == 2 && num != lastimg):
			$id = 2214;
		elseif($num == 3 && num != lastimg):
			$id = 2216;
		elseif($num == 4 && num != lastimg):
			$id = 2800;
		elseif($num == 5 && num != lastimg):
			$id = 2801;
		elseif($num == 6 && num != lastimg):
			$id = 3395;
		elseif($num == 7 && num != lastimg):
			$id = 3407;
		elseif($num == 8 && num != lastimg):
			$id = 3428;
		endif;
	}
	if($size == 'thumbnail'):
		$info = wp_get_attachment_image_src($id);
	elseif($size == 'medium'):
		$info = wp_get_attachment_image_src($id, 'medium');
	elseif($size == 'large'):
		$info = wp_get_attachment_image_src($id, 'large');
	else:
		$info = wp_get_attachment_image_src($id, 'full');
	endif;
	$lastimg = $num;
	return $info;
}


/* 
* Returns the image url of one of the stock featured images 
* for when an article has no image associated with it.  Note
* that if you add more images, they must be hard-coded in.
* you can put in 'thumbnail', 'medium', 'large', or 'full' in as
* a parameter.  Default is full.
*/

function get_stock_feature_url($size){
	$info = get_stock_feature_info($size);
	return $info[0];
}


/* -------------------------------------------------------------------------- */
/* Personalize excerpt and content */
/* -------------------------------------------------------------------------- */

//Eliminar párrafos automáticos por defecto
//remove_filter('the_content', 'wpautop');

function custom_excerpt_length( $length ) {
	$post = get_the_content();
	$matches = array();
	$regex = '<figcaption[^>]*>.*?</figcaption>';
	$hasFigcaption = preg_match($regex, $post, $matches);
	if($hasFigcaption === 1):
		$len = 150 + str_word_count($matches[0]);
		return $len;
	else:
		return 150;
	endif;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    } 
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}

function content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
    } else {
        $content = implode(" ",$content);
    } 
    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('the_content', $content); 
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}


/* -------------------------------------------------------------------------- */
/* Thumbails */
/* -------------------------------------------------------------------------- */
add_theme_support('post-thumbnails');
add_image_size('post', 100, 100, true);
add_image_size('blog_image', 760, 405, true);
add_image_size('post_list', 80 , 80, true);
add_image_size('post_100', 100 , 100, true);
add_image_size('portfolio', 900 , 675, true);
add_image_size('works_footer', 360 , 240, true);
add_image_size('home_post', 727 , 360, true);


/* -------------------------------------------------------------------------- */
/* Comments */
/* -------------------------------------------------------------------------- */

// Custom Comments Walker Class
require_once('wp_comments_walker.php');

function areason_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    ?>
     
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>" class="panel panel-default">
 
            <div class="comment-content panel-body">
                <?php echo get_avatar($comment, 100); ?>
                <?php comment_text(); ?>
            </div>
 
            <div class="panel-footer">
                <div class="row">
                    <div class="col-lg-10 col-md-9 col-sm-8">
                        <i class="fa fa-user"> </i> <?php comment_author_link(); ?> <i class="fa fa-clock-o"></i> <?php comment_date(get_option('date_format')); ?>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4">
                        <span class="pull-right">
                            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('Reply', 'artificial_reason'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

    <?php
}


/* -------------------------------------------------------------------------- */
/* Pagination */
/* -------------------------------------------------------------------------- */
require_once('wp_bootstrap_pagination.php');


/* -------------------------------------------------------------------------- */
/* Sidebar */
/* -------------------------------------------------------------------------- */
if (function_exists('register_sidebar'))
    register_sidebar(array(
        'name'          => __( 'Blog Sidebar', 'artificial_reason' ),
        'id' => 'blog_sidebar',
        'before_widget' => '<div class="panel panel-primary">',
        'after_widget' => '</div></div>',
        'before_title' => '<div class="panel-heading">',
        'after_title' => '</div class="panel-heading"><div class="panel-body">',
    ));

if (function_exists('register_sidebar'))
    register_sidebar(array(
        'name'          => __( 'Footer Widgets', 'artificial_reason' ),
        'id' => 'footer_sidebar',
        'before_widget' => '<div class="col-md-4"><div class="footer-widget">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="footer-widget-title">',
        'after_title' => '</h3>',
    ));


/*web scraper*/

class Curl
{   	

    public $cookieJar = "";

    public function __construct($cookieJarFile = 'cookies.txt') {
        $this->cookieJar = $cookieJarFile;
    }

    function setup()
    {


        $header = array();
        $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
        $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
        $header[] =  "Cache-Control: max-age=0";
        $header[] =  "Connection: keep-alive";
        $header[] = "Keep-Alive: 300";
        $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $header[] = "Accept-Language: en-us,en;q=0.5";
        $header[] = "Pragma: "; // browsers keep this blank.


        curl_setopt($this->curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7');
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $header);
    	curl_setopt($this->curl,CURLOPT_COOKIEJAR, $cookieJar); 
    	curl_setopt($this->curl,CURLOPT_COOKIEFILE, $cookieJar);
    	curl_setopt($this->curl,CURLOPT_AUTOREFERER, true);
    	curl_setopt($this->curl,CURLOPT_FOLLOWLOCATION, true);
    	curl_setopt($this->curl,CURLOPT_RETURNTRANSFER, true);	
    }


    function get($url)
    { 
    	$this->curl = curl_init($url);
    	$this->setup();

    	return $this->request();
    }

    function getAll($reg,$str)
    {
    	preg_match_all($reg,$str,$matches);
    	return $matches[1];
    }

    function postForm($url, $fields, $referer='')
    {
    	$this->curl = curl_init($url);
    	$this->setup();
    	curl_setopt($this->curl, CURLOPT_URL, $url);
    	curl_setopt($this->curl, CURLOPT_POST, 1);
    	curl_setopt($this->curl, CURLOPT_REFERER, $referer);
    	curl_setopt($this->curl, CURLOPT_POSTFIELDS, $fields);
    	return $this->request();
    }

    function getInfo($info)
    {
    	$info = ($info == 'lasturl') ? curl_getinfo($this->curl, CURLINFO_EFFECTIVE_URL) : curl_getinfo($this->curl, $info);
    	return $info;
    }

    function request()
    {
    	return curl_exec($this->curl);
    }
}


/* -------------------------------------------------------------------------- */
/* WIDGETS Artificial Reason */
/* -------------------------------------------------------------------------- */

/* AReason_Tabs_Widget */

// Cuando se inicializa el widget llamaremos al metodo register de la clase AReason_Tabs_Widget
add_action( "widgets_init", array( "AReason_Tabs_Widget", "register" ) );

// Cuando se active el plugin se llamara al metodo activate de la clase Widget_ultimosPostPorAutor
// donde añadiremos los argumentos por defecto para que funcione el plugin
register_activation_hook( __FILE__, array( 'AReason_Tabs_Widget', 'activate' ) );

// Cuando se desactive el plugin se llamara al metodo desactivate de la clase Widget_ultimosPostPorAutor
// donde se eliminaran los argumentos anteriormente guardados, para tener una DB limpia
register_deactivation_hook( __FILE__, array( 'AReason_Tabs_Widget', 'deactivate' ) );

// Clase
class AReason_Tabs_Widget
{
    public static function activate()
    {
        // Argumentos y sus valores por defecto
        $aData = array( 'post_tab' => true,
                        'NUMERO_POST' => 5 );

        // Comprobamos si existe opciones para este Widget, si no existe las creamos por el contrario actualizamos
        if( ! get_option( 'areasonTabsWidget' ) )
            add_option( 'areasonTabsWidget' , $aData );
        else
            update_option( 'areasonTabsWidget' , $data);
    }

    public static function deactivate()
    {
        // Cuando se desactive el plugin se eliminaran todas las filas de la DB que le sirven a este plugin
        delete_option( 'areasonTabsWidget' );
    }
    
    // Panel de control que se mostrara abajo de nuestro Widget en el panel de configuración de Widgets
    public static function control()
    {
        /*$aData = get_option( 'areasonTabsWidget' );

        // Mostraremos un formulario en HTML para modificar los valores del Widget
        ?>
            <p>
                <input type="checkbox" name="areasonTabsWidget_post_tabs" value="<?php echo $aData['post_tab']; ?>">
                <label>Post Tab </label>
            </p>
        <?php

        // Si se ha enviado uno de los valores del formulario por POST actualizaremos los datos
        if( isset( $_POST['areasonTabsWidget_post_tabs'] ) )
        {
            $aData['post_tab'] = attribute_escape( $_POST['areasonTabsWidget_post_tabs'] );
            update_option( 'areasonTabsWidget', $aData );
        }*/
        echo "<p>Options in next version.</p>";
    }

    // Metodo que se llamara cuando se visualize el Widget en pantalla
    public static function widget($args)
    {
        ?>

         <div class="block">
            <ul class="nav nav-tabs nav-tabs-ar" id="myTab2">
		<li class = "active"><a href="#other" data-toggle="tab"><i class="fa fa-archive"></i></a></li>
                <li><a href="#categories" data-toggle="tab"><i class="fa fa-folder-open"></i></a></li>
                <li><a href="#archive" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
		<li><a href = "#tags" data-toggle = "tab"><i class = "fa fa-tags"></i></a></li>
            </ul>
		<div class = "tab-content">
                <div class = "tab-pane active" id = "other">
		
			<h3 class = "post-title"><?php _e('From the Archive', 'artificial_reason') ?></h3>
			
			<table>
			<?php $args = array('posts_per_page' => '3',
			'orderby' => 'rand');	
			$posts = get_posts($args);
			global $post;
			foreach($posts as $post): 
				setup_postdata($post);?>
				<tr>
				<td class = "wide">
				<a href = "<?php the_permalink(); ?>">
				<?php if (has_post_thumbnail($post->ID)) :
					$info = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
					<img src = "<?php  echo $info; ?>" class = "img-responsive imageborder link" width = "100" height = "100">
				<?php else: 
					$url = get_stock_feature_url('thumbnail'); ?>
					<img src="<?php echo $url; ?>" class="img-responsive imageborder link" alt="No image" width = "100" height = "100">
				<?php endif; ?>
				</a>
				</td>
				<td>
				<a href = "<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<br>
				<?php the_date(); ?>
				</td>
				</tr>
				
			<?php endforeach; ?> 
                
                </table>
		</div>


		<div class="tab-pane" id="archive">
                     <h3 class="post-title"><?php _e('Archives', 'artificial_reason') ?></h3>
                    <ul class="simple">
                        <?php wp_get_archives( $args ); ?>
                    </ul>
                </div>

                <div class="tab-pane" id="categories">
                    <h3 class="post-title"><?php _e('Categories', 'artificial_reason') ?></h3>
                    <ul class="simple">
                        <?php wp_list_categories('title_li='); ?>
                    </ul>
                </div>
		
		<div class="tab-pane" id="tags">
                    <h3 class="post-title"><?php _e('Tags', 'artificial_reason') ?></h3>
                    <div class="tags-cloud">
                        <?php
                            $args = array(
                                'smallest'                  => 1, 
                                'largest'                   => 1,
                                'unit'                      => 'em', 
                                'number'                    => 45,  
                                'format'                    => 'flat',
                                'separator'                 => ""
                            );

                            wp_tag_cloud($args);
                        ?>
                    </div>
                </div>

                
            </div> <!-- tab-content -->
        </div>

        <?php
    }

    // Meotodo que se llamara cuando se inicialice el Widget
    public static function register()
    {
        // Incluimos el widget en el panel control de Widgets
        wp_register_sidebar_widget( "AReason_Tabs_Widget", "AReason  Tabs Widget", array( "AReason_Tabs_Widget", "widget" ) );

        // Formulario para editar las propiedades de nuestro Widget
        wp_register_widget_control("AReason_Tabs_Widget",  "AReason Tabs Widget", array( "AReason_Tabs_Widget", "control" ) );
    }
}

/* AReason_Search_Widget */

// Cuando se inicializa el widget llamaremos al metodo register de la clase AReason_Tabs_Widget
add_action( "widgets_init", array( "AReason_Search_Widget", "register" ) );

// Clase
class AReason_Search_Widget
{
    // Metodo que se llamara cuando se visualize el Widget en pantalla
    public static function widget($args)
    {
        ?>

        <div class="block">

        <?php get_search_form(); ?>

        </div>

        <?php
    }

    // Meotodo que se llamara cuando se inicialice el Widget
    public static function register()
    {
        // Incluimos el widget en el panel control de Widgets
        wp_register_sidebar_widget( "AReason_Search_Widget", "AReason Search Widget", array( "AReason_Search_Widget", "widget" ) );
    }
}


/* AReason_Video_Widget */

// Cuando se inicializa el widget llamaremos al metodo register de la clase AReason_Video_Widget
add_action( "widgets_init", array( "AReason_Video_Widget", "register" ) );

// Cuando se active el plugin se llamara al metodo activate de la clase Widget_ultimosPostPorAutor
// donde añadiremos los argumentos por defecto para que funcione el plugin
register_activation_hook( __FILE__, array( 'AReason_Video_Widget', 'activate' ) );

// Cuando se desactive el plugin se llamara al metodo desactivate de la clase Widget_ultimosPostPorAutor
// donde se eliminaran los argumentos anteriormente guardados, para tener una DB limpia
register_deactivation_hook( __FILE__, array( 'AReason_Video_Widget', 'deactivate' ) );

// Clase
class AReason_Video_Widget
{
    public static function activate()
    {
        // Argumentos y sus valores por defecto
        $aData = array( 'url' => "" );

        // Comprobamos si existe opciones para este Widget, si no existe las creamos por el contrario actualizamos
        if( ! get_option( 'areasonVideoWidget' ) )
            add_option( 'areasonVideoWidget' , $aData );
        else
            update_option( 'areasonVideoWidget' , $data);
    }

    public static function deactivate()
    {
        // Cuando se desactive el plugin se eliminaran todas las filas de la DB que le sirven a este plugin
        delete_option( 'areasonVideoWidget' );
    }
    
    // Panel de control que se mostrara abajo de nuestro Widget en el panel de configuración de Widgets
    public static function control()
    {
        $aData = get_option( 'areasonVideoWidget' );

        // Mostraremos un formulario en HTML para modificar los valores del Widget
        ?>
            <p>
                <label>URL: </label><br>
                <input type="text" name="areasonVideoWidget_post_Video" value="<?php echo $aData['url']; ?>">
            </p>
        <?php

        // Si se ha enviado uno de los valores del formulario por POST actualizaremos los datos
        if( isset( $_POST['areasonVideoWidget_post_Video'] ) )
        {
            $aData['url'] = esc_attr__( $_POST['areasonVideoWidget_post_Video'] );
            update_option( 'areasonVideoWidget', $aData );
        }
    }

    // Metodo que se llamara cuando se visualize el Widget en pantalla
    public static function widget($args)
    {
        $aData = get_option( 'areasonVideoWidget' );

        ?>

        <div class="panel panel-primary">
            <div class="panel-heading"><i class="fa fa-play-circle"></i><?php esc_html_e('Featured video', 'artificial_reason'); ?></div class="panel-heading">
            <div class="video">
                <iframe src="<?php echo $aData['url'] ?>"></iframe>
            </div>
        </div>


        <?php
    }

    // Meotodo que se llamara cuando se inicialice el Widget
    public static function register()
    {
        // Incluimos el widget en el panel control de Widgets
        wp_register_sidebar_widget("AReason_Video_Widget", "AReason Video Widget", array( "AReason_Video_Widget", "widget" ) );

        // Formulario para editar las propiedades de nuestro Widget
        wp_register_widget_control("AReason_Video_Widget", "AReason Video Widget", array( "AReason_Video_Widget", "control" ) );
    }
}

/* AReason_Comments_Widget */

// Cuando se inicializa el widget llamaremos al metodo register de la clase AReason_Comments_Widget
add_action( "widgets_init", array( "AReason_Comments_Widget", "register" ) );

// Cuando se active el plugin se llamara al metodo activate de la clase Widget_ultimosPostPorAutor
// donde añadiremos los argumentos por defecto para que funcione el plugin
register_activation_hook( __FILE__, array( 'AReason_Comments_Widget', 'activate' ) );

// Cuando se desactive el plugin se llamara al metodo desactivate de la clase Widget_ultimosPostPorAutor
// donde se eliminaran los argumentos anteriormente guardados, para tener una DB limpia
register_deactivation_hook( __FILE__, array( 'AReason_Comments_Widget', 'deactivate' ) );

// Clase
class AReason_Comments_Widget
{
    public static function activate()
    {
        // Argumentos y sus valores por defecto
        $aData = array( 'num' => "" );

        // Comprobamos si existe opciones para este Widget, si no existe las creamos por el contrario actualizamos
        if( ! get_option( 'areasonCommentsWidget' ) )
            add_option( 'areasonCommentsWidget' , $aData );
        else
            update_option( 'areasonCommentsWidget' , $data);
    }

    public static function deactivate()
    {
        // Cuando se desactive el plugin se eliminaran todas las filas de la DB que le sirven a este plugin
        delete_option( 'areasonCommentsWidget' );
    }
    
    // Panel de control que se mostrara abajo de nuestro Widget en el panel de configuración de Widgets
    public static function control()
    {
        $aData = get_option( 'areasonCommentsWidget' );

        // Mostraremos un formulario en HTML para modificar los valores del Widget
        ?>
            <p>
                <label><?php _e('Number of Comments', 'artificial_reason') ?>: </label><br>
                <input type="text" name="areasonCommentsWidget_post_Comments" value="<?php echo $aData['num']; ?>">
            </p>
        <?php

        // Si se ha enviado uno de los valores del formulario por POST actualizaremos los datos
        if( isset( $_POST['areasonCommentsWidget_post_Comments'] ) )
        {
            $aData['num'] = esc_attr( $_POST['areasonCommentsWidget_post_Comments'] );
            update_option( 'areasonCommentsWidget', $aData );
        }
    }

    // Metodo que se llamara cuando se visualize el Widget en pantalla
    public static function widget($args)
    {
        $aData = get_option( 'areasonCommentsWidget' );

        ?>

        <div class="panel panel-primary">
            <div class="panel-heading"><i class="fa fa-comments"></i> <?php _e('Recent Comments', 'artificial_reason') ?></div>
            <div class="panel-body">
                <ul class="comments-sidebar">

                    <?php $attr = array(
                        'author_email' => '',
                        'ID' => '',
                        'karma' => '',
                        'number' => '5',
                        'offset' => '',
                        'orderby' => '',
                        'order' => 'DESC',
                        'parent' => '',
                        'post_author' => '',
                        'post_name' => '',
                        'post_parent' => '',
                        'post_status' => '',
                        'post_type' => '',
                        'status' => 'approve',
                        'type' => '',
                        'user_id' => '',
                        'search' => '',
                        'count' => false,
                        'meta_key' => '',
                        'meta_value' => '',
                        'meta_query' => '',
                    ); ?>

                    <?php $comments = get_comments( $attr ); ?>

                        <?php foreach($comments as $comment) : ?>
                            <li>
                                <?php echo get_avatar( $comment, 75 ); ?>
                                <h4><a href="<?php echo ($comment->comment_author_url) ?>"><?php echo ($comment->comment_author) ?></a> in <a href="<?php get_permalink($comment->comment_post_ID) ?>"><?php echo get_the_title($comment->comment_post_ID); ?> </a></h4>
                                <?php
                                    $aText =  substr($comment->comment_content, 0, 120);
                                    $aText .= "...";
                                ?>
                                <p><?php echo $aText  ?></p>
                            </li>
                        <?php endforeach; ?>
                </ul>
            </div>
        </div>


        <?php
    }

    // Meotodo que se llamara cuando se inicialice el Widget
    public static function register()
    {
        // Incluimos el widget en el panel control de Widgets
        wp_register_sidebar_widget( "AReason_Comments_Widget", "AReason Comments Widget", array( "AReason_Comments_Widget", "widget" ) );

        // Formulario para editar las propiedades de nuestro Widget
        wp_register_widget_control( "AReason_Comments_Widget", "AReason Comments Widget", array( "AReason_Comments_Widget", "control" ) );
    }
}


/* -------------------------------------------------------------------------- */
/* Shortcodes */
/* -------------------------------------------------------------------------- */
function sc_section_title($atts, $content = null)
{
    extract(shortcode_atts(array(
        "level" => '3'
    ), $atts));

    return '<h'.$level.' class="section-title">'.$content.'</h'.$level.'>';
}

add_shortcode("section-title", "sc_section_title");


function sc_post_list($atts, $content = null)
{
    $result = '<ul class="media-list">';
    extract(shortcode_atts(array(
    ), $atts));

    $thumbnails = get_posts($atts);
    foreach ($thumbnails as $thumbnail) {
        if ( has_post_thumbnail($thumbnail->ID)) {
            $thumb = get_the_post_thumbnail($thumbnail->ID, 'post_list');
        }
        else {
            $thumb = '<img src="' . get_template_directory_uri() . '/img/no_image_80.png" class="img-responsive" alt="No image">';
        }
        $result .= '<li class="media">';
        $result .= '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '" class="pull-left media-object">';
        $result .= $thumb;
        $result .= '</a>';
        $result .= '<div class="media-body">';
        $result .= '<p class="media-heading">';
        $result .= '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
        $result .= get_the_title($thumbnail->ID);
        $result .= '</a>';
        $result .= '</p>';
        $result .= '<small>';
        $result .= get_the_time(get_option('date_format'), $thumbnail);
        $result .= '</small>';
        $result .= '</div>';
        $result .= '<span class="clearfix"></span>';
    }

    $result .= '</ul>';
    return $result;
}

add_shortcode("post-list", "sc_post_list");


$id_shorcode_portfolio_count = 0;

function sc_last_portfolio($atts, $content = null)
{
    global $id_shorcode_portfolio_count;
    
    $result = '';

    $a = shortcode_atts( array(
        'items' => 8,
        'rows' => 1,
        'title' => 'Latest Works',
        'title_class' => 'section-title',
        'controls' => 1
    ), $atts );

    $args_portfolio = array(
        'posts_per_page'   => $a['items'],
        'offset'           => 0,
        'category'         => '',
        'category_name'    => '',
        'orderby'          => 'post_date',
        'order'            => 'DESC',
        'include'          => '',
        'exclude'          => '',
        'meta_key'         => '',
        'meta_value'       => '',
        'post_type'        => 'portfolio_items',
        'post_mime_type'   => '',
        'post_parent'      => '',
        'post_status'      => 'publish',
        'suppress_filters' => true );

    $posts_array = get_posts( $args_portfolio );

    if (count($posts_array) == 0)
        return '';

    $result .= '<h2 class="' . $a['title_class'] . '">' . $a['title'] . '</h2>';

    if ($a['controls'] == 1)
    {
        $result .= '<div class="bxslider-controls">';
        $result .= '    <span id="bx-prev' . $id_shorcode_portfolio_count . '"></span>';
        $result .= '    <span id="bx-next' . $id_shorcode_portfolio_count . '"></span>';
        $result .= '</div>';
    }

    $result .= '<ul class="bxslider" id="latest-works' . $id_shorcode_portfolio_count . '">';

    $cent = 0;

    foreach ($posts_array as $post)
    {
        if ($cent % $a["rows"] == 0)
            $result .= '<li>';

        $result .= '<div class="img-caption-ar">';
        if ( has_post_thumbnail($post->ID)) {
            $thumb = get_the_post_thumbnail($post->ID, '', array('class' => "img-responsive"));
        }
        else {
            $thumb = '<img src="' . get_template_directory_uri() . '/img/no_image.png" class="img-responsive" alt="No image">';
        }
        $result .= $thumb;
        $result .= '    <div class="caption-ar">';
        $result .= '        <div class="caption-content">';
        $result .= '            <a href="' . get_permalink( $post->ID ) .  '" class="animated fadeInDown"><i class="fa fa-search"></i>More info</a>';
        $result .= '            <h4 class="caption-title">' . get_the_title($post->ID) . '</h4>';
        $result .= '        </div>';
        $result .= '    </div>';
        $result .= '</div>';

        $cent++;

        if ($cent % $a["rows"] == 0)
            $result .= '</li>';
    }

    if ($cent % $a["rows"] != 0)
            $result .= '</li>';

    $result .= '</ul>';

    

    add_action('wp_footer', 'last_portfolio_script');

    $id_shorcode_portfolio_count++;

    return $result;
}

function last_portfolio_script()
{
    ?> <script>
    $(document).ready(function(){ <?php

    global $id_shorcode_portfolio_count;

    for ($i = 0; $i < $id_shorcode_portfolio_count; $i++)
    { ?>
        $('#latest-works<?php echo $i; ?>').bxSlider({
            hideControlOnEnd: true,
            minSlides: 2,
            maxSlides: 4,
            slideWidth: 275,
            slideMargin: 10,
            pager: false,
            nextSelector: '#bx-next<?php echo $i; ?>',
            prevSelector: '#bx-prev<?php echo $i; ?>',
            nextText: '>',
            prevText: '<',
          })
        

    <?php }
 
    ?> }); </script> <?php
}

add_shortcode("last-portfolio", "sc_last_portfolio");



$id_shorcode_circles_count = 0;

function sc_circle($atts, $content = null)
{
    $result = '';

    global $id_shorcode_circles_count;

    $result = '<div class="circle" id="circles-' . $id_shorcode_circles_count . '"></div>';

    $a = shortcode_atts( array(
        'radius' => "60",
        'value' => "100",
        'maxValue' => "100",
        'width' => "5",
        'text' => "function(value) {return value + '%';}",
        'colors' => "['rgba(255,255,255,0.3)', '#fff']",
        'duration' => "1000"
    ), $atts );

    // Register the script
    wp_register_script( 'circles_custom', get_stylesheet_directory_uri() . '/js/circles_custom.js' );

    // Localize the script with new data
    $circle_array = array(
        'radius' => $a["radius"],
        'value' => $a["value"],
        'maxValue' => $a["maxValue"],
        'width' => $a["width"],
        'text' => $a["text"],
        'colors' => $a["colors"],
        'duration' => $a["duration"]
    );

    $num_circles = array("num" => $id_shorcode_circles_count);

    wp_localize_script( 'circles_custom', 'circle_' . $id_shorcode_circles_count , $circle_array );
    wp_localize_script( 'circles_custom', 'num_circles', $num_circles );

    // Enqueued script with localized data.
    wp_enqueue_script( 'circles_custom' );

    $id_shorcode_circles_count++;

    return $result;
}

add_shortcode("circle-js", "sc_circle");

/* Email Shortcode */

function sc_contact_form($atts, $content = null)
{
    extract( shortcode_atts( array(
        // if you don't provide an e-mail address, the shortcode will pick the e-mail address of the admin:
        "email" => get_bloginfo( 'admin_email' ),
        "subject" => "",
        "label_name" => "Your Name",
        "label_email" => "Your E-mail Address",
        "label_subject" => "Subject",
        "label_message" => "Your Message",
        "label_submit" => "Submit",
        // the error message when at least one of the required fields are empty:
        "error_empty" => "Please fill in all the required fields.",
        // the error message when the e-mail address is not valid:
        "error_noemail" => "Please enter a valid e-mail address.",
        // and the success message when the e-mail is sent:
        "success" => "Thanks for your e-mail! We'll get back to you as soon as we can."
    ), $atts ) );

    $result = '';

    // if the <form> element is POSTed, run the following code
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        $error = false;
        // set the "required fields" to check
        $required_fields = array( "your_name", "email", "message", "subject" );
     
        // this part fetches everything that has been POSTed, sanitizes them and lets us use them as $form_data['subject']
        foreach ( $_POST as $field => $value ) {
            if ( get_magic_quotes_gpc() ) {
                $value = stripslashes( $value );
            }
            $form_data[$field] = strip_tags( $value );
        }
     
        // if the required fields are empty, switch $error to TRUE and set the result text to the shortcode attribute named 'error_empty'
        foreach ( $required_fields as $required_field ) {
            $value = trim( $form_data[$required_field] );
            if ( empty( $value ) ) {
                $error = true;
                $result = $error_empty;
            }
        }
     
        // and if the e-mail is not valid, switch $error to TRUE and set the result text to the shortcode attribute named 'error_noemail'
        if ( ! is_email( $form_data['email'] ) ) {
            $error = true;
            $result = $error_noemail;
        }
     
        if ( $error == false ) {
            $email_subject = "[" . get_bloginfo( 'name' ) . "] " . $form_data['subject'];
            $email_message = $form_data['message'] . "\n\nIP: " . wptuts_get_the_ip();
            $headers  = "From: " . $form_data['name'] . " <" . $form_data['email'] . ">\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\n";
            $headers .= "Content-Transfer-Encoding: 8bit\n";
            wp_mail( $email, $email_subject, $email_message, $headers );
            $result = $success;
            $sent = true;
        }
        // but if $error is still FALSE, put together the POSTed variables and send the e-mail!
        if ( $error == false ) {
            // get the website's name and puts it in front of the subject
            $email_subject = "[" . get_bloginfo( 'name' ) . "] " . $form_data['subject'];
            // get the message from the form and add the IP address of the user below it
            $email_message = $form_data['message'] . "\n\nIP: " . wptuts_get_the_ip();
            // set the e-mail headers with the user's name, e-mail address and character encoding
            $headers  = "From: " . $form_data['your_name'] . " <" . $form_data['email'] . ">\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\n";
            $headers .= "Content-Transfer-Encoding: 8bit\n";
            // send the e-mail with the shortcode attribute named 'email' and the POSTed data
            wp_mail( $email, $email_subject, $email_message, $headers );
            // and set the result text to the shortcode attribute named 'success'
            $result = $success;
            // ...and switch the $sent variable to TRUE
            $sent = true;
        }
    }

    // if there's no $result text (meaning there's no error or success, meaning the user just opened the page and did nothing) there's no need to show the $info variable
    if ( $result != "" ) {
        $info = '<div class="alert alert-info">' . $result . '</div>';
    }

    $email_form = ' <form role="form" method="post" action="' . get_permalink() . '">
        <div class="form-group">
            <label for="cf_name">' . __('Name', 'artificial_reason') . '</label>
            <input type="text" class="form-control" name="your_name" id="cf_name" value="' . $form_data['your_name'] . '">
        </div>
        <div class="form-group">
            <label for="cf_email">' . __('Email address', 'artificial_reason') . '</label>
            <input type="email" class="form-control" name="email" id="cf_email" value="' . $form_data['email'] . '">
        </div>
        <div class="form-group">
            <label for="cf_subject">' . __('Subject', 'artificial_reason') . '</label>
            <input type="text" class="form-control" name="subject" id="cf_subject" value="' . $subject . $form_data['subject'] . '">
        </div>
        <div class="form-group">
            <label for="cf_message">' . __('Mesagge', 'artificial_reason') . '</label>
            <textarea class="form-control" name="message" id="cf_message" rows="8">' . $form_data['message'] . '</textarea>
        </div>
        <button type="submit" class="btn btn-ar btn-primary" name="send" id="cf_send">' . __('Submit', 'artificial_reason') . '</button>
        <div class="clearfix"></div>
    </form>';


    return $info . $email_form;

}

function wptuts_get_the_ip() {
    if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    else {
        return $_SERVER["REMOTE_ADDR"];
    }
}

add_shortcode("contact-form", "sc_contact_form");


function sc_search($atts, $content = null)
{
    $result = '';

    $result = '<form method="get" class="" id="searchform" action="' . esc_url( home_url( '/' ) ) . '">
       <div class="input-group">
            <input type="text" class="form-control input-lg" placeholder="' . esc_attr__('Have a Question?  Ask or enter a search term here', 'artificial_reason') .'." name="s" id="s">
            <span class="input-group-btn">
                <button class="btn btn-ar btn-lg btn-primary" type="submit">Search</button>
            </span>
        </div><!-- /input-group -->
    </form>';


    return $result;
}

add_shortcode("search-form", "sc_search");


/* Page Header Shortcode */

function sc_page_header($atts, $content = null)
{
    $result = '';

    $a = shortcode_atts( array(
        'radius' => "60"
    ), $atts );

    ?><header class="main-header no-margin-bottom">
        <div class="container">
            <h1 class="page-title"><?php the_title(); ?></h1>

            <ol class="breadcrumb pull-right">
                <?php if(function_exists('bcn_display_list')) {
                    bcn_display_list();
                } ?>
            </ol>
        </div>
    </header><?php

    return $result;
}

add_shortcode("page-header", "sc_page_header");


/* -------------------------------------------------------------------------- */
/* Automatic Default Pages */
/* -------------------------------------------------------------------------- */

/*if (isset($_GET['activated']) && is_admin())
{
    wp_insert_term('Portfolio', 'category', array(
        'description'=>'',
        'slug'=>sanitize_title('portfolio'),
        'parent'=>0
    ));

    $titles = array('Blog Right Sidebar', 'Blog Full', 'Blog Left Sidebar', 'Blog Alternative', 'Portfolio', 'Profile', 'Login', 'Register');
    $templates = array('page-blog.php', 'page-blog-full-php', 'page-blog-left.php', 'page-blog-alt.php', 'page-portfolio.php', 'page-profile.php', 'page-login.php', 'page-register.php');
    $i;

    for ($i = 0; $i < count($titles); $i++)
    {
        $page_check = get_page_by_title($titles[$i]);
        if(isset($page_check->ID))
            continue;

        $page = array(
            'post_type' => 'page',
            'post_title' => $titles[$i],
            'post_status' => 'publish',
            'post_author' => 1);

        $page_id = wp_insert_post($page);
        update_post_meta($page_id, '_wp_page_template', $templates[$i]);
    }
}*/


/* -------------------------------------------------------------------------- */
/* Include scripts */
/* -------------------------------------------------------------------------- */
function include_scripts($scripts = NULL)
{
    static $lists_include_scripts = '';

    if ($scripts != NULL)
    {
        foreach ($scripts as $script)
        {
            $lists_include_scripts .= '<script src="' . get_template_directory_uri() . '/js/' . $script . '.js"></script>';
        }
    }
    else
    {
        echo $lists_include_scripts;
        $lists_include_scripts = '';
    }
        
}


// Register Custom Taxonomy
function filter_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Filters', 'Taxonomy General Name', 'artificial_reason' ),
        'singular_name'              => _x( 'Filter', 'Taxonomy Singular Name', 'artificial_reason' ),
        'menu_name'                  => __( 'Filters', 'artificial_reason' ),
        'all_items'                  => __( 'All Filters', 'artificial_reason' ),
        'parent_item'                => __( 'Parent Filter', 'artificial_reason' ),
        'parent_item_colon'          => __( 'Parent Filter:', 'artificial_reason' ),
        'new_item_name'              => __( 'New Filter Name', 'artificial_reason' ),
        'add_new_item'               => __( 'Add New Filter', 'artificial_reason' ),
        'edit_item'                  => __( 'Edit Filter', 'artificial_reason' ),
        'update_item'                => __( 'Update Filter', 'artificial_reason' ),
        'separate_items_with_commas' => __( 'Separate filters with commas', 'artificial_reason' ),
        'search_items'               => __( 'Search Filters', 'artificial_reason' ),
        'add_or_remove_items'        => __( 'Add or remove filters', 'artificial_reason' ),
        'choose_from_most_used'      => __( 'Choose from the most used filters', 'artificial_reason' ),
        'not_found'                  => __( 'Not Found', 'artificial_reason' ),
    );
    $rewrite = array(
        'slug'                       => 'filter',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => $rewrite,
    );
    register_taxonomy( 'filter', array( 'portfolio_items' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'filter_taxonomy', 0 );


// Register Custom Post Type
function portfolio_post_type() {

    $labels = array(
        'name'                => _x( 'Portfolio Items', 'Post Type General Name', 'artificial_reason' ),
        'singular_name'       => _x( 'Portfolio Item', 'Post Type Singular Name', 'artificial_reason' ),
        'menu_name'           => __( 'Portfolio', 'artificial_reason' ),
        'parent_item_colon'   => __( 'Parent Item:', 'artificial_reason' ),
        'all_items'           => __( 'All Items', 'artificial_reason' ),
        'view_item'           => __( 'View Item', 'artificial_reason' ),
        'add_new_item'        => __( 'Add New Item', 'artificial_reason' ),
        'add_new'             => __( 'Add New', 'artificial_reason' ),
        'edit_item'           => __( 'Edit Item', 'artificial_reason' ),
        'update_item'         => __( 'Update Item', 'artificial_reason' ),
        'search_items'        => __( 'Search Item', 'artificial_reason' ),
        'not_found'           => __( 'Not found', 'artificial_reason' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'artificial_reason' ),
    );
    $rewrite = array(
        'slug'                => 'portfolio',
        'with_front'          => true,
        'pages'               => true,
        'feeds'               => true,
    );
    $args = array(
        'label'               => __( 'portfolio_items', 'artificial_reason' ),
        'description'         => __( 'Elements of the Portfolio section', 'artificial_reason' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail'),
        'taxonomies'          => array( 'filter' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'query_var'           => 'portfolio',
        'rewrite'             => $rewrite,
        'capability_type'     => 'post',
    );
    register_post_type( 'portfolio_items', $args );

}

// Hook into the 'init' action
add_action( 'init', 'portfolio_post_type', 0 );

/* -------------------------------------------------------------------------- */
/* Disable Widgets unused */
/* -------------------------------------------------------------------------- */

// unregister all widgets
 function unregister_default_widgets()
 {
     unregister_widget('WP_Widget_Search');
 }
 add_action('widgets_init', 'unregister_default_widgets', 11);


/* -------------------------------------------------------------------------- */
/* Google Captcha */
/* -------------------------------------------------------------------------- */
 
/** reCAPTCHA header script */
function header_script()
{
    echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
}

/** Output the reCAPTCHA form field. */
function display_captcha()
{
    if (of_get_option('enable_recaptcha'))
    {
        $public_key = of_get_option('captcha_public', '');
        echo '<div class="g-recaptcha" data-sitekey="' . $public_key . '"></div>';
    }
}

/**
 * Send a GET request to verify CAPTCHA challenge
 *
 * @return bool
 */
function captcha_verification()
{
    if (of_get_option('enable_recaptcha'))
    {
        $private_key = of_get_option('captcha_private', '');
        $response = isset( $_POST['g-recaptcha-response'] ) ? esc_attr( $_POST['g-recaptcha-response'] ) : '';
        $remote_ip = $_SERVER["REMOTE_ADDR"];
     
        // make a GET request to the Google reCAPTCHA Server
        $request = wp_remote_get('https://www.google.com/recaptcha/api/siteverify?secret=' . $private_key . '&response=' . $response . '&remoteip=' . $remote_ip);
     
        // get the request response body
        $response_body = wp_remote_retrieve_body( $request );
        $result = json_decode( $response_body, true );
        return $result['success'];
    }

    return true;
}




?>