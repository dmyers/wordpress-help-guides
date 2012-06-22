<?php
/**
 * The template for displaying search forms.
 */
?>
<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form search-small">
	<input type="text" name="s" placeholder="<?php esc_attr_e( 'Enter a search term here.', 'theme' ); ?>" class="search" />
	<input type="submit" name="submit" value="<?php esc_attr_e( 'Search', 'theme' ); ?>" class="search-submit" />
</form>
