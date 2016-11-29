<?php
/*
Plugin Name: Affiliates Manager Paid Membership Pro Integration
Plugin URI: https://wpaffiliatemanager.com
Description: Process an affiliate commission via Affiliates Manager after a Paid Membership Pro checkout.
Version: 1.0.4
Author: wp.insider, affmngr
Author URI: https://wpaffiliatemanager.com
*/
 
//show affiliate id on orders dashboard page
add_action("pmpro_orders_show_affiliate_ids", "__return_true");

//Save affiliate id before checkout
add_action('pmpro_before_send_to_paypal_standard', 'wpam_pmpro_save_aff_id_before_checkout', 10, 2);
add_action('pmpro_before_send_to_twocheckout', 'wpam_pmpro_save_aff_id_before_checkout', 10, 2);

function wpam_pmpro_save_aff_id_before_checkout($user_id, $morder) {
    WPAM_Logger::log_debug('Paid Membership Pro Integration - before checkout hook fired. user id: '.$user_id.', order id: '.$morder->code);
    $strRefKey = '';
    if(isset( $_COOKIE['wpam_id'])){
        $strRefKey = $_COOKIE['wpam_id'];
    }
    else if(isset( $_COOKIE[WPAM_PluginConfig::$RefKey])){
        $strRefKey = $_COOKIE[WPAM_PluginConfig::$RefKey];
    }
    //
    if(!empty($strRefKey)){
        //save affiliate id with the order
        WPAM_Logger::log_debug('Paid Membership Pro Integration - Tracking data present. Tracking value: '.$strRefKey);
        $morder->affiliate_id = $strRefKey;
        $morder->saveOrder();
        WPAM_Logger::log_debug('Paid Membership Pro Integration - Tracking data has been saved with the order');
    }
}

//process affiliate and save id after checkout
function wpam_pmpro_after_checkout($user_id) {
    $morder = new MemberOrder();
    $morder->getLastMemberOrder($user_id);
    $referrer = $_COOKIE['wpam_id'];
    WPAM_Logger::log_debug('Paid Membership Pro Integration - wpam_pmpro_after_checkout() function, user id: '.$user_id.' and affiliate id: '.$referrer);
    if (empty($referrer)) {
        WPAM_Logger::log_debug('Paid Membership Pro Integration - wpam_pmpro_after_checkout() function, affiliate id is empty so no action is necessary.');
        return;
    }
    WPAM_Logger::log_debug('Paid Membership Pro Integration - wpam_pmpro_after_checkout() function, saving affiliate id: '.$referrer.' with order id: '.$morder->code.', amount: '.$morder->total);
    $morder->affiliate_id = $referrer;
    $morder->saveOrder();    
}

add_action("pmpro_after_checkout", "wpam_pmpro_after_checkout");

//for new orders (e.g. recurring orders via web hooks) check if a previous affiliate id was used and process
function wpam_pmpro_add_order($morder) {
    $sale_amt = $morder->total; //The commission will be calculated based on this amount
    $txn_id = $morder->code; //The unique transaction ID for reference
    $muser = get_userdata($morder->user_id);
    $email = $muser->user_email; //Customer email for record
    //need to get the last order before this
    $last_order = new MemberOrder();
    $last_order->getLastMemberOrder($morder->user_id);
    WPAM_Logger::log_debug('Paid Membership Pro Integration - wpam_pmpro_add_order() function, affiliate id: '.$last_order->affiliate_id.', order id: '.$txn_id);
    if (!empty($last_order->affiliate_id)) {
        //perform
        $referrer = $last_order->affiliate_id;
        WPAM_Logger::log_debug('Paid Membership Pro Integration - wpam_pmpro_add_order() function, awarding commission for txn_id: '.$txn_id.', amount: '.$sale_amt);
        $requestTracker = new WPAM_Tracking_RequestTracker();
        $requestTracker->handleCheckoutWithRefKey($txn_id, $sale_amt, $referrer);
        //update the affiliate id for this order
        global $wpam_pmpro_aff_id;
        $wpam_pmpro_aff_id = $referrer;
    }
}

add_action("pmpro_add_order", "wpam_pmpro_add_order");

//After the order is saved update the affiliate id column again
function wpam_pmpro_added_order($morder) {
    global $wpam_pmpro_aff_id;

    if (!empty($wpam_pmpro_aff_id)) {
        $morder->affiliate_id = $wpam_pmpro_aff_id;
        $morder->saveOrder();
        WPAM_Logger::log_debug('Paid Membership Pro Integration - wpam_pmpro_added_order() function, saving affiliate id: '.$wpam_pmpro_aff_id.' with order id: '.$morder->code);
    }
}

add_action("pmpro_added_order", "wpam_pmpro_added_order");

/* For handling membership recurring payments/refunds/cancellations */
add_action("pmpro_updated_order", "wpam_pmpro_updated_order");

function wpam_pmpro_updated_order($order) {
    WPAM_Logger::log_debug('Paid Membership Pro Integration - handling pmpro_updated_order hook');
    $payment_type = $order->payment_type;
    $status = $order->status;
    $sale_amt = $order->total;
    $strRefKey = $order->affiliate_id;
    $email = $order->Email;
    $first_name = $order->FirstName;
    $last_name = $order->LastName;

    $txn_id = $order->code; //actual txn_id
    $txn_id = $txn_id . "_" . date("Y-m-d"); //Add a date to txn_id to make it unique (handy when its a rebill notification for a subscription)

    WPAM_Logger::log_debug('Paid Membership Pro Integration - payment_type: '.$payment_type.', status: '.$status.', txn_id: '.$txn_id.', amount: '.$sale_amt);
    if(isset($strRefKey) && !empty($strRefKey)){
        WPAM_Logger::log_debug('Paid Membership Pro Integration - Tracking data is present. Tracking value: '.$strRefKey);
    }
    else{
        WPAM_Logger::log_debug('Paid Membership Pro Integration - Tracking data is not present. This is not an affiliate sale');
        return;
    }
    //check if commission can be awarded
    if ($status != "success") {
        WPAM_Logger::log_debug('Paid Membership Pro Integration - the order status is not set to success yet. The commission will be awarded when the status changes to success');
        return;
    }
    WPAM_Logger::log_debug('Paid Membership Pro Integration - Awarding commission for txn_id: '.$txn_id.', amount: '.$sale_amt);
    $requestTracker = new WPAM_Tracking_RequestTracker();
    $requestTracker->handleCheckoutWithRefKey($txn_id, $sale_amt, $strRefKey);
}
