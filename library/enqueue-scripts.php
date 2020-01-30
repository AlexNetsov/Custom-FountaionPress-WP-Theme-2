<?php
/**
 * Enqueue all styles and scripts
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */


// Check to see if rev-manifest exists for CSS and JS static asset revisioning
//https://github.com/sindresorhus/gulp-rev/blob/master/integration.md

if ( ! function_exists( 'foundationpress_asset_path' ) ) :
function foundationpress_asset_path( $filename ) {
	$filename_split = explode( '.', $filename );
	$dir = end( $filename_split );
	$manifest_path = dirname( dirname(__FILE__) ) . '/dist/assets/' . $dir . '/rev-manifest.json';
	
	if ( file_exists($manifest_path ) ) {
		$manifest = json_decode( file_get_contents( $manifest_path ), TRUE);
	} else {
		$manifest = [];
	}
	
	if ( array_key_exists( $filename, $manifest) ) {
		return $manifest[$filename];
	}
	return $filename;
}
endif;


if ( ! function_exists( 'foundationpress_scripts' ) ) :
	function foundationpress_scripts() {

		// Enqueue the main Stylesheet.
		wp_enqueue_style( 'main-stylesheet',  get_template_directory_uri() . '/dist/assets/css/' . foundationpress_asset_path('app.css'), array(), '2.10.4', 'all' );

		// Deregister the jquery version bundled with WordPress.
		wp_deregister_script( 'jquery' );

		// CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header.
		wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', array(), '1.12.4', false );
		
		wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/owl-carousel/owl.carousel.min.js', array() ,'2.21', true );

		// Enqueue Founation scripts
		wp_enqueue_script( 'foundation', get_template_directory_uri() . '/dist/assets/js/' . foundationpress_asset_path('app.js'), array( 'jquery' ), '2.10.4', true );

		// Enqueue FontAwesome from CDN. Uncomment the line below if you don't need FontAwesome.
		wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/5016a31c8c.js', array(), '4.7.0', true );

		wp_enqueue_style( 'fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css', array(), '3.2.5', 'all' );
		wp_enqueue_script( 'fancybox-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js', array(), '3.2.5', true );
		
		// Blog ajax
		wp_register_script( "archieve_filters", get_template_directory_uri() . '/src/assets/js/ajax/archieve_filters.js', array('jquery') );
		wp_localize_script( 'archieve_filters', 'archieveFilters', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        
		wp_enqueue_script( 'archieve_filters' );

		// Add the comment-reply library on pages where it is necessary
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	add_action( 'wp_enqueue_scripts', 'foundationpress_scripts' );
endif;
