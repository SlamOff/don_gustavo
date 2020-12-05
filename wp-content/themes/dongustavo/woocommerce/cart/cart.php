<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );

require_once get_template_directory() . '/classes/class-GustavoTranslations.php';
require_once get_template_directory() . '/classes/class-Addresses.php';
require_once get_template_directory() . '/classes/class-Additives.php';
require_once get_template_directory() . '/classes/class-Actions.php';

$translations = new GustavoTranslations();
$additions = new Additives();
$addresses = new Addresses();

function getAdditions($name) {
	$posts = get_posts(array(
		'numberposts'	=> 1,
		'post_type'		=> 'addings',
		'meta_key'		=> 'adding',
		'meta_value'	=> $name
	));
	return $posts[0]->post_title;
}
$appliedCoupon = WC()->cart->get_applied_coupons();
if(!empty($appliedCoupon) and !empty($appliedCoupon[0])) {
	$appliedCoupon = stripslashes($appliedCoupon[0]);
} else {
	$appliedCoupon = $translations->getTranslation(['global', 'promo']);
}
?>
<div class="card">
	<div class="container">
		<h3 class="section_title desktop_hidden"><?php echo $translations->getTranslation(['cart', 'title']) ?></h3>
		<div class="row card_wrapper">
			<div class="col-sm-6">
				<div class="card_form">
					<h3 class="section_title"><?php echo $translations->getTranslation(['cart', 'title']) ?></h3>
					<h4><?php echo $translations->getTranslation(['cart', 'subtitle']) ?></h4>
					<form method="POST" id="cardForm" novalidate="novalidate">
						<div class="row">
							<div class="col-sm-6">
								<input type="text" name="name" placeholder="<?php echo $translations->getTranslation(['cart', 'fields', 'name']) ?>" id="name">
							</div>
							<div class="col-sm-6">
								<input type="text" name="phone" placeholder="<?php echo $translations->getTranslation(['cart', 'fields', 'phone']) ?>" id="phone">
							</div>
						</div>
						<textarea name="message" placeholder="<?php echo $translations->getTranslation(['cart', 'fields', 'comment']) ?>"></textarea>
						<div class="row row_margin">
							<div class="col-sm-6">
								<label class="radio_input">
									<?php echo $translations->getTranslation(['cart', 'fields', 'd_address']) ?>
									<input type="radio" name="delivery" value="Доставка по адресу" id="delivery">
								</label>
								<div class="subinput">
									<div class="input_wrapper">
										<input type="text" name="street" placeholder="<?php echo $translations->getTranslation(['cart', 'fields', 'street']) ?>" id="street">
									</div>
									<div class="input_wrapper">
										<input type="text" name="house" placeholder="<?php echo $translations->getTranslation(['cart', 'fields', 'house']) ?>" id="house">
									</div>
									<div class="input_wrapper">
										<input type="number" name="entrance" placeholder="<?php echo $translations->getTranslation(['cart', 'fields', 'entrance']) ?>" id="entrance">
									</div>
									<div class="input_wrapper">
										<input type="number" name="apartment" placeholder="<?php echo $translations->getTranslation(['cart', 'fields', 'apartment']) ?>" id="apartment">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label class="radio_input radio_main">
									<?php echo $translations->getTranslation(['cart', 'fields', 'selfdelivery']) ?>
									<input type="radio" name="delivery" value="Самовывоз">
								</label>
								<div class="subinput">
									<?php foreach($addresses->getAddressesArray() as $address) { ?>
									<label class="radio_input subradio">
										<?php echo $address->post_title; ?>
										<input type="radio" name="selfdelivery" value="<?php echo $address->post_title; ?>">
									</label>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="row row_margin">
							<div class="col-sm-6">
								<label class="radio_input">
									<?php echo $translations->getTranslation(['cart', 'fields', 'payment_n']) ?>
									<input type="radio" name="payment" value="Оплата наличными">
								</label>
							</div>
							<div class="col-sm-6">
								<label class="radio_input">
									<?php echo $translations->getTranslation(['cart', 'fields', 'payment_c']) ?>
									<input type="radio" name="payment" value="Безналичная оплата">
								</label>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="product_card--promo">
									<div class="product_card--promo_dropdown">
										<input id="promo" type="hidden" name="promo" value="<?php echo $appliedCoupon; ?>">
										<span class="arrow"></span>
										<div class="product_card--promo_value"><?php echo $appliedCoupon; ?></div>
											<?php
												$actions = new Actions('list');
												echo $actions->getCoupons();
											?>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form_total_price">
									<?php echo $translations->getTranslation(['global', 'total']) ?>:
									<span><span id="totalPrice"><?php echo  WC()->cart->get_cart_total(); ?></span></span> грн
									<input type="hidden" name="totalSum" id="totalSum">
								</div>
							</div>
						</div>
						<button type="submit" class="btn_main"><?php echo $translations->getTranslation(['cart', 'button']) ?></button>
					</form>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card_total">
					<h4><?php echo $translations->getTranslation(['cart', 'order']) ?></h4>
					<div class="card_total--table">

					<?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
						<div class="card_total--table_item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<div class="card_total--table_column">
								<h6><?php echo $_product->get_name(); ?></h6>
								<div class="card_total--table_pict">
									<?php echo $_product->get_image(); ?>
									<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="delete" aria-label="%s" data-product_id="%s" data-product_sku="%s"></a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_html__( 'Remove this item', 'woocommerce' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
										),
										$cart_item_key
									);
									?>
								</div>
							</div>
							<div class="card_total--table_column">
								<h6><?php echo $translations->getTranslation(['global', 'price']) ?></h6>
								<span><span class="item_price"><?php echo WC()->cart->get_product_price( $_product ); ?></span> грн</span>
								<div class="product_card--added">
									<?php

									foreach($cart_item as $k=>$value) {
										$p = stripos($k, 'wccpf_');
										if($p !== false and !empty($value['fname'])) {
											$addition = $additions->getSingleAddition($value['fname']);
											if(!empty($addition)) {
												?>
												<div class="product_card--added_item shown" >
													<i>+</i>
													<span><?php echo $addition; ?></span>
												</div>
												<?php
											}
										}
									}
									?>

								</div>
							</div>
							<div class="card_total--table_column">
								<h6 class="desktop"><?php echo $translations->getTranslation(['global', 'count_full']) ?></h6>
								<h6 class="mobile"><?php echo $translations->getTranslation(['global', 'count_mobile']) ?></h6>
								<div class="quantity">
									<div class="btn_minus btn_minus_card card_btn btn_action disabled">-</div>
									<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = woocommerce_quantity_input(
											array(
												'input_name'   => "cart[{$cart_item_key}][qty]",
												'input_value'  => $cart_item['quantity'],
												'max_value'    => $_product->get_max_purchase_quantity(),
												'min_value'    => '0',
												'product_name' => $_product->get_name(),
											),
											$_product,
											false
										);
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
									?>
									<div class="btn_plus btn_plus_card card_btn btn_action">+</div>
								</div>
							</div>
							<div class="card_total--table_column">
								<h6><?php echo $translations->getTranslation(['global', 'total']) ?></h6>
								<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
							</div>
						</div>
<?php
							}
						}
//					new Cart($cartProducts);
						?>
						<div class="card_total--table_footer">
							<h5><?php echo $translations->getTranslation(['global', 'total']) ?>: <span><span id="total_price"><?php echo  WC()->cart->get_cart_total(); ?></span> грн</span></h5>
							<i><?php echo $translations->getTranslation(['cart', 'order_description']) ?></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<?php do_action( 'woocommerce_after_cart' ); ?>
