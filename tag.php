<?php
/**
 * The template used to display Tag Archive pages
 */
?>
<?php get_header(); ?>

<div class="content">

	<?php if ( have_posts() ) : ?>

		<h3>
			<?php
			printf( __( '%d results for "%s"', 'theme' ), $wp_query->found_posts, '<span>' . single_tag_title( '', false ) . '</span>' );
			?>
		</h3>

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
