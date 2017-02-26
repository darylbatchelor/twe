<?php

/**
 * Generate User list Class
 *
 * @since 1.0
 */
if ( ! class_exists( 'DB_Tool_Users' ) ) {
class DB_Anniversary_Tool_Users 
	{

		public $db_all_users;
		public $db_non_users;
		public $db_30Day_users;


		public function getAllToolUsers($tool)
		{
			//arguments for query below
			$args = array(
				    'meta_query' => array(
				        array(
				            'key' => $tool . '-tool',
				            'value' => 1,
				            'compare' => '='
				           
				        ),


				    )
				);

			$this->db_all_users = get_users( $args );

			return $db_all_users;
		}

		public function getNonToolUsers($tool)
		{
			//arguments for query below
			$args = array(
				    'meta_query' => array(
				        array(
				            'key' => $tool . '-tool',
				            'value' => 0,
				            'compare' => '='
				           
				        ),


				    )
				);

			$this->db_non_users = get_users( $args );

			return $db_non_users;

		}

				public function showNonUsers($tool){

					if (!isset($this->db_non_users)) 

					{
						echo "you first need to get All non users with getNonUsers($tool) method";
					} 

					elseif (empty($this->db_non_users)) 
					{
						echo "There are no " . $tool . "-tool non users";
					}

					else 

					{

						foreach ($this->db_non_users as $users) 
						{

							//need to replace this with wp_mail function
							$reply = "<br><br>" . var_dump($users);
							
							echo $reply;
						}
			
						return $reply;

					}	

			
		}



		public function showUsers($tool){

			if (!isset($this->db_all_users)) 

					{
						echo "Cannot display tool users because you first need to get All users with getUsers($tool) method";
					} 

					elseif (empty($this->db_all_users)) {
						echo "Cannot display tool users because there are no tool users";
					}

					else 

					{
				foreach ($this->db_all_users as $users) 

				{

					//need to replace this with wp_mail function
					$reply = "<br><br>" . var_dump($users);
				
					echo $reply;
					}

				}
			return $reply;

			
		}


		public function sendEmailToUsers($subject, $body){

			if (!isset($this->db_all_users)) 

					{
						echo "Cannot Send Email to all tool users because you first need to get All users with getUsers($tool) method";
					} 

					elseif (empty($this->db_all_users)) {
						echo "Cannot Send Email to all tool users because  there are no tool users";
					}

					else 

					{

						foreach ($this->db_all_users as $users) 
						{

							//need to replace this with wp_mail function
							$reply = "<br>To: " . $users->user_email . "<br>";
							$reply .= "subject: " . $subject . "<br>";
							$reply .= "body: Hi " . $users->user_nicename . ",<br>" . $body . "<br><br>";
							echo $reply;
						}
			
					}

		}

		public function sendEmailToNonUsers($subject, $body){

					if (!isset($this->db_non_users)) 

					{
						echo "<br>Cannot send email to non tool users because you first need to get All non users with getNonUsers($tool) method<br>";
					} 

					elseif (empty($this->db_non_users)) {
						echo "<br>Cannot send email to non tool users because there are no tool non users<br>";
					}

					else 

					{

						foreach ($this->db_non_users as $users) 
						{

							//need to replace this with wp_mail function
							$reply = "<br>To: " . $users->user_email . "<br>";
							$reply .= "subject: " . $subject . "<br>";
							$reply .= "body: Hi " . $users->user_nicename . ",<br>" . $body . "<br><br>";
							echo $reply;
						}
					}

		}

		
		

	} // DB_Users class end
} //if exists