<?php 
/**
 * Plugin Name: Kamo Contact Form
 * Plugin URI: 
 * Description: A Kamo Simple Contact Form Plugin.
 * Version: 1.0
 * Author: Levani Papashvili
 * Author URI: http://www.levanipapashvili.com/
 * License: GPL2
 * Text Domain: kamo-contact-form
 */

    if(!defined('ABSPATH')){
        echo 'What are you trying to do ?';
    	exit;
    }
    
    class KamoContactForm {
      
        public function __construct(){
            // Create custom post type
            add_action('init', array($this, 'create_custom_post_type'));
            // add assets (css, js)
            
        }
    
        public function create_custom_post_type(){
            $args = array(
                'public' => true,
                'has_archive' => true,
                'supports' => array('title'),
                'exclude_from_search' => true,
                'publicly_queryable' => false,
                'capability' => 'manage_options',
                'labels' => array(
                    'name' => 'Contact Form',
                    'singular_name' => 'Contact Form Etry',
                ),
                'menu_icon' => 'dashicons-format-aside',
            );
        register_post_type('kamo_contact_form', $args);
    }
}
    
new KamoContactForm;