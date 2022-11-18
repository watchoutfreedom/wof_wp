<?php
/**
* Template Name: Homepage
*
*/

get_header(); ?>

<?php   

$post_types = ['activity','post','product','service'];


?>
<div class="page main-container">
    <?php foreach($post_types as $post_type){
    $post = wp_get_recent_posts(array('numberposts' => 1,'post_type' => $post_type))[0];
    ?>
    <section>
        <div class="featured">
            <?php echo get_the_post_thumbnail($post['ID']); ?>
            <div class="label"><label for=""><?php echo $post_type ?></label></div>
            <h1><?php echo $post['post_title']; ?></h1>
            <p><?php echo get_field('excerpt',$post['ID']) ?></p>
            <div class="author"><span><?php the_author_meta( 'user_nicename' , $post['post_author'] ); ?></span></div>
        </div>
    </section>
    <?php } ?>
</div>

