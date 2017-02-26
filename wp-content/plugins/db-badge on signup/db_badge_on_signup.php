<?php 
/**
 * Plugin Name: DB badge on signup
 * Version: 1.0
 * Description: Adds anniversary badge on signup
 * Author: Daryl Batchelor
 * Author URI: http://batchelors.id.au
 * Plugin URI: 
 */

add_filter( 'mycred_all_references', 'mycred_pro_manual_badge' );
function mycred_pro_manual_badge( $references ) {

	$references['disabled_feature'] = 'Badge is manually awarded';
	return $references;

}

add_action('user_register','db_badge_on_signup');

function db_badge_on_signup($user_id){

$badge_id = 101;
$badge_level = 0; // zero for first level
add_user_meta( $user_id, 'mycred_badge_anniversary' . $badge_id, $badge_level, true );
}
