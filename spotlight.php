<?php
/**
 * Spotlight 
 *
 * @package           Spotlight
 * @author            Certified Vic
 * @copyright         Perfect Timing
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Spotlight
 * Plugin URI:        https://karavic.com/spotlight
 * Description:       Display Widget for The Popular Posts 
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Certified Vic
 * Author URI:        https://karavic.com/certifiedvic
 * Text Domain:       spotlight
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

// Load Class
require_once(plugin_dir_path(__FILE__).'/inc/spotlight-popularposts-class.php');

// Register Widget
function register_spotlightpopularposts_widget(){
    register_widget('Spotlight_PopularPosts_Widget');
  }
  // Hook in function
add_action('widgets_init', 'register_spotlightpopularposts_widget');


// to defer parsing of JS

function spotlight_defer_parsing_of_js ( $url ) {

    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    if ( strpos( $url, 'jquery.js' ) ) return $url;
    return "$url' defer ";

  }

  add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );

  

//  activation
// require_once plugin_dir_path( __FILE__ ) . 'inc/dragonoid-activation.php';

// deactivation
// require_once plugin_dir_path( __FILE__ ) . 'inc/dragonoid-deactivation.php';
