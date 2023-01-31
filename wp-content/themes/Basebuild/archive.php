<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<h1><?php echo get_query_var('type'); ?></h1>

<h4><?php echo get_the_post_type_description(); ?></h4>

<div class="page main-container">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<section>
				<div class="">
					<a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
					<div class="subtitle">
						<label for="">
							<?php 
							if($post_type == 'activity'){
								if(get_field('location',get_the_ID())) echo get_field('location',get_the_ID()); 
								if(get_field('initial_date',get_the_ID())) echo " | ".get_field('initial_date',get_the_ID());
								if(get_field('end_date',get_the_ID())) echo " - ".get_field('end_date',get_the_ID());

							}
							if($post_type == 'service' || $post_type = 'product')
								if(get_field('type',get_the_ID())) echo get_field('type',get_the_ID()); 		
							?>
						</label>
					</div>
					<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					<p><?php echo get_field('excerpt',get_the_ID()) ?></p>
					<div class="author"><span><?php the_author_meta( 'user_nicename' , the_author() ); ?></span></div>
					<hr>
				</div>
    		</section>

		<?php endwhile; ?>

	<?php else : ?>
		<?php get_template_part( 'template-parts/none' ); ?>

	<?php endif; // End have_posts() check. ?>
	<?php
	/* Display navigation to next/previous pages when applicable */
	if ( function_exists( 'foundationpress_pagination' ) ) :
		foundationpress_pagination();
	elseif ( is_paged() ) :
	?>
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
		</nav>
	<?php endif; ?>
</div>

<?php get_footer();
