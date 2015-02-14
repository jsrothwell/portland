<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package portland
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer container" role="contentinfo">
        
        
        <div class="row">
		<div class="site-info col s12">
			
		</div><!-- .site-info -->
           </div>
	</footer><!-- #colophon -->
<div class="fixedBar">
<div class="boxfloat">

<div class="left floatingFooter borderRight valign-wrapper"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
<div class="right floatingFooter borderLeft valign-wrapper"><a href="#Top"> Back to Top… </a></div>

</div>
</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
