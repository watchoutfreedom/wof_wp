<?php

/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<!-- check to see whether to add js for carousel  -->

<?php

if (have_rows('custom_page_creator')) :
    while (have_rows('custom_page_creator')) : the_row();
        if (get_row_layout() == 'gallery_section') :
            $class = "has-article-carousel has-modal";
        else :
            $class = "";
        endif;
    endwhile;
endif;
?>
<div class="page <?php echo $class ?> ">
    <?php

    include_once(get_template_directory() . '/template-sections/hero-nav.php');
    include_once(get_template_directory() . '/template-sections/article/article-hero.php');
    include_once(get_template_directory() . '/template-sections/article/article-detail.php');

    // check if the flexible content field has rows of data
    if (have_rows('custom_page_creator')) :

        // Check for template type and add aprropriate blocks
        while (have_rows('custom_page_creator')) : the_row();

            if (get_row_layout() == 'full_image_section') :

                include(get_template_directory() . '/template-sections/article/article-full-image.php');

            elseif (get_row_layout() == 'full_video_section') :

                include(get_template_directory() . '/template-sections/article/article-full-video.php');

            elseif (get_row_layout() == 'image_overlay_plus_text_section') :

                include(get_template_directory() . '/template-sections/article/article-image-plus-text.php');

            elseif (get_row_layout() == 'plain_text_section') :

                include(get_template_directory() . '/template-sections/article/article-plain-text.php');

            elseif (get_row_layout() == 'coloured_statement') :

                include(get_template_directory() . '/template-sections/article/article-coloured-statement.php');

            elseif (get_row_layout() == 'gallery_section') :

                include(get_template_directory() . '/template-sections/article/article-gallery.php');

            endif;

        endwhile;

    else:

    // no layouts found

    endif;

    // include related articles
    include_once(get_template_directory() . '/template-sections/article/article-related-content.php');
    ?>
</div>
<?php get_footer();
