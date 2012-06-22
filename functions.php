<?php
/**
 * Help Guides functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, theme_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'theme_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override theme_setup() in a child theme, add your own theme_setup to your child theme's
 * functions.php file.
 */
function theme_setup() {}
/**
 * Tell WordPress to run theme_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'theme_setup' );

/**
 * Load our theme scripts.
 */
function theme_load_scripts() {
    wp_enqueue_style( 'farbtastic' );
    wp_enqueue_script( 'farbtastic' );
}
/**
 * Tell WordPress to run theme_load_scripts() when the 'init' hook is run.
 */
add_action( 'init', 'theme_load_scripts' );

/**
 * Register our sidebars and widgetized areas.
 */
function theme_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'theme' ),
		'id' => 'sidebar-1',
		'description' => __( 'Site sidebar', 'theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/**
 * Tell WordPress to run theme_widgets_init() when the 'widgets_init' hook is run.
 */
add_action( 'widgets_init', 'theme_widgets_init' );

/**
 * Sets the post excerpt length to 20 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function theme_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'theme_excerpt_length' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with a read more link.
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function theme_auto_excerpt_more( $more ) {
	global $post;
	return '&hellip; ' . '<a href="'. get_permalink($post->ID) . '" class="highlight">Read More</a>';;
}
add_filter( 'excerpt_more', 'theme_auto_excerpt_more' );

/**
 * Changes any external link to have rel="nofollow".
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function theme_auto_nofollow( $content ) {
	return theme_rel_nofollow( $content );
}
add_filter( 'the_content', 'theme_auto_nofollow' );

/**
 * Adds a class to the edit post link.
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function theme_edit_post_link( $edit_link ) {
	return str_replace('class="post-edit-link"', 'class="post-edit-link highlight"', $edit_link);
}
add_filter('edit_post_link', 'theme_edit_post_link');

function theme_css() {
	// Use the getlastmod date of the CSS style file for the version to help update cache.
	$version = filemtime(realpath(dirname(__FILE__)).'/style.css');

	wp_register_style( 'style', get_template_directory_uri() . '/style.css', array(), $version, 'all' );

	wp_enqueue_style( 'style' );
}

function theme_breadcrumbs() {
	if (is_home()) {
		return;
	}
	?>
	<div class="breadcrumbs">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">Help</a> ›

		<?php if (is_search() || is_tag()): ?>
			Search
		<?php endif; ?>

		<?php if (is_category()): ?>
			<?php $category = get_category( get_cat_id( single_cat_title('', false) ) ); ?>
			<?php echo $category->name ?>
		<?php endif; ?>

		<?php if (is_single()): ?>
			<?php $categories = get_the_category(); ?>
			<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" title="<?php echo esc_attr( $categories[0]->name ); ?>"><?php echo $categories[0]->name ?></a> ›
		<?php endif; ?>

		<?php if (is_single() || is_page()): ?>
			<?php the_title(); ?>
		<?php endif; ?>

		<?php if (is_404()): ?>
			Page Not Found
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Display navigation to next/previous pages.
 */
function the_pagination() {
	global $wp_query;

	$total_pages = $wp_query->max_num_pages;
	
	if ($total_pages <= 1) {
		return;
	}
	
	$current_page = max(1, get_query_var('paged'));

	$pagination_config = array(
		'base' => get_pagenum_link(1) . '%_%',
		'format' => 'page/%#%',
		'current' => $current_page,
		'total' => $total_pages,
		'prev_text' => '&lt;&lt;',
		'next_text' => '&gt;&gt;',
	);
	?>
	<div class="pagination">
		<?php echo paginate_links($pagination_config); ?>
	</div>
	<?php
}

function the_preview() {
	?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		
		<?php the_excerpt(); ?>

		<div class="meta">
			<?php the_modified_date(); ?> <?php the_modified_time(); ?>
		</div>
	</div>
	<?php
}

/**
 * Adds rel nofollow string to all HTML A elements in content.
 *
 * @param string $text Content that may contain HTML A elements.
 * @return string Converted content.
 */
function theme_rel_nofollow( $text ) {
	// This is a pre save filter, so text is already escaped.
	$text = stripslashes($text);
	$text = preg_replace_callback('|<a (.+?)>|i', 'wp_rel_nofollow_callback', $text);
	//$text = esc_sql($text);
	return $text;
}