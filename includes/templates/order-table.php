<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<h2>Printful product orders</h2>

<?php if ( ! empty( $orders ) && is_array( $orders ) && ! empty( $orders['count'] ) && ! empty( $orders['results'] ) && is_array( $orders['results'] ) ) : ?>

	<table class="wp-list-table widefat fixed striped printful-latest-orders">
		<thead>
		<tr>
			<th class="col-order"><?php esc_html_e('Order', 'printful'); ?></th>
			<th class="col-date"><?php esc_html_e('Date', 'printful'); ?></th>
			<th class="col-from"><?php esc_html_e('From', 'printful'); ?></th>
			<th class="col-status"><?php esc_html_e('Status', 'printful'); ?></th>
			<th class="col-total"><?php esc_html_e('Total', 'printful'); ?></th>
			<th class="col-actions"><?php esc_html_e('Actions', 'printful'); ?></th>
		</tr>
		</thead>
		<tbody>

		<?php foreach ( $orders['results'] as $currentOrder ) : ?>
			<?php
			if ( ! is_array( $currentOrder ) ) {
				continue;
			}
			$currentOrder = wp_parse_args( $currentOrder, array(
				'id'          => '',
				'external_id' => '',
				'created'     => 0,
				'recipient'   => array(),
				'status'      => '',
				'costs'       => array(),
			) );
			$pf_recipient_name = isset( $currentOrder['recipient']['name'] ) ? $currentOrder['recipient']['name'] : '';
			$pf_order_total    = isset( $currentOrder['costs']['total'] ) ? $currentOrder['costs']['total'] : '';
			// HPOS-safe edit URL (orders are not posts when custom order tables are enabled).
			$pf_wc_order      = $currentOrder['external_id'] ? wc_get_order( (int) $currentOrder['external_id'] ) : false;
			$pf_edit_order_url = $pf_wc_order ? $pf_wc_order->get_edit_order_url() : '';
			?>

			<tr>
				<td>
					<?php
					if ( $currentOrder['external_id'] && $pf_edit_order_url ) {
						echo '<a href="' . esc_url( $pf_edit_order_url ) . '">';
						echo '#' . esc_html( $currentOrder['external_id'] );
						echo '</a>';
					} elseif ( $currentOrder['external_id'] ) {
						echo '#' . esc_html( $currentOrder['external_id'] );
					} else {
						echo '#' . esc_html( $currentOrder['id'] );
					}
					?>
				</td>
				<td>
					<?php echo esc_html( gmdate('Y-m-d', (int) $currentOrder['created']) ); ?>
				</td>
				<td>
					<?php echo esc_html( $pf_recipient_name ); ?>
				</td>
				<td>
					<?php echo esc_html( ucfirst( (string) $currentOrder['status'] ) ); ?>
				</td>
				<td>
					$<?php echo esc_html( $pf_order_total ); ?>
				</td>
				<td>
					<a href="<?php echo esc_url(Printful_Base::get_printful_host()); ?>dashboard?order_id=<?php echo esc_attr( $currentOrder['id'] ); ?>" target="_blank"><?php esc_html_e('Open in Printful', 'printful'); ?></a>
				</td>
			</tr>

		<?php endforeach; ?>

		</tbody>
		<tfoot>
		<tr>
			<th class="col-order"><?php esc_html_e('Order', 'printful'); ?></th>
			<th class="col-date"><?php esc_html_e('Date', 'printful'); ?></th>
			<th class="col-from"><?php esc_html_e('From', 'printful'); ?></th>
			<th class="col-status"><?php esc_html_e('Status', 'printful'); ?></th>
			<th class="col-total"><?php esc_html_e('Total', 'printful'); ?></th>
			<th class="col-actions"><?php esc_html_e('Actions', 'printful'); ?></th>
		</tr>
		</tfoot>
	</table>

<?php else : ?>
	<div class="printful-latest-orders">
		<p><?php esc_html_e('Once your store gets some Printful product orders, they will be shown here!', 'printful'); ?></p>
	</div>
<?php endif; ?>