<?php
/*
Template Name: Signup
*/

if ( is_user_logged_in() )
    wp_redirect(home_url());


acf_form_head();

get_header();?>

<div class="page main-container">

    <?php 
    
    if (get_transient('originalRegisterRefererURL') ){
        $redirect = get_transient('originalRegisterRefererURL');
        delete_transient('originalRegisterRefererURL');
    }
    else
        $redirect = home_url();
    
    
    acf_form([
            'field_groups' => [ 283 ],
            'post_id'      => 'new_user',
            'return' => $redirect,
            'updated_message' => __("Solicitud registrada. Confirma la suscripción en tu email", 'acf'),
            'submit_value' => __("UNIRME", 'acf')]);
    ?>
</div>

<?php wp_footer(); ?>