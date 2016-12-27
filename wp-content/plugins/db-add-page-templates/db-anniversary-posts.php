<?php

/**
 * Template Name: Anniversary Posts
 *
 * 
 *
 */




get_header(); ?>

<div <?php post_class( 'content-main clearfix' ); ?>>
	<?php do_action('layers_before_post_loop'); ?>
	<div class="grid">
		<?php get_sidebar( 'left' ); ?>


		<?php $loop = new WP_Query( array( 'post_type' => 'anniversary_years', 'posts_per_page' => -1, 'meta_key' => 'year', 'paged' => $paged, 'orderby' => 'meta_value_num', 'order' => 'ASC') ); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php layers_center_column_class(); ?>>
			<div style="background-color:#f4f4f4; width:70%; display:block; margin:auto; padding: 20px">
		 <h2 style="text-align:center; padding-bottom:20px"><?php   echo get_post_meta($post->ID, 'year', true); ?> Year Anniversary</h2>
		 <h3><strong>Traditional Gift US:</strong> <?php   echo get_post_meta($post->ID, 'traditional_gift_us', true); ?></h3>
		 <h3><strong>Traditional Gift UK:</strong> <?php   echo get_post_meta($post->ID, 'traditional_gift_uk', true); ?></h3>
		 <h3><strong>Modern Gift:</strong> <?php   echo get_post_meta($post->ID, 'modern_gift', true); ?></h3>
		 <h3><strong>Color:</strong> <?php   echo get_post_meta($post->ID, 'color', true); ?></h3>
		 <h3><strong>Gemstone:</strong> <?php   echo get_post_meta($post->ID, 'gemstone', true); ?></h3>
		 <h3><strong>Giftpack:</strong><br> <?php   echo get_post_meta($post->ID, 'ideas', true); ?></h3>
		 	</div>
		<br><br><br>
		</article>

		<?php endwhile;	wp_reset_query(); ?>


			

		<?php get_sidebar( 'right' ); ?>
	</div>
	<?php do_action('layers_after_post_loop'); ?>
</div>

<?php get_footer();

