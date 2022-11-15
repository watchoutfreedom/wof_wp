<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package Ollie Smith Basebuild
 * @since wpbb 1.0.0
 */

get_header(); ?>

<div class="page">
<?php   get_template_part( 'template-parts/content', get_post_type() ); ?>
    <section class="section">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php  get_template_part( 'template-parts/content', get_post_type() ); ?>
</div>
<?php get_footer();
