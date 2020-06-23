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
 * Version:           1.0.5
 * Requires at least: 5.2
 * Requires PHP:      7.1
 * Author:            Certified Vic
 * Author URI:        https://karavic.com/certifiedvic
 * Text Domain:       spotlight
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );


Class Spotlight{

  function __construct()
  {
    # code...
    require_once(plugin_dir_path(__FILE__).'/inc/spotlight-popularposts-class.php');

    add_action('widgets_init', array($this,'popularposts_widget'));


  }

  function popularposts_widget()
  {
    # code...

    register_widget('Spotlight_PopularPosts_Widget');


  }


}



if ( class_exists('Spotlight')) {
  # code...

  $myspotlight = new Spotlight();

}
