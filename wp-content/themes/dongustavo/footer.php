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
$translations = new GustavoTranslations();
require_once get_template_directory() . '/classes/class-Addresses.php';
$addresses = new Addresses();
$cate = get_queried_object();
if(!empty($cate->taxonomy) and $cate->taxonomy == 'product_cat' and in_array($cate->slug, ['sushi', 'sushi-ru'])) :
?>
<div class="delivery">
	<?php echo $translations->getTranslation(['plp', $cate->slug, 'seoText']); ?>
</div>
	<figure class="wp-block-gallery columns-5 is-cropped">
		<ul class="blocks-gallery-grid">
			<li class="blocks-gallery-item">
				<figure>
					<img loading="lazy" width="375" height="240"
					     src="/wp-content/uploads/2020/12/photo-1.jpg" alt="" data-id="301"
					     data-full-url="/wp-content/uploads/2020/12/photo-1.jpg"
					     data-link="http://www.dongustavo.com.ua/ru/%d0%b3%d0%bb%d0%b0%d0%b2%d0%bd%d0%b0%d1%8f/photo-1/"
					     class="wp-image-301"
					     srcset="/wp-content/uploads/2020/12/photo-1.jpg 375w, /wp-content/uploads/2020/12/photo-1-300x192.jpg 300w"
					     sizes="(max-width: 375px) 100vw, 375px">
				</figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img loading="lazy" width="390" height="240"
				             src="/wp-content/uploads/2020/12/photo-2.jpg" alt=""
				             data-id="302"
				             data-full-url="/wp-content/uploads/2020/12/photo-2.jpg"
				             data-link="http://www.dongustavo.com.ua/ru/%d0%b3%d0%bb%d0%b0%d0%b2%d0%bd%d0%b0%d1%8f/photo-2/"
				             class="wp-image-302"
				             srcset="/wp-content/uploads/2020/12/photo-2.jpg 390w, /wp-content/uploads/2020/12/photo-2-300x185.jpg 300w"
				             sizes="(max-width: 390px) 100vw, 390px"></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img loading="lazy" width="390" height="240"
				             src="/wp-content/uploads/2020/12/photo-3.jpg" alt=""
				             data-id="303"
				             data-full-url="/wp-content/uploads/2020/12/photo-3.jpg"
				             data-link="http://www.dongustavo.com.ua/ru/%d0%b3%d0%bb%d0%b0%d0%b2%d0%bd%d0%b0%d1%8f/photo-3/"
				             class="wp-image-303"
				             srcset="/wp-content/uploads/2020/12/photo-3.jpg 390w, /wp-content/uploads/2020/12/photo-3-300x185.jpg 300w"
				             sizes="(max-width: 390px) 100vw, 390px"></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img loading="lazy" width="390" height="240"
				             src="/wp-content/uploads/2020/12/photo-4.jpg" alt=""
				             data-id="304"
				             data-full-url="/wp-content/uploads/2020/12/photo-4.jpg"
				             data-link="http://www.dongustavo.com.ua/ru/%d0%b3%d0%bb%d0%b0%d0%b2%d0%bd%d0%b0%d1%8f/photo-4/"
				             class="wp-image-304"
				             srcset="/wp-content/uploads/2020/12/photo-4.jpg 390w, /wp-content/uploads/2020/12/photo-4-300x185.jpg 300w"
				             sizes="(max-width: 390px) 100vw, 390px"></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img loading="lazy" width="376" height="240"
				             src="/wp-content/uploads/2020/12/photo-5.jpg" alt=""
				             data-id="305" data-full-url="/wp-content/uploads/2020/12/photo-5.jpg"
				             data-link="http://www.dongustavo.com.ua/ru/%d0%b3%d0%bb%d0%b0%d0%b2%d0%bd%d0%b0%d1%8f/photo-5/"
				             class="wp-image-305"
				             srcset="/wp-content/uploads/2020/12/photo-5.jpg 376w, /wp-content/uploads/2020/12/photo-5-300x191.jpg 300w"
				             sizes="(max-width: 376px) 100vw, 376px"></figure>
			</li>
		</ul>
	</figure>
<?php endif; ?>
<footer class="footer">
	<div class="container">
		<div class="footer_wrapper">
			<div class="contact">
				<h3 class="section_title section_title--white"><?php echo $translations->getTranslation(['footer', 'contacts']);?></h3>
				<div class="contact_item">
					<img src="<?php echo get_template_directory_uri(); ?>/img/location.png" alt="">
					<p><?php echo $translations->getTranslation(['global', 'city']);?>
						<?php foreach($addresses->getAddressesArray() as $address) { ?>
							<br />
								<?php echo $address->post_title; ?>
						<?php } ?>
						</p>
				</div>
				<div class="contact_item">
					<img src="<?php echo get_template_directory_uri(); ?>/img/mobile.png" alt="">
					<a class="footer_tel" onclick="gtag('event', 'tel1');" href="tel:+380666266808">+380 (66) 626 68 08</a>
					<a class="footer_tel" onclick="gtag('event', 'tel2');" href="tel:+380666757185">+380 (66) 675 71 85</a>
				</div>
			</div>
			<div class="payment">
				<h3 class="section_title section_title--white"><?php echo $translations->getTranslation(['footer', 'payment_title']);?></h3>
				<img class="payment_icon" src="<?php echo get_template_directory_uri(); ?>/img/payment-icon.png" alt="">
				<p><?php echo $translations->getTranslation(['footer', 'payment']);?></p>
				<img class="liqpay" src="<?php echo get_template_directory_uri(); ?>/img/liqpay.png" alt="" class="">
				<strong><?php echo $translations->getTranslation(['footer', 'app']);?></strong>
				<a target="_blank" href="https://apps.apple.com/ua/app/don-gustavo/id1476704675?l=ru"><img class="app-store" src="<?php echo get_template_directory_uri(); ?>/img/apple-store.png" alt=""></a>
				<a target="_blank" href="https://play.google.com/store/apps/details?id=ua.com.wl.dongustavo"><img class="app-store" src="<?php echo get_template_directory_uri(); ?>/img/google-store.png" alt=""></a>
			</div>
			<div class="map">
				<h3 class="section_title section_title--white"><?php echo $translations->getTranslation(['footer', 'site_map']);?></h3>
				<?php if ( is_active_sidebar( 'footer-menu' ) ) :
				dynamic_sidebar( 'footer-menu' );
				endif; ?>
			</div>
		</div>
		<div class="footer_bottom">
			<div class="footer_logo">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo-dark.jpg" alt="">
			</div>
			<div class="policy">
				<a class="popup" href="#politics"><?php echo $translations->getTranslation(['footer', 'politics']);?></a>
				<p>&copy; <script type="text/javascript">var mdate = new Date(); document.write(mdate.getFullYear());</script> “Don Gustavo Pizzeria”. <?php echo $translations->getTranslation(['footer', 'rights']);?></p>
			</div>
			<div class="made_by">
				<?php echo $translations->getTranslation(['footer', 'development']);?>
				<a target="_blank" href="https://kornienko-studio.marketing "><img src="<?php echo get_template_directory_uri(); ?>/img/logo-dev.png" alt=""></a>
			</div>
		</div>
	</div>
</footer>
<div class="hidden">
	<div class="politics" id="politics">
		<h3><?php echo $translations->getTranslation(['footer', 'politics']);?></h3>
		<div class="politics_text">
			<p>
				Ваша конфиденциальность очень важна для нас. Мы хотим, чтобы Ваша работа в Интернет по возможности была максимально приятной и полезной, и Вы совершенно спокойно использовали широчайший спектр информации, инструментов и возможностей, которые предлагает Интернет.<br><br>
				Личная информация Членов, собранная при регистрации (или в любое другое время) преимущественно используется для подготовки Продуктов или Услуг в соответствии с Вашими потребностями. Ваша информация не будет передана или продана третьим сторонам. Однако мы можем частично раскрывать личную информацию в особых случаях, описанных в «Согласии с рассылкой»<br><br>
				<b>Какие данные собираются на сайте</b><br>
				При добровольной регистрации на получение рассылки «Инсайдер интернет предпринимателя» вы отправляете свое Имя и E-mail через форму регистрации.<br><br>
				<b>С какой целью собираются эти данные</b><br>
				Имя используется для обращения лично к вам, а ваш e-mail для отправки вам писем рассылок, новостей тренинга, полезных материалов, коммерческих предложений.<br>
				Ваши имя и e-mail не передаются третьим лицам, ни при каких условиях кроме случаев, связанных с исполнением требований законодательства. Ваше имя и e-mail на защищенных серверах сервиса getresponse.com и используются в соответствии с его политикой конфиденциальности.<br><br>
				Вы можете отказаться от получения писем рассылки и удалить из базы данных свои контактные данные в любой момент, кликнув на ссылку для отписки, присутствующую в каждом письме.<br><br>
				<b>Как эти данные используются</b><br>
				На сайте www.site.com используются куки (Cookies) и данные о посетителях сервиса Google Analytics.<br><br>
				При помощи этих данных собирается информация о действиях посетителей на сайте с целью улучшения его содержания, улучшения функциональных возможностей сайта и, как следствие, создания качественного контента и сервисов для посетителей.<br><br>
				Вы можете в любой момент изменить настройки своего браузера так, чтобы браузер блокировал все файлы cookie или оповещал об отправке этих файлов. Учтите при этом, что некоторые функции и сервисы не смогут работать должным образом.<br><br>
				<b> Как эти данные защищаются</b><br>
				Для защиты Вашей личной информации мы используем разнообразные административные, управленческие и технические меры безопасности. Наша Компания придерживается различных международных стандартов контроля, направленных на операции с личной информацией, которые включают определенные меры контроля по защите информации, собранной в Интернет.<br><br>
				Наших сотрудников обучают понимать и выполнять эти меры контроля, они ознакомлены с нашим Уведомлением о конфиденциальности, нормами и инструкциями.<br><br>
				Тем не менее, несмотря на то, что мы стремимся обезопасить Вашу личную информацию, Вы тоже должны принимать меры, чтобы защитить ее.<br><br>
				Мы настоятельно рекомендуем Вам принимать все возможные меры предосторожности во время пребывания в Интернете. Организованные нами услуги и веб-сайты предусматривают меры по защите от утечки, несанкционированного использования и изменения информации, которую мы контролируем. Несмотря на то, что мы делаем все возможное, чтобы обеспечить целостность и безопасность своей сети и систем, мы не можем гарантировать, что наши меры безопасности предотвратят незаконный доступ к этой информации хакеров сторонних организаций.<br><br>
				В случае изменения данной политики конфиденциальности вы сможете прочитать об этих изменениях на этой странице или, в особых случаях, получить уведомление на свой e-mail.<br><br>
				Для связи с администратором сайта по любым вопросам вы можете написать письмо на e-mail: test@gmail.com
			</p>
		</div>
	</div>
</div>
		<?php wp_footer(); ?>

	</body>
</html>
