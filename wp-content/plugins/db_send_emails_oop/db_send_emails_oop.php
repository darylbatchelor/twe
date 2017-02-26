<?php


/**
 * Plugin Name: Send custom emails OOP version
 * Version: 1.0
 * Description: sends email reminders OOP version
 * Author: Daryl Batchelor
 * Author URI: http://batchelors.id.au
 * Plugin URI: 
 */

define( 'PLUGIN_DIR', plugin_dir_url( __FILE__ ) );
define( 'SEND_EMAIL_PLUGIN_DIR_INC', PLUGIN_DIR . 'inc/' );
define('TEMP_DIR', SEND_EMAIL_PLUGIN_DIR_INC . 'templates/');
define('IMG_DIR', SEND_EMAIL_PLUGIN_DIR_INC . 'images/');

// Bail if called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// DB_User Class
require_once( dirname( __FILE__ ) . '/inc/class.db-users.php' );


//add_action( 'my_daily_event',  'send_emails_daily' );
add_action( 'my_daily_event',  'send_emails_daily' );

function send_emails_daily($all_users){
// DB_User Class
require_once( dirname( __FILE__ ) . '/inc/class.db-emailer.php' );

$all_users = new DB_Emailer('anniversary');


//$all_users->getAllToolUsers('anniversary');
//$all_users->showUsers('anniversary');
//$all_users->sendEmailToUsers("new Email to all Anniversary tool users", "Hey all Tool users");
$all_users->sendAnniversaryReminderEmail('1');
$all_users->sendAnniversaryReminderEmail('7');
$all_users->sendAnniversaryReminderEmail('14');
$all_users->sendAnniversaryReminderEmail('21');
$all_users->sendAnniversaryReminderEmail('30');

//wife birthday reminders
$all_users->sendWifeBirthdayReminderEmail('1');
$all_users->sendWifeBirthdayReminderEmail('7');
$all_users->sendWifeBirthdayReminderEmail('14');
$all_users->sendWifeBirthdayReminderEmail('21');
$all_users->sendWifeBirthdayReminderEmail('30');

//Valentines Day reminders
$all_users->sendValentinesEmail('30');
$all_users->sendValentinesEmail('14');
$all_users->sendValentinesEmail('7');
$all_users->sendValentinesEmail('1');

//Mothers Day reminders
$all_users->sendMothersDayEmail('30');
$all_users->sendMothersDayEmail('14');
$all_users->sendMothersDayEmail('7');
$all_users->sendMothersDayEmail('1');

//Mothers Day reminders
$all_users->sendOtherBirthdayEmails('30');
$all_users->sendOtherBirthdayEmails('14');
$all_users->sendOtherBirthdayEmails('7');
$all_users->sendOtherBirthdayEmails('1');


}




function db_send_emails_oop_activate() {

        wp_schedule_event( time(), 'daily', 'my_daily_event' );
}
register_activation_hook( __FILE__, 'db_send_emails_oop_activate' );

function db_send_emails_oop_deactivate() {

        wp_clear_scheduled_hook('my_daily_event');
}

register_deactivation_hook( __FILE__, 'db_send_emails_oop__deactivate' );

