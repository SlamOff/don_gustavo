class MainMenu {
	constructor() {
		this.mainMenu = jQuery('.menu','.widget_nav_menu');
		
		this.menuIcons();
	}
	
	menuIcons() {
		let classes = ['discount', 'pizza1', 'sushi1', 'glass1', 'customer-satisfaction', 'credit-card'];
		this.mainMenu.each((_i, _el) => {
			jQuery(_el).find('.menu-item').each((i, el) => {
				jQuery(el).find('.icon').addClass('icon-' + classes[i]);
			})
		})
	}
}