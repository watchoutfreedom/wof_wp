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
     'edit.php?post_type=activities', 
     'edit.php?post_type=brainstorms', 
     'edit.php?post_type=services', 
     'edit.php?post_type=products',
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

// add_action('wp_footer', 'disable_parent_menu_link');
?>