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
        $items .= '<li><a href="'. site_url('/user-profile/') .'">My Account ' . get_avatar( $current_user->user_email, 20 ); '</a></li>';
        $items .= '<li><a href="'. wp_logout_url() .'">Log Out</a></li>';
    }
    elseif (!is_user_logged_in() && $args->theme_location == 'layers-secondary-right') {
        $items .= '<li><a href="'. site_url('wp-login.php') .'">Log In</a></li>';
        $items .= '<li class="top-menu-register"><a href="'. site_url('wp-login.php?action=register') .'">JOIN FOR FREE</a></li>';
    }
    return $items;
}

// create widget for mobile view

// Creating the widget

class db_widget extends WP_Widget {

 

function __construct() {

parent::__construct(

// Base ID of your widget

'db_widget',

 

// Widget name will appear in UI

__('Mobile Account Menu', 'db_widget_themanpa'),

 

// Widget description

array( 'description' => __( 'Adds Log In/Out and Account area access when logged in', 'db_widget_themanpa' ), )

);

}

 

// Creating widget front-end

// This is where the action happens

public function widget( $args, $instance ) {

$title = apply_filters( 'widget_title', $instance['title'] );

// before and after widget arguments are defined by themes

echo $args['before_widget'];

if ( ! empty( $title ) )

echo $args['before_title'] . $title . $args['after_title'];

 

// This is where you run the code and display the output
 $current_user = wp_get_current_user();

 if (is_user_logged_in()) {
        $items .= '<li><a href="'. site_url('/user-profile/') .'">My Account ' . get_avatar( $current_user->user_email, 20 ); '</a></li>';
        $items .= '<li><a href="'. wp_logout_url() .'">Log Out</a></li>';
    }
    elseif (!is_user_logged_in() ) {
        $items .= '<li><a href="'. site_url('wp-login.php') .'">Log In</a></li>';
        $items .= '<li class="top-menu-register"><a href="'. site_url('wp-login.php?action=register') .'">JOIN FOR FREE</a></li>';
    }
  echo $items;

echo $args['after_widget'];

}

         

// Widget Backend

public function form( $instance ) {

if ( isset( $instance[ 'title' ] ) ) {

$title = $instance[ 'title' ];

}

else {

$title = __( 'New title', 'db_widget_themanpa' );

}

// Widget admin form

?>

<p>

<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>

<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />

</p>

<?php

}

     

// Updating widget replacing old instances with new

public function update( $new_instance, $old_instance ) {

$instance = array();

$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

return $instance;

}

} // Class db_widget ends here

 

// Register and load the widget

function db_load_widget() {

    register_widget( 'db_widget' );

}

add_action( 'widgets_init', 'db_load_widget' );


?>