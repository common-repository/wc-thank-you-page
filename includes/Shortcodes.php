<?php

namespace WPTE\ThankYou;

/**
 * Thank you page Shortcodes class
 *
 * @since 1.0.2
 */
class Shortcodes {

	/**
	 * Shortcode Constructor
	 */
	public function __construct() {

		$shortcodes = [
			'wpte_order_number',
			'wpte_first_name',
			'wpte_order_status',
			'wpte_currency',
			'wpte_total_price',
			'wpte_created_date',
			'wpte_shipping_method',
		];

		foreach ( $shortcodes as $shortcode ) {
			add_shortcode( $shortcode, [ $this, $shortcode ] );
		}

	}

	/**
	 * Order Number Shortcode
	 */
	public function wpte_order_number() {

		$orderNumber = isset( $_GET['order'] ) ? intval( $_GET['order'] ) : '';
		ob_start();

		if ( $orderNumber ) {
			return $orderNumber;
		}
		$orderNumber = '1245';

		return ob_get_clean();

	}

	/**
	 * User Name Shortcode
	 */
	public function wpte_first_name() {

		$orderID = isset( $_GET['order'] ) ? intval( $_GET['order'] ) : '';
		$order   = wc_get_order( $orderID );

		if ( $orderID ) {
			$wpte_first_name = $order->get_billing_first_name();
			return $wpte_first_name;
		}

		$wpte_first_name = 'Jhon';

		return $wpte_first_name;

	}

	/**
	 * Order Status Shortcode
	 */
	public function wpte_order_status() {

		$orderID = isset( $_GET['order'] ) ? intval( $_GET['order'] ) : '';
		$order   = wc_get_order( $orderID );

		if ( $orderID ) {
			$order_status = $order->get_status();
			return ucfirst($order_status);
		}

		$order_status = 'Processing';

		return $order_status;

	}

	/**
	 *  Currency Shortcode
	 */
	public function wpte_currency() {

		$orderID = isset( $_GET['order'] ) ? intval( $_GET['order'] ) : '';
		$order   = wc_get_order( $orderID );

		if ( $orderID ) {
			$wpte_currency = $order->get_currency();
			return $wpte_currency;
		}

		$wpte_currency = '$';

		return $wpte_currency;

	}

	/**
	 * Total Price Shortcode
	 */
	public function wpte_total_price() {

		$orderID = isset( $_GET['order'] ) ? intval( $_GET['order'] ) : '';
		$order   = wc_get_order( $orderID );

		if ( $orderID ) {
			$total_price = $order->get_total();
			return $total_price;
		}

		$total_price = '1000.00';

		return $total_price;

	}

	/**
	 * Order Created Date Shortcode
	 */
	public function wpte_created_date() {

		$orderID = isset( $_GET['order'] ) ? intval( $_GET['order'] ) : '';
		$order   = wc_get_order( $orderID );

		if ( $orderID ) {
			$wpte_created_date = $order->get_date_created();
			return gmdate( 'd, M Y', strtotime( $wpte_created_date ) );
		}

		$wpte_created_date = '26, Mar 2021';

		return $wpte_created_date;

	}

	/**
	 * Order Shipping Method Shortcode
	 */
	public function wpte_shipping_method() {

		$orderID = isset( $_GET['order'] ) ? intval( $_GET['order'] ) : '';
		$order   = wc_get_order( $orderID );

		if ( $orderID ) {
			$wpte_shipping_method = $order->get_shipping_method();
			return $wpte_shipping_method;
		}

		$wpte_shipping_method = 'Flat rate';

		return $wpte_shipping_method;

	}
}