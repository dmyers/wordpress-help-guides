<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */
?>
<?php get_header(); ?>

<div class="content">

	<?php if ( have_posts() ) : ?>

		<h3>
			<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: %s', 'theme' ), '<span>' . get_the_date() . '</span>' ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: %s', 'theme' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'theme' ) ) . '</span>' ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: %s', 'theme' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'theme' ) ) . '</span>' ); ?>
			<?php else : ?>
				<?php _e( 'Blog Archives', 'theme' ); ?>
			<?php endif; ?>
		</h3>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_preview() ?>

		<?php endwhile; ?>

		<?php theme_pagination(); ?>

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