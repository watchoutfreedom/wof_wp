<?php
/**
* Template Name: Create Post
*
*/


$post = get_post($_GET['id']);

//add redirect if user can't edit thist post
if(!is_user_logged_in()){
    set_transient( 'originalRegisterRefererURL', $_SERVER['HTTP_REFERER'], 60 * 60 * 24 );
    wp_redirect( wp_login_url() );
}

if(!(wp_get_current_user()->ID == $post->post_author) 
    && !current_user_can( 'edit_others_posts') 
    && $_GET['action'] == 'edit')
    wp_redirect(home_url());

if(wp_get_current_user()->ID == $post->post_author && $_GET['action'] == 'create')
    wp_redirect(get_permalink($_GET['id']));


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
            echo "<div class='excerp'>Responder a <a class='answer__to' href='".get_permalink($_GET['id'])."'>".get_the_title($_GET['id'])."</a></div>";

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
