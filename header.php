<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
 
global $wp;
?>
<!doctype html>
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
	
	<div class="mobile-menu-overlay" style="display: none"></div>
	<header class="site-header" role="banner">
		<div class="site-title-bar title-bar" data-responsive-toggle="mobile-menu" data-hide-for="mobilemenu">
			<div class="title-bar-left">
				<button class="mobile-search" not-clicked-icon="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/icons/search-icon.png' ?>" clicked-icon="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/icons/cross-icon-blue.png' ?>">
					<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/icons/search-icon.png' ?>" width="22px" height="22px" />
				</button>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-logo.png' ?>" height="40px" width="222px" />
				</a>
				<button class="menu-icon" type="button" data-toggle="<?php foundationpress_mobile_menu_id(); ?>"></button>
			</div>
		</div>

		<nav class="site-navigation top-bar" role="navigation">
			<div class="top-bar-left">
				<div class="site-desktop-title top-bar-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-logo.png' ?>" height="38px" width="209px" />
					</a>
				</div>
			</div>
			<div class="top-bar-right">
				<div class="desktop-search-form">
					<?php get_search_form(); ?>
				</div>
				<button class="top-search" not-clicked-icon="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/icons/search-icon.png' ?>" clicked-icon="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/icons/cross-icon.png' ?>"><img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/icons/search-icon.png' ?>" width="26px" height="25px" /></button>
				<?php foundationpress_top_bar_r(); ?>

				<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
					<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
				<?php endif; ?>
			</div>
		</nav>
		<div class="submenus">
			<?php 
				$submenus = get_field('single_dropdown', 'option');
				$indexes_array = array();
				foreach($submenus as $single_submenu) {
					array_push($indexes_array,$single_submenu['menu_label_index']);
			?>
					
					<div id="submenu-item-<?php echo $single_submenu['menu_label_index'] ?>" custom-menu-index="<?php echo $single_submenu['menu_label_index'] ?>" class="grid-x" style="display: none;">
						<div class="cell medium-6">
							<h3><?php echo $single_submenu['label_title']?></h3>
							<span><?php echo $single_submenu['label_excerpt']?></span>
							<div class="grid-x medium-up-2">
								<?php 
									$tax_args =array(
										'taxonomy' => $single_submenu['taxonomy_to_showcase'],
										'orderby' => 'count',
										'order' => 'DESC',
										'number' => 11,
										'exclude' => array(548,511,536,506),
									);
									$tax_terms = get_terms( $tax_args );
									foreach($tax_terms as $single_term){
										$term_link = get_term_link($single_term->term_id);
										
								?>
										<a href="<?php echo $term_link ?>" class="cell"><?php echo $single_term->name.' ('.$single_term->count.')'; ?></a>
								<?php
									}
								?>
							</div>
						</div>
						<div class="cell medium-6">
							<?php $image_showcases = $single_submenu['single_image_box'];
								  foreach($image_showcases as $single_image_showcase){
									  $type_of_content = $single_image_showcase['content_to_showcase'];
									  if ($type_of_content == 'custom') {
									?>

									<a href="<?php echo $single_image_showcase['custom_link']?>" class="single-post-inmenu">
										<div class="image-container" style="background:url(<?php echo $single_image_showcase['custom_image']?>)"></div>
										<div class="content-container">
											<span class="post-heading"><?php echo $single_image_showcase['custom_text']?></span>
										</div>
									</a>
									<?php  
									  }
									  else if ($type_of_content == 'eguide'){
										  $eguide_id = $single_image_showcase['eguide_to_show'];
									?>
									<a href="<?php echo get_permalink($eguide_id)?>" class="single-post-inmenu">
										<div class="image-container" style="background:url(<?php echo get_the_post_thumbnail_url($eguide_id, 'full')?>)"></div>
										<div class="content-container">
											<span class="post-heading"><?php echo get_the_title( $eguide_id )?></span>
											<span><?php _e( 'Download the ', 'ttv' )?>
												<strong><?php _e( 'FREE', 'ttv' )?></strong>
												<?php _e( 'eGuide now', 'ttv' )?>
											</span>
										</div>
									</a>
									<?php
									  }
								  }
								  
							?>
						</div>
					</div>
			<?php
				}
			?>
			<div class="indexes-container" style="display: none !important">
				<?php foreach($indexes_array as $s){
					echo $s.',';
					}
				?>
			</div>
		</div>
		<div class="mobile-search-form" style="display: none">
			<form role="search" method="get" id="mobile-searchform" action="<?php echo home_url( '/' ); ?>">
				<div class="input-group">
					<div class="input-group-button">
						<input type="submit" id="mobilesearchsubmit" value="" class="button" style="display: none;">
					</div>
					<input type="text" class="input-group-field" value="" name="s" id="mobiles" placeholder="<?php esc_attr_e( 'Search for...', 'ttv' ); ?>">
				</div>
			</form>
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

