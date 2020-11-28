<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Don_Gustavo
 * @since Don Gustavo 1.0
 */
if(is_product_category() or is_front_page()) {
	global $wp_query;
	$cat = $wp_query->get_queried_object()->slug;


	$translations = new GustavoTranslations();

	if(in_array($cat, ['pizza', 'pizza-ru', 'sushi', 'sushi-ru']) or is_front_page()) {
		require_once(get_template_directory().'/classes/class-Actions.php');
		$slider = new Actions('slider');
		echo $slider->render();

		?>
		<div class="work_time_wrapper">
			<div class="container">
				<div class="row">
					<div class="work_time">
						<div class="col-md-3 time">
							<h6>График работы:</h6>
							<span>10:00 — 22:00</span>
						</div>
						<div class="col-md-6 payment">
							Оплата при доставке наличными или картами банка Visa и Mastercard
						</div>
						<div class="col-md-3">
							<a href="" class="btn_main">Регион доставки</a>
						</div>
					</div>

				</div>
			</div>
		</div>
		<?php
	}

}


the_content();




