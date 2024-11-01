<?php

namespace WPTE\ThankYou\Frontend\Classes;

/**
 * Thank you page redirect class
 *
 * @since 1.0.0
 */
class Class_wpte_redirect {

	/**
	 * Redirect Constructor
	 */
	public function __construct() {

		add_action( 'woocommerce_thankyou', [ $this, 'wpte_thankyou_redirect_after_purchase' ], 10, 1 );

	}

	/**
	 * Method wpte_thankyou_redirect_after_purchase.
	 *
	 * @param int $order_id The ID of the order.
	 */
	public function wpte_thankyou_redirect_after_purchase( $order_id ) {

		if ( ! $order_id ) {
			return; // Exit.
		}

		$order = wc_get_order( $order_id );
		$items = $order->get_items();

		foreach ( $items as $item ) {

			$product_id = $item->get_product_id();

		}

		$isChecked = get_option('thankyou_custom_checkbox');

		$isProductChecked  = get_post_meta( $product_id, 'WPTE_thankyou_custom_checkbox', true );
		$getThankYou       = get_post_meta( $product_id, 'WPTE_thankyou_page_product', true );
		$getThankCustomUrl = get_post_meta( $product_id, 'WPTE_thankyou_page_url', true );

		// Per Product Redirect.
		if ( 'yes' !== $isProductChecked && '' !== $getThankYou && '0' !== $getThankYou ) {
			// Get Order Object.
			wc_get_order( intval( $order_id ) );

			// Get Thank You page ID.
			$thankyoupage = get_permalink( $getThankYou );

			$order_key = isset( $_GET['key'] ) ? sanitize_text_field( $_GET['key'] ) : '';

			$redirect  = $thankyoupage;
			$redirect .= get_option('permalink_structure') === '' ? '&' : '?';
			$redirect .= 'order=' . absint($order_id) . '&key=' . $order_key;
			wp_redirect($redirect);

			exit;

		} elseif ( 'yes' === $isProductChecked && '' !== $getThankCustomUrl && '0' !== $getThankYou ) {

			$order              = wc_get_order($order_id);
			$order_total        = $order->get_total(); // Order total amount.
			$thankyouCustomUrl  = esc_url($getThankCustomUrl); // Get Thank You page URL.
			$thankyouCustomUrl .= '?order_id=' . $order_id . '&order_ammount=' . $order_total; // Passed variables.

			wp_redirect($thankyouCustomUrl);

			exit;
		}

		// Global redirect.
		if ( 'on' !== $isChecked ) {
			// Get Order Object.
			wc_get_order( intval($order_id) );

			// Get Thank You page ID.
			$thankyoupage = get_permalink(get_option('thankyou_page'));

			$order_key = isset( $_GET['key'] ) ? sanitize_text_field( $_GET['key'] ) : '';

			$redirect  = $thankyoupage;
			$redirect .= get_option('permalink_structure') === '' ? '&' : '?';
			$redirect .= 'order=' . absint($order_id) . '&key=' . $order_key;
			wp_redirect($redirect);
			exit;

		} else {

			$order              = wc_get_order($order_id);
			$order_total        = $order->get_total(); // Order total amount.
			$thankyouCustomUrl  = esc_url( get_option('thankyou_custom_url') ); // Get Thank You page URL.
			$thankyouCustomUrl .= '?order_id=' . $order_id . '&order_ammount=' . $order_total; // passed variables.

			wp_redirect( $thankyouCustomUrl );

			exit;
		}

	}

}