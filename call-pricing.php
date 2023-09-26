<?php
/*
Plugin Name: WooCommerce Hide Add to Cart for Zero Price
Description: Hides the "Add to Cart" button and quantity field for products with a price of 0, and displays a "Call for Pricing" button instead.
* Version: 1.0.0
* Author: Hamid Heyhat
*/

// Hide Add to Cart button and quantity field for zero-priced products
function wpse_hide_add_to_cart_for_zero_price($is_purchasable, $product) {
    if ($product->get_price() == 0) {
        $is_purchasable = false;
    }

    return $is_purchasable;
}
add_filter('woocommerce_is_purchasable', 'wpse_hide_add_to_cart_for_zero_price', 10, 2);

// Display Call for Pricing button after price
function wpse_display_call_for_pricing_button() {
    global $product;

    if ($product->get_price() == 0) {
        $phone_number = '+18779376400';
        $phone_number_url = 'tel:' . preg_replace('/[^0-9+]/', '', $phone_number);
        $call_for_pricing_button = '<a href="' . esc_url($phone_number_url) . '" class="button">Call for Pricing</a>';

        // Output the Call for Pricing button
        echo '<div class="call-for-pricing-wrapper">' . $call_for_pricing_button . '</div>';
    }
}
add_action('woocommerce_single_product_summary', 'wpse_display_call_for_pricing_button', 31);
