<?php
require_once get_template_directory() . '/classes/class-GustavoTranslations.php';

class Actions {
	private $query = [];
	private $type = 'slider';
	private $translations;
	private $langPrefix;

	public function __construct($type = 'slider') {
		$this->query = [
			'post_type' => 'shop_coupon',
			'post_status' => 'publish',
			'numberposts' => 0,
			'posts_per_page' => 0
		];
		$this->type = $type;
		$this->translations = new GustavoTranslations();
		$this->langPrefix = $this->translations->currentLang !== 'uk' ? '_ru' : '';
	}


	private function renderSliderHtml() {
		$posts = get_posts($this->query);
		$html = '';
		if(!empty($posts)) {
			$html = '<div class="main_banner">
						<div class="slider_wrapper main_slider_wrapper">
							<div class="main_slider">';
			foreach($posts as $post) {
				$image = get_field('slider_image'.$this->langPrefix, $post->ID);
				$html .= '
				<picture>
					<source srcset="'.$image['sizes']['slider_mobile'].'" media="(max-width : 400px)">
					<img width="1500" height="550" src="'. $image['sizes']['slider'] .'" alt="'.$post->post_title.'">
				</picture>';
			}
			$html .= '</div>
						<div class="container main_slider_container">
							<a href="'. $this->translations->getTranslation(['global', 'actionsUrl']) .'" class="btn_main">'. $this->translations->getTranslation(['global', 'details']) .'</a>
							<div class="arrows">
								<div class="prev"></div>
								<div class="next"></div>
							</div>
						</div>
					</div>
				</div>';
		}
		return $html;
	}

	private function renderListHtml() {
		$posts = get_posts($this->query);
		$html = '';
		if(!empty($posts)) {
			$html = '<div class="promotion">
						<div class="container">';
			foreach($posts as $post) {
				$html .= '<div class="row">
                <div class="line"></div>
                <div class="col-sm-6">
                    <div class="promotion--pict">
						<img src="' . get_field('list_image'.$this->langPrefix, $post->ID) .'" alt="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="promotion--text">' . get_field('description'.$this->langPrefix, $post->ID) .'</div>
                </div>
			</div>';
			}
			$html .= '</div>
				</div>';
		}
		return $html;
	}

	public function getCoupons() {
		$html = null;
		$posts = get_posts($this->query);
		switch($this->type) {
			case 'array':
				$html = $posts;
				break;
			case 'list':
				$html = '<ul class="product_card--promo_list">';
				foreach($posts as $post) {
					$html .= "<li>{$post->post_title}</li>";
				}
				$html .= '</ul>';
				break;
		}
		return $html;
	}

	public function render() {
		$html = '';
		switch($this->type) {
			case 'slider':
				$html = $this->renderSliderHtml();
				break;
			case 'list':
				$html = $this->renderListHtml();
				break;
		}
		return $html;
	}
}