<?php

/**
 * Plugin Name: DB random monthly date editor
 * Version: 1.0
 * Description: Adds random date editor to the menu
 * Author: Daryl Batchelot
 * Author URI: http://batchelors.id.au
 * Plugin URI: 
 */

add_action( 'admin_menu', 'random_date_admin_menu' );

function random_date_admin_menu() {
// Create top-level menu item
add_menu_page( 'Random Date Configuration Page',
'Flower Day', 'manage_options',
'db-random-date-main-menu', 'db_random_date_main',
plugins_url( 'event-icon.png', __FILE__ ) );

}

function db_random_date_main() {
// Retrieve plugin configuration options from database
$options = get_option( 'yearly_random_dates' );
?>
<div id="ch2pho-general" class="wrap">
<h2>Random monthly dates for this year</h2>
<form method="post" action="admin-post.php">
<input type="hidden" name="action"
value="save_ch2pho_options" />
<!-- Adding security through hidden referrer field -->
<?php wp_nonce_field( 'ch2pho' ); ?>
January:<br> <input type="date" name="january_date" value="<?php echo esc_html( $options[0] ); ?>"/><br />
February:<br> <input type="date" name="february_date" value="<?php echo esc_html( $options[1] ); ?>"/><br />
March:<br> <input type="date" name="march_date" value="<?php echo esc_html( $options[2] ); ?>"/><br />
April:<br> <input type="date" name="april_date" value="<?php echo esc_html( $options[3] ); ?>"/><br />
May:<br> <input type="date" name="may_date" value="<?php echo esc_html( $options[4] ); ?>"/><br />
June:<br> <input type="date" name="june_date" value="<?php echo esc_html( $options[5] ); ?>"/><br />
July:<br> <input type="date" name="july_date" value="<?php echo esc_html( $options[6] ); ?>"/><br />
August:<br> <input type="date" name="august_date" value="<?php echo esc_html( $options[7] ); ?>"/><br />
September:<br> <input type="date" name="september_date" value="<?php echo esc_html( $options[8] ); ?>"/><br />
Octobe:<br> <input type="date" name="october_date" value="<?php echo esc_html( $options[9] ); ?>"/><br />
November:<br> <input type="date" name="november_date" value="<?php echo esc_html( $options[10] ); ?>"/><br />
December:<br> <input type="date" name="december_date" value="<?php echo esc_html( $options[11] ); ?>"/><br /><br>


<!-- need to put rest of the inputs here!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->

<input type="submit" value="Update" class="button-primary"/>
</form>
</div>
<?php }

add_action( 'admin_init', 'ch2pho_admin_init' );

function ch2pho_admin_init() {
add_action( 'admin_post_save_ch2pho_options',
'process_ch2pho_options' );
}

function process_ch2pho_options() {
// Check that user has proper security level
if ( !current_user_can( 'manage_options' ) )
wp_die( 'Not allowed' );
// Check that nonce field created in configuration form
// is present
check_admin_referer( 'ch2pho' );
// Retrieve original plugin options array
$options = get_option( 'yearly_random_dates' );


if ( isset( $_POST['january_date'] ) ) {
$options[0] =
sanitize_text_field( $_POST['january_date'] );
}

if ( isset( $_POST['february_date'] ) ) {
$options[1] =
sanitize_text_field( $_POST['february_date'] );
}

if ( isset( $_POST['march_date'] ) ) {
$options[2] =
sanitize_text_field( $_POST['march_date'] );
}

if ( isset( $_POST['april_date'] ) ) {
$options[3] =
sanitize_text_field( $_POST['april_date'] );
}

if ( isset( $_POST['may_date'] ) ) {
$options[4] =
sanitize_text_field( $_POST['may_date'] );
}

if ( isset( $_POST['june_date'] ) ) {
$options[5] =
sanitize_text_field( $_POST['june_date'] );
}
if ( isset( $_POST['july_date'] ) ) {
$options[6] =
sanitize_text_field( $_POST['july_date'] );
}

if ( isset( $_POST['august_date'] ) ) {
$options[7] =
sanitize_text_field( $_POST['august_date'] );
}

if ( isset( $_POST['september_date'] ) ) {
$options[8] =
sanitize_text_field( $_POST['september_date'] );
}

if ( isset( $_POST['october_date'] ) ) {
$options[9] =
sanitize_text_field( $_POST['october_date'] );
}

if ( isset( $_POST['november_date'] ) ) {
$options[10] =
sanitize_text_field( $_POST['november_date'] );
}

if ( isset( $_POST['december_date'] ) ) {
$options[11] =
sanitize_text_field( $_POST['december_date'] );
}


//need to add rest of inputs here too!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

// Store updated options array to database
update_option( 'yearly_random_dates', $options );
// Redirect the page to the configuration form that was
// processed
wp_redirect( add_query_arg( 'page',
'db-random-date-main-menu',
admin_url( 'admin.php' ) ) );
exit;
}

?>