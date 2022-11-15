<?php
/**
 * Register Menus
 *
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

register_nav_menus(
	array(
		'main-nav'  => esc_html__( 'Main', 'foundationpress' ),
		'footer-nav1' => esc_html__( 'Footer1', 'foundationpress' ),
		'footer-nav2' => esc_html__( 'Footer2', 'foundationpress' ),
	)
);

if ( ! function_exists( 'foundationpress_main_nav' ) ) {
	function foundationpress_main_nav() {
		wp_nav_menu(
			array(
				'container'      => false,
				'menu_class'     => 'nav-under',
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'theme_location' => 'main-nav',
				'add_li_class'  => 'nav-item',
				'depth'          => 2,
				'fallback_cb'    => false,
				'walker'         => new Foundationpress_Top_Bar_Walker(),
			)
		);
	}
}

if ( ! function_exists( 'foundationpress_footer_nav1' ) ) {
	function foundationpress_footer_nav1() {
		wp_nav_menu(
			array(
				'container'      => false,
				'menu_class'     => 'no-bullets',
				'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
				'theme_location' => 'footer-nav1',
				'depth'          => 3,
				'fallback_cb'    => false,
				'walker'         => new Foundationpress_Top_Bar_Walker(),
			)
		);
	}
}

if ( ! function_exists( 'foundationpress_footer_nav2' ) ) {
	function foundationpress_footer_nav2() {
		wp_nav_menu(
			array(
				'container'      => false,
				'menu_class'     => 'no-bullets',
				'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
				'theme_location' => 'footer-nav2',
				'depth'          => 3,
				'fallback_cb'    => false,
				'walker'         => new Foundationpress_Top_Bar_Walker(),
			)
		);
	}
}


/**
 * Add support for buttons in the top-bar menu:
 * 1) In WordPress admin, go to Apperance -> Menus.
 * 2) Click 'Screen Options' from the top panel and enable 'CSS CLasses' and 'Link Relationship (XFN)'
 * 3) On your menu item, type 'has-form' in the CSS-classes field. Type 'button' in the XFN field
 * 4) Save Menu. Your menu item will now appear as a button in your top-menu
*/
if ( ! function_exists( 'foundationpress_add_menuclass' ) ) {
	function foundationpress_add_menuclass( $ulclass ) {
		$find    = array( '/<a rel="button"/', '/<a title=".*?" rel="button"/' );
		$replace = array( '<a rel="button" class="button"', '<a rel="button" class="button"' );

		return preg_replace( $find, $replace, $ulclass, 1 );
	}
	add_filter( 'wp_nav_menu', 'foundationpress_add_menuclass' );
}


// add classes on li

function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);