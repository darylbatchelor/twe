<?php
/*
* Plugin Name: google test ShortCode
* Description: test google cal
* Version: 1.0
* Author: DB
* Author URI: https://batchelors.id.au
*/


function Oauth_connect(){


if(isset($_POST['btn']) || isset($_GET['code']) ) 



{ 
define( 'CD_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once( CD_PLUGIN_PATH . '/google-api-php-client/vendor/autoload.php');



define('APPLICATION_NAME', 'thewifeenigma');

define('CLIENT_SECRET_PATH', plugin_dir_path( __FILE__ ) . '/client_secret_661603566580-97cnesi4uh4fqp15f2vs1mdasph85uks.apps.googleusercontent.com.json');
// If modifying these scopes, delete your previously saved credentials
// at ~/.credentials/calendar-php-quickstart.json
define('SCOPES', implode(' ', array(
  Google_Service_Calendar::CALENDAR_READONLY)
));


/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient() {
  $client = new Google_Client();
  
  $client->setAuthConfig(CLIENT_SECRET_PATH);
  $client->setScopes(SCOPES);


 

  if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);
} else {
    // Request authorization from the user.
    $authUrl = $client->createAuthUrl();
    echo "<a href='" . $authUrl . "'>You are not logged in... Click here to log in</a>";
   


   
  }

return;

//Save token in session
if ($client->getAccessToken()) {
  $_SESSION['token'] = $client->getAccessToken();
}


  // Refresh the token if it's expired.
  if ($client->isAccessTokenExpired()) {
    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
  }
  return $client;
}

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$optParams = array(
  'maxResults' => 10,
  'orderBy' => 'startTime',
  'singleEvents' => TRUE,
  'timeMin' => date('c'),
);
$results = $service->events->listEvents($calendarId, $optParams);

if (count($results->getItems()) == 0) {
  print "No upcoming events found.\n";
} else {
  print "Upcoming events:\n";
  foreach ($results->getItems() as $event) {
    $start = $event->start->dateTime;
    if (empty($start)) {
      $start = $event->start->date;
    }
    printf("%s (%s)\n", $event->getSummary(), $start);
  }
}

}

?>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="submit" value="test" name="btn"><br>
</form>
<?php
}
add_shortcode('db_test', 'Oauth_connect');
?>