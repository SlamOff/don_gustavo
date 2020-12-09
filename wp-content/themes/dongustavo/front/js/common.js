jQuery(document).ready(function($) {
	new WOW().init();
	new Pdp();
	new Plp();
	new Cart();
	// Clamp Product decription 
	$('.product_item--descr p').each(function(i, el){
		$clamp(el, {clamp: 2});
	});
	
	// remove placeholder after click
	$('input, textarea').focus(function(){
		$(this).data('placeholder', $(this).attr('placeholder'))
		$(this).attr('placeholder', '');
	});
	$('input, textarea').blur(function(){
		$(this).attr('placeholder', $(this).data('placeholder'));
	});

	$(document).on('click', '.shopping_cart.empty', function(e){
		e.preventDefault();
	});

	function getScroll() {
		return window.pageYOffset || document.documentElement.scrollTop;
	}

	function changeLogoSize() {
		if(getScroll() > 0) {
			$('.logo').addClass('scrolled');
		}
		else {
			$('.logo').removeClass('scrolled');
		}
	}

	// Fixed Header
	$(window).on('scroll', function(){
		changeLogoSize()
	});
	$(window).on('load', function(){
		changeLogoSize();
		// setCardPrice();
	});

	// Burger
	$('.phone_icon').on('click', function(){
		var phone = $('.phone_menu');
		if(phone.is(':visible')){
			phone.fadeOut();
		}
		else {
			phone.fadeIn();
		}
	});

	$('.burger').on('click', function(){
		$('body').addClass('fixed');
		$('.mobile_menu_overlay').fadeIn();
	});

	$('.close').on('click', function(){
		$('body').removeClass('fixed');
		$('.mobile_menu_overlay').fadeOut();
	});

	// scroll to ID
	$('.scroll').click( function(){
	var scrollEl = $(this).attr('href');
		if ($(scrollEl).length != 0) {
			$('html, body').animate({ scrollTop: $(scrollEl).offset().top }, 800);
		}
		return false;
	});

	// mask
	jQuery(function($){
		$('#phone').mask('+38(099) 999-9999');
	});

	// slick carousel
	$('.main_slider').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		nextArrow: '.next',
		prevArrow: '.prev',
		autoplay: true,
		pauseOnHover: true,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					arrows: false,
					dots: true
				}
			}
		]
	});

	$('.single-product .product-list .container').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		nextArrow: '.next',
		prevArrow: '.prev',
		autoplay: false,
		infinite: false,
		pauseOnHover: true,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
					arrows: false,
					dots: true
				}
			},
			{
				breakpoint: 580,
				settings: {
					slidesToShow: 1,
					arrows: false,
					dots: true
				}
			}
		]
	});

	$('.review_slider').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		nextArrow: '.next',
		prevArrow: '.prev',
		autoplay: true,
		pauseOnHover: true,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 580,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});
	
	let utm = [];
	document.location.search.replace('?', '').split('&').forEach(el => {
		if(el.indexOf('utm_') !== -1) {
			utm.push(el);
		}
	});
	if(utm && utm.length) {
		localStorage.setItem('UTM', JSON.stringify(utm));
	}
});