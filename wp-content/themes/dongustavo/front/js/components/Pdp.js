class Pdp extends Base {
	
	constructor() {
		super();
		if(!this.$mainBody.hasClass('single-product')) {
			return;
		}
		this.additivesWrapper = jQuery('#additives');
		this.wc_additivesWrapper = null;
		this.wc_additives = null;
		this.addsTarget = null;
		this.addsPriceTarget = jQuery('.js-adds-price');
		this.currentAddsPrice = parseInt(this.addsPriceTarget.text()) || 0;
		this.$currentPriceTarget = jQuery('#product_total_price');
		if(!this.$currentPriceTarget.length) {
			this.$currentPriceTarget = jQuery('.woocommerce-Price-amount bdi');
		}
		this.currentPrice = parseInt(this.$currentPriceTarget.text());
		this.$countInput = jQuery('.js-quantity');
		if(!this.$countInput.length) {
			this.$countInput = jQuery('.product_card--quantity .qty');
		}
		this.currentCount = parseInt(this.$countInput.val());
		this.startPrice = parseInt(this.$currentPriceTarget.text());
		if(!this.startPrice || this.startPrice === 'NaN') {
			this.startPrice = parseInt(jQuery('#variationprice').data('price'));
		}
		this.init();
	}
	
	
	
	generateAddsItem($el) {
		let i = jQuery('<i>+</i>');
		let html = jQuery('<div class="product_card--added_item" />');
		let span = jQuery('<span>' + $el.find('.additives_item--title').text() + '</span>');
		i.on('click', () => {
			this.selectAdditive($el)
		})
		html.append(i, span);
		return html;
	}
	
	updatePriceData() {
		this.currentPrice = (this.startPrice + this.currentAddsPrice) * this.currentCount;
	}
	
	updateTotalPrice() {
		this.updatePriceData();
		this.$currentPriceTarget = jQuery('#product_total_price');
		if(!this.$currentPriceTarget.length) {
			this.$currentPriceTarget = jQuery('.woocommerce-Price-amount bdi');
		}
		this.$currentPriceTarget.text(this.currentPrice);
	}
	
	selectAdditive($el) {
		let add = !$el.hasClass('added');
		let adds = $el.data('adds-item');
		// let oldPrice = parseInt(this.addsPriceTarget.text());
		let addsPrice = parseInt($el.data('price'));
		if(!adds) {
			adds = this.generateAddsItem($el);
			$el.data('adds-item', adds);
			this.addsTarget.append(adds);
		}
		$el.toggleClass('added', add);
		this.wc_additives.filter('[value=' + $el.data('id') + ']').prop('checked', add).trigger('change')
		adds.toggleClass('shown', add);
		this.currentAddsPrice = (add) ? this.currentAddsPrice + addsPrice : this.currentAddsPrice - addsPrice;
		this.updateAddsPrice();
		setTimeout(() => {
			this.updateTotalPrice();
		}, 200)
	}
	
	updateAddsPrice() {
		if(this.addsPriceTarget.length) {
			this.addsPriceTarget.text(this.currentAddsPrice * this.currentCount);
		}
	}
	
	selectVariation() {
		let variationButtons = jQuery('.js-size-btn');
		if(variationButtons.length < 2) {
			return false;
		}
		let variationSelect = jQuery('#pa_size');
		variationButtons.on('click', e => {
			let $el = jQuery(e.currentTarget);
			if($el.hasClass('active')) {
				return false;
			}
			$el.addClass('active');
			variationSelect
				.val($el.data('variation'))
				.trigger('change')
			variationButtons.not($el).removeClass('active');
			this.startPrice = $el.data('price');
			setTimeout(() => {
				this.updateTotalPrice();
			}, 200)
			
		})
	}
	
	additives() {
		this.wc_additives = jQuery('.wccpf-field', '.wccpf-fields-container');
		this.addsTarget = jQuery('.js-adds');
		jQuery('.js-additive', this.additivesWrapper).on('click', e => {
			this.selectAdditive(jQuery(e.currentTarget));
		})
	}
	
	changeQuantity() {
		let $buttons = jQuery('.js-qty');
		$buttons.on('click', e => {
			let $button = jQuery(e.currentTarget);
			if($button.hasClass('js-plus')) {
				this.currentCount ++;
				$buttons.not($button).removeClass('disabled');
			} else {
				if(this.currentCount == 2) {
					$button.addClass('disabled');
				}
				if(this.currentCount < 2) {
					
					return false;
				}
				this.currentCount --;
			}
			this.$countInput.val(this.currentCount);
			this.updateAddsPrice();
			this.updateTotalPrice();
		})
	}
	
	init() {
		if(this.additivesWrapper.length) {
			this.additives();
		}
		this.selectVariation();
		this.changeQuantity();
		this.customSelect((el, val) => {
			if(val && val !== 0) {
				this.applyCoupon(val, (res) => {
					console.log(res);
				})
			}
			
		});
		
		function addReload() {
			jQuery(document.body).on('added_to_cart', () => {
				document.location.reload();
			})
		}
		
		jQuery('.single_add_to_cart_button').on('click', addReload);
	}
}