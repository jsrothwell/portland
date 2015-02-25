<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package portland
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site row">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'portland' ); ?></a>

	<header id="masthead" class="site-header col s12" role="banner">
		<div class="col s12 offset-s1">
            <div class="site-branding col s10 m6">
			<h1 class="site-title col s12"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<!--h2 class="site-description">< ?php bloginfo( 'description' ); ?></h2-->
            
		</div><!-- .site-branding -->
           <div class="col s2 m6"> 
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( '<i class="mdi-navigation-menu"></i>', 'portland' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'header-menu-dropdown', 'container_class' => 'header-menu-container right' ) ); ?>
            </div>
		</nav><!-- #site-navigation -->
            </div>

	</header><!-- #masthead -->

	<div id="content" class="site-content col s12">
