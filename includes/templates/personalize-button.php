<?php
/**
 * Personalize button.
 *
 * @var string $pfc_button_color
 * @var string $site_url
 * @var string $pfc_button_text
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<a class="button"
   style="background-color: <?php echo esc_attr( $pfc_button_color ); ?>"
   onclick="Printful_Product_Customizer.onCustomizeClick( '<?php echo esc_url($site_url); ?>')">
	<?php echo esc_html( $pfc_button_text ); ?>
</a>