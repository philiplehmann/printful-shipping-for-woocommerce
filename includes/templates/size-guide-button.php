<?php
/**
 * Size guide button.
 *
 * @var string $size_guide_button_color
 * @var string $size_guide_button_text
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<a href="javascript:" style="color: <?php echo esc_attr( $size_guide_button_color ); ?>"
   onclick="Printful_Product_Size_Guide.onSizeGuideClick()">
	<?php echo esc_html( $size_guide_button_text ); ?>
</a>