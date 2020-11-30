<?php

function gustavo_getTranslation($arg=array()) use ($gustavo_Translations) {
	$gustavo_Translations = [
		"header" => [],
		"plp" => [
			"pizza" => [
				"title" => [
					"ru" => 'Выбирайте из более %count% вида пицц с возможностью компоновки ингредиентов',
					"uk" => 'Вибирайте з більш ніж %count% видів піц з можливістю додавання інгридієнтів'
				]
			],
			"sushi" => [
				"title" => [
					"ru" => 'Выбирайте из более %count% видов роллов и сетов в нашем ассортименте',
					"uk" => 'Вибирайте з більш ніж %count% видів ролів та сетів в нашому асортименті'
				]
			]
		],
		"pdp" => []
	];
	return preg_replace_callback('/{([\d\w]+)}/m', function($matches) use ($arg) {
		return $arg[$matches[1]];
	}, $gustavo_Translations);
}