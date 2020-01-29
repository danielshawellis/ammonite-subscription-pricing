<?php
/**
 * Plugin Name:       Ammonite Subscription Pricing
 * Description:       Edits the single purchase price, allowing for greater flexibility with All Products for WooCommerce Subscriptions
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
  Filter To Edit Prices for Single Purchases
*/
add_filter( 'woocommerce_dynamic_pricing_process_product_discounts', 'amdv_remove_dynamic_pricing_settings_from_one_time_option', 10, 4 );
function amdv_remove_dynamic_pricing_settings_from_one_time_option( $eligible, $product, $discounter_name, $discounter_object ) {

  // Log product to JS console for dev
  $output = $product;
  if (is_array($output))
      $output = implode(',', $output);

  echo "<script>console.log(" . $output . ");</script>";

  // Check if product is one time option
  // if (condition) {
  //   $eligible = 0;
  // }

  return $eligible;

}
