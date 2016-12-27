<?php
/**
 * Template Name: My Account Page
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

 if ( !empty( $_POST['user-birthday'] ) ){
        $date = esc_attr( $_POST['user-birthday']);
        
        
        update_user_meta( $current_user->ID, 'user-birthday', $date );
     

    }

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

    //tool activation

    if ( !empty( $_POST['anniversary-tool'] && $_POST['anniversary-tool'] == "1" ) ){
                
        update_user_meta( $current_user->ID, 'anniversary-tool', 1 );
      } else {
        update_user_meta( $current_user->ID, 'anniversary-tool', 0 );
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

  <style>

  h2, h3, h4 {
    color: #fff;
  }

  </style>
	
            <?php if ( !is_user_logged_in() ) : ?>

                    <p class="warning">
                        <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
                    </p><!-- .warning -->
            <?php else : ?>


<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Account</a></li>
    <li><a href="#tabs-2">Relationship Info</a></li>
    <li><a href="#tabs-3">Tools</a></li>
   
  </ul>

   <div id="tabs-1">




<?php
$user_id = get_current_user_id();
  $all_meta_for_user = get_user_meta( $user_id );
 
?>
  
             <h3>Edit Profile</h3></br>
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
                  <br>
                    <div style="border-top: 1px #fff solid">
                    <br>

                    <h3>Change Password</h3>
                    <br>
                    <p class="form-password">
                        <label for="pass1"><?php _e('Password *', 'profile'); ?> </label>
                        <input class="text-input" name="pass1" type="password" id="pass1" />
                    </p><!-- .form-password -->
                    <p class="form-password">
                        <label for="pass2"><?php _e('Repeat Password *', 'profile'); ?></label>
                        <input class="text-input" name="pass2" type="password" id="pass2" />
                    </p><!-- .form-password -->
                    </div>
                      <br>
                      <div style="border-top: 1px #fff solid">
                        <br>
                     <h3>Your Birthday</h3>
                     <br>
                     <?php $user_birthday =  $all_meta_for_user['user-birthday'][0]; ?>
                       <p class="form-email">
                            <p> <input type="date" id="user-birthday" name="user-birthday"  value="<?php  echo $user_birthday; ?>"></p>
                         
                    </p><!-- .form-email -->
                    </div>

      <br>
      <?php echo  do_shortcode('[pmpro_account]'); ?>

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
    <h2>Unlocked Tools</h2>
    <br>
      <?php echo  do_shortcode('[mycred_my_badges]'); ?>
      <br>
      <div style="border-top: 1px #fff solid">
      <br>
      <h2>Available Tools</h2>
      <br>
      <?php echo  do_shortcode('[mycred_badges]'); ?>
      </div>
      <div style="border-top: 1px #fff solid">
       <br>
       <h2>Activate/Deactivate tools</h2>
       <br>
        <h3>Anniversary Reminder Tool</h3>

        <p>This tool sends you email reminders leading up to your anniversary with awesome anniversary gift ideas.  The result - hassle free gift picking for anniversaries!</p>
        <br>
        <p class="form-email">
          <p>Activate Tool: <input type="checkbox" name="anniversary-tool" value="1" id="anniversary-tool" <?php if ($all_meta_for_user['anniversary-tool'][0] == 1) { echo 'checked'; }  ?>></p>
                           
        </p><!-- .form-email -->
    </div>
      <p>
<?php

echo date('Y-m-d');

$all_users = new DB_Emailer('anniversary');
//$all_users->getAllToolUsers('anniversary');
//$all_users->showUsers('anniversary');
//$all_users->sendEmailToUsers("new Email to all Anniversary tool users", "Hey all Tool users");
$all_users->sendAnniversaryReminderEmail('1');
$all_users->sendAnniversaryReminderEmail('7');
$all_users->sendAnniversaryReminderEmail('14');
$all_users->sendAnniversaryReminderEmail('21');
$all_users->sendAnniversaryReminderEmail('30');



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