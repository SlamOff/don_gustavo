<?php
class Additives {
	private $query = array(
		'post_type' => 'addings',
		'post_status' => 'publish',
		'numberposts' => 0,
		'posts_per_page' => 0
	);
	private $additivesCount = 0;
	private $translate;

	public function __construct() {
		$this->translate = new GustavoTranslations();
	}

	private function getAdditives() {
		$additives = [];
		$tmp_additives = get_posts($this->query);
		if(!empty($tmp_additives)) {
			foreach($tmp_additives as $additive) {
				$additives[$additive->ID] = [
					'name' => get_field('name', $additive->ID),
					'additive' => get_field('adding', $additive->ID),
					'image' => get_the_post_thumbnail_url($additive->ID, 'product_additives'),
					'weight' => get_field('weight', $additive->ID),
					'price' => get_field('price', $additive->ID)
				];
			}
		}
		$this->additivesCount = count($tmp_additives);
		return $additives;
	}

	public function render() {
		$additives = $this->getAdditives();
		if($this->additivesCount == 0) {
			return '';
		}
		$html = '<div class="additives" id="additives">
					<div class="container">
						<h3 class="section_title">'. $this->translate->getTranslation(["pdp", 'additives_title'], ['count' => $this->additivesCount - 1]) .'</h3>
						<div class="row js-additives">';
				foreach($additives as $additive) {
					$html .=    '<div class="col-md-2">
									<div class="additives_item js-additive" data-id="'. $additive['additive'] .'" data-price="'. $additive['price'] .'">
										<span class="label_added">'. $this->translate->getTranslation(["pdp", 'additives_added']) .'</span>
										<h3 class="additives_item--title">'. $additive['name'] .'</h3>
										<img src="'. $additive['image'] .'" alt="'. $additive['name'] .'" class="additives_item--pict">
										<div class="additives_item--info">
											<div class="additives_item--info_weight">'. $additive['weight'] .' г</div>
											<div class="additives_item--info_size"><span>'. $additive['price'] .'</span> &nbsp;грн</div>
										</div>
									</div>
								</div>';
				}


		$html .=				'</div>
					</div>
				</div>';
		return $html;
	}
	public function getSingleAddition($name) {
		$q = $this->query;
		$q['numberposts']	= 1;
		$q['meta_key']		= 'adding';
		$q['meta_value']	= $name;
		$posts = get_posts($q);
		return $posts[0]->post_title;
	}
}