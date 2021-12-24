<?php
/**
 * Plugin Name:     Block Patterns
 * Plugin URI:      
 * Description:     A collection of block patterns
 * Version:         1.0.0
 * Author:          Levani Papashvili
 * Author URI:     	https://levanipapashvili.com/
 * License:         GPL-3.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 */
 
 // If this file is called directly, abort.
  if ( ! defined( 'WPINC' ) ) {
	  die;
  }
  
  /**
   * Currently plugin version.
   */
  define( 'LP_BP_VERSION', '1.0.0' );
  
  /**
   * Plugin URL
   */
  define( 'LP_BP_URL', plugin_dir_url( __FILE__ ) ); //This include the trailing slash! 

/**
 * Load styles. 
 */
function lp_bp_enqueue_styles() {
    wp_enqueue_style( 'lp-bp-styles', LP_BP_URL . 'inc/pl-bp-styles.css');
    // load css form the plugin folder.
    wp_enqueue_style( 'lp-blocks.css', LP_BP_URL . 'inc/css/lp-blocks.css');
}
add_action( 'wp_enqueue_scripts', 'lp_bp_enqueue_styles' );

require_once ('inc/categories.php');
require_once ('inc/patterns.php');