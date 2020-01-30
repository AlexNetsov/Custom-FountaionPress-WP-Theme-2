<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<?php 
	// Define values for all the colors
	$blue = '#017DC3';
	$green = '#299F8B';
	$purple = '#8E478F';
	
	$ltblue = 'rgba(1,125,195,0.05)';
	$ltgreen = '#ECF5F3';
	$ltpurple = '#FDFAFF';
		
	// Define eguide global dark and light colors
	global $eg_dark;
	global $eg_light;
	
	// Assign correct colors
	$theme_color = get_field('theme_color');
	if($theme_color == 'blue'){
		$eg_dark = $blue;
		$eg_light = $ltblue;
	}
	else if ($theme_color == 'green'){
		$eg_dark = $green;
		$eg_light = $ltgreen;
	}
	else if ($theme_color == 'purple'){
		$eg_dark = $purple;
		$eg_light = $ltpurple;
	}
	else {
		$eg_dark = $blue;
		$eg_light = $ltblue;
	}
	
?>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>


	<header class="site-header eguide-header" role="banner" style="background:<?php echo $eg_dark;?>">
		<div class="eguide-header-inner">
			<span><?php _e( 'Visit the Tenants Voice website', 'ttv' ); ?></span>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="eguide-header-button" style="color:<?php echo $eg_dark;?>" rel="nofollow" target="_blank"><?php _e( 'Go', 'ttv' ); ?></a>
		</div>
	</header>

	<div class="container">
		<div class="share-container">
			<a href="https://twitter.com/intent/tweet?url=<?php echo home_url( $wp->request );?>" rel="nofollow" target="_blank">
				<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/social-twitter.png' ?>" width="40px" height="40px"/>
			</a>
			
			<a onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+'<?php echo home_url( $wp->request );?>','facebook-share-dialog','width=626, height=436');return false;" rel="nofollow" share_url="<?php echo home_url( $wp->request );?>" target="_blank" rel="nofollow">
				<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/social-facebook.png' ?>" width="40px" height="40px"/>	
			</a>
			<a href="https://plus.google.com/share?url=<?php echo home_url( $wp->request );?>" rel="nofollow" target="_blank">
				<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/social-gplus.png' ?>" width="40px" height="40px"/>
			</a>
		</div>
		<div class="share-container-mobile">
			<span><?php _e( 'share', 'ttv' )?></span>
			<a href="#" class="social-open">
				<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/social-open.png' ?>" width="40px" height="40px"/>
			</a>
			<a href="https://twitter.com/intent/tweet?url=<?php echo home_url( $wp->request );?>" class="mobile-share-social" rel="nofollow" target="_blank">
				<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/social-twitter.png' ?>" width="40px" height="40px"/>
			</a>
			<a onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+'<?php echo home_url( $wp->request );?>','facebook-share-dialog','width=626, height=436');return false;" class="mobile-share-social" rel="nofollow" share_url="<?php echo home_url( $wp->request );?>" target="_blank" rel="nofollow">
				<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/social-facebook.png' ?>" width="40px" height="40px"/>	
			</a>
			<a href="https://plus.google.com/share?url=<?php echo home_url( $wp->request );?>" class="mobile-share-social" rel="nofollow" target="_blank">
				<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/social-gplus.png' ?>" width="40px" height="40px"/>
			</a>
		</div>