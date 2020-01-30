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
	<div class="footer-container">
		<footer class="footer grid-x">
			<div class="small-12 medium-4 cell">
				<img class="ttv-footer-logo" src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-logo-dark.png' ?>" width="378px" height="67px"/>
			</div>
			<div class="small-12 medium-4 cell">
				<p class="socials-heading"><?php _e( 'Connect with us on:', 'ttv-theme' )?></p>
				<div class="footer-socials-container">
					<a href="<?php the_field('twitter_link', 'option')?>" rel="nofollow" target="_blank">
						<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/social-twitter.png' ?>" width="40px" height="40px"/>
					</a>
					<a href="<?php the_field('facebook_link', 'option')?>" rel="nofollow" target="_blank">
						<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/social-facebook.png' ?>" width="40px" height="40px"/>	
					</a>
					<a href="<?php the_field('google_plus_link', 'option')?>" rel="nofollow" target="_blank">
						<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/social-gplus.png' ?>" width="40px" height="40px"/>
					</a>
				</div>
			</div>
			<div class="small-12 medium-4 cell vertical-mobile-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="ttv-offer-logo-mobile" rel="nofollow" target="_blank">
					<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-logo-vertical-dark.png' ?>" height="105px" width="271px" />
				</a>
			</div>
			<div class="small-12 medium-4 cell logos-cell">
				<div class="footer-logos-container">
					<p><?php _e( "In proud partnership with", 'ttv-theme' )?></p>
					<a href="https://www.fantasticservices.com/" rel="nofollow" target="_blank">
						<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/fantastic-services-logo.png' ?>" width="116px" height="48px"/>
					</a>
					<a href="https://www.baseps.co.uk/" rel="nofollow" target="_blank">
						<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/base-logo.png' ?>" width="83px" height="43px"/>
					</a>
				</div>
			</div>
		</footer>
		<div class="footer-top-menu">
			<?php 
				wp_nav_menu( array(
					'container'      => false,                         // Remove nav container
					'menu'           => __( 'footer-top', 'foundationpress' ),
					'menu_class'     => 'menu',
					'theme_location' => 'footer-top',
					'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
					'fallback_cb'    => false,
					'walker'         => new Foundationpress_Mobile_Walker(),
				));
			?>
		</div>
		<div class="footer-logos-container-mobile">
			<p><?php _e( "In proud partnership with", 'ttv-theme' )?></p>
			<a href="https://www.fantasticservices.com/" rel="nofollow" target="_blank">
				<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/fantastic-services-logo.png' ?>" width="116px" height="48px"/>
			</a>
			<a href="https://www.baseps.co.uk/" rel="nofollow" target="_blank">
				<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/base-logo.png' ?>" width="83px" height="43px"/>
			</a>
		</div>
		<div class="footer-bottom-menu">
			<?php 
				wp_nav_menu( array(
					'container'      => false,                         // Remove nav container
					'menu'           => __( 'footer-bottom', 'foundationpress' ),
					'menu_class'     => 'menu',
					'theme_location' => 'footer-bottom',
					'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
					'fallback_cb'    => false,
					'walker'         => new Foundationpress_Mobile_Walker(),
				));
			?>
		</div>
		<div class="ttv-copyright">
			<?php _e( "©2017 The Tenants' Voice Ltd.", 'ttv-theme' )?>
		</div>
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
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . '/owl-carousel/owl.carousel.min.css' ?>" async>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . '/owl-carousel/owl.theme.default.min.css' ?>" async>
</body>
</html>
