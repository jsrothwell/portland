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

	<footer id="colophon" class="site-footer col s12 offset-s1" role="contentinfo">
        
        
		
            <div id="secondary" class="widget-area col s4" role="complementary">
	<?php dynamic_sidebar( 'sidebar-4' ); ?>
	</div>	
		    <div id="secondary" class="widget-area col s4" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>	
	<div id="secondary" class="widget-area col s4" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>


		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
