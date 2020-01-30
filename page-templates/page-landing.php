<?php
/*
Template Name: Landing
*/
get_header(); ?>
<div class="ttv-breadcrumbs-container">
	<div class="ttv-breadcrumbs">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumbs-link"><?php _e( 'Home', 'ttv' )?></a>
		<span class="breadcrumbs-separator">/</span>
		<span class="breadcrumbs-current-page"><?php the_title() ?></span>
	</div>
</div>
<div class="landing-top-section">
<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
<?php 
	$subheading = get_field('landing_subheading');
	if ($subheading){ 
		echo '<h4 class="subheading">';
		echo $subheading;
		echo '</h4>';
	}
?>
<?php 
	$top_excerpt = get_field('top_excerpt');
	if ($top_excerpt){ 
		echo '<p class="top-excerpt">';
		echo $top_excerpt;
		echo '</p>';
	}
?>
<div class="landing-top-bg" style="background: url(<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-landing-bg.png' ?>)" ></div>
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
<?php get_footer();
