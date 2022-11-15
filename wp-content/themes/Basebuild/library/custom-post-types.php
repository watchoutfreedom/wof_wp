<?php 

// add options page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Global Settings',
		'menu_title'	=> 'Global Settings',
	));	
} 

// to add custom post types to the sites menu
add_action( 'init', 'create_post_type' );

function create_post_type() {
	register_post_type( 'article',
		array(
			'labels' => array(
				'name' => __( 'Article' ),
				'singular_name' => __( 'Article' )
			),
		'public' => true,
		'show_in_nav_menus' => true,
		'has_archive' => true,
		'taxonomies' => array('category', 'post_tag'),
		'supports' => array('title', 'thumbnail', 'author')
		// 	'menu_icon' => get_template_directory_uri() . '/assets/images/theme/admin-icons/icon-howtouse.svg'
		)
	);
}