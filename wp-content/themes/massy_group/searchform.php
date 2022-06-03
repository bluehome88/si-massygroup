<?php
/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/*
 * Generate a unique ID for each form and a string containing an aria-label
 * if one was passed to get_search_form() in the args array.
 */
?>

<form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="margin-bottom: 0px;">
	<input type="text" class="header_search" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>">
</form>
