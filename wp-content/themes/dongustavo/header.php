<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Don_Gustavo
 * @since Don Gustavo 1.0
 */


?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>
	<?php if ( is_active_sidebar( 'header-mobile-widgets' ) ) : ?>
		<div class="mobile_menu_overlay">
			<div class="mobile_menu">
				<div class="close"></div>
				<?php dynamic_sidebar( 'header-mobile-widgets' ); ?>


				<div class="mobile_phone">
					<h6>Телефон для онлайн заказа:</h6>
					<a onclick="gtag('event', 'tel1');" href="tel:+380666266808">+38 066 626 68 08</a>
					<a onclick="gtag('event', 'tel2');" href="tel:+380666757185">+38 066 675 71 85</a>
				</div>

			</div>
		</div>


	<?php endif; ?>
	<header class="header">
		<div class="container">
			<div class="header_wrapper">
				<div class="logo">
					<a href="/"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.jpg" alt=""></a>
				</div>
				<div class="phone_icon">
					<img src="<?php echo get_template_directory_uri(); ?>/img/phone.png" alt="">
					<div class="phone_menu">
						<a onclick="gtag('event', 'tel1');" href="tel:+380666266808">+38 066 626 68 08</a>
						<a onclick="gtag('event', 'tel2');" href="tel:+380666757185">+38 066 675 71 85</a>
					</div>
				</div>

				<?php
				if ( is_active_sidebar( 'header-widgets' ) ) :
					dynamic_sidebar( 'header-widgets' );
				endif; ?>
				<div class="burger">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
		</div>
	</header>

	<div class="menu">
		<div class="container">
			<?php if ( is_active_sidebar( 'main_menu' ) ) :
			dynamic_sidebar( 'main_menu' );
			endif; ?>
		</div>
	</div>
