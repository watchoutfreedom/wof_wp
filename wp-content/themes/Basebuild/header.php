<?php

/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 */

// Get ACF vars from options

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

<body <?php body_class(); ?>>
  
  
  <header class="header header-fixed u-unselectable">
    <div class="header-top"> 
      <div class="header-brand">
      <div class="nav-item no-hover"><a href="<?php echo get_home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/dist/img/logo.svg" alt="logo"/></a></div>
        <div class="nav-item nav-btn" id="header-btn"><span></span><span></span><span></span></div>
      </div>
      <div class="header-nav" id="header-menu">
      <?php foundationpress_main_nav(); ?>
      <?php if(is_archive()): ?>
      <div class="header-right">
        <ul>
        <li><a href="">ALL</a></li>
        <?php 
        if(is_post_type_archive("service")) $field = 'field_6377dd09cb415';
        if(is_post_type_archive("product")) $field = 'field_6377e5090ad10';
        if(is_post_type_archive("activity")) $field = 'field_637541b007ca0';
          foreach(get_field_object($field)['choices'] as $choice):?>
            <li><a href="/<?php echo get_post_type().'/'.$choice ?>"><?php echo $choice ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>
      </div>
    </div>
  </header>