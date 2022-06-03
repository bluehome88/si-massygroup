<?php
/**
 * Twenty Twenty functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
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
function twentytwenty_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'twentytwenty-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

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
	load_theme_textdomain( 'twentytwenty' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	/*
	 * Adds starter content to highlight the theme on fresh sites.
	 * This is done conditionally to avoid loading the starter content on every
	 * page load, as it is a one-off operation only needed once in the customizer.
	 */
	if ( is_customize_preview() ) {
		require get_template_directory() . '/inc/starter-content.php';
		add_theme_support( 'starter-content', twentytwenty_get_starter_content() );
	}

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new TwentyTwenty_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}

add_action( 'after_setup_theme', 'twentytwenty_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/classes/class-twentytwenty-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Handle Customizer settings.
require get_template_directory() . '/classes/class-twentytwenty-customize.php';

// Require Separator Control class.
require get_template_directory() . '/classes/class-twentytwenty-separator-control.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-comment.php';

// Custom page walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-page.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-twentytwenty-script-loader.php';

// Non-latin language handling.
require get_template_directory() . '/classes/class-twentytwenty-non-latin-languages.php';

// Custom CSS.
require get_template_directory() . '/inc/custom-css.php';

/**
 * Register and Enqueue Styles.
 */
function twentytwenty_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'twentytwenty-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'twentytwenty-style', 'rtl', 'replace' );

	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'twentytwenty-style', twentytwenty_get_customizer_css( 'front-end' ) );

	// Add print CSS.
	wp_enqueue_style( 'twentytwenty-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print' );

}

// add_action( 'wp_enqueue_scripts', 'twentytwenty_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function twentytwenty_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'twentytwenty-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'twentytwenty-js', 'async', true );

}

// add_action( 'wp_enqueue_scripts', 'twentytwenty_register_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentytwenty_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentytwenty_skip_link_focus_fix' );

/** Enqueue non-latin language styles
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_non_latin_languages() {
	$custom_css = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twentytwenty-style', $custom_css );
	}
}

// add_action( 'wp_enqueue_scripts', 'twentytwenty_non_latin_languages' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function twentytwenty_menus() {

	$locations = array(
		'primary'  => __( 'Desktop Horizontal Menu', 'twentytwenty' ),
		'expanded' => __( 'Desktop Expanded Menu', 'twentytwenty' ),
		'mobile'   => __( 'Mobile Menu', 'twentytwenty' ),
		'footer'   => __( 'Footer Menu', 'twentytwenty' ),
		'social'   => __( 'Social Menu', 'twentytwenty' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'twentytwenty_menus' );

/**
 * Get the information about the logo.
 *
 * @param string $html The HTML output from get_custom_logo (core function).
 *
 * @return string $html
 */
function twentytwenty_get_custom_logo( $html ) {

	$logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $logo_id ) {
		return $html;
	}

	$logo = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo ) {
		// For clarity.
		$logo_width  = esc_attr( $logo[1] );
		$logo_height = esc_attr( $logo[2] );

		// If the retina logo setting is active, reduce the width/height by half.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width / 2 );
			$logo_height = floor( $logo_height / 2 );

			$search = array(
				'/width=\"\d+\"/iU',
				'/height=\"\d+\"/iU',
			);

			$replace = array(
				"width=\"{$logo_width}\"",
				"height=\"{$logo_height}\"",
			);

			// Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
			if ( strpos( $html, ' style=' ) === false ) {
				$search[]  = '/(src=)/';
				$replace[] = "style=\"height: {$logo_height}px;\" src=";
			} else {
				$search[]  = '/(style="[^"]*)/';
				$replace[] = "$1 height: {$logo_height}px;";
			}

			$html = preg_replace( $search, $replace, $html );

		}
	}

	return $html;

}

add_filter( 'get_custom_logo', 'twentytwenty_get_custom_logo' );

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function twentytwenty_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'twentytwenty' ) . '</a>';
}

add_action( 'wp_body_open', 'twentytwenty_skip_link', 5 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentytwenty_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1', 'twentytwenty' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'twentytwenty' ),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2', 'twentytwenty' ),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #3. (Who we are)
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'Who we are', 'twentytwenty' ),
				'id'          => 'who-we-are',
				'description' => __( 'Who we are sidebar.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #4. (Our Business)
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'Our Business', 'twentytwenty' ),
				'id'          => 'our-business',
				'description' => __( 'Our Business sidebar.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #5. (Career Opportunities)
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'Career Opportunities', 'twentytwenty' ),
				'id'          => 'career-opportunities',
				'description' => __( 'Career Opportunities sidebar.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #6. (News and Updates)
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'News and Updates', 'twentytwenty' ),
				'id'          => 'news-and-updates',
				'description' => __( 'News and Updates sidebar.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #7. (Aboutus-pages description)
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'About Us Description', 'twentytwenty' ),
				'id'          => 'about-us-description',
				'description' => __( 'About Us Description sidebar.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #8. (Investor-pages description)
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'Investor Description', 'twentytwenty' ),
				'id'          => 'investor-description',
				'description' => __( 'Investor Description sidebar.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #9. (Top Ten Shareholders Heading)
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'Top Ten Shareholders Heading', 'twentytwenty' ),
				'id'          => 'top-ten-shareholders-heading',
				'description' => __( 'Top Ten Shareholders Heading sidebar.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #10. (Shareholder Download Section)
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'Shareholder Download Section', 'twentytwenty' ),
				'id'          => 'shareholder-download-section',
				'description' => __( 'Shareholder Download Section sidebar.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #11. (Financial Data)
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'Financial Data', 'twentytwenty' ),
				'id'          => 'financial-data',
				'description' => __( 'Financial Data Section for Investors sidebar.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #12. (Career Jobs)
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'Career Jobs Section', 'twentytwenty' ),
				'id'          => 'career-jobs-section',
				'description' => __( 'Career Jobs Section for Careers sidebar.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #13. (Performance Section Main)
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'Performance Section Main', 'twentytwenty' ),
				'id'          => 'performance-section-main',
				'description' => __( 'Performance Section Main sidebar for site pages.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #14. (Performance Section List)
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'Performance Section List', 'twentytwenty' ),
				'id'          => 'performance-section-list',
				'description' => __( 'Performance Section List sidebar for site pages.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #15. (Stock Data Section)
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'Stock Data Section', 'twentytwenty' ),
				'id'          => 'stock-data-section',
				'description' => __( 'Stock Data Section for investor pages.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #16. (Footer Stock Data Section)
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'Footer Stock Data Section', 'twentytwenty' ),
				'id'          => 'footer-stock-data-section',
				'description' => __( 'Stock Data Section for footer.', 'twentytwenty' ),
			)
		)
	);

	// Sidebar #17. ()
	register_sidebar(
		array_merge(
			array(
				'name'        => __( 'Stock Widget And Apps Download Area Section', 'twentytwenty' ),
				'id'          => 'stock-widget-and-apps-download-area-section',
				'description' => __( 'Stock Widget And Apps Download Area Section On Homepage.', 'twentytwenty' ),
			)
		)
	);

}

add_action( 'widgets_init', 'twentytwenty_sidebar_registration' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentytwenty_block_editor_styles() {

	$css_dependencies = array();

	// Enqueue the editor styles.
	wp_enqueue_style( 'twentytwenty-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style-block.css' ), $css_dependencies, wp_get_theme()->get( 'Version' ), 'all' );
	wp_style_add_data( 'twentytwenty-block-editor-styles', 'rtl', 'replace' );

	// Add inline style from the Customizer.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', twentytwenty_get_customizer_css( 'block-editor' ) );

	// Add inline style for non-latin fonts.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'block-editor' ) );

	// Enqueue the editor script.
	wp_enqueue_script( 'twentytwenty-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwenty_block_editor_styles', 1, 1 );

/**
 * Enqueue classic editor styles.
 */
function twentytwenty_classic_editor_styles() {

	$classic_editor_styles = array(
		'/assets/css/editor-style-classic.css',
	);

	add_editor_style( $classic_editor_styles );

}

add_action( 'init', 'twentytwenty_classic_editor_styles' );

/**
 * Output Customizer settings in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 *
 * @return array $mce_init TinyMCE styles.
 */
function twentytwenty_add_classic_editor_customizer_styles( $mce_init ) {

	$styles = twentytwenty_get_customizer_css( 'classic-editor' );

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_customizer_styles' );

/**
 * Output non-latin font styles in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 *
 * @return array $mce_init TinyMCE styles.
 */
function twentytwenty_add_classic_editor_non_latin_styles( $mce_init ) {

	$styles = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'classic-editor' );

	// Return if there are no styles to add.
	if ( ! $styles ) {
		return $mce_init;
	}

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_non_latin_styles' );

/**
 * Block Editor Settings.
 * Add custom colors and font sizes to the block editor.
 */
function twentytwenty_block_editor_settings() {

	// Block Editor Palette.
	$editor_color_palette = array(
		array(
			'name'  => __( 'Accent Color', 'twentytwenty' ),
			'slug'  => 'accent',
			'color' => twentytwenty_get_color_for_area( 'content', 'accent' ),
		),
		array(
			'name'  => __( 'Primary', 'twentytwenty' ),
			'slug'  => 'primary',
			'color' => twentytwenty_get_color_for_area( 'content', 'text' ),
		),
		array(
			'name'  => __( 'Secondary', 'twentytwenty' ),
			'slug'  => 'secondary',
			'color' => twentytwenty_get_color_for_area( 'content', 'secondary' ),
		),
		array(
			'name'  => __( 'Subtle Background', 'twentytwenty' ),
			'slug'  => 'subtle-background',
			'color' => twentytwenty_get_color_for_area( 'content', 'borders' ),
		),
	);

	// Add the background option.
	$background_color = get_theme_mod( 'background_color' );
	if ( ! $background_color ) {
		$background_color_arr = get_theme_support( 'custom-background' );
		$background_color     = $background_color_arr[0]['default-color'];
	}
	$editor_color_palette[] = array(
		'name'  => __( 'Background Color', 'twentytwenty' ),
		'slug'  => 'background',
		'color' => '#' . $background_color,
	);

	// If we have accent colors, add them to the block editor palette.
	if ( $editor_color_palette ) {
		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}

	// Block Editor Font Sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'twentytwenty' ),
				'size'      => 18,
				'slug'      => 'small',
			),
			array(
				'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'twentytwenty' ),
				'size'      => 21,
				'slug'      => 'normal',
			),
			array(
				'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'twentytwenty' ),
				'size'      => 26.25,
				'slug'      => 'large',
			),
			array(
				'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'twentytwenty' ),
				'size'      => 32,
				'slug'      => 'larger',
			),
		)
	);

	// If we have a dark background color then add support for dark editor style.
	// We can determine if the background color is dark by checking if the text-color is white.
	if ( '#ffffff' === strtolower( twentytwenty_get_color_for_area( 'content', 'text' ) ) ) {
		add_theme_support( 'dark-editor-style' );
	}

}

add_action( 'after_setup_theme', 'twentytwenty_block_editor_settings' );

/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 *
 * @return string $html
 */
function twentytwenty_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}

add_filter( 'the_content_more_link', 'twentytwenty_read_more_tag' );

/**
 * Enqueues scripts for customizer controls & settings.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_controls_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Add main customizer js file.
	wp_enqueue_script( 'twentytwenty-customize', get_template_directory_uri() . '/assets/js/customize.js', array( 'jquery' ), $theme_version, false );

	// Add script for color calculations.
	wp_enqueue_script( 'twentytwenty-color-calculations', get_template_directory_uri() . '/assets/js/color-calculations.js', array( 'wp-color-picker' ), $theme_version, false );

	// Add script for controls.
	wp_enqueue_script( 'twentytwenty-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array( 'twentytwenty-color-calculations', 'customize-controls', 'underscore', 'jquery' ), $theme_version, false );
	wp_localize_script( 'twentytwenty-customize-controls', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
}

add_action( 'customize_controls_enqueue_scripts', 'twentytwenty_customize_controls_enqueue_scripts' );

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_preview_init() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script( 'twentytwenty-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview', 'customize-selective-refresh', 'jquery' ), $theme_version, true );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyPreviewEls', twentytwenty_get_elements_array() );

	wp_add_inline_script(
		'twentytwenty-customize-preview',
		sprintf(
			'wp.customize.selectiveRefresh.partialConstructor[ %1$s ].prototype.attrs = %2$s;',
			wp_json_encode( 'cover_opacity' ),
			wp_json_encode( twentytwenty_customize_opacity_range() )
		)
	);
}

add_action( 'customize_preview_init', 'twentytwenty_customize_preview_init' );

/**
 * Get accessible color for an area.
 *
 * @since Twenty Twenty 1.0
 *
 * @param string $area The area we want to get the colors for.
 * @param string $context Can be 'text' or 'accent'.
 * @return string Returns a HEX color.
 */
function twentytwenty_get_color_for_area( $area = 'content', $context = 'text' ) {

	// Get the value from the theme-mod.
	$settings = get_theme_mod(
		'accent_accessible_colors',
		array(
			'content'       => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
			'header-footer' => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
		)
	);

	// If we have a value return it.
	if ( isset( $settings[ $area ] ) && isset( $settings[ $area ][ $context ] ) ) {
		return $settings[ $area ][ $context ];
	}

	// Return false if the option doesn't exist.
	return false;
}

/**
 * Returns an array of variables for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_customizer_color_vars() {
	$colors = array(
		'content'       => array(
			'setting' => 'background_color',
		),
		'header-footer' => array(
			'setting' => 'header_footer_background_color',
		),
	);
	return $colors;
}

/**
 * Get an array of elements.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_elements_array() {

	// The array is formatted like this:
	// [key-in-saved-setting][sub-key-in-setting][css-property] = [elements].
	$elements = array(
		'content'       => array(
			'accent'     => array(
				'color'            => array( '.color-accent', '.color-accent-hover:hover', '.color-accent-hover:focus', ':root .has-accent-color', '.has-drop-cap:not(:focus):first-letter', '.wp-block-button.is-style-outline', 'a' ),
				'border-color'     => array( 'blockquote', '.border-color-accent', '.border-color-accent-hover:hover', '.border-color-accent-hover:focus' ),
				'background-color' => array( 'button:not(.toggle)', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file .wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.bg-accent', '.bg-accent-hover:hover', '.bg-accent-hover:focus', ':root .has-accent-background-color', '.comment-reply-link' ),
				'fill'             => array( '.fill-children-accent', '.fill-children-accent *' ),
			),
			'background' => array(
				'color'            => array( ':root .has-background-color', 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.wp-block-button', '.comment-reply-link', '.has-background.has-primary-background-color:not(.has-text-color)', '.has-background.has-primary-background-color *:not(.has-text-color)', '.has-background.has-accent-background-color:not(.has-text-color)', '.has-background.has-accent-background-color *:not(.has-text-color)' ),
				'background-color' => array( ':root .has-background-background-color' ),
			),
			'text'       => array(
				'color'            => array( 'body', '.entry-title a', ':root .has-primary-color' ),
				'background-color' => array( ':root .has-primary-background-color' ),
			),
			'secondary'  => array(
				'color'            => array( 'cite', 'figcaption', '.wp-caption-text', '.post-meta', '.entry-content .wp-block-archives li', '.entry-content .wp-block-categories li', '.entry-content .wp-block-latest-posts li', '.wp-block-latest-comments__comment-date', '.wp-block-latest-posts__post-date', '.wp-block-embed figcaption', '.wp-block-image figcaption', '.wp-block-pullquote cite', '.comment-metadata', '.comment-respond .comment-notes', '.comment-respond .logged-in-as', '.pagination .dots', '.entry-content hr:not(.has-background)', 'hr.styled-separator', ':root .has-secondary-color' ),
				'background-color' => array( ':root .has-secondary-background-color' ),
			),
			'borders'    => array(
				'border-color'        => array( 'pre', 'fieldset', 'input', 'textarea', 'table', 'table *', 'hr' ),
				'background-color'    => array( 'caption', 'code', 'code', 'kbd', 'samp', '.wp-block-table.is-style-stripes tbody tr:nth-child(odd)', ':root .has-subtle-background-background-color' ),
				'border-bottom-color' => array( '.wp-block-table.is-style-stripes' ),
				'border-top-color'    => array( '.wp-block-latest-posts.is-grid li' ),
				'color'               => array( ':root .has-subtle-background-color' ),
			),
		),
		'header-footer' => array(
			'accent'     => array(
				'color'            => array( 'body:not(.overlay-header) .primary-menu > li > a', 'body:not(.overlay-header) .primary-menu > li > .icon', '.modal-menu a', '.footer-menu a, .footer-widgets a', '#site-footer .wp-block-button.is-style-outline', '.wp-block-pullquote:before', '.singular:not(.overlay-header) .entry-header a', '.archive-header a', '.header-footer-group .color-accent', '.header-footer-group .color-accent-hover:hover' ),
				'background-color' => array( '.social-icons a', '#site-footer button:not(.toggle)', '#site-footer .button', '#site-footer .faux-button', '#site-footer .wp-block-button__link', '#site-footer .wp-block-file__button', '#site-footer input[type="button"]', '#site-footer input[type="reset"]', '#site-footer input[type="submit"]' ),
			),
			'background' => array(
				'color'            => array( '.social-icons a', 'body:not(.overlay-header) .primary-menu ul', '.header-footer-group button', '.header-footer-group .button', '.header-footer-group .faux-button', '.header-footer-group .wp-block-button:not(.is-style-outline) .wp-block-button__link', '.header-footer-group .wp-block-file__button', '.header-footer-group input[type="button"]', '.header-footer-group input[type="reset"]', '.header-footer-group input[type="submit"]' ),
				'background-color' => array( '#site-header', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal', '.menu-modal-inner', '.search-modal-inner', '.archive-header', '.singular .entry-header', '.singular .featured-media:before', '.wp-block-pullquote:before' ),
			),
			'text'       => array(
				'color'               => array( '.header-footer-group', 'body:not(.overlay-header) #site-header .toggle', '.menu-modal .toggle' ),
				'background-color'    => array( 'body:not(.overlay-header) .primary-menu ul' ),
				'border-bottom-color' => array( 'body:not(.overlay-header) .primary-menu > li > ul:after' ),
				'border-left-color'   => array( 'body:not(.overlay-header) .primary-menu ul ul:after' ),
			),
			'secondary'  => array(
				'color' => array( '.site-description', 'body:not(.overlay-header) .toggle-inner .toggle-text', '.widget .post-date', '.widget .rss-date', '.widget_archive li', '.widget_categories li', '.widget cite', '.widget_pages li', '.widget_meta li', '.widget_nav_menu li', '.powered-by-wordpress', '.to-the-top', '.singular .entry-header .post-meta', '.singular:not(.overlay-header) .entry-header .post-meta a' ),
			),
			'borders'    => array(
				'border-color'     => array( '.header-footer-group pre', '.header-footer-group fieldset', '.header-footer-group input', '.header-footer-group textarea', '.header-footer-group table', '.header-footer-group table *', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal nav *', '.footer-widgets-outer-wrapper', '.footer-top' ),
				'background-color' => array( '.header-footer-group table caption', 'body:not(.overlay-header) .header-inner .toggle-wrapper::before' ),
			),
		),
	);

	/**
	* Filters Twenty Twenty theme elements
	*
	* @since Twenty Twenty 1.0
	*
	* @param array Array of elements
	*/
	return apply_filters( 'twentytwenty_get_elements_array', $elements );
}

              

              //*********                              ********//
              //********* Custom work in functions.php ********// 
			  //*********                              ********//



// adding styles & scripts

function gt_setup() {
    wp_enqueue_style( 'owl-carousel', get_theme_file_uri( 'assets/dist/assets/owl.carousel.min.css' ), NULL, microtime(), all );
    wp_enqueue_style( 'owl-theme', get_theme_file_uri( 'assets/dist/assets/owl.theme.default.min.css' ), NULL, microtime(), all );
    wp_enqueue_style( 'aos', 'https://unpkg.com/aos@next/dist/aos.css' );
    wp_enqueue_style( 'datepicker', get_theme_file_uri( 'assets/datepicker/datepicker.min.css' ), NULL, microtime(), all );
    wp_enqueue_style( 'style', get_stylesheet_uri(), NULL, microtime(), all );
    wp_enqueue_script( 'Jquery', get_theme_file_uri( 'assets/bootstrap4.5.0/Jquery.js' ), NULL, microtime(), true );
    wp_enqueue_script( 'bootstrap', get_theme_file_uri( 'assets/bootstrap4.5.0/bootstrap.min.js' ), NULL, microtime(), true );
    wp_enqueue_script( 'all', get_theme_file_uri( 'assets/fontawesome/js/all.js' ), NULL, microtime(), true );
    wp_enqueue_script( 'owl-carousel', get_theme_file_uri( 'assets/dist/owl.carousel.min.js' ), NULL, microtime(), true );
    wp_enqueue_script( 'highstock', 'https://code.highcharts.com/stock/highstock.js' );
    wp_enqueue_script( 'data', 'https://code.highcharts.com/stock/modules/data.js' );
    wp_enqueue_script( 'exporting', 'https://code.highcharts.com/stock/modules/exporting.js' );
    wp_enqueue_script( 'export-data', 'https://code.highcharts.com/stock/modules/export-data.js' );
    wp_enqueue_script( 'aos', 'https://unpkg.com/aos@next/dist/aos.js' );
    wp_enqueue_script( 'datepicker', get_theme_file_uri( 'assets/datepicker/datepicker.min.js' ), NULL, microtime(), true );
    wp_enqueue_script( 'custom', get_theme_file_uri( 'assets/js/custom.js' ), NULL, microtime(), true );
}

add_action( 'wp_enqueue_scripts', 'gt_setup' );

function pagination($pages = '', $range = 4)
{
    $showitems = ($range * 2)+1;
 
    global $paged;
    if(empty($paged)) $paged = 1;
 
    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }
 
    if(1 != $pages)
    {
        echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
        if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
            }
        }
 
        if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
        echo "</div>\n";
    }
}

function custom_header_menu(){
    $menuLocations = get_nav_menu_locations(); // Get nav locations (set in theme settings above)
    // This returns an array of menu locations ([LOCATION_NAME] = MENU_ID);
    $menuID = $menuLocations['primary']; // Get the *primary* menu ID
    $navbar_items = wp_get_nav_menu_items($menuID, array());
    $children  = array();
    $parents = array();
    //break items into separate arrays of child and parent
    foreach ($navbar_items as $key => $item) {
        if($item->menu_item_parent){
            array_push($children, $item);
            unset($navbar_items[$key]);
        }
    }
    //attch children to parents
    foreach ($navbar_items as $key => $item) {
        $navbar_items[$key]->children = array();
        foreach ($children as $k => $child) {
            if ($item->ID == $child->menu_item_parent) {
                array_push($navbar_items[$key]->children, $child);
            }
        }
    }
    //render HTML
    $output .= '<ul class="list-unstyled d-flex nav_items">';
    foreach ($navbar_items as $key => $item) {
        switch (strtolower($item->title)) {
            case 'about us':
                $class = 'caretDown';
                $heading_text = '';
                break;
            case 'investors':
                $class = 'caretDown';
                $heading_text = '';
                break;
            case 'our business':
                $class = 'caretDown';
                $heading_text = '';
                break;
            case 'career':
                $class = 'caretDown';
                $heading_text = '';
                break;
            default:
                $class = '';
                $heading_text = '';
                break;
        }
        $output .= '<li class="'.$class.'"><a href="'.$item->url.'">'.strtolower($item->title).'</a>';
        if ($item->children && !empty($item->children)) {
            $output .= '<img src="'.get_template_directory_uri().'/assets/images/caret.png" />';
            $output .= '<ul class="list-unstyled sub__menu">';
            // $output .= $heading_text;
            foreach ($item->children as $k => $child) {
            	$child_title = $child->title;
                if(isset($child->title) && !empty($child->title) && $child->title != ''){
                    if(strpos($child->title, 'and') !== FALSE){
                        $child_title = str_replace('and', '&', $child->title);
                    }
                }
                $output .= '<li><a href="'.$child->url.'" target="'.$child->target.'">'.strtolower($child_title).'</a></li>';
            }
            $output .= '</ul>';
        }
        $output .= '</li>'; 
    }
    $output .= '</ul>';
    
    return $output; 
}

function custom_footer_menu(){
    $menuLocations = get_nav_menu_locations(); // Get nav locations (set in theme settings above)
    // This returns an array of menu locations ([LOCATION_NAME] = MENU_ID);
    $menuID = $menuLocations['footer']; // Get the *primary* menu ID
    $navbar_items = wp_get_nav_menu_items($menuID, array());
    $children  = array();
    $parents = array();
    //break items into separate arrays of child and parent
    foreach ($navbar_items as $key => $item) {
        if($item->menu_item_parent){
            array_push($children, $item);
            unset($navbar_items[$key]);
        }
    }
    //attch children to parents
    foreach ($navbar_items as $key => $item) {
        $navbar_items[$key]->children = array();
        foreach ($children as $k => $child) {
            if ($item->ID == $child->menu_item_parent) {
                array_push($navbar_items[$key]->children, $child);
            }
        }
    }
    //render HTML
    $output .= '';
    foreach ($navbar_items as $key => $item) {
        $output .= '<div class="col-md-3 mb-3">';
        $output .= '<h3 class="footer_heading">'.strtoupper($item->title).'</h3>';
        $output .= '<ul class="list-unstyled footer_Links">';
        if ($item->children && !empty($item->children)) {
            foreach ($item->children as $k => $child) {
                $child_title = $child->title;
                if(isset($child->title) && !empty($child->title) && $child->title != ''){
                    if(strpos($child->title, 'and') !== FALSE){
                        $child_title = str_replace('and', '&', $child->title);
                    }
                }
                $output .= '<li><a href="'.$child->url.'">'.$child_title.'</a></li>';
            }
        }
        $output .= '</ul>';
        $output .= '</div>'; 
    }
    
    return $output; 
}

function custom_about_menu(){
    $menuLocations = get_nav_menu_locations(); // Get nav locations (set in theme settings above)
    // This returns an array of menu locations ([LOCATION_NAME] = MENU_ID);
    $menuID = $menuLocations['custom_about_menu']; // Get the *primary* menu ID
    $navbar_items = wp_get_nav_menu_items($menuID, array());

    //render HTML
    $output .= '<ul class="list-unstyled">';
    foreach ($navbar_items as $key => $item) {

        $item_title = $item->title;
        // $page_id = url_to_postid($item->url);
        $page_id = get_queried_object_id();
        $class_attr = '';
        if($page_id == $item->object_id){
        	$class_attr = 'class="link_active"';
        }
        $output .= '<li><a '.$class_attr.' href="'.$item->url.'">'.$item_title.'</a></li>';
    }
    $output .= '</ul>';
    
    return $output; 
}

function custom_investor_menu(){
    $menuLocations = get_nav_menu_locations(); // Get nav locations (set in theme settings above)
    // This returns an array of menu locations ([LOCATION_NAME] = MENU_ID);
    $menuID = $menuLocations['custom_investor_menu']; // Get the *primary* menu ID
    $navbar_items = wp_get_nav_menu_items($menuID, array());
    $children  = array();
    $parents = array();
    //break items into separate arrays of child and parent
    foreach ($navbar_items as $key => $item) {
        if($item->menu_item_parent){
            array_push($children, $item);
            unset($navbar_items[$key]);
        }
    }
    //attch children to parents
    foreach ($navbar_items as $key => $item) {
        $navbar_items[$key]->children = array();
        foreach ($children as $k => $child) {
            if ($item->ID == $child->menu_item_parent) {
                array_push($navbar_items[$key]->children, $child);
            }
        }
    }
    //render HTML
    $output .= '<ul class="list-unstyled">';
    
    foreach ($navbar_items as $key => $item) {
        if ($item->children && !empty($item->children)) {
        	$output .= '<li><a href="javascript:void(0)">'.$item->title.'</a>';
            $output .= '<ul>';
            foreach ($item->children as $k => $child) {
                $output .= '<li><a href="'.$child->url.'">'.$child->title.'</a></li>';
            }
            $output .= '</ul>';
        }else{
        	$output .= '<li><a href="'.$item->url.'">'.$item->title.'</a>';
        }
        $output .= '</li>'; 
    }
    $output .= '</ul>';
    
    return $output; 
}

function custom_how_we_do_business_menu(){
    $menuLocations = get_nav_menu_locations(); // Get nav locations (set in theme settings above)
    // This returns an array of menu locations ([LOCATION_NAME] = MENU_ID);
    $menuID = $menuLocations['custom_how_we_do_business_menu']; // Get the *primary* menu ID
    $navbar_items = wp_get_nav_menu_items($menuID, array());

    //render HTML
    $output .= '<ul class="list-unstyled">';
    foreach ($navbar_items as $key => $item) {

        $item_title = $item->title;
        // $page_id = url_to_postid($item->url);
        $page_id = get_queried_object_id();
        $class_attr = '';
        if($page_id == $item->object_id){
        	$class_attr = 'class="link_active"';
        }
        $output .= '<li><a '.$class_attr.' href="'.$item->url.'">'.$item_title.'</a></li>';
    }
    $output .= '</ul>';
    
    return $output; 
}

function custom_about_us_menu(){
    $menuLocations = get_nav_menu_locations(); // Get nav locations (set in theme settings above)
    // This returns an array of menu locations ([LOCATION_NAME] = MENU_ID);
    $menuID = $menuLocations['primary']; // Get the *primary* menu ID
    $navbar_items = wp_get_nav_menu_items($menuID, array());
    $children  = array();
    $about_us_menu_items = array();
    //break items into separate arrays of child and parent
    foreach ($navbar_items as $key => $item) {
        if($item->menu_item_parent){
            array_push($children, $item);
            unset($navbar_items[$key]);
        }
    }

    //attch children to parents
    foreach ($navbar_items as $key => $item) {
    	if($item->ID == 44){
	        $navbar_items[$key]->children = array();
	        foreach ($children as $k => $child) {
	            if ($item->ID == $child->menu_item_parent) {
	                array_push($navbar_items[$key]->children, $child);
	                array_push($about_us_menu_items, $child);
	            }
	        }
        }
    }
    
    //render HTML
    $output .= '<ul class="list-unstyled">';
    foreach ($about_us_menu_items as $key => $item) {

        $item_title = $item->title;
        // $page_id = url_to_postid($item->url);
        $page_id = get_queried_object_id();
        $class_attr = '';
        if($page_id == $item->object_id){
        	$class_attr = 'class="link_active"';
        }
        $output .= '<li><a '.$class_attr.' href="'.$item->url.'">'.$item_title.'</a></li>';
    }
    $output .= '</ul>';

    return $output; 
}

register_nav_menus( array(
    'primary' => __( 'Primary Menu' ),
    'footer' => __( 'Footer Menu' ),
    'custom_about_menu' => __( 'Custom About Menu' ),
    'custom_investor_menu' => __( 'Custom Investor Menu' ),
    'custom_how_we_do_business_menu' => __( 'Custom How We Do Business Menu' ),
) );

/**
 * custom Post Type - News Items
 */
add_action( 'init', function() {
    $labels = array(
      'name'               => _x( 'News Items', 'News Items', 'twentytwenty' ),
      'singular_name'      => _x( 'News Item', 'News Item', 'twentytwenty' ),
      'menu_name'          => _x( 'News Items', 'admin menu', 'twentytwenty' ),
      'name_admin_bar'     => _x( 'News Item', 'add new on admin bar', 'twentytwenty' ),
      'add_new'            => _x( 'Add New', 'news', 'twentytwenty' ),
      'add_new_item'       => __( 'Add New News', 'twentytwenty' ),
      'new_item'           => __( 'New News', 'twentytwenty' ),
      'edit_item'          => __( 'Edit News', 'twentytwenty' ),
      'view_item'          => __( 'View News', 'twentytwenty' ),
      'all_items'          => __( 'All News Items', 'twentytwenty' ),
      'search_items'       => __( 'Search News Items', 'twentytwenty' ),
      'parent_item_colon'  => __( 'Parent News Items:', 'twentytwenty' ),
      'not_found'          => __( 'No News found.', 'twentytwenty' ),
      'not_found_in_trash' => __( 'No News found in Trash.', 'twentytwenty' )
    );

    $args = array(	
      'labels'             => $labels,
      'description'        => __( 'News & Articles.', 'twentytwenty' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'show_in_nav_menus'  => true,
      'show_in_admin_bar'  => true,
      'menu_position'      => 5,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'news-item' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'exclude_from_search'=> false,
      'hierarchical'       => false,
      'menu_position'      => null,
      'can_export'         => true,
      'menu_icon'          => 'dashicons-format-aside',
      'show_in_rest'       => true,
      'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );
    register_post_type( 'News Items', $args );

    register_taxonomy(
        'news_category',
        'newsitems',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'news_category' ),
            'hierarchical' => true,
        )
    );
    flush_rewrite_rules(false);
});

/**
 * custom Post Type - Leadership
 */
add_action( 'init', function() {
    $labels = array(
      'name'               => _x( 'Leadership', 'Leadership', 'twentytwenty' ),
      'singular_name'      => _x( 'Leadership', 'Leadership', 'twentytwenty' ),
      'menu_name'          => _x( 'Leadership', 'admin menu', 'twentytwenty' ),
      'name_admin_bar'     => _x( 'Leadership', 'add new on admin bar', 'twentytwenty' ),
      'add_new'            => _x( 'Add New', 'leadership', 'twentytwenty' ),
      'add_new_item'       => __( 'Add New Leadership', 'twentytwenty' ),
      'new_item'           => __( 'New Leadership', 'twentytwenty' ),
      'edit_item'          => __( 'Edit Leadership', 'twentytwenty' ),
      'view_item'          => __( 'View Leadership', 'twentytwenty' ),
      'all_items'          => __( 'All Leadership', 'twentytwenty' ),
      'search_items'       => __( 'Search Leadership', 'twentytwenty' ),
      'parent_item_colon'  => __( 'Parent Leadership:', 'twentytwenty' ),
      'not_found'          => __( 'No Leadership found.', 'twentytwenty' ),
      'not_found_in_trash' => __( 'No Leadership found in Trash.', 'twentytwenty' )
    );

    $args = array(	
      'labels'             => $labels,
      'description'        => __( 'Leadership', 'twentytwenty' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'show_in_nav_menus'  => true,
      'show_in_admin_bar'  => true,
      'menu_position'      => 5,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'leadership-profile' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'exclude_from_search'=> false,
      'hierarchical'       => false,
      'menu_position'      => null,
      'can_export'         => true,
      'menu_icon'          => 'dashicons-format-aside',
      'show_in_rest'       => true,
      'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );
    register_post_type( 'leadership', $args );

    register_taxonomy(
        'leadership_category',
        'leadership',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'leadership_category' ),
            'hierarchical' => true,
            'show_in_rest' => true,
        )
    );
    flush_rewrite_rules(false);
});

/**
 * custom Post Type - Financial Calendar
 */
include 'financial-calendar-custom-post-type.php';

/**
 * custom Post Type - Corporate Governance
 */
include 'corporate-governance-custom-post-type.php';

/**
 * custom Post Type - Top Ten Shareholders
 */
include 'top-ten-shareholders-custom-post-type.php';

/**
 * custom Post Type - Business Products
 */
include 'business-products-custom-post-type.php';

/**
 * custom Post Type - FAQs
 */
include 'faqs-custom-post-type.php';

/**
 * custom Post Type - Massy Sliders
 */
include 'massy-sliders-custom-post-type.php';

function custom_meta_boxes() {
    add_meta_box( 'sm_meta', __( 'Featured Posts', 'sm-textdomain' ), 'sm_meta_callback', 'newsitems' );
    add_meta_box( 'custom_meta_box_1', __( 'Featured Posts', 'custom_meta_box_1-textdomain' ), 'custom_meta_box_1_callback', 'leadership' );
    add_meta_box( 'custom_meta_box_2', __( 'Designation', 'custom_meta_box_2-textdomain' ), 'custom_meta_box_2_callback', 'leadership' );
    add_meta_box( 'custom_meta_box_3', __( 'Date', 'custom_meta_box_3-textdomain' ), 'custom_meta_box_3_callback', 'financialcalendar' );
    add_meta_box( 'custom_meta_box_4', __( 'Shareholding', 'custom_meta_box_4-textdomain' ), 'custom_meta_box_4_callback', 'toptenshareholder' );
    add_meta_box( 'custom_meta_box_5', __( 'Percentage', 'custom_meta_box_5-textdomain' ), 'custom_meta_box_5_callback', 'toptenshareholder' );
}

/**
 * custom meta Box - Callback (custom meta Box - NewsItem *** Featured ***)
 */
function sm_meta_callback( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>
	<p>
	    <div class="sm-row-content">
	        <label for="meta-checkbox">
	            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
	            <?php _e( 'Featured this post', 'sm-textdomain' )?>
	        </label>
	    </div>
	</p>
    <?php
}

/**
 * Saves the custom meta input
 */
function sm_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and saves
	if( isset( $_POST[ 'meta-checkbox' ] ) ) {
	    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
	} else {
	    update_post_meta( $post_id, 'meta-checkbox', 'no' );
	}
 
}

/**
 * custom meta Box - Callback (custom meta Box - Leadership *** Featured ***)
 */
function custom_meta_box_1_callback( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>
	<p>
	    <div class="sm-row-content">
	        <label for="meta-checkbox_leadership">
	            <input type="checkbox" name="meta-checkbox_leadership" id="meta-checkbox_leadership" value="yes" <?php if ( isset ( $featured['meta-checkbox_leadership'] ) ) checked( $featured['meta-checkbox_leadership'][0], 'yes' ); ?> />
	            <?php _e( 'Featured this post', 'custom_meta_box_1-textdomain' )?>
	        </label>
	    </div>
	</p>
    <?php
}

/**
 * Saves the custom meta input
 */
function custom_meta_box_1_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and saves
	if( isset( $_POST[ 'meta-checkbox_leadership' ] ) ) {
	    update_post_meta( $post_id, 'meta-checkbox_leadership', 'yes' );
	} else {
	    update_post_meta( $post_id, 'meta-checkbox_leadership', 'no' );
	}
 
}

/**
 * custom meta Box - Callback (custom meta Box - Leadership *** Designation ***)
 */
function custom_meta_box_2_callback( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>
	<p>
	    <div class="sm-row-content">
	        <label for="meta-textbox_leadership">
	        	<?php _e( 'Enter Designation', 'custom_meta_box_2-textdomain' )?>
	            <input type="text" name="meta-textbox_leadership" id="meta-textbox_leadership" value="<?php if ( isset ( $featured['meta-textbox_leadership'] ) ){ echo $featured['meta-textbox_leadership'][0] ; } ?>" />
	        </label>
	    </div>
	</p>
    <?php
}

/**
 * Saves the custom meta input
 */
function custom_meta_box_2_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and saves
	if( isset( $_POST[ 'meta-textbox_leadership' ] ) ) {
	    update_post_meta( $post_id, 'meta-textbox_leadership', $_POST[ 'meta-textbox_leadership' ] );
	} else {
	    update_post_meta( $post_id, 'meta-textbox_leadership', '' );
	}
 
}

/**
 * custom meta Box - 3 (custom meta Box - Financial Calendar)
 */
include 'custom-metabox-3.php';

/**
 * custom meta Box - 4 (custom meta Box - Top Ten ShareHolders)
 */
include 'custom-metabox-4.php';

/**
 * custom meta Box - 5 (custom meta Box - Top Ten ShareHolders)
 */
include 'custom-metabox-5.php';

add_action( 'add_meta_boxes', 'custom_meta_boxes' );
add_action( 'save_post', 'sm_meta_save' );
add_action( 'save_post', 'custom_meta_box_1_save' );
add_action( 'save_post', 'custom_meta_box_2_save' );
add_action( 'save_post', 'custom_meta_box_3_save' );
add_action( 'save_post', 'custom_meta_box_4_save' );
add_action( 'save_post', 'custom_meta_box_5_save' );

/**
 * Custom Widgets
 */
function custom_widgets() {
	register_widget( 'aboutus_widget' );
	register_widget( 'investors_widget' );
	register_widget( 'ourbusiness_widget' );
	register_widget( 'career_opportunities_widget' );
	register_widget( 'news_widget' );
	register_widget( 'description_widget' );
	register_widget( 'date_widget' );
	register_widget( 'shareholder_download_widget' );
	register_widget( 'performance_section_main_widget' );
	register_widget( 'performance_section_list_widget' );
	register_widget( 'apps_download_area_widget' );
}

add_action( 'widgets_init', 'custom_widgets' );

include 'about-us-widget.php';
include 'investors-widget.php';
include 'our-business-widget.php';
include 'career-opportunities-widget.php';
include 'news-widget.php';
include 'description-widget.php';
include 'date-widget.php';
include 'shareholder-download-widget.php';
include 'performance-section-main-widget.php';
include 'performance-section-list-widget.php';
include 'apps-download-area-widget.php';

