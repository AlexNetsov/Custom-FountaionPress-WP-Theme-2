<?php
/**
 * The template for displaying single eGuides
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header('eguide'); ?>


<div class="main-wrap full-width">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="eguide-top-logo">
		<img src="<?php echo get_stylesheet_directory_uri() .'/src/assets/images/ttv-logo-dark.png' ?>" height="53px" width="290px" />
	</a>
	<main class="main-content">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<span class="eguide-free-heading" style="color:<?php echo $eg_dark;?>"><?php _e( 'Free ', 'ttv' )?></span>
					<span class="eguide-download-heading" style="color:<?php echo $eg_dark;?>"><?php _e( 'download:', 'ttv' )?></span>
					<?php the_title('<h1>', '</h1>'); ?>
					<div class="eguide-subheading"><?php the_field('eguide_subheading') ?></div>
				</header>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<footer>

				</footer>
			</article>
		<?php endwhile;?>
	</main>
</div>
<?php get_footer('eguide');
