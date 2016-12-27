<?php 
/**
 * Plugin Name: DB add custom anniversary post
 * Version: 1.0
 * Description: Adds anniversary post type
 * Author: Daryl Batchelor
 * Author URI: http://batchelors.id.au
 * Plugin URI: 
 */

add_action( 'init', 'db_anniversary_post_type' );

function db_anniversary_post_type() {
register_post_type( 'anniversary_years',
array(
'labels' => array(
'name' => 'Anniversary Year',
'singular_name' => 'Anniversary Year',
'add_new' => 'Add New',
'add_new_item' => 'Add New Anniversary Year',
'edit' => 'Edit',
'edit_item' => 'Edit Anniversary Year',
'new_item' => 'New Anniversary Year',
'view' => 'View',
'view_item' => 'View Anniversary Year',
'search_items' => 'Search Anniversary Years',
'not_found' => 'No Anniversary Years found',
'not_found_in_trash' =>
'No Anniversary Years found in Trash',
'parent' => 'Parent Anniversary Year'
),
'public' => true,
'menu_position' => 20,
'supports' =>
array( 'title', 'comments',
'thumbnail' ),
'taxonomies' => array( 'category' ),
'menu_icon' =>
plugins_url( 'heart-icon.png', __FILE__ ),
'has_archive' => true
)
);
}


add_action( 'admin_init', 'db_anniversary_admin_init' );

function db_anniversary_admin_init() {
add_meta_box( 'db_anniversary_details_meta_box',
'Anniversary Details',
'db_display_anniversary_details_meta_box',
'anniversary_years', 'normal', 'high' );
}

function db_display_anniversary_details_meta_box( $anniversary_year ) {
// Retrieve current author and rating based on review ID
$year =
intval( get_post_meta( $anniversary_year->ID,
'year', true ) );
$modern_gift =
esc_html( get_post_meta( $anniversary_year->ID,
'modern_gift', true ) );
$traditional_gift_uk =
esc_html( get_post_meta( $anniversary_year->ID,
'traditional_gift_uk', true ) );
$traditional_gift_us =
esc_html( get_post_meta( $anniversary_year->ID,
'traditional_gift_us', true ) );
$gemstone =
esc_html( get_post_meta( $anniversary_year->ID,
'gemstone', true ) );
$color =
esc_html( get_post_meta( $anniversary_year->ID,
'color', true ) );
$ideas =
esc_html( get_post_meta( $anniversary_year->ID,
'ideas', true ) );
$product1_asin =
esc_html( get_post_meta( $anniversary_year->ID,
'product1_asin', true ) );
$product1_qty =
esc_html( get_post_meta( $anniversary_year->ID,
'product1_qty', true ) );
$product2_asin =
esc_html( get_post_meta( $anniversary_year->ID,
'product2_asin', true ) );
$product2_qty =
esc_html( get_post_meta( $anniversary_year->ID,
'product2_qty', true ) );
$product3_asin =
esc_html( get_post_meta( $anniversary_year->ID,
'product3_asin', true ) );
$product3_qty =
esc_html( get_post_meta( $anniversary_year->ID,
'product3_qty', true ) );
$product4_asin =
esc_html( get_post_meta( $anniversary_year->ID,
'product4_asin', true ) );
$product4_qty =
esc_html( get_post_meta( $anniversary_year->ID,
'product4_qty', true ) );
$product5_asin =
esc_html( get_post_meta( $anniversary_year->ID,
'product5_asin', true ) );
$product5_qty =
esc_html( get_post_meta( $anniversary_year->ID,
'product5_qty', true ) );
$product6_asin =
esc_html( get_post_meta( $anniversary_year->ID,
'product6_asin', true ) );
$product6_qty =
esc_html( get_post_meta( $anniversary_year->ID,
'product6_qty', true ) );
?>
<table>
	<tr>
		<td style="width: 100%">Year</td>
		<td><input type="text" size="10" name="anniversary_year" value="<?php echo $year; ?>" /></td>
	</tr>
	<tr>
		<td style="width: 100%">Modern Gift</td>
		<td><input type="text" size="80" name="anniversary_modern_gift" value="<?php echo $modern_gift; ?>" /></td>
	</tr>

	<tr>
		<td style="width: 100%">Traditional Gift (UK)</td>
		<td><input type="text" size="80" name="anniversary_traditional_gift_uk" value="<?php echo $traditional_gift_uk; ?>" /></td>
	</tr>

	<tr>
		<td style="width: 100%">Traditional Gift (US)</td>
		<td><input type="text" size="80" name="anniversary_traditional_gift_us" value="<?php echo $traditional_gift_us; ?>" /></td>
	</tr>

	<tr>
		<td style="width: 100%">Gemstone</td>
		<td><input type="text" size="80" name="anniversary_gemstone" value="<?php echo $gemstone; ?>" /></td>
	</tr>

	<tr>
		<td style="width: 100%">Color</td>
		<td><input type="text" size="80" name="anniversary_color" value="<?php echo $color; ?>" /></td>
	</tr>

	<tr>
		<td style="width: 100%">Anniversary Ideas</td>
		<td><textarea style="width: 100%" name="anniversary_ideas"><?php echo $ideas; ?></textarea> </td>
	</tr>
	<tr><td></td><td  style="width: 100%"><h3>Amazon Product Bundle</h3></td></tr>
	<tr>
		<td style="width: 100%">Product 1</td>
		<td>ASIN:<input type="text" size="80" name="product1_asin" value="<?php echo $product1_asin; ?>" /></td>
		<td>Qty:<input type="text" size="2" name="product1_qty" value="<?php echo $product1_qty; ?>" /></td>
	</tr>
	<tr>
		<td style="width: 100%">Product 2</td>
		<td>ASIN:<input type="text" size="80" name="product2_asin" value="<?php echo $product2_asin; ?>" /></td>
		<td>Qty:<input type="text" size="2" name="product2_qty" value="<?php echo $product2_qty; ?>" /></td>
	</tr>
	<tr>
		<td style="width: 100%">Product 3</td>
		<td>ASIN:<input type="text" size="80" name="product3_asin" value="<?php echo $product3_asin; ?>" /></td>
		<td>Qty:<input type="text" size="2" name="product3_qty" value="<?php echo $product3_qty; ?>" /></td>
	</tr>
	<tr>
		<td style="width: 80%">Product 4</td>
		<td>ASIN:<input type="text" size="80" name="product4_asin" value="<?php echo $product4_asin; ?>" /></td>
		<td>Qty:<input type="text" size="2" name="product4_qty" value="<?php echo $product4_qty; ?>" /></td>
	</tr>
	<tr>
		<td style="width: 80%">Product 5</td>
		<td>ASIN:<input type="text" size="80" name="product5_asin" value="<?php echo $product5_asin; ?>" /></td>
		<td>Qty:<input type="text" size="2" name="product5_qty" value="<?php echo $product5_qty; ?>" /></td>
	</tr>
	<tr>
		<td style="width: 80%">Product 6</td>
		<td>ASIN:<input type="text" size="80" name="product6_asin" value="<?php echo $product6_asin; ?>" /></td>
		<td>Qty:<input type="text" size="2" name="product6_qty" value="<?php echo $product6_qty; ?>" /></td>
	</tr>



</table>
<?php }

add_action( 'save_post',
'db_add_anniversary_detail_fields', 10, 2 );

function db_add_anniversary_detail_fields( $anniversary_year_id, $anniversary_year ) {
// Check post type for anniversary year
if ( $anniversary_year->post_type == 'anniversary_years' ) {
// Store data in post meta table if present in post data
if ( isset( $_POST['anniversary_year'] ) && $_POST['anniversary_year'] != '' ) {
update_post_meta( $anniversary_year_id, 'year', $_POST['anniversary_year'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['anniversary_modern_gift'] ) && $_POST['anniversary_modern_gift'] != '' ) {
update_post_meta( $anniversary_year_id, 'modern_gift', $_POST['anniversary_modern_gift'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['anniversary_traditional_gift_uk'] ) && $_POST['anniversary_traditional_gift_uk'] != '' ) {
update_post_meta( $anniversary_year_id, 'traditional_gift_uk', $_POST['anniversary_traditional_gift_uk'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['anniversary_traditional_gift_us'] ) && $_POST['anniversary_traditional_gift_us'] != '' ) {
update_post_meta( $anniversary_year_id, 'traditional_gift_us', $_POST['anniversary_traditional_gift_us'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['anniversary_gemstone'] ) && $_POST['anniversary_gemstone'] != '' ) {
update_post_meta( $anniversary_year_id, 'gemstone', $_POST['anniversary_gemstone'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['anniversary_color'] ) && $_POST['anniversary_color'] != '' ) {
update_post_meta( $anniversary_year_id, 'color', $_POST['anniversary_color'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['anniversary_ideas'] ) && $_POST['anniversary_ideas'] != '' ) {
update_post_meta( $anniversary_year_id, 'ideas', $_POST['anniversary_ideas'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['product1_asin'] ) && $_POST['product1_asin'] != '' ) {
update_post_meta( $anniversary_year_id, 'product1_asin', $_POST['product1_asin'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['product1_qty'] ) && $_POST['product1_qty'] != '' ) {
update_post_meta( $anniversary_year_id, 'product1_qty', $_POST['product1_qty'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['product2_asin'] ) && $_POST['product2_asin'] != '' ) {
update_post_meta( $anniversary_year_id, 'product2_asin', $_POST['product2_asin'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['product2_qty'] ) && $_POST['product2_qty'] != '' ) {
update_post_meta( $anniversary_year_id, 'product2_qty', $_POST['product2_qty'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['product3_asin'] ) && $_POST['product3_asin'] != '' ) {
update_post_meta( $anniversary_year_id, 'product3_asin', $_POST['product3_asin'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['product3_qty'] ) && $_POST['product3_qty'] != '' ) {
update_post_meta( $anniversary_year_id, 'product3_qty', $_POST['product3_qty'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['product4_asin'] ) && $_POST['product4_asin'] != '' ) {
update_post_meta( $anniversary_year_id, 'product4_asin', $_POST['product4_asin'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['product4_qty'] ) && $_POST['product4_qty'] != '' ) {
update_post_meta( $anniversary_year_id, 'product4_qty', $_POST['product4_qty'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['product5_asin'] ) && $_POST['product5_asin'] != '' ) {
update_post_meta( $anniversary_year_id, 'product5_asin', $_POST['product5_asin'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['product5_qty'] ) && $_POST['product5_qty'] != '' ) {
update_post_meta( $anniversary_year_id, 'product5_qty', $_POST['product5_qty'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['product6_asin'] ) && $_POST['product6_asin'] != '' ) {
update_post_meta( $anniversary_year_id, 'product6_asin', $_POST['product6_asin'] );
}
// Store data in post meta table if present in post data
if ( isset( $_POST['product6_qty'] ) && $_POST['product6_qty'] != '' ) {
update_post_meta( $anniversary_year_id, 'product6_qty', $_POST['product6_qty'] );
}

}
}

add_action('admin_menu', 'db_add_anniversary_dashboard');

function db_add_anniversary_dashboard(){
	add_submenu_page('edit.php?post_type=anniversary_years', 'Anniversary Dashboard', 'Anniversary Tally', 'edit_posts', 'anniversary-tool-dashboard', 'db_show_anniversary_dashboard');

}

function db_show_anniversary_dashboard(){ 


global $wpdb;
$users_with_anniversaries = $wpdb->get_results("SELECT * FROM `wp_usermeta` WHERE (`meta_key` LIKE 'anniversary')", ARRAY_A );
$current_year = date("Y");
$next_year = date('Y', strtotime($current_year . ' + 365 days'));
$anniversary_array = array();
	
	foreach ($users_with_anniversaries as $user) {
		$date = $user['meta_value'];
		list($year, $month, $day) = split('[-]', $date);
		$anniversary = (string)($current_year - $year);
		
		if (!array_key_exists($anniversary,$anniversary_array)){
			$anniversary_array[$anniversary] = $month;
			} else{
			$anniversary_array[$anniversary] .= ",".$month;
		}

	}




ksort($anniversary_array);
$final_anniversary_array = array();

foreach ($anniversary_array as $key => $value) {

	$split_months = split(",", $value);
	asort($split_months);
	$months_tally = array_count_values($split_months);
	$final_anniversary_array[$key . ' Year'] = $months_tally;
	
}

?>

<style>

	table {
    border-collapse: collapse;
    width: 90%;
}

table, th {
    border: 2px solid black;

}

th{
	font-weight: bold;
	width: 8.3%;
}

td{
	border: 1px solid black;
	height:50px;
	text-align: center;
}


</style>
<h3>Current Date: <?php $date_now = date('d-m-Y'); echo $date_now; ?></h3>
<br>
<h3>Anniversaries for <?php echo $current_year; ?></h3>

<table>
	<tr>
		<th>Anniversaries</th>
		<th>January</th>
		<th>February</th>
		<th>March</th>
		<th>April</th>
		<th>May</th>
		<th>June</th>
		<th>July</th>
		<th>August</th>
		<th>September</th>
		<th>October</th>
		<th>November</th>
		<th>December</th>
	
	</tr>
	<tr>
	<?php foreach ($final_anniversary_array as $key => $value) { ?>
		<td><?php echo $key; ?></td>
		<td><?php echo $value['01']; ?></td>
		<td><?php echo $value['02']; ?></td>
		<td><?php echo $value['03']; ?></td>
		<td><?php echo $value['04']; ?></td>
		<td><?php echo $value['05']; ?></td>
		<td><?php echo $value['06']; ?></td>
		<td><?php echo $value['07']; ?></td>
		<td><?php echo $value['08']; ?></td>
		<td><?php echo $value['09']; ?></td>
		<td><?php echo $value['10']; ?></td>
		<td><?php echo $value['11']; ?></td>
		<td><?php echo $value['12']; ?></td>
		
	</tr>

		<?php } ?>


</table>
<br><br>

<?php

$anniversary_array = array();
	
	foreach ($users_with_anniversaries as $user) {
		$date = $user['meta_value'];
		list($year, $month, $day) = split('[-]', $date);
		$anniversary = (string)($next_year - $year);
		
		if (!array_key_exists($anniversary,$anniversary_array)){
			$anniversary_array[$anniversary] = $month;
			} else{
			$anniversary_array[$anniversary] .= ",".$month;
		}

	}




ksort($anniversary_array);
$final_anniversary_array = array();

foreach ($anniversary_array as $key => $value) {

	$split_months = split(",", $value);
	asort($split_months);
	$months_tally = array_count_values($split_months);
	$final_anniversary_array[$key . ' Year'] = $months_tally;
	
} ?>

<h3>Anniversaries for <?php echo $next_year; ?></h3>

<table>
	<tr>
		<th>Anniversaries</th>
		<th>January</th>
		<th>February</th>
		<th>March</th>
		<th>April</th>
		<th>May</th>
		<th>June</th>
		<th>July</th>
		<th>August</th>
		<th>September</th>
		<th>October</th>
		<th>November</th>
		<th>December</th>
	
	</tr>
	<tr>
	<?php foreach ($final_anniversary_array as $key => $value) { ?>
		<td><?php echo $key; ?></td>
		<td><?php echo $value['01']; ?></td>
		<td><?php echo $value['02']; ?></td>
		<td><?php echo $value['03']; ?></td>
		<td><?php echo $value['04']; ?></td>
		<td><?php echo $value['05']; ?></td>
		<td><?php echo $value['06']; ?></td>
		<td><?php echo $value['07']; ?></td>
		<td><?php echo $value['08']; ?></td>
		<td><?php echo $value['09']; ?></td>
		<td><?php echo $value['10']; ?></td>
		<td><?php echo $value['11']; ?></td>
		<td><?php echo $value['12']; ?></td>
		
	</tr>

		<?php } ?>


</table>

<?php }




?>