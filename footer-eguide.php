<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

</div><!-- Close container -->
	<div class="footer-container eguide-footer">
		<footer class="footer">
			<span class="brought-to-you"><?php _e( 'Brought to you by:', 'ttv' )?></span>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" rel="nofollow" target="_blank">
				<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-logo-vertical-dark.png' ?>" height="99px" width="260px" />
			</a>
			<span class="copyright">&#169;<?php _e( "2017 The Tenants' Voice Ltd.", 'ttv' )?></span>
		</footer>
	</div>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
	</div><!-- Close off-canvas content -->
<?php endif; ?>

<?php wp_footer(); ?>
<?php 
	$forms_html = get_field('single_form_html');
	if($forms_html){
		foreach($forms_html as $single_form){
			echo $single_form['form_html'];
		}
	}
?>
</body>
</html>
