<?php
/**
 * The Template for displaying all single posts.
 */
?>
<?php get_header(); ?>

<div id="content">

	<?php while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="title">
				<?php edit_post_link( __( 'Edit', 'theme' ) ); ?>
				
				<h1><?php the_title(); ?></h1>

				<div class="meta">
					Last Updated: <?php the_modified_date() ?> <?php the_modified_time() ?> CST
				</div>
			</div>

			<?php the_content(); ?>
		</div>

	<?php endwhile; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>