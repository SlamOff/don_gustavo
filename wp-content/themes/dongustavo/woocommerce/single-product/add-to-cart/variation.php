<?php
/**
 * Single variation display
 *
 * This is a javascript-based template for single variations (see https://codex.wordpress.org/Javascript_Reference/wp.template).
 * The values will be dynamically replaced after selecting attributes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.5.0
 */

defined( 'ABSPATH' ) || exit;
require_once get_template_directory() . '/classes/class-GustavoTranslations.php';
$translations = new GustavoTranslations();
global $product;

$variations = (!empty($product)) ? $product->get_available_variations() : [];
?>
<script type="text/template" id="tmpl-variation-template">

	<?php  if(is_single()) : ?>

			<div class="product_card--outcome_result<?php if(count($variations) == 1) : ?> hidden<?php endif; ?>">
				<h5 class="section_title"><?php echo $translations->getTranslation(["global", 'total']); ?>:&nbsp;</h5>
				<div class="woocommerce-variation-price">{{{ data.variation.price_html }}}</div>&nbsp;
				грн
			</div>

	<?php else: ?>
		<div class="woocommerce-variation-price">{{{ data.variation.price_html }}}</div>
	<?php endif; ?>

</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
	<p><?php esc_html_e( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ); ?></p>
</script>
