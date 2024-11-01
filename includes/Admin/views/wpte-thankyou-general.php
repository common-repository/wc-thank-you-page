<?php

$submit = isset( $_POST['submit'] ) ? sanitize_text_field( $_POST['submit'] ) : '';

if ( $submit === 'SAVE CHANGES' ) {

	$nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : '';

	if ( wp_verify_nonce( $nonce, 'thankyou_custom_nonce' ) ) :

		$WPTEThankyouPageCheckbox = isset( $_POST['WPTE_thankyou_custom_checkbox'] ) ? sanitize_text_field( $_POST['WPTE_thankyou_custom_checkbox'] ) : '';
		$WPTEThankyouPageUrl      = isset( $_POST['WPTE_thankyou_page_url'] ) ? sanitize_text_field( $_POST['WPTE_thankyou_page_url'] ) : '';
		$WPTE_ThankYou_Page       = isset( $_POST['WPTE_ThankYou_Page'] ) ? sanitize_text_field( $_POST['WPTE_ThankYou_Page'] ) : '';

		if ( isset( $WPTEThankyouPageCheckbox ) ) {
			update_option('thankyou_custom_checkbox', $WPTEThankyouPageCheckbox);  // Save check box in options table.
		} else {
			$WPTEThankyouPageCheckbox = '';
		}

		if ( isset( $WPTEThankyouPageUrl ) ) {
			update_option('thankyou_custom_url', esc_url($WPTEThankyouPageUrl)); // Save custom url in options table.
		} else {
			$WPTEThankyouPageUrl = '';
		}

		if ( isset( $WPTE_ThankYou_Page ) ) {
			update_option( 'thankyou_page', $WPTE_ThankYou_Page ); // Save Page ID in options table.
		} else {
			$WPTE_ThankYou_Page = '';
		}

	endif;

}

$getThankYou       = get_option('thankyou_page');
$getThankCustomUrl = get_option('thankyou_custom_url');
$isChecked         = get_option('thankyou_custom_checkbox') === 'on' ? ' checked' : '';

?>

<form action="" method="POST">	
	<?php
	wp_nonce_field('thankyou_custom_nonce');
	?>
	<div class="general">
		<table class="WPTE_thankyou_page_general">
			<tr>
				<td><?php echo esc_html__('Custom URL', 'wc-thank-you-page'); ?><span class="WPTE_thankyou_tooltip">?<span class="WPTE_thankyou_tooltip_content" ><?php echo esc_html__('enabel the custom url for all products', 'wc-thank-you-page'); ?></span></span></td>
				<td>
					<label class="WPTE_thankyou_custom_checkbox">
						<input type="checkbox" id="WPTE_thankyou_custom_checkbox" name="WPTE_thankyou_custom_checkbox" <?php echo esc_html( $isChecked ); ?>>
						<i></i>
						<?php echo esc_html__('Enable', 'wc-thank-you-page'); ?>
					</label>
				</td>
			</tr>
			<tr id="WPTE_thankyou_page_url">
				<td><?php echo esc_html__('Set a custom url', 'wc-thank-you-page'); ?><span class="WPTE_thankyou_tooltip">?<span class="WPTE_thankyou_tooltip_content" ><?php echo esc_html__('Set a Internal or external URL for all products', 'wc-thank-you-page'); ?></span></span></td>
				<td><input type="text"  class="WPTE_thankyou_page_url" name="WPTE_thankyou_page_url" placeholder="URL" value="<?php echo esc_url($getThankCustomUrl); ?>"></td>
			</tr>
			<tr id="WPTE_thankyou_page_select">
				<td><?php echo esc_html__('Select the General Page', 'wc-thank-you-page'); ?><span class="WPTE_thankyou_tooltip">?<span class="WPTE_thankyou_tooltip_content" ><?php echo esc_html__('Select the General Thank You Page for all products', 'wc-thank-you-page'); ?></span></span></td>
				<td>
					<select class="WPTE-thank-you-page-select" name="WPTE_ThankYou_Page">
						<option value='0' ><?php esc_html_e('Select a Page', 'wc-thank-you-page'); ?></option>
						<?php $wpte_pages = get_pages(); ?>
						<?php foreach ( $wpte_pages as $wpte_page ) { ?>
							<option value='<?php echo intval( $wpte_page->ID ); ?>' <?php selected( $getThankYou, $wpte_page->ID ); ?>><?php echo esc_html( $wpte_page->post_title ); ?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
		</table>

	</div>
	<div class="WPTE-admin-submit">
		<input type="submit" name="submit" id="submit" class="button button-primary" value="SAVE CHANGES"  />
	</div>
</form>	
