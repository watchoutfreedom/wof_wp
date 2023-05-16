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


<div class="page main-container">
	<div class="excerp">Un blog abierto a tus ideas. Participa respondiendo con tu propio artículo a aquellos posts que te interesen.</div>
	<?php if ( have_posts() ) : ?>

		<div id="posts-grid">

			<?php while ( have_posts() ) : the_post(); ?>
				<section class="post-item">
					<div class="">
						<div class="img__wrap"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a></div>
						<a href="<?php the_permalink() ?>"><h2><?php the_title(); ?></h2></a>
						<p><?php echo get_field('excerpt',get_the_ID()) ?></p>
						<div class="author"><span><?php the_author_meta( 'user_nicename' , the_author() ); ?></span></div>
						<hr>
					</div>
				</section>

			<?php endwhile; ?>
		
		</div>

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
