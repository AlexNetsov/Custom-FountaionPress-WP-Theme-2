<?php 
// eGuides testimonials
vc_map( array(
	"name" => __("Double testimonials", "icg"),
	"base" => "double_testimonials",
	"show_settings_on_create" => true,
	"category" => 'ttv',
	"params" => array(
	    array(
			'type' => 'textarea',
			'heading' => __( 'Left testimonial content', 'ttv' ),
			'param_name' => 'left_testimonial_content',
		),
	    array(
	        "type" => "textarea",
	        "heading" => __("Left testimonial person name", "ttv"),
	        "param_name" => "left_testimonial_name",
	    ), 
	    array(
	        "type" => "attach_image",
	        "heading" => __("Left testimonial person photo", "ttv"),
	        "param_name" => "left_testimonial_photo",
	    ), 
	    array(
			'type' => 'textarea',
			'heading' => __( 'Right testimonial content', 'ttv' ),
			'param_name' => 'right_testimonial_content',
		),
	    array(
	        "type" => "textarea",
	        "heading" => __("Right testimonial person name", "ttv"),
	        "param_name" => "right_testimonial_name",
	    ), 
	    array(
	        "type" => "attach_image",
	        "heading" => __("Right testimonial person photo", "ttv"),
	        "param_name" => "right_testimonial_photo",
	    ), 
	),
) );

if(!function_exists('double_testimonials')) {
	function double_testimonials( $atts, $content = null) {
		extract(shortcode_atts(array(
			'left_testimonial_content' => 'Lorem ipsum',
			'left_testimonial_name' => '',
			'left_testimonial_photo' => '',
			'right_testimonial_content' => '',
			'right_testimonial_name' => '',
			'right_testimonial_photo' => '',

		), $atts));
        
		$blue = '#017DC3';
		$green = '#299F8B';
		$purple = '#8E478F';
			
		$eg_dark;

		
		$theme_color = get_field('theme_color');
		if($theme_color == 'blue'){
			$eg_dark = $blue;
		}
		else if ($theme_color == 'green'){
			$eg_dark = $green;
		}
		else if ($theme_color == 'purple'){
			$eg_dark = $purple;
		}
		else {
			$eg_dark = $blue;
			$theme_color = 'blue';
		}
		
		if($left_testimonial_photo){
			$left_testimonial_photo = wp_get_attachment_image_src( $left_testimonial_photo, 'full');
			$left_testimonial_photo_src = $left_testimonial_photo['0'];
			$left_testimonial_photo_src_html = '<img class="t-photo" src="'.$left_testimonial_photo_src.'" />';
		}
		else {
			$left_testimonial_photo_src_html = '';
		}
		
		if($right_testimonial_photo){
			$right_testimonial_photo = wp_get_attachment_image_src( $right_testimonial_photo, 'full');
			$right_testimonial_photo_src = $right_testimonial_photo['0'];
			$right_testimonial_photo_src_html = '<img class="t-photo" src="'.$right_testimonial_photo_src.'" />';
		}
		else {
			$right_testimonial_photo_src_html = '';
		}
        
        $output = '<div class="double-testimonials-container grid-x">
			  			<div class="cell small-12 medium-6 single-testimonial">
			  				<div class="testimonial-content" style="background:'.$eg_dark.'">'.$left_testimonial_content.'
			  				<span class="bottom-triangle" style="background:url('.get_stylesheet_directory_uri().'/src/assets/images/t-bottom-triangle-'.$theme_color.'.png)"></span></div>
			  				<div class="testimonial-meta">
			  				'.$left_testimonial_photo_src_html.'
			  				<div class="t-name">'.$left_testimonial_name.'</div>
			  				</div>
			  			</div>
			  			<div class="cell small-12 medium-6 single-testimonial">
			  				<div class="testimonial-content" style="background:'.$eg_dark.'">'.$right_testimonial_content.'
			  				<span class="bottom-triangle" style="background:url('.get_stylesheet_directory_uri().'/src/assets/images/t-bottom-triangle-'.$theme_color.'.png)"></span></div>
			  				<div class="testimonial-meta">
			  					'.$right_testimonial_photo_src_html.'
			  					<div class="t-name">'.$right_testimonial_name.'</div>
			  				</div>
			  			</div>
			  	</div>'; 
        
        return $output;
	}
	add_shortcode('double_testimonials', 'double_testimonials');		
}

// Taxonomy cloud
if(!function_exists('ttv_taxonomy_cloud')) {
	function ttv_taxonomy_cloud( $atts, $content =  null) {
		extract(shortcode_atts(array(
			'tax_name' => 'category',
		), $atts));
        $terms = get_terms( array(
		    'taxonomy' => $tax_name,
		    'hide_empty' => true,
		) );
		
		$output = '';
		
		if ($terms) {
			$output .= '<div class="terms-cloud-container">';
			
			foreach ($terms as $single_term) {
				$term_url = get_term_link($single_term, $single_term->taxonomy);
				$output .= '<a class="single-term" href="'.$term_url.'">'.$single_term->name.' ('.$single_term->count.')</a>';
			}
			$output .= '</div>';
		} 
        
        return $output;
	}
	add_shortcode('ttv_taxonomy_cloud', 'ttv_taxonomy_cloud');		
}
add_action( 'vc_before_init', 'ttv_taxonomy_cloud_integrateWithVC' );
function ttv_taxonomy_cloud_integrateWithVC() {
	$all_taxonomies = get_taxonomies();
	vc_map( array(
		"name" => __("TTV Taxonomy cloud", "ttv"),
		"base" => "ttv_taxonomy_cloud",
		"show_settings_on_create" => true,
		"category" => 'ttv',
		"params" => array(
		    array(
				'type' => 'dropdown',
				'heading' => __( 'Select taxonomy', 'ttv' ),
				'param_name' => 'tax_name',
				'value' => $all_taxonomies,
			),
		),
	) );
}

// Posts grid
if(!function_exists('ttv_posts_grid')) {
	function ttv_posts_grid( $atts, $content =  null) {
       $atts = vc_map_get_attributes( 'ttv_posts_grid', $atts );
       $mini_term = $atts['ttv_post_grid_term_slug'];
       $featured_taxonomies = array(
	       'post' => 'category',
	       'eguide' => 'guide-type',
	       'advice_from_us' => 'category',
       );
       $taxonomies = get_object_taxonomies($atts['ttv_post_type']);
       $taxonomies_array_featured = array('relation' => 'OR');
       foreach($taxonomies as $single_taxonomy){
	       $taxonomies_array_featured[] = array(
					'taxonomy' => $single_taxonomy,
					'field'    => 'slug',
					'terms'    => 'featured',
				); 
       }

		$args_featured = array(
			'posts_per_page'   => 1,
			'offset'           => 0,
			'post_type'        => $atts['ttv_post_type'],
			'post_status'      => 'publish',
			'tax_query' => array(
				$taxonomies_array_featured,
			),
		);
		
		$output .= '<div class="ttv-posts-grid-container">';
		
		$featured_post_query = new WP_Query( $args_featured );
		// The Loop
		if ( $featured_post_query->have_posts() ) {
			
			while ( $featured_post_query->have_posts() ) {
				$featured_post_query->the_post();
				$featured_post_id = get_the_ID();
				$terms = wp_get_post_terms( get_the_ID(), $featured_taxonomies[$atts['ttv_post_type']] );
				$term_to_display = wp_get_post_terms($post_type_taxonomies[0]);
				$excerpt_html = '';

				$excerpt = get_the_excerpt();
				if ($excerpt) {
					$excerpt_html = '<span class="featured-excerpt">'.$excerpt.'</span>';
				}
				
				$output .= '<a href="'.get_the_permalink().'" class="single-post-ingrid featured-post">
								<div class="image-container" style="background:url('.get_the_post_thumbnail_url(get_the_ID(),'full').')"></div>
								<div class="content-container">
									<h3 class="featured-post-heading">'.get_the_title().'</h3>
									<span class="post-term">'.$term_to_display[0]->name.'</span>'
									.$excerpt_html.
									'<div class="bottom-meta">
										<span class="date">'.get_the_date('d F Y').'</span>
										<span class="views"></span>
									</div>
								</div>
							</a>';
			}
			
			/* Restore original Post Data */
			wp_reset_postdata();
		}
		
		$taxonomies_array_mini = array('relation' => 'OR');
		foreach($taxonomies as $single_taxonomy){
			$taxonomies_array_mini[] = array(
				'taxonomy' => $single_taxonomy,
				'field'    => 'slug',
				'terms'    => $mini_term,
			); 
		}
       
		$args = array(
			'posts_per_page'   => 4,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'exclude'          => array($featured_post_id),
			'post_type'        => $atts['ttv_post_type'],
			'post_status'      => 'publish',
			'tax_query' => array(
				$taxonomies_array_mini,
			),
		);
		$posts_array = get_posts( $args );
		foreach($posts_array as $single_post) {
			//var_dump($single_post);
			$terms = wp_get_post_terms( $single_post->ID, $featured_taxonomies[$atts['ttv_post_type']] );
			$term_to_display = wp_get_post_terms($post_type_taxonomies[0]);
			$output .= '<a href="'.get_the_permalink($single_post->ID).'" class="single-post-ingrid">
								<div class="image-container" style="background:url('.get_the_post_thumbnail_url($single_post->ID,'full').')"></div>
								<div class="content-container">
									<h3 class="post-heading">'.$single_post->post_title.'</h3>
									<span class="post-term">'.$term_to_display[0]->name.'</span>
									<div class="bottom-meta">
										<span class="date">'.get_the_date('d F Y', $single_post->ID).'</span>
										<span class="views"></span>
									</div>
								</div>
							</a>';
		}
		
		
        $output .= '</div>';
        return $output;
	}
	add_shortcode('ttv_posts_grid', 'ttv_posts_grid');		
}

add_action( 'vc_before_init', 'ttv_posts_grid_integrateWithVC' );
function ttv_posts_grid_integrateWithVC() {
	$all_post_types = get_post_types();
	vc_map( array(
		"name" => __("TTV Posts Grid", "ttv"),
		"base" => "ttv_posts_grid",
		"show_settings_on_create" => true,
		"category" => 'ttv',
		"params" => array(
		    array(
				'type' => 'dropdown',
				'heading' => __( 'Select post type', 'ttv' ),
				'param_name' => 'ttv_post_type',
				'value' => $all_post_types,
				'save_always' => true,
				'std' => 'Choose post type',
				'description' => __('What do you want to show in grid layout?'),
			),
			 array(
				'type' => 'textfield',
				'heading' => __( 'Enter term slug', 'ttv' ),
				'param_name' => 'ttv_post_grid_term_slug',
				'save_always' => true,
				'description' => __('Enter term slug from any taxonomy associated with the post type you chose.'),
			),
		),
	) );
}
// Posts slider
if(!function_exists('ttv_posts_slider')) {
	function ttv_posts_slider( $atts, $content =  null) {
		extract(shortcode_atts(array(
			'ttv_post_type_slider' => 'post',
		), $atts));
				
		$output = '';
		$all_slides = get_field('ttv_single_slide');
		if ($all_slides) {
			$output = '<div class="owl-carousel owl-theme ttv-slider">';
			
			foreach ($all_slides as $single_slide) {
				$offer_id = $single_slide['single_slider_featured_offer'];
				
				$new_label_html = '';
				$new_label = get_field('ttv_single_offer_show_new_label',$offer_id);

				if(in_array('yes', $new_label)){
					$new_label_html = '<span class="slider-new-label">NEW</span>';
				}
				$output .= '<a href="'.get_permalink( $offer_id ).'" class="single-slide" style="background: url('.get_the_post_thumbnail_url($offer_id, 'full').')">'.
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
			$output .= '</div>';
			
		}	
        
        return $output;
	}
	add_shortcode('ttv_posts_slider', 'ttv_posts_slider');		
}
add_action( 'vc_before_init', 'ttv_posts_slider_integrateWithVC' );
function ttv_posts_slider_integrateWithVC() {
	vc_map( array(
		"name" => __("TTV Posts Slider", "ttv"),
		"base" => "ttv_posts_slider",
		"show_settings_on_create" => false,
		"category" => 'ttv',
	) );
}

// Popup form button
if(!function_exists('ttv_form_button')) {
	function ttv_form_button( $atts, $content =  null) {
		extract(shortcode_atts(array(
			'ttv_form_id' => '',
			'ttv_button_text' => 'Lorem ipsum',
		), $atts));
				
				
		$output = '';
		if ($ttv_form_id) {
			$output .= '<a class="ttv-form-button" data-fancybox data-src="#'.$ttv_form_id.'" href="javascript:;">'.$ttv_button_text.'</a>';
			
		}	
     
        return $output;
	}
	add_shortcode('ttv_form_button', 'ttv_form_button');		
}
add_action( 'vc_before_init', 'ttv_form_button_integrateWithVC' );
function ttv_form_button_integrateWithVC() {
	vc_map( array(
		"name" => __("TTV Form Button", "ttv"),
		"base" => "ttv_form_button",
		"show_settings_on_create" => false,
		"category" => 'ttv',
		"params" => array(
		    array(
				'type' => 'textfield',
				'heading' => __( 'Form ID', 'ttv' ),
				'param_name' => 'ttv_form_id',
				'description' => __('Enter post ID (without #)'),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Button text', 'ttv' ),
				'param_name' => 'ttv_button_text',
				'description' => __('Enter button text'),
			),
		),
	) );
}
?>