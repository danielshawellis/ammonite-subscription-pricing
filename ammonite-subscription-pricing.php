<?php
/**
 * Plugin Name:       Ammonite Subscription Pricing
 * Description:       Edits the single purchase and subscription option prices, allowing for greater flexibility with All Products for WooCommerce Subscriptions
 * Version:           1.0.0
 * Author:            Daniel Ellis
 * Author URI:        https://danielellisdevelopment.com/
 */

/*
  Basic Security
*/
if ( ! defined( 'ABSPATH' ) ) {
  die;
}

/*
  Edit Prices for Single Purchases VS Subscriptions
*/
add_action( 'woocommerce_before_calculate_totals', 'add_custom_price', 20, 1);
function add_custom_price( $cart ) {

    // This is necessary for WC 3.0+
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    // Avoiding hook repetition (when using price calculations for example)
    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;

    // Loop through cart items
    foreach ( $cart->get_cart() as $item ) {

      // Check if a subscription option is selected for the item
      if ( $item['wcsatt_data']['active_subscription_scheme'] != false ) {

        // If a subscription option is selected, apply quantity-based discounts
        if ( $item['quantity'] == 1 ) {
          $item['data']->set_price( 45 );
        } elseif ( $item['quantity'] == 2 ) {
          $item['data']->set_price( 42.5 );
        } elseif ( $item['quantity'] == 3 ) {
          $item['data']->set_price( 41.66 );
        } elseif ( $item['quantity'] >= 4 ) {
          $item['data']->set_price( 41.25 );
        }

      }
    }
}
