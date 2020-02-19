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
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.0
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


function spotlight_html_contact_form()
{
  # code...

  echo '<form action="'.esc_url( $_SERVER['REQUEST_URI'] ).'" method="post">';
  echo '<div class="row">';
  echo '<div class="col-md-4 form-group">';
  echo '<label for="name">Name</label>';
  echo '<input type="text" id="spotlight-name" name="spotlight-name" required pattern="[a-zA-Z0-9 ]+" value="'.( isset( $_POST["spotlight-name"] ) ? esc_attr( $_POST["spoltlight-name"] ) : '' ) .'" class="form-control ">';
  echo '</div>';
  echo '<div class="col-md-4 form-group">';
  echo '<label for="phone">Phone</label>';
  echo '<input type="text" name="spotlight-phone" pattern="[0-9]+" value="'.( isset( $_POST["spotlight-phone"] ) ? esc_attr( $_POST["spoltlight-phone"] ) : '' ) .'" id="phone" class="form-control ">';
  echo '</div>';
  echo '<div class="col-md-4 form-group">';
  echo '<label for="email">Email</label>';
  echo '<input type="email" name="spotlight-email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" id="email" value="'.( isset( $_POST["spotlight-email"] ) ? esc_attr( $_POST["spoltlight-email"] ) : '' ) .'" class="form-control ">';
  echo '</div>';
  echo '</div>';
  echo '<div class="row">';
  echo '<div class="col-md-12 form-group">';
  echo '<label for="message">Write Message</label>';
  echo '<textarea name="spotlight-message" id="message" class="form-control " cols="30" rows="8">' . ( isset( $_POST["spotlight-message"] ) ? esc_attr( $_POST["spotlight-message"] ) : '' ) . '</textarea>';
  echo '</div>';
  echo '</div>';
  echo '<div class="row">';
  echo '<div class="col-md-6 form-group">';
  echo '<input type="submit" value="Send Message" name="spotlight-submitted" class="btn btn-primary">';
  echo '</div>';
  echo '</div>';
  echo '</form>';


}

function spotlight_deliver_mail() {

  // if the submit button is clicked, send the email
  if ( isset( $_POST['spotlight-submitted'] ) ) {

      // sanitize form values
      $name    = sanitize_text_field( $_POST["spotlight-name"] );
      $phone   = sanitize_text_field( $_POST["spotlight-phone"] );
      $email   = sanitize_email( $_POST["spotlight-email"] );
      $message = esc_textarea( $_POST["spotlight-message"] );

      // get the blog administrator's email address
      $to = get_option( 'admin_email' );

      $headers = "From: $name <$email>" . "\r\n";

      // If email has been process for sending, display a success message
      if ( wp_mail( $to, $phone, $message, $headers ) ) {
          echo '<div>';
          echo '<p>Thanks for contacting me, expect a response soon.</p>';
          echo '</div>';
      } else {
          echo 'An unexpected error occurred';
      }
  }
}

function spotlight_cf_shortcode() {
  ob_start();
  spotlight_deliver_mail();
  spotlight_html_contact_form();

  return ob_get_clean();

}

add_shortcode( 'perfect_contact_form', 'spotlight_cf_shortcode' );



//  activation
// require_once plugin_dir_path( __FILE__ ) . 'inc/dragonoid-activation.php';

// deactivation
// require_once plugin_dir_path( __FILE__ ) . 'inc/dragonoid-deactivation.php';
