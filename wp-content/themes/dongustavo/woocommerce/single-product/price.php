<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$translations = new GustavoTranslations();

$variations = ($product->is_type( 'variable' )) ? $product->get_available_variations() : null;
?>
<?php if(is_single()) : ?>
	<div class="product_card--outcome_result<?php if(!is_array($variations) or count($variations) > 1) : ?> hidden<?php endif; ?>">
		<h5 class="section_title"><?php echo $translations->getTranslation(["global", 'total']); ?>:&nbsp;</h5>
		<div class="woocommerce-variation-price"><?php echo $product->get_price_html(); ?></div>&nbsp;
		грн
	</div>
<?php else: ?>
	<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?> test"><?php echo $product->get_price_html(); ?></p>
<?php endif; ?>
