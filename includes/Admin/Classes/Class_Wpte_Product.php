<?php

namespace WPTE\ThankYou\Admin\Classes;

/**
 * The Class_Wpte_Product Handeler
 */
class Class_Wpte_Product {

	/**
	 * Class_Wpte_Product constructor.
	 */
	public function __construct() {

		// Display Fields using WooCommerce Action Hook.
		add_filter('woocommerce_product_data_tabs', [ $this, 'wpte_thankyou_product_tab' ], 10, 1 );
		add_action('woocommerce_product_data_panels', [ $this, 'wpte_thankyou_tab_data' ] );

		// Save Thankyou Page Data.
		add_action('woocommerce_process_product_meta', [ $this, 'save_thankyou_page_data' ] );
	}

	/**
	 * Method wpte_thankyou_product_tab.
	 *
	 * @param mixed $WPTE_thankyou_tab .
	 */
	public function wpte_thankyou_product_tab( $WPTE_thankyou_tab ) {

		$WPTE_thankyou_tab['custom_tab'] = [
			'label'    => __('WC Thank You Page', 'wc-thank-you-page'),
			'target'   => 'wpte_thankyou_tab_data',
			'priority' => 50,
		];
		return $WPTE_thankyou_tab;
	}

	/**
	 * Method wpte_thankyou_tab_data.
	 */
	public function wpte_thankyou_tab_data() {

		global $post;
		$post_id = $post->ID;

		wp_enqueue_style('wpte-product');
		wp_enqueue_style('wo-select2-style');
		wp_enqueue_script('wo-admin-js');
		wp_enqueue_script('wo-select2-js');

		$nonce             = wp_create_nonce( 'wpte_product_update_nonce' );
		$isChecked         = get_post_meta( $post_id, 'WPTE_thankyou_custom_checkbox', true ) === 'yes' ? ' checked' : '';
		$getThankYou       = get_post_meta( $post_id, 'WPTE_thankyou_page_product', true );
		$getThankCustomUrl = get_post_meta( $post_id, 'WPTE_thankyou_page_url', true );
		?>

			<div id="wpte_thankyou_tab_data" class="panel woocommerce_options_panel  WPTE-product-tabs-data">

				<div class='tab-content WPTE_options_group' style="padding: 20px;">
					<div class="WPTE-thankyou-product-page-warning"> <p style="text-align: left;"><?php echo '<strong> ' . esc_html__( 'Note:', 'wc-thank-you-page' ) . ' </strong>' . esc_html__( 'This feature won\'t work with gropued product', 'wc-thank-you-page' ); ?></p></div>
					<form action="" method="POST">
						<table class="WPTE_thankyou_page_general">
							<tr>
								<td><?php echo esc_html__('Custom URL', 'wc-thank-you-page'); ?><span class="WPTE_thankyou_tooltip">?<span class="WPTE_thankyou_tooltip_content" ><?php echo esc_html__('enabel the custom url for this products', 'wc-thank-you-page'); ?></span></span></td>
								<td>
									<label class="WPTE_thankyou_custom_checkbox">
										<input type="checkbox" id="WPTE_thankyou_custom_checkbox" name="WPTE_thankyou_custom_checkbox" <?php echo esc_html( $isChecked ); ?> >
										<i></i>
										<?php echo esc_html__('Enable', 'wc-thank-you-page'); ?>
									</label>
								</td>
							</tr>
							<tr id="WPTE_thankyou_page_url">
								<td><?php echo esc_html__('Set a custom url', 'wc-thank-you-page'); ?></td>
								<td><input type="text"  class="WPTE_thankyou_page_url" name="WPTE_thankyou_page_url" placeholder="URL" value="<?php echo esc_url($getThankCustomUrl); ?>"></td>
							</tr>
							<tr id="WPTE_thankyou_page_select">
								<td><?php echo esc_html__('Select the General Page', 'wc-thank-you-page'); ?><span class="WPTE_thankyou_tooltip">?<span class="WPTE_thankyou_tooltip_content" ><?php echo esc_html__('Select the General Thank You Page for this products', 'wc-thank-you-page'); ?></span></span></td>
								<td>
									<select class="WPTE-thank-you-page-select" name="WPTE_thankyou_page_product">
										<option value='0'><?php esc_html_e('Select a Page', 'wc-thank-you-page'); ?></option>
										<?php $wpte_pages = get_pages(); ?>
										<?php foreach ( $wpte_pages as $wpte_page ) { ?>
											<option value='<?php echo intval( $wpte_page->ID ); ?>' <?php selected( $getThankYou, $wpte_page->ID ); ?>><?php echo esc_html( $wpte_page->post_title ); ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
						</table>
						<input type="hidden" name="wpte_product_update_nonce_meta" value="<?php echo esc_attr( $nonce ); ?>" />
					</form>
					<input type="submit" name="submit" id="submit" class="button button-primary" value="SAVE CHANGES"  />
				</div>
			</div>
	   
		<?php
	}

	/**
	 * Save the custom fields.
	 *
	 * @param int $post_id The ID of the post.
	 */
	public function save_thankyou_page_data( $post_id ) {

		// Custom Checkbox.

		$nonce = isset( $_POST['wpte_product_update_nonce_meta'] ) ? sanitize_text_field( $_POST['wpte_product_update_nonce_meta'] ) : '';

		if ( ! wp_verify_nonce( $nonce, 'wpte_product_update_nonce' ) ) {
			return;
		}

		$customCheckBox = isset( $_POST['WPTE_thankyou_custom_checkbox'] ) && sanitize_text_field( $_POST['WPTE_thankyou_custom_checkbox'] ) ? 'yes' : 'no';

		if ( isset( $customCheckBox ) ) :
			update_post_meta( $post_id, 'WPTE_thankyou_custom_checkbox', $customCheckBox );
		else :
			$customCheckBox = '';
		endif;

		// External URL.
		$externalURL = isset( $_POST['WPTE_thankyou_page_url'] ) ? sanitize_text_field( $_POST['WPTE_thankyou_page_url'] ) : '';

		if ( isset( $externalURL ) ) :
			update_post_meta( $post_id, 'WPTE_thankyou_page_url', $externalURL );
		else :
			$externalURL = '';
		endif;

		// Internal Pages.
		$internalPage = isset( $_POST['WPTE_thankyou_page_product'] ) ? sanitize_text_field( $_POST['WPTE_thankyou_page_product'] ) : '';

		if ( isset( $internalPage ) ) :
			update_post_meta( $post_id, 'WPTE_thankyou_page_product', $internalPage );
		else :
			$internalPage = '';
		endif;
	}

}
