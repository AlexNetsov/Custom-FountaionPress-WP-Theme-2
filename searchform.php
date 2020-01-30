<?php
/**
 * The template for displaying search form
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
 ?>

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<div class="input-group">
		<div class="input-group-button">
			<input type="submit" id="searchsubmit" value="" class="button" style="background-image: url(<?php echo get_stylesheet_directory_uri() .'/src/assets/images/icons/search-icon.png' ?>)">
		</div>
		<input type="text" class="input-group-field" value="" name="s" id="s" placeholder="<?php esc_attr_e( 'Enter keywords', 'ttv' ); ?>">
	</div>
</form>
