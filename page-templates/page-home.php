<?php
/*
Template Name: Homepage
*/
get_header(); ?>
<header class="homepage-search" style="background: url(<?php echo the_post_thumbnail_url( 'full' )?>)">
	<div class="homepage-search-inner-container">
		<h2><?php _e( "The Tenants' Voice", 'ttv-theme' )?></h2>
		<h4><?php _e( "The UK's Largest Tenant Support Community", 'ttv-theme' )?></h4>
		
		<div class="homepage-search-form">
			<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div>
					<input type="text" value="" name="s" id="s" placeholder="I'm looking for..."/>
					<input type="submit" id="searchsubmit" value="" />
				</div>
			</form>
		</div>
		<?php 
			$tax_heading = get_field('top_section_taxonomy_title');
			$tax_to_display = get_field('top_section_taxonomy_showcase');
			$view_all_link = get_field('homepage_top_sections_view_all_link', 'option');
			if($tax_to_display){
				$terms = get_terms( array(
				    'taxonomy' => $tax_to_display,
				    'orderby'    => 'count',
				    'order' => 'DESC',
				    'number' => 6,
				    'hide_empty' => true,
				) );
								
				if ($terms) {
					if($tax_heading) {
						echo '<h3>'.$tax_heading.'</h3>';
					}
					echo '<div class="terms-cloud-container">';
					
					foreach ($terms as $single_term) {
						$term_url = get_term_link($single_term, $single_term->taxonomy);
						echo '<a class="single-term" href="'.$term_url.'">'.$single_term->name.' ('.$single_term->count.')</a>';
					}
					
					echo '</div>';
					echo '<a class="home-view-all-terms" href="'.$view_all_link.'">'.__( 'View all', 'ttv' ).' ('.wp_count_terms($tax_to_display).')</a>';
				} 		        
			}
			
		?>
	</div>
</header>
<div class="main-wrap full-width">
	<main class="main-content">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile;?>
	</main>
</div>
<?php get_footer();
