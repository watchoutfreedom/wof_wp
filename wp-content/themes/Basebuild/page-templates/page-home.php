<?php
/**
* Template Name: Homepage
*
*/

$page = "home";
get_header(); ?>

<div class="page main-container">

    <?php if($featured = get_field('feautured_post') ){
    $args = array('p' => $featured->ID,'post_type' => 'any');
      $wp_query = new WP_Query($args);
      while ( have_posts() ) : the_post(); ?>
    <section>
        <div class="featured">
            <a href="<?php echo get_permalink() ?>"><?php echo get_the_post_thumbnail(); ?></a>
            <div class="post_type"><label for=""><?php echo get_post_type() ?></label></div>
            <h2><a href="<?php echo get_permalink() ?>"><?php echo the_title() ?></a></h2>
            <p><?php echo get_field('excerpt') ?></p>
            <div class="author"><span><?php the_author(); ?></span></div>
            <hr>
        </div>
    </section>
    <?php endwhile; } ?>
    
    <?php 
    //lazy load
    echo do_shortcode('[ajax_load_more id="6962705037" loading_style="infinite classic" post_type="post, 
    activity, service, product" posts_per_page="5" post_format="standard"]') 
    ?>
    <section>
        <a class="button" href="signup">SUSCRIBIRME</a>
    </section>

</div>

<?php wp_footer(); ?>