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

/**
 * WordPress admin customisation
 */
function my_login_logo() { ?>
	<style type="text/css">

		html {
			background: #f6f6f6;
		}

		body.login div#login h1 a {
			/* background: url(<?php echo get_bloginfo( 'template_directory' ) ?>/assets/images/theme/medelalogo.svg) no-repeat !important;*/
			padding-bottom: 0;
			background-size: 300px 57px;
			height: 57px;
			margin: 0 auto 25px;
			width: 300px;
		}

		body.login {
			/* background: #000 url(<?php echo get_bloginfo( 'template_directory' ) ?>/assets/images/theme/splash-screen.jpg) no-repeat !important;*/
			background-size: cover !important;
			background-position: 50% !important;
			font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
			font-weight: 300;
			color: #757474;
		}

		body #login {
			position: relative;;
			overflow: hidden;
		}

	</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


// remove admin menu items we don't use / need

function remove_menu_items() {
  global $menu;
  $restricted = array(__('Links'), __('Comments'), __('Posts'),__('Tools'),__('Users'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
      unset($menu[key($menu)]);}
    }
  }

//add_action('admin_menu', 'remove_menu_items');


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

// add_action('wp_footer', 'disable_parent_menu_link');
?>