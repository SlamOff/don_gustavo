<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Don_Gustavo
 * @since Don Gustavo 1.0
 */

?>
<footer class="footer">
	<div class="container">
		<div class="footer_wrapper">
			<div class="contact">
				<h3 class="section_title section_title--white">Контакты</h3>
				<div class="contact_item">
					<img src="<?php echo get_template_directory_uri(); ?>/img/location.png" alt="">
					<p>г. Черновцы <br />ул. Небесной сотни, 19Е <br />ул. Соборная площадь, 1</p>
				</div>
				<div class="contact_item">
					<img src="<?php echo get_template_directory_uri(); ?>/img/mobile.png" alt="">
					<a class="footer_tel" onclick="gtag('event', 'tel1');" href="tel:+380666266808">+380 (66) 626 68 08</a>
					<a class="footer_tel" onclick="gtag('event', 'tel2');" href="tel:+380666757185">+380 (66) 675 71 85</a>
				</div>
			</div>
			<div class="payment">
				<h3 class="section_title section_title--white">Способы оплаты:</h3>
				<img class="payment_icon" src="<?php echo get_template_directory_uri(); ?>/img/payment-icon.png" alt="">
				<p>Оплата при доставке наличными <br />или картами банка Visa и Mastercard</p>
				<img class="liqpay" src="<?php echo get_template_directory_uri(); ?>/img/liqpay.png" alt="" class="">
				<strong>Скачивайте мобильное приложение для заказа онлайн:</strong>
				<a target="_blank" href="https://apps.apple.com/ua/app/don-gustavo/id1476704675?l=ru"><img class="app-store" src="<?php echo get_template_directory_uri(); ?>/img/apple-store.png" alt=""></a>
				<a target="_blank" href="https://play.google.com/store/apps/details?id=ua.com.wl.dongustavo"><img class="app-store" src="<?php echo get_template_directory_uri(); ?>/img/google-store.png" alt=""></a>
			</div>
			<div class="map">
				<h3 class="section_title section_title--white">Карта сайта</h3>
				<ul class="map_list">
					<li><a href="promotion.html">Акции</a></li>
					<li><a href="index.html">Пицца</a></li>
					<li><a href="sushi.html">Суши</a></li>
					<li><a href="drink.html">Напитки</a></li>
					<li><a href="review.html">Отзывы</a></li>
				</ul>
			</div>
		</div>
		<div class="footer_bottom">
			<div class="footer_logo">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo-dark.jpg" alt="">
			</div>
			<div class="policy">
				<a class="popup" href="#politics">Политика конфиденциальности</a>
				<p>&copy; <script type="text/javascript">var mdate = new Date(); document.write(mdate.getFullYear());</script> “Don Gustavo Pizzeria”. Все права защищены</p>
			</div>
			<div class="made_by">
				Проект <br />разработан:
				<a target="_blank" href="https://kornienko-studio.marketing "><img src="<?php echo get_template_directory_uri(); ?>/img/logo-dev.png" alt=""></a>
			</div>
		</div>
	</div>
</footer>

		<?php wp_footer(); ?>

	</body>
</html>
