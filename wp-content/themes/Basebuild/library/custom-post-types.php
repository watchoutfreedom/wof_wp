<?php 


/*
// add options page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Global Settings',
		'menu_title'	=> 'Global Settings',
	));	
} 

*/

// to add custom post types to the sites menu
add_action( 'init', 'create_post_type' );

function create_post_type() {

	$labels = array(
		'name'                  => _x( 'Activities', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Activity', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Activities', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'Activity', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Add New', 'textdomain' ),
		'add_new_item'          => __( 'Add New Activity', 'textdomain' ),
		'new_item'              => __( 'New Activity', 'textdomain' ),
		'edit_item'             => __( 'Edit Activity', 'textdomain' ),
		'view_item'             => __( 'View Activity', 'textdomain' ),
		'all_items'             => __( 'All Activities', 'textdomain' ),
		'search_items'          => __( 'Search Activities', 'textdomain' ),
		'parent_item_colon'     => __( 'Parent Activities:', 'textdomain' ),
		'not_found'             => __( 'No activities found.', 'textdomain' ),
		'not_found_in_trash'    => __( 'No activities found in Trash.', 'textdomain' )	
	);

	register_post_type( 'activity',
		array(
		'labels' => $labels,
		'public' => true,
		'show_ui'            => true,
		'show_in_nav_menus' => true,
		'rewrite'	=> array( 'slug' => 'activity' ),
		'has_archive' => true,
		'taxonomies' => array('category', 'post_tag'),
		'menu_icon'   => 'dashicons-products',
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
		)
	);

	$labels = array(
		'name'                  => _x( 'Brainstorms', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Brainstorm', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Brainstorms', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'Brainstorm', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Add New', 'textdomain' ),
		'add_new_item'          => __( 'Add New Brainstorm', 'textdomain' ),
		'new_item'              => __( 'New Brainstorm', 'textdomain' ),
		'edit_item'             => __( 'Edit Brainstorm', 'textdomain' ),
		'view_item'             => __( 'View Brainstorm', 'textdomain' ),
		'all_items'             => __( 'All Brainstorms', 'textdomain' ),
		'search_items'          => __( 'Search Brainstorms', 'textdomain' ),
		'parent_item_colon'     => __( 'Parent Brainstorms:', 'textdomain' ),
		'not_found'             => __( 'No brainstorms found.', 'textdomain' ),
		'not_found_in_trash'    => __( 'No brainstorms found in Trash.', 'textdomain' )	
	);

	register_post_type( 'brainstorm',
		array(
		'labels' => $labels,
		'public' => true,
		'show_ui'            => true,
		'show_in_nav_menus' => true,
		'rewrite'	=> array( 'slug' => 'brainstorm' ),
		'has_archive' => true,
		'taxonomies' => array('category', 'post_tag'),
		'menu_icon'   => 'dashicons-format-status',
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
		)
	);

	$labels = array(
		'name'                  => _x( 'Services', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Service', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Services', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'Service', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Add New', 'textdomain' ),
		'add_new_item'          => __( 'Add New Service', 'textdomain' ),
		'new_item'              => __( 'New Service', 'textdomain' ),
		'edit_item'             => __( 'Edit Service', 'textdomain' ),
		'view_item'             => __( 'View Service', 'textdomain' ),
		'all_items'             => __( 'All Services', 'textdomain' ),
		'search_items'          => __( 'Search Services', 'textdomain' ),
		'parent_item_colon'     => __( 'Parent Services:', 'textdomain' ),
		'not_found'             => __( 'No services found.', 'textdomain' ),
		'not_found_in_trash'    => __( 'No services found in Trash.', 'textdomain' )	
	);

	register_post_type( 'service',
		array(
		'labels' => $labels,
		'public' => true,
		'show_ui'            => true,
		'show_in_nav_menus' => true,
		'rewrite'	=> array( 'slug' => 'service' ),
		'has_archive' => true,
		'taxonomies' => array('category', 'post_tag'),
		'menu_icon'   => 'dashicons-hammer',
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
		)
	);

	$labels = array(
		'name'                  => _x( 'Products', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Product', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Products', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'Product', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Add New', 'textdomain' ),
		'add_new_item'          => __( 'Add New Product', 'textdomain' ),
		'new_item'              => __( 'New Product', 'textdomain' ),
		'edit_item'             => __( 'Edit Product', 'textdomain' ),
		'view_item'             => __( 'View Product', 'textdomain' ),
		'all_items'             => __( 'All Products', 'textdomain' ),
		'search_items'          => __( 'Search Products', 'textdomain' ),
		'parent_item_colon'     => __( 'Parent Products:', 'textdomain' ),
		'not_found'             => __( 'No product found.', 'textdomain' ),
		'not_found_in_trash'    => __( 'No product found in Trash.', 'textdomain' )	
	);

	register_post_type( 'product',
		array(
		'labels' => $labels,
		'public' => true,
		'show_ui'            => true,
		'show_in_nav_menus' => true,
		'rewrite'	=> array( 'slug' => 'product' ),
		'has_archive' => true,
		'taxonomies' => array('category', 'post_tag'),
		'menu_icon'   => 'dashicons-products',
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
		)
	);

}