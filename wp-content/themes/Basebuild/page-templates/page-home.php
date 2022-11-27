<?php
/**
* Template Name: Homepage
*
*/

get_header(); ?>

<?php   

$post_types = ['activity','post','product','service'];



if($feautured = get_field('feautured_post') ){
    $feautured_type = $feautured->post_type;
    $post_types = array_diff( $post_types, [$feautured_type] );
    array_unshift($post_types,$feautured_type);
}

?>
<div class="page main-container">
    <h1>Qué está pasando en Wof!</h1>
    <?php foreach($post_types as $post_type){
    $post = wp_get_recent_posts(array('numberposts' => 1,'post_type' => $post_type))[0];
    ?>
    <section>
        <div class="<?php if($featured) echo 'featured'?>">
            <a href="<?php echo get_permalink($post['ID']) ?>"><?php echo get_the_post_thumbnail($post['ID']); ?></a>
            <div class="post_type"><label for=""><?php echo $post_type ?></label></div>
            <a href="<?php echo get_permalink($post['ID']) ?>"><h1><?php echo $post['post_title']; ?></h1></a>
            <p><?php echo get_field('excerpt',$post['ID']) ?></p>
            <div class="author"><span><?php the_author_meta( 'user_nicename' , $post['post_author'] ); ?></span></div>
            <hr>
        </div>
    </section>
    <?php } ?>
    <section>
        <a href="">SUSCRIBIRME</a>
    </section>

</div>

<?php wp_footer(); ?>