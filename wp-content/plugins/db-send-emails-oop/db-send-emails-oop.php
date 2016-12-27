<?php


/**
 * Plugin Name: Send custom emails OOP version
 * Version: 1.0
 * Description: sends email reminders OOP version
 * Author: Daryl Batchelor
 * Author URI: http://batchelors.id.au
 * Plugin URI: 
 */

define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Bail if called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// DB_User Class
require_once( dirname( __FILE__ ) . '/inc/class.db-users.php' );
// DB_User Class
require_once( dirname( __FILE__ ) . '/inc/class.db-emailer.php' );

// DB_Emailer Class
//require_once( dirname( __FILE__ ) . '/inc/class.db-emailer.php' );