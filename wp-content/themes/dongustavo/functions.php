<?php

/**
 * Don Gustavo functions and definitions
 *
 * @link
 *
 * @package WordPress
 * @subpackage Don_Gustavo
 * @since Don Gustavo 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dongustavo_theme_support() {

	add_theme_support( 'automatic-feed-links' );
	/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Twenty, use a find and replace
	 * to change 'twentytwenty' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'dongustavo' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://wordpress.org/support/article/post-formats/
	 */
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'dongustavo_theme_support' );

require get_template_directory() . '/inc/template-tags.php';




/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dongustavo_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
//		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
//		'after_title'   => '</h2>',
//		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
//		'after_widget'  => '</div></div>',
	);

	// Header.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'HeaderMobile', 'dongustavo' ),
				'id'          => 'header-mobile-widgets',
				'description' => __( 'Widgets in this area will be displayed in the header.', 'dongustavo' ),
			)
		)
	);
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Header', 'dongustavo' ),
				'id'          => 'header-widgets',
				'description' => __( 'Widgets in this area will be displayed in the header.', 'dongustavo' ),
			)
		)
	);
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Main menu', 'dongustavo' ),
				'id'          => 'main_menu',
				'description' => __( 'Widgets in this area will be displayed in the header.', 'dongustavo' ),
			)
		)
	);
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Main menu mobile', 'dongustavo' ),
				'id'          => 'main_menu_mobile',
				'description' => __( 'Widgets in this area will be displayed in the header.', 'dongustavo' ),
			)
		)
	);
	// Footer.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer', 'dongustavo' ),
				'id'          => 'footer-widgets',
				'description' => __( 'Widgets in this area will be displayed in the footer.', 'dongustavo' ),
			)
		)
	);

}

add_action( 'widgets_init', 'dongustavo_sidebar_registration' );




/**
 * Register and Enqueue Styles.
 */
function dongustavo_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	//Libs
	wp_enqueue_style( 'dongustavo-bootstrap', get_template_directory_uri(). '/front/libs/bootstrap/css/bootstrap.min.css', array(), $theme_version );
	wp_enqueue_style( 'dongustavo-animate', get_template_directory_uri(). '/front/libs/animate/animate.min.css', array(), $theme_version );
	wp_enqueue_style( 'dongustavo-magnific-popup', get_template_directory_uri(). '/front/libs/magnific-popup/magnific-popup.css', array(), $theme_version );
	wp_enqueue_style( 'dongustavo-slick', get_template_directory_uri(). '/front/libs/slick/slick.css', array(), $theme_version );
	wp_enqueue_style( 'dongustavo-slick-theme', get_template_directory_uri(). '/front/libs/slick/slick-theme.css', array(), $theme_version );
	//END Libs

	wp_enqueue_style( 'dongustavo-style', get_stylesheet_uri(), array(), $theme_version );

	// Add print CSS.
	wp_enqueue_style( 'dongustavo-media-style', get_template_directory_uri() . '/media.css', null, $theme_version, 'all' );
	wp_enqueue_style( 'dongustavo-fonts-style', get_template_directory_uri() . '/fonts.css', null, $theme_version, 'all' );


	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	//Libs
	wp_enqueue_script( 'dongustavo-bootstrap', get_template_directory_uri(). '/front/libs/bootstrap/js/bootstrap.min.js', array('jquery'), $theme_version, true );
	wp_enqueue_script( 'dongustavo-magnific-popup', get_template_directory_uri(). '/front/libs/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), $theme_version, true );
	wp_enqueue_script( 'dongustavo-slick', get_template_directory_uri(). '/front/libs/slick/slick.min.js', array('jquery'), $theme_version, true );
	wp_enqueue_script( 'dongustavo-maskedinput', get_template_directory_uri(). '/front/libs/maskedinput/jquery.maskedinput.min.js', array('jquery'), $theme_version, true );
	wp_enqueue_script( 'dongustavo-validation', get_template_directory_uri(). '/front/libs/validation/jquery.validate.min.js', array('jquery'), $theme_version, true );
	wp_enqueue_script( 'dongustavo-wow', get_template_directory_uri(). '/front/libs/animate/wow.min.js', array('jquery'), $theme_version, true );
	wp_enqueue_script( 'dongustavo-clamp', get_template_directory_uri(). '/front/libs/clamp.js', array('jquery'), $theme_version, true );
	//END Libs

	//Components
	wp_enqueue_script( 'dongustavo-Base', get_template_directory_uri(). '/front/js/core/Base.js', array('jquery'), $theme_version, true );
//	wp_enqueue_script( 'dongustavo-MainMenu', get_template_directory_uri(). '/front/js/components/MainMenu.js', array('jquery'), $theme_version, true );
//	wp_enqueue_script( 'dongustavo-AddToCart', get_template_directory_uri(). '/front/js/components/AddToCart.js', array('jquery'), $theme_version, true );
	wp_enqueue_script( 'dongustavo-Pdp', get_template_directory_uri(). '/front/js/components/Pdp.js', array('jquery', 'dongustavo-Base'), $theme_version, true );
	wp_enqueue_script( 'dongustavo-Plp', get_template_directory_uri(). '/front/js/components/Plp.js', array('jquery', 'dongustavo-Base'), $theme_version, true );
	wp_enqueue_script( 'dongustavo-Cart', get_template_directory_uri(). '/front/js/components/Cart.js', array('jquery', 'dongustavo-Base'), $theme_version, true );
	//END Components



	wp_enqueue_script( 'dongustavo-js', get_template_directory_uri() . '/front/js/common.js', array(), $theme_version, true );
	wp_script_add_data( 'dongustavo-js', 'async', true );



}

add_action( 'wp_enqueue_scripts', 'dongustavo_register_styles' );



/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function dongustavo_menus() {

	$locations = array(
		'primary'  => __( 'Desktop Main Menu', 'dongustavo' ),
		'mobile'   => __( 'Mobile Main Menu', 'dongustavo' ),
		'footer'   => __( 'Footer Menu', 'dongustavo' )
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'dongustavo_menus' );

function change_menu_item_args( $args, $item, $depth) {

	if ( $depth === 0 ) {
		$args->link_before = '<i class="icon"></i>';
	}

	return $args;
}

add_filter( 'nav_menu_item_args', 'change_menu_item_args', 10, 3 );

// Register Custom Post Type
function dongustavo_addings() {

	$labels = array(
		'name'                  => _x( 'Addings', 'Post Type General Name', 'dongustavo' ),
		'singular_name'         => _x( 'Adding', 'Post Type Singular Name', 'dongustavo' ),
		'menu_name'             => __( 'Додатки до піц', 'dongustavo' ),
		'name_admin_bar'        => __( 'Додатки до піц', 'dongustavo' ),
		'archives'              => __( 'Item Archives', 'dongustavo' ),
		'attributes'            => __( 'Item Attributes', 'dongustavo' ),
		'parent_item_colon'     => __( 'Parent Item:', 'dongustavo' ),
		'all_items'             => __( 'All Items', 'dongustavo' ),
		'add_new_item'          => __( 'Add New Item', 'dongustavo' ),
		'add_new'               => __( 'Додати додаток', 'dongustavo' ),
		'new_item'              => __( 'Новий додаток', 'dongustavo' ),
		'edit_item'             => __( 'Редагувати', 'dongustavo' ),
		'update_item'           => __( 'Оновити', 'dongustavo' ),
		'view_item'             => __( 'Перегляд', 'dongustavo' ),
		'view_items'            => __( 'View Items', 'dongustavo' ),
		'search_items'          => __( 'Search Item', 'dongustavo' ),
		'not_found'             => __( 'На знайдено', 'dongustavo' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'dongustavo' ),
		'featured_image'        => __( 'Зображення', 'dongustavo' ),
		'set_featured_image'    => __( 'Додати зображення', 'dongustavo' ),
		'remove_featured_image' => __( 'Видалити зображення', 'dongustavo' ),
		'use_featured_image'    => __( 'Use as featured image', 'dongustavo' ),
		'insert_into_item'      => __( 'Insert into item', 'dongustavo' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'dongustavo' ),
		'items_list'            => __( 'Items list', 'dongustavo' ),
		'items_list_navigation' => __( 'Items list navigation', 'dongustavo' ),
		'filter_items_list'     => __( 'Filter items list', 'dongustavo' ),
	);
	$args = array(
		'label'                 => __( 'Adding', 'dongustavo' ),
		'description'           => __( 'Post Type Description', 'dongustavo' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'custom-fields' ),
		'taxonomies'            => array( 'category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => false,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
	);
	register_post_type( 'addings', $args );

}
add_action( 'init', 'dongustavo_addings', 0 );

// Register Custom Post Type
function dongustavo_addresses() {

	$labels = array(
		'name'                  => _x( 'Addresses', 'Post Type General Name', 'dongustavo' ),
		'singular_name'         => _x( 'Address', 'Post Type Singular Name', 'dongustavo' ),
		'menu_name'             => __( 'Адреси', 'dongustavo' ),
		'name_admin_bar'        => __( 'Адреси', 'dongustavo' ),
		'archives'              => __( 'Item Archives', 'dongustavo' ),
		'attributes'            => __( 'Item Attributes', 'dongustavo' ),
		'parent_item_colon'     => __( 'Parent Item:', 'dongustavo' ),
		'all_items'             => __( 'All Items', 'dongustavo' ),
		'add_new_item'          => __( 'Add New Item', 'dongustavo' ),
		'add_new'               => __( 'Додати адресу', 'dongustavo' ),
		'new_item'              => __( 'Нова адреса', 'dongustavo' ),
		'edit_item'             => __( 'Редагувати', 'dongustavo' ),
		'update_item'           => __( 'Оновити', 'dongustavo' ),
		'view_item'             => __( 'Перегляд', 'dongustavo' ),
		'view_items'            => __( 'View Items', 'dongustavo' ),
		'search_items'          => __( 'Search Item', 'dongustavo' ),
		'not_found'             => __( 'На знайдено', 'dongustavo' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'dongustavo' ),
		'featured_image'        => __( 'Зображення', 'dongustavo' ),
		'set_featured_image'    => __( 'Додати зображення', 'dongustavo' ),
		'remove_featured_image' => __( 'Видалити зображення', 'dongustavo' ),
		'use_featured_image'    => __( 'Use as featured image', 'dongustavo' ),
		'insert_into_item'      => __( 'Insert into item', 'dongustavo' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'dongustavo' ),
		'items_list'            => __( 'Items list', 'dongustavo' ),
		'items_list_navigation' => __( 'Items list navigation', 'dongustavo' ),
		'filter_items_list'     => __( 'Filter items list', 'dongustavo' ),
	);
	$args = array(
		'label'                 => __( 'Addresses', 'dongustavo' ),
		'description'           => __( 'Post Type Description', 'dongustavo' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'custom-fields' ),
		'taxonomies'            => array( 'category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => false,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
	);
	register_post_type( 'addresses', $args );

}
add_action( 'init', 'dongustavo_addresses', 0 );

require get_template_directory() . '/inc/shortCodes.php';
require get_template_directory() . '/inc/image_sizes.php';
require get_template_directory() . '/inc/woocommerce_hooks.php';
require_once get_template_directory() . '/classes/class-GustavoTranslations.php';
require_once get_template_directory() . '/classes/class-Additives.php';