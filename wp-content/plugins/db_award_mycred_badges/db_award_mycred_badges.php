<?php

/**
 * Plugin Name: DB mycred share this shortcode
 * Version: 1.0
 * Description: creates [mycred_share_this href='insert either facebook, twitter, google, pinterest']
 * Author: Daryl Batchelor
 * Author URI: http://batchelors.id.au
 * Plugin URI: https://mycred.me/tutorials/awarding-points-for-users-who-share-a-post/
 */

add_shortcode( 'mycred_share_this', 'mycred_render_shortcode_share_this' );
function mycred_render_shortcode_share_this( $attr, $link_title )
{
	$url = get_permalink();

	if ( $attr['href'] == 'facebook' )
		$attr['href'] = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( $url );

	return mycred_render_shortcode_link( $attr, $link_title );
}

?>