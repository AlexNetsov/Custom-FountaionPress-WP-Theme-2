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
	<div class="footer-container offer-footer">
		<footer class="footer">
			<span class="brought-to-you"><?php _e( 'This fantastic offer was brought to you by:', 'ttv' )?></span>
			<div class="offer-bottom-logos">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="ttv-offer-logo" rel="nofollow" target="_blank">
					<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-logo-dark.png' ?>" height="58px" width="320px" />
				</a>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="ttv-offer-logo-mobile" rel="nofollow" target="_blank">
					<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-logo-vertical-dark.png' ?>" height="105px" width="271px" />
				</a>
				<?php 
					if(get_field('offer_partner_logo')){
				?>
					<a href="<?php the_field('offer_partner_link') ?>" class="fo-offer-logo" rel="nofollow" target="_blank">
						<img src="<?php the_field('offer_partner_logo'); ?>" width="207px" />
					</a>
				<?php
					}
				?>
			</div>
			<span class="copyright">&#169;<?php _e( "2017 The Tenants' Voice Ltd.", 'ttv' )?></span>
		</footer>
	</div>

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
