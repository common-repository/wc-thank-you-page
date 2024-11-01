<?php
/**
 * Plugin Name:       WC Thank You Page
 * Plugin URI:        https://wptoffee.com
 * Description:       This is redirect to thank you page plugin after complete order for Woocommerce
 * Version:           1.0.3
 * Author:            WPToffee
 * Author URI:        https://wptoffee.com
 * Text Domain:       wc-thank-you-page
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined('ABSPATH') ) {
	wp_die( esc_html__( 'You can\'t access this page', ' wc-thank-you-page' ) );
}

/** If class `WP_Dark_Mode` doesn't exists yet. */
if ( ! class_exists('WPTE_ThankYou_Page') ) {

	/**
	 * Sets up and initializes the plugin.
	 * Main initiation class
	 *
	 * @since 1.0.0
	 */
	final class WPTE_ThankYou_Page {

		/**
		 * Plugin Version
		 */
		const VERSION = '1.0.3';

		/**
		 * Php Version
		 */
		const MIN_PHP_VERSION = '7.3';

		/**
		 * WC Version
		 */
		const MIN_WC_VERSION = '7.9.0';

		/**
		 * WordPress Version
		 */
		const MIN_WP_VERSION = '6.2';

		/**
		 * Class Constractor
		 */
		private function __construct() {

			require_once __DIR__ . '/vendor/autoload.php';
			$this->define_constance();
			register_activation_hook( __FILE__, [ $this, 'activate' ] );
			add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
			add_action( 'admin_init', [ $this, 'activation_redirect' ] );
			add_filter('plugin_action_links_' . plugin_basename(WPTE_THANKYOU_FILE), [ __CLASS__, 'wpte_thankyou_page_action_links' ] );
		}

		/**
		 * Initilize a singleton instance
		 *
		 * @return /WPTE_ThankYou_Page
		 */
		public static function init() {

			static $instance = false;

			if ( ! $instance ) {

				$instance = new self();
			}

			return $instance;
		}

		/**
		 * Method define_constance.
		 * Plugin Constance.
		 */
		public function define_constance() {

			define('WPTE_THANKYOU_VERSION', self::VERSION);
			define('WPTE_THANKYOU_FILE', __FILE__);
			define('WPTE_THANKYOU_PATH', __DIR__);
			define('WPTE_THANKYOU_URL', plugins_url('', WPTE_THANKYOU_FILE));
			define('WPTE_THANKYOU_ASSETS', WPTE_THANKYOU_URL . '/assets' );
			define('WPTE_THANKYOU_MINIMUM_PHP_VERSION', self::MIN_PHP_VERSION);
			define('WPTE_THANKYOU_MINIMUM_WC_VERSION', self::MIN_WC_VERSION);
			define('WPTE_THANKYOU_MINIMUM_WP_VERSION', self::MIN_WP_VERSION);
		}

		/**
		 * After activate Plugin
		 */
		public function activate() {

			$installed = get_option('WPTE_thankyou_installed');

			if ( ! $installed ) {

				update_option('WPTE_thankyou_installed', time());
			}

			update_option('WPTE_thankyou_version', WPTE_THANKYOU_VERSION);

			add_option('WPTE_thankyou_page_activation_redirect', true);
		}

		/**
		 * Plugins Loaded
		 */
		public function init_plugin() {

			new WPTE\ThankYou\Assets();
			new WPTE\ThankYou\Shortcodes();

			if ( is_admin() ) {
				new WPTE\ThankYou\Admin();
			} else {
				new WPTE\ThankYou\Frontend();
			}
		}

		/**
		 * Redirect to settings page after activation the plugin
		 */
		public function activation_redirect() {

			if ( get_option( 'WPTE_thankyou_page_activation_redirect', false ) ) {

				delete_option('WPTE_thankyou_page_activation_redirect');

				wp_safe_redirect( admin_url('admin.php?page=wc-thank-you-page') );
			}
		}

		/**
		 * Plugin Page Settings menu.
		 *
		 * @param mixed $links .
		 */
		public static function wpte_thankyou_page_action_links( $links ) {

			if ( ! current_user_can( 'manage_options' ) ) {
				return $links;
			}

			$links = array_merge(
				[
					sprintf('<a href="%s">%s</a>',
						admin_url( 'admin.php?page=wc-thank-you-page' ),
						esc_html__( 'Settings', ' wc-thank-you-page' )
				),
				],
				$links
			);
			return $links;
		}

	}

}

/**
 * Initilize the main plugin
 *
 * @return /WPTE_ThankYou_Page
 */
function wpte_thankyou() {

	if ( class_exists( 'WPTE_ThankYou_Page' ) ) :

		return WPTE_ThankYou_Page::init();

	endif;

}

/**
 * Kick-off the plugin
 */
wpte_thankyou();
