<?php

// Path: wp-content/themes/customtheme/functions.php
// load stylesheets
function load_css() {
    wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all' );
    wp_enqueue_style( 'bootstrap' );
  

    wp_register_style( 'main', get_template_directory_uri() . '/css/main.css', array(), false, 'all' );
    wp_enqueue_style( 'main' );
   
}
add_action( 'wp_enqueue_scripts', 'load_css' );

// Path: wp-content/themes/customtheme/functions.php
// load javascript
function load_js() {
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', false, true );
    wp_enqueue_script( 'bootstrap' );
}
add_action( 'wp_enqueue_scripts', 'load_js' );

// Theme options
add_theme_support( 'menus' );              // Add menu support
add_theme_support( 'post-thumbnails' );   // Add feature image support

// Custom Image Sizes
add_image_size( 'small-thumbnail', 180, 120, true );
add_image_size( 'banner-image', 1920, 210, true );
add_image_size( 'blog-image', 400, 400, true );
add_image_size( 'blog-image-small', 300, 200, true );
add_image_size( 'blog-image-large', 800, 400, true );

// Menus
register_nav_menus(
    array(
        'top-menu' => 'Top Menu Location',
        'mobile-menu' => 'Mobile Menu Location',
        'footer-menu' => 'Footer Menu Location',
    )
);
