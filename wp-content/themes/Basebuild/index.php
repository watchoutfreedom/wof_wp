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
			<?php if(!get_field('answer_to',get_the_ID()) || (get_field('answer_to',get_the_ID()) && get_field('display_answer',get_the_ID()))): ?>
				<section class="post-item">
					<div class="">
						<div class="img__wrap"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a></div>
						<a href="<?php the_permalink() ?>"><h2><?php the_title(); ?></h2></a>
						<p><?php echo get_field('excerpt',get_the_ID()) ?></p>
						<div class="author"><span><?php the_author_meta( 'user_nicename' , the_author() ); ?></span></div>
						<?php
						$my_posts = get_posts(array(
							'numberposts'   => -1,
							'post_type'     => 'post',
							'meta_key'      => 'answer_to',
							'meta_value'    => get_the_ID()
							));


							if(!empty($my_posts)):?>

							<div class="answers">
								<h2>Respuestas</h2>

								<ul>
								<?php
									foreach($my_posts as $my_post){
										echo "<li><span><a href='".get_permalink($my_post->ID)."'>".$my_post->post_title."</a> por ".get_the_author_meta('display_name', $my_post->post_author )."</span></li>";
										
									}?>
								</ul>
							</div>
							<?php endif ?>

						<hr>
					</div>
				</section>
				<?php endif; ?>

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
