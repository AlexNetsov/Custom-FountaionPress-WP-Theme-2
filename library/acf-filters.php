<?php 
// Featured offer select
function acf_load_ttv_advice_featured_offer_field_choices( $field ) {    
    // reset choices
    $field['choices'] = array();
    $args = array(
	    'post_type' => 'offer',
	    'posts_per_page' => -1,
    );
    // get the textarea value from options page without any formatting
    $choices = get_posts( $args );
    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        foreach( $choices as $choice ) {
            
            $field['choices'][ $choice->ID ] = $choice->post_title;   
        }     
    } 
    // return the field
    return $field; 
}
add_filter('acf/load_field/name=ttv_advice_featured_offer', 'acf_load_ttv_advice_featured_offer_field_choices');
add_filter('acf/load_field/name=single_slider_featured_offer', 'acf_load_ttv_advice_featured_offer_field_choices');
// Advice from us/Your home sidebar offer select
function acf_load_ttv_advice_sidebar_offer_field_choices( $field ) {    
    // reset choices
    $field['choices'] = array();
    $args = array(
	    'post_type' => 'offer',
	    'posts_per_page' => -1,
    );
    // get the textarea value from options page without any formatting
    $choices = get_posts( $args );
    $field['choices'][0] = 'No offer';
    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        foreach( $choices as $choice ) {
            
            $field['choices'][ $choice->ID ] = $choice->post_title;   
        }     
    } 
    // return the field
    return $field; 
}
add_filter('acf/load_field/name=advice_from_us_sidebar_offer', 'acf_load_ttv_advice_sidebar_offer_field_choices');

// Menu label select
function acf_load_menu_label_index_field_choices( $field ) {    
    // reset choices
    $field['choices'] = array();
    $theme_locations = get_nav_menu_locations();
    $choices = wp_get_nav_menu_items($theme_locations['top-bar-r']);
    // loop through array and add to field 'choices'
    if( is_array($choices) ) { 
        foreach( $choices as $choice ) {  
            $field['choices'][ $choice->ID ] = $choice->title;
        }  
    } 
    // return the field
    return $field; 
}
add_filter('acf/load_field/name=menu_label_index', 'acf_load_menu_label_index_field_choices');

// Taxonomy to showcase in submenu
function acf_load_taxonomy_to_showcase_field_choices( $field ) {    
    // reset choices
    $field['choices'] = array();
    $choices = get_taxonomies();
    // loop through array and add to field 'choices'
    foreach( $choices as $choice ) {  
        $field['choices'][ $choice ] = $choice;
    }  
    // return the field
    return $field; 
}
add_filter('acf/load_field/name=taxonomy_to_showcase', 'acf_load_taxonomy_to_showcase_field_choices');

// eGuide to show in header menu submenu
function acf_load_eguide_to_show_field_choices( $field ) {    
    // reset choices
    $field['choices'] = array();
    $args = array(
	    'post_type' => 'eguide',
    );
    // get the textarea value from options page without any formatting
    $choices = get_posts( $args );
    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        foreach( $choices as $choice ) {
            
            $field['choices'][ $choice->ID ] = $choice->post_title;   
        }     
    } 
    // return the field
    return $field; 
}
add_filter('acf/load_field/name=eguide_to_show', 'acf_load_eguide_to_show_field_choices');
?>