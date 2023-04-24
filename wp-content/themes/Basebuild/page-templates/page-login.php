<?php
/**
* Template Name: Custom Login Page
*/
?>


<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel='dns-prefetch' href='//polyfill.io' />
    <link rel='dns-prefetch' href='//fonts.googleapis.com' />
	<?php wp_head(); ?>
</head>

<?php 

if ( ! is_user_logged_in() ) {

    if( isset($_GET['action']) && $_GET['action'] == 'lostpassword'){?>
    

        <div id="password-lost-form">
            <h3><?php _e( 'Forgot Your Password?', 'personalize-login' ); ?></h3>
        <p>
            <?phpe("Enter your email address and we'll send you a link you can use to pick a new password.",'personalize_login');?>
        </p>

        <form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
                <input type="text" name="user_login" id="user_login" placeholder="Email">
                <br>
                <input type="submit" name="submit" class="button" value="<?php _e( 'Reset Password', 'personalize-login' ); ?>"/>
        </form>
        
        <?php if($error) echo display_error_message($error);?>

        </div>

    <?php }

    else{

        if (get_transient('originalRegisterRefererURL') ){
        $redirect = home_url()."/create-post/?action=create&id=".url_to_postid(get_transient('originalRegisterRefererURL'));
        }
        else
        $redirect = home_url();


        $args = array(
            'redirect' => $redirect, // redirect to admin dashboard.
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
        echo '
        <div class="login__container">
        ';
        echo $form;
        echo "<div class='login__links'> <a class='button__links' href='/login?action=lostpassword'>Recuperar contraseña</a><br>";
        echo "<a class='button__links' href='/signup'>No tienes cuenta? Únete!</a><br></div>";

    }

    if( isset($_GET['login_error']) ){
        echo display_error_message($_GET['login_error']);
    }

    echo '
    </div>
    ';
    
}
else
    wp_redirect(home_url());



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
