<?php
/*
Template Name: Signup
*/

if ( is_user_logged_in() )
    wp_redirect(home_url());


acf_form_head();

get_header();?>

<div class="page main-container">

    <?php acf_form([
            'field_groups' => [ 283 ],
            'post_id'      => 'new_user',
            'updated_message' => __("Solicitud registrada. Confirma la suscripción en tu email", 'acf'),
            'submit_value' => __("UNIRME", 'acf')]);
    ?>
</div>

<?php wp_footer(); ?>