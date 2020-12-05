<?php


class Actions {
	private $query = [];
	private $type = 'slider';

	public function __construct($type = 'slider') {
		$this->query = [
			'post_type' => 'shop_coupon',
			'post_status' => 'publish',
			'numberposts' => 0,
			'posts_per_page' => 0
		];
		$this->type = $type;

	}


	private function renderSliderHtml() {
		$posts = get_posts($this->query);
		$html = '';
		if(!empty($posts)) {
			$html = '<div class="main_banner">
						<div class="slider_wrapper main_slider_wrapper">
							<div class="main_slider">';
			foreach($posts as $post) {
				$html .= '<img src="' . get_field('slider_image', $post->ID) .'" alt="">';
			}
			$html .= '</div>
						<div class="container main_slider_container">
							<a href="promotion.html" class="btn_main">Подробнее</a>
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
						<img src="' . get_field('list_image', $post->ID) .'" alt="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="promotion--text">' . get_field('description', $post->ID) .'</div>
                </div>
			</div>';
			}
			$html .= '</div>
				</div>';
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