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

			define( 'SEND_EMAIL_PLUGIN_DIR_INC', plugin_dir_path( __FILE__ ) );
			define('TEMP_DIR', SEND_EMAIL_PLUGIN_DIR_INC . 'templates/');
			define('IMG_DIR',SEND_EMAIL_PLUGIN_DIR_INC . 'images/');

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


	}//DB_Emailer
}//if exists