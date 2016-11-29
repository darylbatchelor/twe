<?php 

function generate_random_dates(){

//need to set up cron job to run this once a year

$date = date('Y-m-d');
                                                
//split up date into $day and $month
list($year, $month, $day) = split('[-]', $date);

//using random date generator api found here: https://api.lrs.org/docs/random-date-generator

//get random dates for current year&1 per month& excluding sat and sun& & return 12 dates
$url = "https://api.lrs.org/random-date-generator?year=" . $year . "&lim_months=1&exclude[]=6&exclude[]=7&num_dates=12";
$resp = file_get_contents($url);
$dates = json_decode($resp);
 
$dates = get_object_vars($dates->data);
$yearly_random_dates = array();

 foreach ($dates as $date) {
     
      $random_day_of_month =  $date->db;
      
      //save dates to wp_options table
      //update_option( 'flowerday_' . $i . '_date', $random_day_of_month );
      //update_option( 'flowerday_' . $i . '_long', $long_date );
     
     array_push($yearly_random_dates, $random_day_of_month);
 }
 
 update_option( 'yearly_random_dates', $yearly_random_dates );

}

//generate_random_dates();

?>