<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Custom Post Types */
require_once( 'library/custom-post-types.php' );

/** Format comments */
require_once( 'library/class-foundationpress-comments.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/class-foundationpress-top-bar-walker.php' );
require_once( 'library/class-foundationpress-mobile-walker.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

/** Gutenberg editor support */
require_once( 'library/gutenberg.php' );

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );


// disable gutenberg editor
add_filter('use_block_editor_for_post', '__return_false', 10);

// remove admin menu items we don't use / need

function remove_menu_items() {
  global $menu;
  $restricted = array(('Comments'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
      unset($menu[key($menu)]);}
    }
  }
add_action('admin_menu', 'remove_menu_items');

function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
    return array(
     'index.php', // this represents the dashboard link
     'edit.php?post_type=activity', 
     'edit.php?post_type=brainstorm', 
     'edit.php?post_type=service', 
     'edit.php?post_type=product',
     'edit.php?post_type=page', // this is the default page menu
	 'upload.php' // this is the default upload menu

 );
}
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');


//  remove admin item we don't use / need
function remove_submenus() {
  global $submenu;
  unset($submenu['index.php'][10]); // Removes 'Updates'.
  unset($submenu['themes.php'][5]); // Removes 'Themes'.
  unset($submenu['options-general.php'][10]); // Removes 'Writing'.
}

//add_action('admin_menu', 'remove_submenus');

// allow svg upload

function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}

// add_filter('upload_mimes', 'add_file_types_to_uploads');

// disable parent menu link
function disable_parent_menu_link()
{
    wp_print_scripts('jquery');
?>
    <script type="text/javascript">
        if (jQuery("ul li.menu-item:has(ul.sub-menu)").length > 0) {
            jQuery("ul li.menu-item:has(ul.sub-menu)").hover(function() {
                jQuery(this).children("a").removeAttr('href');
                jQuery(this).children("a").css('cursor', 'default');
                jQuery(this).children("a").click(function() {
                    return false;
                });
            });
        }
    </script>
<?php
}

add_filter('wp_nav_menu_items', 'crunchify_add_login_logout_menu', 10, 2);
function crunchify_add_login_logout_menu($items, $args) {
        ob_start();
        wp_loginout('index.php');
        $loginoutlink = ob_get_contents();
        $loginoutlink = str_replace('Log in', 'Entrar', $loginoutlink);
        ob_end_clean();
        $items .= '<li class="menu-item nav-item login">'. $loginoutlink .'</li>';
    return $items;
}

add_filter( 'login_url', function( $login_url){
  // Change here your login page url
  $login_url = home_url('/login');
  return $login_url;
}, 10, 3);

add_action('wp_login_failed', '_login_failed_redirect');

function _login_failed_redirect( $username ){

  $user = get_user_by('login', $username );

  if(!$user){
    //Username incorrect
    wp_redirect(home_url('/login') .'?login_error=1');

  }else{
   //Username Password combination incorrect
    wp_redirect(home_url('/login') .'?login_error=2');
  }

}

function populate_answer_to($field) {
  // only on front end
  if (is_admin()) {
    return $field;
  }
  if (isset($_GET['id']) && $_GET['action'] == 'create') {
    $field['value'] = $_GET['id'];
  }
  return $field;
}

add_filter('acf/prepare_field/key=field_6375339e513ad', 'populate_answer_to');

function register_user($post_id,$form){

  // Check that we are targeting the right form. I do this by checking the acf_form ID.
	if ( ! isset( $form['id'] ) || 'register_new_user' != $form['id'] ) {
		return $post_id;
	}

  // Create an empty array to add user field data into
	$user_fields = array();

  	// Check for the fields we need in our postdata, and add them to the $user_fields array if they exist
	if ( isset( $_POST['acf']['field_6382c10939765'] ) ) {
		$user_fields['first_name'] = sanitize_text_field( $_POST['acf']['field_6382c10939765']);
	}

	if ( isset( $_POST['acf']['field_599c480e8c0aa'] ) ) {
		$user_fields['last_name'] = sanitize_text_field( $_POST['acf']['field_599c480e8c0aa'] );
	}

	if ( isset( $_POST['acf']['field_6382c14839766'] ) ) {
		$user_fields['user_login'] = sanitize_user( $_POST['acf']['field_6382c14839766'] );
	}

	if ( isset( $_POST['acf']['field_6382c14839766'] ) ) {
		$user_fields['user_email'] = sanitize_email( $_POST['acf']['field_6382c14839766']);
	}

	if ( isset( $_POST['acf']['field_6382c1b639768'] ) ) {
		$user_fields['user_pass'] = $_POST['acf']['field_6382c1b639768'];
	}

	if ( isset( $_POST['acf']['field_6382c10939765'], $_POST['acf']['field_599c480e8c0aa'] ) ) {
		$user_fields['display_name'] = sanitize_text_field( $_POST['acf']['field_6382c10939765'] . ' ' . $_POST['acf']['field_599c480e8c0aa'] );
	}

  $user_id = wp_insert_user( $user_fields );


  if ( is_wp_error( $user_id ) ) {
		wp_die( $user_id->get_error_message() );
	} else {

    // update phone and skills
    update_field('field_6382d30135418',$_POST['acf']['field_6382c15c39767'],'user_'.$user_id);
    update_field('field_6382d31035419',$_POST['acf']['field_6382c25fbc87b'],'user_'.$user_id);

    wp_new_user_notification($user_id);


    //auto login user
    wp_set_current_user( $user_id, $user_fields['user_email'] );
    wp_set_auth_cookie( $user_id );
    do_action( 'wp_login', $user_fields['user_email'], get_user_by('id',$user_id) );


		// Set the 'post_id' to the newly created user_id, including the 'user_' ACF uses to target a user
		return 'user_' . $user_id;
	  }
  }
add_filter('acf/pre_save_post','register_user', 10, 2);


function my_acf_validate_email( $valid, $value, $field, $input_name ) {

    // Bail early if value is already invalid.
    if( $valid !== true )
        return $valid;

    if ( email_exists( $value ) ) { return 'Email already exists.'; }
    
    return $valid;
}
add_filter('acf/validate_value/key=field_6382c14839766', 'my_acf_validate_email', 10, 4);

function my_acf_validate_password( $valid, $value, $field, $input_name ) {

  // Bail early if value is already invalid.
  if( $valid !== true )
      return $valid;
  if ( $value != $_POST['acf']['field_6382c1d439769']) { return 'Passwords don\'t match.'; }
  
  return $valid;
}
add_filter('acf/validate_value/key=field_6382c1b639768', 'my_acf_validate_password', 10, 4);



// add_action('wp_footer', 'disable_parent_menu_link');


function add_query_vars_filter( $vars ){
  $vars[] = "type";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

function filter_archive_posts( $query ) {

		if (  $query->is_post_type_archive() ) {

      //$query->set( 'meta_key', 'type' );
      $query->set( 'meta_value', get_query_var('type') );
		}
  }
add_action( 'pre_get_posts', 'filter_archive_posts' );


function change_role_name() {
  global $wp_roles;

  if ( ! isset( $wp_roles ) )
      $wp_roles = new WP_Roles();

  $wp_roles->roles['contributor']['name'] = 'Conversador';
  $wp_roles->role_names['contributor'] = 'Conversador';           
}
add_action('init', 'change
_role_name');

// fix for navbar not showing up when logged in
add_action('wp_head', 'mbe_wp_head');
function mbe_wp_head(){
    echo '<style>'
    .PHP_EOL
    .'body{ padding-top: 70px ; }'
    .PHP_EOL
    .'body.body-logged-in .navbar-fixed-top{ top: 46px !important; }'
    .PHP_EOL
    .'body.logged-in .navbar-fixed-top{ top: 46px !important; }'
    .PHP_EOL
    .'@media only screen and (min-width: 783px) {'
    .PHP_EOL
    .'body{ padding-top: 70px ; }'
    .PHP_EOL
    .'body.body-logged-in header{ top: 28px !important; }'
    .PHP_EOL
    .'body.logged-in header{ top: 28px !important; }'
    .PHP_EOL
    .'}</style>'
    .PHP_EOL;
}



add_filter( 'admin_email_check_interval', '__return_false' );


/********************************
ADD ADDITIONAL TOOLBAR SET TO ACF WYSIWYG
********************************/
if ( function_exists( 'get_field' ) ) {
  add_filter( 'acf/fields/wysiwyg/toolbars' , 'qd_toolbars'  );
  function qd_toolbars( $toolbars )
  {
    //INJECT/ADD AN OPTION INTO THE BASIC TOOLBAR
    $toolbars['Basic' ][1] = array_merge( array_slice( $toolbars['Basic' ][1], 0, 3, true ), array( 'subscript','superscript' ), array_slice( $toolbars['Basic' ][1], 3, null, true ) );

    //FIND MORE INFO ABOUT THIS OPERATION AT http://www.advancedcustomfields.com/resources/customize-the-wysiwyg-toolbars/
    // Add a new toolbar called "Very Simple"
    // - this toolbar has only 1 row of buttons
    $toolbars['Very Simple' ] = array();
    $toolbars['Very Simple' ][1] = array('bold' , 'italic' , 'underline', 'link', 'unlink' );

    // return $toolbars - IMPORTANT!
    return $toolbars;
  }
}
add_filter( 'wp_is_application_passwords_available', '__return_false' );
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
add_action( 'admin_head', function(){
    ob_start(); ?>
    <style>
        #your-profile > h2,
        .user-rich-editing-wrap,
        .user-syntax-highlighting-wrap,
        .user-admin-color-wrap,
        .user-description-wrap,
        .user-comment-shortcuts-wrap,
        .user-sessions-wrap,
        .user-admin-bar-front-wrap {
            display: none;
        }
    </style>
    <?php ob_end_flush();
});?>