<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Normalize API data so missing keys don't emit PHP 8 warnings.
$stats = is_array( $stats ) ? $stats : array();
foreach ( array( 'orders_today', 'orders_last_7_days', 'orders_last_28_days' ) as $pf_period ) {
	$stats[ $pf_period ] = wp_parse_args(
		isset( $stats[ $pf_period ] ) && is_array( $stats[ $pf_period ] ) ? $stats[ $pf_period ] : array(),
		array( 'total' => 0, 'orders' => 0, 'trend' => '' )
	);
}
$stats = wp_parse_args( $stats, array( 'currency' => '', 'profit_last_28_days' => 0, 'profit_trend_last_28_days' => '' ) );
?>

<div class="printful-stats">
	<div class="printful-stats-item">
		<h4><?php echo esc_html(get_woocommerce_currency_symbol($stats['currency'])) . ' ' . esc_html($stats['orders_today']['total']); ?></h4>
		<b>
			<?php
			echo esc_html($stats['orders_today']['orders']);
			echo ' ' . esc_html( _n( 'ORDER', 'ORDERS', $stats['orders_today']['orders'], 'printful' ) );
			?>
		</b>
		<?php esc_html_e('today', 'printful'); ?>
	</div>
	<div class="printful-stats-item">
		<h4>
			<?php echo esc_html(get_woocommerce_currency_symbol($stats['currency'])) . ' ' . esc_html($stats['orders_last_7_days']['total']); ?>
			<?php echo '<span class="dashicons dashicons-arrow-' . esc_attr($stats['orders_last_7_days']['trend']) . '-alt"></span>'; ?>
		</h4>
		<b>
			<?php
			echo esc_html($stats['orders_last_7_days']['orders']);
			echo ' ' . esc_html( _n( 'ORDER', 'ORDERS', $stats['orders_last_7_days']['orders'], 'printful' ) );
			?>
		</b>
		<?php esc_html_e('last 7 days', 'printful'); ?>
	</div>
	<div class="printful-stats-item">
		<h4>
			<?php echo esc_html(get_woocommerce_currency_symbol($stats['currency'])) . ' ' . esc_html($stats['orders_last_28_days']['total']); ?>
			<?php echo '<span class="dashicons dashicons-arrow-' . esc_attr($stats['orders_last_28_days']['trend']) . '-alt"></span>'; ?>
		</h4>
		<b>
			<?php
			echo esc_html($stats['orders_last_28_days']['orders']);
			echo ' ' . esc_html( _n( 'ORDER', 'ORDERS', $stats['orders_last_28_days']['orders'], 'printful' ) );
			?>
		</b> <?php esc_html_e('last 28 days', 'printful'); ?>
	</div>
	<div class="printful-stats-item">
		<h4>
			<?php echo esc_html(get_woocommerce_currency_symbol($stats['currency'])) . ' ' . esc_attr($stats['profit_last_28_days']); ?>
			<?php echo '<span class="dashicons dashicons-arrow-' . esc_attr($stats['profit_trend_last_28_days']) . '-alt"></span>'; ?>
		</h4>
		<b><?php esc_html_e('PROFIT', 'printful'); ?></b> <?php esc_html_e('last 28 days', 'printful'); ?>
	</div>
</div>