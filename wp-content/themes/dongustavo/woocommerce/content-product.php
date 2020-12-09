<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$category = get_term($product->get_category_ids()[0], 'product_cat')->slug;
$isPizza = in_array($category, ['pizza', 'pizza-ru']);
$isDrink = in_array($category, ['drinks', 'drinks-ru']);
//var_dump($product);
//die;
$product_type = $product->get_type();
$variations = null;
if($product_type === "variable") {
	$variations = $product->get_available_variations();
	$defVariation = $product->get_default_attributes();
}
$translations = new GustavoTranslations();
$dataWeight = '';
$dataPrice = '';
$divPrice = '<div class="product_item--price"><div class="price"><span>'.$product->get_price('view').'</span>&nbsp;грн</div>';

if($variations) {
	$divWeight = '<div class="product_item--weight js-weight">';
	$divSize = '<div class="product_item--size js-size">';
	$divPrice = '<div class="product_item--price">';
	$dataWeight = '';
	$dataPrice = '';
	$i = 0;
	$len = count($variations);
	foreach($variations as $variation) {
//		var_dump($variation['variation_id']);
//		die;
		$isLast = '';
		$isActive = '';
		$coma = ',';
		if($variation["attributes"]["attribute_pa_size"] == $defVariation['pa_size']) {
			$isActive = ' active';
			$divWeight .= '<span>'.$translations->getTranslation(["plp", $category, 'weight']).':&nbsp;<span class="weight">'.$variation['weight'].'</span>&nbsp;г</span>';
			$divPrice .= '<div class="price"><span>'.$variation['display_price'].'</span>&nbsp;грн</div>';
		} else {
			$isActive = '';
		}

		if ($i === $len - 1) {
			$coma = '';
			$isLast = ($i !== 0) ? ' second_size' : '';
		}
		$dataWeight .= $variation['weight'].$coma;
		$dataPrice .= $variation['display_price'].$coma;
		$divSize .= '<span class="size_btn'.$isActive.$isLast.'" data-variation_id="'.$variation['variation_id'].'" data-size="'.wc_attribute_label($variation['attributes']['attribute_pa_size']).'">'.str_replace('-', ' ', wc_attribute_label($variation['attributes']['attribute_pa_size'])).'</span>';
		$i ++;
	}
	$divWeight .= '</div>';
	$divSize .= '</div>';
//	$divPrice .= '</div>';

}


?>
<?php if($isDrink): ?>
	<div class="col-md-3 drink-item">
		<div class="often_item">
			<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
		</div>
		<h4 class="often_title"><?php the_title(); ?></h4>
		<div class="often_item--footer">
			<div class="often_item--footer_price">
				<?php echo $product->get_price();?> грн
			</div>
			<div class="choose">
				<div class="g-quantity">
					<div class="btn_minus btn_action">-</div>
					<input disabled="" type="text" value="1" name="quantity">
					<div class="btn_plus btn_action">+</div>
				</div>
				<?php

					do_action( 'woocommerce_after_shop_loop_item' );
				?>
			</div>

		</div>
	</div>
<?php else: ?>
<div class="col-sm-6 col-md-4">
	<div class="product_item" data-weight="[<?php echo $dataWeight ?>]" data-price="[<?php echo $dataPrice ?>]">
		<a href="<?php echo $product->get_permalink(); ?>">
		<?php

		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
	//	do_action( 'woocommerce_before_shop_loop_item' );
		?>
			<h4 class="product_item--name"><?php the_title(); ?></h4>
			<div class="product_item--pict">
				<div class="added_to_cart"><img src="<?php echo get_template_directory_uri(); ?>/img/shopping-cart.png" alt=""></div>

				<img class="product-image" src="<?php the_post_thumbnail_url('product_thumbnail'); ?>"  alt="<?php the_title(); ?>" />
				<?php if($variations) {
					echo $divWeight.$divSize;
				}  ?>

			</div>
		</a>
		<div class="product_item--footer">
			<div class="product_item--descr">
				<p><?php echo $product->get_short_description( 'view' ); ?></p>
				<?php if($isPizza): ?>
				<a href="<?php echo $product->get_permalink(); ?>"><?php echo $translations->getTranslation(["plp", $category, 'add_components'])?>&gt;&gt;&gt;</a>
				<?php endif; ?>
			</div>
			<?php echo $divPrice; ?>
			<div class="choose">
				<div class="g-quantity">
					<div class="preloader"></div>
					<div class="btn_minus btn_action">-</div>
					<input disabled="" type="text" value="1" name="quantity">
					<div class="btn_plus btn_action">+</div>
				</div>
				<?php
				if($product_type === "variable") {
					woocommerce_variable_add_to_cart();
				} else {
					do_action( 'woocommerce_after_shop_loop_item' );
				}
				?>
			</div>
		</div>
		</div>
	<?php


	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
//	do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
//	do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );




	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	?>


	</div>
</div>
<?php endif;