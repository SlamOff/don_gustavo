class Cart extends Base {
	constructor() {
		super();
		if(!this.$mainBody.hasClass('woocommerce-cart')) {
			return;
		}
		this.$form = jQuery('#cardForm');
		this.init();
	}
	
	submitForm() {
		let data = this.$form.serializeArray();
		let utmData = localStorage.getItem('UTM');
		let utm = [];
		if(utmData) {
			try {
				utm = JSON.parse(utmData);
			} catch (e) {
				utm.push(['status=UTM_Empty']);
			}
		}
		
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: '/wp-admin/admin-ajax.php',
			data: {action : 'dongustavo_cart_ajax_order', userData : data, utm: utm},
			success: (msg) => {
				if(msg.status === 'ok') {
					if(this.lang === 'uk') {}
					document.location.href = (this.lang === 'uk') ? '/thanks_page' : '/ru/thanks_page-ru';
				}
			}
		})
	}
	
	validateForm() {
		let self = this;
		let validationName = (this.lang === 'uk') ? "Обов'язково для заповнення" : "Обязательно для заполнения";
		let validationNameMax = (this.lang === 'uk') ? "Від 2 до 16 літер" : "От 2 до 16 букв";
		let validationPhone = (this.lang === 'uk') ? "Введіть вірний номер" : "Введите корректный номер";
		let validationEmail = (this.lang === 'uk') ? "Введіть вірний E-mail" : "Введите корректный E-mail";
		let validationRadio = (this.lang === 'uk') ? "Виберіть варіант" : "Выберите вариант";

		this.$form.validate({
			submitHandler: (form, e) => {
				self.submitForm();
			},
			rules: {
				name: {
					required: true,
					minlength: 2,
					maxlength: 16
				},
				phone: {
					required: true
				},
				delivery: {
					required: true
				},
				payment: {
					required: true
				},
				street: {
					required: true
				},
				house: {
					required: true
				},
				entrance: {
					required: true
				},
				apartment: {
					required: true
				},
				selfdelivery: {
					required: true
				}
			},
			messages: {
				name: {
					required: validationName,
					minlength: validationNameMax,
					maxlength: validationNameMax
				},
				phone: {
					required: validationPhone
				},
				delivery: {
					required: validationRadio
				},
				payment: {
					required: validationRadio
				},
				street: {
					required: validationName
				},
				house: {
					required: validationName
				},
				entrance: {
					required: validationName
				},
				apartment: {
					required: validationName
				},
				selfdelivery: {
					required: validationRadio
				},
			}
		})
	}
	
	formRadio() {
		jQuery('.radio_input', this.$form).on('change', (e) => {
			let $this = jQuery(e.currentTarget);
			let subinput = $this.siblings('.subinput');
			$this.closest('.row').find('.radio_input').removeClass('checked');
			$this.addClass('checked');

			if(!$this.hasClass('subradio')){
				if($this.hasClass('checked')){
					$this.closest('.row').find('.subinput').slideUp();
					subinput.slideDown();
				}
			}
			else {
				$this.closest('.row').find('.radio_main').addClass('checked');
			}
		});
	}
	
	getCartTotalSum(callback) {
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: '/wp-admin/admin-ajax.php',
			data: {action: 'dongustavo_cart_total', getTotal: 1},
		}).done((data) => {
			if(typeof callback === 'function') {
				callback(data);
			}
			jQuery('#totalPrice').html(data.html);
			jQuery('#total_price').html(data.html);
			
		})
	}
	
	changeQuantity() {
		let cartItem = null;
		let inputs = jQuery('.quantity input');
		inputs.attr('readonly', 'readonly');
		jQuery('.btn_action').on('click', e => {
			let $this = jQuery(e.currentTarget);
			let type = $this.hasClass('btn_plus') ? 'plus' : 'minus';
			let input = $this.siblings('.quantity').find('input');
			let quy = parseInt(input.val());
			let wrapper = $this.parent();
			let preloader = wrapper.find('.preloader');
			cartItem = $this.parents('.cart_item');
			let newTotalPrice = 0;
			if (type === 'minus') {
				$this.toggleClass('disabled', quy <= 2)
				if(quy === 1) {
					return;
				}
				quy --;
			} else {
				if(quy === 1) {
					wrapper.find('.btn_minus').removeClass('disabled');
				}
				quy ++;
			}
			newTotalPrice = parseFloat(wrapper.data('price')) * quy;
			preloader.show();
			input.val(quy);
			
			cartItem.find('.js-sub_total .amount bdi').text(newTotalPrice);
			this.updateQuantityRequest(type, wrapper.data('product_id'), () => {
				this.getCartTotalSum(() => {
					preloader.hide();
				})
			})
		})
	}
	
	deleteItem() {
		jQuery('.delete').on('click', e => {
			e.preventDefault();
			let $this = jQuery(e.currentTarget);
			jQuery.ajax({
				url: $this.attr('href'),
				type: 'get',
				success: (msg) => {
					$this.parents('.cart_item').remove();
					this.getCartTotalSum(data => {
						if(data.count === 0) {
							document.location.href = '/';
						}
					});
				}
			})
		})
	}
	
	init() {
		let self = this;
		this.validateForm();
		this.formRadio();
		this.customSelect((el, val) => {
			if(val !== '') {
				this.applyCoupon(val, (data) => {
					if(data.status === 1) {
						self.getCartTotalSum()
					}
				});
			}
		});
		this.changeQuantity()
		this.deleteItem();
	}
}