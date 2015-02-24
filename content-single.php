<?php
/**
 * @package portland
 */
?>
 
    
<?php // the featured image with default settings
    the_featured_image("featured", "ig-mayfair noisy"); 
?>

<header class="entry-header single-featured-image col s6 offset-s3">
    <div class="col s6 single-post-title post-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </div>
    <div class="col s6 single-post-title post-meta right">
		<div class="entry-meta">
			<?php portland_posted_on(); ?>
        </div><!-- .entry-meta --></div>
	</header><!-- .entry-header -->

<article id="post-<?php the_ID(); ?>" class="col s10 offset-s1">
	

	<div class="entry-content inline-comments">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'portland' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php portland_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
