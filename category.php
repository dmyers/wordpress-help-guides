<?php
/**
 * The template for displaying Category Archive pages.
 */
?>
<?php get_header(); ?>

<div class="content">

	<?php if ( have_posts() ) : ?>
		
		<h3><?php echo single_cat_title( '', false ) ?></h3>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_preview() ?>

		<?php endwhile; ?>

		<?php the_pagination(); ?>

	<?php else : ?>

		<div id="post-0" class="post no-results not-found">
			<h1><?php _e( 'Nothing Found', 'theme' ); ?></h1>
		
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'theme' ); ?></p>
			
			<?php get_search_form(); ?>
		</div>

	<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
