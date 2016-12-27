<?php 
/**
 * Plugin Name: DB redirect users on login
 * Version: 1.0
 * Description: Redirects users to home page after login
 * Author: Daryl Batchelor
 * Author URI: http://batchelors.id.au
 * Plugin URI: 
 */
function my_login_redirect( $url, $request, $user ){
    if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
        if( $user->has_cap( 'administrator' ) ) {
            $url = admin_url();
        } else {
            $url = home_url('/user-profile/');
        }
    }
    return $url;
}
add_filter('login_redirect', 'my_login_redirect', 10, 3 );