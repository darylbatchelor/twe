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
        list($year, $month, $day) = explode('-', $date);
        
        update_user_meta( $current_user->ID, 'anniversary-day', $day );
        update_user_meta( $current_user->ID, 'anniversary-month', $month );
        update_user_meta( $current_user->ID, 'anniversary-year', $year );
        update_user_meta( $current_user->ID, 'anniversary', $date );

    if ( !empty( $_POST['wife-birthday'] ) ){
        $date = esc_attr( $_POST['wife-birthday']);
        list($year, $month, $day) = explode('-', $date);
        
        update_user_meta( $current_user->ID, 'wife-birthday-day', $day );
        update_user_meta( $current_user->ID, 'wife-birthday-month', $month );
        update_user_meta( $current_user->ID, 'wife-birthday-year', $year );

    }
// NEW CODE STARTS HERE ------------ NEW CODE STARTS HERE -------------NEW CODE STARTS HERE 
    if ( !empty( $_POST['wife-birthday-interests'] ) ){

        
         $interests = get_user_meta($current_user->ID, 'wife-birthday-interests', true); 
              if ($interests == '') {
                $interests = array();
                array_push($interests, esc_attr( $_POST['wife-birthday-interests']));
                update_user_meta( $current_user->ID, 'wife-birthday-interests', $interests);
              } else {
                 array_push($interests, esc_attr( $_POST['wife-birthday-interests']));
                 update_user_meta( $current_user->ID, 'wife-birthday-interests', $interests);

              }
 
    }

    

    if ( !empty( $_POST['birthdays-to-remember'] ) )
    { 
        update_user_meta( $current_user->ID, 'birthdays-to-remember', $_POST['birthdays-to-remember'] );
    }

    $additioanl_birthdays= get_user_meta($current_user->ID, 'birthdays-to-remember', true); 

    if (!$additioanl_birthdays == '') {

      $birthdays_remembering = get_user_meta($current_user->ID, $key = 'birthdays-to-remember', $single = true);

      for ($i=1; $i < $birthdays_remembering +1 ; $i++) 
      { 
          $birthday_number_name = 'birthday-' . (string)$i . '-name';
          $birthday_number_date = 'birthday-' . (string)$i . '-date';
          $birthday_number_gender = 'birthday-' . (string)$i . '-gender';
          $birthday_number_interests = 'birthday-' . (string)$i . '-interests';
          $birthday_number_delete_interests = 'birthday-' . (string)$i . '-delete-interests';
                //add if not empty     
           if ( !empty( $_POST[$birthday_number_name] ) ){
             update_user_meta( $current_user->ID, $birthday_number_name, $_POST[$birthday_number_name] );
            }
            if ( !empty( $_POST[$birthday_number_date] ) ){
             update_user_meta( $current_user->ID, $birthday_number_date, $_POST[$birthday_number_date] );
            }
            if ( !empty( $_POST[$birthday_number_gender] ) ){
              update_user_meta( $current_user->ID, $birthday_number_gender, $_POST[$birthday_number_gender] );
            }
            if ( !empty( $_POST[$birthday_number_interests] ) ){
              $interests = get_user_meta($current_user->ID, $birthday_number_interests, true); 
              if ($interests == '') {
                $interests = array();
                array_push($interests, esc_attr( $_POST[$birthday_number_interests]));
                update_user_meta( $current_user->ID, $birthday_number_interests, $interests);
              } else {
                 array_push($interests, esc_attr( $_POST[$birthday_number_interests]));
                 update_user_meta( $current_user->ID, $birthday_number_interests, $interests);

              }
              
            }
            
        }


}

      if ( !empty( $_POST['mothers-day-country'] ) )
        update_user_meta( $current_user->ID, 'country', esc_attr( $_POST['mothers-day-country'] ) );




   
                        
// NEW CODE ENDS HERE ------------ NEW CODE ENDS HERE -------------NEW CODE ENDS HERE                 

    //tool activation

    if ( !empty( $_POST['anniversary-tool'] && $_POST['anniversary-tool'] == "1" ) ){
                
        update_user_meta( $current_user->ID, 'anniversary-tool', 1 );
      } else {
        update_user_meta( $current_user->ID, 'anniversary-tool', 0 );
      }
// NEW CODE STARTS HERE ------------ NEW CODE STARTS HERE -------------NEW CODE STARTS HERE                 

        //gift tool activation

    if ( !empty( $_POST['gift-tool'] && $_POST['gift-tool'] == "1" ) ){
                
        update_user_meta( $current_user->ID, 'gift-tool', 1 );
      } else {
        update_user_meta( $current_user->ID, 'gift-tool', 0 );
      }
 // NEW CODE ENDS HERE ------------ NEW CODE ENDS HERE -------------NEW CODE ENDS HERE                 
     
     
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
    <li><a href="#tabs-1">Relationship Info</a></li>
    <li><a href="#tabs-2">Account</a></li>
    <li><a href="#tabs-3">Tools</a></li>
   
  </ul>

   <div id="tabs-1">




<?php
 
$user_id = get_current_user_id();
  $all_meta_for_user = get_user_meta( $user_id );
 

?>
  
<?php do_shortcode('[test_amazon]'); ?>
             
                <?php if ( isset($_GET['updated']) && $_GET['updated'] == 'true' ) : ?> <div id="message" class="updated"><p style="color:#557b58">Your profile has been updated.</p><br></div> <?php endif; ?>
                <?php if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; ?>
                <form method="post" id="adduser" action="<?php the_permalink(); ?>">
              
    <br>

    <?php 
    //need to create $anniversary_year/month/day if not set because it occurs on signup
    list($year, $month, $day) = explode('-', $all_meta_for_user['anniversary'][0]);
    
    if (isset($all_meta_for_user['anniversary-year'][0])) {
      $anniversary_year = $all_meta_for_user['anniversary-year'][0];
    } elseif (isset($all_meta_for_user['anniversary'][0])) {
        
        $anniversary_year = $year; 
    } else {
      $anniversary_year =  '';
    }

    if (isset($all_meta_for_user['anniversary-month'][0])) {
      $anniversary_month = $all_meta_for_user['anniversary-month'][0];
    } elseif (isset($all_meta_for_user['anniversary'][0])) {
        
        $anniversary_month = $month; 
      } else {
      $anniversary_month =  '';
    }

    if (isset($all_meta_for_user['anniversary-day'][0])) {
      $anniversary_day = $all_meta_for_user['anniversary-day'][0];
    } elseif (isset($all_meta_for_user['anniversary'][0])) {
        
        $anniversary_day = $day; 
      } else {
      $anniversary_day =  '';
    }
    
    if (isset($all_meta_for_user['anniversary'])) {
      $anniversary = $anniversary_year . "-" . $anniversary_month . "-" .$anniversary_day;
    
    } else {
      $anniversary = $all_meta_for_user['anniversary'][0];
      
    }

    

   $wife_birthday_year =  isset($all_meta_for_user['wife-birthday-year'][0]) ? $all_meta_for_user['wife-birthday-year'][0] : '';
    $wife_birthday_month =  isset($all_meta_for_user['wife-birthday-month'][0]) ? $all_meta_for_user['wife-birthday-month'][0] : ''; 
    $wife_birthday_day =  isset($all_meta_for_user['wife-birthday-day'][0]) ? $all_meta_for_user['wife-birthday-day'][0] : '';
    $wife_birthday = $wife_birthday_year . "-" . $wife_birthday_month . "-" .$wife_birthday_day;
 // NEW CODE STARTS HERE ------------ NEW CODE STARTS HERE -------------NEW CODE STARTS HERE      
    $birthdays_to_remember = isset($all_meta_for_user['birthdays-to-remember'][0]) ? $all_meta_for_user['birthdays-to-remember'][0] : '';
    
    //this needs to be changed for live site as badge will have a different post id
    $gift_tool_badge_earned = isset($all_meta_for_user['mycred_badge451'][0]) ? true : false;

    $country = isset($all_meta_for_user['country'][0]) ? $all_meta_for_user['country'][0] : '';

    ?>
                    <div class="accounts-anniversary">
                      <h2>Anniversary</h2>
                      
                        <?php 
                         $anniversary_set= get_user_meta($current_user->ID, 'anniversary', true); 

                        if (!$anniversary_set == '') {
                          //days been married
                          $now = time(); // or your date as well
                          $your_date = strtotime($anniversary);
                          ?>

                           <?php 
                         
                          //days until anniversary
                          $this_year_anniversary = date("Y") . "-" . $anniversary_month . "-" .$anniversary_day;
                          
                          
                          
                          if ($now > strtotime($this_year_anniversary)) {
                            $next_year_anniversary = date("Y-m-d", strtotime(date("Y-m-d", strtotime($this_year_anniversary)) . " + 365 day"));
                            
                            $your_date = strtotime($next_year_anniversary);
                            $datediff = $your_date - $now;
                            
                          } else{
                            
                            $your_date = strtotime($this_year_anniversary);
                            $datediff = $your_date - $now;
                           
                          }    

                          list($your_date_year, $your_date_month, $your_date_day) = explode('-', $your_date);

                          ?>
                          <p>Your <?php echo date("Y",$your_date) - $anniversary_year; ?> year anniversary is in <?php echo ceil($datediff / (60 * 60 * 24)); ?> days</p> 
                        <?php } ?>  
                        <p class="read-more-link">Expand <span class="fa fa-caret-down"></span></p>
                      <div class="read-more-content">
                        <p class="read-less-link">Collapse <span class="fa fa-caret-up"></span></p>

                          <?php 
                          $your_date = strtotime($anniversary);
                          $datediff = $now - $your_date; ?>
                          
                          <p>You have been married for <?php echo floor($datediff / (60 * 60 * 24)); ?> days</p> 
                         
                         
                        <br>
  <?php // NEW CODE ENDS HERE ------------ NEW CODE ENDS HERE -------------NEW CODE ENDS HERE ?>  

                        <p class="form-email">
                                <p>Wedding Date: <input type="date" id="anniversary" name="anniversary"  value="<?php  echo $anniversary; ?>"></p>
                             
                        </p><!-- .form-email -->
<?php //new code -> ?></div>
                    </div>
<?php // NEW CODE STARTS HERE ------------ NEW CODE STARTS HERE -------------NEW CODE STARTS HERE ?>  
<style type="text/css">
.account-birthdays{
  overflow: auto;
}

.wifes-birthday-box {
    padding: 10px;
    margin-top: 10px;
    border-radius: 5px;
    background-color: #b7c68b;
    color: #000;
}

.birthday-addition-box {
    background-color: #b7c68b;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
    color: #000;
}
.birthday-addition-box h3{
    
    color: #000;
}
.read-more-content{
  display: none;
}

.read-more-link, .read-less-link{
  float: right;
  cursor: pointer;
}

.read-more-content li{
       margin: 26px 5px;
}

a.interests-amazon-button:hover {
    color: #fff;
    background-color: #5e5544;
}

a.interests-amazon-button {
    margin: 5px 23px;
    border-radius: 5px;
    background-color: #555555;
    padding: 5px;
    box-shadow: 2px 2px 0 #2b2b2b;
    transition: 0.5s;
  }

  .trash-can{
    color:#b30303!important;
    transition: 0.5s;
  }

    .trash-can:hover{
    color:red!important;
  }

#mycred-all-badges:hover{
  cursor: pointer;
}

#mycred-all-badges:hover + .next-badge-instructions{
display: block;
}

.next-badge-instructions:hover{
  display: block;
}

.next-badge-instructions{
  display: none;
  position:absolute;
  min-height: 200px;
  width: 100%;
  background-color:#fffffc;
  top:147px;
  border-radius: 5px;
  z-index: 100;
  color: #000;
  text-align: center;
  line-height: 1.5;
}

.next-badge-instructions a[href*="facebook"] {
  color:#fff;
  display: block;
  width: 100px;
  height: 25px;
  background-color: #3b5998;
  text-align: center;
  border-radius: 5px;
  margin: 10px auto 10px auto;
}

.available-tools{
  border-top: 1px #fff solid;
  position: relative;
  color: #fff;
  text-align: center;
}

.available-tools small{
  color: #fff;
}

.ui-tabs .ui-tabs-panel {
    padding: 2em 1.4em;
   
}


</style>

<script type="text/javascript">

jQuery(document).ready(function(){
  
  jQuery('.read-more-link').click(function() {
      jQuery(this).hide().next('.read-more-content').slideDown();
  });
  jQuery('.read-less-link').click(function() {
      
    jQuery(this).parent('div.read-more-content').slideUp().prev('.read-more-link').delay( 500 ).fadeIn( 400 );
  });
  
  
});

</script>

                    <br>
                <?php 
                if ($gift_tool_badge_earned && $all_meta_for_user['gift-tool'][0] == 1) { 
                ?>
                    <div class="account-birthdays">
                      <h2>Birthdays</h2>
                      <?php 
                         

                        if (!$wife_birthday == '') {
                          //wife age
                          $wife_age = date("Y") - date(("Y"), strtotime($wife_birthday_year));
                        

                          //days been married
                          $now = time(); // or your date as well
                          $your_date = strtotime($wife_birthday);
                                                    
                          //days until anniversary
                          $this_year_birthday = date("Y") . "-" . $wife_birthday_month . "-" . $wife_birthday_day;

                                                   
                          if ($now > strtotime($this_year_birthday)) {
                            $next_year_birthday = date("Y-m-d", strtotime(date("Y-m-d", strtotime($this_year_birthday)) . " + 1 year"));
                            
                            $your_date = strtotime($next_year_birthday);
                            $datediff = $your_date - $now;
                            
                          } else{
                            
                            $your_date = strtotime($this_year_birthday);
                            $datediff = $your_date - $now;
                       
                          }
                          ?>
                           <p>You wife's <?php echo $wife_age; ?> birthday is in <?php echo ceil($datediff / (60 * 60 * 24)); if (ceil($datediff / (60 * 60 * 24)) == 1 ) { echo ' day'; } else { echo ' days'; } ?></p> 
                        <?php } ?>  
                      <p class="read-more-link">Expand <span class="fa fa-caret-down"></span></p>
                      <div class="read-more-content">
                      <p class="read-less-link">Collapse <span class="fa fa-caret-up"></span></p>
                      <p class="form-email">
                      <br>
                      <div class="wifes-birthday-box">
                        <p>Wife Birthday: <input type="date" id="wife-birthday" name="wife-birthday"  value="<?php echo $wife_birthday; ?>"></p>
                           
                        </p><!-- .form-email -->
                        <?php 
                          //used to delete wife birthday ideas 
                          if (isset($_GET['wife-birthday-interests'])) {
                            $delete_interest =  esc_attr( $_GET['wife-birthday-interests']);
                            $interests = get_user_meta($current_user->ID, 'wife-birthday-interests', false);
             
                            if ( !$interests[0] =='') {
                               $interests = $interests[0];  
                               $interests = array_diff($interests, array($delete_interest));
                               update_user_meta( $current_user->ID, 'wife-birthday-interests', $interests);
                            } 
                           
                          }
                          //delete birthday
                          if (isset($_GET['delete-birthday'])) {

                           global $wpdb;
                            $delete_birthday_data = esc_attr( $_GET['delete-birthday']);
                            $wpdb->query($wpdb->prepare("DELETE FROM `wp_usermeta` WHERE `wp_usermeta`.`meta_key` LIKE %s;", '%' . $delete_birthday_data . '%'));
                          }

                         
                                   ?>
                          <br>
                          <p>Wife's Interests:</p>
                                  
                          <ul>
                                  <?php $wifebirthday_interests = get_user_meta($current_user->ID, $key = 'wife-birthday-interests', $single = false); 
                                  if ( isset($wifebirthday_interests[0])) {
                                  foreach ($wifebirthday_interests[0] as $key => $value) { ?>
                                  <li><i class="fa fa-gift" aria-hidden="true"></i>&nbsp;<?php echo $value; ?>&nbsp;&nbsp;<a class="interests-amazon-button" href="<?php echo get_permalink() . '?amazon-search=' . $value;?>">Buy on <i class='fa fa-amazon' aria-hidden='true'></i></a>&nbsp;&nbsp;<a href="<?php echo get_permalink().'?wife-birthday-interests=' . $value; ?>" class="trash-can"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                 <?php }
                                  } else { 
                                      echo '<p>No Interests Recorded</p>';
                                  }
                                   ?>
                         </ul>
                         <br>
                         <p>Add Interests: <input type="text" id="wife-birthday-interests"  name="wife-birthday-interests" ></p>
                           
                        </p><!-- .form-email -->
                      </div>
                      <br>
                      <p class="form-email">
                              <p>Additional birthdays to remember: <input type="number" id="birthdays-to-remember" name="birthdays-to-remember"  value="<?php echo $birthdays_to_remember; ?>"></p>
                           
                     
                      <div style="width:80%; margin:auto">
                        <?php 
                            if (!empty($birthdays_to_remember)) {

                              for ($i=1; $i < $birthdays_to_remember +1 ; $i++) { 
                                $birthday_number_name = 'birthday-' . (string)$i . '-name';
                                $birthday_number_date = 'birthday-' . (string)$i . '-date';
                                $birthday_number_gender = 'birthday-' . (string)$i . '-gender';
                                $birthday_number_interests = 'birthday-' . (string)$i . '-interests';
                                $birthday_number_delete_interests = 'birthday-' . (string)$i . '-delete-interests';
                                $birthday_number = 'birthday-' . (string)$i . '-';
                            //used to additional birthday ideas items
                                if (isset($_GET[$birthday_number_delete_interests])) {
                                  $delete_interest =  esc_attr( $_GET[$birthday_number_delete_interests]);
                                  $interests = get_user_meta($current_user->ID, $birthday_number_interests, false); 
                                  
                                  $interests = $interests[0]; 
                                  $interests = array_diff($interests, array($delete_interest));
                                  update_user_meta( $current_user->ID, $birthday_number_interests, $interests);
                                }

                                ?>
                                  <br>
                                  <div class="birthday-addition-box">
                                <h3>
                                  <?php 
                                  $birthday_person_name = get_user_meta($current_user->ID, $key = $birthday_number_name, $single = true); 
                                  if(!$birthday_person_name == '') { echo $birthday_person_name . '\'s Birthday'; } else { echo ''; } 
                                  ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo get_permalink().'?delete-birthday=' . $birthday_number; ?>" class="trash-can"><i class="fa fa-trash" aria-hidden="true"></i></a></h3>
                                  <br>
                                <p class="form-email">

                                  <p>Name: <input type="text" id="<?php echo $birthday_number_name; ?>"  name="<?php echo $birthday_number_name; ?>"  value="<?php echo get_user_meta($current_user->ID, $key = $birthday_number_name, $single = true); ?>"></p>
                           
                                </p><!-- .form-email -->

                                <p class="form-email">

                                  <p>Birthday: <input type="date" id="<?php echo $birthday_number_date; ?>"  name="<?php echo $birthday_number_date; ?>"  value="<?php echo get_user_meta($current_user->ID, $key = $birthday_number_date, $single = true); ?>"></p>
                           
                                </p><!-- .form-email -->

                                <p class="form-email">

                                  <p>Gender: <input type="radio" name="<?php echo $birthday_number_gender; ?>" value="male" <?php if (get_user_meta($current_user->ID, $key = $birthday_number_gender, $single = true) == 'male') { echo 'checked'; } ?>> Male&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="<?php echo $birthday_number_gender; ?>" value="female" <?php if (get_user_meta($current_user->ID, $key = $birthday_number_gender, $single = true) == 'female') { echo 'checked'; } ?>> Female</p>
                           
                                </p><!-- .form-email -->

                                <p class="form-email">
                                 
                                  <h3>Interests:</h3>
                                  
                                  <ul>
                                  <?php $birthday_interests = get_user_meta($current_user->ID, $key = $birthday_number_interests, $single = false); 
                                  if (isset($birthday_interests[0])) {
                                    foreach ($birthday_interests[0] as $key => $value) { ?>
                                    <li><i class="fa fa-gift" aria-hidden="true"></i>&nbsp;<?php echo $value; ?>&nbsp;&nbsp;<a class="interests-amazon-button" href="<?php echo get_permalink() . '?amazon-search=' . $value;?>">Buy on <i class='fa fa-amazon' aria-hidden='true'></i></a><a href="<?php echo get_permalink().'?' . $birthday_number_delete_interests . '=' . $value; ?>" class="trash-can"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                 <?php }
                                  }
                                  
                                   ?>
                                   </ul>
                                   <br>
                                  <p>Add Interests: <input type="text" id="<?php echo $birthday_number_interests; ?>"  name="<?php echo $birthday_number_interests; ?>" ></p>
                           
                                </p><!-- .form-email -->
                             
                                </div>
                              <?php

                                }
                            }
                        ?>
                        
                      </div>
                      </div>
                    </div>
                  

                  <div class="accounts-valentines-day">
                      <h2>Valentines Day</h2>
                      
                        <?php 
                         

                      
                          //valentines day
                          $now = time(); // or your date as well
                          
                          $this_years_valentines = date("Y-m-d", strtotime("14 February"));
                          
                          //days until valentines
              
                          if ($now > strtotime($this_years_valentines)) {
                            $next_year_valentines = date("Y-m-d", strtotime(date("Y-m-d", strtotime($this_years_valentines)) . " + 1 year"));
                            
                            $your_date = strtotime($next_year_valentines);
                            $datediff = $your_date - $now;
                          
                            
                          } else{
                            
                            $your_date = strtotime($this_years_valentines);
                            $datediff = $your_date - $now;
                           
                          }
                          ?>
                          <p>Valentines Day is in <?php echo ceil($datediff / (60 * 60 * 24)); ?> days</p> 
                      

                    </div>
                    <br>
                    <div class="accounts-mothers-day">
                      <h2>Mothers Day</h2>
                      <?php 

                     if ($country == '') {
                       echo "<p>Please select your country</p>";
                     } else {
                       
                        //need to modify this for mothers day and make drop down to save persons country <?php echo date('d.m.Y', strtotime('third Sunday of May 2013'))

                          
                          $now = time(); // or your date as well
                          if ($country == 'USA' || $country == 'Canada' || $country == 'Australia' || $country == 'New-Zealand') 
                          {
                             $mothers_day = date('Y-m-d', strtotime('second Sunday of May 2017'));
                            
                             
                          } else {

                            $easter_date = date("Y-m-d",easter_date(2017));
                            $mothers_day = strtotime("$easter_date -20 days");
                            $mothers_day = date("Y-m-d", $mothers_day);
                            

                          }
                          
                          list($year, $month, $day) = explode('-', $mothers_day);
                          $this_years_mothers = date("Y") . "-" . $month . "-" .$day;

                         
                          
                          //days until mothers day
              
                          if ($now > strtotime($this_years_mothers)) {
                            $next_year_mothers = date("Y-m-d", strtotime(date("Y-m-d", strtotime($this_years_mothers)) . " + 365 day"));
                            
                            $your_date = strtotime($next_year_mothers);
                            $datediff = $your_date - $now;
                            
                          } else{
                            
                            $your_date = strtotime($this_years_mothers);
                            $datediff = $your_date - $now;
                           
                          }
                          ?>
                          <p>Mothers Day is in <?php echo ceil($datediff / (60 * 60 * 24)); ?> days</p> 
                          <?php } ?>

                         <p class="read-more-link">Expand <span class="fa fa-caret-down"></span></p>
                      <div class="read-more-content">
                      <p class="read-less-link">Collapse <span class="fa fa-caret-up"></span></p>
                      <br>
                        <p class="form-country"> Different countires celebrate Mothers Day on different dates.  To make sure we send you the correct reminders please make sure you select your country below <br><br>
                              <p>Where do you live: 
                                <select name="mothers-day-country">
                                  <option value=''>Please Select a Country</option>
                                  <option value="USA" <?php if ($country == 'USA') { echo "selected='selected'"; } ?> >USA</option>
                                  <option value="Canada" <?php if ($country == 'Canada') { echo "selected='selected'"; } ?>>Canada</option>
                                  <option value="UK" <?php if ($country == 'UK') { echo "selected='selected'"; } ?>>UK</option>
                                  <option value ="Australia" <?php if ($country == 'Australia') { echo "selected='selected'"; } ?>>Australia</option>
                                  <option value="New-Zealand" <?php if ($country == 'New-Zealand') { echo "selected='selected'"; } ?>>New Zealand</option>
                                </select>
                                </p>
                            </p>
                        </div>
                    </div>


                    <?php } ?>

                    </div><!--end tab 1-->
                  
                  
<?php // NEW CODE ENDS HERE ------------ NEW CODE ENDS HERE -------------NEW CODE ENDS HERE ?>  


 
              

  <div id="tabs-2">
        <h3>Edit Profile</h3></br>
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
                     <?php $user_birthday =  isset($all_meta_for_user['user-birthday'][0]) ? $all_meta_for_user['user-birthday'][0] : ''; ?>
                       <p class="form-email">
                            <p> <input type="date" id="user-birthday" name="user-birthday"  value="<?php  echo $user_birthday; ?>"></p>
                         
                    </p><!-- .form-email -->

                    </div>

      <br>
      <?php echo  do_shortcode('[pmpro_account]'); ?>

   </div>
    <!--end tab 2-->
  <div id="tabs-3">
    
     <br>
    <h2>Unlocked Tools</h2>
    <br>
      <?php echo  do_shortcode('[mycred_my_badges]'); ?>
      <br>
      <div class="available-tools">
        <br>
        
        <h2>Available Tools</h2>
        <br>
        <p><small>To find out how the get you next Man's PA tool hover or click on the badges below.</small><br><br><i class="fa fa-hand-o-down" aria-hidden="true"></i></p>
        <?php echo  do_shortcode('[mycred_badges]'); ?>
        <div class="next-badge-instructions">
           
          <?php
          //checks if the user has the badges by checking usermeta - must change this for the production site
          //as badge numbers (post_id for each badges) will be different
          if (!isset($all_meta_for_user['mycred_badge451'][0])) 
            { 
              echo "<p>Your next available tool is the<strong> Gift Boss Tool</strong>! <br><br> With this awesome tool you will never forget a Birthday, Valentines Day or Mothers Day again!</p><br><br> 
                <p>Click on the Facebook button below and once you have shared the link you will have access to the tool.</p>"; 
                // need to configure this with share link hook in points in dashboard - currently set to 50 points no badge
              $refferal_id = '?mref=' . do_shortcode('[mycred_affiliate_id]');
              $url = urlencode('https://themanpa.com' . $refferal_id); 
              $url = 'https://www.facebook.com/sharer/sharer.php?u=' . $url;

              echo  do_shortcode('[mycred_link href="' . $url . '"]<i class="fa fa-facebook" aria-hidden="true"></i>[/mycred_link]'); 
            } 
            else if (!isset($all_meta_for_user['mycred_badge1052'][0]))
            { 
              echo "<p>Your next available tool is the<strong> Flower Champion Tool</strong>!</p><br><br> 
                <p>This tool is not quite ready yet... but we will let you know when it's ready for use.</p>";
             }
          ?> 
         
          
        
          
        </div>
      </div>
      <div style="border-top: 1px #fff solid">
       <br>
       <h2>Activate/Deactivate tools</h2>
       <br>
        <h3>Anniversary Reminder Tool</h3>

        <p>This tool sends you email reminders leading up to your anniversary with awesome anniversary gift ideas.  The result - hassle free gift picking for anniversaries!</p>
        <br>
        <p class="form-email">
          <p>Activate Tool: <input type="checkbox" name="anniversary-tool" value="1" id="anniversary-tool" <?php if (isset($all_meta_for_user['anniversary-tool'][0]) && $all_meta_for_user['anniversary-tool'][0] == 1) { echo 'checked'; }  ?>></p>
                           
        </p><!-- .form-email -->

        <br>
    
       <br>
       <?php 
// NEW CODE ENDS HERE ------------ NEW CODE ENDS HERE -------------NEW CODE ENDS HERE                 

       if ($gift_tool_badge_earned) { ?>
        <h3>Gift Tool </h3>

        <p>This tool enables you to upload birthdays and it will send you reminders leading up to the birthdays plus gift ideas based on the interests you have specified for that person.</p>
        <br>
        <p class="form-email">
          <p>Activate Tool: <input type="checkbox" name="gift-tool" value="1" id="gift-tool" <?php if ($all_meta_for_user['gift-tool'][0] == 1) { echo 'checked'; }  ?>></p>
                           
        </p><!-- .form-email -->
    </div>
      <p>
       <?php }
 // NEW CODE ENDS HERE ------------ NEW CODE ENDS HERE -------------NEW CODE ENDS HERE                 



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
                        <?php //echo $referer; ?>
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