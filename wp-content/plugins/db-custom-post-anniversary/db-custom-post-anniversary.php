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
'taxonomies' => array( '' ),
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
}
}




?>