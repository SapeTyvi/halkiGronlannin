<?php


if ( ! function_exists( 'ewp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ewp_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ewp, use a find and replace
	 * to change 'ewp' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ewp', get_template_directory() . '/languages' );

	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );	
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'ewp-full-bleed', 2000, 1200, true );
	add_image_size( 'ewp-index-img', 1000, 550, true );
	add_image_size( 'ewp-large-thumb', 1000 );
	add_image_size( 'ewp-medium-thumb', 550, 400, true );
	add_image_size( 'ewp-small-thumb', 230 );
	add_image_size( 'ewp-service-thumb', 350 );
	add_image_size( 'ewp-mas-thumb', 480 );

	// wp_nav_menu käytetään 2 paikassa header ja footerissa
	register_nav_menus( array(
		'primary' => esc_html__( 'Header', 'ewp' ),
		'social' => esc_html__( 'Social Media Menu', 'ewp' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Lisätään custom background ominaisuus
	add_theme_support( 'custom-background', apply_filters( 'ewp_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Lisätän custom logo ominaisuus
	add_theme_support( 'custom-logo', array(
		'width' => 90,
		'height' => 90,
		'flex-width' => true,
	));

	

	// Editor styles
	add_editor_style( array( 'inc/editor-styles.css', ewp_fonts_url() ) );
}
endif;
add_action( 'after_setup_theme', 'ewp_setup' );


// Omat fontit
function ewp_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro and PT Serif, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'ewp' );
	$pt_serif = _x( 'on', 'PT Serif font: on or off', 'ewp' );

	$font_families = array();

	if ( 'off' !== $source_sans_pro ) {
		$font_families[] = 'Source Sans Pro:400,400i,700,900';
	}

	if ( 'off' !== $pt_serif ) {
		$font_families[] = 'PT Serif:400,400i,700,700i';
	}


	if ( in_array( 'on', array($source_sans_pro, $pt_serif) ) ) {

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function ewp_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'ewp-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'ewp_resource_hints', 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ewp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ewp_content_width', 640 );
}
add_action( 'after_setup_theme', 'ewp_content_width', 0 );


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function ewp_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 900 <= $width ) {
		$sizes = '(min-width: 900px) 700px, 900px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-2' ) ) {
		$sizes = '(min-width: 900px) 600px, 900px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'ewp_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function ewp_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'ewp_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function ewp_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {

	if ( !is_singular() ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$attr['sizes'] = '(max-width: 900px) 90vw, 800px';
		} else {
			$attr['sizes'] = '(max-width: 1000px) 90vw, 1000px';
		}
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'ewp_post_thumbnail_sizes_attr', 10, 3 );




// Widget alue
function ewp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ewp' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add sidebar widgets here.', 'ewp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'ewp' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add page sidebar widgets here.', 'ewp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'ewp' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add footer widgets here.', 'ewp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
// Poistettu käytöstä 
/*
	register_sidebar( array(
		'name'          => esc_html__( 'Admin Sidebar', 'ewp' ),
		'id'            => 'sidebar-3',
		'description'   => 'Dynamic Right Sidebar',
		'before_widget' => '<section id="%1$s" class="ewp-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="ewp-widget-title">',
		'after_title'   => '</h2>',
	) );
*/
}
add_action( 'widgets_init', 'ewp_widgets_init' );


// Lisätään scriptit ja tyylit
function ewp_scripts() {
	// Enqueue Google Fonts: Source Sans Pro and PT Serif
	wp_enqueue_style( 'ewp-fonts', ewp_fonts_url() );

	// Enqueue Font Awesome
	wp_enqueue_style( 'font_awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	// CSS
	wp_enqueue_style( 'ewp-style', get_stylesheet_uri() );
	// Navigation.js
	wp_enqueue_script( 'ewp-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );
	wp_localize_script( 'ewp-navigation', 'ewpScreenReaderText', array(
		'expand' => __( 'Expand child menu', 'ewp'),
		'collapse' => __( 'Collapse child menu', 'ewp'),
	));

	wp_enqueue_script( 'ewp-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20161201', true );

	wp_enqueue_script( 'ewp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ewp_scripts' );







// Ladataan custom header
require get_template_directory() . '/inc/custom-header.php';

// Ladataan custom template tags
require get_template_directory() . '/inc/template-tags.php';

// Ladataan custom functions
require get_template_directory() . '/inc/extras.php';

// Ladataan customizer
require get_template_directory() . '/inc/customizer.php';

// Ladataan jetpack
require get_template_directory() . '/inc/jetpack.php';

// Ladataan admin functions
require get_template_directory() . '/inc/function-admin.php';

// Ladataan custom post types
require get_template_directory() . '/inc/custom-post-type.php';

// Ladataan shortcodes
require get_template_directory() . '/inc/shortcodes.php';

// Ladataan custom widgets
// require get_template_directory() . '/inc/widgets.php';

// Ladataan ajax
require get_template_directory() . '/inc/ajax.php';