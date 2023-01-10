<?php
/**
 * The template for displaying the blog
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<h4>Un blog abierto a las ideas de nuetros colaboradores.</h4>

<div class="page main-container">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<section>
				<div class="">
					<a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
                    <div class="author"><span><?php the_author_meta( 'user_nicename' , the_author() ); ?></span></div>
					<a href="<?php the_permalink() ?>"><h1><?php the_title(); ?></h1></a>
					<p><?php echo get_field('excerpt',get_the_ID()) ?></p>
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
