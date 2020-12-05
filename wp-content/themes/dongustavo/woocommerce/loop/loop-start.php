<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;
$cat_obj = $wp_query->get_queried_object();

$category = (is_front_page()) ? 'pizza' : $cat_obj->slug;
$count = $cat_obj->count;


if($count < 10) {
	$count = 21;
} else {
	$count = $count - 1;
}

$translations = new GustavoTranslations();
$_title = $translations->getTranslation(["plp", $category, 'title'], ['count' => $count])
?>
<?php if(in_array($category, ['drinks', 'drinks-ru'])): ?>
<div class="drink">
<?php endif; ?>
<div class="product product-list">
	<div class="container">
		<h3 class="section_title"><?php echo $_title; ?></h3>