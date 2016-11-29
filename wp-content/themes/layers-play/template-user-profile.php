<?php
/**
 * Template Name: User Profile
 *
 * Allow users to update their profiles from Frontend.
 *
 */
 

/* Get user info. */
global $current_user, $wp_roles;
get_currentuserinfo();

/* Load the registration file. */
require_once( ABSPATH . WPINC . '/registration.php' );
$error = array();    
/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

    /* Update user password. */
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] )
            wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
        else
            $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
    }

    /* Update user information. */
   
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] )))
            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
        elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
            $error[] = __('This email is already used by another user.  try a different one.', 'profile');
        else{
            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
        }
    }

    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
    if ( !empty( $_POST['display_name'] ) )
        wp_update_user(array('ID' => $current_user->ID, 'display_name' => esc_attr( $_POST['display_name'] )));
      update_user_meta($current_user->ID, 'display_name' , esc_attr( $_POST['display_name'] ));
    if ( !empty( $_POST['anniversary'] ) )
        $date = esc_attr( $_POST['anniversary']);
        list($year, $month, $day) = split('[-]', $date);
        
        update_user_meta( $current_user->ID, 'anniversary-day', $day );
        update_user_meta( $current_user->ID, 'anniversary-month', $month );
        update_user_meta( $current_user->ID, 'anniversary-year', $year );
        update_user_meta( $current_user->ID, 'anniversary', esc_attr( $_POST['anniversary'] ) );
    if ( !empty( $_POST['wife-birthday'] ) ){
        $date = esc_attr( $_POST['wife-birthday']);
        list($year, $month, $day) = split('[-]', $date);
        
        update_user_meta( $current_user->ID, 'wife-birthday-day', $day );
        update_user_meta( $current_user->ID, 'wife-birthday-month', $month );
        update_user_meta( $current_user->ID, 'wife-birthday-year', $year );

    }
    /* Redirect so the page will show updated info.*/
  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
    if ( count($error) == 0 ) {
        //action hook for plugins and extra fields saving
        do_action('edit_user_profile_update', $current_user->ID);
        wp_redirect( get_permalink().'?updated=true' ); exit;
    }       
}



get_header(); // Loads the header.php template. ?>



<div <?php post_class( 'container content-main clearfix' ); ?>>
    <?php do_action('layers_before_page_loop'); ?>
    <div class="grid">
        <?php if( have_posts() ) : ?>
            <?php while( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php layers_center_column_class(); ?>>
                    <?php get_template_part( 'partials/content', 'single' ); ?>

<!--need to add this script in properly-->              
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
	
            <?php if ( !is_user_logged_in() ) : ?>

                    <p class="warning">
                        <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
                    </p><!-- .warning -->
            <?php else : ?>


<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Site Profile</a></li>
    <li><a href="#tabs-2">Relationship Info</a></li>
   <li><a href="#tabs-3">test info</a></li>
  </ul>
  <div id="tabs-1">
    
<?php
$user_id = get_current_user_id();
  $all_meta_for_user = get_user_meta( $user_id );
 
?>
             <h3>Update Information for &quot;<?php echo $current_user->user_login ?>&quot;</h3></br>
                <?php if ( $_GET['updated'] == 'true' ) : ?> <div id="message" class="updated"><p>Your profile has been updated.</p></div> <?php endif; ?>
                <?php if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; ?>
                <form method="post" id="adduser" action="<?php the_permalink(); ?>">
                    <p class="form-username">
                        <label for="first-name"><?php _e('First Name', 'profile'); ?></label>
                        <input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" />
                    </p><!-- .form-username -->
                    <p class="form-username">
                        <label for="last-name"><?php _e('Last Name', 'profile'); ?></label>
                        <input class="text-input" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" />
                    </p><!-- .form-username -->
                    <!-- .form-display_name -->
                    <p class="form-display_name"><label for="display_name"><?php _e('Display name publicly as') ?></label>
                    
                        <select name="display_name" id="display_name"><br/>
                        <?php
                            $public_display = array();
                            $public_display['display_nickname']  = $current_user->nickname;
                            $public_display['display_username']  = $current_user->user_login;

                            if ( !empty($current_user->first_name) )
                                $public_display['display_firstname'] = $current_user->first_name;

                            if ( !empty($current_user->last_name) )
                                $public_display['display_lastname'] = $current_user->last_name;

                            if ( !empty($current_user->first_name) && !empty($current_user->last_name) ) {
                                $public_display['display_firstlast'] = $current_user->first_name . ' ' . $current_user->last_name;
                                $public_display['display_lastfirst'] = $current_user->last_name . ' ' . $current_user->first_name;
                            }

                            if ( ! in_array( $current_user->display_name, $public_display ) ) // Only add this if it isn't duplicated elsewhere
                                $public_display = array( 'display_displayname' => $current_user->display_name ) + $public_display;

                            $public_display = array_map( 'trim', $public_display );
                            $public_display = array_unique( $public_display );

                            foreach ( $public_display as $id => $item ) {
                        ?>
                            <option <?php selected( $current_user->display_name, $item ); ?>><?php echo $item; ?></option>
                        <?php
                            }
                        ?>
                        </select></p><!-- .form-display_name -->
                    <p class="form-email">
                        <label for="email"><?php _e('E-mail *', 'profile'); ?></label>
                        <input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" />
                    </p><!-- .form-email -->


                    <p class="form-password">
                        <label for="pass1"><?php _e('Password *', 'profile'); ?> </label>
                        <input class="text-input" name="pass1" type="password" id="pass1" />
                    </p><!-- .form-password -->
                    <p class="form-password">
                        <label for="pass2"><?php _e('Repeat Password *', 'profile'); ?></label>
                        <input class="text-input" name="pass2" type="password" id="pass2" />
                    </p><!-- .form-password -->
                 

   

  </div><!--end tab 1-->
  <div id="tabs-2">
    <br>

    <?php 
    $anniversary_year =  $all_meta_for_user['anniversary-year'][0];
    $anniversary_month =  $all_meta_for_user['anniversary-month'][0]; 
    $anniversary_day =  $all_meta_for_user['anniversary-day'][0];
    $anniversary = $anniversary_year . "-" . $anniversary_month . "-" .$anniversary_day;

   $wife_birthday_year =  $all_meta_for_user['wife-birthday-year'][0];
    $wife_birthday_month =  $all_meta_for_user['wife-birthday-month'][0]; 
    $wife_birthday_day =  $all_meta_for_user['wife-birthday-day'][0];
    $wife_birthday = $wife_birthday_year . "-" . $wife_birthday_month . "-" .$wife_birthday_day;

    ?>
                    <p class="form-email">
                            <p>Wedding Date: <input type="date" id="anniversary" name="anniversary"  value="<?php  echo $anniversary; ?>"></p>
                         
                    </p><!-- .form-email -->

                    <p class="form-email">
                            <p>Wife Birthday: <input type="date" id="wife-birthday" name="wife-birthday"  value="<?php echo $wife_birthday; ?>"></p>
                         
                    </p><!-- .form-email -->


                 

  </div><!--end tab 2-->

    <div id="tabs-3">
    <br>
                    <p>
<?php


function send_flower_email(){

//Get current date
  $date = date('Y-m-d');

//split up date into $day and $month
list($year, $month, $day) = split('[-]', $date);

//check if current date matches monthly flower date

  $yearly_random_dates = get_option('yearly_random_dates');




foreach ($yearly_random_dates as $key => $value) {

  if ($value == $date) {
    
    //look up all users who have flower subscription
    global $wpdb;
    $flower_members = $wpdb->get_results("SELECT `user_id` FROM `wp_pmpro_memberships_users` WHERE `membership_id` = 2", ARRAY_N);
    $member_string = array();

    //put all members id numbers in a string
     foreach ($flower_members as $key => $value) {

        array_push($member_string, $value[0]);
      }


    $member_string = implode(', ' , $member_string);

    //query database for members with flower subscriptions and return display name and email

    $flower_members = $wpdb->get_results("SELECT user_email, display_name FROM wp_users WHERE ID IN ($member_string)", ARRAY_A);

    //send email to each person

    foreach ($flower_members as $flower_members) {
      
      
       $to = $flower_members['user_email'];
                     
       $subject = 'Its Flower Day!';
       $body = "Hey " . $flower_members['display_name'] . "<br><br> Its Flower Day again!<br><br>Click on the below link to get your flowers<br><a href='google.com'>Click here to get you discounted flowers</a><br><br>Regards,<br><br> the guys at The Wife Enigma";

       $headers = array('Content-Type: text/html; charset=UTF-8');
                      
       wp_mail( $to, $subject, $body, $headers ); 

    }

  }
  
 }



}

//send_flower_email();


function wife_birthday_reminder_email($days){
//set timezone - may have to change this to DateTime class
date_default_timezone_set('America/Chicago');

// Get current date
$date = date('Y-m-d');
                           
//get all birthdays 2 weeks from now
$date = date('Y-m-d', strtotime($date . ' +' . $days . ' days'));
                          
//split up date into $day and $month
list($year, $month, $day) = split('[-]', $date);

                         

//arguments for query below
$args = array(
    'meta_query' => array(
        array(
            'key' => 'wife-birthday-day',
            'value' => $day,
            'compare' => '='
           
        ),
        array(
            'key' => 'wife-birthday-month',
            'value' => $month,
            'compare' => '='
            
        )
    )
);

//query database for user obj array and get all users who have a wife with a birthday 2 weeks away
$allusers = get_users( $args);
if (!empty($allusers)) {
         foreach ($allusers as $allusers) {
      
               $to = $allusers->user_email;
               
               if ($days == '1') {
               $subject = 'Your partners birthday is tomorrow!';
               $body = "Hey " . $allusers->display_name . "<br><br> Your wife's birthday is tomorrow!<br><br> I hope you have something and she appreciates it.<br><br>Regards,<br><br> the guys at The Wife Enigma";
               } else {
               $subject = 'Your partners birthday is in ' . $days . ' days!';
               $body = "Hey " . $allusers->display_name . "<br><br> Your wife's birthday is in " . $days . " days.<br><br> If you haven't got her a present already, now would be a good time to start to think about what to get her... Don't leave it to the last minute!<br><br>Regards,<br><br> the guys at The Wife Enigma";
               }
               $headers = array('Content-Type: text/html; charset=UTF-8');
                
               wp_mail( $to, $subject, $body, $headers ); 
                   //send email function goes here using details above function send_birthday_reminder($notice (14 - days))
          }
    }                         


}

wife_birthday_reminder_email('14');
wife_birthday_reminder_email('7');
wife_birthday_reminder_email('1');

function wife_anniversary_reminder_members($days){
// Get current date
$date = date('Y-m-d');
                          
//get all birthdays 2 weeks from now
$date = date('Y-m-d', strtotime($date . ' +' . $days . ' days'));
                      
//split up date into $day and $month
list($year, $month, $day) = split('[-]', $date);

                         

//arguments for query below
$args = array(
    'meta_query' => array(
        array(
            'key' => 'anniversary-day',
            'value' => $day,
            'compare' => '='
           
        ),
        array(
            'key' => 'anniversary-month',
            'value' => $month,
            'compare' => '='
            
        )
        //add in argument to filter for certain membership levels
    )
);

//query database for user obj array and get all users who have a wife with a birthday 2 weeks away
$allusers = get_users( $args);

if (!empty($allusers)) {
         foreach ($allusers as $allusers) {
      //need to look up anniversary year to figure out what anniversary it is
       $user_id = $allusers->ID;
       $key = 'anniversary-year';
       $single = true;
       $anniversary_year = get_user_meta( $user_id, $key, $single );
       $anniversary = intval($year) - intval($anniversary_year);
      
     //once year is established need to look up gift ideas in custom post
$args = array(
   'meta_query' => array(
       array(
           'key' => 'year',
           'value' => $anniversary,
           'compare' => '=',
       )
   )
);
global $wpdb;
$anniversary_post = $wpdb->get_results("SELECT * FROM $wpdb->postmeta
WHERE meta_key = 'year' AND  meta_value = '" . $anniversary . "' LIMIT 1", OBJECT);

$anniversary_post_id = $anniversary_post[0]->post_id;
$postmeta_array = get_post_meta($anniversary_post_id);


$modern_gift = $postmeta_array['modern_gift'][0];
$traditional_gift_uk = $postmeta_array['traditional_gift_uk'][0];
$traditional_gift_us = $postmeta_array['traditional_gift_us'][0];
$gemstone = $postmeta_array['gemstone'][0];
$color = $postmeta_array['color'][0];
$ideas = $postmeta_array['ideas'][0];

//delete this -> echo $modern_gift . $traditional_gift_us . $traditional_gift_uk . $gemstone . $color . $ideas;
      //mail info
               $to = $allusers->user_email;

               if ($days == '1') {
               $subject = 'Your anniversary is tomorrow!';
               $body = "Hey " . $allusers->display_name . "<br><br> Your " . $anniversary . " year anniversary is tomorrow!<br><br> I hope you have everything all sorted.<br><br>Regards,<br><br> the guys at The Wife Enigma";
               } else {
               $subject = 'Your anniversary is in ' . $days . ' days!';
               $body = "Hey " . $allusers->display_name . "<br><br> Your " . $anniversary . " year anniversary is in " . $days . " days.<br><br> If you haven't got her a present already, now would be a good time to start to think about what to get her... For " . $anniversary . " year anniversaries, the following is a list of the usual anniversary themes that may help:<br><br> Modern Gift: " . $modern_gift . "<br>Traditional Gift (UK): " . $traditional_gift_uk . "<br>Traditional Gift (US): " . $traditional_gift_us . "<br> Gemstone: " . $gemstone . "<br>Color: " . $color . "<br><br>Here are also a few ideas that may work for you:<br> " . $ideas . "<br><br>Don't leave it to the last minute!<br><br>Regards,<br><br> the guys at The Wife Enigma";
               }
               $headers = array('Content-Type: text/html; charset=UTF-8');
                
              wp_mail( $to, $subject, $body, $headers ); 
                   //send email function goes here using details above function send_birthday_reminder($notice (14 - days))
          }
    }                         


}

//wife_anniversary_reminder_members('1');
//wife_anniversary_reminder_members('7');


?>
 </p><!-- .form-email -->


                 

  </div><!--end tab 3-->
  
</div>


                    <?php 
                        //action hook for plugin and extra fields
                       // do_action('edit_user_profile',$current_user); 
                    ?>
                    <br><br>
                    <p class="form-submit update-user-wrap">
                        <?php echo $referer; ?>
                        <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'profile'); ?>" />
                        <?php wp_nonce_field( 'update-user_'. $current_user->ID ) ?>
                        <input name="action" type="hidden" id="action" value="update-user" />
                    </p><!-- .form-submit -->
                </form><!-- #adduser -->
            <?php endif; ?>


	



	
  </article>
            <?php endwhile; // while has_post(); ?>
        <?php endif; // if has_post() ?>
    </div>
    <?php do_action('layers_after_page_loop'); ?>
</div>
<?php get_footer(); // Loads the footer.php template. ?>