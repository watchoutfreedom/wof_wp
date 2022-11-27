<?php
/**
* Template Name: Create Post
*
*/


//add redirect if user can't edit thist post
$post = get_post($_GET['id']);

if(!(wp_get_current_user()->ID == $post->post_author) 
    && !current_user_can( 'edit_others_posts') 
    && $_GET['action'] == 'edit')
    wp_redirect(home_url());

acf_form_head();

get_header(); ?>

<div class="page main-container">
    <?php

    if( isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edit' ){

        acf_form(array(
            'post_id'       => $_GET['id'],
            'post_title'    => true,
            'post_content'  => false,
            'return' => '%post_url%',
            'submit_value' => __("Publicar", 'acf')
        ));  
    }
    else{

        if($_GET['action'] == "create" && isset($_GET['id']))
            echo "<h4>Respuesta a <a href='".get_permalink($_GET['id'])."'>".get_the_title($_GET['id'])."</a></4>";

        acf_form(array(
            'post_id'       => 'new_post',
            'post_title'    => true,
            'post_content'  => false,
            'return' => '%post_url%',
            'submit_value' => __("Publicar", 'acf'),
            'new_post'      => array(
                'post_type'     => 'post',
                'post_status'   => 'publish'
            )
        ));
    }
    
    ?>
</div>
<?php wp_footer() ?>
