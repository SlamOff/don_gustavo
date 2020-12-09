<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
require_once get_template_directory() . '/classes/class-GustavoTranslations.php';
require_once get_template_directory() . '/classes/class-Additives.php';
global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$category = get_term($product->get_category_ids()[0], 'product_cat')->slug;
$isPizza = in_array($category, ['pizza', 'pizza-ru']);
$additives = new Additives();

$product_type = $product->get_type();
$variations = null;
if($product_type === "variable") {
	$variations = $product->get_available_variations();
	$defVariation = $product->get_default_attributes();
}
$productCategoryClass = ($isPizza)? 'category-pizza' : 'category-'.$category;
$translations = new GustavoTranslations();
?>
<div class="product_card <?php echo $productCategoryClass; ?>">
	<div class="container">
		<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'row ', $product ); ?>>
			<div class="col-sm-6">
			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
			?>
			</div>
			<div class="summary entry-summary col-sm-6">
				<div class="product_card--info <?php echo $product_type; ?>">
				<h3 class="product_card--name section_title"><?php echo $product->get_title(); ?></h3>

				<?php
				if($variations) {
					$re = '/\D+/gm'
					?>
					<h4 class="product_card--descr"><?php echo $product->get_short_description();  ?></h4>
				<div class="product_card--size ">
					<?php
					$activePrice = 0;
					foreach($variations as $variation) {
						$isActive = '';
						if($variation["attributes"]["attribute_pa_size"] == $defVariation['pa_size']) {
							$isActive = ' active';
							$activePrice = $variation['display_price'];
						} else {
							$isActive = '';
						}
						$size = strval(wc_attribute_label($variation['attributes']['attribute_pa_size']));
						$size = str_replace('-cm', '', $size);
						?>
						<div class="product_card--size_btn<?php echo $isActive;?> size_btn js-size-btn" data-price="<?php echo $variation['display_price'];?>" data-variation="<?php echo wc_attribute_label($variation['attributes']['attribute_pa_size']); ?>">
							<span class="product_size-"><?php echo $size;?></span>&nbsp;см&nbsp;&nbsp;
							<span class="product_weight-"><?php echo str_replace($re, '', $variation['weight']) ?></span>&nbsp;г&nbsp;&nbsp;
							<span><?php echo $variation['display_price'];?> грн</span>
						</div>
						<?php
					} ?>
				</div>
					<span id="variationprice" data-price="<?php echo $activePrice;?>"></span>
				<?php } else { ?>
					<h4 class="product_card--descr"><?php echo $product->get_short_description();  ?>
						<div class="product_card--weight mobile"><span><?php echo $product->weight ?></span> г</div>
					</h4>
				<?php }
				if($isPizza) {
					?>
					<div class="product_card--adds">
						<a href="#additives" class="scroll">
							<div class="product_card--adds_btn">
								<img src="<?php echo get_template_directory_uri(); ?>/img/additives.png" alt="">
								<span><?php echo $translations->getTranslation(['pdp', 'addAdditions']) ?></span>
							</div>
						</a>
						<div class="product_card--adds_title"><?php echo $translations->getTranslation(['pdp', 'additives']) ?></div>
						<div class="product_card--adds_price"><span class="js-adds-price">0</span><sup>грн</sup></div>
					</div>
					<div class="product_card--added js-adds"></div>
					<?php
				}
				?>

				<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */

				do_action( 'woocommerce_single_product_summary' );
				?>
			</div>
			</div>
		</div>

	</div>
</div>


<?php  do_action( 'woocommerce_after_single_product' ); ?>
<?php
if($isPizza) {
	echo $additives->render();
}

?>
<div class="often">
	<div class="container">
		<h3 class="section_title"><?php echo $translations->getTranslation(['plp', $category, 'related']) ?></h3>
		<div class="slider_wrapper row">
			<div class="often_slider">
				<?php echo do_shortcode('[products category=drinks]') ?>
			</div>
			<div class="arrows">
				<div class="prev"></div>
				<div class="next"></div>
			</div>
		</div>
	</div>
</div>
