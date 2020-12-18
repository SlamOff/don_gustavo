<?php


class Addresses {
	private $query = [
		'post_type' => 'addresses',
		'post_status' => 'publish',
		'numberposts' => 0,
		'posts_per_page' => 0
	];
	public function __construct() {

	}

	public function getAddressesArray() {
		return get_posts($this->query);
	}
}