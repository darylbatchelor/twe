<?php
/**
 * Plugin Name: DB custom menu iteem top
 * Version: 1.0
 * Description: Adds Log In and Logout/Register to top menu
 * Author: Daryl Batchelot
 * Author URI: http://batchelors.id.au
 * Plugin URI: 
 */
add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );


function add_loginout_link( $items, $args ) {

 $current_user = wp_get_current_user();

    if (is_user_logged_in() && $args->theme_location == 'layers-secondary-right') {
        $items .= '<li><a href="'. site_url('/user-profile/') .'">' . $current_user->display_name . get_avatar( $current_user->user_email, 20 ); '</a></li>';
        $items .= '<li><a href="'. wp_logout_url() .'">Log Out</a></li>';
    }
    elseif (!is_user_logged_in() && $args->theme_location == 'layers-secondary-right') {
        $items .= '<li><a href="'. site_url('wp-login.php') .'">Log In</a></li>';
        $items .= '<li class="top-menu-register"><a href="'. site_url('wp-login.php?action=register') .'">Register</a></li>';
    }
    return $items;
}


?>