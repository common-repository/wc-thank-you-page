<?php

namespace WPTE\ThankYou\Admin;

/**
 * Menu Handeler Calss
 */
class Menu {

	/**
	 * Admin Menu Constructor
	 */
	public function __construct() {

		add_action( 'admin_menu', [ $this, 'admin_menu' ] );

	}

	/**
	 * Register Admin Menue
	 *
	 * @return void
	 */
	public function admin_menu() {
		add_menu_page( __('WC Thank You', 'wc-thank-you-page' ), __( 'WC Thank You', 'wc-thank-you-page' ), 'manage_options', 'wc-thank-you-page', [ $this, 'plugin_page' ], 'dashicons-redo', 56 );
	}

	/**
	 * Plugin Page Handelare
	 *
	 * @return void
	 */
	public function plugin_page() {

		wp_enqueue_style( 'wo-admin-style' ); // Enqueue admin Style.
		wp_enqueue_style( 'wo-select2-style' ); // Enqueue Select 2 Style.
		wp_enqueue_style( 'wpte-fontello-style' ); // Enqueue fontello Style.

		wp_enqueue_script( 'wo-select2-js' ); // Enqueue Select 2 JS.
		wp_enqueue_script( 'wo-admin-js' ); // Enqueue Admin Js.

		include __DIR__ . '/views/wpte-thankyou-tabs.php';

	}

}