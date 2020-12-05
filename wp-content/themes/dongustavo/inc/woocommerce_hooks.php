<?php
require_once get_template_directory() . '/classes/class-Cart.php';


$currentLang = 'uk';
$langs = pll_the_languages( array( 'raw' => 1 ) );
if(!empty($langs) and is_array($langs)) {
	foreach($langs as $l) {
		if($l['current_lang']) {
			$currentLang = $l['locale'];
		}
	}
}




add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart() {

	$product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
	$quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
	$variation_id = absint($_POST['variation_id']);
	$passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
	$product_status = get_post_status($product_id);

	if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

		do_action('woocommerce_ajax_added_to_cart', $product_id);

		if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
			wc_add_to_cart_message(array($product_id => $quantity), true);
		}

		WC_AJAX :: get_refreshed_fragments();
	} else {

		$data = array(
			'error' => true,
			'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

		echo wp_send_json($data);
	}

	wp_die();
}

add_action('wp_ajax_woocommerce_ajax_cart_quantity', 'woocommerce_ajax_change_quantity');
add_action('wp_ajax_nopriv_woocommerce_ajax_cart_quantity', 'woocommerce_ajax_change_quantity');


function woocommerce_ajax_change_quantity() {
	$cart = WC()->instance()->cart;
	$id = absint($_POST['product_id']);
//
//	$cart_id = $cart->generate_cart_id($id);
//	$cart_item_id = $cart->find_product_in_cart($cart_id);
	$cart_item_id = false;
	$quantity = stripslashes($_POST['quantity']);
	$newQuantity = 0;
	$cartQuantity = 0;
	foreach($cart->cart_contents as $cart_item_key => $cart_item) {
		if($cart_item['product_id'] == $id){
			$cart_item_id = $cart_item_key;
			$cartQuantity = $cart_item['quantity'];
		}
	}
	if($cart_item_id){
		if($cartQuantity !== 0) {
			switch($quantity) {
				case 'plus':
					$newQuantity = $cartQuantity + 1;
					break;
				case 'minus':
					$newQuantity = $cartQuantity - 1;
					break;
			}
		}

		if($cart->set_quantity($cart_item_id, $newQuantity)) {
			do_action('woocommerce_ajax_added_to_cart', $cart_item_id);

			if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
				wc_add_to_cart_message(array($cart_item_id => $newQuantity), true);
			}

			WC_AJAX :: get_refreshed_fragments();
		} else {

			$data = array(
				'error' => true,
				'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

			echo wp_send_json($data);
		};

	} else {
		$data = [$id, $cart_item_id, $quantity];
		echo wp_send_json($cart->cart_contents);
	}

	wp_die();
}

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' );
function woocommerce_custom_single_add_to_cart_text() {
	global $currentLang;
	if($currentLang == 'uk') {
		return __( 'В кошик', 'woocommerce' );
	} else {
		return __( 'В корзину', 'woocommerce' );
	}

}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );
function woocommerce_custom_product_add_to_cart_text() {
	global $currentLang;
	if($currentLang == 'uk') {
		return __( 'В кошик', 'woocommerce' );
	} else {
		return __( 'В корзину', 'woocommerce' );
	}
}

add_action('wp_ajax_dongustavo_cart_ajax_order', 'dongustavo_cart_ajax_order');
add_action('wp_ajax_nopriv_dongustavo_cart_ajax_order', 'dongustavo_cart_ajax_order');


function dongustavo_cart_ajax_order() {
	$cart = WC()->instance()->cart;
	$userData = $_POST['userData'];
	$order = $cart->get_cart();
	$cartClass = new Cart($userData, $order);

	echo wp_send_json($cartClass->send());

	wp_die();
}

add_action('wp_ajax_dongustavo_cart_apply_coupon', 'dongustavo_cart_apply_coupon');
add_action('wp_ajax_nopriv_dongustavo_cart_apply_coupon', 'dongustavo_cart_apply_coupon');

function dongustavo_cart_apply_coupon() {
	$ret = '{"status": 0}';
	if(!empty($_POST['couponcode'])) {
		$couponcode = stripslashes($_POST['couponcode']);
		WC()->cart->remove_coupons();
		$ret = '{"status" :'.WC()->cart->add_discount( $couponcode ).'}';
	}
	echo $ret;
	wp_die();
}

add_action('wp_ajax_dongustavo_cart_total', 'dongustavo_cart_total');
add_action('wp_ajax_nopriv_dongustavo_cart_total', 'dongustavo_cart_total');

function dongustavo_cart_total() {
	$ret = [
		'html' => WC()->cart->get_cart_total()
	];
	echo wp_send_json($ret);;
	wp_die();
}