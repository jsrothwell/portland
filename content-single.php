<?php
/**
 * @package portland
 */
?>
 
    


<header class="entry-header single-featured-image col s10 offset-s1">
    <div class="col s12 single-post-title post-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </div><hr />
    
    <div class="col s12 right single-post-title post-meta">
		<div class="entry-meta">
			<?php portland_posted_on(); ?>
        </div><!-- .entry-meta --></div>
	</header><!-- .entry-header -->

<article id="post-<?php the_ID(); ?>" class="col s10 offset-s1 copy-body">
	

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
