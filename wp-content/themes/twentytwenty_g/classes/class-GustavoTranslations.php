<?php

class GustavoTranslations {
	private $translations = [
		"header" => [],
		"plp" => [
			"pizza" => [
				"title" => [
					"ru_RU" => 'Выбирайте из более %count% вида пицц <br> с возможностью компоновки ингредиентов',
					"uk" => 'Вибирайте з більш ніж %count% видів піц <br> з можливістю додавання інгридієнтів'
				],
				"weight" => [
					"ru_RU" => 'Вес',
					"uk" => 'Вага'
				],
				"add_components" => [
					"ru_RU" => 'Добавить компоненты',
					"uk" => 'Вибрати додатки'
				]
			],
			"sushi" => [
				"title" => [
					"ru_RU" => 'Выбирайте из более %count% видов роллов и сетов в нашем ассортименте',
					"uk" => 'Вибирайте з більш ніж %count% видів ролів та сетів в нашому асортименті'
				]
			],
			"drinks" => [
				"title" => [
					"ru_RU" => 'Выберите напиток, который идеально подойдет для пиццы и роллов',
					"uk" => 'Виберіть напій, який ідеально підійде для піци та ролів'
				]
			]
		],
		"pdp" => []
	];
	private $currentLang = null;

	public function __construct() {
		$langs = pll_the_languages( array( 'raw' => 1 ) );
		foreach($langs as $l) {
			if($l['current_lang']) {
				$this->currentLang = $l['locale'];
			}
		}
	}

	public function getTranslation($type=array(), $arg=array()) {
		$template = null;
		$re = '/-ru$/s';
		foreach($type as $key=>$t) {

			if($key === 0) {
				$template = $this->translations[$t];
			} else {
				$part = preg_replace($re, '', $t);
				$template = (!empty($template)) ? $template[$part] : null;
			}
		}

		$template = (!empty($template)) ? $template[$this->currentLang] : null;

		return preg_replace_callback('/%(\w+)%/m', function($matches) use ($arg) {
			return $arg[$matches[1]];
		}, $template);
	}


}