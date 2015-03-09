<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace( "/\W/", "_", strtolower( $themename ) );
	return $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'portland'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// If using image radio buttons, define a directory path
	$imagepath =  trailingslashit( get_template_directory_uri() ) . 'images/';

	// Background Defaults
	$background_defaults = array(
		'color' => '#222222',
		'image' => $imagepath . 'dark-noise.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' );

	// Editor settings
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	// Footer Position settings
	$footer_position_settings = array(
		'left' => esc_html__( 'Left aligned', 'portland' ),
		'center' => esc_html__( 'Center aligned', 'portland' ),
		'right' => esc_html__( 'Right aligned', 'portland' )
	);

	$options = array();

	$options[] = array(
		'name' => esc_html__( 'Basic Settings', 'portland' ),
		'type' => 'heading' );

	$options[] = array(
		'name' => esc_html__( 'Background', 'portland' ),
		'desc' => sprintf( wp_kses( __( 'If you&rsquo;d like to replace or remove the default background image, use the <a href="%1$s" title="Custom background">Appearance &gt; Background</a> menu option.', 'portland' ), array( 
			'a' => array( 
				'href' => array(),
				'title' => array() )
			) ), admin_url( 'themes.php?page=custom-background' ) ),
		'type' => 'info' );

	$options[] = array(
		'name' => esc_html__( 'Logo', 'portland' ),
		'desc' => sprintf( wp_kses( __( 'If you&rsquo;d like to replace or remove the default logo, use the <a href="%1$s" title="Custom header">Appearance &gt; Header</a> menu option.', 'portland' ), array( 
			'a' => array( 
				'href' => array(),
				'title' => array() )
			) ), admin_url( 'themes.php?page=custom-header' ) ),
		'type' => 'info' );

	$options[] = array(
		'name' => esc_html__( 'Social Media Settings', 'portland' ),
		'desc' => esc_html__( 'Enter the URLs for your Social Media platforms. You can also optionally specify whether you want these links opened in a new browser tab/window.', 'portland' ),
		'type' => 'info' );

	$options[] = array(
		'name' => esc_html__('Open links in new Window/Tab', 'portland'),
		'desc' => esc_html__('Open the social media links in a new browser tab/window', 'portland'),
		'id' => 'social_newtab',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => esc_html__( 'Twitter', 'portland' ),
		'desc' => esc_html__( 'Enter your Twitter URL.', 'portland' ),
		'id' => 'social_twitter',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Facebook', 'portland' ),
		'desc' => esc_html__( 'Enter your Facebook URL.', 'portland' ),
		'id' => 'social_facebook',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Google+', 'portland' ),
		'desc' => esc_html__( 'Enter your Google+ URL.', 'portland' ),
		'id' => 'social_googleplus',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'LinkedIn', 'portland' ),
		'desc' => esc_html__( 'Enter your LinkedIn URL.', 'portland' ),
		'id' => 'social_linkedin',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'SlideShare', 'portland' ),
		'desc' => esc_html__( 'Enter your SlideShare URL.', 'portland' ),
		'id' => 'social_slideshare',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Dribbble', 'portland' ),
		'desc' => esc_html__( 'Enter your Dribbble URL.', 'portland' ),
		'id' => 'social_dribbble',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Tumblr', 'portland' ),
		'desc' => esc_html__( 'Enter your Tumblr URL.', 'portland' ),
		'id' => 'social_tumblr',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'GitHub', 'portland' ),
		'desc' => esc_html__( 'Enter your GitHub URL.', 'portland' ),
		'id' => 'social_github',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Bitbucket', 'portland' ),
		'desc' => esc_html__( 'Enter your Bitbucket URL.', 'portland' ),
		'id' => 'social_bitbucket',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Foursquare', 'portland' ),
		'desc' => esc_html__( 'Enter your Foursquare URL.', 'portland' ),
		'id' => 'social_foursquare',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'YouTube', 'portland' ),
		'desc' => esc_html__( 'Enter your YouTube URL.', 'portland' ),
		'id' => 'social_youtube',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Instagram', 'portland' ),
		'desc' => esc_html__( 'Enter your Instagram URL.', 'portland' ),
		'id' => 'social_instagram',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Flickr', 'portland' ),
		'desc' => esc_html__( 'Enter your Flickr URL.', 'portland' ),
		'id' => 'social_flickr',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Pinterest', 'portland' ),
		'desc' => esc_html__( 'Enter your Pinterest URL.', 'portland' ),
		'id' => 'social_pinterest',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'RSS', 'portland' ),
		'desc' => esc_html__( 'Enter your RSS Feed URL.', 'portland' ),
		'id' => 'social_rss',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Advanced settings', 'portland' ),
		'type' => 'heading' );

	$options[] = array(
		'name' =>  esc_html__( 'Banner Background', 'portland' ),
		'desc' => esc_html__( 'Select an image and background color for the homepage banner.', 'portland' ),
		'id' => 'banner_background',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' => esc_html__( 'Footer Background Color', 'portland' ),
		'desc' => esc_html__( 'Select the background color for the footer.', 'portland' ),
		'id' => 'footer_color',
		'std' => '#222222',
		'type' => 'color' );

	$options[] = array(
		'name' => esc_html__( 'Footer Content', 'portland' ),
		'desc' => esc_html__( 'Enter the text you&lsquo;d like to display in the footer. This content will be displayed just below the footer widgets. It&lsquo;s ideal for displaying your copyright message or credits.', 'portland' ),
		'id' => 'footer_content',
		'std' => portland_get_credits(),
		'type' => 'editor',
		'settings' => $wp_editor_settings );

	$options[] = array(
		'name' => esc_html__( 'Footer Content Position', 'portland' ),
		'desc' => esc_html__( 'Select what position you would like the footer content aligned to.', 'portland' ),
		'id' => 'footer_position',
		'std' => 'center',
		'type' => 'select',
		'class' => 'mini',
		'options' => $footer_position_settings );


	return $options;
}
