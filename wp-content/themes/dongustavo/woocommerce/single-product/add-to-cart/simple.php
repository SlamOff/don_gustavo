<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
require_once get_template_directory() . '/classes/class-Actions.php';
global $product;

if ( ! $product->is_purchasable() ) {
	return;
}
$translations = new GustavoTranslations();
//echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>
<div class="product_card--weight desktop">
	<span><?php echo $product->weight ?></span> г
</div>
	<?php
//	var_dump($product);
	do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		<?php
//		do_action( 'woocommerce_before_add_to_cart_quantity' );
//
//		woocommerce_quantity_input(
//			array(
//				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
//				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
//				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
//			)
//		);
//
//		do_action( 'woocommerce_after_add_to_cart_quantity' );
		$quantity = isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity();
		?>
		<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ) ?>">
		<div class="product_card--final">
			<div class="product_card--quantity">
				<span><?php echo $translations->getTranslation(["global", 'count']); ?></span>
				<div class="quantity">
					<div class="btn_minus btn_action btn_minus_product_sushi_card js-qty js-minus disabled">-</div>
					<input readonly="" type="text" class="js-quantity" value="<?php echo $quantity ?>" name="quantity">
					<div class="btn_plus btn_action btn_plus_product_sushi_card js-qty js-plus">+</div>
				</div>
			</div>
			<div class="product_card--promo">
				<div class="product_card--promo_dropdown">
					<input id="promo" type="hidden" name="promo">
					<span class="arrow"></span>
					<div class="product_card--promo_value">Выберите промокод</div>
					<?php
					$actions = new Actions('list');
					echo $actions->getCoupons();
					?>
				</div>
			</div>
		</div>
		<div class="product_card--outcome">
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt btn_main"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

			<div class="product_card--outcome_result">
				<h5 class="section_title"><?php echo $translations->getTranslation(["global", 'total']); ?></h5>
				<h6 class="section_title"><span id="product_total_price"><?php echo $product->regular_price ?></span>&nbsp;грн</h6>
			</div>
		</div>


		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
