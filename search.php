<?php
/**
 * The template for displaying Search Results pages.
 */
?>
<?php get_header(); ?>

<div id="content">

	<h3>
		<?php printf( __( '%d results for "%s"', 'theme' ), $wp_query->found_posts, '<span>' . get_search_query() . '</span>' ); ?>
	</h3>

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_preview() ?>

		<?php endwhile; ?>

		<?php the_pagination(); ?>

	<?php else : ?>

		<div id="post-0" class="post no-results not-found">
			<p><?php _e( 'Sorry. Try searching again or submit a ticket.', 'theme' ); ?></p>
		</div>

	<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>