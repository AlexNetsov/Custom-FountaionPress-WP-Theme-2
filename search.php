<?php
/**
 * The template for displaying search page
 *
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header();
global $post;
?>
<div class="top-archieve-container" >
	<div class="ttv-breadcrumbs">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumbs-link"><?php _e( 'Home', 'ttv' )?></a>
		<span class="breadcrumbs-separator">/</span>
		<span class="breadcrumbs-current-page"><?php _e( 'Search', 'ttv' )?></span>
	</div>
	<h1><?php _e( 'Search Results for ', 'ttv' )?>
		<span style="color:#017dc3;"><?php echo get_search_query(); ?></span>
	</h1>
	<div class="landing-top-bg" style="background: url(<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-landing-bg.png' ?>)" ></div>
</div>
<div class="main-wrap full-width">
	<main class="main-content">
		<div class="grid-x medium-up-3 articles-container">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<a href="<?php echo get_the_permalink() ?>" class="single-post-ingrid cell">
						<div class="image-container" style="background:url(<?php echo get_the_post_thumbnail_url($post->ID,'full') ?>)"></div>
						<div class="content-container">
							<h3 class="post-heading"><?php the_title() ?></h3>
							<span class="post-term"></span>
							<div class="bottom-meta">
								<span class="date"><?php echo get_the_date('d F Y') ?></span>
								<span class="views"></span>
							</div>
						</div>
					</a>
				<?php endwhile; ?>
		
				<?php else : ?>
					<h2 class="no-search-results"><?php _e( 'No results for ', '' ) ?> <?php echo get_search_query(); ?></h2>
			<?php endif; ?>
		</div>
	</main>
</div>
<?php $args = array(
	'posts_per_page'   => 12,
	'offset'           => 0,
	'orderby'          => 'rand',
	'post_type'        => 'offer',
	'post_status'      => 'publish',
);
$offers_array = get_posts( $args );
?>
<div class="popular-downloads-container">
	<h2>
		<?php _e( 'Popular Offers and Discounts', 'ttv' ); ?>
	</h2>
	<div class="owl-carousel owl-theme popular-slider">
		<?php 
			foreach($offers_array as $single_offer){
				echo '<a href="'.get_permalink( $single_offer->ID ).'" class="single-slide" style="background: url('.get_the_post_thumbnail_url($single_offer->ID, 'full').')">'.
							$new_label_html.'
							<div class="white-overlay"></div>
							<div class="slide-logo-row over-white-overlay">
								<img class="tenants-slider-logo" src="'.get_stylesheet_directory_uri() .'/src/assets/images/ttv-logo-dark.png' .'" width="100px" height="18px">
								<img class="fs-slider-logo" src="'.get_stylesheet_directory_uri() .'/src/assets/images/fantastic-services-logo.png' .'" width="68px" height="28px">
							</div>
							<h4 class="slide-title over-white-overlay">'.get_field('ttv_single_offer_embed_title', $single_offer->ID).'</h4>
							<h5 class="slide-subtitle over-white-overlay">'.get_field('ttv_single_offer_subtitle', $single_offer->ID).'</h5>
						</a>';
			}
		?>
	</div>
</div>
<div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid landing-sign-up-row vc_custom_1512570976122 vc_row-has-fill" style="position: relative; box-sizing: border-box; width: 100%; padding-left: 35px; padding-right: 35px;"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper"><h2 style="color: #ffffff;text-align: center" class="vc_custom_heading">Sign up to our <b>FREE</b> newsletter</h2><h5 style="color: #ffffff;text-align: center" class="vc_custom_heading">Sign up to our weekly newsletter and be the first to hear about fantastic discounts and promotions</h5><div class="vc_row wpb_row vc_inner vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner "><div class="wpb_wrapper"><p style="font-size: 18px;color: #ffffff;text-align: left" class="vc_custom_heading">Get expert crafted online guides to help you solve renting issues !</p><p style="font-size: 18px;color: #ffffff;text-align: left" class="vc_custom_heading">Get FREE tools and resource to help you manage your rental property !</p></div></div></div><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner "><div class="wpb_wrapper"><p style="font-size: 18px;color: #ffffff;text-align: left" class="vc_custom_heading">Keep up with industry news and regulations in the renting sector. Be the first to know !</p><p style="font-size: 18px;color: #ffffff;text-align: left" class="vc_custom_heading">Get discounts and promotions exclusive for members of The Tenants' Voice !</p></div></div></div></div><a class="ttv-form-button" data-fancybox="" data-src="#popup-form" href="javascript:;">Sign up now!</a></div></div></div></div>

<?php get_footer('archive');
