class Base {
	constructor() {
		this.mainMenu = jQuery('.menu','.widget_nav_menu');
		this.$mainBody = jQuery('body');
		this.lang = jQuery('html').attr('lang');
		this._init();
	}
	
	menuIcons() {
		let classes = ['discount', 'pizza1', 'sushi1', 'glass1', 'customer-satisfaction', 'credit-card'];
		this.mainMenu.each((_i, _el) => {
			jQuery(_el).find('.menu-item').each((i, el) => {
				jQuery(el).find('.icon').addClass('icon-' + classes[i]);
			})
		})
	}
	
	prepareData($thisbutton) {
		let $form = $thisbutton.closest('form.cart');
		
		let data = {
			action: 'woocommerce_ajax_add_to_cart'
		}
		$form.serializeArray().forEach(el => {
			if(el.name !== "add-to-cart") {
				data[el.name] = el.value;
			}
			
		})
		if(typeof data.variation_id === 'undefined' || data.variation_id === 0) {
			data.variation_id = $form.find('input[name=variation_id]').val() || 0
		}
		return data;
	}
	
	addToCartRequest(data, before, complete, callback) {
		jQuery.ajax({
			type: 'post',
			url: wc_add_to_cart_params.ajax_url,
			data: data,
			beforeSend: (response) => {
				if(typeof before === 'function') {
					before();
				}
			},
			complete: (response) => {
				if(typeof complete === 'function') {
					complete();
				}
			},
			success: (response) => {
				if (response.error && response.product_url) {
					window.location = response.product_url;
					return;
				} else {
					if(typeof callback === 'function') {
						callback(response);
					}
				}
			},
		});
	}
	
	updateQuantityRequest(type, product_id, callback) {
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: '/wp-admin/admin-ajax.php',
			data: {action : 'woocommerce_ajax_cart_quantity', product_id : product_id, quantity : type },
			success: (data) => {
				callback(data);
			}
		})
	}
	
	customSelect(callback) {
		jQuery('.product_card--promo_dropdown').on('click', (e) => {
			let $this = jQuery(e.currentTarget);
			let title = $this.find(('.product_card--promo_value'));
			let list = $this.find('.product_card--promo_list');
			let value = '';
			let slideUpFunc = () => {
				$this.find('.product_card--promo_list').slideUp(500, function(){
					$this.removeClass('opened');
				});
			}
			if (e.target.classList.contains('product_card--promo_value') || e.target.classList.contains('arrow')) {
				if(list.is(':visible')){
					slideUpFunc();
				}
				else {
					$this.addClass('opened');
					$this.find('.product_card--promo_list').slideDown(500);
				}
			}
			else {
				value = e.target.textContent;
				title.text(value);
				jQuery('#promo').val(value);
				slideUpFunc();
			}
			if(typeof callback === 'function') {
				callback($this, value);
			}
		});
	}
	
	applyCoupon(coupon, callback) {
		let data = {
			action: 'dongustavo_cart_apply_coupon',
			couponcode: coupon
		};
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: '/wp-admin/admin-ajax.php',
			data: data,
			success: (data) => {
				callback(data)
			}
		})
	}
	
	homeLink() {
		let link = this.lang === 'uk' ? '/' : '/ru/главная/';
		jQuery('.header_wrapper .logo > a').attr('href', link);
	}
	
	cartLink() {
		let link = this.lang === 'uk' ? '/cart' : '/ru/cart-ru';
		jQuery('.header_wrapper .shopping_cart').attr('href', link);
	}
	
	_init() {
		this.menuIcons();
		this.homeLink();
		this.cartLink();
	}
}