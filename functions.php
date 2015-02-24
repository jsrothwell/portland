<?php
/**
 * portland functions and definitions
 *
 * @package portland
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'portland_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function portland_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on portland, use a find and replace
	 * to change 'portland' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'portland', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'portland' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'portland_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif; // portland_setup
add_action( 'after_setup_theme', 'portland_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function portland_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'portland' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'portland_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function portland_scripts() {
	wp_enqueue_style( 'portland-style', get_stylesheet_uri() );
// Main Style
    wp_enqueue_style( 'northwest-style',  get_stylesheet_directory_uri() . '/assets/css/style-min.css' );
// Main Scripts	    
    wp_enqueue_script( 'portland-scripts' , get_template_directory_uri() . '/assets/js/production.js' );
    wp_enqueue_script( 'portland-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
    wp_enqueue_script( 'portland-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
    wp_enqueue_script(  'materialize-js', get_template_directory_uri() . '/assets/bower_components/materialize/dist/js/materialize.min.js', array(), 'v0.95.2', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'portland_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Including TGM Plugin Activation
 */
require_once( get_template_directory() . '/library/vendors/tgm-plugin-activation/required-plugins.php' );

function so_comment_button() {
     
    echo '<button name="submit" class="waves-effect waves-light btn" type="submit" value="' . __( 'Post Comment', 'textdomain' ) . '" >Submit</button>';
     
}
 
add_action( 'comment_form', 'so_comment_button' );

//Remove "Protected:" from password protected posts and pages
function the_title_trim($title) {
	$title = esc_attr($title);
	$findthese = array(
		'#Protected:#',
		'#Private:#'
	);
	$replacewith = array(
		'', // What to replace "Protected:" with
		'' // What to replace "Private:" with
	);
	$title = preg_replace($findthese, $replacewith, $title);
	return $title;
}
add_filter('the_title', 'the_title_trim');

add_action( 'init', 'cd_add_editor_styles' );
/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
 */
function cd_add_editor_styles() {

    add_editor_style( get_stylesheet_uri() );

}

/**
* Featured Image function for posts and pages
* 
* @param  string $class The CSS class name to apply to the image default is .featured-img
* @param  string $size  The image size to use. Default is full size
* @return string        img -> width | height | src | class | alt
* 
*/
function the_featured_image( $size = 'full', $class = 'featured-img' ) {
 
    global $post;
 
    if ( has_post_thumbnail( $post->ID ) ) {
 
    /* get the title attribute of the post or page 
     * and apply it to the alt tag of the image if the alt tag is empty
     */
    $attachment_id = get_post_thumbnail_id( $post->ID );
 
    if ( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) === '' ) {
        // if no alt attribute is filled out then echo "Featured Image of article: Article Name"
        $title = the_title_attribute( 
            array( 
                'before' => __( 'Featured image of article: ', 'YOUR-THEME-TEXTDOMAIN' ), 
                'echo' => false
            ) 
        );
    } else {
        // the post thumbnail img alt tag
        $title = trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
    }
 
    $default_attr = array(
        'class' => $class,
        'alt' => $title,
    );
 
    // echo the featured image
    the_post_thumbnail( $size, $default_attr );
 
    } // end if has_post_thumbnail
}
add_filter( 'wpcf7_form_class_attr', 'your_custom_form_class_attr' );

function your_custom_form_class_attr( $class ) {
	$class .= ' col s12';
	return $class;
}