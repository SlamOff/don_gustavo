class Plp extends Base {
	constructor() {
		super();
		if(jQuery('.product-list').length) {
			this.init();
		} else {
			return;
		}
		
	}
	
	addToCartEvent() {
		jQuery(document).on('click', '.single_add_to_cart_button', (e) => {
			e.preventDefault();
			let $thisbutton = jQuery(e.currentTarget);
			
			let data = this.prepareData($thisbutton);
			
			jQuery(document.body).trigger('adding_to_cart', [$thisbutton, data]);
			
			this.addToCartRequest(data, null, null, (response) => {
				jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
				$thisbutton
					.addClass('invisible')
					.closest('.product_item').find('.added_to_cart').addClass('visible');
				this.cartLink();
				this.updateQuantity($thisbutton, data.product_id)
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
			this.updateQuantity(button, button.data('product_id'));
			
		})
	}
	
	changeVariations() {
		jQuery('.variations_form').each((i, el) => {
			let form = jQuery(el);
			let addToCartButton = form.find('.single_add_to_cart_button');
			let variationsSelect = jQuery('.variations', form).find('select');
			let variationsButtons = form.parents('.product_item').find('.js-size').children('.size_btn');
			variationsButtons.on('click', (e) => {
				e.preventDefault();
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
					form.find('.variation_id').val($this.data('variation_id'))
					addToCartButton
						.removeClass('invisible')
						.closest('.product_item').find('.added_to_cart').removeClass('visible');
					
				}
				
			});
		})
	}
	
	updateQuantity($button, product_id) {
		let wrapper = $button.closest('.product_item').find('.g-quantity');
		if(!wrapper.length) {
			wrapper = $button.closest('.drink-item').find('.g-quantity');
		}
		let input = wrapper.find('input');
		
		wrapper.find('.btn_action').on('click', e => {
			let $element = jQuery(e.currentTarget);
			let preloader = $element.parent().find('.preloader');
			let type = ($element.hasClass('btn_minus')) ? 'minus' : 'plus';
			preloader.show();
			this.updateQuantityRequest(type, product_id, response => {
				preloader.hide();
				jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);
				let newVal = (type === 'plus') ? parseInt(input.val()) + 1 : parseInt(input.val()) - 1;
				if(newVal === 0) {
					$button
						.removeClass('added invisible')
						.closest('.product_item').find('.added_to_cart.visible').removeClass('visible')
				} else {
					input.val(newVal)
				}
				
			});
		})
		
	}
	
	init() {
		this.addToCartEvent();
		this.changeVariations()
	}
}