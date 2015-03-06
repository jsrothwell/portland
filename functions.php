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
    wp_enqueue_script(  'materialize-js', get_template_directory_uri() . '/assets/bower_components/materialize/dist/js/materialize.js', array(), 'v0.95.2', true );
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
//require get_template_directory() . '/inc/template-tags.php';

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

/**
 * Prints HTML with meta information for current post: author and date
 *
 * @since portland 1.0
 *
 * @return void
 */
if ( ! function_exists( 'portland_posted_on' ) ) {
	function portland_posted_on() {
		$post_icon = '';
		switch ( get_post_format() ) {
			case 'aside':
				$post_icon = 'mdi-editor-insert-drive-file';
				break;
			case 'audio':
				$post_icon = 'mdi-av-volume-up';
				break;
			case 'chat':
				$post_icon = 'mdi-communication-comment';
				break;
			case 'gallery':
				$post_icon = 'mdi-image-camera';
				break;
			case 'image':
				$post_icon = 'mdi-action-picture-in-picture';
				break;
			case 'link':
				$post_icon = 'mdi-content-link';
				break;
			case 'quote':
				$post_icon = 'mdi-editor-format-quote';
				break;
			case 'status':
				$post_icon = 'mdi-action-account-box';
				break;
			case 'video':
				$post_icon = 'mdi-av-videocam';
				break;
			default:
				$post_icon = 'mdi-action-bookmark-outline';
				break;
		}

		// Translators: 1: Icon 2: Permalink 3: Post date and time 4: Publish date in ISO format 5: Post date
		$date = sprintf( '<div class="posted-on">Posted on: <a href="%2$s" title="Posted %3$s" rel="bookmark"><time class="entry-date" datetime="%4$s" itemprop="datePublished">%5$s</time></a></div>',
			$post_icon,
			esc_url( get_permalink() ),
			sprintf( esc_html__( '%1$s @ %2$s', 'portland' ), esc_html( get_the_date('m,d,Y') ), esc_attr( get_the_time() ) ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date('m,F,Y') )
		);

		// Translators: 1: Date link 2: Author link 3: Categories 4: No. of Comments
		$author = sprintf( '<div class="posted-by"><address class="author vcard">Posted by: <a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></address></div>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'portland' ), get_the_author() ) ),
			get_the_author()
		);

		// Return the Categories as a list
		$categories_list = get_the_category_list( esc_html__( ' ', 'portland' ) );

		// Translators: 1: Permalink 2: Title 3: No. of Comments
		$comments = sprintf( '<div class="posted-comments"><span class="comments-link"><a href="%1$s" title="%2$s"><i class="mdi-editor-insert-comment"></i> %3$s</a></span></div>',
			esc_url( get_comments_link() ),
			esc_attr( esc_html__( 'Comment on ' . the_title_attribute( 'echo=0' ) ) ),
			( get_comments_number() > 0 ? sprintf( _n( '%1$s Comment', '%1$s Comments', get_comments_number(), 'portland' ), get_comments_number() ) : esc_html__( 'No Comments', 'portland' ) )
		);

		// Translators: 1: Date 2: Author 3: Categories 4: Comments
		printf( wp_kses( __( '<div class="header-meta">%1$s%2$s<span class="post-categories">%3$s</span>%4$s</div>', 'portland' ), array( 
			'div' => array ( 
				'class' => array() ), 
			'span' => array( 
				'class' => array() ) ) ),
			$author,
            $date,
            $categories_list,
            ( is_search() ? '' : $comments )
			
		);
	}
}


/**
 * Prints HTML with meta information for current post: categories, tags, permalink
 *
 * @since portland 1.0
 *
 * @return void
 */
if ( ! function_exists( 'portland_entry_meta' ) ) {
	function portland_entry_meta() {
		// Return the Tags as a list
		$tag_list = "";
		if ( get_the_tag_list() ) {
			$tag_list = get_the_tag_list( '<span class="post-tags">', esc_html__( ' ', 'portland' ), '</span>' );
		}

		// Translators: 1 is tag
		if ( $tag_list ) {
			printf( wp_kses( __( '<i class="mdi-image-tag-faces"></i> %1$s', 'portland' ), array( 'i' => array( 'class' => array() ) ) ), $tag_list );
		}
	}
}

// Remove the WP version for extra WordPress Security
function remove_wp_version(){ 
return ''; 
} 
add_filter('the_generator', 'remove_wp_version'); 

// WP Typeahead. Add autocomplete search functionality to default WordPress search form. Originally created by c.bavota & Michal Bluma


class portland_WP_Typeahead {
	public $plugin_url;

	public function __construct() {
		$this->plugin_url = plugin_dir_url( __FILE__ );

		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );

		add_action( 'wp_ajax_nopriv_ajax_search', array( $this, 'ajax_search' ) );
		add_action( 'wp_ajax_ajax_search', array( $this, 'ajax_search' ) );
	}

	/**
	 * Enqueue Typeahead.js and the stylesheet
	 *
	 * @since 1.0.0
	 */
	public function wp_enqueue_scripts() {
		wp_enqueue_script( 'wp_typeahead_js', get_template_directory_uri() . '/js/typeahead.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'wp_hogan_js' , get_template_directory_uri() . '/js/hogan.min.js', array( 'wp_typeahead_js' ), '', true );
		wp_enqueue_script( 'typeahead_wp_plugin' , get_template_directory_uri() . '/js/wp-typeahead.js', array( 'wp_typeahead_js', 'wp_hogan_js' ), '', true );

		$wp_typeahead_vars = array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) );
		wp_localize_script( 'typeahead_wp_plugin', 'wp_typeahead', $wp_typeahead_vars );

		//wp_enqueue_style( 'wp_typeahead_css', get_template_directory_uri() . '/css/typeahead.css' );
	}

	/**
	 * Ajax query for the search
	 *
	 * @since 1.0.0
	 */
	public function ajax_search() {
		if ( isset( $_REQUEST['fn'] ) && 'get_ajax_search' == $_REQUEST['fn'] ) {
			$search_query = new WP_Query( array(
				's' => $_REQUEST['terms'],
				'posts_per_page' => 10,
				'no_found_rows' => true,
			) );

			$results = array( );
			if ( $search_query->get_posts() ) {
				foreach ( $search_query->get_posts() as $the_post ) {
					$title = get_the_title( $the_post->ID );
					$results[] = array(
						'value' => $title,
						'url' => get_permalink( $the_post->ID ),
						'tokens' => explode( ' ', $title ),
					);
				}
			} else {
				$results[] = __( 'Sorry. No results match your search.', 'wp-typeahead' );
			}

			wp_reset_postdata();
			echo json_encode( $results );
		}
		die();
	}
}
$portland_wp_typeahead = new portland_WP_Typeahead;