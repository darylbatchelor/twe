<?php

/*

Use this for Mailgun
require PLUGIN_DIR . 'vendor/autoload.php';
use Mailgun\Mailgun;
*/

/**
 * Generate Emailer  Class
 *
 * @since 1.0
 */
if ( ! class_exists( 'DB_Emailer' ) ) {

class DB_Emailer 

	{



		public function sendAnniversaryReminderEmail($days)
		{

			global $current_user;


			// Get current date
			$date = date('Y-m-d');

			                          
			//get all birthdays 2 weeks from now
			$date = date('Y-m-d', strtotime($date . ' + ' . $days . ' days'));
			                 
			//split up date into $day and $month
			list($year, $month, $day) = split('[-]', $date);

		
			//arguments for query below
			$args = array(
				    'meta_query' => array(
				        array(
				            'key' => 'anniversary-tool',
				            'value' => 1,
				            'compare' => '='
				           
				        ),

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


				    )
				);



			//query database for user obj array and get all users who have a wife with a birthday 2 weeks away
			$allusers = get_users( $args);

			
	if (!empty($allusers)) {
         foreach ($allusers as $allusers) 
         {
	      //need to look up anniversary year to figure out what anniversary it is
	       $user_id = $allusers->ID;
	       $key = 'anniversary-year';
	       $single = true;
	       $anniversary_year = get_user_meta( $user_id, $key, $single );
	       $anniversary = intval($year) - intval($anniversary_year);
	      
	     //once year is established need to look up gift ideas in custom post

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
			
			$product1_asin = $postmeta_array['product1_asin'][0];
			$product1_qty = $postmeta_array['product1_qty'][0];
			$product2_asin = $postmeta_array['product2_asin'][0];
			$product2_qty = $postmeta_array['product2_qty'][0];
			$product3_asin = $postmeta_array['product3_asin'][0];
			$product3_qty = $postmeta_array['product3_qty'][0];
			$product4_asin = $postmeta_array['product4_asin'][0];
			$product4_qty = $postmeta_array['product4_qty'][0];
			$product5_asin = $postmeta_array['product5_asin'][0];
			$product5_qty = $postmeta_array['product5_qty'][0];
			$product6_asin = $postmeta_array['product6_asin'][0];
			$product6_qty = $postmeta_array['product6_qty'][0];

			$affiliate_link = 'http://www.amazon.com/gp/aws/cart/add.html?AssociateTag=themanpa-20&SubscriptionId=AKIAJ6DSNTLJGPWCDHXQ&ASIN.1=' . $product1_asin . '&Quantity.1=' . $product1_qty . '&ASIN.2=' . $product2_asin . '&Quantity.2=' . $product2_qty . '&ASIN.3=' . $product3_asin . '&Quantity.3=' . $product3_qty . '&ASIN.4=' . $product4_asin . '&Quantity.4=' . $product4_qty . '&ASIN.5=' . $product5_asin . '&Quantity.5=' . $product5_qty . '&ASIN.6=' . $product6_asin . '&Quantity.6=' . $product6_qty;

			      //mail info
			$to = $allusers->user_email;


			
			switch ($days) {
				case '1':
					//fetch 1 day template
					require_once( TEMP_DIR . 'anniversary-reminder-one-day.php'); 
					break;
				
				case '7':
					//fetch 7 day template
					require_once( TEMP_DIR . 'anniversary-reminder-seven-day.php');
					break;

				case '14':
					//fetch 14 day template
					require_once( TEMP_DIR . 'anniversary-reminder-fourteen-day.php');
					break;

				case '21':
					//fetch 21 day template
					require_once( TEMP_DIR . 'anniversary-reminder-twenty-one-day.php');
					break;

				case '30':
					//fetch 30 day template
					require_once( TEMP_DIR . 'anniversary-reminder-thirty-day.php');
					
					break;
			}

			

/*
			# Instantiate the client.
			$mgClient = new Mailgun('key-514832fab5299f35a4af7e1a9eb87ca4');
			$domain = "sandbox2e7148a7091e4ad7b2ccf71b1237a0ed.mailgun.org";

			# Make the call to the client.
			$result = $mgClient->sendMessage($domain, array(
			    'from'    => 'Excited User <mailgun@themanpa.com>',
			    'to'      => $to,
			    'subject' => $subject,
			    'text'    => $body
			));
  
*/

              wp_mail( $to, $subject, $body, $headers ); 
                   //send email function goes here using details above function send_birthday_reminder($notice (14 - days))
          }
    }    

		}

	public function sendWifeBirthdayReminderEmail($days)
		{

			


			// Get current date
			$date = date('Y-m-d');

			                          
			//get all birthdays 2 weeks from now
			$date = date('Y-m-d', strtotime($date . ' + ' . $days . ' days'));
			                 
			//split up date into $day and $month
			list($year, $month, $day) = explode('-', $date);

		
			//arguments for query below
			$args = array(
				    'meta_query' => array(
				        array(
				            'key' => 'gift-tool',
				            'value' => 1,
				            'compare' => '='
				           
				        ),

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

	if (!empty($allusers) ) {
         foreach ($allusers as $allusers) 
         {
	      
	     $wife_birthday_year = get_user_meta($allusers->ID, $key='wife-birthday-year', $single = true);
            //wife age
            $wife_age = date("Y") - date(("Y"), strtotime($wife_birthday_year));
                  
         	
			
         	$wifebirthday_interests = get_user_meta($allusers->ID, $key = 'wife-birthday-interests', $single = false); 


			//mail info
			$to = $allusers->user_email;


			
		
			require_once( plugin_dir_path( __FILE__ ) . 'templates/wife-birthday-email-template.php'); 


			

/*
			# Instantiate the client.
			$mgClient = new Mailgun('key-514832fab5299f35a4af7e1a9eb87ca4');
			$domain = "sandbox2e7148a7091e4ad7b2ccf71b1237a0ed.mailgun.org";

			# Make the call to the client.
			$result = $mgClient->sendMessage($domain, array(
			    'from'    => 'Excited User <mailgun@themanpa.com>',
			    'to'      => $to,
			    'subject' => $subject,
			    'text'    => $body
			));
  
*/
				
            
				//echo $to . "<br><br>" . $subject . "<br><br>" . $body . "<br><br>";
				//print_r($headers);
              wp_mail( $to, $subject, $body, $headers ); 
                   //send email function goes here using details above function send_birthday_reminder($notice (14 - days))
          }
    }  

		}

		public function sendOtherBirthdayEmails($days)
		{
			// query database to get all birthdays
			global $wpdb;
			$query = "SELECT * FROM `wp_usermeta` WHERE `meta_key` LIKE 'birthday-%' ORDER BY `umeta_id` DESC";
			
			 $all_birthday_data = $wpdb->get_results( $query, ARRAY_A );  
			
			 

			$date = date("Y-m-d");

			                        
			//get all birthdays 2 weeks from now
			$date = date('Y-m-d', strtotime($date . ' + ' . $days . ' days'));
			               
			
			$other_birthdays = array();
			$other_birthday_matching_date = array();
			$other_birthday_matches = array();

			//find all user_meta with value as birthday#-date
			 foreach ($all_birthday_data as $key => $user_meta) {
			 	
			 	$input = preg_quote('-date', '~'); // don't forget to quote input string!

				$result = preg_grep('~' . $input . '~', $user_meta);
				if (!empty($result)) {
					array_push($other_birthdays, $user_meta);
				}

			 }

			 //find all user_meta with matching date reminder
			 foreach ($other_birthdays as $key => $user_meta) {
			 	
			 	
			 	list($year, $month, $day) = explode('-', $user_meta['meta_value']);
			 	$birthday_this_year = date("Y") . "-" . $month . "-" . $day;
			 
			 	
			 	if ($birthday_this_year == $date) 
				 {
				 
				   array_push($other_birthday_matching_date, $user_meta);
				 }
			 }

			 //find all corresponding user_meta to matching date user_meta save as matching birthday
			 foreach ($other_birthday_matching_date as $key => $user_meta) {
			 	$search = str_replace("-date", "", $user_meta['meta_key']);
			 	
			 	$inner_array = array();

			 	 

			 	foreach ($all_birthday_data as $key => $all_user_meta) {
			 		
			 		
					$input1 = preg_quote($search, '~'); 
					$input2 = preg_quote($user_meta['user_id'], '~');
					//add user_id to array
					if (empty($inner_array) )
					{
						$inner_array['user_id'] = $user_meta['user_id'];
						
					}
					$result1 = preg_grep('~' . $input1 . '~', $all_user_meta);
					$result2 = preg_grep('~' . $input2 . '~', $all_user_meta);
					
					//add rest of info to array
					if (!empty($result1) && !empty($result2)) {
						
						//clean up keys i.e make birthday-1-name = name
						list($birthday, $number, $new_key) = explode('-', $all_user_meta['meta_key']);
						$inner_key = $new_key;
						$inner_array[$inner_key] = $all_user_meta['meta_value'];
						
						
					}
					


			 	}

			 	array_push($other_birthday_matches, $inner_array);

			 }

// add suffix to number function
			 	function addOrdinalNumberSuffix($num) {
				    if (!in_array(($num % 100),array(11,12,13))){
				      switch ($num % 10) {
				        // Handle 1st, 2nd, 3rd
				        case 1:  return $num.'st';
				        case 2:  return $num.'nd';
				        case 3:  return $num.'rd';
				      }
				    }
				    return $num.'th';
				  }


				 //send email to user
			 foreach ($other_birthday_matches as $key => $user_details) {

			 	//get email from database by using user_id
			 	$user_info = get_userdata($user_details['user_id']);

			 	$to = $user_info->user_email;

			 	$user_name = $user_info->display_name;

			 	$birthday_person_name = $user_details['name'];

			 	$birthday_person_gender = $user_details['gender'];
			 	
			 	//get birthday person age
			 	$this_year = date("Y-m-d");
			 	$date1=date_create($user_details['date']);
				$date2=date_create(date("Y-m-d", strtotime($this_year . " + " . $days . " days")));
				$diff=date_diff($date1,$date2);
			 	$birthday_person_age = $diff->format("%y");
			 	
			 	

				  $birthday_number_suffix = addOrdinalNumberSuffix($birthday_person_age);

			 	//get interests
			 	$interests = unserialize($user_details['interests']);
			 	
			 				 	

			 	//email template

						require( plugin_dir_path( __FILE__ ) . 'templates/other-birthday-reminder-email.php'); 

			 		
			    wp_mail( $to, $subject, $body, $headers ); 
     			
			 } 
			 
			
		}

		public function sendValentinesEmail($days)
		{



			
	         //valentines day
	       
	                         
	         $current_date = date("Y-m-d");

	        $this_years_valentines = date("Y-m-d", strtotime('14 February'));
				                          
				//get all birthdays 2 weeks from now
			$days_valentines = date('Y-m-d', strtotime($this_years_valentines . ' - ' . $days . ' days'));
				echo $current_date . "     - ----   " . $days_valentines;   
			if ($current_date == $days_valentines) 
			{
				
							//arguments for query below
				$args = array(
					    'meta_query' => array(
					        array(
					            'key' => 'gift-tool',
					            'value' => 1,
					            'compare' => '='
					           
					        )


					    )
					);



					//query database for user obj array and get all users who have a wife with a birthday 2 weeks away
					$allusers = get_users( $args);

				if (!empty($allusers) ) 
				{
			         foreach ($allusers as $allusers) 
			         {
				     

						//mail info
						$to = $allusers->user_email;


						
					
						require_once( plugin_dir_path( __FILE__ ) . 'templates/valentines-day-reminder-email.php'); 


						

			/*
						# Instantiate the client.
						$mgClient = new Mailgun('key-514832fab5299f35a4af7e1a9eb87ca4');
						$domain = "sandbox2e7148a7091e4ad7b2ccf71b1237a0ed.mailgun.org";

						# Make the call to the client.
						$result = $mgClient->sendMessage($domain, array(
						    'from'    => 'Excited User <mailgun@themanpa.com>',
						    'to'      => $to,
						    'subject' => $subject,
						    'text'    => $body
						));
			  
			*/
							
			            
							//echo $to . "<br><br>" . $subject . "<br><br>" . $body . "<br><br>";
							//print_r($headers);
			              wp_mail( $to, $subject, $body, $headers ); 
			                   //send email function goes here using details above function send_birthday_reminder($notice (14 - days))
			          }
			    }  

			}          
		
		


		}

		public function sendMothersDayEmail($days)
		{
        //UK Mothers Day
	       	                         
	        $current_date = date("Y-m-d");

	        $easter_date = date("Y-m-d",easter_date(2017));
            $uk_mothers_day = strtotime("$easter_date -20 days");
            $uk_mothers_day = date("Y-m-d", $uk_mothers_day);
			 list($year, $month, $day) = explode('-', $uk_mothers_day);
             $this_years_uk_mothers_day = date("Y") . "-" . $month . "-" .$day;	  

				//get all birthdays 2 weeks from now
			$uk_mothers_day = date('Y-m-d', strtotime($this_years_uk_mothers_day . ' - ' . $days . ' days'));
				
			if ($current_date == $uk_mothers_day) 
			{
				

							//arguments for query below
				$args = array(
					    'meta_query' => array(
					        array(
					            'key' => 'gift-tool',
					            'value' => 1,
					            'compare' => '='
					           
					        ),

					       
					        array(
					            'key' => 'country',
					            'value' => 'UK',
					            'compare' => '='
					           
					        )


					    )
					);



					//query database for user obj array and get all users who have a wife with a birthday 2 weeks away
					$allusers = get_users( $args);

				if (!empty($allusers) ) 
				{
			         foreach ($allusers as $allusers) 
			         {
				     

						//mail info
						$to = $allusers->user_email;


						
					
						require_once( plugin_dir_path( __FILE__ ) . 'templates/mothers-day-reminder-email.php'); 


						

			/*
						# Instantiate the client.
						$mgClient = new Mailgun('key-514832fab5299f35a4af7e1a9eb87ca4');
						$domain = "sandbox2e7148a7091e4ad7b2ccf71b1237a0ed.mailgun.org";

						# Make the call to the client.
						$result = $mgClient->sendMessage($domain, array(
						    'from'    => 'Excited User <mailgun@themanpa.com>',
						    'to'      => $to,
						    'subject' => $subject,
						    'text'    => $body
						));
			  
			*/
							
			            
							//echo $to . "<br><br>" . $subject . "<br><br>" . $body . "<br><br>";
							//print_r($headers);
			              wp_mail( $to, $subject, $body, $headers ); 
			                   //send email function goes here using details above function send_birthday_reminder($notice (14 - days))
			          }
			    }  

			} //end UK mothers day if statement         

			$mothers_day = date('Y-m-d', strtotime('second Sunday of May 2017'));
			
			 list($year, $month, $day) = explode('-', $mothers_day);
             $this_years_mothers_day = date("Y") . "-" . $month . "-" .$day;	  

				//get all birthdays 2 weeks from now
			$mothers_day = date('Y-m-d', strtotime($this_years_mothers_day . ' - ' . $days . ' days'));
				
			if ($current_date == $mothers_day) 
			{
			

							//arguments for query below
				$args = array(
					    'meta_query' => array(
					    	'relation' => 'OR',
					        					        	
					        array(
					            'key' => 'country',
					            'value' => 'USA',
					            'compare' => '='
					           
					        ),
					        array(
					            'key' => 'country',
					            'value' => 'Australia',
					            'compare' => '='
					           
					        ),
		      
					        array(
					            'key' => 'country',
					            'value' => 'Canada',
					            'compare' => '='
					           
					        ),

					        array(
					            'key' => 'country',
					            'value' => 'New-Zealand',
					            'compare' => '='
					           
					        )

					    )
					);



					//query database for user obj array and get all users who have a wife with a birthday 2 weeks away
					$allusers = get_users( $args);

				if (!empty($allusers) ) 
				{
			         foreach ($allusers as $allusers) 
			         {
				     

						//mail info
						$to = $allusers->user_email;


						
					
						require_once( plugin_dir_path( __FILE__ ) . 'templates/mothers-day-reminder-email.php'); 


						

			/*
						# Instantiate the client.
						$mgClient = new Mailgun('key-514832fab5299f35a4af7e1a9eb87ca4');
						$domain = "sandbox2e7148a7091e4ad7b2ccf71b1237a0ed.mailgun.org";

						# Make the call to the client.
						$result = $mgClient->sendMessage($domain, array(
						    'from'    => 'Excited User <mailgun@themanpa.com>',
						    'to'      => $to,
						    'subject' => $subject,
						    'text'    => $body
						));
			  
			*/
							
			            
							//echo $to . "<br><br>" . $subject . "<br><br>" . $body . "<br><br>";
							
			              wp_mail( $to, $subject, $body, $headers ); 
			                   //send email function goes here using details above function send_birthday_reminder($notice (14 - days))
			          }
			    }  

			} //end UK mothers day if statement
		
		


		}


	}//DB_Emailer
}//if exists