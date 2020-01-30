<?php 
add_action("wp_ajax_archieve_filters_callback", "archieve_filters_callback");
add_action("wp_ajax_nopriv_archieve_filters_callback", "archieve_filters_callback");

function archieve_filters_callback() {  
	
	// Get required vars
	$query_vars = json_decode($_REQUEST['query_vars']);
	$filter_action = $_REQUEST['filter_action'];
	$taxonomy = $_REQUEST['taxonomy'];
	$clicked_term = intval($_REQUEST['clicked_term']);
	$term_posts_to_display = $_REQUEST['term_posts_to_display'];
	//$post_type = json_decode($_REQUEST['post_type']);
	$post_type = json_decode( str_replace('\\', '', $_REQUEST['post_type']));
	error_log(print_r($post_type,true));
	// Fix the var type
	if(!empty($query_vars)){
		if (gettype($query_vars) == 'integer'){
			$query_vars_array = array($query_vars);
		}
		else {
			$query_vars_array = $query_vars;
		}
	}
	else {
		$query_vars_array = array();
	}
	
	// Filter removal
	if($filter_action == 'remove'){
		// Handle hidden array and filter navigation
		if (($key = array_search($clicked_term, $query_vars_array)) !== false) {
		    unset($query_vars_array[$key]);
		}
		$query_vars_array = array_values($query_vars_array);
		
		$terms = get_terms( array(
		    'taxonomy' => $taxonomy,
		    'hide_empty' => true,
		    'exclude' => $query_vars_array,
		    'orderby' => 'count',
		    'order' => 'DESC',
		) );
		$not_selected_terms_html = '';
		foreach($terms as $single_term){
			$not_selected_terms_html .= '<a class="not-selected-term" term-id='.$single_term->term_id.'>'.$single_term->name.' ('.$single_term->count.')</a>';
			
		
		}
	}
	// Add filter
	else if($filter_action == 'add'){
		// Handle hidden array and filter navigation
		array_push($query_vars_array, $clicked_term);
		
		$addes_term_object = get_term($clicked_term);
		
		$result['added_term_html'] = '<a class="selected-term" term-id="'.$clicked_term.'">'
										.$addes_term_object->name.' ('.$addes_term_object->count.')'.
										'<i class="fa fa-times" aria-hidden="true"></i>
									</a>';
	}
	else if($filter_action == 'load_more'){
		$term_posts_to_display = -1;
	}
	// Filter the remaining posts
	if(empty($query_vars_array)){
		$args_term_posts = array(
			'posts_per_page'   => $term_posts_to_display,
			'offset'           => 0,
			'post_type'        => $post_type,
			'post_status'      => 'publish',
			'orderby'          => 'date',
			'order'            => 'DESC',
		);
	}
	else {
		$args_term_posts = array(
			'posts_per_page'   => $term_posts_to_display,
			'offset'           => 0,
			'post_type'        => $post_type,
			'post_status'      => 'publish',
			'orderby'          => 'date',
			'order'            => 'DESC',
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $query_vars_array,
				),
			),
		);
	}
					
	$term_posts_query = new WP_Query( $args_term_posts );
	
	$result['term_posts'] = '';
	if ( $term_posts_query->have_posts() ) {
		while ( $term_posts_query->have_posts() ) {
			$term_posts_query->the_post();
			$term_post_id = get_the_ID();
			
			$result['term_posts'] .= '<a href="'.get_the_permalink().'" class="single-post-ingrid cell">
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
					
	$result['query_vars'] = json_encode($query_vars_array);
	$result['not_selected_terms_html'] = $not_selected_terms_html;
	$result['type'] = 'success';
	$result = json_encode($result);
	echo $result; 
    die();
}
?>