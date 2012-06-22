<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */
?>
<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php theme_search('search-large', 'Have a question? Ask or enter a search term here.'); ?>

	<div class="content">

		<h3>Browse By Topic</h3>

		<?php
		$categories = get_categories();
		$category_count = count($categories);
		$c = 1;
		?>

		<div class="categories">

			<?php foreach ($categories as $category): ?>

				<div class="category">
					<div class="category-title">
						<h4><?php echo $category->name ?></h4>
					</div>

					<div class="category-meta">
						<span class="category-total">
							<?php echo $category->category_count ?> Articles
						</span>

						<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="highlight category-view-all">VIEW ALL</a>
					</div>

					<ul class="category-posts">
						<?php //get_most_viewed_category($category->term_id, 'both', 5); ?>
						
						<?php $posts = get_posts(array('category' => $category->term_id, 'numberposts' => 5)); ?>

						<?php foreach ($posts as $post ): ?>
						
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

						<?php endforeach; ?>

					</ul>
				</div>

				<?php if ($c % 2 === 0): ?>
					<div class="clearfix"></div>
				<?php endif; ?>

				<?php $c++; ?>

			<?php endforeach; ?>

			<?php if ($category_count % 2 !== 0): ?>
				<div class="clearfix"></div>
			<?php endif; ?>

		</div>

	</div>

<?php else : ?>

	<div id="content">

		<div id="post-0" class="post no-results not-found">
			<h1><?php _e( 'Nothing Found', 'theme' ); ?></h1>
			
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'theme' ); ?></p>
				
			<?php get_search_form(); ?>
		</div>

	</div>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>