<?php

namespace WPTE\ThankYou;

/**
 * Assets Handeler class
 */
class Assets {

	/**
	 * Assets constructor.
	 */
	public function __construct() {

		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );

	}

	/**
	 * Assets enqueue_assets.
	 */
	public function enqueue_assets() {

		// Enqueue Admin CSS.
		wp_register_style('wo-admin-style', WPTE_THANKYOU_ASSETS . '/css/admin.css', null, filemtime( WPTE_THANKYOU_PATH . '/assets/css/admin.css' ) );
		wp_register_style('wpte-product', WPTE_THANKYOU_ASSETS . '/css/wpte-product.css', null, filemtime( WPTE_THANKYOU_PATH . '/assets/css/wpte-product.css' ) );
		wp_register_style('wo-select2-style', WPTE_THANKYOU_ASSETS . '/lib/select2/select2.min.css', null, filemtime( WPTE_THANKYOU_PATH . '/assets/lib/select2/select2.min.css' ) );
		wp_register_style('wpte-fontello-style', WPTE_THANKYOU_ASSETS . '/lib/icon/css/fontello.css', null, filemtime( WPTE_THANKYOU_PATH . '/assets/lib/icon/css/fontello.css' ) );

		// Enqueue Admin Js.
		wp_register_script('wo-admin-js', WPTE_THANKYOU_ASSETS . '/js/admin.js', [ 'jquery' ], filemtime( WPTE_THANKYOU_PATH . '/assets/js/admin.js' ), true);
		wp_register_script('wo-select2-js', WPTE_THANKYOU_ASSETS . '/lib/select2/select2.min.js', [ 'jquery' ], filemtime( WPTE_THANKYOU_PATH . '/assets/lib/select2/select2.min.js' ), true );

	}

}