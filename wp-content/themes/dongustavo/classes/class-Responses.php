<?php


class GustavoResponses {

	private $query = array(
		'post_type' => 'responses',
		'post_status' => 'publish',
		'numberposts' => 0,
		'posts_per_page' => 0
	);
	private $translations;

	public function __construct() {
		$this->translations = new GustavoTranslations();
	}

	public function render() {
		$responses = get_posts($this->query);
		$html = '';
		if(!empty($responses)) {
			$html = '<div class="review">
	        <div class="container">
	            <h3 class="section_title">'. $this->translations->getTranslation(["responses", "title"]) .'</h3>
	            <div class="slider_wrapper row">
	                <div class="arrows">
	                    <div class="prev"></div>
	                    <div class="next"></div>
	                </div>
	                <div class="review_slider">
	                    
	                ';

			foreach($responses as $response) {
				$html .= '<div class="col-md-3">
	                        <div class="review_item">
	                            <img src="'. get_the_post_thumbnail_url($response->ID, 'response') .'" alt="'.$response->post_title.'">
	                        </div>
	                    </div>';
			}
			$html .= '</div>
		            </div>
		        </div>
		    </div>';
		}
		return $html;
	}
}