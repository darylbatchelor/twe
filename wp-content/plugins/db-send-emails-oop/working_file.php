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

//wife_birthday_reminder_email('14');


?>