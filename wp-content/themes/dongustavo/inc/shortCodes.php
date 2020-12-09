<?php
require_once(get_template_directory().'/classes/class-Actions.php');
require_once(get_template_directory().'/classes/class-Responses.php');

function showActionsSlider($atts) {
	$slider = new Actions('slider');
	return $slider->render();
}
add_shortcode('actions_slider', 'showActionsSlider');

function showActionsList($atts) {
	$slider = new Actions('list');
	return $slider->render();
}
add_shortcode('gustavo_actions', 'showActionsList');

function showResponses($atts) {
	$responses = new GustavoResponses();

	return $responses->render();
}
add_shortcode('gustavo_responses', 'showResponses');


//function showProducts($atts) {
//	require_once(get_template_directory().'/classes/class-Actions.php');
//
//	$slider = new Actions('list');
//	return $slider->render();
//}
//add_shortcode('gustavo_products', 'showActionsList');