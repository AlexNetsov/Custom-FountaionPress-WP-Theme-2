<?php
/**
 * The template for displaying single eGuides
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header('eguide');
$ttv_logo_margin = '';
if(!get_field('offer_partner_logo')){
	$ttv_logo_margin = 'style="margin-left:0;"';
} 
?>

<div class="offer-header-image-container" style="background: url(<?php the_field('offer_single_page_top_image')?>)">
	<div class="white-overlay"></div>
	<div class="offer-logos-container over-white-overlay">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="offer-top-logo">
			<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-logo-dark.png' ?>" <?php echo $ttv_logo_margin ?>height="53px" width="290px" />
		</a>
		<?php 
			if(get_field('offer_partner_logo')){
		?>
			<a href="<?php the_field('offer_partner_link') ?>" class="offer-top-logo-right" rel="nofollow" target="_blank">
				<img src="<?php the_field('offer_partner_logo'); ?>" width="199px" />
			</a>
		<?php
			}
		?>
	</div>
	<h1 class="over-white-overlay"><?php the_field('ttv_single_offer_title'); ?></h1>
	<span class="over-white-overlay"><?php the_field('ttv_single_offer_page_subtitle'); ?></span>
	<a href="<?php the_field('ttv_single_offer_offer_link') ?>" class="download-button over-white-overlay" rel="nofollow" target="_blank"><?php _e( 'Claim my offer NOW !', 'ttv' )?></a>
	<div class="mobile-bg" style="background: url(<?php the_field('offer_single_page_top_image')?>); display: none;">
		<div class="mobile-gradient"></div>
	</div>
	<div class="landing-top-bg over-white-overlay" style="background: url(<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-landing-bg.png' ?>)" >
		<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/house-icon.png' ?>" width="42px" height="41px" />
	</div>
</div>
<div class="main-wrap full-width">
	<main class="main-content">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<footer>

				</footer>
			</article>
		<?php endwhile;?>
	</main>
</div>
<?php get_footer('offer');
