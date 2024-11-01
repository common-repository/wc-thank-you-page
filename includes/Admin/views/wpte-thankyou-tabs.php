<div class="wrap">
	<div class="wrap">
		<h1></h1>
		<div class="wpteheader">
			<h1><span class="wpte-logo"><img src="<?php echo esc_attr( WPTE_THANKYOU_ASSETS ); ?>/img/logo.png" /></span><?php echo esc_html__('WC Thank You Page Settings', 'wc-thank-you-page'); ?></h1>
		</div>
		<div class="WPTE-thankyou-tabs">
				<ul class="WPTE-thankyou-tab-button">
					<li class="btn active"><a href="#general"><i class="demo-icon icon-general"></i> <?php echo esc_html__('General Settings', 'wc-thank-you-page'); ?></a></li>
					<li class="btn"><a href="#shortcodes"><i class="demo-icon icon-code"></i> <?php echo esc_html__('Shortcodes', 'wc-thank-you-page'); ?></a></li>
					<li class="btn"><a href="#status"><i class="demo-icon icon-status"></i> <?php echo esc_html__('System Status', 'wc-thank-you-page'); ?></a></li>
					<li class="btn"><a href="#tutorial"><i class="demo-icon icon-doc"></i> <?php echo esc_html__('Documentation', 'wc-thank-you-page'); ?></a></li>
				</ul>
				<div class="WPTE-thankyou-tab-content">
					<div id="general" class="tab-item active">
						<h2> <i class="demo-icon icon-general"></i> <?php echo esc_html__('General Settings', 'wc-thank-you-page'); ?></h2>
						<hr>
						<div class="WPTE-tab-content">
							<?php
							if ( file_exists( __DIR__ . '/wpte-thankyou-general.php') ) {
								include __DIR__ . '/wpte-thankyou-general.php';
							}
							?>
						</div>
					</div>
					<div id="shortcodes" class="tab-item">
							<h2> <i class="demo-icon icon-code"></i>  <?php echo esc_html__('Shortcodes', 'wc-thank-you-page'); ?></h2>
							<hr>
							<div class="WPTE-tab-content">
								<?php
								if ( file_exists( __DIR__ . '/wpte-thankyou-shortcode.php' ) ) {
									include __DIR__ . '/wpte-thankyou-shortcode.php';
								}
								?>
							</div>
					</div>
					<div id="status" class="tab-item">
							<h2> <i class="demo-icon icon-status"></i> <?php echo esc_html__('System Status', 'wc-thank-you-page'); ?></h2>
							<hr>
							<div class="WPTE-tab-content">
								<?php
								if ( file_exists( __DIR__ . '/wpte-thankyou-status.php' ) ) {
									include __DIR__ . '/wpte-thankyou-status.php';
								}
								?>
							</div>
					</div>

					<div id="tutorial" class="tab-item">
						<h2> <i class="demo-icon icon-doc"></i> <?php echo esc_html__('Documentation', 'wc-thank-you-page'); ?></h2>
						<hr>
						<div class="WPTE-tab-content">
							<?php
							if ( file_exists( __DIR__ . '/wpte-thankyou-tutorial.php' ) ) {
								include __DIR__ . '/wpte-thankyou-tutorial.php';
							}
							?>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>