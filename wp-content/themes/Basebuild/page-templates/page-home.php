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
            <div class="img__wrap">
                <a href="<?php echo get_permalink() ?>"><?php echo get_the_post_thumbnail(); ?></a>
            </div>  
            <div class="post_type">
                <label class="post_type__label" for="">
                    <?php 
                    if ($postType = get_post_type_object(get_post_type())) {
                        if(get_post_type() == 'post'){
                            echo esc_html($postType->labels->singular_name);
                        }
                    }
                    ?>
                </label>
            </div>
            <div class="subtitle">
                <label for="">
                    <?php 
                    if(get_post_type()  == 'activity'){
                        $field_object = get_field_object('type',get_the_ID());
                        $value = $field_object['value'];
                        if($field_object) echo "<a href='/".get_post_type()."?type=".$value."'>".$field_object['choices'][$value]."</a> | "; 

                        if(get_field('location',get_the_ID())) echo get_field('location',get_the_ID()); 
                        if(get_field('initial_date',get_the_ID())) echo " | ".get_field('initial_date',get_the_ID());
                        if(get_field('end_date',get_the_ID())) echo " - ".get_field('end_date',get_the_ID());

                    }
                    if(get_post_type()  == 'service' || get_post_type()  == 'product'){
                        $field_object = get_field_object('type',get_the_ID());
                        $value = $field_object['value'];
                        if($field_object) echo "<a href='/".get_post_type()."?type=".$value."'>".$field_object['choices'][$value]."</a>"; 
                    }		
                    ?>
                </label>
            </div>
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

</div>

<?php wp_footer(); ?>


