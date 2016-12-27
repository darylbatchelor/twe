<?php

/**
 * Template Name: Single Anniversary Posts
 *
 * 
 *
 */



get_header(); ?>

<div <?php post_class( 'content-main clearfix' ); ?>>
	<?php do_action('layers_before_post_loop'); ?>
	<div class="grid">
		<?php get_sidebar( 'left' ); ?>

		<?php if( have_posts() ) : ?>

			<?php while( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php layers_center_column_class(); ?>>
				!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
					<?php the_content() ?>
					<h2><?php   echo get_post_meta($post->ID, 'year', true); ?> Year Anniversary</h2>
				</article>
			<?php endwhile; // while has_post(); ?>

		<?php endif; // if has_post() ?>

		<?php get_sidebar( 'right' ); ?>
	</div>
	<?php do_action('layers_after_post_loop'); ?>
</div>

<?php get_footer();