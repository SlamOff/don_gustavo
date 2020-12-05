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
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: '/wp-admin/admin-ajax.php',
			data: {action : 'dongustavo_cart_ajax_order', userData : data }
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
	
	getCartTotalSum() {
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: '/wp-admin/admin-ajax.php',
			data: {action: 'dongustavo_cart_total', getTotal: 1},
		}).done((data) => {
			jQuery('#totalPrice').html(data.html);
			jQuery('#total_price').html(data.html);
			
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
	}
}