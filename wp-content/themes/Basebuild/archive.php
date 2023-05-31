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



<div class="page main-container">

    <h4><?php echo get_the_post_type_description(); ?></h4>

	<?php 
    //lazy load
    echo do_shortcode('[ajax_load_more id="6962705037" tag="'.get_query_var('tag').'" custom_args="type:'.get_query_var('type').'" loading_style="infinite" post_type="'.$post_type.'" posts_per_page="5" post_format="standard"]') 
    ?>
</div>

<br><br><br>

<?php get_footer();
