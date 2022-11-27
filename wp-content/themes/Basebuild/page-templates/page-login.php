<?php
/**
* Template Name: Custom Login Page
*/

if ( ! is_user_logged_in() ) {

    if( isset($_GET['action']) && $_GET['action'] == 'lostpassword'){
        
    }

    $args = array(
        'redirect' => home_url(), // redirect to admin dashboard.
        'form_id' => 'custom_loginform',
        'label_username' => false,
        'label_password' => false,
        'label_remember' => __( 'Remember Me' ),
        'label_log_in' => __( 'Log In' ),
         'remember' => false,
         'echo' => false
    );

    $form = wp_login_form( $args );

    //add the placeholders
    $form = str_replace('name="log"', 'name="log" placeholder="Username"', $form);
    $form = str_replace('name="pwd"', 'name="pwd" placeholder="Password"', $form);
    
    echo $form;
    echo "<a href='/login?action=lostpassword'>Recuperar contraseña</a>";
}
else
    wp_redirect(home_url());

if( isset($_GET['login_error']) ){
    echo display_error_message($_GET['login_error']);
}

function display_error_message( $err_code ){
    // Invalid username.
    if ( $err_code  == 1 ) {
        $error = '<strong>ERROR</strong>: Invalid username.';
    }
    // Incorrect password.
    if (  $err_code == 2 ) {
        $error = '<strong>ERROR</strong>: The password you entered is incorrect.';
    }
return $error;
}
