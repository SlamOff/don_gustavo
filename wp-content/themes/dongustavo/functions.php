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
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer menu', 'dongustavo' ),
				'id'          => 'footer-menu',
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

//	//Libs
//	wp_enqueue_style( 'dongustavo-bootstrap', get_template_directory_uri(). '/front/libs/bootstrap/css/bootstrap.min.css', array(), $theme_version );
//	wp_enqueue_style( 'dongustavo-animate', get_template_directory_uri(). '/front/libs/animate/animate.min.css', array(), $theme_version );
//	wp_enqueue_style( 'dongustavo-magnific-popup', get_template_directory_uri(). '/front/libs/magnific-popup/magnific-popup.css', array(), $theme_version );
//	wp_enqueue_style( 'dongustavo-slick', get_template_directory_uri(). '/front/libs/slick/slick.css', array(), $theme_version );
//	wp_enqueue_style( 'dongustavo-slick-theme', get_template_directory_uri(). '/front/libs/slick/slick-theme.css', array(), $theme_version );
//	//END Libs

	wp_enqueue_style( 'dongustavo-style', get_stylesheet_uri(), array(), $theme_version );

	// Add print CSS.
//	wp_enqueue_style( 'dongustavo-media-style', get_template_directory_uri() . '/media.css', null, $theme_version, 'all' );
//	wp_enqueue_style( 'dongustavo-fonts-style', get_template_directory_uri() . '/fonts.css', null, $theme_version, 'all' );


	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
//	//Libs
//	wp_enqueue_script( 'dongustavo-bootstrap', get_template_directory_uri(). '/front/libs/bootstrap/js/bootstrap.min.js', array('jquery'), $theme_version, true );
//	wp_enqueue_script( 'dongustavo-magnific-popup', get_template_directory_uri(). '/front/libs/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), $theme_version, true );
//	wp_enqueue_script( 'dongustavo-slick', get_template_directory_uri(). '/front/libs/slick/slick.min.js', array('jquery'), $theme_version, true );
//	wp_enqueue_script( 'dongustavo-maskedinput', get_template_directory_uri(). '/front/libs/maskedinput/jquery.maskedinput.min.js', array('jquery'), $theme_version, true );
//	wp_enqueue_script( 'dongustavo-validation', get_template_directory_uri(). '/front/libs/validation/jquery.validate.min.js', array('jquery'), $theme_version, true );
//	wp_enqueue_script( 'dongustavo-wow', get_template_directory_uri(). '/front/libs/animate/wow.min.js', array('jquery'), $theme_version, true );
//	wp_enqueue_script( 'dongustavo-clamp', get_template_directory_uri(). '/front/libs/clamp.js', array('jquery'), $theme_version, true );
//	//END Libs
//
//	//Components
//	wp_enqueue_script( 'dongustavo-Base', get_template_directory_uri(). '/front/js/core/Base.js', array('jquery'), $theme_version, true );
//	wp_enqueue_script( 'dongustavo-Pdp', get_template_directory_uri(). '/front/js/components/Pdp.js', array('jquery', 'dongustavo-Base'), $theme_version, true );
//	wp_enqueue_script( 'dongustavo-Plp', get_template_directory_uri(). '/front/js/components/Plp.js', array('jquery', 'dongustavo-Base'), $theme_version, true );
//	wp_enqueue_script( 'dongustavo-Cart', get_template_directory_uri(). '/front/js/components/Cart.js', array('jquery', 'dongustavo-Base'), $theme_version, true );
//	//END Components



	wp_enqueue_script( 'dongustavo-js', get_template_directory_uri() . '/main.js', array('jquery'), $theme_version, true );
//	wp_enqueue_script( 'dongustavo-js', get_template_directory_uri() . '/front/js/common.js', array('jquery'), $theme_version, true );
	wp_script_add_data( 'dongustavo-js', 'async', true );



}

add_action( 'wp_enqueue_scripts', 'dongustavo_register_styles', 999, 5 );



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

// Register Custom Post Type
function dongustavo_responses() {

	$labels = array(
		'name'                  => _x( 'Відгуки', 'Post Type General Name', 'dongustavo' ),
		'singular_name'         => _x( 'Відгук', 'Post Type Singular Name', 'dongustavo' ),
		'menu_name'             => __( 'Відгуки', 'dongustavo' ),
		'name_admin_bar'        => __( 'Відгуки', 'dongustavo' ),
		'archives'              => __( 'Item Archives', 'dongustavo' ),
		'attributes'            => __( 'Item Attributes', 'dongustavo' ),
		'parent_item_colon'     => __( 'Parent Item:', 'dongustavo' ),
		'all_items'             => __( 'All Items', 'dongustavo' ),
		'add_new_item'          => __( 'Add New Item', 'dongustavo' ),
		'add_new'               => __( 'Додати відгук', 'dongustavo' ),
		'new_item'              => __( 'Нова відгук', 'dongustavo' ),
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
		'label'                 => __( 'Відгуки', 'dongustavo' ),
		'description'           => __( 'Post Type Description', 'dongustavo' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'custom-fields', 'thumbnail'),
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
	register_post_type( 'responses', $args );

}
add_action( 'init', 'dongustavo_responses', 0 );

require_once get_template_directory() . '/classes/class-GustavoTranslations.php';
require_once get_template_directory() . '/classes/class-Additives.php';
require_once get_template_directory() . '/classes/class-Responses.php';

require get_template_directory() . '/inc/shortCodes.php';
require get_template_directory() . '/inc/image_sizes.php';
require get_template_directory() . '/inc/woocommerce_hooks.php';


function dongustavo_title($t) {
	global $wp_query;
	$post = $wp_query->post;
	$title = $t;
	$isCategory = null;
	if($post->ID == 0) {
		$cat = get_term_by('slug', $post->post_name, 'product_cat');
		$isCategory = $cat->term_id ?? null;
	}
	if ( !empty($post->post_type) and in_array($post->post_type, ['page', 'product']) and empty($isCategory)) {
		$title = get_field('titile', $post->ID) ?? $post->post_title;
	}
	if ( !empty($isCategory) ) {
		$title = get_field('titile', 'product_cat_'.$isCategory) ?? $post->post_title;
	}
//	var_dump($post);
	return array('title' => $title);
}
add_filter( 'document_title_parts', 'dongustavo_title');


function dongustavo_titles() {
	global $wp_query;
	$post = $wp_query->post;
	$translations = new GustavoTranslations();
	$meta_description = '';
	$meta_keywords = '';
	$isCategory = null;

	if($post->ID == 0) {
		$cat = get_term_by('slug', $post->post_name, 'product_cat');
		$isCategory = $cat->term_id ?? null;
	}


	if ( !empty($post->post_type) and in_array($post->post_type, ['page']) and empty($isCategory)) {
		$meta_description = get_field('meta_description', $post->ID) ?? $translations->getTranslation(['global', 'meta_description']);
		$meta_keywords = get_field('meta_keywords', $post->ID) ?? 'empty';
	}
	if ( !empty($isCategory) ) {
		$meta_description = get_field('meta_description', 'product_cat_'.$isCategory) ?? $translations->getTranslation(['global', 'meta_description']);
		$meta_keywords = get_field('meta_keywords', 'product_cat_'.$isCategory) ?? 'empty';
	}
	echo '<meta name="description" content="'.$meta_description.'" />
	<meta name="keywords" content="'.$meta_keywords.'" />';
}
add_action( 'wp_head', 'dongustavo_titles');


add_action('wp_loaded', 'atm_output_buffer_start');
add_action('shutdown', 'atm_output_buffer_end');

function atm_output_buffer_start() {
	ob_start("atm_output_callback");
}

function atm_output_buffer_end() {
	ob_get_clean();
}

function atm_output_callback($buffer) {
	if(!is_admin() && !(defined('DOING_AJAX') && DOING_AJAX))
	{
		// Remove type from javascript and CSS
		$buffer = preg_replace( "%[ ]type=[\'\"]text\/(javascript|css)[\'\"]%", '', $buffer );
		// clear HEAD
		$buffer = preg_replace_callback('/(?=<head(.*?)>)(.*?)(?<=<\/head>)/s',
			function($matches) {
				return preg_replace(array(
					'/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', // delete HTML comments
					/* Fix HTML */
					'/\>[^\S ]+/s',  // strip whitespaces after tags, except space
					'/[^\S ]+\</s',  // strip whitespaces before tags, except space
					'/\>\s+\</',    // strip whitespaces between tags
				), array(
					'',
					/* Fix HTML */
					'>',  // strip whitespaces after tags, except space
					'<',  // strip whitespaces before tags, except space
					'><',   // strip whitespaces between tags
				), $matches[2]);
			}, $buffer);
		// clear BODY
		$buffer = preg_replace_callback('/(?=<body(.*?)>)(.*?)(?<=<\/body>)/s',
			function($matches) {
				return preg_replace(array(
					'/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', // delete HTML comments
					/* Fix HTML */
					'/\>[^\S ]+/s',  // strip whitespaces after tags, except space
					'/[^\S ]+\</s',  // strip whitespaces before tags, except space
					'/\>\s+\</',    // strip whitespaces between tags
				), array(
					'', // delete HTML comments
					/* Fix HTML */
					'>',  // strip whitespaces after tags, except space
					'<',  // strip whitespaces before tags, except space
					'> <',   // strip whitespaces between tags
				), $matches[2]);
			}, $buffer);
		$buffer = preg_replace_callback('/(?=<script(.*?)>)(.*?)(?<=<\/script>)/s',
			function($matches) {
				return preg_replace(array(
					'@\/\*(.*?)\*\/@s', // delete JavaScript comments
					'@((^|\t|\s|\r)\/{2,}.+?(\n|$))@s', // delete JavaScript comments
					'@(\}(\n|\s+)else(\n|\s+)\{)@s', // fix "else" statemant
					'@((\)\{)|(\)(\n|\s+)\{))@s', // fix brackets position
					//'@(\}\)(\t+|\s+|\n+))@s', // fix closed functions
					'@(\}(\n+|\t+|\s+)else\sif(\s+|)\()@s', // fix "else if"
					'@(if|for|while|switch|function)\(@s', // fix "if, for, while, switch, function"
					'@\s+(\={1,3}|\:)\s+@s', // fix " = and : "
					'@\$\((.*?)\)@s', // fix $(  )
					'@(if|while)\s\((.*?)\)\s\{@s', // fix "if|while ( ) {"
					'@function\s\(\s+\)\s{@s', // fix "function ( ) {"
					'@(\n{2,})@s', // fix multi new lines
					'@([\r\n\s\t]+)(,)@s', // Fix comma
					'@([\r\n\s\t]+)?([;,{}()]+)([\r\n\s\t]+)?@', // Put all inline
				), array(
					"\n", // delete JavaScript comments
					"\n", // delete JavaScript comments
					'}else{', // fix "else" statemant
					'){', // fix brackets position
					//"});\n", // fix closed functions
					'}else if(', // fix "else if"
					"$1(",  // fix "if, for, while, switch, function"
					" $1 ", // fix " = and : "
					'$'."($1)", // fix $(  )
					"$1 ($2) {", // fix "if|while ( ) {"
					'function(){', // fix "function ( ) {"
					"\n", // fix multi new lines
					',', // fix comma
					"$2", // Put all inline
				), $matches[2]);
			}, $buffer);
		// Clear CSS
		$buffer = preg_replace_callback('/(?=<style(.*?)>)(.*?)(?<=<\/style>)/s',
			function($matches) {
				return preg_replace(array(
					'/([.#]?)([a-zA-Z0-9,_-]|\)|\])([\s|\t|\n|\r]+)?{([\s|\t|\n|\r]+)(.*?)([\s|\t|\n|\r]+)}([\s|\t|\n|\r]+)/s', // Clear brackets and whitespaces
					'/([0-9a-zA-Z]+)([;,])([\s|\t|\n|\r]+)?/s', // Let's fix ,;
					'@([\r\n\s\t]+)?([;:,{}()]+)([\r\n\s\t]+)?@', // Put all inline
				), array(
					'$1$2{$5} ', // Clear brackets and whitespaces
					'$1$2', // Let's fix ,;
					"$2", // Put all inline
				), $matches[2]);
			}, $buffer);

		// Clean between HEAD and BODY
		$buffer = preg_replace( "%</head>([\s\t\n\r]+)<body%", '</head><body', $buffer );
		// Clean between BODY and HTML
		$buffer = preg_replace( "%</body>([\s\t\n\r]+)</html>%", '</body></html>', $buffer );
		// Clean between HTML and HEAD
		$buffer = preg_replace( "%<html(.*?)>([\s\t\n\r]+)<head%", '<html$1><head', $buffer );
	}

	return $buffer;
}