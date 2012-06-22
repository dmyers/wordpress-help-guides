<?php
/**
 * The template for displaying 404 pages (Not Found).
 */
?>
<?php get_header(); ?>

<div class="content">

	<div id="post-0" class="post error404 not-found">
		<h1>
			<?php _e( 'Sorry, we couldn\'t find that page.', 'theme' ); ?>
		</h1>
		
		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'theme' ); ?></p>

		<?php get_search_form(); ?>
	</div>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>