<?php
require_once get_template_directory() . '/classes/class-TelegramApi.php';

class Cart {
	private $sender;
	private $user;
	private $order;
	private $sendData = array();
	private $cart;
	private $utm;

	public function __construct($user, $order, $cart, $utm) {
		$this->user = $user;
		$this->order = $order;
		$this->sender = new TelegramApi();
		$this->cart = $cart;
		$this->utm = $utm;
	}

	private function getAdditions($name) {
		$posts = get_posts(array(
			'numberposts'	=> 1,
			'post_type'		=> 'addings',
			'meta_key'		=> 'adding',
			'meta_value'	=> $name
		));
		return $posts[0]->post_title;
	}

	private function prepareOrder() {
		$products = array();
		foreach($this->order as $order) {
			$pr_id = ($order['variation_id'] == 0) ? $order['product_id'] : $order['variation_id'];
			$product = wc_get_product($pr_id);
			$tmp_product = array(
				'name' => $product->get_name(),
				'quantity' => $order['quantity'],
//				'price' => $product->get_price()
			);
			foreach($order as $k=>$value) {
				$p = stripos($k, 'wccpf_');
				if($p !== false and !empty($value['fname'])) {
					$tmp_product['additions'][] = $this->getAdditions($value['fname']);
				}
			}
			array_push($products, $tmp_product);
		}
		array_push($this->sendData, $products);
//		return $products;
	}

	private function prepareUser() {
		$userData = array();
		foreach($this->user as $user) {
			$userData['u_'.$user['name']] = $user['value'];
		}
		array_push($this->sendData, $userData);
	}


	/**
	 * @return mixed
	 */
	public function getUser() {
		return $this->user;
	}

	private function prepareUTM() {
		$utmData = array();
		if(!empty($this->utm) and is_array($this->utm)) {
			foreach($this->utm as $utm) {
				array_push($utmData, explode('=', $utm));
			}
			array_push($this->sendData, $utmData);
		}
	}

	public function send() {
		$this->prepareOrder();
		$this->prepareUser();
		$this->prepareUTM();
		$this->sender->setData($this->sendData);
		$this->sender->send();
		$this->cart->empty_cart();
		echo '{"status": "ok"}';
		die;
	}
}