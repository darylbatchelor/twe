<?php 
/**
 * Plugin Name: DB Amazon Product Advertising
 * Version: 1.0
 * Description: Implements the Amazon Product Advertising API for the Gift Boss Tool
 * Author: Daryl Batchelor
 * Author URI: http://batchelors.id.au
 * Plugin URI: 
 */



function db_create_amazon_shortcode(){

if (isset($_GET['amazon-search']) && !empty($_GET['amazon-search'])) {

$Keywords = esc_attr($_GET['amazon-search']);
if (isset($_GET['amazon-search-index'])) { 
$SearchIndex = esc_attr($_GET['amazon-search-index']);
} else {
$SearchIndex = "All";
}


// Your AWS Access Key ID, as taken from the AWS Your Account page
$aws_access_key_id = "";

// Your AWS Secret Key corresponding to the above ID, as taken from the AWS Your Account page
$aws_secret_key = "";


// The region you are interested in
$endpoint = "webservices.amazon.com";

$uri = "/onca/xml";

$params = array(
    "Service" => "AWSECommerceService",
    "Operation" => "ItemSearch",
    "AWSAccessKeyId" => "",
    "AssociateTag" => "themanpa-20",
    "SearchIndex" => $SearchIndex,
    "Keywords" => $Keywords,
    "Condition" => "New",
    "ItemPage" => "1",
    "ResponseGroup" => "Images,ItemAttributes,Offers"

);

// Set current timestamp if not set
if (!isset($params["Timestamp"])) {
    $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
}

// Sort the parameters by key
ksort($params);

$pairs = array();

foreach ($params as $key => $value) {
    array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
}

// Generate the canonical query
$canonical_query_string = join("&", $pairs);

// Generate the string to be signed
$string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;

// Generate the signature required by the Product Advertising API
$signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));

// Generate the signed URL
$request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);


//Catch the response in the $response object
$xml = new SimpleXMLElement($request_url, 0, TRUE);

?>
<script type="text/javascript">
jQuery( document ).ready(function() {
	jQuery('.popup .close').on( "click", function() {
		jQuery('.overlay').css({"visibility": "hidden", "opacity": "0", "display" : "none"});
		jQuery('section.header-site').css("display","block");
		jQuery('#footer').css("display","block");
		jQuery('.wrapper-site').css("max-height","");
	});
});
</script>
<style type="text/css">

section.header-site{
	display: none;
}
#footer{
	display: none;
}
.wrapper-site{
	max-height: 68%;
}

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: visible;
  opacity: 1;
}


.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 80%;
  height: 80%;
  display: block;
  position: relative;
  transition: all 5s ease-in-out;
  overflow: hidden;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 0px;
  right: 20px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #c3d687;
  cursor: pointer;
}
.popup .content {
  max-height: 95%;
  overflow: auto;
}



#amazon-search-form {
	color: #000;
	text-align: left;
	padding: 10px;
    border-bottom: 1px solid gray;
}

.amazon-search-input{
	display: inline-block;
}


#amazon-search-form input[type=text], select{
width: 60%;
}



.item{
	position: relative;
	width: 20%;
	color:#000;
	display: inline-block;
	box-shadow: 0 0 5px;
	margin: 10px;
	padding: 5px;
	min-height: 254px;
	border-radius: 5px;
	background-color: #f4f4f4;
	vertical-align: top;
	text-align: center;
}
.item h5{
	color: #000;
	font-weight: bold;

}

.item img.amazon-small{
	margin: 5px;
	border-radius: 5px;
}

.item img.amazon-small:hover{
	cursor: pointer;
}

img.amazon-small:hover + img.amazon-large{
	display: block;
	cursor: zoom-in;
}

.item img.amazon-large:hover{
	display: block;
	cursor:zoom-in;
}

.item img.amazon-large{
	display: none;
	position: absolute;
	top: 34px;
    left: 0;
    z-index: 1000;
    border-radius: 5px;
    box-shadow: 0 0 5px;
}

.item a.buy-on-amazon{

    display: inline-block;
    border-radius: 5px;
    background-color: #454545;
    max-width: 80%;
    padding: 5px;
    transition: all 200ms;
}

.item a.buy-on-amazon:hover{
	color: #fff;
	background-color: #5e5544;
}



@media screen and (max-width: 900px){
  .amazon-search-input{
    width: 100%;
    margin: 5px;
  }

#amazon-search-form input[type=text], select{
width: 100%;
}

 #amaxon-search-form input[type=submit]{
	margin: 5px;
	display: block;
}

}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }

  .item{
	width: 33%;
}
}

@media screen and (max-width: 600px){
  .item{
	width: 40%;
}
}

</style>


	
<div id="popup1" class="overlay">
	<div class="popup">
		<form method="get" id="amazon-search-form" action="<?php the_permalink(); ?>">
			<div class="amazon-search-input">
				Change Search: <input type="text" name="amazon-search" id="amazon-search" value="<?php echo $Keywords; ?>"/>
			</div>
			<div class="amazon-search-input">
				Category: <select id="searchform_category" name="amazon-search-index"/>
					<option value="All">All</option>
					<option value="Books">Books</option>
					<option value="DVD">DVD</option>
					<option value="Apparel">Apparel</option>
					<option value="Automotive">Automotive</option>
					<option value="Electronics">Electronics</option><option value="GourmetFood">GourmetFood</option>
					<option value="Kitchen">Kitchen</option>
					<option value="Music">Music</option>
					<option value="PCHardware">PCHardware</option>
					<option value="PetSupplies">PetSupplies</option>
					<option value="Software">Software</option>
					<option value="SoftwareVideoGames">SoftwareVideoGames</option>
					<option value="SportingGoods">SportingGoods</option>
					<option value="Tools">Tools</option>
					<option value="Toys">Toys</option>
					<option value="VHS">VHS</option>
					<option value="VideoGames">VideoGames</option>
					<option value="UnboxVideo">Video on Demand</option>
				</select>
			</div>
			<input type="submit" value="Search">
		</form>
		
		<p class="close">&times;</p>
		<div class="content">
  
  
<?php  foreach($xml->Items->Item as $current){
	echo '<div class="item"><h5>' . $current->ItemAttributes->Title . '</h5>';
	echo "<img class='amazon-small' src='" . $current->SmallImage->URL . "'/>";
	echo "<img class='amazon-large' src='" . $current->LargeImage->URL . "'/>";
    if (isset($current->Offers->Offer->OfferListing->Price->FormattedPrice)){
    print("<p>Price:
    ".$current->Offers->Offer->OfferListing->Price->FormattedPrice) . "<p>";
  }else{
  print("<p>Unavailable :(</p>");
   }
   echo "<br><a class='buy-on-amazon' href='" .$current->DetailPageURL . "' target='_blank'>Buy on <i class='fa fa-amazon' aria-hidden='true'></i></a>";
   echo '</div>';
  }

 ?> 
 			<div class="item">
 				<h5>Can't find anything you like?</h5><br>
 				<a class='buy-on-amazon' href='<?php echo $xml->Items->MoreSearchResultsUrl; ?>' target='_blank'>Click here to find more results on Amazon</a>
 			</div>

		</div>
	</div>
</div>

 <?php

}


}

add_shortcode('test_amazon', 'db_create_amazon_shortcode');


