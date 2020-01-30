<?php
/**
 * The template for displaying all advice from us pages
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header();

// SHOW YOAST PRIMARY CATEGORY, OR FIRST CATEGORY
$category = get_the_category();
$useCatLink = true;
// If post has a category assigned.
if ($category){
	$category_display = '';
	$category_link = '';
	if ( class_exists('WPSEO_Primary_Term') )
	{
		// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
		$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
		$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
		$term = get_term( $wpseo_primary_term );
		if (is_wp_error($term)) { 
			// Default to first category (not Yoast) if an error is returned
			$category_display = $category[0]->name;
			$category_link = get_category_link( $category[0]->term_id );
		} else { 
			// Yoast Primary category
			$category_display = $term->name;
			$category_link = get_category_link( $term->term_id );
		}
	} 
	else {
		// Default, display the first category in WP's list of assigned categories
		$category_display = $category[0]->name;
		$category_link = get_category_link( $category[0]->term_id );
	}	
}
 ?>

<div class="main-wrap">
	<main class="main-content">
		<div class="ttv-breadcrumbs">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumbs-link"><?php _e( 'Home', 'ttv' )?></a>
			<span class="breadcrumbs-separator">/</span>
			<a href="/help-and-advice" class="breadcrumbs-link"><?php _e( 'Help & Advice', 'ttv' )?></a>
			<span class="breadcrumbs-separator">/</span>
			<a href="<?php echo $category_link ?>" class="breadcrumbs-link"><?php echo htmlspecialchars($category_display) ?></a>
			<span class="breadcrumbs-separator">/</span>
			<span class="breadcrumbs-current-page"><?php the_title() ?></span>
		</div>
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
				<?php	the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php the_excerpt(); ?>
				<?php if(get_field('top_call_to_action')){
						echo '<div class="top-cta-container">';
						the_field('top_call_to_action');
						echo '</div>';
					  }
				?>
				<div class="separator-line"></div>
				</header>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<footer>
					<?php if(get_field('bottom_offer_link')) {?>
					<a href="<?php the_field('bottom_offer_link')?>" class="bottom-offer" style="background: url(<?php the_field('bottom_offer_image');?>)">
						<div class="white-overlay"></div>
						<div class="slide-logo-row over-white-overlay">
							<img class="tenants-slider-logo" src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-logo-dark.png' ?>" width="100px" height="18px">
						</div>
						<h4 class="slide-title over-white-overlay"><?php the_field('bottom_offer_title'); ?></h4>
						<h5 class="slide-subtitle over-white-overlay"><?php the_field('bottom_offer_subtitle'); ?></h5>
					</a>
					<?php }?>
				</footer>
			</article>
		<?php endwhile;?>
	</main>
	<aside class="sidebar advice-sidebar">
		<?php 
			if (get_field('advice_sidebar_img')){
		?>
			<img src="<?php the_field('advice_sidebar_img')?>" width="100%"/>
		<?php
			}
		?>
		<?php if(get_field('single_form_html')){?>
			<div class="sidebar-call-to-action">
				<a data-fancybox data-src="#popup-form" href="javascript:;"><?php _e( 'Download', 'ttv' )?></a>
				<strong><?php _e( 'the eGuide to get your', 'ttc' )?></strong>
				<br>
				<strong><?php _e( 'FREE', 'ttv' )?></strong>
				<strong><?php _e( 'sample letter', 'ttv' )?></strong>
				<ul>
					<li><?php _e( 'Sample letters to send out', 'ttv' )?></li>
					<li><?php _e( 'Pre-written templates', 'ttv' )?></li>
					<li><?php _e( 'Useful contacts', 'ttv' )?></li>
				</ul>
				<span><?php _e( 'and lots more...', 'ttv' )?></span>	
			</div>
			<a data-fancybox data-src="#popup-form" href="javascript:;" class="download-button"><?php _e( 'Download now for FREE !', 'ttv' )?></a>
		<?php } ?>
		<?php 
			$offer_id = get_field('advice_from_us_sidebar_offer');
		?>
		<?php if($offer_id && $offer_id != 0) {?>
		<a href="<?php echo get_permalink( $offer_id );?>" class="single-slide side-offer" style="background: url(<?php echo get_the_post_thumbnail_url($offer_id, 'full');?>)">
			<?php 
				$new_label = get_field('ttv_single_offer_show_new_label',$offer_id);

				if(in_array('yes', $new_label)){
					echo '<span class="slider-new-label">NEW</span>';
				}
			?>
			<div class="white-overlay"></div>
			<div class="slide-logo-row over-white-overlay">
				<img class="tenants-slider-logo" src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-logo-dark.png' ?>" width="100px" height="18px">
				<img class="fs-slider-logo" src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/fantastic-services-logo.png' ?>" width="68px" height="28px">
			</div>
			<h4 class="slide-title over-white-overlay"><?php echo get_field('ttv_single_offer_embed_title', $offer_id); ?></h4>
			<h5 class="slide-subtitle over-white-overlay"><?php echo get_field('ttv_single_offer_subtitle', $offer_id); ?></h5>
		</a>
		<?php }?>
	</aside>
</div>
<?php $args = array(
	'posts_per_page'   => 12,
	'offset'           => 0,
	'orderby'          => 'rand',
	'post_type'        => 'eguide',
	'post_status'      => 'publish',
);
$eguides_array = get_posts( $args );
?>
<div class="popular-downloads-container">
	<h2>
		<?php _e( 'Other Popular', 'ttv' )?>
		<strong><?php _e( 'FREE', 'ttv' )?></strong>
		<?php _e( 'Downloads', 'ttv' )?>
	</h2>
	<div class="owl-carousel owl-theme popular-slider">
		<?php 
			foreach($eguides_array as $single_eguide){
				echo '<a href="'.get_permalink($single_eguide->ID).'">
					  	<div class="image-container" style="background:url('.get_the_post_thumbnail_url($single_eguide->ID, 'full').')"></div>
					  	<div class="meta-container">
					  		<p>'.$single_eguide->post_title.'</p>
					  		<span>'.__( 'Download the <b>FREE</b> eGuide now', 'ttv' ).'</span>
					  	</div>
					  </a>';
			}
		?>
	</div>
</div>
<?php get_footer();
