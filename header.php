<?php
/**
 * The Header for our theme.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	
	<title>
	<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	wp_title( '|', true, 'right' );
	?>
	</title>
	
	<?php add_action( 'wp_enqueue_scripts', 'theme_css' ); ?>
	
	<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>

	<div class="wrapper">
		<div class="help-link">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Help Guides</a>
		</div>

		<?php theme_breadcrumbs(); ?>
