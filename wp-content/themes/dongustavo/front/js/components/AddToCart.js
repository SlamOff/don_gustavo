class AddToCart{
	constructor() {
		this.initEvents();
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
		
		return data;
	}
	
	sendRequest(data, before, complete, callback) {
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
	updateQuantity(wrapper, product_id) {
		let input = wrapper.find('input');
		wrapper.find('.btn_action').on('click', e => {
			let $element = jQuery(e.currentTarget);
			let type = ($element.hasClass('btn_minus')) ? 'minus' : 'plus';
			this.updateQuantityRequest(type, product_id, response => {
				jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);
				let newVal = (type === 'plus') ? parseInt(input.val()) + 1 : parseInt(input.val()) - 1;
				input.val(newVal)
			});
		})
		
	}
	addToCartEvent() {
		jQuery(document).on('click', '.single_add_to_cart_button', (e) => {
			e.preventDefault();
			let $thisbutton = jQuery(e.currentTarget);
			
			let data = this.prepareData($thisbutton);
			
			jQuery(document.body).trigger('adding_to_cart', [$thisbutton, data]);
			
			this.sendRequest(data, null, null, (response) => {
				jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
				$thisbutton
					.addClass('invisible')
					.closest('.product_item').find('.added_to_cart').addClass('visible');
				this.updateQuantity($thisbutton.closest('.product_item').find('.g-quantity'), data.product_id)
			})
			
			
			return false;
		});
		jQuery(document.body).on('added_to_cart', (e, el, el1, button) => {
			if(typeof button === 'undefined' || button.hasClass('single_add_to_cart_button')) {
				return false;
			}
			button
				.addClass('invisible')
				.closest('.product_item').find('.added_to_cart').addClass('visible');
			this.updateQuantity(button.closest('.product_item').find('.g-quantity'), button.data('product_id'));
			
		})
	}
	
	changeVariations() {
		let form,
			variationsSelect,
			variationsButtons,
			addToCartButton;
		jQuery('.variations_form').each((i, el) => {
			form = jQuery(el);
			addToCartButton = form.find('.single_add_to_cart_button');
			variationsSelect = jQuery('.variations', form).find('select');
			variationsButtons = form.parents('.product_item').find('.js-size').children('.size_btn');
			variationsButtons.on('click', (e) => {
				let $this = jQuery(e.currentTarget);
				let sizes = $this.closest('.product_item').data().weight;
				let prices = $this.closest('.product_item').data().price;
				if(sizes.length > 1){
					let weightNode = $this.parent().siblings('.product_item--weight').find('span.weight');
					let priceNode = $this.parent().closest('a').siblings('.product_item--footer').find('.price span');
					$this.siblings('span').removeClass('active');
					$this.addClass('active');
					if($this.hasClass('second_size')){
						weightNode.text(sizes[1]);
						priceNode.text(prices[1]);
					}
					else {
						weightNode.text(sizes[0]);
						priceNode.text(prices[0]);
					}
					variationsSelect
						.val($this.data('size'))
						.trigger('change');
					addToCartButton
						.removeClass('invisible')
						.closest('.product_item').find('.added_to_cart').removeClass('visible');
					
				}
				
			});
			
			console.log(variationsSelect.val());
		})
	}
	
	initEvents() {
		this.addToCartEvent();
		this.changeVariations()
	}
}