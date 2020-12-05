<?php


class TelegramApi {
	protected $token = '1424949574:AAE0s-rK5y2y5MpUKdJiJMtkBuZs-R2rVuA';
	protected $chatId = '-429036341';
	private $msg = '';
	private $data;

	public function __construct() {

	}

	private function sendToApi() {
//		$response = array(
//			'chat_id' => $this->chatId,
//			'parse_mode' => 'html',
//			'text' => $this->msg
//		);
//		$ch = curl_init('https://api.telegram.org/bot'. $this->token .'/sendMessage');
//		curl_setopt($ch, CURLOPT_POST, 1);
//		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//		curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
//		curl_setopt($ch, CURLOPT_HEADER, false);
//		$result = curl_exec($ch);
//		curl_close($ch);
//		return $result;
		return fopen("https://api.telegram.org/bot{$this->token}/sendMessage?chat_id={$this->chatId}&parse_mode=html&text={$this->msg}", "r");
	}

	private function prepareMsg() {
		$names = [
			'name'=>'Товар',
			'quantity'=>'Количество',
			'u_name'=> 'Имя',
			'u_phone'=>'Тел.',
			'u_message'=>'Сообщение',
			'u_delivery'=>'Доставка',
			'u_street'=>'Улица',
			'u_house'=>'Дом',
			'u_entrance'=>'Парадное',
			'u_apartment'=>'Квартира',
			'u_payment'=>'Оплата',
			'u_promo'=>'Купон'
		];
		$j = 1;
		$this->msg = '<b>Заказ с сайта:</b>%0A';
		foreach($this->data[0] as $key=>$values) {
			$this->msg .= $j.') ';
			foreach($values as $k=>$value) {
				if(is_array($value)) {
					$this->msg .= '<b>Добавки: </b>';
					foreach($value as $i=>$v) {
						$coma = ($i + 1 == count($value)) ? ';' : ', ';
						$this->msg .= '<i>'.$v.$coma.'</i>';
					}
					$this->msg .= '%0A';
				} else {
					$this->msg .= '<b>'.$names[$k].': </b>'.$value.'%0A';
				}
			}
			$j ++;
			$this->msg .= '%0A';
		}
		$this->msg .= '<b>Клиент:</b>%0A';
		foreach($this->data[1] as $k=>$value) {
			$this->msg .= '<b>'.$names[$k].'</b>: '.$value.'%0A';
		}
	}

	/**
	 * @param mixed $data
	 */
	public function setData($data): void {
		$this->data = $data;
	}

	public function send() {
		$this->prepareMsg();
		return $this->sendToApi();
	}
}