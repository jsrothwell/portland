<?php
/**
 * The template for displaying all single posts.
 *
 * @package portland
 */

get_header(); ?>

	<div id="primary" class="content-area">
        
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
            <?php // the featured image with default settings
    the_featured_image(); 
?>
            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<?php get_template_part( 'content', 'single' ); ?>
            </article>
			

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
            
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer('single'); ?>
