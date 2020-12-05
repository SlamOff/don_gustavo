<?php
function showActionsSlider($atts) {
	require_once(get_template_directory().'/classes/class-Actions.php');

	$slider = new Actions('slider');
	return $slider->render();
}
add_shortcode('actions_slider', 'showActionsSlider');

function showActionsList($atts) {
	require_once(get_template_directory().'/classes/class-Actions.php');

	$slider = new Actions('list');
	return $slider->render();
}
add_shortcode('gustavo_actions', 'showActionsList');

//function showProducts($atts) {
//	require_once(get_template_directory().'/classes/class-Actions.php');
//
//	$slider = new Actions('list');
//	return $slider->render();
//}
//add_shortcode('gustavo_products', 'showActionsList');