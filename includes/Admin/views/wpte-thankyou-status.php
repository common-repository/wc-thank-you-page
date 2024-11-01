<?php

global $wp_version;

$wp_cache = WP_CACHE ? 'Yes' : 'No';


// Check for required PHP version.
if ( version_compare( $wp_version, WPTE_THANKYOU_MINIMUM_WP_VERSION, '<' ) ) {

	$wpVersion = " <td class=\"text-left red\">$wp_version  <span style='color:#444;font-size: 12px;'>Please Incrise WordPress Version</span></td>";

} else {

	$wpVersion = " <td class=\"text-left green\">$wp_version</td>";

}

// Check for required PHP version.
if ( version_compare( PHP_VERSION, WPTE_THANKYOU_MINIMUM_PHP_VERSION, '<' ) ) {

	$phpVerseion = ' <td class="text-left red">' . PHP_VERSION . ' <span style="color:#444;font-size: 12px;">Please Incrise PHP Version</span></td> ';

} else {

	$phpVerseion = ' <td class=\"text-left green\">' . PHP_VERSION . '</td>';

}

// Check for required PHP version.
if ( version_compare( WC_VERSION, WPTE_THANKYOU_MINIMUM_WC_VERSION, '<' ) ) {

	$WcVerseion = ' <td class="text-left red">' . WC_VERSION . '<span style="color:#444;font-size: 12px;">Please Incrise WooCommerce Version</span></td>';

} else {

	$WcVerseion = ' <td class="text-left green">' . WC_VERSION . '</td>';

}

?>  

<table class="wpte-status-area">
		<tbody class="wpte-status-table-body">
			<tr>
				<td class="text-left"><?php echo esc_html__('Site Url', 'wc-thank-you-page'); ?></td>
				<td class="text-left green"><?php echo esc_url( get_site_url() ); ?></td>
			</tr>
			<tr>
				<td class="text-left"><?php echo esc_html__('Define WP_CACHE', 'wc-thank-you-page'); ?></td>
				<td class="text-left green"><?php echo wp_kses( $wp_cache, true); ?></td>
			</tr>
		</tbody>
</table>

<table style="margin-top: 50px; margin-bottom: 50px;" class="wpte-status-area">
		<tbody class="wpte-status-table-body">
			<tr>
				<td class="text-left"><?php echo esc_html__('WordPress Version', 'wc-thank-you-page'); ?></td>
				<?php echo wp_kses( $wpVersion, true ); ?>
			</tr>
			<tr>
				<td class="text-left"><?php echo esc_html__('PHP Version', 'wc-thank-you-page'); ?></td>
				<?php echo wp_kses( $phpVerseion, true ); ?>
			</tr>
			<tr>
				<td class="text-left"><?php echo esc_html__('WooCommerce Version', 'wc-thank-you-page'); ?></td>
				<?php echo wp_kses( $WcVerseion, true ); ?>
			</tr>
			<tr>
				<td class="text-left"><?php echo esc_html__('Available Memory', 'wc-thank-you-page'); ?></td>
				<td class="text-left green"><?php echo esc_html( WP_MAX_MEMORY_LIMIT ); ?></td>
			</tr>
			<tr>
				<td class="text-left"><?php echo esc_html__('Memory Limit', 'wc-thank-you-page'); ?></td>
				<td class="text-left green"><?php echo esc_html( WP_MEMORY_LIMIT ); ?></td>
			</tr>
		</tbody>
</table>

