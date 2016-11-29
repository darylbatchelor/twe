<?php
/**
 * Plugin Name: DB custom subscriber display
 * Version: 1.0
 * Description: Customises subscriber display - removes admin bar
 * Author: Daryl Batchelor
 * Author URI: http://batchelors.id.au
 * Plugin URI: 
 */

//Removes top admin bar

add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

//Customises profile pannel for subscribers

add_action('admin_head','hide_personal_options');

function hide_personal_options(){




echo "\n" . '<script type="text/javascript">jQuery(document).ready(function($) {
	$(\'form#your-profile > h3:first\').hide(); 
	$(\'form#your-profile > table:first\').hide(); 
	$(\'form#your-profile .user-url-wrap\').hide(); 
	$(\'form#your-profile .user-nickname-wrap\').hide();
	$(\'form#your-profile .user-description-wrap\').hide();
	$(\'form#your-profile .user-display-name-wrap\').hide();	
	$(\'form#your-profile h2:nth-of-type(1), form#your-profile h2:nth-of-type(2), form#your-profile h2:nth-of-type(2)\').hide();
	$(\'form#your-profile\').show(); 

	});</script>' . "\n";

}

function db_custom_styles_scripts() {

    wp_enqueue_style( 'frontendDashboard', plugins_url( '/css/frontend-dashboard.css', __FILE__ ) );
 


   }
add_action( 'wp_enqueue_scripts', 'db_custom_styles_scripts' );



?>