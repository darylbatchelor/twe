<?php

/**
 * Plugin Name: Send custom emails
 * Version: 1.0
 * Description: sends email reminders
 * Author: Daryl Batchelor
 * Author URI: http://batchelors.id.au
 * Plugin URI: 
 */

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


function wife_birthday_reminder_members($days){
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
			$subject = 'Your partners birthday is in ' . $days . ' days!';
			if ($days == '1') {
			$body = "Hey " . $allusers->display_name . "<br><br> Your wife's birthday is tomorrow!<br><br> I hope you have something.  If not duck away today and get her something... don't forget!";
			} else {
			$body = "Hey " . $allusers->display_name . "<br><br> Your wife's birthday is in " . $days . " days.<br><br> If you haven't already, now would be a good time to start to think about what to get her.;"
			}
			$headers = array('Content-Type: text/html; charset=UTF-8');
			 
			wp_mail( $to, $subject, $body, $headers ); 
			    //send email function goes here using details above function send_birthday_reminder($notice (14 - days))
		}
    }                         


}




?>