<?php
/**
Template Name: All Tags
 */

get_header();
?>
<div class="top-archieve-container" >
	<div class="ttv-breadcrumbs">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumbs-link"><?php _e( 'Home', 'ttv' )?></a>
		<span class="breadcrumbs-separator">/</span>
		<span class="breadcrumbs-current-page"><?php _e( 'Help & Advice', 'ttv' )?></span>
	</div>
	<h1><?php _e( 'Explore our articles.', 'ttv' )?></h1>
	<span class="archieve-subtitle"><?php _e( 'Everything you need to know about renting and living in the UK.', 'ttv' )?>
		<br>
		<?php _e( 'Masterfully crafted online guides about the important topics in renting !', 'ttv' )?>
	</span>
	<div class="landing-top-bg" style="background: url(<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-landing-bg.png' ?>)" ></div>
</div>
<div class="main-wrap full-width">
	<div class="ajax-loader" style="display: none"></div>
	<main class="main-content">
		<div class="filters-row">
			<button class="all-topics">
				<?php _e( 'View all topics', 'ttv' )?>
				<i class="fa fa-chevron-down" aria-hidden="true"></i>
			</button>
			<div class="current-topics">
			</div>
		</div>
		<div class="all-topics-row" style="display: none">
			<?php 
				$terms = get_terms( array(
				    'taxonomy' => 'post_tag',
				    'hide_empty' => true,
				    'orderby' => 'count',
				    'order' => 'DESC',
				) );
				foreach($terms as $single_term){
					echo '<a class="not-selected-term" term-id='.$single_term->term_id.'>'.$single_term->name.' ('.$single_term->count.')</a>';
				}
			?>
		</div>
		<div class="grid-x medium-up-3 articles-container">
			<?php 
				$posts_displayed = 0;
				
				// Display featured offer
				$args_featured_offer = array(
					'posts_per_page'   => 1,
					'offset'           => 0,
					'post_type'        => 'offer',
					'post_status'      => 'publish',
					'tax_query' => array(
						array(
							'taxonomy' => 'offer-type',
							'field'    => 'slug',
							'terms'    => 'archive-featured',
						),
					),
				);
								
				$featured_offer_query = new WP_Query( $args_featured_offer );
				if ( $featured_offer_query->have_posts() ) {
					while ( $featured_offer_query->have_posts() ) {
						$featured_offer_query->the_post();
						
						$offer_id = get_the_ID();
			
						$new_label_html = '';
						$new_label = get_field('ttv_single_offer_show_new_label',$offer_id);

						if(in_array('yes', $new_label)){
							$new_label_html = '<span class="slider-new-label">NEW</span>';
						}
						echo '<a href="'.get_permalink( $offer_id ).'" class="single-slide cell" style="background: url('.get_the_post_thumbnail_url($offer_id, 'full').')">'.$new_label_html.'
										<div class="white-overlay"></div>
										<div class="slide-logo-row over-white-overlay">
											<img class="tenants-slider-logo" src="'.get_stylesheet_directory_uri() .'/src/assets/images/ttv-logo-dark.png' .'" width="100px" height="18px">
											<img class="fs-slider-logo" src="'.get_stylesheet_directory_uri() .'/src/assets/images/fantastic-services-logo.png' .'" width="68px" height="28px">
										</div>
										<h4 class="slide-title over-white-overlay">'.get_field('ttv_single_offer_embed_title', $offer_id).'</h4>
										<h5 class="slide-subtitle over-white-overlay">'.get_field('ttv_single_offer_subtitle', $offer_id).'</h5>
									</a>';
						$posts_displayed++;
					}
					
					/* Restore original Post Data */
					wp_reset_postdata();
				}
			?>
			<?php 
				// Display featured eGuides
				$args_featured_eguides = array(
					'posts_per_page'   => 3,
					'offset'           => 0,
					'post_type'        => 'eguide',
					'post_status'      => 'publish',
					'tax_query' => array(
						array(
							'taxonomy' => 'guide-type',
							'field'    => 'slug',
							'terms'    => 'archive-featured',
						),
					),
				);
								
				$featured_eguides_query = new WP_Query( $args_featured_eguides );
				if ( $featured_eguides_query->have_posts() ) {
					while ( $featured_eguides_query->have_posts() ) {
						$featured_eguides_query->the_post();
						$eguide_id = get_the_ID();
						
						echo '<a href="'.get_permalink($eguide_id) .'" class="single-post-inmenu cell">
										<div class="image-container" style="background:url('.get_the_post_thumbnail_url($eguide_id, 'full').')"></div>
										<div class="content-container">
											<span class="post-heading">'.get_the_title( $eguide_id ).'</span>
											<span>'. __( 'Download the ', 'ttv' ).'
												<strong>'. __( 'FREE', 'ttv' ).'</strong>'.
												__( 'eGuide now', 'ttv' ).'
											</span>
										</div>
									</a>';
						$posts_displayed++;
					}
					
					/* Restore original Post Data */
					wp_reset_postdata();
				}
			?>
			<?php 
				// Fullfill the rest of the grid with term posts
					$term_posts_to_display = 9 - $posts_displayed;
					$current_taxonomy = get_taxonomy('post_tag');
					$args_term_posts = array(
						'posts_per_page'   => $term_posts_to_display,
						'offset'           => 0,
						'post_type'        => $current_taxonomy->object_type,
						'post_status'      => 'publish',
						'orderby'          => 'date',
						'order'            => 'DESC',
					);
									
					$term_posts_query = new WP_Query( $args_term_posts );
					if ( $term_posts_query->have_posts() ) {
						while ( $term_posts_query->have_posts() ) {
							$term_posts_query->the_post();
							$term_post_id = get_the_ID();
							
							echo '<a href="'.get_the_permalink().'" class="single-post-ingrid cell">
								<div class="image-container" style="background:url('.get_the_post_thumbnail_url($term_post_id->ID,'full').')"></div>
								<div class="content-container">
									<h3 class="post-heading">'.get_the_title( $term_post_id ).'</h3>
									<span class="post-term"></span>
									<div class="bottom-meta">
										<span class="date">'.get_the_date('d F Y', $term_post_id).'</span>
										<span class="views"></span>
									</div>
								</div>
							</a>';
						}
						
						wp_reset_postdata();
					}
	
			?>
			<?php 
				$post_type_array = array();
				foreach($current_taxonomy->object_type as $key => $value){
					array_push($post_type_array, $value);
				}
			?>
		</div>
		<div class="ttv-gradient-button view-all-container">
			<a class="vc_btn3 view-all-button" href="#" title=""><?php _e( 'View more guides', 'ttv' )?></a>
		</div>
		<div class="query-vars" term-posts-to-display="<?php echo $term_posts_to_display ?>" taxonomy="post_tag" style="display: none"></div>
		<div class="post-type" style="display: none"><?php echo json_encode($post_type_array) ?></div>
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
