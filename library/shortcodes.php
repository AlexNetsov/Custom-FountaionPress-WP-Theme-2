<?php 
// [fast-facts]
function fast_facts_func( $atts ) {
	$facts = '<div class="fast-facts">
						<h3>'. __( 'Fast facts', 'ttv' ).'</h3>'.
						get_field('fast_facts').'</div>';
    return $facts;
}
add_shortcode( 'fast-facts', 'fast_facts_func' );

// [featured-offers]
function featured_offers_func( $atts ) {
	$offers = '';
	
	$all_offers = get_field('featured_offer');
	if ($all_offers) {
		$offers = '<div class="featured-offers">';
		
		foreach ($all_offers as $single_offer) {
			$offer_id = $single_offer['ttv_advice_featured_offer'];
			
			$new_label_html = '';
			$new_label = get_field('ttv_single_offer_show_new_label',$offer_id);

			if(in_array('yes', $new_label)){
				$new_label_html = '<span class="slider-new-label">NEW</span>';
			}
			$offers .= '<a href="'.get_permalink( $offer_id ).'" class="single-slide single-featured-offer" style="background: url('.get_the_post_thumbnail_url($offer_id, 'full').')">'.
							$new_label_html.'
							<div class="white-overlay"></div>
							<div class="slide-logo-row over-white-overlay">
								<img class="tenants-slider-logo" src="'.get_stylesheet_directory_uri() .'/src/assets/images/ttv-logo-dark.png' .'" width="100px" height="18px">
								<img class="fs-slider-logo" src="'.get_stylesheet_directory_uri() .'/src/assets/images/fantastic-services-logo.png' .'" width="68px" height="28px">
							</div>
							<h4 class="slide-title over-white-overlay">'.get_field('ttv_single_offer_embed_title', $offer_id).'</h4>
							<h5 class="slide-subtitle over-white-overlay">'.get_field('ttv_single_offer_subtitle', $offer_id).'</h5>
						</a>';
		}
		$offers .= '</div>';
		
	}
	
    return $offers;
}
add_shortcode( 'featured-offers', 'featured_offers_func' );

// [download-separator bottom-border="yes"]
function download_separator_func( $atts ) {
	$a = shortcode_atts( array(
        'bottom-border' => 'yes',
    ), $atts );
    $border_bottom_html = '';
    if ($a['bottom-border'] != 'yes') {
	    $border_bottom_html = 'style="border-bottom:none"';
    }
	$separator = '<div class="download-seperator"'.$border_bottom_html.'>
						<a data-fancybox data-src="#popup-form" href="javascript:;">Download</a>
						<span>your FREE sample letters and pre-written templates now!</span>
						<span class="return-to-top">Back to top</a>
				  </div>';
    return $separator;
}
add_shortcode( 'download-separator', 'download_separator_func' );

// [separator bottom-border="yes"]
function separator_func( $atts ) {
	$a = shortcode_atts( array(
        'bottom-border' => 'yes',
    ), $atts );
    $border_bottom_html = '';
    if ($a['bottom-border'] != 'yes') {
	    $border_bottom_html = 'style="border-bottom:none"';
    }
	$separator = '<div class="download-seperator"'.$border_bottom_html.'>
						<span class="return-to-top">Back to top</a>
				  </div>';
    return $separator;
}
add_shortcode( 'separator', 'separator_func' );
?>